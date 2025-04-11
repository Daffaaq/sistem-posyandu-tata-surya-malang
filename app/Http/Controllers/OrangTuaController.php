<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreChildrenRequest;
use App\Http\Requests\StoreOrangTuaRequest;
use App\Http\Requests\UpdateChildrenRequest;
use App\Http\Requests\UpdateOrangTuaRequest;
use App\Models\Anak;
use App\Models\OrangTua;
use App\Models\User;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class OrangTuaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:orang-tua.index')->only('index', 'list', 'viewAddChildren', 'listChildren');
        $this->middleware('permission:orang-tua.create')->only('create', 'store');
        $this->middleware('permission:orang-tua.edit')->only('edit', 'update');
        $this->middleware('permission:orang-tua.destroy')->only('destroy');
    }

    public function list(Request $request)
    {
        if ($request->ajax()) {
            if (Auth::user()->hasRole('super-admin') || Auth::user()->hasRole('admin')) {
                $orangTua = DB::table('orang_tuas')
                    ->leftJoin('users', 'orang_tuas.user_id', '=', 'users.id')
                    ->select('orang_tuas.id', 'orang_tuas.nama_ayah', 'orang_tuas.nama_ibu', 'users.is_active'); // Add is_active here
            } elseif (Auth::user()->hasRole('orang-tua')) {
                $orangTua = DB::table('orang_tuas')
                    ->leftJoin('users', 'orang_tuas.user_id', '=', 'users.id')
                    ->select('orang_tuas.id', 'orang_tuas.nama_ayah', 'orang_tuas.nama_ibu', 'users.is_active') // Add is_active here
                    ->where('orang_tuas.user_id', Auth::user()->id);
            }
            return DataTables::of($orangTua)
                ->addIndexColumn()
                ->make(true);
        }
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('orang-tua.index');
    }

    public function updateStatus($id)
    {
        // Temukan data orang tua berdasarkan ID
        $orangTua = OrangTua::find($id);

        // Jika data orang tua tidak ditemukan
        if (!$orangTua) {
            return response()->json(['success' => false, 'message' => 'Data tidak ditemukan.']);
        }

        // Akses objek user yang terkait dengan orang tua
        $user = $orangTua->user;

        // Toggle status 'is_active' dan perbarui
        if ($user->is_active == 'active') {
            // Jika status saat ini adalah active, ubah menjadi non-active dan hapus peran 'orang-tua'
            $user->is_active = 'non-active';
            $user->removeRole('orang-tua');
        } else {
            // Jika status saat ini adalah non-active, ubah menjadi active dan berikan peran 'orang-tua'
            $user->is_active = 'active';
            $user->assignRole('orang-tua');
        }

        // Simpan perubahan status dan peran
        $user->save();

        // Kembalikan response sukses
        return response()->json(['success' => true, 'message' => 'Status berhasil diperbarui.']);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('orang-tua.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrangTuaRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_active' => $request->is_active,
        ]);

        if ($user->is_active == 'active') {
            $user->assignRole('orang-tua');
        }

        $orangTua = OrangTua::create([
            'user_id' => $user->id,
            'nama_ayah' => $request->nama_ayah,
            'nama_ibu' => $request->nama_ibu,
            'tanggal_lahir_ayah' => $request->tanggal_lahir_ayah,
            'tanggal_lahir_ibu' => $request->tanggal_lahir_ibu,
            'no_telepon_ayah' => $request->no_telepon_ayah,
            'no_telepon_ibu' => $request->no_telepon_ibu,
            'email_ayah' => $request->email_ayah,
            'email_ibu' => $request->email_ibu,
            'pekerjaan_ayah' => $request->pekerjaan_ayah,
            'pekerjaan_ibu' => $request->pekerjaan_ibu,
            'alamat_ayah' => $request->alamat_ayah,
            'alamat_ibu' => $request->alamat_ibu,
        ]);

        return redirect()->route('orang-tua.index')
            ->with('success', 'Data orang tua berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $orangTua = OrangTua::with('user')->findOrFail($id);
        return view('orang-tua.show', compact('orangTua'));
    }

    public function acceptedOrangTua($id)
    {
        $orangTua = OrangTua::findOrFail($id);
        if ($orangTua->user->is_active == 'active') {
            //return json
            return response()->json([
                'success' => true,
                'message' => 'Account already active'
            ]);
        }
        $orangTua->user->update(['is_active' => 'active']);
        $orangTua->user->assignRole('orang-tua');
        // return json
        return response()->json([
            'success' => true,
            'message' => 'Account accepted'
        ]);
    }

    public function rejectedOrangTua($id)
    {
        $orangTua = OrangTua::findOrFail($id);
        if ($orangTua->user->is_active == 'non-active') {
            //return json
            return response()->json([
                'success' => true,
                'message' => 'Account already non-active'
            ]);
        }
        $orangTua->user->update(['is_active' => 'non-active']);
        $orangTua->user->removeRole('orang-tua');
        // return json
        return response()->json([
            'success' => true,
            'message' => 'Account non-active'
        ]);
    }

    public function viewAddChildren($id)
    {
        $orangTua = OrangTua::findOrFail($id);
        return view('orang-tua.add-children', compact('orangTua'));
    }

    public function addchildren(StoreChildrenRequest $request, $id)
    {
        // dd($request->all());
        $orangTua = OrangTua::findOrFail($id);

        Log::info($request->all());

        // Loop through each child in the 'children' array from the request
        foreach ($request->children as $childData) {
            // Create a new Anak record for each child and associate it with the parent
            Anak::create([
                'nama_anak' => $childData['nama_anak'],
                'jenis_kelamin_anak' => $childData['jenis_kelamin_anak'],
                'tanggal_lahir_anak' => $childData['tanggal_lahir_anak'],
                'orang_tua_id' => $orangTua->id, // Assigning the parent ID to the child
            ]);
        }

        return redirect()->route('orang-tua.view-form-add-children', $orangTua->id)
            ->with('success', 'Children added successfully!');
    }

    public function formEditAnak($id)
    {
        $anak = Anak::findOrFail($id);
        $orangTua = OrangTua::findOrFail($anak->orang_tua_id);
        return view('orang-tua.form-edit-anak', compact('anak', 'orangTua'));
    }

    public function updateAnak(UpdateChildrenRequest $request, $id)
    {
        $anak = Anak::findOrFail($id);
        $orangTua = OrangTua::findOrFail($anak->orang_tua_id);

        $validated = $request->validated();

        // Jika validasi berhasil, lanjutkan untuk update data
        $anak->update([
            'nama_anak' => $validated['nama_anak'],
            'jenis_kelamin_anak' => $validated['jenis_kelamin_anak'],
            'tanggal_lahir_anak' => $validated['tanggal_lahir_anak'],
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('orang-tua.view-form-add-children', $orangTua->id)
            ->with('success', 'Children updated successfully!');
    }

    public function destroyAnak($id)
    {
        // mulai transaksi 
        DB::beginTransaction();
        try {
            $anak = Anak::findOrFail($id);
            $anak->delete();
            DB::commit();
            return response()->json(['success' => true, 'message' => 'Data berhasil dihapus'], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Data gagal dihapus'], 500);
        }
    }

    public function listChildren(Request $request, $id)
    {
        if ($request->ajax()) {
            // Cari orang tua berdasarkan ID
            $orangTua = OrangTua::findOrFail($id);

            // Menyusun query untuk anak berdasarkan role pengguna
            $query = Anak::where('orang_tua_id', $orangTua->id)
                ->select('id', 'nama_anak', 'jenis_kelamin_anak', 'tanggal_lahir_anak');

            // Mengecek peran pengguna
            $user = Auth::user();

            // Jika role adalah super-admin atau admin, tampilkan semua anak
            if ($user->hasRole('orang-tua')) {
                // Jika role orang tua, pastikan hanya anak mereka yang bisa diakses
                if ($user->id !== $orangTua->user_id) {
                    return response()->json(['message' => 'Unauthorized'], 403);
                }
            } elseif (!$user->hasRole('super-admin') && !$user->hasRole('admin')) {
                // Role selain super-admin, admin, atau orang-tua tidak diperbolehkan
                return response()->json(['message' => 'Unauthorized'], 403);
            }

            // Jika request AJAX, kembalikan data anak dalam format DataTables
            if ($request->ajax()) {
                return DataTables::of($query)
                    ->addIndexColumn()
                    ->make(true);
            }
        }

        // jika bukan response ajax maka return 405
        return response()->json(['message' => 'Method not allowed'], 405);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $orangTua = OrangTua::findOrFail($id);
        $user = $orangTua->user;
        return view('orang-tua.edit', compact('orangTua', 'user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrangTuaRequest $request, $id)
    {
        $orangTua = OrangTua::findOrFail($id);

        $user = $orangTua->user;

        // Update data user terkait jika ada perubahan
        if ($user) {
            $user->update([
                'name' => $request->name,  // Mengupdate nama user
                'email' => $request->email, // Mengupdate email user
                // Hanya update password jika ada perubahan
                'password' => $request->password ? Hash::make($request->password) : $user->password,
            ]);
        }

        // Update data orang tua berdasarkan request yang valid
        $orangTua->update([
            'nama_ayah' => $request->nama_ayah,
            'nama_ibu' => $request->nama_ibu,
            'tanggal_lahir_ayah' => $request->tanggal_lahir_ayah,
            'tanggal_lahir_ibu' => $request->tanggal_lahir_ibu,
            'no_telepon_ayah' => $request->no_telepon_ayah,
            'no_telepon_ibu' => $request->no_telepon_ibu,
            'email_ayah' => $request->email_ayah,
            'email_ibu' => $request->email_ibu,
            'pekerjaan_ayah' => $request->pekerjaan_ayah,
            'pekerjaan_ibu' => $request->pekerjaan_ibu,
            'jenis_kelamin_ayah' => 'Laki-laki',
            'jenis_kelamin_ibu' => 'Perempuan',
            'agama_ayah' => $request->agama_ayah,
            'agama_ibu' => $request->agama_ibu,
            'alamat_ayah' => $request->alamat_ayah,
            'alamat_ibu' => $request->alamat_ibu,
        ]);

        return redirect()->route('orang-tua.index')
            ->with('success', 'Data orang tua berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //mulai transaksi
        DB::beginTransaction();
        try {
            $orangTua = OrangTua::findOrFail($id);
            $user = $orangTua->user;
            $user->delete();
            $orangTua->delete();
            DB::commit();
            //return json
            return response()->json(['success' => true, 'message' => 'Data berhasil dihapus'], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Data gagal dihapus'], 500);
        }
    }
}

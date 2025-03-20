<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreChildrenRequest;
use App\Http\Requests\UpdateChildrenRequest;
use App\Models\Anak;
use App\Models\OrangTua;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
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
            if (Auth::user()->hasRole('super-admin') || Auth::user()->hasRole('user')) {
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

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        $orangTua = OrangTua::findOrFail($id); // Cari orang tua berdasarkan ID

        // Pengecekan jika role adalah 'super-admin' atau 'user'
        if (Auth::user()->hasRole('super-admin') || Auth::user()->hasRole('user')) {
            // Jika role adalah super-admin, tampilkan semua anak
            $anak = Anak::where('orang_tua_id', $orangTua->id)->select('id', 'nama_anak', 'jenis_kelamin_anak', 'tanggal_lahir_anak');
        } elseif (Auth::user()->hasRole('orang-tua')) {
            // Jika role adalah user (orang tua), hanya tampilkan anak mereka sendiri
            if (Auth::user()->id !== $orangTua->user_id) {
                // Jika user yang login bukan orang tua yang bersangkutan, return Unauthorized
                return response()->json(['message' => 'Unauthorized'], 403);
            }
            $anak = Anak::where('orang_tua_id', $orangTua->id)->select('id', 'nama_anak', 'jenis_kelamin_anak', 'tanggal_lahir_anak');
        } else {
            // Role selain super-admin dan user tidak boleh mengakses
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        // Jika request AJAX, kembalikan data anak dalam format DataTables
        if ($request->ajax()) {
            return DataTables::of($anak)
                ->addIndexColumn()
                ->make(true);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }
}

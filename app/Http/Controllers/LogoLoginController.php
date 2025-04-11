<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLogoLoginRequest;
use App\Http\Requests\UpdateLogoLoginRequest;
use App\Models\LogoLogin;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class LogoLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:logo-login.index')->only('index', 'list');
        $this->middleware('permission:logo-login.create')->only('create', 'store');
        $this->middleware('permission:logo-login.edit')->only('edit', 'update');
        $this->middleware('permission:logo-login.destroy')->only('destroy');
    }

    public function list(Request $request)
    {
        if ($request->ajax()) {
            try {
                $showActiveOnly = filter_var($request->get('active_only'), FILTER_VALIDATE_BOOLEAN);

                $data = LogoLogin::select('id', 'judul_logo_login', 'status_logo_login');

                if ($showActiveOnly) {
                    $data->active();
                }

                return datatables()->of($data)
                    ->addIndexColumn()
                    ->make(true);
            } catch (\Exception $e) {
                return response()->json(['error' => 'Failed to fetch data'], 500);
            }
        }

        return response()->json(['message' => 'Method not allowed'], 405);
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('logo_login.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('logo_login.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLogoLoginRequest $request)
    {
        try {
            // Upload file logo
            if ($request->hasFile('logo_login')) {
                $file = $request->file('logo_login');
                $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

                // Simpan file ke storage/app/public/logo_login
                $path = $file->storeAs('public/logo_login', $filename);

                // Default status dari request
                $status = $request->status_logo_login;

                // Cek jika user pilih "active" tapi sudah ada data yang aktif
                if ($status === 'active' && \App\Models\LogoLogin::where('status_logo_login', 'active')->exists()) {
                    $status = 'non-active'; // override status jadi non-active
                }

                // Simpan ke database
                \App\Models\LogoLogin::create([
                    'judul_logo_login'   => $request->judul_logo_login,
                    'logo_login'         => $filename,
                    'status_logo_login'  => $status,
                ]);

                return redirect()->route('logo-login.index')->with('success', 'Logo login berhasil ditambahkan dengan status: ' . $status);
            } else {
                return back()->withErrors(['logo_login' => 'File logo tidak ditemukan.'])->withInput();
            }
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat menyimpan logo login.')->withInput();
        }
    }


    public function checkActive()
    {
        try {
            Log::info('Check active route accessed');
            $exists = \App\Models\LogoLogin::active()->exists();

            return response()->json([
                'success' => true,
                'exists' => $exists
            ]);
        } catch (\Exception $e) {
            Log::error('Check active failed: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal memeriksa status aktif.'
            ], 500);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(LogoLogin $logoLogin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $logoLogin = LogoLogin::findOrFail($id);
        return view('logo_login.edit', compact('logoLogin'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLogoLoginRequest $request, $id)
    {
        try {
            $logoLogin = \App\Models\LogoLogin::findOrFail($id);

            // Ambil data status dari request
            $status = $request->status_logo_login;

            // Kalau status yang dikirim adalah 'active', cek dulu apakah sudah ada data lain yang aktif
            if ($status === 'active' && \App\Models\LogoLogin::where('status_logo_login', 'active')->where('id', '!=', $id)->exists()) {
                $status = 'non-active'; // override status jadi non-active
            }

            // Jika user upload file baru, proses file-nya
            if ($request->hasFile('logo_login')) {
                $file = $request->file('logo_login');
                $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

                // Simpan file ke folder storage
                $file->storeAs('public/logo_login', $filename);

                // Hapus file lama (optional)
                if ($logoLogin->logo_login && Storage::exists('public/logo_login/' . $logoLogin->logo_login)) {
                    Storage::delete('public/logo_login/' . $logoLogin->logo_login);
                }

                // Update file baru
                $logoLogin->logo_login = $filename;
            }

            // Update data lainnya
            $logoLogin->judul_logo_login = $request->judul_logo_login;
            $logoLogin->status_logo_login = $status;
            $logoLogin->save();

            return redirect()->route('logo-login.index')->with('success', 'Logo login berhasil diperbarui dengan status: ' . $status);
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat memperbarui logo login.')->withInput();
        }
    }

    public function checkActiveEdit(Request $request)
    {
        try {
            $id = $request->input('id');

            $exists = \App\Models\LogoLogin::where('status_logo_login', 'active')
                ->where('id', '!=', $id)
                ->exists();

            return response()->json([
                'success' => true,
                'exists' => $exists
            ]);
        } catch (\Exception $e) {
            Log::error('Check active (edit) failed: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Gagal memeriksa status aktif.'
            ], 500);
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LogoLogin $logoLogin)
    {
        DB::beginTransaction();

        try {
            // Hapus file jika ada
            if ($logoLogin->logo_login && Storage::exists('public/logo_login/' . $logoLogin->logo_login)) {
                Storage::delete('public/logo_login/' . $logoLogin->logo_login);
            }

            // Hapus data dari database
            $logoLogin->delete();

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Logo login berhasil dihapus.'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Gagal menghapus logo login: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menghapus logo login.'
            ], 500);
        }
    }
}

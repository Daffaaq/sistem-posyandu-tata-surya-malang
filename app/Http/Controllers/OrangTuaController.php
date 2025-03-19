<?php

namespace App\Http\Controllers;

use App\Models\OrangTua;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class OrangTuaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:orang-tua.index')->only('index', 'list');
        $this->middleware('permission:orang-tua.create')->only('create', 'store');
        $this->middleware('permission:orang-tua.edit')->only('edit', 'update');
        $this->middleware('permission:orang-tua.destroy')->only('destroy');
    }

    public function list(Request $request)
    {
        if ($request->ajax()) {
            $orangTua = DB::table('orang_tuas')
                ->leftJoin('users', 'orang_tuas.user_id', '=', 'users.id')
                ->select('orang_tuas.id', 'orang_tuas.nama_ayah', 'orang_tuas.nama_ibu', 'users.is_active'); // Add is_active here
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
        if($orangTua->user->is_active == 'active'){
            //return json
            return response()->json([
                'success' => true,
                'message' => 'Account already active'
            ]);
        }
        $orangTua->user->update(['is_active' => 'active']);
        // return json
        return response()->json([
            'success' => true,
            'message' => 'Account accepted'
        ]);
    }

    public function rejectedOrangTua($id)
    {
        $orangTua = OrangTua::findOrFail($id);
        if($orangTua->user->is_active == 'non-active'){
            //return json
            return response()->json([
                'success' => true,
                'message' => 'Account already non-active'
            ]);
        }
        $orangTua->user->update(['is_active' => 'non-active']);
        // return json
        return response()->json([
            'success' => true,
            'message' => 'Account non-active'
        ]);
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

<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\JadwalPosyanduController;
use App\Http\Controllers\JenisKunjunganKeluargaBerencanaController;
use App\Http\Controllers\KategoriImunasasiController;
use App\Http\Controllers\KategoriKeluargaBerencanaController;
use App\Http\Controllers\KunjunganController;
use App\Http\Controllers\Menu\MenuGroupController;
use App\Http\Controllers\Menu\MenuItemController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\OrangTuaController;
use App\Http\Controllers\RoleAndPermission\AssignPermissionController;
use App\Http\Controllers\RoleAndPermission\AssignUserToRoleController;
use App\Http\Controllers\RoleAndPermission\PermissionController;
use App\Http\Controllers\RoleAndPermission\RoleController;
use App\Http\Controllers\TypeKunjunganController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/register-success', function () {
    return view('auth.register-success');
})->name('register.success')->middleware('guest');
Route::get('/account-inactive', function () {
    return view('auth.inactive');
})->name('account.inactive')->middleware('guest');


Route::group(['middleware' => ['auth', 'checkactive']], function () {
    Route::get('/dashboard', function () {
        return view('home');
    });

    Route::prefix('master-management')->group(function () {
        //tipe kunjungan
        Route::resource('tipe-kunjungan', TypeKunjunganController::class);
        Route::post('/tipe-kunjungan/list', [TypeKunjunganController::class, 'list'])->name('tipe-kunjungan.list');

        //jadwal-posyandu
        Route::resource('jadwal-posyandu', JadwalPosyanduController::class);
        Route::post('/jadwal-posyandu/list', [JadwalPosyanduController::class, 'list'])->name('jadwal-posyandu.list');

        //obat
        Route::resource('obat', ObatController::class);
        Route::post('/obat/list', [ObatController::class, 'list'])->name('obat.list');

        //kategori-kb
        Route::resource('kategori-kb', KategoriKeluargaBerencanaController::class);
        Route::post('/kategori-kb/list', [KategoriKeluargaBerencanaController::class, 'list'])->name('kategori-kb.list');

        //jenis-kunjungan-kb
        Route::resource('jenis-kunjungan-kb', JenisKunjunganKeluargaBerencanaController::class);
        Route::post('/jenis-kunjungan-kb/list', [JenisKunjunganKeluargaBerencanaController::class, 'list'])->name('jenis-kunjungan-kb.list');

        // kategori-imunisasi
        Route::resource('kategori-imunisasi', KategoriImunasasiController::class);
        Route::post('/kategori-imunisasi/list', [KategoriImunasasiController::class, 'list'])->name('kategori-imunisasi.list');
    });

    Route::prefix('posyandu-management')->group(function () {
        //kunjungan
        Route::resource('kunjungan', KunjunganController::class);
        Route::post('/kunjungan/list', [KunjunganController::class, 'list'])->name('kunjungan.list');
        Route::get('/kunjungan/{id}/pantauan-tumbuh-kembang-anak', [KunjunganController::class, 'showAnaliticsGrowthChildren'])->name('kunjungan.pantauan-tumbuh-kembang-anak');
        Route::put('/kunjungan/{id}/pantauan-tumbuh-kembang-anak', [KunjunganController::class, 'addGrowthChildren'])->name('kunjungan.pantauan-tumbuh-kembang-anak-store');

        Route::post('/kunjungan/{id}/list-pemantauan-tumbuh-kembang-anak', [KunjunganController::class, 'listPemantauanTumbuhKembangAnak'])->name('kunjungan.list-pemantauan-tumbuh-kembang-anak');
        Route::post('/kunjungan/{id}/list-data-obat-kunjungan', [KunjunganController::class, 'ListDataObatKunjungan'])->name('kunjungan.list-data-obat-kunjungan');
    });

    Route::prefix('user-management')->group(function () {
        Route::resource('user', UserController::class);
        Route::post('/user/list', [UserController::class, 'list'])->name('user.list');

        // orang-tua
        Route::resource('orang-tua', OrangTuaController::class);
        Route::post('/orang-tua/list', [OrangTuaController::class, 'list'])->name('orang-tua.list');
        Route::post('/orang-tua/accepted/{id}', [OrangTuaController::class, 'acceptedOrangTua'])->name('orang-tua.accepted');
        Route::post('/orang-tua/rejected/{id}', [OrangTuaController::class, 'rejectedOrangTua'])->name('orang-tua.rejected');
        Route::get('/orang-tua/view-form-add-children/{id}', [OrangTuaController::class, 'viewAddChildren'])->name('orang-tua.view-form-add-children');
        Route::put('/orang-tua/add-children/{id}', [OrangTuaController::class, 'addchildren'])->name('orang-tua.add-children');
        Route::post('/orang-tua/list-children/{id}', [OrangTuaController::class, 'listChildren'])->name('orang-tua.list-children');
        Route::get('/orang-tua/view-form-edit/children/{id}', [OrangTuaController::class, 'formEditAnak'])->name('orang-tua.view-form-edit-anak');
        Route::put('/orang-tua/children/edit/{id}', [OrangTuaController::class, 'updateAnak'])->name('orang-tua.edit-anak');
        Route::delete('/orang-tua/children/delete/{id}', [OrangTuaController::class, 'destroyAnak'])->name('orang-tua.delete-anak');
        Route::post('/orang-tua/update-status/{id}', [OrangTuaController::class, 'updateStatus'])->name('orang-tua.update-status');
    });
    Route::prefix('category-management')->group(function () {
        Route::resource('category', CategoryController::class);
    });

    Route::prefix('menu-management')->group(function () {
        Route::resource('menu-group', MenuGroupController::class);
        Route::post('/menu-group/list', [MenuGroupController::class, 'list'])->name('menu-group.list');

        Route::resource('menu-item', MenuItemController::class);
        Route::post('/menu-item/list', [MenuItemController::class, 'list'])->name('menu-item.list');
    });

    Route::group(['prefix' => 'role-and-permission'], function () {
        //role
        Route::resource('role', RoleController::class);
        Route::post('/role/list', [RoleController::class, 'list'])->name('role.list');

        //permission
        Route::resource('permission', PermissionController::class);
        Route::post('/permission/list', [PermissionController::class, 'list'])->name('permission.list');

        //assign permission
        Route::get('assign', [AssignPermissionController::class, 'index'])->name('assign.index');
        Route::get('assign/create', [AssignPermissionController::class, 'create'])->name('assign.create');
        Route::get('assign/{role}/edit', [AssignPermissionController::class, 'edit'])->name('assign.edit');
        Route::put('assign/{role}', [AssignPermissionController::class, 'update'])->name('assign.update');
        Route::post('assign', [AssignPermissionController::class, 'store'])->name('assign.store');
        Route::post('/assign/list', [AssignPermissionController::class, 'list'])->name('assign.list');

        //assign user to role
        Route::get('assign-user', [AssignUserToRoleController::class, 'index'])->name('assign.user.index');
        Route::get('assign-user/create', [AssignUserToRoleController::class, 'create'])->name('assign.user.create');
        Route::post('assign-user', [AssignUserToRoleController::class, 'store'])->name('assign.user.store');
        Route::get('assign-user/{user}/edit', [AssignUserToRoleController::class, 'edit'])->name('assign.user.edit');
        Route::put('assign-user/{user}', [AssignUserToRoleController::class, 'update'])->name('assign.user.update');
        Route::post('/assign-user/list', [AssignUserToRoleController::class, 'list'])->name('assign.user.list');
    });
});

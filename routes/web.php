<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ImunisasiController;
use App\Http\Controllers\JadwalKunjunganKBController;
use App\Http\Controllers\JadwalPosyanduController;
use App\Http\Controllers\JenisKunjunganKeluargaBerencanaController;
use App\Http\Controllers\KategoriImunasasiController;
use App\Http\Controllers\KategoriKeluargaBerencanaController;
use App\Http\Controllers\KeluargaBerencanaController;
use App\Http\Controllers\KunjunganController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\LogoLoginController;
use App\Http\Controllers\Menu\MenuGroupController;
use App\Http\Controllers\Menu\MenuItemController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\OrangTuaController;
use App\Http\Controllers\PemeriksaanOrangTuaController;
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


Route::get('/', [LandingPageController::class, 'index'])->name('landing-page');
Route::post('/landingPage-listObat', [LandingPageController::class, 'dataObat'])->name('list-obat-landingpage');

Route::get('/login', function () {
    return view('auth.login');
})->name('login');


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
        Route::post('/obat/list-kadaluarsa', [ObatController::class, 'list2'])->name('obat.list-kadaluarsa');
        Route::post('/obat/arsipkan-semua', [ObatController::class, 'arsipkanSemuaObatKadaluarsa'])->name('obat.arsipkan.semua');
        Route::post('/obat/arsipkan/{id}', [ObatController::class, 'arsipkanSatuObat'])->name('obat.arsipkan.satu');
        Route::post('/obat/list-arsip', [ObatController::class, 'listArsipObat'])->name('obat.list-arsip');
        Route::post('/obat/unarchive/{id}', [ObatController::class, 'unarchiveObat'])->name('obat.unarchive');



        //kategori-kb
        Route::resource('kategori-kb', KategoriKeluargaBerencanaController::class);
        Route::post('/kategori-kb/list', [KategoriKeluargaBerencanaController::class, 'list'])->name('kategori-kb.list');

        //jenis-kunjungan-kb
        Route::resource('jenis-kunjungan-kb', JenisKunjunganKeluargaBerencanaController::class);
        Route::post('/jenis-kunjungan-kb/list', [JenisKunjunganKeluargaBerencanaController::class, 'list'])->name('jenis-kunjungan-kb.list');

        // kategori-imunisasi
        Route::resource('kategori-imunisasi', KategoriImunasasiController::class);
        Route::post('/kategori-imunisasi/list', [KategoriImunasasiController::class, 'list'])->name('kategori-imunisasi.list');

        //logo-login
        Route::get('/logo-login/check-active', [LogoLoginController::class, 'checkActive'])->name('logo-login.check-active');
        Route::get('/logo-login/check-active-edit', [LogoLoginController::class, 'checkActiveEdit'])->name('logo-login.check-active.edit');
        Route::resource('logo-login', LogoLoginController::class);
        Route::post('/logo-login/list', [LogoLoginController::class, 'list'])->name('logo-login.list');
    });

    Route::prefix('posyandu-management')->group(function () {
        //kunjungan
        Route::resource('kunjungan', KunjunganController::class);
        Route::post('/kunjungan/list', [KunjunganController::class, 'list'])->name('kunjungan.list');
        Route::get('/kunjungan/{id}/pantauan-tumbuh-kembang-anak', [KunjunganController::class, 'showAnaliticsGrowthChildren'])->name('kunjungan.pantauan-tumbuh-kembang-anak');
        Route::put('/kunjungan/{id}/pantauan-tumbuh-kembang-anak', [KunjunganController::class, 'addGrowthChildren'])->name('kunjungan.pantauan-tumbuh-kembang-anak-store');
        Route::post('/kunjungan/{id}/list-pemantauan-tumbuh-kembang-anak', [KunjunganController::class, 'listPemantauanTumbuhKembangAnak'])->name('kunjungan.list-pemantauan-tumbuh-kembang-anak');
        Route::post('/kunjungan/{id}/list-data-obat-kunjungan', [KunjunganController::class, 'ListDataObatKunjungan'])->name('kunjungan.list-data-obat-kunjungan');
        Route::get('/kunjungan/{id}/edit-pantauan-tumbuh-kembang-anak', [KunjunganController::class, 'showFormEditPemantauanTumbuhKembang'])->name('kunjungan.form-edit-pantauan-tumbuh-kembang-anak');
        Route::put('/kunjungan/{id}/update-pantauan-tumbuh-kembang-anak', [KunjunganController::class, 'updatePemantauanTumbuhKembang'])->name('kunjungan.update-pantauan-tumbuh-kembang-anak');
        Route::delete('/kunjungan/{id}/delete-pantauan-tumbuh-kembang-anak', [KunjunganController::class, 'destroyPemantauanTumbuhKembang'])->name('kunjungan.delete-pantauan-tumbuh-kembang-anak');
        Route::get('/kunjungan/{id}/edit-obat-kunjungan', [KunjunganController::class, 'showFormEditObatKunjungan'])->name('kunjungan.form-edit-obat-kunjungan');
        Route::put('/kunjungan/{id}/update-obat-kunjungan', [KunjunganController::class, 'updateObatKunjungan'])->name('kunjungan.update-obat-kunjungan');
        Route::delete('/kunjungan/{id}/delete-obat-kunjungan', [KunjunganController::class, 'destroyObatKunjungan'])->name('kunjungan.delete-obat-kunjungan');
        Route::get('/kunjungan/{id}/pantauan-orang-tua', [PemeriksaanOrangTuaController::class, 'showAnaliticsParent'])->name('kunjungan.pantauan-orang-tua');
        Route::post('/kunjungan/{id}/list-pemantauan-ayah', function (Illuminate\Http\Request $request, $id) {
            return app(PemeriksaanOrangTuaController::class)->listAnalyticsParent($request, $id, 'ayah');
        })->name('kunjungan.list-pemantauan-ayah');
        Route::post('/kunjungan/{id}/list-pemantauan-ibu', function (Illuminate\Http\Request $request, $id) {
            return app(PemeriksaanOrangTuaController::class)->listAnalyticsParent($request, $id, 'ibu');
        })->name('kunjungan.list-pemantauan-ibu');
        Route::put('/kunjungan/{id}/store-pemantauan-orang-tua', [PemeriksaanOrangTuaController::class, 'storePemeriksaanOrangTua'])->name('kunjungan.store-pemantauan-orang-tua');
        Route::get('/kunjungan/{id}/show-data-pemeriksaan-ayah', [PemeriksaanOrangTuaController::class, 'showDataPemantauanAyah'])->name('kunjungan.show-data-pemeriksaan-ayah');
        Route::get('/kunjungan/{id}/show-data-pemeriksaan-ibu', [PemeriksaanOrangTuaController::class, 'showDataPemantauanIbu'])->name('kunjungan.show-data-pemeriksaan-ibu');
        Route::get('/kunjungan/{id}/edit-pemeriksaan-ayah', [PemeriksaanOrangTuaController::class, 'editDataPemeriksaanAyah'])->name('kunjungan.form-edit-pemeriksaan-ayah');
        Route::get('/kunjungan/{id}/edit-pemeriksaan-ibu', [PemeriksaanOrangTuaController::class, 'editDataPemeriksaanIbu'])->name('kunjungan.form-edit-pemeriksaan-ibu');
        Route::put('/kunjungan/{id}/update-pemeriksaan-ayah', [PemeriksaanOrangTuaController::class, 'updateDataPemeriksaanAyah'])->name('kunjungan.update-pemeriksaan-ayah');
        Route::put('/kunjungan/{id}/update-pemeriksaan-ibu', [PemeriksaanOrangTuaController::class, 'updateDataPemeriksaanIbu'])->name('kunjungan.update-pemeriksaan-ibu');

        Route::delete('/kunjungan/{id}/delete-pemeriksaan-ayah', [PemeriksaanOrangTuaController::class, 'deletePemeriksaanAyah'])
            ->name('kunjungan.delete-pemeriksaan-ayah');
        Route::delete('/kunjungan/{id}/delete-pemeriksaan-ibu', [PemeriksaanOrangTuaController::class, 'deletePemeriksaanIbu'])
            ->name('kunjungan.delete-pemeriksaan-ibu');

        Route::get('/kunjungan/{id}/imunisasi-anak', [ImunisasiController::class, 'indexImunisasi'])->name('kunjungan.imunisasi-anak');
        Route::post('/kunjungan/{id}/imunisasi-anak/list', [ImunisasiController::class, 'listImunisasi'])->name('list.imunisasi-anak');
        Route::post('/kunjungan/{id}/imunisasi-anak/list-obat', [ImunisasiController::class, 'listObatImunisasi'])->name('list.obat-imunisasi-anak');
        Route::post('/kunjungan/{id}/imunisasi-anak', [ImunisasiController::class, 'storeImunisasi'])->name('imunisasi.store');


        //keluarga-berencana
        Route::resource('keluarga-berencana', KeluargaBerencanaController::class);
        Route::post('/keluarga-berencana/list', [KeluargaBerencanaController::class, 'list'])->name('keluarga-berencana.list');
        Route::get('/keluarga-berencana/{id}/jadwal-kunjungan', [JadwalKunjunganKBController::class, 'index'])->name('keluarga-berencana.jadwal-kunjungan-kb.index');
        Route::post('/keluarga-berencana/{id}/jadwal-kunjungan/list', [JadwalKunjunganKBController::class, 'list'])->name('keluarga-berencana.jadwal-kunjungan-kb.list');
        Route::post('/keluarga-berencana/{id}/jadwal-kunjungan/store', [JadwalKunjunganKBController::class, 'store'])->name('keluarga-berencana.jadwal-kunjungan-kb.store');
        Route::get('/keluarga-berencana/{id}/jadwal-kunjungan-kb/edit', [JadwalKunjunganKBController::class, 'edit'])->name('keluarga-berencana.jadwal-kunjungan-kb.edit');
        Route::put('/keluarga-berencana/{id}/jadwal-kunjungan-kb/update', [JadwalKunjunganKBController::class, 'update'])->name('keluarga-berencana.jadwal-kunjungan-kb.update');
        Route::delete('/keluarga-berencana/{id}/jadwal-kunjungan/destroy', [JadwalKunjunganKBController::class, 'destroy'])->name('keluarga-berencana.jadwal-kunjungan-kb.destroy');
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

<?php

namespace Tests\Feature;

use App\Http\Controllers\KategoriImunasasiController;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\KategoriImunasasi;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class KategoriImunasasiTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->withoutMiddleware([
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Auth\Middleware\Authenticate::class
        ]);

        $this->user = User::factory()->create();
        Permission::create(['name' => 'kategori-imunisasi.create']);
        Permission::create(['name' => 'kategori-imunisasi.edit']);
        Permission::create(['name' => 'kategori-imunisasi.destroy']);
        Permission::create(['name' => 'kategori-imunisasi.index']);
        Permission::create(['name' => 'kategori-imunisasi.list']);

        $this->user->givePermissionTo([
            'kategori-imunisasi.index',
            'kategori-imunisasi.create',
            'kategori-imunisasi.edit',
            'kategori-imunisasi.destroy',
            'kategori-imunisasi.list',
        ]);
    }

    public function test_store_kategori_imunisasi()
    {
        $response = $this->actingAs($this->user)->post('/master-management/kategori-imunisasi', [
            'nama_kategori_imunisasi' => 'Baru',
            'keterangan' => 'Kategori baru',
            'is_active' => true,
            'slug' => 'baru'
        ]);

        $response->assertRedirect(route('kategori-imunisasi.index'));
        $this->assertDatabaseHas('kategori_imunasasis', [
            'nama_kategori_imunisasi' => 'Baru',
            'slug' => 'baru',
        ]);
    }

    public function test_update_kategori_imunisasi()
    {
        $kategori = KategoriImunasasi::create([
            'nama_kategori_imunisasi' => 'Awal',
            'keterangan' => 'Deskripsi awal',
            'is_active' => false,
            'slug' => 'awal'
        ]);

        $response = $this->actingAs($this->user)->put("/master-management/kategori-imunisasi/{$kategori->id}", [
            'nama_kategori_imunisasi' => 'Updated',
            'keterangan' => 'Sudah update',
            'is_active' => true,
            'slug' => 'updated'
        ]);

        $response->assertRedirect(route('kategori-imunisasi.index'));
        $this->assertDatabaseHas('kategori_imunasasis', [
            'nama_kategori_imunisasi' => 'Updated',
            'keterangan' => 'Sudah update',
        ]);
    }

    public function test_destroy_kategori_imunisasi()
    {
        $kategori = KategoriImunasasi::create([
            'nama_kategori_imunisasi' => 'Hapus',
            'keterangan' => 'Akan dihapus',
            'is_active' => true,
            'slug' => 'hapus'
        ]);

        $response = $this->actingAs($this->user)->delete("/master-management/kategori-imunisasi/{$kategori->id}");

        $response->assertStatus(200);
        $this->assertDatabaseMissing('kategori_imunasasis', [
            'id' => $kategori->id,
        ]);
    }

    public function test_list_kategori_imunisasi()
    {
        $this->actingAs($this->user);

        $kategori = KategoriImunasasi::create([
            'nama_kategori_imunisasi' => 'Imunisasi Dasar',
            'keterangan' => 'Kategori imunisasi dasar',
            'is_active' => true,
            'slug' => 'imunisasi-dasar',
        ]);

        $request = Request::create(
            '/master-management/kategori-imunisasi/list',
            'POST',
            [],
            [],
            [],
            ['HTTP_X-Requested-With' => 'XMLHttpRequest']
        );

        $controller = new KategoriImunasasiController();
        $response = $controller->list($request);

        $data = json_decode($response->getContent(), true);

        $this->assertArrayHasKey('data', $data);
        $this->assertCount(1, $data['data']);
        $this->assertEquals('Imunisasi Dasar', $data['data'][0]['nama_kategori_imunisasi']);
    }
}

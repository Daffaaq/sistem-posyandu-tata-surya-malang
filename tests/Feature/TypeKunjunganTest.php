<?php

namespace Tests\Feature;

use App\Http\Controllers\TypeKunjunganController;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\TypeKunjungan;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;

class TypeKunjunganTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Menonaktifkan middleware CSRF dan autentikasi untuk pengujian ini
        $this->withoutMiddleware([
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Auth\Middleware\Authenticate::class
        ]);

        // Setup user + permission
        $this->user = User::factory()->create();
        Permission::create(['name' => 'tipe-kunjungan.create']);
        Permission::create(['name' => 'tipe-kunjungan.edit']);
        Permission::create(['name' => 'tipe-kunjungan.destroy']);
        Permission::create(['name' => 'tipe-kunjungan.index']);
        Permission::create(['name' => 'tipe-kunjungan.list']);

        $this->user->givePermissionTo([
            'tipe-kunjungan.create',
            'tipe-kunjungan.edit',
            'tipe-kunjungan.destroy',
            'tipe-kunjungan.index',
            'tipe-kunjungan.list'
        ]);
    }

    public function test_store_tipe_kunjungan()
    {
        $response = $this->actingAs($this->user)->post('/master-management/tipe-kunjungan', [
            'nama_tipe_kunjungan' => 'Kunjungan Industri',
            'deskripsi' => 'Kunjungan ke pabrik industri'
        ]);

        $response->assertRedirect(route('tipe-kunjungan.index'));
        $this->assertDatabaseHas('type_kunjungans', [
            'nama_tipe_kunjungan' => 'Kunjungan Industri',
        ]);
    }

    public function test_update_tipe_kunjungan()
    {
        $tipe = TypeKunjungan::create([
            'nama_tipe_kunjungan' => 'Awal',
            'deskripsi' => 'Deskripsi awal'
        ]);

        $response = $this->actingAs($this->user)->put("/master-management/tipe-kunjungan/{$tipe->id}", [
            'nama_tipe_kunjungan' => 'Updated',
            'deskripsi' => 'Sudah diperbarui',
        ]);

        $response->assertRedirect(route('tipe-kunjungan.index'));
        $this->assertDatabaseHas('type_kunjungans', [
            'nama_tipe_kunjungan' => 'Updated',
        ]);
    }

    public function test_destroy_tipe_kunjungan()
    {
        $tipe = TypeKunjungan::create([
            'nama_tipe_kunjungan' => 'Hapus ini',
            'deskripsi' => 'Akan dihapus'
        ]);

        $response = $this->actingAs($this->user)->delete("/master-management/tipe-kunjungan/{$tipe->id}");

        $response->assertStatus(200);
        $this->assertDatabaseMissing('type_kunjungans', [
            'id' => $tipe->id,
        ]);
    }

    public function test_list_tipe_kunjungan()
    {
        // Membuat user untuk otentikasi
        $user = User::factory()->create();

        // Buat data tipe kunjungan
        $tipe = TypeKunjungan::create([
            'nama_tipe_kunjungan' => 'List ini',
            'deskripsi' => 'Akan dihapus'
        ]);

        // Buat instance request untuk meniru request AJAX
        $request = \Illuminate\Http\Request::create(
            '/master-management/tipe-kunjungan/list',
            'POST',
            [],
            [],
            [],
            ['HTTP_X-Requested-With' => 'XMLHttpRequest']
        );
        $request->setLaravelSession(session());

        // Panggil metode list() secara langsung, sama seperti controller
        $controller = new TypeKunjunganController();
        $response = $controller->list($request);

        // Konversi response ke array
        $data = json_decode($response->getContent(), true);

        // Verifikasi data yang dikembalikan
        $this->assertArrayHasKey('data', $data); // Pastikan ada 'data' di response JSON
        $this->assertCount(1, $data['data']); // Pastikan hanya ada 1 data (karena baru 1 data yang dimasukkan)
        $this->assertEquals('List ini', $data['data'][0]['nama_tipe_kunjungan']); // Verifikasi nama tipe kunjungan
        $this->assertEquals('Akan dihapus', $data['data'][0]['deskripsi']); // Verifikasi deskripsi
    }
}

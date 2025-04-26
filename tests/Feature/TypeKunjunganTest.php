<?php

namespace Tests\Feature;

use App\Http\Controllers\TypeKunjunganController;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\TypeKunjungan;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class TypeKunjunganTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->withoutMiddleware([
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Auth\Middleware\Authenticate::class
        ]);

        $this->user = User::factory()->create();

        $permissions = [
            'tipe-kunjungan.create',
            'tipe-kunjungan.edit',
            'tipe-kunjungan.destroy',
            'tipe-kunjungan.index',
            'tipe-kunjungan.list',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        $this->user->givePermissionTo($permissions);
    }

    private function createTipeKunjungan(array $data = [])
    {
        return TypeKunjungan::create(array_merge([
            'nama_tipe_kunjungan' => 'Default',
            'deskripsi' => 'Default deskripsi',
        ], $data));
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
        $tipe = $this->createTipeKunjungan([
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
        $tipe = $this->createTipeKunjungan([
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
        $this->actingAs($this->user);

        $this->createTipeKunjungan([
            'nama_tipe_kunjungan' => 'List ini',
            'deskripsi' => 'Akan dihapus'
        ]);

        $request = Request::create(
            '/master-management/tipe-kunjungan/list',
            'POST',
            [],
            [],
            [],
            ['HTTP_X-Requested-With' => 'XMLHttpRequest']
        );

        $controller = new TypeKunjunganController();
        $response = $controller->list($request);

        $data = json_decode($response->getContent(), true);

        $this->assertArrayHasKey('data', $data);
        $this->assertCount(1, $data['data']);
        $this->assertEquals('List ini', $data['data'][0]['nama_tipe_kunjungan']);
        $this->assertEquals('Akan dihapus', $data['data'][0]['deskripsi']);
    }
}

<?php

namespace Tests\Feature;

use App\Http\Controllers\ObatController;
use App\Models\ArsipObat;
use App\Models\Obat;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class ObatTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    protected function setUp(): void
    {
        parent::setUp();

        // Disable CSRF middleware and authentication middleware for the tests
        $this->withoutMiddleware([
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Auth\Middleware\Authenticate::class
        ]);

        // Create or get the super-admin role
        $role = Role::firstOrCreate(['name' => 'super-admin']);

        // Create the test user and assign the super-admin role
        $this->user = User::factory()->create();
        $this->user->assignRole($role);
        // Define the permissions you want to assign to the user
        $permissions = [
            'obat.create',
            'obat.edit',
            'obat.destroy',
            'obat.index',
            'obat.list',
        ];

        // Create the permissions if they don't already exist
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Assign the permissions to the user
        $this->user->givePermissionTo($permissions);
    }


    public function test_user_can_add_new_obat()
    {
        // Gunakan $this->user dari setUp() untuk memastikan tidak membuat user baru
        $this->actingAs($this->user);

        $data = [
            'nama_obat_vitamin' => 'Obat F',
            'deskripsi' => 'Deskripsi obat F',
            'tipe' => 'vitamin',
            'stok' => 200,
            'tanggal_kadaluarsa' => now()->addDays(10), // Obat yang belum kadaluarsa
        ];

        // Kirim POST request ke endpoint untuk tambah obat
        $response = $this->post('/master-management/obat', $data); // Endpoint untuk tambah obat

        // Memastikan redireksi ke halaman index setelah penyimpanan
        $response->assertRedirect(route('obat.index'));

        // Pastikan data obat telah disimpan di database
        $this->assertDatabaseHas('obats', [
            'nama_obat_vitamin' => 'Obat F',
            'deskripsi' => 'Deskripsi obat F',
            'tipe' => 'vitamin',
            'stok' => 200,
            'tanggal_kadaluarsa' => $data['tanggal_kadaluarsa']->format('Y-m-d'),
        ]);
    }

    public function test_list_obat_belum_kadaluarsa()
    {
        $this->actingAs($this->user);

        // Menambahkan beberapa obat
        Obat::create([
            'nama_obat_vitamin' => 'Obat F',
            'deskripsi' => 'Deskripsi obat F',
            'tipe' => 'vitamin',
            'stok' => 200,
            'tanggal_kadaluarsa' => now()->addDays(10),
        ]);

        // Membuat request ajax untuk memanggil endpoint list
        $request = Request::create(
            '/master-management/obat/list',
            'POST',
            [],
            [],
            [],
            ['HTTP_X-Requested-With' => 'XMLHttpRequest']
        );

        // Menginisialisasi controller dan memanggil metode list
        $controller = new ObatController();
        $response = $controller->list($request);

        $data = json_decode($response->getContent(), true);

        $this->assertArrayHasKey('data', $data); // Memastikan bahwa ada data
        $this->assertCount(1, $data['data']); // Memastikan hanya ada 1 data obat
        $this->assertEquals('Obat F', $data['data'][0]['nama_obat_vitamin']); // Memastikan nama obat yang tepat
        $this->assertEquals('vitamin', $data['data'][0]['tipe']); // Memastikan tipe obat yang tepat
    }

    public function test_list_obat_sudah_kadaluarsa()
    {
        $this->actingAs($this->user);

        // Menambahkan beberapa obat, satu yang sudah kadaluarsa
        Obat::create([
            'nama_obat_vitamin' => 'Obat A',
            'deskripsi' => 'Deskripsi obat A',
            'tipe' => 'vitamin',
            'stok' => 100,
            'tanggal_kadaluarsa' => now()->subDays(1), // Obat A sudah kadaluarsa
        ]);

        Obat::create([
            'nama_obat_vitamin' => 'Obat B',
            'deskripsi' => 'Deskripsi obat B',
            'tipe' => 'obat',
            'stok' => 150,
            'tanggal_kadaluarsa' => now()->subDays(5), // Obat B sudah kadaluarsa
        ]);

        Obat::create([
            'nama_obat_vitamin' => 'Obat C',
            'deskripsi' => 'Deskripsi obat C',
            'tipe' => 'obat',
            'stok' => 200,
            'tanggal_kadaluarsa' => now()->addDays(10), // Obat C belum kadaluarsa
        ]);

        // Membuat request ajax untuk memanggil endpoint list
        $request = Request::create(
            '/master-management/obat/list-kadaluarsa', // Memanggil route untuk obat yang sudah kadaluarsa
            'POST',
            [],
            [],
            [],
            ['HTTP_X-Requested-With' => 'XMLHttpRequest']
        );

        // Menginisialisasi controller dan memanggil metode list2
        $controller = new ObatController();
        $response = $controller->list2($request);

        $data = json_decode($response->getContent(), true);

        // Memastikan ada data yang dikembalikan
        $this->assertArrayHasKey('data', $data);
        $this->assertCount(2, $data['data']); // Hanya ada 2 obat yang kadaluarsa

        // Memastikan urutan berdasarkan nama obat
        $obatNames = array_column($data['data'], 'nama_obat_vitamin');
        $this->assertTrue(in_array('Obat A', $obatNames)); // Memastikan Obat A ada
        $this->assertTrue(in_array('Obat B', $obatNames)); // Memastikan Obat B ada
        $this->assertFalse(in_array('Obat C', $obatNames)); // Memastikan Obat C tidak ada
    }

    public function test_list_arsip_obat()
    {
        $this->actingAs($this->user); // Menyimulasikan user yang login

        // Menambahkan beberapa obat untuk arsip
        $obat1 = Obat::create([
            'nama_obat_vitamin' => 'Vitamin C',
            'deskripsi' => 'Deskripsi vitamin C',
            'tipe' => 'vitamin',
            'stok' => 100,
            'tanggal_kadaluarsa' => now()->addDays(10),
        ]);

        $obat2 = Obat::create([
            'nama_obat_vitamin' => 'Vitamin D',
            'deskripsi' => 'Deskripsi vitamin D',
            'tipe' => 'vitamin',
            'stok' => 150,
            'tanggal_kadaluarsa' => now()->addDays(5),
        ]);

        // Menambahkan arsip obat
        ArsipObat::create([
            'obat_id' => $obat1->id,
            'tanggal_arsip_obat' => now(),
            'user_id' => $this->user->id,
        ]);

        ArsipObat::create([
            'obat_id' => $obat2->id,
            'tanggal_arsip_obat' => now()->subDays(1),
            'user_id' => $this->user->id,
        ]);

        // Membuat request ajax untuk memanggil endpoint list-arsip
        $request = Request::create(
            'master-management/obat/list-arsip',
            'POST',
            [],
            [],
            [],
            ['HTTP_X-Requested-With' => 'XMLHttpRequest']
        );

        // Menginisialisasi controller dan memanggil metode listArsipObat
        $controller = new \App\Http\Controllers\ObatController();
        $response = $controller->listArsipObat($request);

        // Decode JSON response untuk memeriksa data
        $data = json_decode($response->getContent(), true);

        // Memastikan data arsip obat dikembalikan dengan benar
        $this->assertArrayHasKey('data', $data);
        $this->assertCount(2, $data['data']); // Harus ada dua arsip obat

        // Memastikan data obat pertama sesuai
        $this->assertEquals('Vitamin C', $data['data'][0]['nama_obat']);
        $this->assertEquals('vitamin', $data['data'][0]['tipe']);
        $this->assertEquals(100, $data['data'][0]['stok']);
        $this->assertEquals($obat1->tanggal_kadaluarsa->toDateString(), $data['data'][0]['tanggal_kadaluarsa']);
        $this->assertEquals(now()->toDateString(), $data['data'][0]['tanggal_arsip_obat']);

        // Memastikan data obat kedua sesuai
        $this->assertEquals('Vitamin D', $data['data'][1]['nama_obat']);
        $this->assertEquals('vitamin', $data['data'][1]['tipe']);
        $this->assertEquals(150, $data['data'][1]['stok']);
        $this->assertEquals($obat2->tanggal_kadaluarsa->toDateString(), $data['data'][1]['tanggal_kadaluarsa']);
        $this->assertEquals(now()->subDays(1)->toDateString(), $data['data'][1]['tanggal_arsip_obat']);
    }

    public function test_arsipkan_semua_obat_kadaluarsa()
    {
        $this->actingAs($this->user); // Menyimulasikan user yang login

        // Simulasikan obat kadaluarsa yang belum diarsipkan
        $obat1 = Obat::create([
            'nama_obat_vitamin' => 'Vitamin A',
            'deskripsi' => 'Deskripsi Vitamin A',
            'tipe' => 'vitamin',
            'stok' => 100,
            'tanggal_kadaluarsa' => now()->subDays(1), // Obat kadaluarsa
        ]);

        $obat2 = Obat::create([
            'nama_obat_vitamin' => 'Vitamin B',
            'deskripsi' => 'Deskripsi Vitamin B',
            'tipe' => 'vitamin',
            'stok' => 150,
            'tanggal_kadaluarsa' => now()->subDays(1), // Obat kadaluarsa
        ]);

        // Menyimulasikan arsip obat yang sudah ada
        ArsipObat::create([
            'obat_id' => $obat1->id,
            'tanggal_arsip_obat' => now()->subDays(2),
            'user_id' => $this->user->id
        ]);

        // Membuat request untuk arsipkan semua obat kadaluarsa
        $response = $this->postJson(route('obat.arsipkan.semua'));

        // Memastikan response berhasil
        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
            'message' => 'Semua Obat Kadaluarsa berhasil diarsipkan',
        ]);

        // Memastikan hanya satu obat yang diarsipkan (karena satu sudah diarsipkan sebelumnya)
        $this->assertDatabaseCount('arsip_obats', 2);
    }

    public function test_arsipkan_satu_obat()
    {
        $this->actingAs($this->user); // Menyimulasikan user yang login

        // Menyimulasikan obat yang sudah kadaluarsa
        $obat = Obat::create([
            'nama_obat_vitamin' => 'Vitamin C',
            'deskripsi' => 'Deskripsi Vitamin C',
            'tipe' => 'vitamin',
            'stok' => 100,
            'tanggal_kadaluarsa' => now()->subDays(1), // Obat kadaluarsa
        ]);

        // Membuat request untuk arsipkan satu obat
        $response = $this->postJson(route('obat.arsipkan.satu', ['id' => $obat->id]));

        // Memastikan response berhasil
        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
            'message' => 'Obat Kadaluarsa berhasil diarsipkan',
        ]);

        // Memastikan obat diarsipkan
        $this->assertDatabaseHas('arsip_obats', [
            'obat_id' => $obat->id,
        ]);
    }

    public function test_arsipkan_satu_obat_belum_kadaluarsa()
    {
        $this->actingAs($this->user); // Menyimulasikan user yang login

        // Menyimulasikan obat yang belum kadaluarsa
        $obat = Obat::create([
            'nama_obat_vitamin' => 'Vitamin D',
            'deskripsi' => 'Deskripsi Vitamin D',
            'tipe' => 'vitamin',
            'stok' => 100,
            'tanggal_kadaluarsa' => now()->addDays(5), // Obat belum kadaluarsa
        ]);

        // Membuat request untuk arsipkan obat yang belum kadaluarsa
        $response = $this->postJson(route('obat.arsipkan.satu', ['id' => $obat->id]));

        // Memastikan response dengan status warning
        $response->assertStatus(400);
        $response->assertJson([
            'status' => 'warning',
            'code' => 'not_expired',
            'message' => 'Obat belum kadaluarsa.',
        ]);

        // Memastikan obat belum diarsipkan
        $this->assertDatabaseMissing('arsip_obats', [
            'obat_id' => $obat->id,
        ]);
    }

    public function test_unarchive_obat()
    {
        $this->actingAs($this->user); // Simulate a logged-in user

        // Simulate a drug that has been archived
        $obat = Obat::create([
            'nama_obat_vitamin' => 'Vitamin E',
            'deskripsi' => 'Deskripsi Vitamin E',
            'tipe' => 'vitamin',
            'stok' => 100,
            'tanggal_kadaluarsa' => now()->subDays(2), // Drug expired
        ]);

        // Simulate archiving the drug
        $arsipObat = ArsipObat::create([
            'obat_id' => $obat->id,
            'tanggal_arsip_obat' => now()->subDays(3),
            'user_id' => $this->user->id
        ]);

        // Make the unarchive request
        $response = $this->postJson(route('obat.unarchive', ['id' => $arsipObat->id]));

        // Assert successful response with the correct message
        $response->assertStatus(200);

        // Check if the correct message is returned based on whether truncation occurs
        if (ArsipObat::count() <= 1) {
            $response->assertJson([
                'success' => true,
                'message' => 'Obat berhasil dipulihkan dan tabel arsip dikosongkan (truncate).',
            ]);
        } else {
            $response->assertJson([
                'success' => true,
                'message' => 'Obat berhasil dipulihkan dari arsip.',
            ]);
        }

        // Check that the drug has been removed from the archive
        $this->assertDatabaseMissing('arsip_obats', [
            'obat_id' => $obat->id,
        ]);
    }

    public function test_unarchive_obat_sisa_1()
    {
        $this->actingAs($this->user); // Simulasi user yang login

        // Simulasi obat yang sudah diarsipkan
        $obat = Obat::create([
            'nama_obat_vitamin' => 'Vitamin F',
            'deskripsi' => 'Deskripsi Vitamin F',
            'tipe' => 'vitamin',
            'stok' => 100,
            'tanggal_kadaluarsa' => now()->subDays(2), // Obat kadaluarsa
        ]);

        // Simulasi arsip obat
        $arsipObat = ArsipObat::create([
            'obat_id' => $obat->id,
            'tanggal_arsip_obat' => now()->subDays(3),
            'user_id' => $this->user->id
        ]);

        // Pastikan hanya ada 1 arsip obat
        $this->assertDatabaseCount('arsip_obats', 1); // Pastikan ada 1 arsip

        // Membuat request untuk unarchive obat
        $response = $this->postJson(route('obat.unarchive', ['id' => $arsipObat->id]));

        // Memastikan response berhasil dan arsip di-truncate
        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
            'message' => 'Obat berhasil dipulihkan dan tabel arsip dikosongkan (truncate).'
        ]);

        // Memastikan tabel arsip kosong setelah unarchive
        $this->assertDatabaseCount('arsip_obats', 0); // Pastikan arsip sudah kosong
    }
}

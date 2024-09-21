<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        \App\Models\Role::factory()->createMany([
            ['nama_role' => 'Pengelola'],
            ['nama_role' => 'Kasir'],
            ['nama_role' => 'Chef'],
            ['nama_role' => 'Pelanggan'],
        ]);

        \App\Models\User::factory()->create([
            'no_hp' => '081234567890',
            'username' => 'pengelola',
            'password' => bcrypt('asdasdasd'),
            'id_role' => 1,
            'status' => 'aktif',
        ]);

        \App\Models\User::factory(100)->create();

        \App\Models\KategoriMenu::factory()->createMany([
            // ['nama_kategori_menu' => 'Appetizers'],
            // ['nama_kategori_menu' => 'Main Courses'],
            // ['nama_kategori_menu' => 'Sides'],
            // ['nama_kategori_menu' => 'Desserts'],
            // ['nama_kategori_menu' => 'Beverages'],
            // ['nama_kategori_menu' => 'Snacks'],
            // ['nama_kategori_menu' => 'Speciality'],
            ['nama_kategori_menu' => 'Pembuka'],
            ['nama_kategori_menu' => 'Hidangan Utama'],
            ['nama_kategori_menu' => 'Sampingan'],
            ['nama_kategori_menu' => 'Makanan Penutup'],
            ['nama_kategori_menu' => 'Minuman'],
            ['nama_kategori_menu' => 'Camilan'],
            ['nama_kategori_menu' => 'Spesial'],
        ]);
    }
}

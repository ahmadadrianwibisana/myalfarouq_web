<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Admin;
use App\Models\AdminBesar;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Membuat data user
        User::create([
            'name' => 'adrian',
            'email' => 'adrian@gmail.com',
            'password' => bcrypt('123456789'),
            'no_telepon' => '08123456789',  // Sesuaikan nomor telepon
            'image' => 'default.jpg', // Nama file gambar default
        ]);

        // Membuat data admin
        Admin::create([
            'name' => 'adminkecil',
            'username' => 'adminkecil',
            'email' => 'adminkecil@gmail.com',
            'password' => bcrypt('123456789'),
            'no_wa' => '081275037017',  // Nomor WhatsApp admin
        ]);

        // Membuat data admin besar
        AdminBesar::create([
            'name' => 'adminbesar',
            'username' => 'adminbesar',
            'email' => 'adminbesar@gmail.com',
            'password' => bcrypt('123456789'),
        ]);
    }
}

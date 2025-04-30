<?php

namespace Database\Seeders;

use App\Models\Items;
use App\Models\MasterCustomer;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make('12345678')
        ]);

        MasterCustomer::create([
            'nomor_customer' => 'CUST-' . Str::random(5),
            'nama_customer'  => 'Siti Aminah',
            'jenis_kelamin'  => 'P',
            'tanggal_lahir'  => '1988-08-15',
            'no_hp'          => '089876543210',
            'email'          => 'siti@example.com',
            'alamat'         => 'Jl. Merdeka No. 25, Bandung',
            'nik'            => '3201987654321001',
            'status'         => false
        ]);

        Items::create([
            'code' => '100',
            'nama' => 'item satu',
            'kategori' => 'gas',
            'harga' => 200000,
            'stok' => 10,
            'satuan' => 'kaleng'
        ]);
    }
}

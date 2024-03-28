<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Buku;
use App\Models\Kategori;
use App\Models\Ulasan;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::insert([
            [
                'name'     => 'Admin',
                'slug'     => 'admin',
                'email'    => 'admin@gmail.com',
                'username' => 'admin',
                'password' => Hash::make('password'),
                'telepon'  => '098765432123',
                'alamat'   => 'Tajur',
                'role'     => 'admin',
                // 'status'   => 1,
            ], [
                'name'     => 'Pustakawan',
                'slug'     => 'pustakawan',
                'email'    => 'pustakawan@gmail.com',
                'username' => 'pustaKawan',
                'password' => Hash::make('password'),
                'telepon'  => '098765432123',
                'alamat'   => 'Tajur',
                'role'     => 'pustakawan',
                // 'status'   => 1,
            ], [
                'name'     => 'Nadalia Putri',
                'slug'     => 'nadalia',
                'email'    => 'nada@gmail.com',
                'username' => 'nada',
                'password' => Hash::make('password'),
                'telepon'  => '089513886227',
                'alamat'   => 'Tajur',
                'role'     => 'pembaca',
                // 'status'   => 1,
            ]
        ]);

        Kategori::insert([
            [
                'kategori' => 'Light Novel',
                // 'slug'     => 'light-novel',
            ], [
                'kategori' => 'Non Fiksi',
                // 'slug'     => 'non-fiksi',
            ]
        ]);

        Buku::insert([
            [
                'judul'        => 'Mariposa',
                'slug'         => 'mariposa',
                'penulis'      => 'Luluk HF',
                'penerbit'     => 'Gramedia',
                'tahun_terbit' => '2019',
                'deskripsi'    => 'Sebuah light novel misteri karya Luluk HF.',
                'stok'         => 3,
                'kategori_id'  => 1,
            ], [
                'judul'        => 'Mariposa: Zero',
                'slug'         => 'mariposa-zero',
                'penulis'      => 'Luluk HF',
                'penerbit'     => 'Gramedia',
                'tahun_terbit' => '2020',
                'deskripsi'    => 'Cerita prekuel light novel karya Luluk HF, Mariposa.',
                'stok'         => 3,
                'kategori_id'  => 1,
            ]
        ]);

        User::factory(5)->create();
        Kategori::factory(10)->create();
        Buku::factory(20)->create();
        Ulasan::factory(50)->create();
    }
}

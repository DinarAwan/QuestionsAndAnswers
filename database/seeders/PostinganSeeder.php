<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PostinganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('postingans')->insert([
            [
                'judul' => 'Apa itu Laravel?',
                'isi' => 'Laravel adalah framework PHP yang digunakan untuk mengembangkan aplikasi web dengan sintaks yang elegan dan ekspresif.',
                'user_id' => 1,
            ],
            [
                'judul' => 'Bagaimana cara menginstal Laravel?',
                'isi' => 'Anda dapat menginstal Laravel menggunakan Composer dengan perintah "composer create-project --prefer-dist laravel/laravel nama_proyek".',
                'user_id' => 2,
            ],
            [
                'judul' => 'Apa itu Eloquent ORM?',
                'isi' => 'Eloquent ORM adalah Object-Relational Mapping (ORM) yang disediakan oleh Laravel untuk memudahkan interaksi dengan database menggunakan model dan relasi.',
                'user_id' => 1,
            ],
        ]);
    }
}

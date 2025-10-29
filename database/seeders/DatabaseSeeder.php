<?php

namespace Database\Seeders;

use App\Models\Category;
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

        // Create admin with unimal.ac.id domain
        User::updateOrCreate(
            ['email' => 'admin@unimal.ac.id'],
            [
                'name' => 'Admin Universitas',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'role' => 'admin',
            ]
        );

        // Create user with unimal.ac.id domain
        User::updateOrCreate(
            ['email' => 'mahasiswa@unimal.ac.id'],
            [
                'name' => 'Mahasiswa Universitas',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'role' => 'user',
                'student_id' => '2190102014',
            ]
        );

        // Create or update categories
        $categories = [
            [
                'name' => 'Komputer dan Perangkat',
                'description' => 'Pelaporan masalah terkait komputer, laptop, dan perangkat lainnya',
            ],
            [
                'name' => 'Jaringan dan Internet',
                'description' => 'Pelaporan masalah terkait jaringan dan koneksi internet',
            ],
            [
                'name' => 'Perabotan dan Ruangan',
                'description' => 'Pelaporan masalah terkait perabotan dan kondisi ruangan',
            ],
            [
                'name' => 'Kelistrikan',
                'description' => 'Pelaporan masalah terkait listrik, stopkontak, dan peralatan listrik',
            ],
            [
                'name' => 'Bangunan',
                'description' => 'Pelaporan masalah terkait bangunan, pintu, jendela, dll',
            ],
            [
                'name' => 'Lainnya',
                'description' => 'Pelaporan masalah lainnya yang tidak masuk kategori',
            ],
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(
                ['name' => $category['name']],
                ['description' => $category['description']]
            );
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            [
                'name' => 'Classic Cut',
                'description' => 'Konsultasi gaya, cuci rambut, potong, dan styling akhir.',
            ],
            [
                'name' => 'Royal Shave',
                'description' => 'Cukur jenggot tradisional menggunakan handuk panas & razor.',
            ],
            [
                'name' => 'Gentle Care',
                'description' => 'Paket potong rambut lengkap dengan pijat bahu dan masker wajah.',
            ],
            [
                'name' => 'Beard Trim',
                'description' => 'Rapikan jenggot dan kumis dengan presisi alat khusus.',
            ],
            [
                'name' => 'Anti-Bacterial Wash',
                'description' => 'Cuci rambut deep-cleansing dengan produk anti bakteri dan pijat kulit kepala.',
            ],
            [
                'name' => 'Face Treatment',
                'description' => 'Perawatan wajah premium, scrub dan masker untuk kulit yang segar dan sehat.',
            ],
        ];

        foreach ($services as $service) {
            Service::firstOrCreate([
                'name' => $service['name'],
                'description' => $service['description'],
                'img' => '',
            ]);
        }
    }
}

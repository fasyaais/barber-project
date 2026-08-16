<?php

namespace Database\Seeders;

use App\Models\Job;
use App\Models\Merchant;
use App\Models\Position;
use Illuminate\Database\Seeder;

class JobSeeder extends Seeder
{
    public function run(): void
    {
        $jobs = [
            [
                'position' => 'Master Barber',
                'location' => 'Senopati',
                'type' => 'Full-time',
                'salary' => 'Rp 6 - 9 jt/bulan',
                'slot' => 2,
                'description' => 'Lead barber berpengalaman dengan standar presisi tinggi untuk melayani pelanggan premium.',
            ],
            [
                'position' => 'Barber Stylist',
                'location' => 'Kelapa Gading',
                'type' => 'Full-time',
                'salary' => 'Rp 4 - 6 jt/bulan',
                'slot' => 3,
                'description' => 'Ahli styling klasik hingga modern dengan fokus pada konsultasi gaya dan kepuasan pelanggan.',
            ],
            [
                'position' => 'Guest Relation',
                'location' => 'Dago',
                'type' => 'Part-time',
                'salary' => 'Rp 3 - 4.5 jt/bulan',
                'slot' => 1,
                'description' => 'Menyambut tamu, mengelola janji temu, dan memastikan pengalaman kunjungan yang berkesan.',
            ],
            [
                'position' => 'Shop Manager',
                'location' => 'Kemang',
                'type' => 'Full-time',
                'salary' => 'Rp 8 - 11 jt/bulan',
                'slot' => 1,
                'description' => 'Memimpin operasional gerai, tim, dan inventaris untuk menjaga standar layanan terbaik.',
            ],
            [
                'position' => 'Content Creator',
                'location' => 'Remote',
                'type' => 'Freelance',
                'salary' => 'Proyek / konten',
                'slot' => 2,
                'description' => 'Membuat konten visual untuk media sosial dan kampanye branding Tampan yang engaging.',
            ],
            [
                'position' => 'Receptionist',
                'location' => 'Ubud',
                'type' => 'Part-time',
                'salary' => 'Rp 3 - 4 jt/bulan',
                'slot' => 2,
                'description' => 'Mengelola jadwal, kasir, dan reservasi dengan keramahtamahan khas Tampan.',
            ],
        ];

        foreach ($jobs as $job) {
            $position = Position::where('name', $job['position'])->first();
            if (! $position) {
                continue;
            }

            $merchant = Merchant::where('name', 'like', '%' . $job['location'] . '%')->first()
                ?? Merchant::first();

            if (! $merchant) {
                continue;
            }

            Job::updateOrCreate(
                ['position_id' => $position->id],
                [
                    'merchant_id' => $merchant->id,
                    'description' => $job['description'],
                    'type' => $job['type'],
                    'salary' => $job['salary'],
                    'loc' => $job['location'],
                    'slot' => $job['slot'],
                    'status' => 'available',
                    'due_date' => now()->addMonths(3)->toDateString(),
                ]
            );
        }
    }
}
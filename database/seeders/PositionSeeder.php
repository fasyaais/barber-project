<?php

namespace Database\Seeders;

use App\Models\Position;
use Illuminate\Database\Seeder;

class PositionSeeder extends Seeder
{
    public function run(): void
    {
        $positions = [
            'Master Barber',
            'Barber Stylist',
            'Guest Relation',
            'Shop Manager',
            'Content Creator',
            'Receptionist',
        ];

        foreach ($positions as $name) {
            Position::firstOrCreate(['name' => $name]);
        }
    }
}
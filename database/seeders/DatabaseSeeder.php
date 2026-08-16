<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $hashed = bcrypt('admin');
        User::create([
            'fullname' => 'Admin Besar',
            'username' => 'admin',
            'no_whatsapp' => '0895332282555',
            'email' => fake()->safeEmail(),
            'password' => $hashed,
            'role' => 'admin',
        ]);

        $this->call([
            UserSeeder::class,
            MerchantSeeder::class,
            PositionSeeder::class,
            JobSeeder::class,
            ServiceSeeder::class,
        ]);
    }
}

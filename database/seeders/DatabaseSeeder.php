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

        // calling all the available seeders together
        $this->call([
            AdminSeeder::class,
            CountrySeeder::class,
            DivisonSeeder::class,
            DistrictSeeder::class,
            UpazilaSeeder::class,
            PostcodeSeeder::class,
            BiodataSeeder::class,
        ]);

        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@test.com',
        ]);
    }
}

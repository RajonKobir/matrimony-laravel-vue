<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('countries')->insert([
            'country_id' => 880,
            'country_phone_code' => 880,
            'country_name' => 'Bangladesh',
            'country_bn_name' => 'বাংলাদেশ',
            'country_short_name' => 'BD',
        ]);
    }
}

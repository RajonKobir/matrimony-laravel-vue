<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class PostcodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = File::get("database/data/bd-postcodes.json");
        $postcodes = json_decode($json);
        $postcodes = $postcodes->postcodes;

        foreach ( $postcodes as $postcode_key => $postcode_value ) {
            DB::table('postcodes')->insert([
                'division_id' => (int)$postcode_value->division_id,
                'district_id' => (int)$postcode_value->district_id,
                'upazila_name' => $postcode_value->upazila,
                'post_office_name' => $postcode_value->postOffice,
                'post_code' => $postcode_value->postCode,
            ]);
        }
    }
}

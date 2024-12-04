<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class DistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = File::get("database/data/bd-districts.json");
        $districts = json_decode($json);
        $districts = $districts->districts;

        foreach ( $districts as $district_key => $district_value ) {
            DB::table('districts')->insert([
                'division_id' => (int)$district_value->division_id,
                'district_id' => (int)$district_value->id,
                'district_name' => $district_value->name,
                'district_bn_name' => $district_value->bn_name,
                'district_lat' => (float)$district_value->lat,
                'district_long' => (float)$district_value->long,
            ]);
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class DivisonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $json = File::get("database/data/bd-divisions.json");
        $divisions = json_decode($json);
        $divisions = $divisions->divisions;

        foreach ( $divisions as $division_key => $division_value ) {
            DB::table('divisions')->insert([
                'division_id' => (int)$division_value->id,
                'division_name' => $division_value->name,
                'division_bn_name' => $division_value->bn_name,
                'division_lat' => (float)$division_value->lat,
                'division_long' => (float)$division_value->long,
            ]);
        }

    }
}

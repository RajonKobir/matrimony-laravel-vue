<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class UpazilaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = File::get("database/data/bd-upazilas.json");
        $upazilas = json_decode($json);
        $upazilas = $upazilas->upazilas;

        foreach ( $upazilas as $upazila_key => $upazila_value ) {
            DB::table('upazilas')->insert([
                'district_id' => (int)$upazila_value->district_id,
                'upazila_id' => (int)$upazila_value->id,
                'upazila_name' => $upazila_value->name,
                'upazila_bn_name' => $upazila_value->bn_name,
            ]);
        }
    }
}

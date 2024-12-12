<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('upazilas', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->unsignedSmallInteger('district_id')->nullable();
            $table->unsignedSmallInteger('upazila_id')->nullable()->unique();
            $table->string('upazila_name', 50);
            $table->string('upazila_bn_name', 50);
            $table->unsignedInteger('upazila_population')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('upazilas');
    }
};

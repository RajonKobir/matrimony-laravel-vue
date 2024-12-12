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
        Schema::create('postcodes', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->unsignedSmallInteger('division_id')->nullable();
            $table->unsignedSmallInteger('district_id')->nullable();
            $table->string('upazila_name', 50);
            $table->string('post_office_name', 50);
            $table->string('post_code', 50)->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('postcodes');
    }
};

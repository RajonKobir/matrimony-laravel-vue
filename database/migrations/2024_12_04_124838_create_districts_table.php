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
        Schema::create('districts', function (Blueprint $table) {
            $table->tinyIncrements('id');
            $table->unsignedSmallInteger('division_id')->nullable();
            $table->unsignedSmallInteger('district_id')->nullable()->unique();
            $table->string('district_name', 50)->unique();
            $table->string('district_bn_name', 50)->unique();
            $table->float('district_lat')->nullable();
            $table->float('district_long')->nullable();
            $table->unsignedInteger('district_population')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('districts');
    }
};

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
        Schema::create('countries', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->unsignedSmallInteger('region_id')->default(142);
            $table->unsignedSmallInteger('country_id')->nullable();
            $table->unsignedSmallInteger('country_phone_code');
            $table->string('country_name', 50);
            $table->string('country_bn_name', 50);
            $table->string('country_short_name', 3);
            $table->unsignedInteger('country_population')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('countries');
    }
};

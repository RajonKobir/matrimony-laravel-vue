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
        Schema::create('divisions', function (Blueprint $table) {
            $table->tinyIncrements('id');
            $table->unsignedSmallInteger('country_id')->default(880);
            $table->unsignedSmallInteger('division_id')->nullable();
            $table->string('division_name', 50);
            $table->string('division_bn_name', 50);
            $table->float('division_lat')->nullable();
            $table->float('division_long')->nullable();
            $table->unsignedInteger('division_population')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('divisions');
    }
};

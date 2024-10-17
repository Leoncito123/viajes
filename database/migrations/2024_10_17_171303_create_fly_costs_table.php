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
        Schema::create('fly_costs', function (Blueprint $table) {
            $table->id();
            $table->float('cost');
            $table->foreignId('id_fly')->constrained('flies');
            $table->foreignId('id_class')->constrained('classes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fly_costs');
    }
};

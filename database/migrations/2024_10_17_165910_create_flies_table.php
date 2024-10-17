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
        Schema::create('flies', function (Blueprint $table) {
            $table->id();
            $table->date('depature_date');
            $table->date('arrival_date')->nullable();
            $table->float('fly_number');
            $table->float('fly_duration');
            $table->foreignId('id_airplane')->constrained('airplanes');
            $table->foreignId('id_destinies')->constrained('destinies');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flies');
    }
};

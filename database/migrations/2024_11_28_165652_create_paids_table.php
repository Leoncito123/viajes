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
        Schema::create('paids', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_buy')->constrained('buys');
            $table->boolean('status')->default(1)->nullable();
            $table->float('cantidad');
            $table->string('buyer');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paids');
    }
};

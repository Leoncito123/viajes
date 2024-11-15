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
    Schema::create('reservations', function (Blueprint $table) {
      $table->id();
      $table->time('check_in');
      $table->time('check_out');
      $table->float('cant_kinds');
      $table->float('cant_adults');
      $table->float('cant_infants');
      $table->boolean('status_payment');
      $table->foreignId('id_user_reservation')->constrained('user_reservations');
      $table->foreignId('id_room')->constrained('rooms');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('reservations');
  }
};

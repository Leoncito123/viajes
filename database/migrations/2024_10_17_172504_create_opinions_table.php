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
    Schema::create('opinions', function (Blueprint $table) {
      $table->id();
      $table->string('name');
      $table->integer('stars');
      $table->longText('description');
      $table->foreignId('id_hotel')->constrained('hotels');
      $table->foreignId('id_user')->constrained('users');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('opinions');
  }
};

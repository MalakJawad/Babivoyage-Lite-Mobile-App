<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up(): void {
    Schema::create('bookings', function (Blueprint $table) {
      $table->id();
      $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
      $table->foreignId('flight_id')->constrained('flights')->cascadeOnDelete();
      $table->integer('adults')->default(1);
      $table->string('status')->default('confirmed');
      $table->timestamps();

      $table->foreign('flight_id')->references('id')->on('flights')->cascadeOnDelete();
    });
  }

  public function down(): void {
    Schema::dropIfExists('bookings');
  }
};
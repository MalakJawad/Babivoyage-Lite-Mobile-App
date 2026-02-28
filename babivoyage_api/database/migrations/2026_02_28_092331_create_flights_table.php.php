<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('flights', function (Blueprint $table) {
            $table->id();

            $table->string('airline');
            $table->string('flight_no')->nullable();

            $table->string('from_code', 8);
            $table->string('to_code', 8);

            $table->date('date');

            $table->string('depart_time');
            $table->string('arrive_time');

            $table->unsignedInteger('duration_min'); 
            $table->boolean('non_stop')->default(true);

            $table->decimal('price', 10, 2);
            $table->string('cabin')->default('Economy');
            $table->string('status')->default('On Time');

            $table->timestamps();

            $table->index(['from_code', 'to_code', 'date']);
            $table->foreign('from_code')->references('code')->on('airports')->cascadeOnDelete();
            $table->foreign('to_code')->references('code')->on('airports')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('flights');
    }
};
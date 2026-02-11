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
    Schema::create('bookings', function (Blueprint $table) {
        $table->id();

        $table->foreignId('client_id')->constrained('users')->cascadeOnDelete();
        $table->foreignId('provider_id')->constrained('users')->cascadeOnDelete();
        $table->foreignId('service_id')->constrained('services')->cascadeOnDelete();

        $table->dateTime('start_at');
        $table->dateTime('end_at');

        $table->string('status', 30)->default('pending_payment');
        // pending_payment|confirmed|completed|cancelled

        $table->dateTime('lock_expires_at')->nullable(); // bloqueo mientras paga
        $table->timestamps();

        $table->index(['provider_id', 'start_at']);
        $table->index(['client_id', 'start_at']);
        $table->index(['status']);
    });
}


    /**
     * Reverse the migrations.
     */
   public function down(): void
{
    Schema::dropIfExists('bookings');
}

};

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
    Schema::create('payments', function (Blueprint $table) {
        $table->id();
        $table->foreignId('booking_id')->unique()->constrained()->cascadeOnDelete();

        $table->unsignedInteger('amount_clp');
        $table->string('status', 30)->default('init'); // init|paid|failed
        $table->string('provider', 30)->default('mock'); // mock|webpay
        $table->string('provider_ref')->nullable(); // token o ref externa

        $table->timestamps();
    });
}



    /**
     * Reverse the migrations.
     */
  public function down(): void
{
    Schema::dropIfExists('payments');
}


};

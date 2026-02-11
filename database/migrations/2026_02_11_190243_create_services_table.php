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
    Schema::create('services', function (Blueprint $table) {
        $table->id();

        $table->foreignId('provider_id')->constrained('users')->cascadeOnDelete();

        $table->string('name');
        $table->unsignedInteger('duration_min'); // fijo
        $table->unsignedInteger('price_clp');    // CLP entero
        $table->boolean('active')->default(true);

        $table->timestamps();

        $table->index(['provider_id', 'active']);
    });
}


    /**
     * Reverse the migrations.
     */
   public function down(): void
{
    Schema::dropIfExists('services');
}

};

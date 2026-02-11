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
    Schema::create('availability_rules', function (Blueprint $table) {
        $table->id();
        $table->foreignId('provider_id')->constrained('users')->cascadeOnDelete();

        $table->unsignedTinyInteger('weekday'); // 1=Lun ... 7=Dom (ISO)
        $table->time('start_time');
        $table->time('end_time');

        $table->unsignedInteger('slot_step_min')->default(30); // 30 por defecto
        $table->unsignedInteger('buffer_min')->default(0);

        $table->boolean('active')->default(true);
        $table->timestamps();

        $table->index(['provider_id', 'weekday', 'active']);
    });
}


    /**
     * Reverse the migrations.
     */
   public function down(): void
{
    Schema::dropIfExists('availability_rules');
}

};

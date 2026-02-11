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
    Schema::table('bookings', function ($table) {
        $table->string('meeting_token', 80)->nullable()->after('meeting_id');
    });
}


    /**
     * Reverse the migrations.
     */
   public function down(): void
{
    Schema::table('bookings', function ($table) {
        $table->dropColumn('meeting_token');
    });
}

};

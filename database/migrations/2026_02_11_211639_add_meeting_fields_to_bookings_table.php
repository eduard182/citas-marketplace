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
        $table->string('meeting_provider', 30)->nullable()->after('status'); // mock|zoom|google_meet
        $table->string('meeting_join_url')->nullable()->after('meeting_provider');
        $table->string('meeting_host_url')->nullable()->after('meeting_join_url');
        $table->string('meeting_id')->nullable()->after('meeting_host_url');
    });
}


    /**
     * Reverse the migrations.
     */
   public function down(): void
{
    Schema::table('bookings', function ($table) {
        $table->dropColumn([
            'meeting_provider',
            'meeting_join_url',
            'meeting_host_url',
            'meeting_id',
        ]);
    });
}

};

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
    Schema::table(table: 'users', callback: function (Blueprint $table): void {
        $table->string('role', 20)->default('client')->index();   // client|provider|admin
        $table->string('status', 20)->default('active')->index(); // active|pending|approved|suspended
    });
}


    /**
     * Reverse the migrations.
     */
   public function down(): void
{
    Schema::table(table: 'users', callback: function (Blueprint $table): void {
        $table->dropIndex(['role']);
        $table->dropIndex(['status']);
        $table->dropColumn(['role', 'status']);
    });
}
};

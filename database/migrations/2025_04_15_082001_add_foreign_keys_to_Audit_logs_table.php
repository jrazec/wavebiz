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
        Schema::connection('admin_db')->table('Audit_logs', function (Blueprint $table) {
            $table->foreign(['fldUserID'], 'audit_logs_ibfk_1')->references(['fldID'])->on('Users')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('admin_db')->table('Audit_logs', function (Blueprint $table) {
            $table->dropForeign('audit_logs_ibfk_1');
        });
    }
};

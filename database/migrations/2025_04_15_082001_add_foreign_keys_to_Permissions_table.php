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
        Schema::connection('admin_db')->table('Permissions', function (Blueprint $table) {
            $table->foreign(['fldModuleID'], 'permissions_ibfk_1')->references(['fldID'])->on('Modules')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('admin_db')->table('Permissions', function (Blueprint $table) {
            $table->dropForeign('permissions_ibfk_1');
        });
    }
};

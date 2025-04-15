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
        Schema::connection('admin_db')->create('User_permissions', function (Blueprint $table) {
            $table->bigIncrements('fldID');
            $table->unsignedBigInteger('fldUserID')->nullable()->index('flduserid');
            $table->unsignedBigInteger('fldPermissionID')->nullable()->index('fldpermissionid');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('admin_db')->dropIfExists('User_permissions');
    }
};

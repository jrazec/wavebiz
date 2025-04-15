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
        Schema::connection('admin_db')->create('Audit_logs', function (Blueprint $table) {
            $table->bigIncrements('fldID');
            $table->unsignedBigInteger('fldUserID')->nullable()->index('flduserid');
            $table->string('fldAction')->nullable();
            $table->string('fldTableName')->nullable();
            $table->bigInteger('fldRecordID')->nullable();
            $table->string('fldOldValue')->nullable();
            $table->string('fldNewValue')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('admin_db')->dropIfExists('Audit_logs');
    }
};

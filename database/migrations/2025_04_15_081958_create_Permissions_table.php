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
        Schema::connection('admin_db')->create('Permissions', function (Blueprint $table) {
            $table->bigIncrements('fldID');
            $table->string('fldRoleName')->nullable();
            $table->unsignedBigInteger('fldModuleID')->nullable()->index('fldmoduleid');
            $table->boolean('fldCanView')->nullable()->default(false);
            $table->boolean('fldCanAdd')->nullable()->default(false);
            $table->boolean('fldCanEdit')->nullable()->default(false);
            $table->boolean('fldCanDelete')->nullable()->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('admin_db')->dropIfExists('Permissions');
    }
};

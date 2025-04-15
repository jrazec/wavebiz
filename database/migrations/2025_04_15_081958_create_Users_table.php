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
        Schema::connection('admin_db')->create('Users', function (Blueprint $table) {
            $table->bigIncrements('fldID');
            $table->string('fldUserName', 150)->unique('fldusername');
            $table->string('fldPassword');
            $table->string('fldEmail')->nullable()->unique('fldemail');
            $table->string('fldFirstName', 150)->nullable();
            $table->string('fldLastName', 150)->nullable();
            $table->boolean('fldIsActive')->nullable()->default(true);
            $table->dateTime('fldDateCreated')->nullable()->useCurrent();
            $table->dateTime('fldDateModified')->useCurrentOnUpdate()->nullable()->useCurrent();
            $table->unsignedBigInteger('fldCreatedBy')->nullable()->default(0);
            $table->unsignedBigInteger('fldModifiedBy')->nullable()->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('admin_db')->dropIfExists('Users');
    }
};

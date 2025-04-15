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
        Schema::connection('wb_db')->create('Categories', function (Blueprint $table) {
            $table->integer('fldID', true);
            $table->string('fldName', 300);
            $table->string('fldDescription', 250);
            $table->integer('fldSeqNo')->default(0);
            $table->string('fldImage', 400)->nullable();
            $table->dateTime('fldDateCreated')->useCurrent();
            $table->integer('fldCreatedBy')->default(0);
            $table->boolean('fldModified')->default(false);
            $table->dateTime('fldDateModified')->useCurrent();
            $table->integer('fldModifiedBy')->default(0);
            $table->boolean('fldIsDeleted')->default(false);
            $table->dateTime('fldDateDeleted')->useCurrent();
            $table->integer('fldDeletedBy')->default(0);
            $table->integer('subCategoryId')->nullable()->index('subcategoryid');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Categories');
    }
};

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
        Schema::connection('wb_db')->create('Products', function (Blueprint $table) {
            $table->bigInteger('fldID', true);
            $table->bigInteger('fldStoreID')->default(0);
            $table->integer('fldCategoryID')->default(0)->index('fk_productcategory');
            $table->string('fldName', 400)->nullable();
            $table->text('fldDescription')->nullable();
            $table->string('fldShortDescription', 400);
            $table->string('fldBrand', 300)->nullable();
            $table->string('fldFDARegistration', 300)->nullable();
            $table->dateTime('fldExpiryDate')->nullable();
            $table->string('fldMaterial', 400)->nullable();
            $table->integer('fldWeight')->nullable();
            $table->integer('fldWidth')->nullable();
            $table->integer('fldLength')->nullable();
            $table->integer('fldHeight');
            $table->string('fldDimension', 200)->nullable();
            $table->integer('fldCondition');
            $table->decimal('fldPrice', 8, 4)->default(0);
            $table->decimal('fldSpecialPrice', 8, 4)->default(0);
            $table->string('fldUnit', 300)->nullable();
            $table->string('fldWarranty', 300)->nullable();
            $table->string('fldWarrantyPolicy', 400)->nullable();
            $table->boolean('fldIsBattery')->default(false);
            $table->boolean('fldIsFlammable')->default(false);
            $table->boolean('fldIsLiquid')->default(false);
            $table->boolean('fldNone')->default(true);
            $table->boolean('fldIsPublished')->default(true);
            $table->string('fldVariation1', 100)->nullable();
            $table->string('fldVariation2', 100)->nullable();
            $table->boolean('fldIsCompanyOwned')->default(false);
            $table->boolean('fldIsSoldOut')->default(false);
            $table->boolean('fldIsVisible')->default(true);
            $table->dateTime('fldDateCreated')->useCurrent();
            $table->integer('fldCreatedBy')->default(0);
            $table->boolean('fldModified')->default(false);
            $table->dateTime('fldDateModified')->useCurrent();
            $table->integer('fldModifiedBy')->default(0);
            $table->boolean('fldIsDeleted')->default(false);
            $table->dateTime('fldDateDeleted')->useCurrent();
            $table->integer('fldDeletedBy')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Products');
    }
};

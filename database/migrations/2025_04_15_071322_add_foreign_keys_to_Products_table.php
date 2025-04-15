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
        Schema::connection('wb_db')->table('Products', function (Blueprint $table) {
            $table->foreign(['fldCategoryID'], 'FK_ProductCategory')->references(['fldID'])->on('Categories')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['fldCategoryID'], 'products_ibfk_1')->references(['fldID'])->on('Categories')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('Products', function (Blueprint $table) {
            $table->dropForeign('FK_ProductCategory');
            $table->dropForeign('products_ibfk_1');
        });
    }
};

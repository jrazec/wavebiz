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
        Schema::connection('wb_db')->table('Categories', function (Blueprint $table) {
            $table->foreign(['subCategoryId'], 'categories_ibfk_1')->references(['fldID'])->on('Categories')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('Categories', function (Blueprint $table) {
            $table->dropForeign('categories_ibfk_1');
        });
    }
};

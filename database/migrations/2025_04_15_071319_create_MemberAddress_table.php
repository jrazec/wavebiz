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
        Schema::connection('wb_db')->create('MemberAddress', function (Blueprint $table) {
            $table->bigInteger('fldID')->primary();
            $table->bigInteger('fldMemberID')->index('fldmemberid');
            $table->text('fldAddress')->nullable();
            $table->string('fldCountry', 100)->nullable();
            $table->string('fldRegion', 200)->nullable();
            $table->string('fldProvince', 200);
            $table->string('fldMunicipality', 200)->nullable();
            $table->string('fldBarangay', 200)->nullable();
            $table->string('fldState', 150)->nullable();
            $table->string('fldDistrict', 100)->nullable();
            $table->string('fldPostalcode', 50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('MemberAddress');
    }
};

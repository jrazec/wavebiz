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
        Schema::connection('wb_db')->create('Members', function (Blueprint $table) {
            $table->bigInteger('fldID', true);
            $table->string('fldUserID', 20);
            $table->string('fldUserName', 40)->unique('fldusername');
            $table->string('fldFirstName', 150)->nullable();
            $table->string('fldMiddleName', 150)->nullable();
            $table->string('fldLastName', 150)->nullable();
            $table->string('fldNickName', 100)->nullable();
            $table->string('fldPassword', 64)->default('');
            $table->date('fldBirthDate')->default('1900-01-01');
            $table->boolean('fldCivilStatus')->default(true);
            $table->boolean('fldGender')->default(true);
            $table->string('fldNationality', 150)->nullable();
            $table->decimal('fldOrderLimitPerMonth')->default(5000);
            $table->boolean('fldAgreeTerms')->default(true);
            $table->text('fldTermsAndCondition')->nullable();
            $table->boolean('fldUpdateNeeded')->default(true);
            $table->dateTime('fldDateCreated')->useCurrent();
            $table->integer('fldCreatedBy')->default(0);
            $table->dateTime('fldDateModified')->useCurrent();
            $table->integer('fldModifiedBy')->default(0);
            $table->boolean('fldIsDeleted')->default(false);
            $table->dateTime('fldDateDeleted')->nullable();
            $table->integer('fldDeletedBy')->nullable();
            $table->string('fldEmailAdd', 300)->nullable();
            $table->string('fldCellphone', 50)->nullable();
            $table->string('fldLandline', 50)->nullable();
            $table->text('fldBeneficiary')->nullable();
            $table->string('fldRelationship', 100)->nullable();
            $table->string('fldTIN', 50)->nullable();
            $table->integer('fldPackageID')->default(0);
            $table->boolean('fldStatus')->default(false);
            $table->bigInteger('fldSponsorID')->nullable()->default(0);
            $table->bigInteger('fldDirectSponsorID')->nullable()->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Members');
    }
};

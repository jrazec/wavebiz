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
        Schema::create('Users', function (Blueprint $table) {
            $table->bigIncrements("fldID");
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
        });
        
        Schema::create('Modules', function (Blueprint $table) {
            $table->bigIncrements("fldID");
            $table->enum('fldTableName', ['Products', 'Categories', 'Members','Audit_logs','User_permissions','Users','Member_address','Member_sponsors']);
        });

        Schema::create('Permissions', function (Blueprint $table) {
            $table->bigIncrements("fldID");
            $table->string("fldRoleName");
            $table->bigInteger('fldModuleID')->unsigned();
            $table->foreign('fldModuleID')->references('fldID')->on('Modules');
            $table->boolean('fldCanView')->default(0);
            $table->boolean('fldCanAdd')->default(0);
            $table->boolean('fldCanEdit')->default(0);
            $table->boolean('fldCanDelete')->default(0);
            $table->timestamps();
        });
                
        Schema::create('User_permissions', function (Blueprint $table) {
            $table->bigIncrements("fldID");
            $table->bigInteger('fldUserID')->unsigned();
            $table->bigInteger('fldPermissionID')->unsigned();
            $table->foreign('fldUserID')->references('fldID')->on('Users');
            $table->foreign('fldPermissionID')->references('fldID')->on('Permissions');
            $table->timestamps();
        });
        
        Schema::create('Audit_logs', function (Blueprint $table) {
            $table->bigIncrements("fldID");
            $table->bigInteger('fldUserID')->unsigned();
            $table->string('fldAction');
            $table->string('fldTableName');
            $table->bigInteger('fldRecordID');
            $table->string('fldOldValue');
            $table->string('fldNewValue');
            $table->timestamps();
        
            $table->foreign('fldUserID')->references('fldID')->on('Users');
        });
        
        Schema::create('Members', function (Blueprint $table) {
            $table->bigIncrements('fldID');
            $table->string('fldUserID', 20)->unique();
            $table->string('fldUserName', 40);
            $table->string('fldFirstName', 150)->nullable();
            $table->string('fldMiddleName', 150)->nullable();
            $table->string('fldLastName', 150)->nullable();
            $table->string('fldNickName', 100)->nullable();
            $table->string('fldPassword', 64)->default('');
            $table->date('fldBirthDate')->default('1900-01-01');
            $table->tinyInteger('fldCivilStatus')->default(1);
            $table->tinyInteger('fldGender')->default(1);
            $table->string('fldNationality', 150)->nullable();
            $table->decimal('fldOrderLimitPerMonth', 8, 2)->default(5000.00);
            $table->tinyInteger('fldAgreeTerms')->default(1);
            $table->text('fldTermsAndCondition')->nullable();
            $table->tinyInteger('fldUpdateNeeded')->default(1);
            $table->dateTime('fldDateCreated')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->integer('fldCreatedBy')->default(0);
            $table->dateTime('fldDateModified')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->integer('fldModifiedBy')->default(0);
            $table->tinyInteger('fldIsDeleted')->default(0);
            $table->dateTime('fldDateDeleted')->nullable();
            $table->integer('fldDeletedBy')->nullable();
            $table->string('fldEmailAdd', 300)->nullable();
            $table->string('fldCellphone', 50)->nullable();
            $table->string('fldLandline', 50)->nullable();
            $table->text('fldBeneficiary')->nullable();
            $table->string('fldRelationship', 100)->nullable();
            $table->string('fldTIN', 50)->nullable();
            $table->integer('fldPackageID')->default(0);
            $table->tinyInteger('fldStatus')->default(0);
        });
        
        Schema::create('Member_address', function (Blueprint $table) {
            $table->bigIncrements('fldID');
            $table->bigInteger('fldMemberID')->unsigned();
            $table->text('fldAddress')->nullable();
            $table->string('fldCountry', 100)->nullable();
            $table->string('fldRegion', 200)->nullable();
            $table->string('fldProvince', 200);
            $table->string('fldMunicipality', 200)->nullable();
            $table->string('fldBarangay', 200)->nullable();
            $table->string('fldState', 150)->nullable();
            $table->string('fldDistrict', 100)->nullable();
            $table->string('fldPostalcode', 50)->nullable();
            $table->foreign('fldMemberID')->references('fldID')->on('Members');
        });
        
        Schema::create('Member_sponsors', function (Blueprint $table) {
            $table->bigIncrements('fldID');
            $table->bigInteger('fldMemberID')->unsigned();
            $table->bigInteger('fldSponsorID')->unsigned()->default(0);
            $table->bigInteger('fldDirectSponsor')->unsigned()->default(0);
            $table->foreign('fldMemberID')->references('fldID')->on('Members');
            $table->foreign('fldSponsorID')->references('fldID')->on('Members');
            $table->foreign('fldDirectSponsor')->references('fldID')->on('Members');
        });
        
        Schema::create('Categories', function (Blueprint $table) {
            $table->bigIncrements('fldID');
            $table->string('fldName', 300);
            $table->string('fldDescription', 250);
            $table->integer('fldSeqNo')->default(0);
            $table->string('fldImage', 400)->nullable();
            $table->dateTime('fldDateCreated')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->integer('fldCreatedBy')->default(0);
            $table->tinyInteger('fldModified')->default(0);
            $table->dateTime('fldDateModified')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->integer('fldModifiedBy')->default(0);
            $table->tinyInteger('fldIsDeleted')->default(0);
            $table->dateTime('fldDateDeleted')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->integer('fldDeletedBy')->default(0);
            $table->integer('subCategoryId')->nullable();
            $table->foreign('subCategoryId')->references('fldID')->on('Categories');
        });
        
        Schema::create('Products', function (Blueprint $table) {
            $table->bigIncrements('fldID');
            $table->bigInteger('fldStoreID')->default(0);
            $table->bigInteger('fldCategoryID')->unsigned()->default(0);
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
            $table->integer('fldCondition');
            $table->decimal('fldPrice', 8, 4)->default(0.0000);
            $table->decimal('fldSpecialPrice', 8, 4)->default(0.0000);
            $table->string('fldUnit', 300)->nullable();
            $table->string('fldWarranty', 300)->nullable();
            $table->string('fldWarrantyPolicy', 400)->nullable();
            $table->foreign('fldCategoryID')->references('fldID')->on('Categories');
        });
        


        // Schema::create('password_reset_tokens', function (Blueprint $table) {
        //     $table->string('email')->primary();
        //     $table->string('token');
        //     $table->timestamp('created_at')->nullable();
        // });

        // Schema::create('sessions', function (Blueprint $table) {
        //     $table->string('id')->primary();
        //     $table->foreignId('user_id')->nullable()->index();
        //     $table->string('ip_address', 45)->nullable();
        //     $table->text('user_agent')->nullable();
        //     $table->longText('payload');
        //     $table->integer('last_activity')->index();
        // });
        // Schema::create('roles', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('name')->unique(); // Role name (Admin, Superadmin, Processor, etc.)
        //     $table->timestamps();
        // });
        
        // Schema::create('permissions', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('name')->unique(); // Permission name (read, write, delete, etc.)
        //     $table->timestamps();
        // });
        
        // Schema::create('role_user', function (Blueprint $table) {
        //     $table->id();
        //     $table->foreignId('user_id')->constrained()->onDelete('cascade'); 
        //     $table->foreignId('role_id')->constrained()->onDelete('cascade'); 
        //     $table->timestamps();
        // });
        
        // Schema::create('permission_role', function (Blueprint $table) {
        //     $table->id();
        //     $table->foreignId('role_id')->constrained()->onDelete('cascade');
        //     $table->foreignId('permission_id')->constrained()->onDelete('cascade');
        //     $table->timestamps();
        // });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('Products');
        Schema::dropIfExists('Categories');
        Schema::dropIfExists('Member_sponsors');
        Schema::dropIfExists('Member_address');
        Schema::dropIfExists('Members');
        Schema::dropIfExists('Audit_logs');
        Schema::dropIfExists('Modules');
        Schema::dropIfExists('Permissions');
        Schema::dropIfExists('User_permissions');
        Schema::dropIfExists('Users');
    }
};

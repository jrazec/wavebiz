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
        Schema::connection('wb_db')->table('MemberAddress', function (Blueprint $table) {
            $table->foreign(['fldMemberID'], 'memberaddress_ibfk_1')->references(['fldID'])->on('Members')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('MemberAddress', function (Blueprint $table) {
            $table->dropForeign('memberaddress_ibfk_1');
        });
    }
};

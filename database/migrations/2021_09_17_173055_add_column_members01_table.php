<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnMembers01Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('members', function (Blueprint $table) {
            $table->string('member_status',50)->nullable()->default('');
            $table->date('date_expiry')->nullable();
            $table->date('date_renew')->nullable();
            $table->string('member_group',50)->nullable()->default('');
            $table->string('member_active',50)->nullable()->default('');
            $table->integer('max_no')->nullable()->default('0');
            $table->integer('member_year')->nullable()->default('2021');
            $table->integer('member_month')->nullable()->default('1');
            $table->string('member_no',50)->nullable()->default('');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('members', function (Blueprint $table) {
            //
        });
    }
}

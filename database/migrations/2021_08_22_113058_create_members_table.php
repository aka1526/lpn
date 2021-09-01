<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->string('uid')->default('');
            $table->string('firs_tname',200)->default('');
            $table->string('last_name',200)->default('');
            $table->string('full_name',200)->default('');
            $table->string('gender',50)->default('');
            $table->date('dateofbirth')->nullable();
            $table->string('user_tel',50)->default('');
            $table->string('khan_uid',50)->default('');
            $table->integer('khan_no')->default('0');
            $table->string('khan_name',200)->default('');
            $table->string('certificate_no',50)->default('');
            $table->string('kru_uid',50)->default('');
            $table->string('under_kru',200)->default('');
            $table->string('club_name',200)->default('');
            $table->string('user_address',200)->default('');
            $table->string('country_code',50)->default('');
            $table->string('country_name',200)->default('');
            $table->string('user_facebook',50)->default('');
            $table->string('user_ig',50)->default('');
            $table->string('user_wechat',50)->default('');
            $table->string('img_profile',200)->default('');
            $table->string('img_user',200)->default('');
            $table->string('user_email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('user_type',50)->default('member');
            $table->string('password')->default('');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('members');
    }
}
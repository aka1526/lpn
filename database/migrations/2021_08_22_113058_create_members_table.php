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
            $table->string('first_name',200)->nullable()->default('');
            $table->string('last_name',200)->nullable()->default('');
            $table->string('full_name',200)->nullable()->default('');
            $table->string('gender',50)->nullable()->default('');
            $table->date('dateofbirth')->nullable();
            $table->string('user_tel',50)->nullable()->default('');
            $table->string('khan_uid',50)->nullable()->default('');
            $table->integer('khan_no')->nullable()->default('0');
            $table->string('khan_name',200)->nullable()->default('');
            $table->string('certificate_no',50)->nullable()->default('');
            $table->string('kru_uid',50)->nullable()->default('');
            $table->string('under_kru',200)->nullable()->default('');
            $table->string('club_name',200)->nullable()->default('');
            $table->string('user_address',200)->nullable()->default('');
            $table->string('country_code',50)->nullable()->default('');
            $table->string('country_name',200)->nullable()->default('');
            $table->string('user_facebook',50)->nullable()->default('');
            $table->string('user_ig',50)->nullable()->default('');
            $table->string('user_wechat',50)->nullable()->default('');
            $table->string('img_profile',200)->nullable()->default('');
            $table->string('img_user',200)->nullable()->default('');
            $table->string('user_email')->nullable()->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('user_type',50)->nullable()->default('member');
            $table->string('password')->nullable()->default('');
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
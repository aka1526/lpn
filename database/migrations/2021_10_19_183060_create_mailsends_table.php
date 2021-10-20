<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMailSendsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       
    Schema::create('mailsends', function (Blueprint $table) {
        $table->string('send_uid',50)->primary();
        $table->string('send_email',200)->nullable()->default('');
        $table->string('send_uid_subject',50)->nullable()->default('');
        $table->string('send_subject',200)->nullable()->default('');
        $table->string('send_type',50)->nullable()->default('');
        $table->string('send_status',50)->nullable()->default('');
        $table->string('created_by',200)->nullable()->default('');
        $table->string('updated_by',200)->nullable()->default('');
        $table->timestamp('created_at')->nullable();
        $table->timestamp('updated_at')->nullable();
    });
       
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mailsends');
    }
}

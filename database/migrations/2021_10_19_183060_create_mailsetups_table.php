<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMailsetupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       
    Schema::create('mailsetups', function (Blueprint $table) {
        $table->string('mail_uid',50)->nullable()->default('');
        $table->integer('mail_index')->default(0);
        $table->string('email_from',200)->nullable()->default('');
        $table->string('email_from_alia',200)->nullable()->default('');
        
        $table->string('email_address',200)->primary();
        $table->string('email_password',200)->nullable()->default('');
        $table->string('smtp_host',50)->nullable()->default('');
        $table->string('smtp_port',50)->nullable()->default('');
        $table->string('smtp_secure',50)->nullable()->default('');
        $table->string('smtp_auth',50)->nullable()->default('');
       
        $table->string('email_smtp',50)->nullable()->default('');
        $table->string('email_smtp_ssl',50)->nullable()->default('');
        $table->string('email_smtp_server',50)->nullable()->default('');
        $table->string('email_status',50)->nullable()->default('');
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
        Schema::dropIfExists('mailsetups');
    }
}

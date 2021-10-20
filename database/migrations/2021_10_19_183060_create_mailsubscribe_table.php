<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMailsubscribeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       
    Schema::create('mailsubscribe', function (Blueprint $table) {
        $table->string('email_uid',50)->primary();
        $table->string('email_subject',50)->nullable()->default('');
        $table->string('email_body',50)->nullable()->default('');
        $table->string('email_status',50)->nullable()->default('');
        $table->integer('email_total')->nullable()->default(0);
        $table->integer('email_send_total')->nullable()->default(0);
        $table->date('email_date_start')->nullable();
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
        Schema::dropIfExists('mailsubscribe');
    }
}

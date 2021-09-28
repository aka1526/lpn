<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCertificatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       
    Schema::create('certificates', function (Blueprint $table) {
        
        $table->string('cer_uid',50)->nullable()->default(0);
        $table->integer('cer_no')->primary();
        $table->integer('cer_maxno')->nullable()->default(0);
        $table->integer('cer_year')->nullable()->default(0);
        $table->integer('cer_month')->nullable()->default(0);
        $table->date('cer_date_issue')->nullable();
        $table->date('cer_date_exp')->nullable();
        $table->string('khan_uid',50)->nullable()->default('');
        $table->integer('khan_no')->nullable()->default(0);
        $table->string('khan_name',200)->nullable()->default('');
        $table->string('cer_member_uid',50)->nullable()->default('');
        $table->string('cer_member_no',50)->nullable()->default('');
        $table->string('cer_member_fullname',200)->nullable()->default('Y');
        $table->string('created_by',200)->nullable()->default('Y');
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
        Schema::dropIfExists('certificates');
    }
}

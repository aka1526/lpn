<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRankingslistTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()    {

 
       
    Schema::create('rankingslist', function (Blueprint $table) {
        $table->string('list_uid',50)->primary();
        $table->string('list_ref',50)->nullable()->default('');
        $table->integer('list_index')->nullable()->default(0);
        $table->string('contenders',200)->nullable()->default('');
        $table->string('contenders_type',50)->nullable()->default('');
        $table->string('contenders_gander',50)->nullable()->default('');
        $table->string('won_title',50)->nullable()->default('');
        $table->string('last_defense',50)->nullable()->default('');
        $table->string('contenders_img',50)->nullable()->default('');
        $table->string('created_by',200)->nullable();
        $table->string('updated_by',200)->nullable();
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
        Schema::dropIfExists('rankingslist');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       
    Schema::create('country', function (Blueprint $table) {
        
        $table->string('country_uid',50)->primary();
        $table->string('country_code',50)->nullable()->default('');
        $table->string('country_code3',50)->nullable()->default('');
        $table->string('country_name',200)->nullable()->default('');
        $table->string('country_flag',200)->nullable()->default('');
        $table->string('country_status',50)->nullable()->default('Y');
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
        Schema::dropIfExists('country');
    }
}

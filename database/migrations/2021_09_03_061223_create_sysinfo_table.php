<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSysinfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sys_info', function (Blueprint $table) {
            $table->string('sys_uid',50)->nullable()->default('');
            $table->string('sys_name',200)->primary();
            $table->string('sys_name_th',300)->nullable()->default('');
            $table->string('sys_address',300)->nullable()->default('');
            $table->string('sys_slogan',300)->nullable()->default('');
            
            $table->string('sys_email1',200)->nullable()->default('');
            $table->string('sys_email2',200)->nullable()->default('');
            $table->string('sys_phone1',200)->nullable()->default('');
            $table->string('sys_phone2',200)->nullable()->default('');
            
            $table->string('sys_openday',200)->nullable()->default('');
            $table->string('sys_openhour',200)->nullable()->default('');
            $table->string('sys_facebook',200)->nullable()->default('');
            $table->string('sys_twitter',200)->nullable()->default('');
            $table->string('sys_youtube',200)->nullable()->default('');
            $table->string('sys_intragram',200)->nullable()->default('');

            $table->string('sys_googlemap_lat',200)->nullable()->default('');
            $table->string('sys_googlemap_lon',200)->nullable()->default('');
            $table->string('sys_googlemap_zoom',200)->nullable()->default('');
            $table->string('sys_googlemap_info',200)->nullable()->default('');
            $table->string('sys_googlemap_marker',200)->nullable()->default('');
            
            
            $table->string('sys_status',50)->nullable()->default('Y');
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
        Schema::dropIfExists('sys_info');
    }
}

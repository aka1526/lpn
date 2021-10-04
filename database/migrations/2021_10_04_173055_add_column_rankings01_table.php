<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnRankings01Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rankings', function (Blueprint $table) {
            $table->string('world_img',50)->nullable()->default('');
            $table->string('international_img',50)->nullable()->default('');
           
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rankings', function (Blueprint $table) {
            //
        });
    }
}

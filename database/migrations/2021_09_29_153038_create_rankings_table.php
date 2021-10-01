<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRankingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()    {
       
    Schema::create('rankings', function (Blueprint $table) {
        $table->string('rank_uid',50)->primary();
        $table->integer('rank_index')->nullable()->default(0);
        $table->string('rank_gander',50)->nullable()->default('MALE');
        $table->string('rank_img',200)->nullable()->default('');
        $table->string('rankings_weight',200)->nullable()->default('');
        $table->string('rankings_weight_desc',200)->nullable()->default('Y');
        
        $table->string('world_vacant',200)->nullable()->default('');
        $table->string('world_won_title',200)->nullable()->default('');
        $table->string('world_last_defense',200)->nullable()->default('Y');

        $table->string('international_vacant',200)->nullable()->default('');
        $table->string('international_won_title',200)->nullable()->default('');
        $table->string('international_last_defense',200)->nullable()->default('');
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
        Schema::dropIfExists('rankings');
    }
}

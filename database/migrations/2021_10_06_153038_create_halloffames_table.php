<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHalloffamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()    {
       
    Schema::create('halloffames', function (Blueprint $table) {
        $table->string('hof_uid',50)->primary();
        $table->integer('hof_index')->nullable()->default(0);
        $table->string('hof_title',200)->nullable()->default('');
        $table->string('hof_date',50)->nullable()->default('');
        $table->string('hof_img',200)->nullable()->default('');
        $table->text('hof_content',60380)->nullable()->default('');
        $table->string('content_status',50)->nullable()->default('');
        $table->string('hof_slug',200)->nullable()->default('');
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
        Schema::dropIfExists('halloffames');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKhansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       
    Schema::create('khans', function (Blueprint $table) {
        $table->string('khan_uid',50)->primary();
        $table->integer('khan_index')->default(0);
        $table->string('khan_group',50)->nullable()->default('');
        $table->string('khan_name',200)->nullable()->default('');
        $table->string('khan_name_th',200)->nullable()->default('');
        $table->string('khan_desc',1000)->nullable()->default('');
        $table->string('khan_img',200)->nullable()->default('');
        $table->string('khan_status',50)->nullable()->default('Y');
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
        Schema::dropIfExists('khans');
    }
}

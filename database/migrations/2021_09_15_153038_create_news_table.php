<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       
    Schema::create('news', function (Blueprint $table) {
        $table->string('news_uid',50)->primary();
        $table->integer('news_index')->default(0);
        $table->string('news_group',200)->nullable()->default('');
        $table->string('news_toppic',300)->nullable()->default('');
        $table->string('news_desc',10000)->nullable()->default('');
        $table->string('news_url',200)->nullable()->default('');
        $table->string('news_img',200)->nullable()->default('');
        $table->string('news_status',50)->nullable()->default('Y');
        $table->timestamp('news_datetime')->nullable();
        $table->string('news_icon',100)->nullable();
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
        Schema::dropIfExists('news');
    }
}

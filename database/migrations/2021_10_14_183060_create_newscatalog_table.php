<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsCatalogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       
    Schema::create('news_catalog', function (Blueprint $table) {
        $table->string('catalog_uid',50)->nullable()->default('');
        $table->integer('catalog_index')->default(0);
        $table->string('catalog_name',200)->primary();
        $table->string('catalog_status',50)->nullable()->default('');
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
        Schema::dropIfExists('news_catalog');
    }
}

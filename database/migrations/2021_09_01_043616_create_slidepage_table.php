<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSlidepageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('slidepages', function (Blueprint $table) {
            $table->string('slidepages_uid',50)->primary();
            $table->integer('slidepages_index')->default(0);
            $table->string('slidepages_headline',200)->nullable()->default('');
            $table->string('slidepages_header',200)->nullable()->default('');
            $table->string('slidepages_detail',300)->nullable()->default('');
            $table->string('slidepages_link',200)->nullable()->default('');
            $table->string('slidepages_status',50)->nullable()->default('Y');
            $table->string('slidepages_img',50)->nullable()->default('Y');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('update_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('slidepage');
    }
}

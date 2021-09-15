<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAboutusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       
    Schema::create('aboutus', function (Blueprint $table) {
        $table->string('aboutus_uid',50)->primary();
        $table->integer('aboutus_index')->default(0);
        $table->string('aboutus_name',200)->nullable()->default('');
        $table->string('aboutus_header',200)->nullable()->default('');
        $table->string('aboutus_desc',10000)->nullable()->default('');
        $table->string('aboutus_url',100)->nullable()->default('');
        $table->string('aboutus_img',200)->nullable()->default('');
        $table->string('aboutus_status',50)->nullable()->default('Y');
        $table->string('aboutus_icon',100)->nullable();
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
        Schema::dropIfExists('aboutus');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePageheaderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pageheader', function (Blueprint $table) {
            $table->string('pageheader_uid',50)->nullable();
            $table->string('pageheader_type')->primary();
            $table->string('pageheader_title',200)->nullable()->default('');
            $table->string('pageheader_header',200)->nullable()->default('');
            $table->string('pageheader_detail',300)->nullable()->default('');
            $table->string('pageheader_status',50)->nullable()->default('Y');
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
        Schema::dropIfExists('pageheader');
    }
}

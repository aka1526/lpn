<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsgalleryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       
    Schema::create('newsgallery', function (Blueprint $table) {
        $table->string('gallery_uid',50)->primary();
        $table->string('gallery_uid_ref',50)->nullable()->default('');
        $table->string('gallery_filename',200)->nullable()->default('');
        $table->string('gallery_url',200)->nullable()->default('');
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
        Schema::dropIfExists('newsgallery');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseitemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses_item', function (Blueprint $table) {
            $table->string('course_item_uid',50)->primary();
            $table->integer('course_item_index')->default(0);
            $table->string('course_item_name',200)->nullable()->default('');
            $table->string('Course_details',2000)->nullable()->default('');
            $table->string('Course_vdo_link',200)->nullable()->default('');
            $table->string('course_item_status',50)->nullable()->default('Y');
            $table->string('courseref_uid',50)->nullable()->default('');
            $table->string('courseref_name',200)->nullable()->default('');
            $table->string('course_item_icon',200)->nullable();
            $table->string('course_item_img',200)->nullable()->default('');
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
        Schema::dropIfExists('courses_item');
    }
}

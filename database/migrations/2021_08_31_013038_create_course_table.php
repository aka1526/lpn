<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       
    Schema::create('courses', function (Blueprint $table) {
        $table->string('course_uid',50)->primary();
        $table->integer('course_index')->default(0);
        $table->string('course_name',200)->nullable()->default('');
        $table->string('course_th',200)->nullable()->default('');
        $table->string('course_description',200)->nullable()->default('');
        $table->string('course_link',100)->nullable()->default('');
        $table->integer('course_total')->nullable()->default(0);
        $table->string('course_status',50)->nullable()->default('Y');
        $table->string('course_icon',200)->nullable();
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
        Schema::dropIfExists('courses');
    }
}

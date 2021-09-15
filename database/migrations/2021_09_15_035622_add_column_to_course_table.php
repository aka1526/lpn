<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToCourseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->string('course_img',200)->nullable()->default('bn-bg1.jpg');
            $table->string('course_img2',200)->nullable()->default('bn-bg1.jpg');
            $table->string('course_img3',200)->nullable()->default('bn-bg1.jpg');
            //$table->string('course_item_header_img',200)->nullable()->default('/assets/img/course/bn-bg1.jpg');
           // $table->string('course_item_detail_img',200)->nullable()->default('/assets/img/course/cd-bg.jpg');
 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('courses', function (Blueprint $table) {
            //
        });
    }
}

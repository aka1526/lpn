<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToCourseitem2Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('courses_item', function (Blueprint $table) {
            $table->string('course_item_home_img',200)->nullable()->default('crs1.jpg');
            $table->string('course_item_header_img',200)->nullable()->default('bn-bg1.jpg');
            $table->string('course_item_detail_img',200)->nullable()->default('cd-bg.jpg');
 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('courseitem', function (Blueprint $table) {
            //
        });
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToCourseitemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('courses_item', function (Blueprint $table) {
            $table->integer('course_item_price')->nullable()->default(0);
            $table->integer('course_item_lessons')->nullable()->default(0);
            $table->integer('course_item_students')->nullable()->default(0);//Total มาเรียนแล้ว
            $table->integer('course_item_votes')->nullable()->default(0);
            $table->integer('course_item_duration')->nullable()->default(0);
            $table->string('course_item_certificate',50)->nullable()->default('N');
            
 
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

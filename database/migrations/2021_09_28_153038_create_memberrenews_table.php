<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMemberrenewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       
    Schema::create('memberrenews', function (Blueprint $table) {
        $table->string('renew_uid',50)->primary();
        $table->integer('renew_maxno')->nullable()->default(0);
        $table->string('renew_member_uid',50)->nullable()->default('');
        $table->string('renew_member_no',50)->nullable()->default('');
        $table->string('renew_member_fullname',200)->nullable()->default('Y');
        $table->float('renew_price')->nullable()->default(0);
        $table->string('khan_uid',50)->nullable()->default(0);
        $table->integer('khan_no')->nullable()->default(0);
        $table->string('khan_name',200)->nullable()->default('');
        $table->integer('renew_year')->nullable()->default(0);
        $table->integer('renew_month')->nullable()->default(0);
        $table->date('renew_date_issue')->nullable();
        $table->date('renew_date_exp')->nullable();
        
        $table->string('card_img',200)->nullable()->default('');
        $table->string('renew_status')->nullable()->default('Y');
        $table->string('created_by',200)->nullable();
        $table->string('updated_by',200)->nullable();
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
        Schema::dropIfExists('memberrenews');
    }
}

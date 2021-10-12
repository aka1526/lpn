<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewslettersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()    {
        
    Schema::create('newsletters', function (Blueprint $table) {
        $table->string('news_uid',50)->primary();
        $table->string('news_type',50)->nullable()->default('subscribe');// subscribe ,contact
        $table->string('news_title',50)->nullable()->default(''); 
        $table->string('news_email',200)->nullable()->default(''); 
        $table->string('news_name',200)->nullable()->default(''); 
        $table->string('news_phone',50)->nullable()->default(''); 
        $table->date('news_date')->nullable();
        $table->string('news_message',2000)->nullable()->default('');
        $table->string('news_message_reply',2000)->nullable()->default('');
        $table->string('news_ref_uid',50)->nullable()->default(''); 
        $table->string('news_by_ipaddress',50)->nullable()->default(''); 
        $table->string('news_by_os',200)->nullable()->default(''); 
        $table->string('news_member_id',50)->nullable()->default('');
        $table->string('news_status',50)->nullable()->default('Y');
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
        Schema::dropIfExists('newsletters');
    }
}

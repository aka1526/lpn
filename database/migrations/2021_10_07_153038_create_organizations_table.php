<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrganizationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()    {
        
    Schema::create('organizations', function (Blueprint $table) {
        $table->string('org_uid',50)->nullable()->default('');
        $table->string('org_type',50)->nullable()->default('');
        $table->string('org_name',200)->nullable()->primary();
        $table->string('org_name_th',200)->nullable()->default('');
        $table->string('org_name_teachers',200)->nullable()->default('');
        $table->string('org_country_code',50)->nullable()->default('');
        $table->string('org_country_uid',50)->nullable()->default('');
        $table->string('org_country_name',200)->nullable()->default('');
        $table->string('org_www',200)->nullable()->default('');
        $table->string('org_email',200)->nullable()->default('');
        $table->string('org_tel',200)->nullable()->default('');
        $table->string('org_address',200)->nullable()->default('');
        $table->string('org_facebook',200)->nullable()->default('');
        $table->string('org_youtube',200)->nullable()->default('');
        $table->string('org_instagram',200)->nullable()->default('');
        $table->string('org_wechat',200)->nullable()->default('');
        $table->text('org_profile',60000)->nullable()->default('');
        $table->date('org_date_register')->nullable();
        $table->string('org_location_lat')->nullable()->default('');
        $table->string('org_location_log')->nullable()->default('');
        $table->date('org_date_validate')->nullable();
        $table->date('org_date_exp')->nullable();
        $table->string('org_logo',50)->nullable();
        $table->string('org_card_id',50)->nullable();
        $table->string('org_card_img',50)->nullable();
        $table->string('org_certificate_no',50)->nullable();
        $table->string('org_certificate_img',50)->nullable();
        $table->string('org_status',50)->nullable()->default('');
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
        Schema::dropIfExists('organizations');
    }
}

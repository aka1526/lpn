<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminmenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_menus', function (Blueprint $table) {
            $table->string('menu_uid')->primary();
            $table->string('menu_name',200)->nullable();
            $table->string('menu_name_th',200)->nullable();
            $table->string('menu_url',100)->nullable();
            $table->string('menu_route',100)->nullable();
            $table->string('menu_icon',100)->nullable();
            $table->string('menu_class',100)->nullable();
            $table->integer('menu_index')->default(1);
            $table->string('menu_main',100)->nullable();
            $table->string('menu_main_name',200)->nullable();
            $table->string('menu_status',100)->nullable();
            $table->timestamp('created_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('adminmenus');
    }
}

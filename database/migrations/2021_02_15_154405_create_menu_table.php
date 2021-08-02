<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('su_menus', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug');
            $table->string('menu_name');
            $table->string('label');
            $table->string('route');
            $table->integer('icon');
            $table->integer('is_menu');
            $table->integer('is_dropdown');
            $table->integer('order');
            $table->timestamps();
            $table->string('ip_created');
            $table->string('ip_updated');
            $table->string('user_created');
            $table->string('user_updated');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menu');
    }
}

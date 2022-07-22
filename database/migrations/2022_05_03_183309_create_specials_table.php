<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('specials', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->on('users')->references('id');
            $table->tinyInteger('mehmani')->unsigned()->comment('0:2nafare,1:dorehami,2:tavalod,3:arosi');
            $table->bigInteger('tedad')->unsigned();
            $table->bigInteger('ash')->unsigned();
            $table->bigInteger('ghorme')->unsigned();
            $table->bigInteger('bastani')->unsigned();
            $table->bigInteger('ab')->unsigned();
            $table->bigInteger('kashk')->unsigned();
            $table->bigInteger('kabab')->unsigned();
            $table->bigInteger('jelle')->unsigned();
            $table->bigInteger('dough')->unsigned();
            $table->bigInteger('dolme')->unsigned();
            $table->bigInteger('gosht')->unsigned();
            $table->bigInteger('poding')->unsigned();
            $table->bigInteger('noshabeh')->unsigned();
            $table->bigInteger('mazeh')->unsigned();
            $table->bigInteger('koofteh')->unsigned();
            $table->bigInteger('shaik')->unsigned();
            $table->bigInteger('delester')->unsigned();
            $table->timestamps();
            $table->engine='innoDB';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('specials');
    }
};

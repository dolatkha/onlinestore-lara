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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name',255);
            $table->bigInteger('price')->unsigned();
            $table->string('loc',255)->nullable();
            $table->integer('count')->default(0)->unsigned();
            $table->tinyInteger('status')->default(1)->unsigned()->comment('1:faal,0:ghirefaal');
            $table->bigInteger('category_id')->unsigned();
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
        Schema::dropIfExists('products');
    }
};

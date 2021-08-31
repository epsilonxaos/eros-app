<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductoGaleriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('producto_galerias', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('img');
            $table->integer('order') -> default(0);
            $table->unsignedBigInteger('producto_id');

            $table->foreign('producto_id') -> references('id') -> on('productos') -> onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('producto_galerias');
    }
}

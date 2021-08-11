<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('cover');
            $table->string('nombre');
            $table->text('descripcion') -> nullable();
            $table->longText('descripcion_extra') -> nullable();
            $table->tinyInteger('status') -> default(1);
            $table->unsignedBigInteger('categorias_id');

            $table->foreign('categorias_id')
                ->references('id') -> on('establecimiento_categorias')
                ->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productos');
    }
}

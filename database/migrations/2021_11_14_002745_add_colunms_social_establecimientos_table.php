<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColunmsSocialEstablecimientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('establecimientos', function (Blueprint $table) {
            $table->string('facebook') -> nullable();
            $table->string('instagram') -> nullable();
            $table->string('twitter') -> nullable();
            $table->string('whatsapp') -> nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('establecimientos', function (Blueprint $table) {
            $table -> dropColumn('facebook');
            $table -> dropColumn('instagram');
            $table -> dropColumn('twitter');
            $table -> dropColumn('whatsapp');
        });
    }
}

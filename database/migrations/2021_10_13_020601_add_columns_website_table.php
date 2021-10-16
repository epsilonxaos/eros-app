<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsWebsiteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('website', function (Blueprint $table) {
            $table->string('banner_texto_1')->nullable();
            $table->string('banner_texto_2')->nullable();
            $table->string('banner_texto_3')->nullable();
            $table->string('hab_titulo')->nullable();
            $table->string('ser_titulo')->nullable();
            $table->string('con_titulo')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('website', function (Blueprint $table) {
            $table->dropColumn('banner_texto_1');
            $table->dropColumn('banner_texto_2');
            $table->dropColumn('banner_texto_3');
            $table->dropColumn('hab_titulo');
            $table->dropColumn('ser_titulo');
            $table->dropColumn('con_titulo');
        });
    }
}

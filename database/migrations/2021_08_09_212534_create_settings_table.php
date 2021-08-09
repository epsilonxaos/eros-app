<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('metaAuthor');
            $table->string('metaKeywords');
            $table->string('metaDescription');
            $table->string('metaOgTitle')->nullable();
            $table->string('metaOgUrl')->nullable();
            $table->string('metaOgDescription')->nullable();
            $table->string('archivoFavicon')->nullable();
            $table->string('archivoOgImagen')->nullable();
            $table->string('idAnalitics')->nullable();
            $table->string('sitemap')->nullable();
            $table->mediumText('code')->nullable();
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
        Schema::dropIfExists('settings');
    }
}

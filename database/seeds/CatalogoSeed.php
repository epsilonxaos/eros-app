<?php

use App\Website;
use Illuminate\Database\Seeder;

class CatalogoSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $add = new Website();
        $add -> catagoloPDF = 'catalogo.pdf';
        $add -> banner_texto_1 = 'Dejando nada a';
        $add -> banner_texto_2 = 'La imaginacion';
        $add -> banner_texto_3 = 'Consulta nuestro catalogo';
        $add -> hab_titulo = 'Habitaciones';
        $add -> ser_titulo = 'Servicios';
        $add -> con_titulo = 'Contacto';
        $add -> save();
    }
}

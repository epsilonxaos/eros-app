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
        $add -> save();
    }
}

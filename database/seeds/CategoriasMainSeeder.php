<?php

use App\EstablecimientoCategorias;
use Illuminate\Database\Seeder;

class CategoriasMainSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categorias = [
            [
                'nombre' => 'Habitaciones',
                'cover' => 'default.jpg',
            ],
            [
                'nombre' => 'Sexshop',
                'cover' => 'default.jpg',
            ]
        ];

        foreach ($categorias as $key => $value) {
            EstablecimientoCategorias::create($value);
        }
    }
}

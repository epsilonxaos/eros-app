<?php

namespace App\Http\Controllers;

use App\EstablecimientoCategorias;
use App\Productos;
use Illuminate\Http\Request;

class ProductosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all = Productos::orderBy('id', 'desc') -> get();

        return view('panel.productos.list', [
            'title' => 'Productos',
            'breadcrumb' => [
                [
                    'title' => 'Todos',
                    'route' => 'panel.eros.productos.index',
                    'active' => true
                ]
            ],
            'lista' => $all
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorias = EstablecimientoCategorias::where('status', 1) -> get();

        return view('panel.productos.create', [
            'title' => 'Productos',
            'breadcrumb' => [
                [
                    'title' => 'Todos',
                    'route' => 'panel.eros.productos.index',
                    'active' => false
                ],
                [
                    'title' => 'Nuevo',
                    'route' => 'panel.eros.productos.create',
                    'active' => true
                ]
            ],
            'categorias' => $categorias
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Productos  $productos
     * @return \Illuminate\Http\Response
     */
    public function show(Productos $productos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Productos  $productos
     * @return \Illuminate\Http\Response
     */
    public function edit(Productos $productos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Productos  $productos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Productos $productos)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Productos  $productos
     * @return \Illuminate\Http\Response
     */
    public function destroy(Productos $productos)
    {
        //
    }
}

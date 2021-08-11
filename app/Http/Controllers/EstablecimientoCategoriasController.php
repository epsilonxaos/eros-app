<?php

namespace App\Http\Controllers;

use App\EstablecimientoCategorias;
use App\Helpers;
use App\Http\Requests\StoreEstablecimientoCategorias;
use App\Http\Requests\UpdateEstablecimientoCategorias;
use Illuminate\Http\Request;

class EstablecimientoCategoriasController extends Controller
{
    protected $directorio = 'public/establecimiento/categorias';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all = EstablecimientoCategorias::orderBy('id', 'desc') -> get();

        return view('panel.categorias.index', [
            'title' => 'Categorias',
            'breadcrumb' => [
                [
                    'title' => 'Todos',
                    'route' => 'panel.eros.categorias.index',
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEstablecimientoCategorias $request)
    {
        $add = new EstablecimientoCategorias();
        $cover = Helpers::addFileStorage($request -> file('cover'), $this -> directorio);

        $add -> nombre = $request -> nombre;
        $add -> cover = $cover;
        $add -> save();

        return redirect() -> back() -> with('success', 'Categoria creada correctamente!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\EstablecimientoCategorias  $establecimientoCategorias
     * @return \Illuminate\Http\Response
     */
    public function show(EstablecimientoCategorias $establecimientoCategorias)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\EstablecimientoCategorias  $establecimientoCategorias
     * @return \Illuminate\Http\Response
     */
    public function edit(EstablecimientoCategorias $establecimientoCategorias)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EstablecimientoCategorias  $establecimientoCategorias
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEstablecimientoCategorias $request)
    {
        $upd = EstablecimientoCategorias::find($request -> id);

        if($request -> hasFile('cover')) {
            Helpers::deleteFileStorage('establecimiento_categorias', 'cover', $request -> id);
            $cover = Helpers::addFileStorage($request -> file('cover'), $this -> directorio);
            $upd -> cover = $cover;
            $upd -> save();
        }

        $upd -> nombre = $request -> nombre;
        $upd -> save();

        return redirect() -> back() -> with('success', 'Categoria actualizada correctamente!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EstablecimientoCategorias  $establecimientoCategorias
     * @return \Illuminate\Http\Response
     */
    public function destroy(Int $id)
    {
        Helpers::deleteFileStorage('establecimiento_categorias', 'cover', $id);
        $del = EstablecimientoCategorias::find($id);
        $del -> delete();

        return redirect() -> back() -> with('success', 'Categoria eliminada correctamente!');
    }

    /**
     * Change status to show - hidden
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function changeStatus(Request $request)
    {
        Helpers::changeStatus('establecimiento_categorias', $request -> id, $request -> status);
        return 'true';
    }
}

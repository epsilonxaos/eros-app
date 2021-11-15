<?php

namespace App\Http\Controllers;

use App\Establecimiento;
use App\Helpers;
use App\Http\Requests\StoreEstablecimiento;
use App\Http\Requests\UpdateEstablecimiento;
use Illuminate\Http\Request;

class EstablecimientoController extends Controller
{
    public $directorio = 'public/establecimiento';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all = Establecimiento::orderBy('id', 'desc') -> get();

        return view('panel.establecimientos.list', [
            'title' => 'Establecimientos',
            'breadcrumb' => [
                [
                    'title' => 'Todos',
                    'route' => 'panel.eros.establecimientos.index',
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
        return view('panel.establecimientos.create', [
            'title' => 'Establecimientos',
            'breadcrumb' => [
                [
                    'title' => 'Todos',
                    'route' => 'panel.eros.establecimientos.index',
                    'active' => false
                ],
                [
                    'title' => 'Nuevo establecimiento',
                    'route' => 'panel.eros.establecimientos.create',
                    'active' => true
                ]
            ]
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEstablecimiento $request)
    {
        $add = new Establecimiento();

        if($request -> hasFile('cover')) {
            $cover = Helpers::addFileStorage($request -> file('cover'), $this -> directorio);
        }

        $add -> nombre = $request -> nombre;
        $add -> cover = $cover;
        $add -> lat = $request -> lat;
        $add -> lng = $request -> lng;
        $add -> telefono = $request -> telefono;
        $add -> email = $request -> email;
        $add -> facebook = $request -> facebook;
        $add -> instagram = $request -> instagram;
        $add -> twitter = $request -> twitter;
        $add -> whatsapp = $request -> whatsapp;
        $add -> save();

        return redirect() -> back() -> with('success', 'Establecimiento creado correctamente!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Establecimiento  $establecimiento
     * @return \Illuminate\Http\Response
     */
    public function show(Establecimiento $establecimiento)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Establecimiento  $establecimiento
     * @return \Illuminate\Http\Response
     */
    public function edit(Int $id)
    {
        $data = Establecimiento::find($id);
        return view('panel.establecimientos.edit', [
            'title' => 'Establecimientos',
            'breadcrumb' => [
                [
                    'title' => 'Todos',
                    'route' => 'panel.eros.establecimientos.index',
                    'active' => false
                ],
                [
                    'title' => 'Editar establecimiento',
                    'route' => 'panel.eros.establecimientos.edit',
                    'params' => [
                        "id" => $id
                    ],
                    'active' => true
                ]
            ],
            'data' => $data
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Establecimiento  $establecimiento
     * @return \Illuminate\Http\Response
     */
    public function update(Int $id, UpdateEstablecimiento $request)
    {
        $upd = Establecimiento::find($id);
        if($request -> hasFile('cover')) {
            Helpers::deleteFileStorage('establecimientos', 'cover', $id);
            $cover = Helpers::addFileStorage($request -> file('cover'), $this -> directorio);
            $upd -> cover = $cover;
            $upd -> save();
        }

        $upd -> nombre = $request -> nombre;
        $upd -> lat = $request -> lat;
        $upd -> lng = $request -> lng;
        $upd -> telefono = $request -> telefono;
        $upd -> email = $request -> email;
        $upd -> facebook = $request -> facebook;
        $upd -> instagram = $request -> instagram;
        $upd -> twitter = $request -> twitter;
        $upd -> whatsapp = $request -> whatsapp;
        $upd -> save();

        return redirect() -> back() -> with('success', 'Establecimiento actualizado correctamente!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Establecimiento  $establecimiento
     * @return \Illuminate\Http\Response
     */
    public function destroy(Int $id)
    {
        Helpers::deleteFileStorage('establecimientos', 'cover', $id);
        $del = Establecimiento::find($id);
        $del -> delete();

        return redirect() -> back() -> with('success', 'Establecimiento eliminado correctamente!');
    }

    /**
     * Change status to show - hidden
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function changeStatus(Request $request)
    {
        Helpers::changeStatus('establecimientos', $request -> id, $request -> status);
        return 'true';
    }
}

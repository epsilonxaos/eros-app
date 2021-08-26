<?php

namespace App\Http\Controllers;

use App\Amenidades;
use App\Helpers;
use App\Http\Requests\StoreAmenidades;
use App\Http\Requests\UpdateAmenidades;
use Illuminate\Http\Request;

class AmenidadesController extends Controller
{
    protected $directorio = 'public/amendiades';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all = Amenidades::orderBy('id', 'desc') -> get();

        return view('panel.amenidades.index', [
            'title' => 'Amenidades',
            'breadcrumb' => [
                [
                    'title' => 'Todos',
                    'route' => 'panel.eros.amenidades.index',
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
    public function store(StoreAmenidades $request)
    {
        $add = new Amenidades();
        $cover = Helpers::addFileStorage($request -> file('img'), $this -> directorio);

        $add -> titulo = $request -> titulo;
        $add -> img = $cover;
        $add -> save();

        return redirect() -> back() -> with('success', 'Amenidad creada correctamente!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Amenidades  $amenidades
     * @return \Illuminate\Http\Response
     */
    public function show(Amenidades $amenidades)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Amenidades  $amenidades
     * @return \Illuminate\Http\Response
     */
    public function edit(Amenidades $amenidades)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Amenidades  $amenidades
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAmenidades $request)
    {
        $upd = Amenidades::find($request -> id);

        if($request -> hasFile('img')) {
            Helpers::deleteFileStorage('amenidades', 'img', $request -> id);
            $cover = Helpers::addFileStorage($request -> file('img'), $this -> directorio);
            $upd -> img = $cover;
            $upd -> save();
        }

        $upd -> titulo = $request -> titulo;
        $upd -> save();

        return redirect() -> back() -> with('success', 'Amenidad actualizada correctamente!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Amenidades  $amenidades
     * @return \Illuminate\Http\Response
     */
    public function destroy(Int $id)
    {
        Helpers::deleteFileStorage('amenidades', 'img', $id);
        $del = Amenidades::find($id);
        $del -> delete();

        return redirect() -> back() -> with('success', 'Amenidad eliminada correctamente!');
    }

    /**
     * Change status to show - hidden
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function changeStatus(Request $request)
    {
        Helpers::changeStatus('amenidades', $request -> id, $request -> status);
        return 'true';
    }
}

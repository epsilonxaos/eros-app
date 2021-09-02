<?php

namespace App\Http\Controllers;

use App\Faqs;
use Illuminate\Http\Request;

class FaqsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('panel.faqs.index', [
            'title' => 'Preguntas frecuentes',
            'breadcrumb' => [
                [
                    'title' => 'Todos',
                    'route' => 'panel.faqs.index',
                    'active' => true
                ]
            ],
            'lista' => Faqs::all()
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
    public function store(Request $request)
    {
        $add = new Faqs();
        $add -> titulo = $request -> titulo;
        $add -> informacion = $request -> informacion;
        $add -> save();

        return redirect() -> back() -> with('success', 'Registro creado correctamente!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Faqs  $faqs
     * @return \Illuminate\Http\Response
     */
    public function show(Faqs $faqs)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Faqs  $faqs
     * @return \Illuminate\Http\Response
     */
    public function edit(Faqs $faqs)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Faqs  $faqs
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $add = Faqs::find($request -> id);
        $add -> titulo = $request -> titulo;
        $add -> informacion = $request -> informacion;
        $add -> save();

        return redirect() -> back() -> with('success', 'Registro editado correctamente!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Faqs  $faqs
     * @return \Illuminate\Http\Response
     */
    public function destroy(Int $id)
    {
        Faqs::where('id', $id) -> delete();
        return redirect() -> back() -> with('success', 'Registro eliminado correctamente!');
    }
}

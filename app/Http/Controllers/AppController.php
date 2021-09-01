<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AppController extends Controller
{
    public function home()
    {
        return view('web.home');
    }

    public function contacto()
    {
        return view('web.contacto');
    }

    public function catalogo()
    {
        return view('web.catalogo');
    }

    public function catalogo_detalle()
    {
        return view('web.catalogo-detalle');
    }

    public function faqs ()
    {
        return view('web.faqs');
    }

    public function politicas ()
    {
        return view('web.politicas');
    }

    public function terminos ()
    {
        return view('web.terminos');
    }
}

<?php

namespace App\Http\Controllers;

use App\Helpers;
use App\Website;
use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    protected $directorio = "public/website";
    public function catalogoPdf (Int $id)
    {
        return view('panel.catalogoPdf.edit', [
            'title' => 'Website - Textos',
            'breadcrumb' => [
                [
                    'title' => 'Website',
                    'route' => 'panel.website.catalogo',
                    'active' => true,
                    'params' => [
                        "id" => $id
                    ],
                ],
            ],
            'data' => Website::find($id)
        ]);
    }

    public function catalogoPdfUpdate(Int$id, Request $request)
    {
        $udp = Website::find($id);
        if($request -> hasFile('pdf')) {
            $pdf = Helpers::addFileStorage($request -> file('pdf'), $this -> directorio);
            Helpers::deleteFileStorage('website', 'catagoloPDF', $id);
            $udp -> catagoloPDF = $pdf;
            $udp -> save();
        }

        $udp -> banner_texto_1 = $request -> banner_texto_1;
        $udp -> banner_texto_2 = $request -> banner_texto_2;
        $udp -> banner_texto_3 = $request -> banner_texto_3;
        $udp -> hab_titulo = $request -> hab_titulo;
        $udp -> ser_titulo = $request -> ser_titulo;
        $udp -> con_titulo = $request -> con_titulo;
        $udp -> save();

        return redirect() -> back() -> with('success', 'Website actualizado correctamente!');
    }
}

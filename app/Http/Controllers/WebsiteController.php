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
            'title' => 'Catalogo PDF',
            'breadcrumb' => [
                [
                    'title' => 'Catalogo PDF',
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
        $pdf = Helpers::addFileStorage($request -> file('pdf'), $this -> directorio);
        $udp = Website::find($id);
        Helpers::deleteFileStorage('website', 'catagoloPDF', $id);
        $udp -> catagoloPDF = $pdf;
        $udp -> save();

        return redirect() -> back() -> with('success', 'Catalogo actualizado correctamente!');
    }
}

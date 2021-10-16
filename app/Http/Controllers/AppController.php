<?php

namespace App\Http\Controllers;

use App\Amenidades;
use App\Establecimiento;
use App\EstablecimientoCategorias;
use App\Faqs;
use App\ProductoGaleria;
use App\Productos;
use App\Website;
use Illuminate\Http\Request;

class AppController extends Controller
{
    public function home()
    {
        $info['website'] = Website::find(1);
        $info['establecimientos'] = Establecimiento::where('status', 1) -> get();
        $info['categorias'] = EstablecimientoCategorias::where('status', 1) -> get();

        return view('web.home', compact('info'));
    }

    public function contacto()
    {
        $info['establecimientos'] = Establecimiento::where('status', 1) -> get();
        return view('web.contacto', compact('info'));
    }

    public function catalogo(Request $request)
    {
        $info['establecimientos'] = Establecimiento::where('status', 1) -> get();
        $info['categorias'] = EstablecimientoCategorias::where('status', 1) -> get();
        if(count($request -> all()) == 0) {
            $info['productos'] = Productos::select('productos.*', "establecimientos.nombre AS nombreEstablecimiento")
                -> join('producto_establecimiento', 'productos.id', '=', 'producto_establecimiento.producto_id')
                -> join('establecimientos', 'producto_establecimiento.establecimiento_id', '=', 'establecimientos.id')
                -> where([
                    ["productos.status", "=", 1],
                    ["establecimientos.id", "=", $info['establecimientos'][0] -> id],
                    ["producto_establecimiento.establecimiento_id", "=", $info['establecimientos'][0] -> id],
                ]) -> get();
        } else {
            if(isset($request -> categoria) && $request -> categoria !== null) {
                if(isset($request -> establecimiento)) {
                    $info['productos'] = Productos::select('productos.*', "establecimientos.nombre AS nombreEstablecimiento")
                        -> join('producto_establecimiento', 'productos.id', '=', 'producto_establecimiento.producto_id')
                        -> join('establecimientos', 'producto_establecimiento.establecimiento_id', '=', 'establecimientos.id')
                        -> where([
                            ["productos.status", "=", 1],
                            ["productos.categorias_id", "=", $request -> categoria],
                            ["establecimientos.id", "=", $request -> establecimiento],
                            ["producto_establecimiento.establecimiento_id", "=", $request -> establecimiento],
                        ]) -> get();
                } else {
                    $info['productos'] = Productos::select('productos.*', "establecimientos.nombre AS nombreEstablecimiento")
                    -> join('producto_establecimiento', 'productos.id', '=', 'producto_establecimiento.producto_id')
                    -> join('establecimientos', 'producto_establecimiento.establecimiento_id', '=', 'establecimientos.id')
                    -> where([
                        ["productos.status", "=", 1],
                        ["productos.categorias_id", "=", $request -> categoria],
                    ]) -> get();
                }
            } else {
                $info['productos'] = Productos::select('productos.*', "establecimientos.nombre AS nombreEstablecimiento")
                    -> join('producto_establecimiento', 'productos.id', '=', 'producto_establecimiento.producto_id')
                    -> join('establecimientos', 'producto_establecimiento.establecimiento_id', '=', 'establecimientos.id')
                    -> where([
                        ["productos.status", "=", 1],
                        ["establecimientos.id", "=", $request -> establecimiento],
                        ["producto_establecimiento.establecimiento_id", "=", $request -> establecimiento],
                    ]) -> get();
            }
        }

        return view('web.catalogo', compact('info'));
    }

    public function catalogo_buscar(Request $request)
    {
        $info['establecimientos'] = Establecimiento::where('status', 1) -> get();
        $info['categorias'] = EstablecimientoCategorias::where('status', 1) -> get();
        $info['productos'] = Productos::select('productos.*', "establecimientos.nombre AS nombreEstablecimiento")
            -> join('producto_establecimiento', 'productos.id', '=', 'producto_establecimiento.producto_id')
            -> join('establecimientos', 'producto_establecimiento.establecimiento_id', '=', 'establecimientos.id')
            -> where([
                ["productos.status", "=", 1],
                ["productos.nombre", "LIKE", "%{$request -> buscar}%"]
            ]) -> get();

        return view('web.catalogo', compact('info'));
    }

    public function catalogo_detalle(Int $id)
    {
        $info['producto'] = Productos::select('productos.*', "establecimientos.nombre AS nombreEstablecimiento",)
            -> join('producto_establecimiento', 'productos.id', '=', 'producto_establecimiento.producto_id')
            -> join('establecimientos', 'producto_establecimiento.establecimiento_id', '=', 'establecimientos.id')
            -> where([
                ["productos.id", "=", $id]
            ]) -> first();
        $info['galeria'] = ProductoGaleria::where("producto_id",  $id) -> get();
        $info['amenidades'] = Amenidades::select('amenidades.*')
            -> join('producto_amenidades', 'amenidades.id', '=', 'producto_amenidades.amenidades_id')
            -> where([
                ["producto_amenidades.producto_id", "=", $id]
            ]) -> get();
        $info['otros'] = Productos::where([
            ["status", "=", 1],
            ["id", "!=", $id]
        ]) -> inRandomOrder() -> limit(8);
        return view('web.catalogo-detalle', compact('info'));
    }

    public function faqs ()
    {
        $info['faqs'] = Faqs::all();
        return view('web.faqs', compact('info'));
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

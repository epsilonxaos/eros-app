<?php

namespace App\Http\Controllers;

use App\Establecimiento;
use App\EstablecimientoCategorias;
use App\Helpers;
use App\Http\Requests\StoreProductos;
use App\Http\Requests\UpdateProductos;
use App\ProductoAmenidad;
use App\ProductoEstablecimiento;
use App\Productos;
use Illuminate\Http\Request;
use Symfony\Component\Console\Helper\Helper;

class ProductosController extends Controller
{
    protected $directorio = "public/productos";

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all = Productos::select('productos.*', 'establecimiento_categorias.nombre AS nombreCategoria')
            -> join('establecimiento_categorias', 'productos.categorias_id', '=', 'establecimiento_categorias.id')
            -> where('productos.tipo', 'producto')
            -> orderBy('productos.id', 'desc') -> get();

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

    public function indexHabitaciones()
    {
        $all = Productos::select('productos.*', 'establecimiento_categorias.nombre AS nombreCategoria')
            -> join('establecimiento_categorias', 'productos.categorias_id', '=', 'establecimiento_categorias.id')
            -> where('productos.tipo', 'habitacion')
            -> orderBy('productos.id', 'desc') -> get();

        return view('panel.habitaciones.list', [
            'title' => 'Habitaciones',
            'breadcrumb' => [
                [
                    'title' => 'Todos',
                    'route' => 'panel.eros.habitaciones.index',
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
        $establecimiento = Establecimiento::where('status', 1) -> get();

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
            'categorias' => $categorias,
            'establecimiento' => $establecimiento
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createHabitaciones()
    {
        $categorias = EstablecimientoCategorias::where('status', 1) -> get();
        $establecimiento = Establecimiento::where('status', 1) -> get();

        return view('panel.habitaciones.create', [
            'title' => 'Habitaciones',
            'breadcrumb' => [
                [
                    'title' => 'Todos',
                    'route' => 'panel.eros.habitaciones.index',
                    'active' => false
                ],
                [
                    'title' => 'Nuevo',
                    'route' => 'panel.eros.habitaciones.create',
                    'active' => true
                ]
            ],
            'categorias' => $categorias,
            'establecimiento' => $establecimiento
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductos $request)
    {
        $add = new Productos();
        $cover = Helpers::addFileStorage($request -> file('cover'), $this -> directorio);

        $add -> cover = $cover;
        $add -> nombre = $request -> nombre;
        $add -> categorias_id = $request -> categorias_id;
        $add -> descripcion = $request -> descripcion;
        $add -> descripcion_extra = $request -> descripcion_extra;
        $add -> save();

        if(count($request -> establecimiento) > 0) {
            foreach ($request -> establecimiento as $key => $establecimiento_id) {
                $add2 = new ProductoEstablecimiento();
                $add2 -> producto_id = $add -> id;
                $add2 -> establecimiento_id = $establecimiento_id;
                $add2 -> save();
            }
        }

        if($request -> tipo === 'habitacion') {
            $add -> tipo = 'habitacion';
            $add -> save();

            // if(count($request -> amenidades) > 0) {
            //     foreach ($request -> amenidades as $key => $amenidad_id) {
            //         $add3 = new ProductoAmenidad();
            //         $add3 -> producto_id = $add -> id;
            //         $add3 -> amenidades_id = $amenidad_id;
            //     }
            // }
        }
        $message = ($request -> tipo === 'habitacion') ? 'Habitacion creada correctamente!' : 'Producto creado correctamente!';
        return redirect() -> back() -> with('success', $message);
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
    public function edit(Int $id)
    {
        $data = Productos::find($id);
        $categorias = EstablecimientoCategorias::where('status', 1) -> get();
        $establecimiento = Establecimiento::select('establecimientos.*', 'producto_establecimiento.establecimiento_id AS activo')
            ->leftJoin('producto_establecimiento', 'establecimientos.id', '=', 'producto_establecimiento.establecimiento_id')
            ->where('establecimientos.status', 1) -> get();

        return view('panel.productos.edit', [
            'title' => 'Productos',
            'breadcrumb' => [
                [
                    'title' => 'Todos',
                    'route' => 'panel.eros.productos.index',
                    'active' => false
                ],
                [
                    'title' => 'Editar',
                    'route' => 'panel.eros.productos.edit',
                    'params' => [
                        'id' => $id
                    ],
                    'active' => true
                ]
            ],
            'data' => $data,
            'categorias' => $categorias,
            'establecimiento' => $establecimiento
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Productos  $productos
     * @return \Illuminate\Http\Response
     */
    public function editHabitaciones(Int $id)
    {
        $data = Productos::find($id);
        $categorias = EstablecimientoCategorias::where('status', 1) -> get();
        $establecimiento = Establecimiento::select('establecimientos.*', 'producto_establecimiento.establecimiento_id AS activo', 'producto_establecimiento.producto_id AS prod')
            ->join('producto_establecimiento', 'establecimientos.id', '=', 'producto_establecimiento.establecimiento_id')
            ->where([
                ['establecimientos.status', '=', 1]
            ])  -> get();

            dd($establecimiento -> toArray());

        return view('panel.habitaciones.edit', [
            'title' => 'Habitaciones',
            'breadcrumb' => [
                [
                    'title' => 'Todos',
                    'route' => 'panel.eros.habitaciones.index',
                    'active' => false
                ],
                [
                    'title' => 'Editar',
                    'route' => 'panel.eros.habitaciones.edit',
                    'params' => [
                        'id' => $id
                    ],
                    'active' => true
                ]
            ],
            'data' => $data,
            'categorias' => $categorias,
            'establecimiento' => $establecimiento
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Productos  $productos
     * @return \Illuminate\Http\Response
     */
    public function update(Int $id, UpdateProductos $request)
    {
        $upd = Productos::find($id);
        if($request -> hasFile('cover')) {
            Helpers::deleteFileStorage('productos', 'cover', $id);
            $cover = Helpers::addFileStorage($request -> file('cover'), $this -> directorio);
            $upd -> cover = $cover;
            $upd -> save();
        }

        $upd -> nombre = $request -> nombre;
        $upd -> categorias_id = $request -> categorias_id;
        $upd -> descripcion = $request -> descripcion;
        $upd -> descripcion_extra = $request -> descripcion_extra;
        $upd -> save();

        if(count($request -> establecimiento) > 0) {
            ProductoEstablecimiento::where('producto_id', $id) -> delete();
            foreach ($request -> establecimiento as $key => $establecimiento_id) {
                $add2 = new ProductoEstablecimiento();
                $add2 -> producto_id = $upd -> id;
                $add2 -> establecimiento_id = $establecimiento_id;
                $add2 -> save();
            }
        }

        if($request -> tipo === 'habitacion') {
            // if(count($request -> amenidades) > 0) {
                // ProductoAmenidad::where('producto_id', $id) -> delete();
                // foreach ($request -> amenidades as $key => $amenidad_id) {
                //     $add3 = new ProductoAmenidad();
                //     $add3 -> producto_id = $upd -> id;
                //     $add3 -> amenidades_id = $amenidad_id;
                // }
            // }
        }
        $message = ($request -> tipo === 'habitacion') ? 'Habitacion creada correctamente!' : 'Producto creado correctamente!';
        return redirect() -> back() -> with('success', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Productos  $productos
     * @return \Illuminate\Http\Response
     */
    public function destroy(Int $id)
    {
        Helpers::deleteFileStorage('productos', 'cover', $id);
        Productos::where('id', $id) -> delete();
        return redirect() -> back() -> with('success', 'Registro eliminado correctamente!');
    }

    /**
     * Change status to show - hidden
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function changeStatus(Request $request)
    {
        Helpers::changeStatus('productos', $request -> id, $request -> status);
        return 'true';
    }
}

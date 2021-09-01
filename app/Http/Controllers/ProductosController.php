<?php

namespace App\Http\Controllers;

use App\Amenidades;
use App\Establecimiento;
use App\EstablecimientoCategorias;
use App\Helpers;
use App\Http\Requests\StoreProductos;
use App\Http\Requests\UpdateProductos;
use App\ProductoAmenidad;
use App\ProductoEstablecimiento;
use App\ProductoGaleria;
use App\Productos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\Console\Helper\Helper;

class ProductosController extends Controller
{
    protected $directorio = "public/productos";
    protected $directorioGalerias = "public/productos/galeria";

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
            'establecimiento' => $establecimiento,
            'amenidades' => Amenidades::all()
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
        // dd($request -> all());
        $add = new Productos();
        $cover = Helpers::addFileStorage($request -> file('cover'), $this -> directorio);

        $add -> cover = $cover;
        $add -> nombre = $request -> nombre;
        $add -> categorias_id = $request -> categorias_id;
        $add -> descripcion = $request -> descripcion;
        $add -> descripcion_extra = $request -> descripcion_extra;
        $add -> save();

        if(isset($request -> establecimiento)) {
            foreach ($request -> establecimiento as $key => $establecimiento_id) {
                $add2 = new ProductoEstablecimiento();
                $add2 -> producto_id = $add -> id;
                $add2 -> establecimiento_id = $establecimiento_id;
                $add2 -> save();
            }
        }

        $message = ($request -> tipo === 'habitacion') ? 'Habitacion creada correctamente!' : 'Producto creado correctamente!';

        if($request -> tipo === 'habitacion') {
            $add -> tipo = 'habitacion';
            $add -> save();

            if(isset($request -> amenidades)) {
                foreach ($request -> amenidades as $key => $amenidad_id) {
                    $add3 = new ProductoAmenidad();
                    $add3 -> producto_id = $add -> id;
                    $add3 -> amenidades_id = $amenidad_id;
                    $add3 -> save();
                }
            }
            return redirect() -> route('panel.eros.habitaciones.galeria.acciones', ['accion' => 'create', 'id' => $add -> id]) -> with('success', $message);
        }
        return redirect() -> route('panel.eros.productos.galeria.acciones', ['accion' => 'create', 'id' => $add -> id]) -> with('success', $message);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createGaleria(String $accion, Int $id)
    {
        if($accion === 'edit')
        {
            $nameProduct = Productos::select('nombre') -> where('id', $id) -> first();
        }

        $info = [
            'title' => 'Galeria',
            'breadcrumb' => [
                [
                    'title' => 'Todos',
                    'route' => 'panel.eros.productos.index',
                    'active' => false
                ],
                [
                    'title' => ($accion === 'edit') ? 'Editar - '.$nameProduct -> nombre : 'Nuevo',
                    'route' => ($accion === 'edit') ? 'panel.eros.productos.edit' : 'panel.eros.productos.create',
                    'active' => false,
                    'params' => ($accion === 'edit') ? ['id' => $id] : ''
                ],
                [
                    'title' => 'Galeria',
                    'route' => 'panel.eros.productos.galeria.acciones',
                    'active' => true,
                    'params' => [
                        'accion' => $accion,
                        'id' => $id
                    ]
                ]
            ],
            'galeria' => ProductoGaleria::where('producto_id', $id) -> orderBy('order', 'asc') -> get(),
            'id' => $id,
            'accion' => $accion
        ];
        return view('panel.productos.galeria.index', $info);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createGaleria2(String $accion, Int $id)
    {
        if($accion === 'edit')
        {
            $nameProduct = Productos::select('nombre') -> where('id', $id) -> first();
        }

        $info = [
            'title' => 'Galeria',
            'breadcrumb' => [
                [
                    'title' => 'Todos',
                    'route' => 'panel.eros.habitaciones.index',
                    'active' => false
                ],
                [
                    'title' => ($accion === 'edit') ? 'Editar - '.$nameProduct -> nombre : 'Nuevo',
                    'route' => ($accion === 'edit') ? 'panel.eros.habitaciones.edit' : 'panel.eros.habitaciones.create',
                    'active' => false,
                    'params' => ($accion === 'edit') ? ['id' => $id] : ''
                ],
                [
                    'title' => 'Galeria',
                    'route' => 'panel.eros.habitaciones.galeria.acciones',
                    'active' => true,
                    'params' => [
                        'accion' => $accion,
                        'id' => $id
                    ]
                ]
            ],
            'galeria' => ProductoGaleria::where('producto_id', $id) -> orderBy('order', 'asc') -> get(),
            'id' => $id,
            'accion' => $accion
        ];
        return view('panel.habitaciones.galeria.index', $info);
    }

    public function storeGaleria(Request $request) {
        $input = $request -> all();
        $rules = [
            'file' => 'mimes:jpeg,jpg,png|max:2048'
        ];

        $validation = Validator::make($input, $rules);

        if($validation -> fails())
        {
            return Response::json('Limite de peso excedido', 400);
        }

        $file = $request -> file('file');
        $cover = Helpers::addFileStorage($file, $this -> directorioGalerias);
        $add = new ProductoGaleria();
        $add -> img = $cover;
        $add -> producto_id = $request -> id;
        $add -> save();
        $add -> order = $add -> id;
        $add -> save();

        return Response::json('success', 200);
    }

    /**
     * Reording files gallery
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function ordenamiento(Request $request)
    {
        $orden = $request -> toArray();
        foreach ($orden as $key => $val) {
            $gal = ProductoGaleria::find($val['id']);
            $gal -> order = $val['orden'];
            $gal -> save();
        }

        return 'true';
    }

    /**
     * Delete image gallery
     *
     * @param \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroyImageGallery(Request $request)
    {
        Helpers::deleteFileStorage('producto_galerias', 'img', $request -> id);
        ProductoGaleria::where('id', $request -> id) -> delete();

        return 'true';
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
        $establecimiento = Establecimiento::where('status', '1') -> get() -> toArray();
        foreach ($establecimiento as $key => $local) {
            $activo = ProductoEstablecimiento::where([
                ['producto_id', '=', $id],
                ['establecimiento_id', '=', $local['id']]
            ]) -> get() -> toArray();

            $establecimiento[$key]['activo'] = (count($activo) > 0) ? true : false;
        }

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
        $establecimiento = Establecimiento::where('status', '1') -> get() -> toArray();
        foreach ($establecimiento as $key => $local) {
            $activo = ProductoEstablecimiento::where([
                ['producto_id', '=', $id],
                ['establecimiento_id', '=', $local['id']]
            ]) -> get() -> toArray();

            $establecimiento[$key]['activo'] = (count($activo) > 0) ? true : false;
        }
        $amenidades = Amenidades::where('status', '1') -> get() -> toArray();
        foreach ($amenidades as $key => $amenidad) {
            $activo = ProductoAmenidad::where([
                ['producto_id', '=', $id],
                ['amenidades_id', '=', $amenidad['id']]
            ]) -> get() -> toArray();

            $amenidades[$key]['activo'] = (count($activo) > 0) ? true : false;
        }

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
            'establecimiento' => $establecimiento,
            'amenidades' => $amenidades
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
            if(isset($request -> amenidades)) {
                ProductoAmenidad::where('producto_id', $id) -> delete();
                foreach ($request -> amenidades as $key => $amenidad_id) {
                    $add3 = new ProductoAmenidad();
                    $add3 -> producto_id = $upd -> id;
                    $add3 -> amenidades_id = $amenidad_id;
                    $add3 -> save();
                }
            }
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

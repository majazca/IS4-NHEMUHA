<?php

namespace App\Http\Controllers;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProductosController extends Controller
{    
    /**
    * Retorna la vista con la lista de productos por categoría seleccionada.
    */
    public function index($id_categoria)
    {
        Log::info('Ingresamos a ProductosController.index.');

        $productos = $this->obtenerProductos_cat($id_categoria);
        $categorias =  (new HomeController)->obtenerCategorias();
        $nombreCategoria =  (new HomeController)->obtenerNombreCategoria($id_categoria);

        Log::info('Salimos de ProductosController.index.');
        //return view("productos.index", ["productos"=>$productos], ["categorias"=>$categorias], ['nombreCategoria'=>$nombreCategoria]);
        return view("productos.index", compact('productos', 'categorias', 'nombreCategoria'));

    }

    // function to load productos TODO


    #region Productos
    /**
    * Retorna la lista de productos por categoría.
    */
    private function obtenerProductos_cat($id_categoria)
    {
        Log::info('Ingresamos a ProductosController.obtenerProductos_cat.');
        //Log::debug('Vamos a obtener la lista de productos de la categoría {}.'); // TODO

        $productos = Producto::where('id_categoria', $id_categoria)->orderBy('nombre')->get();

        Log::info('Salimos de ProductosController.obtenerProductos_cat.');
        return $productos;
    }

    /**
    * Realiza la busqueda de productos por nombre.
    */
    public function productosNombre($nombre)
    {
        Log::info('Ingresamos a ProductosController.productosNombre.');
        Log::debug('Vamos a obtener la lista de productos con el nombre: '.$nombre);

        //$productos = Producto::where('id_categoria', '1')->orderBy('nombre')->get();
        $productos = Producto::where('nombre', 'LIKE', '%'.$nombre.'%')->get();

       // echo $productos;

        Log::info('Salimos de ProductosController.productosNombre.');

        //return view("productos.index", compact('productos', 'categorias', 'nombreCategoria'));

        
        return response()->json($productos);

        // $route = "/";
        // return redirect($route);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Venderore;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use DB;

class VendedoresController extends Controller
{    
    /**
    * Retorna la vista de vendedores.
    */
    public function index()
    {
        Log::info('Ingresamos a VendedoresController.index.');

        // $categorias =  (new HomeController)->obtenerCategorias();

        $rol = config('global.roles.admin');

        $id_vendedor = config('global.roles.id_vendedor');

        $vendedor = Venderore::where('id_vendedor', $id_vendedor)->get();

        Log::info('Salimos de VendedoresController.index.');
        return view("vendedores.index", compact('rol', 'vendedor'));
    }

    /**
    * Retorna la vista con el formulario para cargar producto.
    */
    public function cargarProducto($id_vendedor)
    {
        Log::info('Ingresamos a ProductosController.cargarProducto.');
        // Log::debug('Ingresamos a ProductosController.cargarProducto. id_vendedor:', $id_vendedor); //TODO

        // TODO
        $rol = config('global.roles.admin');
        $categorias =  (new HomeController)->obtenerCategorias();
        $vendedor = Venderore::where('id_vendedor', $id_vendedor)->get();


        Log::info('Salimos de ProductosController.cargarProducto.');
        return view("vendedores.cargarProducto", compact('rol', 'vendedor','categorias'));
    }

    /**
    * Retorna la vista con el formulario para cargar producto.
    */
    public function listaProducto($id_vendedor)
    {
        Log::info('Ingresamos a VendedorController.listaProducto. Vamos a obtener los productos para el vendedor con id: '.$id_vendedor);

        // // TODO
        $rol = config('global.roles.admin');
        $productos = Producto::where('id_vendedor', $id_vendedor)->get();
        $vendedor = Venderore::where('id_vendedor', $id_vendedor)->get();

        Log::info('Salimos de VendedorController.listaProducto.');
        return view("vendedores.listaProductos", compact('productos', 'rol', 'vendedor'));
    }

    public function datos($id_vendedor)
    {
        Log::info('Ingresamos a VendedorController.datos. Vamos a obtener los datos para el vendedor con id: '.$id_vendedor);

        // // TODO
        $rol = config('global.roles.admin');
        $vendedor = Venderore::where('id_vendedor', $id_vendedor)->get();

        Log::info('Salimos de VendedorController.datos.');
        return view("vendedores.datos", compact('rol', 'vendedor'));
    }

    public function actualizarDatos()
    {
        Log::info('Ingresamos a VendedorController.actualizarDatos.');

        $nombre = request('nombre');
        $id_vendedor = request('id_vendedor');
        $direccion = request('direccion');
        $ruc = request('ruc');
        $telefono = request('telefono');
        $fecha_ingreso = request('fecha_ingreso');
        $pin_acceso = request('pin_acceso');  

        // // TODO
        $rol = config('global.roles.admin');
        $data=array('nombre'=>$nombre,"direccion"=>$direccion,"ruc"=>$ruc,"telefono"=>$telefono,"fecha_ingreso"=>$fecha_ingreso,"pin_acceso"=>$pin_acceso);
        DB::table('venderores')->update($data);   

        $route = "/vendedores/".$id_vendedor."/datos";

        Log::info('Salimos de VendedorController.actualizarDatos.');
        return redirect($route);
    }


    /**
    * Realiza la carga de producto del vendedor.
    */
    public function guardar()
    {
        Log::info('Ingresamos a ProductosController.guardar.');

        $nombre = request('nombre');
        $id_vendedor = 1;
        $id_categoria = request('id_categoria');
        $descripcion = request('descripcion');
        $precio = request('precio');
        $iva = request('iva');
        $imagen = request('imagen');  
        $cantidad = request('cantidad'); 
        $id_vendedor = request('id_vendedor');        

        $data=array('nombre'=>$nombre,"id_categoria"=>$id_categoria,"descripcion"=>$descripcion,"precio"=>$precio,"iva"=>$iva,"imagen"=>$imagen, "cantidad"=>$cantidad,"id_vendedor"=>$id_vendedor);
        DB::table('productos')->insert($data);   

        $route = "/vendedores/".$id_vendedor."/CargarProducto";

        Log::info('Salimos de ProductosController.guardar.');
        return redirect($route);
    }

    public function obtenerNombreVendedor($id_vendedor)
    {
        Log::info('Ingresamos a VendedorController.obtenerNombreVendedor. Vamos a obtener el nombre del vendedor con id: '.$id_vendedor);

        $nombreVendedor = Venderore::where('id_vendedor', $id_vendedor)->get('nombre');

        Log::info('Salimos de VendedorController.guarobtenerNombreVendedordar.');
        return $nombreVendedor;
    }
    
}

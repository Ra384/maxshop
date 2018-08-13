<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


use App\Producto;
use App\Categoria;
use App\Marca;
use App\Proveedor;

class ProductoController extends Controller
{
    public function index(){
       $productos = DB::table('productos')
            ->join('categorias','productos.categorias_id','=','categorias.id')
            ->join('marcas','productos.marcas_id','=','marcas.id')
            ->join('proveedores','productos.proveedores_id','=','proveedores.id')
            ->select(
                'productos.*',
                        'categorias.nombre as nombre_categoria',
                        'marcas.nombre as nombre_marca',
                        'proveedores.nombre as nombre_proveedor'
            )->orderBy('id','DESC')->get();

        return $productos;
    }

    public function store(Request $request){
        $producto = new Producto();
        $producto->codigo = $request->codigo;
        $producto->nombre = $request->nombre;
        $producto->descripcion = $request->descripcion;
        $producto->precio_original = $request->precio_original;
        $producto->precio_venta = $request->precio_venta;
        $producto->cantidad = $request->cantidad;
        $producto->estado = $request->estado;
        $producto->categorias_id = $request->categorias_id;
        $producto->proveedores_id = $request->proveedores_id;
        $producto->marcas_id = $request->marcas_id;
        $producto->save();
    }

    public function selectCategoria(){
        $categorias  = Categoria::all();
        return $categorias;
    }

    public function selectMarca(){
        $marcas = Marca::all();
        return $marcas;
    }

    public function selectProveedor(){
        $pro = Proveedor::all();
        return $pro;
    }

    public function update(Request $request){
        $producto = Producto::find($request->id);
        $producto->update($request->all());
       /* $categoria = $producto->categoria;
        $marca = $producto->marca;
        $proveedor = $producto->proveedor;*/
        /*$producto->nombre = $request->nombre;
        $producto->descripcion = $request->descripcion;
        $producto->precio_original = $request->precio_original;
        $producto->precio_venta = $request->precio_venta;
        $producto->precio_original = $request->precio_original;
        $producto->cantidad = $request->cantidad;
        $producto->estado = $request->estado;
        $producto->categorias_id = $request->categorias_id;
        $producto->proveedores_id = $request->proveedores_id;
        $producto->marcas_id = $request->marcas_id;*/
    }

    public function destroy($id)
    {
        $proveedor = Producto::findOrFail($id);
        $proveedor -> delete();
    }

    //Pendiente

    public function verImagenes(){

    }

    public function subirImagenes(Request $request){
        if($request->hasFile('images')){
            foreach ($request->file('images') as $file){
                $name = time()."_".$file->getClientOriginalName();
                $file->move(public_path().'/uploads/productos',$name);
            }
        }
    }
}

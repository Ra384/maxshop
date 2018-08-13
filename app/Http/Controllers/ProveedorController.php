<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Proveedor;

class ProveedorController extends Controller
{
    //
    public function index(){
        $proveedores = Proveedor::orderBy('id','DESC')->get();
        return $proveedores;
    }

    public function store(Request $request){
        $proveedor = new Proveedor();
        $proveedor->nombre = $request->nombre;
        $proveedor->compania = $request->compania;
        $proveedor->direccion = $request->direccion;
        $proveedor->codigo_postal = $request->codigo_postal;
        $proveedor->telefono = $request->telefono;
        $proveedor->correo_electronico = $request->correo_electronico;
        $proveedor->save();
    }

    public function update(Request $request)
    {
        $proveedor = Proveedor::find($request->id);
        $proveedor -> update($request->all());
    }

    public function destroy($id)
    {
        $proveedor = Proveedor::findOrFail($id);
        $proveedor -> delete();
    }
}

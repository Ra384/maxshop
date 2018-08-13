<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Marca;

class MarcaController extends Controller
{
    public function index(){
        $marcas = Marca::orderBy('id','DESC')->get();
        return $marcas;
    }

    public function store(Request $request){
        $marca = new Marca();
        $marca->nombre = $request->nombre;
        $marca->estado = $request->estado;
        $marca->save();
    }

    public function update(Request $request){
        $marca = Marca::findOrFail($request->id);
        $marca -> update($request->all());
    }

    public function destroy($id){
        $marca = Marca::findOrFail($id);
        $marca -> delete();
    }
}

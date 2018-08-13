<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    //Campos
    protected $fillable = ['categorias_id','proveedores_id','marcas_id','codigo','nombre','descripcion','precio_original','precio_venta','cantidad','estado'];

    public function categoria()
    {
        return $this->belongsTo('App\Categoria','categorias_id');
    }

    public function marca()
    {
        return $this->belongsTo('App\Marca','marcas_id');
    }

    public function proveedor(){
        return $this->belongsTo('App\Proveedor','proveedores_id');
    }

    public function imagenes(){
        return $this->hasMany('App\Imagen','productos_id');
    }
}

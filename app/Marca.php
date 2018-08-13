<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    //Campos
    protected $fillable = ['nombre','estado'];
    //Nombre Tabla
    protected $table = 'marcas';

    public function productos()
    {
        return $this->hasMany('App\Producto');
    }
}

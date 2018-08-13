<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Imagen extends Model
{
    //
    protected $fillable = ['productos_id','url'];
    protected $table = 'imagenes';

    public function producto(){
        return $this->belongsTo('App\Producto','productos_id');
    }
}

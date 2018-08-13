<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    //Campos
    protected $fillable = ['nombre','compania','direccion','codigo_postal','telefono','correo_electronico'];
    //Nombre de la tabla
    protected $table = 'proveedores';

    public function productos(){
        return $this->hasMany('App\Proveedor','proveedores_id');
    }
}

<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home.content');

});

Route::get('/categorias','CategoriaController@index');
Route::post('/categorias/guardar','CategoriaController@store');
Route::put('/categorias/actualizar','CategoriaController@update');
Route::delete('/categorias/eliminar/{id}','CategoriaController@destroy');

Route::get('/proveedores','ProveedorController@index');
Route::post('/proveedores/guardar','ProveedorController@store');
Route::put('/proveedores/actualizar','ProveedorController@update');
Route::delete('/proveedores/eliminar/{id}','ProveedorController@destroy');

Route::get('/marcas','MarcaController@index');
Route::post('/marcas/guardar','MarcaController@store');
Route::put('/marcas/actualizar','MarcaController@update');
Route::delete('/marcas/eliminar/{id}','MarcaController@destroy');

Route::get('/productos','ProductoController@index');
Route::post('/productos/guardar','ProductoController@store');
Route::put('/productos/actualizar','ProductoController@update');
Route::delete('/productos/eliminar/{id}','ProductoController@destroy');
Route::get('/selectCategorias','ProductoController@selectCategoria');
Route::get('/selectMarcas','ProductoController@selectMarca');
Route::get('/selectProveedores','ProductoController@selectProveedor');


//Pendiente
Route::get('/productos/verImagenes','ProductoController@verImagenes');
Route::post('/productos/upload','ProductoController@subirImagenes');





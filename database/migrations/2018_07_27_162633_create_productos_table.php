<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::enableForeignKeyConstraints();
        Schema::create('productos', function (Blueprint $table) {
            //Campos
            $table->increments('id');
            $table->unsignedInteger('categorias_id');
            $table->unsignedInteger('proveedores_id');
            $table->unsignedInteger('marcas_id');
            $table->string('codigo');
            $table->string('nombre');
            $table->string('descripcion');
            $table->float('precio_original');
            $table->float('precio_venta');
            $table->integer('cantidad');
            $table->boolean('estado')->default(1);
            $table->timestamps();

            //Llaves Foraneas
            $table->foreign('categorias_id')->references('id')->on('categorias');
            $table->foreign('proveedores_id')->references('id')->on('proveedores');
            $table->foreign('marcas_id')->references('id')->on('marcas');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productos');
    }
}

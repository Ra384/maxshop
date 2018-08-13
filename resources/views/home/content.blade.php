@extends('main')

@section('content')
    
    <!-- Productos -->
    <template v-if="opcion == 1">
        <product></product>
    </template>

    <!-- Categorias -->
    <template v-if="opcion == 2">
        <category></category>

    </template>
    <!--Marcas-->
    <template v-if="opcion == 3">
        <brand></brand>
    </template>
    <!-- Ingresos -->
    <template v-if="opcion == 4">
        <h1>Contenido 3</h1>
    </template>
    <!-- Proveedores -->
    <template v-if="opcion == 5">
        <provider></provider>
    </template>

    <!-- Clientes -->

    <!-- Ventas -->

    <!-- Usuarios -->
    <template v-if="opcion == 8">

    </template>

@endsection
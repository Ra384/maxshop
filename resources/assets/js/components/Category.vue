<template>
    <div class="row">
        <div class="col-md">
            <div class="card">
                <div class="card-header">
                    <h3 class="float-left">Lista de Categorias</h3>
                    <button type="button" @click="categorias.accion = 'add'; categorias.nombre=''" class="btn btn-raised btn-success btn-sm float-right" data-toggle="modal" data-target="#categoriesModal">
                        Nueva Categoria
                    </button>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">CATEGORIA</th>
                            <th scope="col">ESTADO</th>
                            <th scope="col">OPCIONES</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="item in categorias.lista" :key="item.id">
                            <td>{{ item.id }}</td>
                            <td>{{ item.nombre }}</td>

                            <td v-if="item.estado==1"><span class="badge badge-success">Activo</span></td>
                            <td v-else><span class="badge badge-danger">No Activo</span></td>
                            <td style="display: flex; align-items:center; justify-content: center;">
                                <button class="btn btn-raised btn-warning btn-sm" @click="fillForm(item)" data-toggle="modal" data-target="#categoriesModal">Editar</button>&nbsp;
                                <button class="btn btn-raised btn-danger btn-sm" @click="openModal(item)">Eliminar</button>
                            </td>

                        </tr>
                        </tbody>
                    </table>
                </div>
                <!-- MODALES CATEGORIAS-->
                <div class="modal fade" id="categoriesModal" tabindex="-1" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 v-if="categorias.accion == 'add'" class="modal-title">Agregar Categoria</h5>
                                <h5 v-if="categorias.accion == 'edit'" class="modal-title">Modificar Categoria</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="nombre">Nombre</label>
                                    <input type="text" id="nombre" name="nombre" v-model="categorias.nombre" class="form-control" placeholder="Nombre de Categoría">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                <button type="button" v-if="categorias.accion == 'add'" class="btn btn-primary" @click="createCategorias()">Guardar</button>
                                <button type="button" v-if="categorias.accion == 'edit'" class="btn btn-primary" @click="updateCategorias()">Actualizar</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="deleteModal">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Eliminar Categoria</h5>
                            </div>
                            <div class="modal-body">
                                <p style="color:red;">¿Desea eliminar el registro? :(</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                <button type="button" class="btn btn-primary" @click="deleteCategorias()">Eliminar</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- FIN MODALES CATEGORIAS-->
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return{
                id: 0,
                categorias: {
                    'lista'  : [],
                    'nombre' : '',
                    'estado' : 0,
                    'accion' : ''
                }
            }
        },
        created: function () {
            this.readCategorias();
        },
        methods:{
            readCategorias: function () {
                let me=this;
                var url= 'categorias';
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.categorias.lista = respuesta;
                });
            },
            createCategorias: function(){
                let me = this;
                axios.post('/categorias/guardar',{
                    nombre: me.categorias.nombre,
                    estado: 1
                }).then(response => {
                    $('#categoriesModal').modal('hide');
                    me.readCategorias();
                    alert('OK!');
                    this.categorias.nombre = '';
                }).catch(function (error) {
                    console.log(error);
                });

            },
            updateCategorias: function () {
                let me = this;
                axios.put('/categorias/actualizar',{
                    nombre: this.categorias.nombre,
                    id: this.id
                }).then(response => {
                    $('#categoriesModal').modal('hide');
                    me.readCategorias();
                    this.categorias.nombre = '';
                    this.categorias.accion = '';
                    this.id = 0;
                    alert('OK!');
                }).catch(function (error) {
                    console.log(error);
                });
            },
            deleteCategorias: function () {

                let me = this;
                axios.delete('categorias/eliminar/'+me.id).then(response => {
                    $('#deleteModal').modal('hide');
                    me.id = 0;
                    me.readCategorias();
                    alert('Ok!');
                });
            },
            fillForm:function (item) {
                this.categorias.accion = 'edit';
                this.categorias.nombre = item.nombre;
                this.id = item.id;
            },
            openModal:function (item) {
                this.categorias.accion = 'delete';
                this.id = item.id;
                $('#deleteModal').modal('show');

            }
        }
    }
</script>

<style>

</style>

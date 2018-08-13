<template>
    <div class="row">
        <div class="col-md">
            <div class="card">
                <div class="card-header">
                    <h3 class="float-left">Lista de Proveedores</h3>
                    <button type="button" v-on:click="marcas.accion ='add'" class="btn btn-raised btn-success btn-sm float-right" data-toggle="modal" data-target="#modal">
                        Nueva Marca
                    </button>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>NOMBRE</th>
                            <th>ESTADO</th>
                            <th>OPCIONES</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="item in marcas.lista" :key="item.id">
                            <td v-text="item.id"></td>
                            <td v-text="item.nombre"></td>
                            <td v-if="item.estado"><span class="badge badge-success">Activo</span></td>
                            <td v-else><span class="badge badge-danger">Inactivo</span></td>

                            <td style="display: flex; align-items:center; justify-content: center;">
                                <button class="btn btn-warning btn-sm" v-on:click="fillForm(item)" data-toggle="modal" data-target="#modal">Editar</button>&nbsp;
                                <span class="px-1">
                                    <button class="btn btn-danger btn-sm" v-on:click="openModal(item)">Eliminar</button>
                                </span>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <!--Modal-->
                <div class="modal fade" id="modal" tabindex="-1" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 v-if="marcas.accion == 'add'" class="modal-title">Agregar Marca</h5>
                                <h5 v-if="marcas.accion == 'edit'" class="modal-title">Modificar Marca</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="nombre">Nombre</label>
                                    <input type="text" id="nombre" name="nombre" v-model="marcas.nombre" class="form-control" placeholder="Nombre">
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                <button type="button" v-if="marcas.accion == 'add'" class="btn btn-primary" @click="createMarcas()">Guardar</button>
                                <button type="button" v-if="marcas.accion == 'edit'" class="btn btn-primary" @click="updateMarcas()">Actualizar</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="deleteModal">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Eliminar Marca</h5>
                            </div>
                            <div class="modal-body">
                                <p style="color:red;">¿Desea eliminar el registro? :(</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                <button type="button" class="btn btn-primary" @click="deleteMarcas()">Eliminar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return{
                id: 0,
                marcas: {
                    'lista'  : [],
                    'nombre' : '',
                    'estado' : '',
                    'accion' : ''
                }
            }
        },
        created: function(){
            this.readMarcas();
        },
        methods:{
            readMarcas: function () {
                let me = this;
                var url = 'marcas';
                axios.get(url).then(function (response) {
                    me.marcas.lista = response.data;
                });
            },
            createMarcas: function () {

                axios.post('/marcas/guardar', {
                    nombre: this.marcas.nombre,
                    estado: 1
                }).then(response=>{
                    $('#modal').modal('hide');
                    this.readMarcas();
                    this.marcas.nombre = '';
                    alert('OK!');
                }).catch(function (error) {
                    console.log(error);
                });
            },
            updateMarcas: function () {
                axios.put('/marcas/actualizar', {
                    nombre: this.marcas.nombre,
                    estado: 1,
                    id:this.id
                }).then(response=>{
                    $('#modal').modal('hide');
                    this.readMarcas();
                    this.marcas.nombre = '';
                    this.id = 0;
                    alert('OK!');
                }).catch(function (error) {
                    console.log(error);
                });
            },
            deleteMarcas: function () {
                let me = this;
                axios.delete('marcas/eliminar/'+me.id).then(response => {
                    $('#deleteModal').modal('hide');
                    me.id = 0;
                    me.readMarcas();
                    alert('Ok!');
                });
            },
            openModal: function (item) {
               this.marcas.accion = 'delete';
               this.id = item.id;
               $('#deleteModal').modal('show');

            },
            fillForm: function (item) {
                this.marcas.accion = 'edit';
                this.marcas.nombre = item.nombre;
                this.id = item.id;

            }
        }
    }
</script>
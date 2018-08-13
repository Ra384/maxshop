<template>
    <div class="row">
        <div class="col-md">
            <div class="card">
                <div class="card-header">
                    <h3 class="float-left">Lista de Proveedores</h3>
                    <button type="button" v-on:click="proveedores.accion ='add'" class="btn btn-raised btn-success btn-sm float-right" data-toggle="modal" data-target="#providersModal">
                        Nuevo Proveedor
                    </button>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>NOMBRE</th>
                            <th>COMPAÑIA</th>
                            <th>DIRECCION</th>
                            <th>C.POSTAL</th>
                            <th>TELEFONO</th>
                            <th>E-MAIL</th>
                            <th>OPCIONES</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="item in proveedores.lista" :key="item.id">
                            <td v-text="item.id"></td>
                            <td v-text="item.nombre"></td>
                            <td v-text="item.compania"></td>
                            <td v-text="item.direccion"></td>
                            <td v-text="item.codigo_postal"></td>
                            <td v-text="item.telefono"></td>
                            <td v-text="item.correo_electronico"></td>
                            <td style="display: flex; align-items:center; justify-content: center;">
                                <button class="btn btn-warning btn-sm" v-on:click="fillForm(item)" data-toggle="modal" data-target="#providersModal">Editar</button>&nbsp;
                                <button class="btn btn-danger btn-sm" v-on:click="openModal(item)">Eliminar</button>
                            </td>

                        </tr>
                        </tbody>
                    </table>
                </div>

                <!-- MODALES PROVEEDORES-->
                <div class="modal fade" id="providersModal" tabindex="-1" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 v-if="proveedores.accion == 'add'" class="modal-title">Agregar Proveedor</h5>
                                <h5 v-if="proveedores.accion == 'edit'" class="modal-title">Modificar Proveedor</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="nombre">Nombre</label>
                                    <input type="text" id="nombre" name="nombre" v-model="proveedores.nombre" class="form-control" placeholder="Nombre">
                                </div>
                                <div class="form-group">
                                    <label for="compania">Compañia</label>
                                    <input type="text" id="compania" v-model="proveedores.compania" class="form-control" placeholder="Compañia">
                                </div>
                                <div class="form-group">
                                    <label for="direccion">Dirección</label>
                                    <input type="text" id="direccion"  v-model="proveedores.direccion" class="form-control" placeholder="Dirección">
                                </div>
                                <div class="form-group">
                                    <label for="codigo_postal">Código Postal</label>
                                    <input type="text" id="codigo_postal"  v-model="proveedores.codigo_postal" class="form-control" placeholder="Código Postal">
                                </div>
                                <div class="form-group">
                                    <label for="telefono">Telefono</label>
                                    <input type="text" id="telefono"  v-model="proveedores.telefono" class="form-control" placeholder="Telefono">
                                </div>
                                <div class="form-group">
                                    <label for="correo_electronico">Correo Electronico</label>
                                    <input type="text" id="correo_electronico"  v-model="proveedores.correo_electronico" class="form-control" placeholder="Correo Electronico">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                <button type="button" v-if="proveedores.accion == 'add'" class="btn btn-primary" @click="createProveedores()">Guardar</button>
                                <button type="button" v-if="proveedores.accion == 'edit'" class="btn btn-primary" @click="updateProveedores()">Actualizar</button>
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
                                <button type="button" class="btn btn-primary" @click="deleteProveedores()">Eliminar</button>
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
                proveedores: {
                    'lista'  : [],
                    'nombre' : '',
                    'compania': '',
                    'direccion': '',
                    'codigo_postal': '',
                    'telefono': '',
                    'correo_electronico':'',
                    'accion' : ''
                }
            }
        },
        created: function () {
            this.readProveedores();
        },
        methods:{
            readProveedores: function () {
                let me=this;
                var url= 'proveedores';
                axios.get(url).then(function (response) {
                    me.proveedores.lista = response.data;
                });
            },
            createProveedores: function(){
                let me = this;
                axios.post('/proveedores/guardar',{
                    nombre: this.proveedores.nombre,
                    compania: this.proveedores.compania,
                    direccion: this.proveedores.direccion,
                    codigo_postal: this.proveedores.codigo_postal,
                    telefono: this.proveedores.telefono,
                    correo_electronico: this.proveedores.correo_electronico
                }).then(response => {
                    $('#providersModal').modal('hide');
                    me.readProveedores();
                    alert('OK!');

                }).catch(function (error) {
                    console.log(error);
                });

            },
            updateProveedores: function () {
                let me = this;
                axios.put('/proveedores/actualizar',{
                    nombre: this.proveedores.nombre,
                    compania: this.proveedores.compania,
                    direccion: this.proveedores.direccion,
                    codigo_postal: this.proveedores.codigo_postal,
                    telefono: this.proveedores.telefono,
                    correo_electronico: this.proveedores.correo_electronico,
                    id: this.id
                }).then(response => {
                    $('#providersModal').modal('hide');
                    me.readProveedores();
                    this.proveedores.accion = '';
                    this.proveedores.nombre = '';
                    this.proveedores.compania = '';
                    this.proveedores.direccion = '';
                    this.proveedores.codigo_postal = '';
                    this.proveedores.telefono = '';
                    this.proveedores.correo_electronico = '';
                    this.id = 0;
                    alert('OK!');

                }).catch(function (error) {
                    console.log(error);
                });
            },
            deleteProveedores: function () {
                let me = this;
                axios.delete('proveedores/eliminar/'+me.id).then(response => {
                    $('#deleteModal').modal('hide');
                    me.id = 0;
                    me.readProveedores();
                    alert('OK!');

                });
            },
            fillForm:function (item) {
                this.proveedores.accion = 'edit';
                this.proveedores.nombre = item.nombre;
                this.proveedores.compania = item.compania;
                this.proveedores.direccion = item.direccion;
                this.proveedores.codigo_postal = item.codigo_postal;
                this.proveedores.telefono = item.telefono;
                this.proveedores.correo_electronico = item.correo_electronico;
                this.id = item.id;
            },
            openModal:function (item) {
                this.proveedores.accion = 'delete';
                this.id = item.id;
                $('#deleteModal').modal('show');

            }
        }
    }
</script>



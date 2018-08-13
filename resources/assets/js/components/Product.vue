<template>
    <div class="row">
        <div class="col-md">
            <div class="card">
                <div class="card-header">
                    <h3 class="float-left">Lista de Productos</h3>
                    <button type="button" v-on:click="productos.accion ='add'" @click="limpiarCampos()" class="btn btn-raised btn-success btn-sm float-right" data-toggle="modal" data-target="#addModal">
                        Nuevo Producto
                    </button>
                </div>
                <div class="card-body table-responsive">
                    <!-- TABLE PRODUCTOS -->
                    <table class="table table-bordered">
                        <thead>
                            <th>CODIGO</th>
                            <th>NOMBRE</th>
                            <th>PROVEEDOR</th>
                            <th>PRECIO</th>
                            <th width="2px">CANTIDAD</th>
                            <th>ESTADO</th>
                            <th>ACCIONES</th>
                        </thead>
                        <tbody>
                            <tr v-for="item in productos.lista">
                                <td v-text="item.codigo"></td>
                                <td v-text="item.nombre"></td>
                                <td v-text="item.nombre_proveedor"></td>
                                <td v-text="item.precio_venta"></td>
                                <td v-text="item.cantidad"></td>
                                <td v-if="item.estado"><span class="badge badge-success">Activo</span></td>
                                <td v-else><span class="badge badge-danger">Inactivo</span></td>
                                <td style="display: flex; align-items:center; justify-content: center;">
                                    <button class="btn btn-info btn-sm" @click="verProducto(item)" data-toggle="modal" data-target="#productsModal">Ver</button>&nbsp;
                                    <button class="btn btn-danger btn-sm" @click="openModal(item)">Eliminar</button>
                                    
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!--Modales-->
                    <!--Ver Producto-->
                    <div class="modal fade" id="productsModal" tabindex="-1" role="dialog">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-body">

                                    <!-- MENU PILLS BOOTSTRAP NAV PARA MODAL-->
                                    <ul class="nav nav-pills nav-fill" id="myTab" role="tablist">
                                        <!-- OPCIONES TABS -->
                                        <li class="nav-item">
                                            <a class="nav-link active" id="info-tab" data-toggle="tab" href="#info" role="tab" aria-selected="true">Información del Producto</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="images-tab" data-toggle="tab" href="#images" role="tab" aria-selected="false">Ver Imagenes</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="add-tab" data-toggle="tab" href="#add-images" role="tab" aria-selected="false">Agregar Imagenes</a>
                                        </li>
                                        <!-- FIN OPCIONES TABS -->
                                    </ul>
                                    <!-- FIN MENU PILLS BOOTSTRAP ... -->

                                    <div class="tab-content" id="myTabContent">
                                        <!-- BODY OPCIONES TAB PILLS -->

                                            <!-- OP 1 ver info -->
                                        <div class="tab-pane fade show active" id="info" role="tabpanel" aria-labelledby="info-tab">
                                            <div class="container py-3">
                                                <div class="form-row">
                                                    <div class="form-group col-6">
                                                        <label for="codigo">Código</label>
                                                        <input type="text" id="codigo" v-model="productos.codigo" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-6">
                                                        <label for="nombre">Nombre</label>
                                                        <input type="text" id="nombre" v-model="productos.nombre" class="form-control" placeholder="Nombre del Producto">
                                                    </div>
                                                    <div class="form-group col-6">
                                                        <label>Categoria</label>
                                                        <select class="form-control" v-model="productos.categoria">
                                                            <option v-for="item in listas.lcategoria" :value="item.id">{{item.nombre}}</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="desc">Descripción</label>
                                                    <textarea type="text" id="desc" v-model="productos.descripcion" class="form-control" rows="3" placeholder="Descripción"></textarea>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col">
                                                        <label for="precio_original">Precio Original</label>
                                                        <input type="text" id="precio_original" v-model="productos.precio_original" class="form-control" placeholder="$0.00">
                                                    </div>
                                                    <div class="form-group col">
                                                        <label for="precio_venta">Precio Venta</label>
                                                        <input type="text" id="precio_venta" v-model="productos.precio_venta" class="form-control" placeholder="$0.00">
                                                    </div>
                                                    <div class="form-group col">
                                                        <label for="cantidad">Cantidad</label>
                                                        <input type="number" id="cantidad" v-model="productos.cantidad" class="form-control" value="1">
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col">
                                                        <label for="pro">Proveedor</label>
                                                        <select class="form-control" id="pro" v-model="productos.proveedor">
                                                            <option v-for="item in listas.lproveedor" :value="item.id">{{item.nombre}}</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col">
                                                        <label for="marca">Marca</label>
                                                        <select class="form-control" id="marca" v-model="productos.marca">
                                                            <option v-for="item in listas.lmarca" :value="item.id">{{item.nombre}}</option>
                                                        </select>
                                                    </div>

                                                </div>
                                                <button class="btn btn-primary float-right" @click="updateProducto()">Actualizar</button>
                                            </div>

                                        </div>

                                            <!-- OP 2 ver imagenes -->
                                        <div class="tab-pane fade" id="images" role="tabpanel" aria-labelledby="images-tab">...</div>

                                            <!-- OP 3 upload images -->
                                        <div class="tab-pane fade" id="add-images" role="tabpanel" aria-labelledby="add-images">
                                            <div class="container py-1">
                                                <!-- FORM UPLOAD PRODUCTS IMAGES-->
                                                    <form @change="previewImage" class="file-upload-form" method="POST" enctype=multipart/form-data>
                                                        <label>Imagenes</label>
                                                        <input type="file" name="images[]" class="btn btn-outline-success" accept="image/*" multiple>
                                                        <button type="button" class="btn btn-primary" @click="subirImagenes">Guardar</button>
                                                    </form>
                                                <!-- FIN FORM UPLOAD PRODUCTS IMAGES -->

                                                <!-- VISUALIZADOR PREVIEW IMAGE  -->
                                                <div class="image-preview row" v-if="imageData.length > 0">
                                                    <div v-for="item in imageData" class="py-2">
                                                        <div class="col-md-2">
                                                            <img class="preview" :src="item">
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- FIN VISUALIZADOR PREVIEW IMAGE  -->

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Eliminar -->
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
                                    <button type="button" class="btn btn-primary" @click="deleteProducto()">Eliminar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Agregar Producto-->
                    <div class="modal fade" id="addModal">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Agregar Producto</h5>
                                </div>
                                <div class="modal-body">
                                    <div class="container">
                                        <div class="form-row">
                                            <div class="form-group col-6">
                                                <label>Código</label>
                                                <input type="text" v-model="productos.codigo" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-6">
                                                <label>Nombre</label>
                                                <input type="text" v-model="productos.nombre" class="form-control" placeholder="Nombre del Producto">
                                            </div>
                                            <div class="form-group col-6">
                                                <label>Categoria</label>
                                                <select class="form-control" v-model="productos.categoria">
                                                    <option v-for="item in listas.lcategoria" :value="item.id">{{item.nombre}}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Descripción</label>
                                            <textarea type="text" v-model="productos.descripcion" class="form-control" rows="3" placeholder="Descripción"></textarea>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col">
                                                <label>Precio Original</label>
                                                <input type="text" v-model="productos.precio_original" class="form-control" placeholder="$0.00">
                                            </div>
                                            <div class="form-group col">
                                                <label>Precio Venta</label>
                                                <input type="text" v-model="productos.precio_venta" class="form-control" placeholder="$0.00">
                                            </div>
                                            <div class="form-group col">
                                                <label>Cantidad</label>
                                                <input type="number" v-model="productos.cantidad" class="form-control" value="1">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col">
                                                <label>Proveedor</label>
                                                <select class="form-control" v-model="productos.proveedor">
                                                    <option v-for="item in listas.lproveedor" :value="item.id">{{item.nombre}}</option>
                                                </select>
                                            </div>
                                            <div class="form-group col">
                                                <label>Marca</label>
                                                <select class="form-control" v-model="productos.marca">
                                                    <option v-for="item in listas.lmarca" :value="item.id">{{item.nombre}}</option>
                                                </select>
                                            </div>

                                        </div>
                                        <button class="btn btn-primary float-right" @click="addProducto()">Guardar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                <!--Fin Modales-->
            </div>
        </div>

    </div>

</template>

<style>
    .file-upload-form,
    .image-preview {
        font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        padding: 20px;
    }

    img.preview {
        width: 200px;
        background-color: white;
        border: 1px solid #DDD;
        padding: 5px;
    }

</style>

<script>

    export default {
        data() {
            return {
                id: 0,
                file: null,
                formData: new FormData(),
                imageData: [],
                productos: {
                    'lista': [],
                    'accion': '',
                    'codigo': '',
                    'nombre': '',
                    'descripcion': '',
                    'precio_original': null,
                    'precio_venta': null,
                    'cantidad': 1,
                    'estado': 0,
                    'categoria': null,
                    'marca': null,
                    'proveedor': null
                },
                listas: {
                    lcategoria: [],
                    lmarca: [],
                    lproveedor: []
                }
            }
        },
        created: function () {
            this.readProductos();
            this.selectCategoria();
            this.selectMarca();
            this.selectProveedor();
        },
        methods: {
            readProductos: function () {
                let me = this;
                axios.get('productos').then(function (response) {
                    me.productos.lista = response.data;
                });
            },
            selectCategoria: function () {

                let me = this;
                axios.get('/selectCategorias').then(function (response) {
                    me.listas.lcategoria = response.data;
                });
            },
            selectMarca: function () {
                let me = this;
                axios.get('/selectMarcas').then(function (response) {
                    me.listas.lmarca = response.data;
                });
            },
            selectProveedor: function () {
                let me = this;
                axios.get('/selectProveedores').then(function (response) {
                    me.listas.lproveedor = response.data;
                });
            },
            verProducto: function (item) {
                $('#myTab a[href="#info"]').tab('show')
                let me = this;
                me.productos.codigo = item.codigo;
                me.productos.nombre = item.nombre;
                me.productos.descripcion = item.descripcion;
                me.productos.precio_original = item.precio_original
                me.productos.precio_venta = item.precio_original;
                me.productos.cantidad = item.cantidad;
                me.productos.estado = item.estado;
                me.productos.categoria = item.categorias_id;
                me.productos.proveedor = item.proveedores_id;
                me.productos.marca = item.marcas_id;
                me.id = item.id;
            },
            verImagen: function (item) {

            },
            addProducto: function () {
                let me = this;
                axios.post('/productos/guardar', {
                    codigo: me.productos.codigo,
                    nombre: me.productos.nombre,
                    descripcion: me.productos.descripcion,
                    precio_original: me.productos.precio_original,
                    precio_venta: me.productos.precio_venta,
                    cantidad: me.productos.cantidad,
                    estado: 1,
                    categorias_id: me.productos.categoria,
                    proveedores_id: me.productos.proveedor,
                    marcas_id: me.productos.marca

                }).then(response => {
                    me.readProductos();
                    $('#addModal').modal('hide');
                    alert('OK!');
                });
            },
            limpiarCampos: function () {
                this.productos.codigo = '';
                this.productos.nombre = '';
                this.productos.descripcion = '';
                this.productos.precio_original = '';
                this.productos.precio_venta = '';
                this.productos.cantidad = 1;
                this.productos.categoria = this.listas.lcategoria[0]['id'];
                this.productos.proveedor = this.listas.lproveedor[0]['id'];
                this.productos.marca = this.listas.lcategoria[0]['id'];
            },
            updateProducto: function () {
                let me = this;
                axios.put('/productos/actualizar', {
                    codigo: me.productos.codigo,
                    nombre: me.productos.nombre,
                    descripcion: me.productos.descripcion,
                    precio_original: me.productos.precio_original,
                    precio_venta: me.productos.precio_venta,
                    cantidad: me.productos.cantidad,
                    estado: me.productos.estado,
                    categorias_id: me.productos.categoria,
                    proveedores_id: me.productos.proveedor,
                    marcas_id: me.productos.marca,
                    id: me.id
                }).then(response => {
                    $('#productsModal').modal('hide');
                    me.readProductos();
                    alert('OK!');
                }).catch(function (error) {
                    console.log(error);
                });

            },
            deleteProducto: function () {
                let me = this;
                axios.delete('productos/eliminar/' + me.id).then(response => {
                    $('#deleteModal').modal('hide');
                    me.id = 0;
                    me.readProductos();
                    alert('Ok!');
                });
            },
            openModal: function (item) {
                this.productos.accion = 'delete';
                this.id = item.id;
                $('#deleteModal').modal('show');

            },
            previewImage: function(event) {

                for(var key in event.target.files){
                    this.formData.append('images[]', event.target.files[key]);
                }

                var input = event.target;
                if(input.files){
                    var filesAmount = input.files.length;

                    for (var i = 0; i<filesAmount;i++){
                        var reader = new FileReader();

                        reader.onload = (e) =>{
                            this.imageData.push(e.target.result);
                        }

                        reader.readAsDataURL(input.files[i]);
                    }
                }
            },
            subirImagenes: function () {
                axios.post('/productos/upload', this.formData)
                    .then(function (response) {
                        console.log(response);
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            }
        }
    }
</script>
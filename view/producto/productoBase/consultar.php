<div class="panel-header bg-primary-gradient">
    <div class="page-inner py-5">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
            <div>
                <h2 class="text-white pb-2 fw-bold">Bienvenido,</h2>
                <h5 class="text-white op-7 mb-2">
                    Buen dia <strong>Johan Muelas</strong>
                </h5>
            </div>
            <!-- <div class="ml-md-auto py-2 py-md-0">
                        <a href="#" class="btn btn-white btn-border btn-round mr-2">Manage</a>
                        <a href="#" class="btn btn-secondary btn-round">Add Customer</a>
                    </div> -->
        </div>
    </div>
</div>

<div class="page-inner mt--5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-head-row">
                        <div class="card-title">Gestion de Productos Base</div>
                        <div class="card-tools">
                            <button class="btn btn-primary btn-round ml-auto resetSubCategoria" data-toggle="modal" data-target="#agregarProductoModal">
                                <i class="fa fa-plus"></i>
                                Agregar Producto
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body">

                    <!-- modal de agregar -->
                    <div class="modal fade" id="agregarProductoModal" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header no-bd">
                                    <h5 class="modal-title">
                                        <span class="fw-mediumbold">
                                            Agregar</span>
                                        <span class="fw-light">
                                            Producto
                                        </span>
                                    </h5>
                                    <button type="button" class="close resetSubCategoria" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p class="small">Por favor ingrese los datos para agregar el producto: </p>
                                    <form id="formAgregarProducto">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group form-group-default">
                                                    <label>Nombre Producto</label>
                                                    <input id="nomProducto" name="nomProducto" type="text" class="form-control" placeholder="Ingerese nombre Producto">
                                                </div>
                                            </div>

                                            <div class="col-sm-12">
                                                <div class="form-group form-group-default">
                                                    <label>Categoria Producto</label>

                                                    <select name="idCategoria" id="idCategoria" class="form-control idCategoria">
                                                        <option value="0" selected>Seleccione Categoria</option>

                                                        <?php
                                                        foreach ($categorias as $rs) {
                                                            echo "<option value= '" . $rs['cat_codigo'] . "'>" . $rs['cat_descripcion'] . "</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-sm-12">
                                                <div class="form-group form-group-default">
                                                    <label>Subcategoria Producto</label>
                                                    
                                                    <select name="idSubCategoria"  id="idSubCategoria" class="form-control idSubCategoria" disabled>
                                                        <option value="0">Seleccione Categoria</option>

                                                    </select>
                                                </div>
                                            </div>

                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer no-bd">
                                    <button type="button" id="agregarProducto" data-url="<?php echo getUrl('producto', 'productobase', 'insertar', false, 'ajax'); ?>" class="btn btn-primary">Agregar</button>
                                    <button type="button" class="btn btn-danger resetSubCategoria" data-dismiss="modal">Cancelar</button>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- modal editar -->

                    <div class="modal fade" id="editarProductoModal" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header no-bd">
                                    <h5 class="modal-title">
                                        <span class="fw-mediumbold">
                                            Editar</span>
                                        <span class="fw-light">
                                            Maquina
                                        </span>
                                    </h5>
                                    <button type="button" class="close resetSubCategoria" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p class="small">Por favor ingrese los datos para actualizar la informacion de la maquina: </p>
                                    <form id="formEditarProducto">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-sm-8" style="text-align: right;">
                                                            <label>Codigo Producto</label>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <input id="editCodigoProducto" name="editCodigoProducto" type="text" class="form-control" style="text-align: right;" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group form-group-default">
                                                    <label>Nombre Producto</label>
                                                    <input id="editNomProducto" name="editNomProducto" type="text" class="form-control" placeholder="Ingerese nombre Maquina">
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group form-group-default">
                                                    <label>Categoria Producto</label>

                                                    <select name="idCategoria" 
                                                            class="form-control idCategoria"
                                                            >
                                                        <option value="0" selected>Seleccione Categoria</option>
                                                        
                                                        <?php
                                                            foreach ($categorias AS $rs){
                                                                echo "<option value= '".$rs['cat_codigo']."'>".$rs['cat_descripcion']."</option>";
                                                            }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-sm-12">
                                                <div class="form-group form-group-default">
                                                    <label>Subcategoria Producto</label>
                                                    <select name="idSubCategoria" 
                                                            class="form-control idSubCategoria"
                                                            disabled
                                                            >
                                                        <option value="0">Seleccione Categoria</option>
                                                            
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer no-bd">
                                    <button type="button" id="editarProducto" data-url="<?php echo getUrl('producto', 'productobase', 'editar', false, 'ajax'); ?>" class="btn btn-primary">Actualizar</button>
                                    <button type="button" class="btn btn-danger resetSubCategoria" data-dismiss="modal">Cancelar</button>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- Table -->
                    <div class="table-responsive">
                        <table id="tablaGestionarProducto" class="display table table-striped table-hover">

                            <thead>
                                <tr>
                                    <th>Codigo</th>
                                    <th>Producto</th>
                                    <th>Categoria</th>
                                    <th>Subcategoria</th>
                                    <th style="width: 10%">Acciones</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Codigo</th>
                                    <th>Producto</th>
                                    <th>Categoria</th>
                                    <th>Subcategoria</th>
                                    <th>Acciones</th>
                                </tr>
                            </tfoot>
                            <tbody>

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
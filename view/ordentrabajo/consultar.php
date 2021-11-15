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
                        <div class="card-title">Gestion Orden de trabajo</div>
                        <div class="card-tools">
                            <button class="btn btn-primary btn-round ml-auto" data-toggle="modal" data-target="#agregarOrdenTrabajoModal">
                                <i class="fa fa-plus"></i>
                                Agregar Orden de Trabajo
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body">

                    <!-- <div class="chart-container" style="min-height: 375px">
                        <canvas id="statisticsChart"></canvas>
                    </div>
                    <div id="myChartLegend"></div> -->
                    <div class="modal fade" id="agregarOrdenTrabajoModal" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header no-bd">
                                    <h5 class="modal-title">
                                        <span class="fw-mediumbold">
                                            Agregar</span>
                                        <span class="fw-light">
                                            Orden de Trabajo
                                        </span>
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p class="small">Por favor ingrese los datos para agregar la orden de trabajo: </p>
                                    <form id="formAgregarOrdenTrabajo">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group form-group-default">
                                                    <label>Identificador Orden de Trabajo</label>
                                                    <input id="idenOrdenTrabajo" name="idenOrdenTrabajo" type="text" class="form-control" placeholder="Ingrese identificador de la Orden de trabajo">
                                                    
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group form-group-default">
                                                    <label>SubCategoria Producto</label>
                                                    
                                                    <select name="otrSubCategoriaId" id="otrSubCategoriaId" class="form-control" 
                                                    data-url="<?php echo getUrl('ordentrabajo','ordentrabajo','filtroProductoCategoria',false,'ajax');?>">
                                                        <option value="0" selected>Seleccione Prodcuto</option>
                                                        <?php
                                                        foreach ($subCategoria as $srs) {
                                                            echo "<option value= '" . $srs['sub_codigo'] . "'>" . $srs['sub_descripcion'] . "</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group form-group-default">
                                                    <label>Nombre Producto</label>
                                                    <select name="otrIdProducto" id="otrIdProducto" class="form-control"
                                                    data-url="<?php echo getUrl('ordentrabajo','ordentrabajo','filtroDescripcion',false,'ajax');?>">
                                                        <option value="0" selected>Seleccione Prodcuto</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group shadow-textarea">
                                                    <label>Descripcion Producto</label>
                                                    
                                                    <textarea id="ortProdDescripcion" class="form-control z-depth-1" rows="6"  readonly 
                                                                style="overflow: scroll;"
                                                                placeholder="Descripcion del producto seleccionado..."></textarea>

                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer no-bd">
                                    <button type="button" id="agregarOrdenTrabajo" data-url="<?php echo getUrl('ordentrabajo', 'ordentrabajo', 'insertar', false, 'ajax'); ?>" class="btn btn-primary">Agregar</button>
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                                </div>
                            </div>
                        </div>
                    </div>



                    <!-- modal editar -->

                    <div class="modal fade" id="editarOrdenTrabajoModal" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header no-bd">
                                    <h5 class="modal-title">
                                        <span class="fw-mediumbold">
                                            Editar</span>
                                        <span class="fw-light">
                                            Orden de Trabajo
                                        </span>
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p class="small">Por favor ingrese los datos para actualizar la informacion de la orden de trabajo: </p>
                                    <form id="formEditarOrdenTrabajo">
                                        <div class="row">
                                        <div class="col-sm-12">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-sm-8" style="text-align: right;">
                                                        <label >Codigo Orden Trabajo</label>
                                                        </div>
                                                        <div class="col-sm-4" >
                                                        <input id="editCodigoOrdenTrabajo" name="editCodigoOrdenTrabajo" type="text" class="form-control" style="text-align: right;" readonly>        
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group form-group-default">
                                                    <label>Identificador Orden Trabajo</label>
                                                    <input id="editidenOrdenTrabajo" name="editidenOrdenTrabajo" type="text" class="form-control" placeholder="Ingrese identificador Maquina">
                                                </div>
                                            </div>
                                            <!-- SubCategoria -->
                                            <div class="col-sm-12">
                                                <div class="form-group form-group-default">
                                                    <label>SubCategoria Producto</label>
                                                    
                                                    <select name="editOtrSubCategoriaId" id="editOtrSubCategoriaId" class="form-control" 
                                                    data-url="<?php echo getUrl('ordentrabajo','ordentrabajo','filtroProductoCategoria',false,'ajax');?>">
                                                        <option value="0" selected>Seleccione Prodcuto</option>
                                                        <?php
                                                        foreach ($subCategoria as $srs) {
                                                            echo "<option value= '" . $srs['sub_codigo'] . "'>" . $srs['sub_descripcion'] . "</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group form-group-default">
                                                    <label>Nombre Producto</label>
                                                    <select name="editOtrIdProducto" id="editOtrIdProducto" class="form-control"
                                                    data-url="<?php echo getUrl('ordentrabajo','ordentrabajo','filtroDescripcion',false,'ajax');?>">
                                                        <option value="0" selected>Seleccione Prodcuto</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group shadow-textarea">
                                                    <label>Descripcion Producto</label>
                                                    
                                                    <textarea id="editOrtProdDescripcion" class="form-control z-depth-1" rows="6"  readonly 
                                                                style="overflow: scroll;"
                                                                placeholder="Descripcion del producto seleccionado..."></textarea>

                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer no-bd">
                                    <button type="button" id="editarOrdenTrabajo" data-url="<?php echo getUrl('ordentrabajo', 'ordentrabajo', 'editar', false, 'ajax'); ?>" class="btn btn-primary">Editar</button>
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- Table -->
                    <div class="table-responsive">
                        <table id="tablaGestionarOrdenTrabajo" class="display table table-striped table-hover">

                            <thead>
                                <tr>
                                    <th>Codigo</th>
                                    <th>Identificador OT</th>
                                    <th>Codigo Producto</th>
                                    <th>Nombre Producto</th>
                                    <th style="width: 10%">Acciones</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Codigo</th>
                                    <th>Identificador OT</th>
                                    <th>Codigo Producto</th>
                                    <th>Nombre Producto</th>
                                    <th>Acciones</th>
                                </tr>
                            </tfoot>
                            <tbody>

                                <?php
                                /*
                                foreach ($maquinas as $maq) {
                                    echo '<tr>';
                                    echo "<td>".$maq['maq_codigo']."</td>";
                                    echo "<td>".$maq['maq_identificador']."</td>";
                                    echo "<td>".$maq['maq_nombre']."</td>";

                                    echo '<td>
                                            <div class="form-button-action">
                                                <button type="button" data-toggle="tooltip" title=""
                                                    class="btn btn-link btn-primary btn-lg" data-original-title="Editar">
                                                    <i class="fa fa-edit"></i>
                                                </button>';

                                    // Ciclo para activar o desactivar maquinas
                                    if($maq['est_codigo']==1){
                                        echo '<button type="button" data-toggle="tooltip" title=""
                                                    class="btn btn-link btn-danger" data-original-title="Eliminar">
                                                    <i class="
                                                    fas fa-eye-slash"></i>
                                                </button>
                                            </div>';
                                    }else{
                                        echo '<button type="button" data-toggle="tooltip" title=""
                                                    class="btn btn-link btn-success" data-original-title="Habilitar">
                                                    <i class=" fas fa-eye"></i>
                                                </button>
                                            </div>';
                                    }
                                    echo '</td>';

                                }
                                */
                                ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>

    </div>
    
<!-- </div> -->
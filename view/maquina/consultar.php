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
                        <div class="card-title">Gestion de Maquina</div>
                        <div class="card-tools">
                            <button class="btn btn-primary btn-round ml-auto" data-toggle="modal" data-target="#agregarMaquinaModal">
                                <i class="fa fa-plus"></i>
                                Agregar Maquina
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body">

                    <!-- <div class="chart-container" style="min-height: 375px">
                        <canvas id="statisticsChart"></canvas>
                    </div>
                    <div id="myChartLegend"></div> -->
                    <div class="modal fade" id="agregarMaquinaModal" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header no-bd">
                                    <h5 class="modal-title">
                                        <span class="fw-mediumbold">
                                            Agregar</span>
                                        <span class="fw-light">
                                            Maquina
                                        </span>
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p class="small">Por favor ingrese los datos para agregar la maquina: </p>
                                    <form id="formAgregarMaquina">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group form-group-default">
                                                    <label>Identificador Maquina</label>
                                                    <input id="idenMaquina" name="idenMaquina" type="text" class="form-control" placeholder="Ingrese identificador Maquina">
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group form-group-default">
                                                    <label>Nombre Maquina</label>
                                                    <input id="nomMaquina" name="nomMaquina" type="text" class="form-control" placeholder="Ingerese nombre Maquina">
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer no-bd">
                                    <button type="button" id="agregarMaquina" data-url="<?php echo getUrl('maquina', 'maquina', 'insertar', false, 'ajax'); ?>" class="btn btn-primary">Agregar</button>
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                                </div>
                            </div>
                        </div>
                    </div>



                    <!-- modal editar -->

                    <div class="modal fade" id="editarMaquinaModal" tabindex="-1" role="dialog" aria-hidden="true">
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
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p class="small">Por favor ingrese los datos para actualizar la informacion de la maquina: </p>
                                    <form id="formEditarMaquina">
                                        <div class="row">
                                        <div class="col-sm-12">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-sm-8" style="text-align: right;">
                                                        <label >Codigo Maquina</label>
                                                        </div>
                                                        <div class="col-sm-4" >
                                                        <input id="editCodigoMaquina" name="editCodigoMaquina" type="text" class="form-control" style="text-align: right;" readonly>        
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group form-group-default">
                                                    <label>Identificador Maquina</label>
                                                    <input id="editIdenMaquina" name="editIdenMaquina" type="text" class="form-control" placeholder="Ingrese identificador Maquina">
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group form-group-default">
                                                    <label>Nombre Maquina</label>
                                                    <input id="editNomMaquina" name="editNomMaquina" type="text" class="form-control" placeholder="Ingerese nombre Maquina">
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer no-bd">
                                    <button type="button" id="editarMaquina" data-url="<?php echo getUrl('maquina', 'maquina', 'editar', false, 'ajax'); ?>" class="btn btn-primary">Agregar</button>
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- Table -->
                    <div class="table-responsive">
                        <table id="tablaGestionarMaquina" class="display table table-striped table-hover">

                            <thead>
                                <tr>
                                    <th>Codigo</th>
                                    <th>Identificador</th>
                                    <th>Nombre</th>
                                    <th style="width: 10%">Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Codigo</th>
                                    <th>Identificador</th>
                                    <th>Nombre</th>
                                    <th>Action</th>
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
    <div class="row mt--2">
        <div class="col-md-6">
            <div class="card full-height">
                <div class="card-body">
                    <div class="card-title">Estadisticas del sistema</div>
                    <div class="card-category">
                        Informacion diaria sobre estadisticas en el sistema.
                    </div>
                    <div class="d-flex flex-wrap justify-content-around pb-2 pt-4">
                        <div class="px-2 pb-2 pb-md-0 text-center">
                            <div id="circles-1"></div>
                            <h6 class="fw-bold mt-3 mb-0">Usuarios trabajando</h6>
                        </div>
                        <div class="px-2 pb-2 pb-md-0 text-center">
                            <div id="circles-2"></div>
                            <h6 class="fw-bold mt-3 mb-0">Ordenes en sistema</h6>
                        </div>
                        <div class="px-2 pb-2 pb-md-0 text-center">
                            <div id="circles-3"></div>
                            <h6 class="fw-bold mt-3 mb-0">Maquinaria en operacion</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card full-height">
                <div class="card-body">
                    <div class="card-title">
                        Pendiente - Total income & spend statistics
                    </div>
                    <div class="row py-3">
                        <div class="col-md-4 d-flex flex-column justify-content-around">
                            <div>
                                <h6 class="fw-bold text-uppercase text-success op-8">
                                    Total Income
                                </h6>
                                <h3 class="fw-bold">$9.782</h3>
                            </div>
                            <div>
                                <h6 class="fw-bold text-uppercase text-danger op-8">
                                    Total Spend
                                </h6>
                                <h3 class="fw-bold">$1,248</h3>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div id="chart-container">
                                <canvas id="totalIncomeChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




</div>
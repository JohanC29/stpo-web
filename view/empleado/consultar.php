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
                        <div class="card-title">Gestion de Colaborador</div>
                        <div class="card-tools">
                            <button class="btn btn-primary btn-round ml-auto" data-toggle="modal" data-target="#agregarEmpleadoModal">
                                <i class="fa fa-plus"></i>
                                Agregar Colaborador
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body">

                    <!-- <div class="chart-container" style="min-height: 375px">
                        <canvas id="statisticsChart"></canvas>
                    </div>
                    <div id="myChartLegend"></div> -->
                    <div class="modal fade" id="agregarEmpleadoModal" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header no-bd">
                                    <h5 class="modal-title">
                                        <span class="fw-mediumbold">
                                            Agregar</span>
                                        <span class="fw-light">
                                            Colaborador
                                        </span>
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="limpiarCampoEmpleado()">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p class="small">Por favor ingrese los datos para agregar el colaborador: </p>
                                    <form id="formAgregarEmpleado">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group form-group-default">
                                                    <label>No. Identificacion Colaborador</label>
                                                    <input id="idenEmpleado" name="idenEmpleado" type="number" class="form-control" placeholder="Ingrese No. Identificacion del colaborador">
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group form-group-default">
                                                    <label>Nombres Colaborador</label>
                                                    <input id="nomEmpleado" name="nomEmpleado" type="text" class="form-control" placeholder="Ingerese nombres colaborador">
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group form-group-default">
                                                    <label>Apellidos Colaborador</label>
                                                    <input id="apeEmpleado" name="apeEmpleado" type="text" class="form-control" placeholder="Ingrese apellidos colaborador">
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group form-group-default">
                                                    <label>Cargo Colaborador</label>
                                                    <input id="carEmpleado" name="carEmpleado" type="text" class="form-control" placeholder="Ingrese cargo colaborador">
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer no-bd">
                                    <button type="button" id="agregarEmpleado" data-url="<?php echo getUrl('empleado', 'empleado', 'insertar', false, 'ajax'); ?>" class="btn btn-primary">Agregar</button>
                                    <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="limpiarCampoEmpleado()">Cancelar</button>
                                </div>
                            </div>
                        </div>
                    </div>



                    <!-- modal editar -->

                    <div class="modal fade" id="editarEmpleadoModal" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header no-bd">
                                    <h5 class="modal-title">
                                        <span class="fw-mediumbold">
                                            Editar</span>
                                        <span class="fw-light">
                                            Colaborador
                                        </span>
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p class="small">Por favor ingrese los datos para actualizar la informacion del colaborador: </p>
                                    <form id="formEditarEmpleado">
                                        <div class="row">
                                        <div class="col-sm-12">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-sm-8" style="text-align: right;">
                                                        <label >Codigo Colaborador</label>
                                                        </div>
                                                        <div class="col-sm-4" >
                                                        <input id="editCodigoEmpleado" name="editCodigoEmpleado" type="text" class="form-control" style="text-align: right;" readonly>        
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group form-group-default">
                                                    <label>No. Identificacion Colaborador</label>
                                                    <input id="editIdenEmpleado" name="editIdenEmpleado" type="text" class="form-control" placeholder="Ingrese identificador Maquina">
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group form-group-default">
                                                    <label>Nombres Colaborador</label>
                                                    <input id="editNomEmpleado" name="editNomEmpleado" type="text" class="form-control" placeholder="Ingerese nombre Maquina">
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group form-group-default">
                                                    <label>Apellidos Colaboradr</label>
                                                    <input id="editApeEmpleado" name="editApeEmpleado" type="text" class="form-control" placeholder="Ingerese nombre Maquina">
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group form-group-default">
                                                    <label>Cargo Colaborador</label>
                                                    <input id="editCarEmpleado" name="editCarEmpleado" type="text" class="form-control" placeholder="Ingerese nombre Maquina">
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer no-bd">
                                    <button type="button" id="editarEmpleado" data-url="<?php echo getUrl('empleado', 'empleado', 'editar', false, 'ajax'); ?>" class="btn btn-primary">Actualizar</button>
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- Table -->
                    <div class="table-responsive">
                        <table id="tablaGestionarEmpleado" class="display table table-striped table-hover">

                            <thead>
                                <tr>
                                    <th>Codigo</th>
                                    <th>Identificacion</th>
                                    <th>Nombre</th>
                                    <th>Apellido</th>
                                    <th>Cargo</th>
                                    <th style="width: 10%">Acciones</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Codigo</th>
                                    <th>Identificacion</th>
                                    <th>Nombre</th>
                                    <th>Apellido</th>
                                    <th>Cargo</th>
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
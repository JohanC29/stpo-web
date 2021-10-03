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
                        <div class="card-title">Consultar de proceso</div>
                        <div class="card-tools">
                            <!-- <button class="btn btn-primary btn-round ml-auto" data-toggle="modal" data-target="#agregarProcesoModal">
                                <i class="fa fa-plus"></i>
                                Agregar Proceso
                            </button> -->
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Campo de consulta -->
                        <div class="col-md-8">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Identificador Proceso</label>
                                    <input id="idenProcesoA" name="idenProcesoA" type="text" class="form-control"
                                        placeholder="Ingrese identificador Proceso">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Nombre Proceso</label>
                                        <select name="idCodigoProceso" id="idCodigoProceso" class="form-control">
                                            <option value="0" selected>Seleccione Proceso</option>
                                            <?php
                                            foreach ($procesos as $rs) {
                                                echo "<option value= '" . $rs['pro_codigo'] . "'>" . $rs['pro_nombre'] . "</option>";
                                            }
                                            ?>
                                        </select>
                                        
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <div class="row align-items-end align-self-end" style="margin-right: 50px;">
                        <!-- Botones de accion -->
                        <div class="ml-md-auto py-2 py-md-0 ">
                            <button class="btn btn-danger" id="limpiar">Limpiar</button>
                            <!-- <a href="#" class="btn btn-danger">Limpiar</a> -->
                            <button class="btn btn-success" id="consultar">Consultar</button>
                            <!-- <a href="#" class="btn btn-success" id="consultar">Consultar</a> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-head-row">
                        <div class="card-title">Asignacion de maquinas</div>
                        <div class="card-tools">
                            <button class="btn btn-primary btn-round ml-auto" data-toggle="modal"
                                data-target="#agregarAsignacionMaquinaModal">
                                <i class="fa fa-plus"></i>
                                Asociar Maquina
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <!-- modal agegar Maquina -->
                    <div class="modal fade" id="agregarAsignacionMaquinaModal" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header no-bd">
                                    <h5 class="modal-title">
                                        <span class="fw-mediumbold">
                                            Agregar</span>
                                        <span class="fw-light">
                                            Asignación
                                        </span>
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    
                                    <p class="small">Por favor ingrese los datos para asociar la maquina: </p>
                                    <form id="formAsociarMaquina">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label>Codigo Proceso</label>
                                                    <input type="number" id="pmidCodigo" hidden value="0">
                                                    <input id="pmIdCodigoNombreProceso" name="pmIdCodigoNombreProceso" type="text" value="001-Proceso Prueba"
                                                        class="form-control"
                                                        readonly>
                                                </div>
                                            </div>
                                            
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label>Codigo Maquina</label>
                                                    <input id="pmIdCodigoMaquina" name="pmIdCodigoMaquina" type="number" value="0"
                                                        class="form-control"
                                                        readonly>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group form-group-default">
                                                    <label>Nombre Maquina</label>
                                                        <select name="pmIdCodigoMaquinaSelect" id="pmIdCodigoMaquinaSelect" class="form-control">
                                                            <option value="0" selected>Seleccione Maquina</option>
                                                            <?php
                                                            foreach ($maquinas as $mrs) {
                                                                echo "<option value= '" . $mrs['maq_codigo'] . "'>" . $mrs['maq_nombre'] . "</option>";
                                                            }
                                                            ?>
                                                        </select>


                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer no-bd">
                                    <button type="button" id="agregarAsignacionMaquina"
                                        data-url="<?php echo getUrl('procesos', 'procesos', 'insertarMaquinaProceso', false, 'ajax'); ?>"
                                        class="btn btn-primary">Agregar</button>
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- <?php echo getUrl("costos","cotizacion","insertDetalleCotizacion",array('Ped_id' =>'hola','Ped_id2' =>'hola2'));?> -->


                    <!-- Table -->
                    <div class="table-responsive">
                        <table id="tablaDetalleProcesoMaquina" class="display table table-striped table-hover">
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

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>
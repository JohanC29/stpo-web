<div class="panel-header bg-primary-gradient">
    <div class="page-inner py-5">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
            <div>
                <h2 class="text-white pb-2 fw-bold">Bienvenido,</h2>
                <h5 class="text-white op-7 mb-2">
                    Buen dia <strong>Johan Muelas</strong>
                </h5>
            </div>
        </div>
    </div>
</div>

<div class="page-inner mt--5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-head-row">
                        <div class="card-title">Consultar por Orden de trabajo</div>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Input de consulta -->
                    <div class="row">

                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="inputOrdenTrabajo">Orden de Trabajo</label>
                                        <div class="input-group">
                                            <input type="number" class="form-control" id="inputOrdenTrabajo"
                                                placeholder="Ingrese la orden de trabajo"
                                                aria-describedby="basic-addon1">
                                            <div class="input-group-prepend">
                                                <button id="btnConsultarSotr" class="btn btn-success" type="button"
                                                    data-info="<?php echo getUrl('seguimiento', 'seguimiento', 'consultInfoOt', false, 'ajax'); ?>"
                                                    data-grafi="<?php echo getUrl('seguimiento', 'seguimiento', 'circlesOt', false, 'ajax'); ?>">Consultar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-6">

                                    <div class="form-group">
                                        <h5 class="fw-bold">Categoria: </h5>
                                        <h5 id="sotrCategoria"></h5>
                                    </div>

                                    <div class="form-group">
                                        <h5 class="fw-bold">Producto: </h5>
                                        <h5 id="sotrProducto"></h5>
                                    </div>

                                    <div class="form-group">
                                        <h5 class="fw-bold">Descripción: </h5>
                                        <h5 id="sotrDescripcion"></h5>
                                    </div>


                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <h5 class="fw-bold">Sub Categoria: </h5>
                                        <h5 id="sotrSubCategoria"></h5>
                                    </div>



                                    <div class="form-group">
                                        <h5 class="fw-bold">Fecha Creacion de la orden: </h5>
                                        <h5 id="sotrFechaCrea"></h5>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <!-- Grafica de la cantidad ejecutada -->
                            <div class="card full-height">
                                <div class="card-body">
                                    <div class="card-title">Estadisticas de la Ot</div>
                                    <div class="card-category">
                                        Informacion sobre el estado de cumplimiento de la orden.
                                    </div>
                                    <div class="d-flex flex-wrap justify-content-around pb-2 pt-4">
                                        <div class="px-2 pb-2 pb-md-0 text-center">
                                            <div id="circlesOt"></div>
                                            <!-- <h6 class="fw-bold mt-3 mb-0">Usuarios trabajando</h6> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- Table -->
                    <div class="table-responsive">
                        <div class="form-group">
                            <div class="separator-dashed"></div>
                            <h2>Seguimiento registratos</h2>
                        </div>

                        <table id="tablaGestionarSeguimientoPorOt" class="display table table-striped table-hover"
                            cellspacing="0" width="2000px">
                            <thead>
                                <tr>
                                    <th>Codigo</th>
                                    <th>Id Empelado</th>
                                    <th>Nombre Colaborador</th>
                                    <th>Apellido Colaborador</th>
                                    <th>Id Proceso</th>
                                    <th style="width: 100px">Proceso</th>
                                    <th>Id Maquina</th>
                                    <th>Maquina</th>
                                    <th>Fecha Inicio</th>
                                    <th>Fecha Terminado</th>
                                    <th>Tiempo Ejecucion</th>
                                    <th>Cantidad Fabricada</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Codigo</th>
                                    <th>Id Empelado</th>
                                    <th>Nombre Colaborador</th>
                                    <th>Apellido Colaborador</th>
                                    <th>Id Proceso</th>
                                    <th>Proceso</th>
                                    <th>Id Maquina</th>
                                    <th>Maquina</th>
                                    <th>Fecha Inicio</th>
                                    <th>Fecha Terminado</th>
                                    <th>Tiempo Ejecucion</th>
                                    <th>Cantidad Fabricada</th>
                                    <th>Estado</th>
                                </tr>
                            </tfoot>
                            <tbody>

                            </tbody>
                        </table>
                    </div>



                    <!-- Table -->
                    <!-- <div class="table-responsive">
                        <div class="form-group">
                            <div class="separator-dashed"></div>
                            <h2>Seguimiento registratos</h2>
                        </div>

                        <table id="tablaGestionarSeguimientoPorOt" class="display table table-striped table-hover"
                            cellspacing="0" width="2000px">
                            <thead>
                                <tr>
                                    <th>Codigo</th>
                                    <th>Id Empelado</th>
                                    <th>Nombre Colaborador</th>
                                    <th>Apellido Colaborador</th>
                                    <th>Id Proceso</th>
                                    <th style="width: 100px">Proceso</th>
                                    <th>Id Maquina</th>
                                    <th>Maquina</th>
                                    <th>Fecha Inicio</th>
                                    <th>Fecha Terminado</th>
                                    <th>Tiempo Ejecucion</th>
                                    <th>Cantidad Fabricada</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Codigo</th>
                                    <th>Id Empelado</th>
                                    <th>Nombre Colaborador</th>
                                    <th>Apellido Colaborador</th>
                                    <th>Id Proceso</th>
                                    <th>Proceso</th>
                                    <th>Id Maquina</th>
                                    <th>Maquina</th>
                                    <th>Fecha Inicio</th>
                                    <th>Fecha Terminado</th>
                                    <th>Tiempo Ejecucion</th>
                                    <th>Cantidad Fabricada</th>
                                    <th>Estado</th>
                                </tr>
                            </tfoot>
                            <tbody>

                            </tbody>
                        </table>
                    </div> -->
                    <!-- final tabla -->

                </div>
            </div>
        </div>
    </div>







    <!-- </div> -->
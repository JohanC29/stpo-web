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
                            <button class="btn btn-primary btn-round ml-auto" data-toggle="modal" data-target="#agregarProductoModal">
                                <i class="fa fa-plus"></i>
                                Agregar Proceso
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
                                                    <input id="idenMaquina" name="idenMaquina" type="text"
                                                        class="form-control"
                                                        placeholder="Ingrese identificador Maquina">
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group form-group-default">
                                                    <label>Nombre Maquina</label>
                                                    <input id="nomMaquina" name="nomMaquina" type="text"
                                                        class="form-control" placeholder="Ingerese nombre Maquina">
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer no-bd">
                                    <button type="button" id="agregarMaquina"
                                        data-url="<?php echo getUrl('maquina', 'maquina', 'insertar', false, 'ajax'); ?>"
                                        class="btn btn-primary">Agregar</button>
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>
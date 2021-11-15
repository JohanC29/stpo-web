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
                        Estadistica de OT semanal
                    </div>
                    <div class="row py-3">
                        <div class="col-md-4 d-flex flex-column justify-content-around">
                            <div>
                                <h6 class="fw-bold text-uppercase text-success op-8">
                                    Total Ordenes de Trabajo
                                </h6>
                                <h3 class="fw-bold" id="charTotalOt">&nbsp;</h3>
                            </div>
                            <!-- <div>
                                <h6 class="fw-bold text-uppercase text-danger op-8">
                                    Total Spend
                                </h6>
                                <h3 class="fw-bold">2 veces</h3>
                            </div> -->
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


    <div class="row">
        <div class="col-md-6">
            <div class="card full-height">
                <div class="card-header">
                    <div class="card-title">Proceso Ordenes de trabajo</div>
                    <div class="card-tools">
                        <ul class="nav nav-pills nav-secondary nav-pills-no-bd nav-sm" id="pills-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="pills-today" data-toggle="pill" href="#pills-today"
                                    role="tab" aria-selected="true">Ultimos 30 dias</a>
                            </li>
                            <!-- <li class="nav-item">
                                    <a class="nav-link active" id="pills-week" data-toggle="pill" href="#pills-week"
                                        role="tab" aria-selected="false">Week</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-month" data-toggle="pill" href="#pills-month"
                                        role="tab" aria-selected="false">Month</a>
                                </li> -->
                        </ul>
                    </div>
                </div>
                <div class="card-body scrollCard" id="homeActividadOrdenTrabajo" style="max-height: 430px">
                    <div class="" style="
                            padding-left: 40%;
                            padding-top: 10%;">
                        <div class="lds-ring">
                            <div></div>
                            <div></div>
                            <div></div>
                            <div></div>
                        </div>
                    </div>
                    <br />
                    <h5 class="text-center op-7 mb-2">Cargando información...</h5>
                    <!-- inicio -->
                    <!-- <ol class="activity-feed">
                            <li class="feed-item feed-item-secondary">
                                <time class="date" datetime="4-10">Abril 10</time>
                                <span class="text">Responded to need
                                    <a href="#">"Volunteer opportunity"</a></span><br/>
                                    <span class="text">Responded to need
                                    <a href="#">"Volunteer opportunity"</a></span><br/>
                                    <span class="text">Responded to need
                                    <a href="#">"Volunteer opportunity"</a></span><br/>
                                    <span class="text">Responded to need
                                    <a href="#">"Volunteer opportunity"</a></span><br/>
                            </li>
                            <li class="feed-item feed-item-success">
                                <time class="date" datetime="9-24">Sep 24</time>
                                <span class="text">Added an interest
                                    <a href="#">"Volunteer Activities"</a></span>
                            </li>
                            <li class="feed-item feed-item-info">
                                <time class="date" datetime="9-23">Sep 23</time>
                                <span class="text">Joined the group
                                    <a href="single-group.php">"Boardsmanship Forum"</a></span>
                            </li>
                            <li class="feed-item feed-item-warning">
                                <time class="date" datetime="9-21">Sep 21</time>
                                <span class="text">Responded to need
                                    <a href="#">"In-Kind Opportunity"</a></span>
                            </li>
                            <li class="feed-item feed-item-danger">
                                <time class="date" datetime="9-18">Sep 18</time>
                                <span class="text">Created need
                                    <a href="#">"Volunteer Opportunity"</a></span>
                            </li>
                            <li class="feed-item">
                                <time class="date" datetime="9-17">Sep 17</time>
                                <span class="text">Attending the event
                                    <a href="single-event.php">"Some New Event"</a></span>
                            </li>
                        </ol> -->
                    <!-- final -->
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card full-height">
                <div class="card-header">
                    <div class="card-head-row">
                        <div class="card-title">Actividad Colaboradores</div>
                        <div class="card-tools">
                            <ul class="nav nav-pills nav-secondary nav-pills-no-bd nav-sm" id="pills-tab"
                                role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="pills-today" data-toggle="pill" href="#pills-today"
                                        role="tab" aria-selected="true">Hoy</a>
                                </li>
                                <!-- <li class="nav-item">
                                        <a class="nav-link active" id="pills-week" data-toggle="pill" href="#pills-week"
                                            role="tab" aria-selected="false">Week</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="pills-month" data-toggle="pill" href="#pills-month"
                                            role="tab" aria-selected="false">Month</a>
                                    </li> -->
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card-body scrollCard" id="homeActividadUsuario" style="max-height: 430px">
                    <div class="" style="
                        padding-left: 40%;
                        padding-top: 10%;">
                        <div class="lds-ring">
                            <div></div>
                            <div></div>
                            <div></div>
                            <div></div>
                        </div>
                    </div>
                    <br />
                    <h5 class="text-center op-7 mb-2">Cargando información...</h5>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-head-row">
                        <div class="card-title">Historial Orden de trabajo</div>
                        <div class="card-tools">
                            <!-- <a href="#" class="btn btn-info btn-border btn-round btn-sm mr-2">
                                <span class="btn-label">
                                    <i class="fa fa-pencil"></i>
                                </span>
                                Export
                            </a>
                            <a href="#" class="btn btn-info btn-border btn-round btn-sm">
                                <span class="btn-label">
                                    <i class="fa fa-print"></i>
                                </span>
                                Print
                            </a> -->
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart-container" style="min-height: 375px">
                        <canvas id="statisticsChart"></canvas>
                    </div>
                    <div id="myChartLegend"></div>
                </div>
            </div>
        </div>
    </div>
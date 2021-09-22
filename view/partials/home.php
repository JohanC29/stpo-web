


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
                                Estadistica de uso
                            </div>
                            <div class="row py-3">
                                <div class="col-md-4 d-flex flex-column justify-content-around">
                                    <div>
                                        <h6 class="fw-bold text-uppercase text-success op-8">
                                            Total Income
                                        </h6>
                                        <h3 class="fw-bold">9 veces</h3>
                                    </div>
                                    <div>
                                        <h6 class="fw-bold text-uppercase text-danger op-8">
                                            Total Spend
                                        </h6>
                                        <h3 class="fw-bold">2 veces</h3>
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
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-head-row">
                                <div class="card-title">Estidistica de maquinaria</div>
                                <div class="card-tools">
                                    <a href="#" class="btn btn-info btn-border btn-round btn-sm mr-2">
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
                                    </a>
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
                <div class="col-md-4">
                    <div class="card card-primary">
                        <div class="card-header">
                            <div class="card-title">Fecha de instalacion</div>
                            <div class="card-category">Septiembre 11 </div>
                        </div>
                        <div class="card-body pb-0">
                            <div class="mb-4 mt-2">
                                <h1>15 veces</h1>
                            </div>
                            <div class="pull-in">
                                <canvas id="dailySalesChart"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body pb-0">
                            <div class="h1 fw-bold float-right text-warning">+7%</div>
                            <h2 class="mb-2">213</h2>
                            <p class="text-muted">Transactions</p>
                            <div class="pull-in sparkline-fix">
                                <div id="lineChart"></div>
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
                        </div>
                        <div class="card-body">
                            <ol class="activity-feed">
                                <li class="feed-item feed-item-secondary">
                                    <time class="date" datetime="4-10">Abril 10</time>
                                    <span class="text">Responded to need
                                        <a href="#">"Volunteer opportunity"</a></span>
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
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card full-height">
                        <div class="card-header">
                            <div class="card-head-row">
                                <div class="card-title">Actividad Usiarios</div>
                                <div class="card-tools">
                                    <ul class="nav nav-pills nav-secondary nav-pills-no-bd nav-sm" id="pills-tab"
                                        role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link" id="pills-today" data-toggle="pill" href="#pills-today"
                                                role="tab" aria-selected="true">Today</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link active" id="pills-week" data-toggle="pill"
                                                href="#pills-week" role="tab" aria-selected="false">Week</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="pills-month" data-toggle="pill" href="#pills-month"
                                                role="tab" aria-selected="false">Month</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="avatar avatar-online">
                                    <span class="avatar-title rounded-circle border border-white bg-info">J</span>
                                </div>
                                <div class="flex-1 ml-3 pt-1">
                                    <h6 class="text-uppercase fw-bold mb-1">
                                        Joko Subianto
                                        <span class="text-warning pl-3">iniciada pendiente</span>
                                    </h6>
                                    <span class="text-muted">Ot 1231231. Pendiente cantidad 5 proceso corte. maquinaria
                                        guillotina No 2.</span>
                                </div>
                                <div class="float-right pt-1">
                                    <small class="text-muted">8:40 AM</small>
                                </div>
                            </div>
                            <div class="separator-dashed"></div>
                            <div class="d-flex">
                                <div class="avatar avatar-offline">
                                    <span class="avatar-title rounded-circle border border-white bg-secondary">P</span>
                                </div>
                                <div class="flex-1 ml-3 pt-1">
                                    <h6 class="text-uppercase fw-bold mb-1">
                                        Prabowo Widodo
                                        <span class="text-success pl-3">ot iniciada</span>
                                    </h6>
                                    <span class="text-muted">OT 52923121. Cantidad 10. Proceso fresado. Maquinaria
                                        Fresadora R-4.</span>
                                </div>
                                <div class="float-right pt-1">
                                    <small class="text-muted">8:20 AM</small>
                                </div>
                            </div>
                            <div class="separator-dashed"></div>
                            <div class="d-flex">
                                <div class="avatar avatar-away">
                                    <span class="avatar-title rounded-circle border border-white bg-danger">L</span>
                                </div>
                                <div class="flex-1 ml-3 pt-1">
                                    <h6 class="text-uppercase fw-bold mb-1">
                                        Lee Chong Wei
                                        <span class="text-muted pl-3">ot terminada</span>
                                    </h6>
                                    <span class="text-muted">OT 16323912. Cantidad 1000. Proceso embalaje. Maquinaria
                                        ninguna.</span>
                                </div>
                                <div class="float-right pt-1">
                                    <small class="text-muted">8:07 AM</small>
                                </div>
                            </div>
                            <div class="separator-dashed"></div>
                            <div class="d-flex">
                                <div class="avatar avatar-offline">
                                    <span class="avatar-title rounded-circle border border-white bg-secondary">P</span>
                                </div>
                                <div class="flex-1 ml-3 pt-1">
                                    <h6 class="text-uppercase fw-bold mb-1">
                                        Peter Parker
                                        <span class="text-success pl-3">ot iniciada</span>
                                    </h6>
                                    <span class="text-muted">OT 343291. Cantidad 65. Proceso Corte. Maquinaria
                                        Guillotina N 1.</span>
                                </div>
                                <div class="float-right pt-1">
                                    <small class="text-muted">8:01 AM</small>
                                </div>
                            </div>
                            <div class="separator-dashed"></div>
                            <div class="d-flex">
                                <div class="avatar avatar-away">
                                    <span class="avatar-title rounded-circle border border-white bg-danger">L</span>
                                </div>
                                <div class="flex-1 ml-3 pt-1">
                                    <h6 class="text-uppercase fw-bold mb-1">
                                        Logan Paul <span class="text-muted pl-3">ot terminada</span>
                                    </h6>
                                    <span class="text-muted">OT 8723161. Cantidad 42. Proceso Embalaje. Maquinaria
                                        Ninguna. </span>
                                </div>
                                <div class="float-right pt-1">
                                    <small class="text-muted">4:58 PM</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



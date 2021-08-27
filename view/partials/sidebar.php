		<!-- Sidebar -->
		<div class="sidebar sidebar-style-2">
			<div class="sidebar-wrapper scrollbar scrollbar-inner">
				<div class="sidebar-content">
					<ul class="nav nav-primary">
						<li class="nav-item active">
							<a data-toggle="collapse" href="#dashboard" class="collapsed" aria-expanded="false">
								<i class="fas fa-home"></i>
								<p>Dashboard</p>
								<span class="caret"></span>
							</a>
							<div class="collapse" id="dashboard">
								<ul class="nav nav-collapse">
									<li>
										<a href="">
											<span class="sub-item">Dashboard 1</span>
										</a>
									</li>
									<!-- <li>
										<a href="../demo2/index.html">
											<span class="sub-item">Dashboard 2</span>
										</a>
									</li> -->
								</ul>
							</div>
						</li>

						<li class="nav-section">
							<span class="sidebar-mini-icon">
								<i class="fa fa-ellipsis-h"></i>
							</span>
							<h4 class="text-section">Modulos</h4>
						</li>

						<li class="nav-item">
							<a data-toggle="collapse" href="#OT">
								<i class="fas fa-layer-group"></i>
								<p>Orden Trabajo</p>
								<span class="caret"></span>
							</a>
							<div class="collapse" id="OT">
								<ul class="nav nav-collapse">
									<li>
										<a href="">
											<span class="sub-item">Orden Trabajo</span>
										</a>
									</li>
									<li>
										<a href="">
											<span class="sub-item">Consultar</span>
										</a>
									</li>
								</ul>
							</div>
						</li>
						<li class="nav-item">
							<a data-toggle="collapse" href="#producto">
								<i class="fas fa-layer-group"></i>
								<p>Producto</p>
								<span class="caret"></span>
							</a>
							<div class="collapse" id="producto">
								<ul class="nav nav-collapse">
									<li>
										<a href="<?php echo getUrl("producto","proyecto","consult");?>">
											<span class="sub-item">Proyecto</span>
										</a>
									</li>
									<li>
										<a href="<?php echo getUrl("producto","productobase","consult");?>">
											<span class="sub-item">Producto Base</span>
										</a>
									</li>
								</ul>
							</div>
						</li>
						<li class="nav-item">
							<a data-toggle="collapse" href="#procesos">
								<i class="fas fa-layer-group"></i>
								<p>Procesos</p>
								<span class="caret"></span>
							</a>
							<div class="collapse" id="procesos">
								<ul class="nav nav-collapse">
									<li>
										<a href="<?php echo getUrl("procesos","procesos","consult");?>">
											<span class="sub-item">Gestionar proceso</span>
										</a>
									</li>
									<!-- <li>
										<a href="">
											<span class="sub-item">Gestionar Base</span>
										</a>
									</li> -->
								</ul>
							</div>
						</li>
						<li class="nav-item">
							<a data-toggle="collapse" href="#maquina">
								<i class="fas fa-layer-group"></i>
								<p>Maquina</p>
								<span class="caret"></span>
							</a>
							<div class="collapse" id="maquina">
								<ul class="nav nav-collapse">
									<li>
										<a href="<?php echo getUrl("maquina","maquina","consult");?>">
											<span class="sub-item">Gestionar maquina</span>
										</a>
									</li>
									<!-- <li>
										<a href="">
											<span class="sub-item">Gestionar Base</span>
										</a>
									</li> -->
								</ul>
							</div>
						</li>

						<li class="nav-section">
							<span class="sidebar-mini-icon">
								<i class="fa fa-ellipsis-h"></i>
							</span>
							<h4 class="text-section">Panel Control</h4>
						</li>

						<li class="nav-item">
							<a data-toggle="collapse" href="#usuarios">
								<i class="fas fa-layer-group"></i>
								<p>Usuarios</p>
								<span class="caret"></span>
							</a>
							<div class="collapse" id="usuarios">
								<ul class="nav nav-collapse">
									<li>
										<a href="">
											<span class="sub-item">Gestionar Usuarios</span>
										</a>
									</li>
									<!-- <li>
										<a href="">
											<span class="sub-item">Gestionar Base</span>
										</a>
									</li> -->
								</ul>
							</div>
						</li>
						<li class="nav-item">
							<a data-toggle="collapse" href="#notificaciones">
								<i class="fas fa-layer-group"></i>
								<p>Notificaciones</p>
								<!-- <span class="caret"></span> -->
							</a>
						</li>
						<!-- Fin tesis -->
					</ul>
				</div>
			</div>
		</div>
		<!-- End Sidebar -->
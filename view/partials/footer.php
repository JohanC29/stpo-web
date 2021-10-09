
<footer class="footer">
				<div class="container-fluid">
					<nav class="pull-left">
						<ul class="nav">
							<li class="nav-item">
								<a class="nav-link" href="">
									Universidad Cooperativa de Colombia
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="#"> Help </a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="#"> Licenses </a>
							</li>
						</ul>
					</nav>
					<div class="copyright ml-auto">
						2021, made with <i class="fa fa-heart heart text-success"></i> by
						<a href="">UCC</a>
					</div>
				</div>
			</footer>
		</div>

		<!-- Custom template | don't include it in your project! -->
		<div class="custom-template">
			<div class="title">Settings</div>
			<div class="custom-content">
				<div class="switcher">
					<div class="switch-block">
						<h4>Logo Header</h4>
						<div class="btnSwitch">
							<button type="button" class="changeLogoHeaderColor" data-color="dark"></button>
							<button type="button" class="selected changeLogoHeaderColor" data-color="blue"></button>
							<button type="button" class="changeLogoHeaderColor" data-color="purple"></button>
							<button type="button" class="changeLogoHeaderColor" data-color="light-blue"></button>
							<button type="button" class="changeLogoHeaderColor" data-color="green"></button>
							<button type="button" class="changeLogoHeaderColor" data-color="orange"></button>
							<button type="button" class="changeLogoHeaderColor" data-color="red"></button>
							<button type="button" class="changeLogoHeaderColor" data-color="white"></button>
							<br />
							<button type="button" class="changeLogoHeaderColor" data-color="dark2"></button>
							<button type="button" class="changeLogoHeaderColor" data-color="blue2"></button>
							<button type="button" class="changeLogoHeaderColor" data-color="purple2"></button>
							<button type="button" class="changeLogoHeaderColor" data-color="light-blue2"></button>
							<button type="button" class="changeLogoHeaderColor" data-color="green2"></button>
							<button type="button" class="changeLogoHeaderColor" data-color="orange2"></button>
							<button type="button" class="changeLogoHeaderColor" data-color="red2"></button>
						</div>
					</div>
					<div class="switch-block">
						<h4>Navbar Header</h4>
						<div class="btnSwitch">
							<button type="button" class="changeTopBarColor" data-color="dark"></button>
							<button type="button" class="changeTopBarColor" data-color="blue"></button>
							<button type="button" class="changeTopBarColor" data-color="purple"></button>
							<button type="button" class="changeTopBarColor" data-color="light-blue"></button>
							<button type="button" class="changeTopBarColor" data-color="green"></button>
							<button type="button" class="changeTopBarColor" data-color="orange"></button>
							<button type="button" class="changeTopBarColor" data-color="red"></button>
							<button type="button" class="changeTopBarColor" data-color="white"></button>
							<br />
							<button type="button" class="changeTopBarColor" data-color="dark2"></button>
							<button type="button" class="selected changeTopBarColor" data-color="blue2"></button>
							<button type="button" class="changeTopBarColor" data-color="purple2"></button>
							<button type="button" class="changeTopBarColor" data-color="light-blue2"></button>
							<button type="button" class="changeTopBarColor" data-color="green2"></button>
							<button type="button" class="changeTopBarColor" data-color="orange2"></button>
							<button type="button" class="changeTopBarColor" data-color="red2"></button>
						</div>
					</div>
					<div class="switch-block">
						<h4>Sidebar</h4>
						<div class="btnSwitch">
							<button type="button" class="selected changeSideBarColor" data-color="white"></button>
							<button type="button" class="changeSideBarColor" data-color="dark"></button>
							<button type="button" class="changeSideBarColor" data-color="dark2"></button>
						</div>
					</div>
					<div class="switch-block">
						<h4>Background</h4>
						<div class="btnSwitch">
							<button type="button" class="changeBackgroundColor" data-color="bg2"></button>
							<button type="button" class="changeBackgroundColor selected" data-color="bg1"></button>
							<button type="button" class="changeBackgroundColor" data-color="bg3"></button>
							<button type="button" class="changeBackgroundColor" data-color="dark"></button>
						</div>
					</div>
				</div>
			</div>
			<div class="custom-toggle">
				<i class="flaticon-settings"></i>
			</div>
		</div>
		<!-- End Custom template -->
	</div>
	<!--   Core JS Files   -->
	<script src="../assets/js/core/jquery.3.2.1.min.js"></script>
	<script src="../assets/js/core/popper.min.js"></script>
	<script src="../assets/js/core/bootstrap.min.js"></script>

	<!-- jQuery UI -->
	<script src="../assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
	<script src="../assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>

	<!-- jQuery Scrollbar -->
	<script src="../assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>

	<!-- Chart JS -->
	<script src="../assets/js/plugin/chart.js/chart.min.js"></script>

	<!-- jQuery Sparkline -->
	<script src="../assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>

	<!-- Chart Circle -->
	<script src="../assets/js/plugin/chart-circle/circles.min.js"></script>

	<!-- Datatables -->
	<script src="../assets/js/plugin/datatables/datatables.min.js"></script>

	<!-- Bootstrap Notify -->
	<script src="../assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>

	<!-- jQuery Vector Maps -->
	<script src="../assets/js/plugin/jqvmap/jquery.vmap.min.js"></script>
	<script src="../assets/js/plugin/jqvmap/maps/jquery.vmap.world.js"></script>

	<!-- Sweet Alert -->
	<script src="../assets/js/plugin/sweetalert/sweetalert.min.js"></script>

	<!-- Atlantis JS -->
	<script src="../assets/js/atlantis.min.js"></script>

	<!-- Atlantis DEMO methods, don't include it in your project! -->
	<script src="../assets/js/setting-demo.js"></script>
	<script src="../assets/js/demo.js"></script>
	<script>
		$.ajax({
			url: "ajax.php?modulo=seguimiento&controlador=seguimiento&funcion=cir_usuarios",
			type: "POST",
			// data: parametros,
			success: function (c) {
				var cJson = JSON.parse(c);
				console.log(cJson);
				Circles.create({
					id: cJson.id,
					radius: cJson.radius,
					value: cJson.value,
					maxValue: cJson.maxValue,
					width: cJson.width,
					text: cJson.text,
					colors: cJson.colors,  //["#f1f1f1", "#FF9E27"],
					duration: cJson.duration,
					wrpClass: cJson.wrpClass,
					textClass: cJson.textClass,
					styleWrapper: cJson.styleWrapper,
					styleText: cJson.styleText,
				});
			// var errorJson = JSON.parse(error); 

			},
      	});		
	  
	 
	 	// Circles.create({
		// 	id: "circles-1",
		// 	radius: 45,
		// 	value: 60,
		// 	maxValue: 100,
		// 	width: 7,
		// 	text: 5,
		// 	colors: ["#f1f1f1", "#FF9E27"],
		// 	duration: 400,
		// 	wrpClass: "circles-wrp",
		// 	textClass: "circles-text",
		// 	styleWrapper: true,
		// 	styleText: true,
		// });


		$.ajax({
			url: "ajax.php?modulo=seguimiento&controlador=seguimiento&funcion=cir_orden_sistema",
			type: "POST",
			// data: parametros,
			success: function (c) {
				var cJson = JSON.parse(c);
				console.log(cJson);
				Circles.create({
					id: cJson.id,
					radius: cJson.radius,
					value: cJson.value,
					maxValue: cJson.maxValue,
					width: cJson.width,
					text: cJson.text,
					colors: cJson.colors,  //["#f1f1f1", "#FF9E27"],
					duration: cJson.duration,
					wrpClass: cJson.wrpClass,
					textClass: cJson.textClass,
					styleWrapper: cJson.styleWrapper,
					styleText: cJson.styleText,
				});
			// var errorJson = JSON.parse(error); 

			},
      	});		


		$.ajax({
			url: "ajax.php?modulo=seguimiento&controlador=seguimiento&funcion=cir_maq",
			type: "POST",
			// data: parametros,
			success: function (c) {
				var cJson = JSON.parse(c);
				console.log(cJson);
				Circles.create({
					id: cJson.id,
					radius: cJson.radius,
					value: cJson.value,
					maxValue: cJson.maxValue,
					width: cJson.width,
					text: cJson.text,
					colors: cJson.colors,  //["#f1f1f1", "#FF9E27"],
					duration: cJson.duration,
					wrpClass: cJson.wrpClass,
					textClass: cJson.textClass,
					styleWrapper: cJson.styleWrapper,
					styleText: cJson.styleText,
				});
			// var errorJson = JSON.parse(error); 

			},
      	});	



		var totalIncomeChart = document
			.getElementById("totalIncomeChart")
			.getContext("2d");

		var mytotalIncomeChart = new Chart(totalIncomeChart, {
			type: "bar",
			data: {
				labels: ["S", "M", "T", "W", "T", "F", "S", "S", "M", "T"],
				datasets: [
					{
						label: "Total Income",
						backgroundColor: "#ff9e27",
						borderColor: "rgb(23, 125, 255)",
						data: [6, 4, 9, 5, 4, 6, 4, 3, 8, 10],
					},
				],
			},
			options: {
				responsive: true,
				maintainAspectRatio: false,
				legend: {
					display: false,
				},
				scales: {
					yAxes: [
						{
							ticks: {
								display: false, //this will remove only the label
							},
							gridLines: {
								drawBorder: false,
								display: false,
							},
						},
					],
					xAxes: [
						{
							gridLines: {
								drawBorder: false,
								display: false,
							},
						},
					],
				},
			},
		});

		$("#lineChart").sparkline([105, 103, 123, 100, 95, 105, 115], {
			type: "line",
			height: "70",
			width: "100%",
			lineWidth: "2",
			lineColor: "#ffa534",
			fillColor: "rgba(255, 165, 52, .14)",
		});
	</script>

<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <!-- agregados de STPO  -->
	<script src="js/general.js"></script>

	<!-- importacion de scrips especificos de cada url -->

	<script src="js/home.js"></script>
	<script src="js/procesos.js"></script>
	<script src="js/maquina.js"></script>
	<script src="js/producto.js"></script>
	<script src="js/ordentrabajo.js"></script>
	<script src="js/productoDetalle.js"></script>
	<script src="js/OtDetallle.js"></script>
	
	
	


// $(document).ready();

setInterval(pagina(), 30000);

// setInterval(function(){
//   console.log('Solo');
// }, 100);

function pagina() {
  // pagina();

  //  setInterval(pagina(), 1000);
 

  // function pagina() {
    // Circulos
    console.log(1);
    $.ajax({
      url: "ajax.php?modulo=seguimiento&controlador=seguimiento&funcion=cir_usuarios",
      type: "POST",
      // data: parametros,
      success: function (c) {
        var cJson = JSON.parse(c);
        // console.log(cJson);
        Circles.create({
          id: cJson.id,
          radius: cJson.radius,
          value: cJson.value,
          maxValue: cJson.maxValue,
          width: cJson.width,
          text: cJson.text,
          colors: cJson.colors, //["#f1f1f1", "#FF9E27"],
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
        // console.log(cJson);
        Circles.create({
          id: cJson.id,
          radius: cJson.radius,
          value: cJson.value,
          maxValue: cJson.maxValue,
          width: cJson.width,
          text: cJson.text,
          colors: cJson.colors, //["#f1f1f1", "#FF9E27"],
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
        // console.log(cJson);
        Circles.create({
          id: cJson.id,
          radius: cJson.radius,
          value: cJson.value,
          maxValue: cJson.maxValue,
          width: cJson.width,
          text: cJson.text,
          colors: cJson.colors, //["#f1f1f1", "#FF9E27"],
          duration: cJson.duration,
          wrpClass: cJson.wrpClass,
          textClass: cJson.textClass,
          styleWrapper: cJson.styleWrapper,
          styleText: cJson.styleText,
        });
        // var errorJson = JSON.parse(error);
      },
    });

    //

    // Orden
    var totalIncomeChart = document
      .getElementById("totalIncomeChart")
      .getContext("2d");

    $.ajax({
      url: "ajax.php?modulo=seguimiento&controlador=seguimiento&funcion=semanaOt",
      type: "POST",
      // data: parametros,
      success: function (c) {
        var cJson = JSON.parse(c);
        // console.log(cJson);
        $("#charTotalOt").html("" + cJson[2] + " ");
        var mytotalIncomeChart = new Chart(totalIncomeChart, {
          type: "bar",
          data: {
            labels: cJson[0],
            datasets: [
              {
                label: "Cantidad Ot",
                backgroundColor: "#ff9e27",
                borderColor: "rgb(23, 125, 255)",
                data: cJson[1],
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

        // var errorJson = JSON.parse(error);
      },
    });

    //

    //Chart
    var myLegendContainer = document.getElementById("myChartLegend");

    var ctx = document.getElementById("statisticsChart").getContext("2d");

    // var statisticsChart = new Chart(ctx, {
    // 	type: 'line',
    // 	data: {
    // 		labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
    // 		datasets: [ {
    // 			label: "Subscribers",
    // 			borderColor: '#f3545d',
    // 			pointBackgroundColor: 'rgba(243, 84, 93, 0.6)',
    // 			pointRadius: 0,
    // 			backgroundColor: 'rgba(243, 84, 93, 0.4)',
    // 			legendColor: '#f3545d',
    // 			fill: true,
    // 			borderWidth: 2,
    // 			data: [154, 184, 175, 203, 210, 231, 240, 278, 252, 312, 320, 374]
    // 		}, {
    // 			label: "New Visitors",
    // 			borderColor: '#fdaf4b',
    // 			pointBackgroundColor: 'rgba(253, 175, 75, 0.6)',
    // 			pointRadius: 0,
    // 			backgroundColor: 'rgba(253, 175, 75, 0.4)',
    // 			legendColor: '#fdaf4b',
    // 			fill: true,
    // 			borderWidth: 2,
    // 			data: [256, 230, 245, 287, 240, 250, 230, 295, 331, 431, 456, 521]
    // 		}, {
    // 			label: "Active Users",
    // 			borderColor: '#177dff',
    // 			pointBackgroundColor: 'rgba(23, 125, 255, 0.6)',
    // 			pointRadius: 0,
    // 			backgroundColor: 'rgba(23, 125, 255, 0.4)',
    // 			legendColor: '#177dff',
    // 			fill: true,
    // 			borderWidth: 2,
    // 			data: [542, 480, 430, 550, 530, 453, 380, 434, 568, 610, 700, 900]
    // 		}]
    // 	},
    // 	options : {
    // 		responsive: true,
    // 		maintainAspectRatio: false,
    // 		legend: {
    // 			display: false
    // 		},
    // 		tooltips: {
    // 			bodySpacing: 4,
    // 			mode:"nearest",
    // 			intersect: 0,
    // 			position:"nearest",
    // 			xPadding:10,
    // 			yPadding:10,
    // 			caretPadding:10
    // 		},
    // 		layout:{
    // 			padding:{left:5,right:5,top:15,bottom:15}
    // 		},
    // 		scales: {
    // 			yAxes: [{
    // 				ticks: {
    // 					fontStyle: "500",
    // 					beginAtZero: false,
    // 					maxTicksLimit: 5,
    // 					padding: 10
    // 				},
    // 				gridLines: {
    // 					drawTicks: false,
    // 					display: false
    // 				}
    // 			}],
    // 			xAxes: [{
    // 				gridLines: {
    // 					zeroLineColor: "transparent"
    // 				},
    // 				ticks: {
    // 					padding: 10,
    // 					fontStyle: "500"
    // 				}
    // 			}]
    // 		},
    // 		legendCallback: function(chart) {
    // 			var text = [];
    // 			text.push('<ul class="' + chart.id + '-legend html-legend">');
    // 			for (var i = 0; i < chart.data.datasets.length; i++) {
    // 				text.push('<li><span style="background-color:' + chart.data.datasets[i].legendColor + '"></span>');
    // 				if (chart.data.datasets[i].label) {
    // 					text.push(chart.data.datasets[i].label);
    // 				}
    // 				text.push('</li>');
    // 			}
    // 			text.push('</ul>');
    // 			return text.join('');
    // 		}
    // 	}
    // });

    $.ajax({
      url: "ajax.php?modulo=seguimiento&controlador=seguimiento&funcion=historialOt",
      type: "POST",
      // data: parametros,
      success: function (c) {
        var cJson = JSON.parse(c);
        // console.log(cJson);
        // console.log(c);
        var creacion = {
          type: "line",
          data: {
            labels: [
              "Ene",
              "Feb",
              "Mar",
              "Abr",
              "May",
              "Jun",
              "Jul",
              "Ago",
              "Sep",
              "Oct",
              "Nov",
              "Dic",
            ],
            datasets: cJson,
          },
          options: {
            responsive: true,
            maintainAspectRatio: false,
            legend: {
              display: false,
            },
            tooltips: {
              bodySpacing: 4,
              mode: "nearest",
              intersect: 0,
              position: "nearest",
              xPadding: 10,
              yPadding: 10,
              caretPadding: 10,
            },
            layout: {
              padding: { left: 5, right: 5, top: 15, bottom: 15 },
            },
            scales: {
              yAxes: [
                {
                  ticks: {
                    fontStyle: "500",
                    beginAtZero: false,
                    maxTicksLimit: 5,
                    padding: 10,
                  },
                  gridLines: {
                    drawTicks: false,
                    display: false,
                  },
                },
              ],
              xAxes: [
                {
                  gridLines: {
                    zeroLineColor: "transparent",
                  },
                  ticks: {
                    padding: 10,
                    fontStyle: "500",
                  },
                },
              ],
            },
            legendCallback: function (chart) {
              var text = [];
              text.push('<ul class="' + chart.id + '-legend html-legend">');
              for (var i = 0; i < chart.data.datasets.length; i++) {
                text.push(
                  '<li><span style="background-color:' +
                    chart.data.datasets[i].legendColor +
                    '"></span>'
                );
                if (chart.data.datasets[i].label) {
                  text.push(chart.data.datasets[i].label);
                }
                text.push("</li>");
              }
              text.push("</ul>");
              return text.join("");
            },
          },
        };

        //creacion.data.datasets.push(cJson);
        var statisticsChart = new Chart(ctx, creacion);
        // generate HTML legend
        myLegendContainer.innerHTML = statisticsChart.generateLegend();

        // bind onClick event to all LI-tags of the legend
        var legendItems = myLegendContainer.getElementsByTagName("li");
        for (var i = 0; i < legendItems.length; i += 1) {
          legendItems[i].addEventListener("click", legendClickCallback, false);
        }

        // var errorJson = JSON.parse(error);
      },
    });

    // Peticion para actualizar informacion de
    // las actividades de usuario
    $.ajax({
      url: "ajax.php?modulo=seguimiento&controlador=seguimiento&funcion=actividadUsuario",
      type: "POST",
      // data: parametros,
      success: function (res) {
        // console.log(res);
        $("#homeActividadUsuario").html(res);
      },
    });


}
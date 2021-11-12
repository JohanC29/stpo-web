$(document).ready(function() {


//Chart

var ctx = document.getElementById('statisticsChart').getContext('2d');

/*
var statisticsChart = new Chart(ctx, {
	type: 'line',
	data: {
		labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
		datasets: [ {
			label: "Subscribers",
			borderColor: '#f3545d',
			pointBackgroundColor: 'rgba(243, 84, 93, 0.6)',
			pointRadius: 0,
			backgroundColor: 'rgba(243, 84, 93, 0.4)',
			legendColor: '#f3545d',
			fill: true,
			borderWidth: 2,
			data: [154, 184, 175, 203, 210, 231, 240, 278, 252, 312, 320, 374]
		}, {
			label: "New Visitors",
			borderColor: '#fdaf4b',
			pointBackgroundColor: 'rgba(253, 175, 75, 0.6)',
			pointRadius: 0,
			backgroundColor: 'rgba(253, 175, 75, 0.4)',
			legendColor: '#fdaf4b',
			fill: true,
			borderWidth: 2,
			data: [256, 230, 245, 287, 240, 250, 230, 295, 331, 431, 456, 521]
		}, {
			label: "Active Users",
			borderColor: '#177dff',
			pointBackgroundColor: 'rgba(23, 125, 255, 0.6)',
			pointRadius: 0,
			backgroundColor: 'rgba(23, 125, 255, 0.4)',
			legendColor: '#177dff',
			fill: true,
			borderWidth: 2,
			data: [542, 480, 430, 550, 530, 453, 380, 434, 568, 610, 700, 900]
		}]
	},
	options : {
		responsive: true, 
		maintainAspectRatio: false,
		legend: {
			display: false
		},
		tooltips: {
			bodySpacing: 4,
			mode:"nearest",
			intersect: 0,
			position:"nearest",
			xPadding:10,
			yPadding:10,
			caretPadding:10
		},
		layout:{
			padding:{left:5,right:5,top:15,bottom:15}
		},
		scales: {
			yAxes: [{
				ticks: {
					fontStyle: "500",
					beginAtZero: false,
					maxTicksLimit: 5,
					padding: 10
				},
				gridLines: {
					drawTicks: false,
					display: false
				}
			}],
			xAxes: [{
				gridLines: {
					zeroLineColor: "transparent"
				},
				ticks: {
					padding: 10,
					fontStyle: "500"
				}
			}]
		}, 
		legendCallback: function(chart) { 
			var text = []; 
			text.push('<ul class="' + chart.id + '-legend html-legend">'); 
			for (var i = 0; i < chart.data.datasets.length; i++) { 
				text.push('<li><span style="background-color:' + chart.data.datasets[i].legendColor + '"></span>'); 
				if (chart.data.datasets[i].label) { 
					text.push(chart.data.datasets[i].label); 
				} 
				text.push('</li>'); 
			} 
			text.push('</ul>'); 
			return text.join(''); 
		}  
	}
});

*/
/*
creacion.data.datasets.push({
	label: "Johan",
	borderColor: '#f3545d',
	pointBackgroundColor: 'rgba(243, 84, 93, 0.6)',
	pointRadius: 0,
	backgroundColor: 'rgba(243, 84, 93, 0.4)',
	legendColor: '#f3545d',
	fill: true,
	borderWidth: 2,
	data: [124, 154, 135, 173, 180, 231, 240, 278, 252, 312, 320, 374]
},{
	label: "Johan4",
	borderColor: '#f3545d',
	pointBackgroundColor: 'rgba(243, 84, 93, 0.6)',
	pointRadius: 0,
	backgroundColor: 'rgba(243, 84, 93, 0.4)',
	legendColor: '#f3545d',
	fill: true,
	borderWidth: 2,
	data: [124, 154, 135, 173, 180, 231, 240, 278, 252, 312, 320, 374]
});*/

$.ajax({
    url: "ajax.php?modulo=seguimiento&controlador=seguimiento&funcion=historialOt",
    type: "POST",
    // data: parametros,
    success: function (c) {
        var cJson = JSON.parse(c);
        console.log(cJson);
        // console.log(c);
        var creacion = {
            type: 'line',
            data: {
                labels: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"],
                datasets: cJson
            },
            options : {
                responsive: true, 
                maintainAspectRatio: false,
                legend: {
                    display: false
                },
                tooltips: {
                    bodySpacing: 4,
                    mode:"nearest",
                    intersect: 0,
                    position:"nearest",
                    xPadding:10,
                    yPadding:10,
                    caretPadding:10
                },
                layout:{
                    padding:{left:5,right:5,top:15,bottom:15}
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            fontStyle: "500",
                            beginAtZero: false,
                            maxTicksLimit: 5,
                            padding: 10
                        },
                        gridLines: {
                            drawTicks: false,
                            display: false
                        }
                    }],
                    xAxes: [{
                        gridLines: {
                            zeroLineColor: "transparent"
                        },
                        ticks: {
                            padding: 10,
                            fontStyle: "500"
                        }
                    }]
                }, 
                legendCallback: function(chart) { 
                    var text = []; 
                    text.push('<ul class="' + chart.id + '-legend html-legend">'); 
                    for (var i = 0; i < chart.data.datasets.length; i++) { 
                        text.push('<li><span style="background-color:' + chart.data.datasets[i].legendColor + '"></span>'); 
                        if (chart.data.datasets[i].label) { 
                            text.push(chart.data.datasets[i].label); 
                        } 
                        text.push('</li>'); 
                    } 
                    text.push('</ul>'); 
                    return text.join(''); 
                }  
            }
        };

        //creacion.data.datasets.push(cJson);
        var statisticsChart = new Chart(ctx,creacion);

    // var errorJson = JSON.parse(error); 

    },
  });	



//console.log(creacion.data.datasets);

});
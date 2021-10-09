
// Se puede poner en un metodo jquery y hacer que se ejecute por parametros
//Notify
// $(document).ready(function () {
    
//     // Add Row
//     // $('#tablaGestionar').DataTable({
//     //     "pageLength": 5,
//     // });
    
// });

function Notify(mensaje,titulo='Aviso!',tipo='info',icono='flaticon-alarm-1') {
    $.notify({
        icon: icono,
        title: titulo,
        message: mensaje,
    },{
        // type: 'danger',
        type: tipo,
        placement: {
            from: "bottom",
            align: "right"
        },
        time: 1000,
    });
}

// Variables Globales   -  prefijo variable ->  g
var giconError = 'fas fa-times';

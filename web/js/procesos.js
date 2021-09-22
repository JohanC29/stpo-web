$(document).ready(function () {
  $(".loading").hide();

  // Proceso de -- Gestionar Maquina
  // Se Crea la tabla y se deja activa para el resto de procesos
  
  var table = $("#tablaGestionarProceso").DataTable({
    "ajax": {
      "url": "ajax.php?modulo=procesos&controlador=procesos&funcion=getTable",
      "dataSrc": "",
    },
    "columns": [
      { "data": "pro_codigo" },
      { "data": "pro_identificador" },
      { "data": "pro_nombre" },
      { "data": "est_codigo" },
    ]
  });
  

  obtener_data_editar_proceso("#tablaGestionarProceso tbody", table);
  
  $("#agregarProceso").click(function () {
    $(".loading").show();
    var url = $(this).attr("data-url");
    var formulario = $("#formAgregarProceso").serialize();
    $.ajax({
      url: url,
      type: "POST",
      data: formulario,
      success: function (mensaje) {
        Notify(mensaje, "Exito!", "success", "fas fa-check");
        table.ajax.reload();
        $(".loading").hide();
      },
    });
    $("#agregarProcesoModal").modal("hide");
  });

  //Editar Proceso
  
  $("#editarProceso").click(function () {
    $(".loading").show();
    var url = $(this).attr("data-url");
    var formulario = $("#formEditarProceso").serialize();
    $.ajax({
      url: url,
      type: "POST",
      data: formulario,
      success: function (mensaje) {
        Notify(mensaje, "Exito!", "success", "fas fa-check");
        table.ajax.reload();
        $(".loading").hide();
      },
    });
    $("#editarProcesoModal").modal("hide");
  });

  // Deshabilitar Maquina

  $("#tablaGestionarProceso tbody").on("click", "button.eliminar", function () {
    var data = table.row($(this).parents("tr")).data();
    //console.log(data.est_codigo);
    var titulo = "";
    var est_codigo = data.est_codigo.substr(
      data.est_codigo.indexOf("<button estado = ") + 18,
      1
    );
    var urlEliminar =
      "ajax.php?modulo=procesos&controlador=procesos&funcion=eliminar";

    if (est_codigo == 1) {
      titulo = "¿Desea Deshabilidar el proceso " + data.pro_identificador + "?";
    } else {
      titulo = "¿Desea Habilitar el proceso " + data.pro_identificador + "?";
    }

    swal({
      title: titulo,
      text: "Una vez realizada esta operación puede volver a realizar el cambio.",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    }).then((willDelete) => {
      if (willDelete) {
        //Se le deja el control del tiempo de espera a la funcion
        cambioEstado(data.pro_codigo, est_codigo, urlEliminar, table);
      }
    });
  });



  
  // Proceso de Asignacion de Maquina
  var tableAsignacionMaquina = $("#tablaDetalleProcesoMaquina").DataTable({
    ajax: {
      url: "ajax.php?modulo=procesos&controlador=procesos&funcion=getTable",
      dataSrc: "",
    },
    columns: [
      { data: "pro_codigo" },
      { data: "pro_identificador" },
      { data: "pro_nombre" },
      { data: "est_codigo" },
    ],
  });


  

  // Auto completado - Identificador maquina

  // idenProcesoA
  var local_sourse = [
    {id: 1,value: "proceso1"},
    {id: 2,value: "proceso2"},
    {id: 3,value: "proceso3"},
    {id: 4,value: "proceso4"},
    {id: 5,value: "proceso5"},
    {id: 3,value: "proceso6"},
    {id: 7,value: "proceso7"},
    {id: 2,value: "proceso8"},
    {id: 3,value: "proceso9"},
    {id: 8,value: "proceso10"},
    {id: 2,value: "proceso21"},
    {id: 9,value: "proceso31"},
    {id: 2,value: "proceso11"},
    {id: 2,value: "proceso21"},
    {id: 3,value: "proceso31"},
    {id: 2,value: "proceso12"},
    {id: 2,value: "proceso22"},
    {id: 3,value: "proceso32"},
  ];

  
  $("#idenProcesoA").autocomplete({
    source: function( request, response ) {
      // Fetch data
      $.ajax({
        url:"ajax.php?modulo=procesos&controlador=procesos&funcion=getProcesos",
       type: 'POST',
       dataType: "json",
       data: {
        search: request.term
       },
       success: function( data ) {
        response( data );
       }
      });
     },
     select: function (event, ui) {
      // Set selection
      $('#idenProcesoA').val(ui.item.label); // display the selected text
      $('#idCodigoProceso').val(ui.item.value); // save selected id to input
      return false;
      },
      focus: function(event, ui){
        $( "#idenProcesoA" ).val( ui.item.label );
        $( "#idCodigoProceso" ).val( ui.item.value );
        return false;
      },
  //   select:function(event,ui){
  //     $(this).val(ui.item.value)
  //     $("#idCodigoProceso").val(ui.item.id)
  //   },
  //   minLength:2,   
  //  delay:500,   
  //   autoFocus: true
  // source:local_sourse
  });
  

  // $.ajax({
  //   url:"ajax.php?modulo=procesos&controlador=procesos&funcion=getProcesos",
  //   type:"GET",
  //   dataType:"json",
  //   success:function(data){
  //     console.log(data);
  //     $("#idenProcesoA").fuzzycomplete(
  //     data
  //     );

  //   }
  // });

  


});







// Proceso Gestionar Maquina
var obtener_data_editar_proceso = function (tbody, table) {
  $(tbody).on("click", "button.editar", function () {
    var data = table.row($(this).parents("tr")).data();
    console.log(data);
    $("#editIdenProceso").val(data.pro_identificador);
    $("#editNomProceso").val(data.pro_nombre);
    $("#editCodigoProceso").val(data.pro_codigo);
  });
};

function cambioEstado(id, est_codigo, url, table) {
  $(".loading").show();
  // Parametros enviados
  var parametros = {
    id: id,
    est_codigo: est_codigo,
  };
  $.ajax({
    url: url,
    type: "POST",
    data: parametros,
    success: function (mensaje) {
      Notify(mensaje, "Exito!", "success", "fas fa-check");
      table.ajax.reload();
      $(".loading").hide();
    },
  });
}

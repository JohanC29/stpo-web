$(document).ready(function () {
  $(".loading").hide();

  // Proceso de -- Gestionar Maquina
  // Se Crea la tabla y se deja activa para el resto de procesos

  var table = $("#tablaGestionarProceso").DataTable({
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
  var tabladpm = $("#tablaDetalleProcesoMaquina").DataTable({
    destroy: true, //Cada vez que se construya una nueva tabla, destruye la anterior
    processing: true, //En caso de que sea mucha data, aparecerá un texto "procesando"
    columns: [
      { data: "maq_codigo" },
      { data: "maq_identificador" },
      { data: "maq_nombre" },
      { data: "est_codigo" },
    ],
  });


  // Limpiar variables y campos
  $("#limpiar").click(function(){
    // Limpiar variables
    $("#idCodigoProceso").val(0);
    $("#idenProcesoA").val('');

    // Limpiar Data Table
    tabladpm.destroy();
    tabladpm = $("#tablaDetalleProcesoMaquina").DataTable({
      destroy: true, //Cada vez que se construya una nueva tabla, destruye la anterior
      processing: true, //En caso de que sea mucha data, aparecerá un texto "procesando"
      columns: [
        { data: "maq_codigo" },
        { data: "maq_identificador" },
        { data: "maq_nombre" },
        { data: "est_codigo" },
      ],
    });
  })

  // Consultar asosiacion
  $("#consultar").click(function () {
    $(".loading").show();
    var id = $("#idCodigoProceso").val();
    var iden = $("#idenProcesoA").val() + "";

    
    tabladpm.destroy();

    //Validacion de datos ingresados
    if (id == 0 && iden == "") {
      Notify(
        "Datos no validos. Ingrese un parametro de filtro.",
        "Error",
        "danger"
      );

      tabladpm = $("#tablaDetalleProcesoMaquina").DataTable({
        destroy: true, //Cada vez que se construya una nueva tabla, destruye la anterior
        processing: true, //En caso de que sea mucha data, aparecerá un texto "procesando"
        columns: [
          { data: "maq_codigo" },
          { data: "maq_identificador" },
          { data: "maq_nombre" },
          { data: "est_codigo" },
        ],
      });
      $(".loading").hide();
    }else if(id != 0 && iden != ""){
      Notify(
        "Datos no validos. Ingrese solo un parametro.",
        "Error",
        "danger"
      );

      tabladpm = $("#tablaDetalleProcesoMaquina").DataTable({
        destroy: true, //Cada vez que se construya una nueva tabla, destruye la anterior
        processing: true, //En caso de que sea mucha data, aparecerá un texto "procesando"
        columns: [
          { data: "maq_codigo" },
          { data: "maq_identificador" },
          { data: "maq_nombre" },
          { data: "est_codigo" },
        ],
      });
      $(".loading").hide();
    }else {
      //Se valida que los parametros de ingreso tengan datos

      // Valida si cuentan con datos
      var parametros = {
        id: id,
        idenP: iden,
      };

      $.ajax({
        url: "ajax.php?modulo=procesos&controlador=procesos&funcion=validaAsigancionMaquina",
        type: "POST",
        data: parametros,
        success: function (error) {
          var errorJson = JSON.parse(error);
          // console.log(errorJson);

          // Validar si el proceso no existe
          if (errorJson[0]["vaProceso"] > 0) {
            // El proceso si existe
            // Validar si tiene maquinas asociadas
            if (errorJson[1]["vaMaquina"] > 0) {
              // El proceso cuenta con maquinas asociadas

              if (id != 0 && iden != "") {
                Notify(
                  "La consulta solo se realiza por un campo ingresado.",
                  "Error",
                  "danger"
                );

                tabladpm = $("#tablaDetalleProcesoMaquina").DataTable({
                  destroy: true, //Cada vez que se construya una nueva tabla, destruye la anterior
                  processing: true, //En caso de que sea mucha data, aparecerá un texto "procesando"
                  columns: [
                    { data: "maq_codigo" },
                    { data: "maq_identificador" },
                    { data: "maq_nombre" },
                    { data: "est_codigo" },
                  ],
                });
              } else if (id == 0 && iden != "") {
                // Consulta por identificador text

                tabladpm = $("#tablaDetalleProcesoMaquina").DataTable({
                  ajax: {
                    url:
                      "ajax.php?modulo=procesos&controlador=procesos&funcion=getTableAsignacionMaquina&id=" +
                      id +
                      "&idenP=" +
                      iden,
                    dataSrc: "",
                  },
                  columns: [
                    { data: "maq_codigo" },
                    { data: "maq_identificador" },
                    { data: "maq_nombre" },
                    { data: "est_codigo" },
                  ],
                });
              } else if (id != 0 && iden == "") {
                // Consulta por id
                tabladpm = $("#tablaDetalleProcesoMaquina").DataTable({
                  ajax: {
                    url:
                      "ajax.php?modulo=procesos&controlador=procesos&funcion=getTableAsignacionMaquina&id=" +
                      id +
                      "&idenP=" +
                      iden,
                    dataSrc: "",
                  },
                  columns: [
                    { data: "maq_codigo" },
                    { data: "maq_identificador" },
                    { data: "maq_nombre" },
                    { data: "est_codigo" },
                  ],
                });
              } else {
                Notify("Datos no validos.", "Error", "danger");
                tabladpm = $("#tablaDetalleProcesoMaquina").DataTable({
                  destroy: true, //Cada vez que se construya una nueva tabla, destruye la anterior
                  processing: true, //En caso de que sea mucha data, aparecerá un texto "procesando"
                  columns: [
                    { data: "maq_codigo" },
                    { data: "maq_identificador" },
                    { data: "maq_nombre" },
                    { data: "est_codigo" },
                  ],
                });
              }
            } else {
              // El proceso no cuenta con maquinas asociadas
              Notify(
                "El proceso no cuenta con maquinas asociadas.",
                "Aviso",
                "info"
              );
              tabladpm = $("#tablaDetalleProcesoMaquina").DataTable({
                destroy: true, //Cada vez que se construya una nueva tabla, destruye la anterior
                processing: true, //En caso de que sea mucha data, aparecerá un texto "procesando"
                columns: [
                  { data: "maq_codigo" },
                  { data: "maq_identificador" },
                  { data: "maq_nombre" },
                  { data: "est_codigo" },
                ],
              });
            }
          } else {
            // El proceso no existe
            Notify("El proceso ingresado no existe.", "Error", "danger");
            tabladpm = $("#tablaDetalleProcesoMaquina").DataTable({
              destroy: true, //Cada vez que se construya una nueva tabla, destruye la anterior
              processing: true, //En caso de que sea mucha data, aparecerá un texto "procesando"
              columns: [
                { data: "maq_codigo" },
                { data: "maq_identificador" },
                { data: "maq_nombre" },
                { data: "est_codigo" },
              ],
            });
          }
          $(".loading").hide();
        },
      });
    }

    //   if( (id!=0 && iden!='') || (id==0 && iden!='') || (id!=0 && iden=='') ){

    //   tabladpm.destroy();
    //       // $('#tablaDetalleProcesoMaquina').empty(); // empty in case the columns change
    //   tabladpm = $('#tablaDetalleProcesoMaquina').DataTable( {
    //     ajax: {
    //       url: "ajax.php?modulo=procesos&controlador=procesos&funcion=getTableAsignacionMaquina&id="+id+"&idenP="+iden,
    //       dataSrc: "",
    //     },
    //     "columns":[
    //         {"data":"maq_codigo"},
    //         {"data":"maq_identificador"},
    //         {"data":"maq_nombre"},
    //         {"data":"est_codigo"}
    //     ]
    //   } );

    // }
  });

  // Auto completado - Identificador maquina
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

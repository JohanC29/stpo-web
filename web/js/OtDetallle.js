$(document).ready(function () {
  $(".loading").hide();

  
  // Proceso de Producto Detalle
  var tabladotr = $("#tablaOtDetalle").DataTable({
    destroy: true, //Cada vez que se construya una nueva tabla, destruye la anterior
    processing: true, //En caso de que sea mucha data, aparecerá un texto "procesando"
    columns: [
      { data: "dotr_codigo" },
      { data: "pro_codigo" },
      { data: "pro_nombre" },
      { data: "dotr_cantidad" },
      { data: "dotr_orden" },
      { data: "est_codigo" },
    ],
  });

  // Limpiar variables y campos
  $("#limpiardotr").click(function () {
    // Limpiar variables
    $("#idenOT").val("");
    $("#idCodigoOrdenTrabajo").val(0);
    
    $("#dotrIdCodigo").val(0);
    $("#dotrIdCodigoNombre").val("");

    // Limpiar Data Table
    tabladotr.destroy();
    tabladotr = $("#tablaOtDetalle").DataTable({
      destroy: true, //Cada vez que se construya una nueva tabla, destruye la anterior
      processing: true, //En caso de que sea mucha data, aparecerá un texto "procesando"
      columns: [
        { data: "dotr_codigo" },
        { data: "pro_codigo" },
        { data: "pro_nombre" },
        { data: "dotr_cantidad" },
        { data: "dotr_orden" },
        { data: "est_codigo" },
      ],
    });
  });

  // Consultar asosiacion
  $("#consultardotr").click(function () {
    
    $(".loading").show();

    var id = $("#idCodigoOrdenTrabajo").val();
    var iden = $("#idenOT").val();

    tabladotr.destroy();

    //Validacion de datos ingresados
    if (id == 0 && (iden == "" || iden == 0) ) {
      Notify(
        "Datos no validos. Ingrese un parametro de filtro.",
        "Error",
        "danger"
      );

      
      tabladotr = $("#tablaOtDetalle").DataTable({
        destroy: true, //Cada vez que se construya una nueva tabla, destruye la anterior
        processing: true, //En caso de que sea mucha data, aparecerá un texto "procesando"
        columns: [
          { data: "dotr_codigo" },
          { data: "pro_codigo" },
          { data: "pro_nombre" },
          { data: "dotr_cantidad" },
          { data: "dotr_orden" },
          { data: "est_codigo" },
        ],
      });

      $("#dotrIdCodigo").val(0);
      $("#dotrIdCodigoNombre").val("");

      $(".loading").hide();
    } else if (id != 0 && iden != "") {
      Notify("Datos no validos. Ingrese solo un parametro.", "Error", "danger");


      tabladotr = $("#tablaOtDetalle").DataTable({
        destroy: true, //Cada vez que se construya una nueva tabla, destruye la anterior
        processing: true, //En caso de que sea mucha data, aparecerá un texto "procesando"
        columns: [
          { data: "dotr_codigo" },
          { data: "pro_codigo" },
          { data: "pro_nombre" },
          { data: "dotr_cantidad" },
          { data: "dotr_orden" },
          { data: "est_codigo" },
        ],
      });

      $("#dotrIdCodigo").val(0);
      $("#dotrIdCodigoNombre").val("");

      $(".loading").hide();
    } else {
      //Se valida que los parametros de ingreso tengan datos

      // Valida si cuentan con datos
      var parametros = {
        id: id,
        idenP: iden,
      };

      $.ajax({
        url: "ajax.php?modulo=ordentrabajo&controlador=ordentrabajo&funcion=validaOtDetalle",
        type: "POST",
        data: parametros,
        success: function (error) {
          var errorJson = JSON.parse(error);
          // console.log(errorJson);
          // console.log(parametros); 

          // Validar si el proceso no existe
          if (errorJson[0]["vaOrdenTrabajo"] > 0) {
            var idProductoConsultado = errorJson[1]["otr_codigo"];
            var nombreProductoConsultado = errorJson[1]["otr_identificador"];

            $("#dotrIdCodigo").val(idProductoConsultado);
            $("#dotrIdCodigoNombre").val(
              idProductoConsultado + "-" + nombreProductoConsultado
            );
            // El proceso si existe
            // Validar si tiene maquinas asociadas
            if (errorJson[1]["vaProceso"] > 0) {
              // El proceso cuenta con maquinas asociadas
              

              if (id != 0 && iden != "") {
                Notify(
                  "La consulta solo se realiza por un campo ingresado.",
                  "Error",
                  "danger"
                );

                tabladotr = $("#tablaOtDetalle").DataTable({
                  destroy: true, //Cada vez que se construya una nueva tabla, destruye la anterior
                  processing: true, //En caso de que sea mucha data, aparecerá un texto "procesando"
                  columns: [
                    { data: "dotr_codigo" },
                    { data: "pro_codigo" },
                    { data: "pro_nombre" },
                    { data: "dotr_cantidad" },
                    { data: "dotr_orden" },
                    { data: "est_codigo" },
                  ],
                });
          
                $("#dotrIdCodigo").val(0);
                $("#dotrIdCodigoNombre").val("");
              } else if (id == 0 && iden != "") {
                // Consulta por identificador text
               

                tabladotr = $("#tablaOtDetalle").DataTable({
                  ajax: {
                    url:
                      "ajax.php?modulo=ordentrabajo&controlador=ordentrabajo&funcion=getTableProductoDetalle&id=" +
                      id +
                      "&idenP=" +
                      iden,
                    dataSrc: "",
                  },
                  columns: [
                    { data: "dotr_codigo" },
                    { data: "pro_codigo" },
                    { data: "pro_nombre" },
                    { data: "dotr_cantidad" },
                    { data: "dotr_orden" },
                    { data: "est_codigo" },
                  ],
                });
              } else if (id != 0 && iden == "") {
                
                // Consulta por id
                tabladotr = $("#tablaOtDetalle").DataTable({
                  ajax: {
                    url:
                      "ajax.php?modulo=ordentrabajo&controlador=ordentrabajo&funcion=getTableProductoDetalle&id=" +
                      id +
                      "&idenP=" +
                      iden,
                    dataSrc: "",
                  },
                  columns: [
                    { data: "dotr_codigo" },
                    { data: "pro_codigo" },
                    { data: "pro_nombre" },
                    { data: "dotr_cantidad" },
                    { data: "dotr_orden" },
                    { data: "est_codigo" },
                  ],
                });
                // console.log("ajax.php?modulo=producto&controlador=productobase&funcion=getTableProductoDetalle&id=" +
                // id +
                // "&idenP=" +
                // iden);
              } else {
                Notify("Datos no validos.", "Error", "danger");
                tabladotr = $("#tablaOtDetalle").DataTable({
                  destroy: true, //Cada vez que se construya una nueva tabla, destruye la anterior
                  processing: true, //En caso de que sea mucha data, aparecerá un texto "procesando"
                  columns: [
                    { data: "dotr_codigo" },
                    { data: "pro_codigo" },
                    { data: "pro_nombre" },
                    { data: "dotr_cantidad" },
                    { data: "dotr_orden" },
                    { data: "est_codigo" },
                  ],
                });
              }
            } else {
              // El proceso no cuenta con maquinas asociadas
              Notify(
                "El producto no cuenta con procesos asociados.",
                "Aviso",
                "info"
              );
              tabladotr = $("#tablaOtDetalle").DataTable({
                destroy: true, //Cada vez que se construya una nueva tabla, destruye la anterior
                processing: true, //En caso de que sea mucha data, aparecerá un texto "procesando"
                columns: [
                  { data: "dotr_codigo" },
                  { data: "pro_codigo" },
                  { data: "pro_nombre" },
                  { data: "dotr_cantidad" },
                  { data: "dotr_orden" },
                  { data: "est_codigo" },
                ],
              });
        

        
              // $("#dprodIdCodigo").val(0);
              // $("#dprodIdCodigoNombre").val("");

              // Si debe de tener el retorno del proceso
            }
          } else {
            // El proceso no existe
            Notify("El proceso ingresado no existe.", "Error", "danger");
            tabladotr = $("#tablaOtDetalle").DataTable({
              destroy: true, //Cada vez que se construya una nueva tabla, destruye la anterior
              processing: true, //En caso de que sea mucha data, aparecerá un texto "procesando"
              columns: [
                { data: "dotr_codigo" },
                { data: "pro_codigo" },
                { data: "pro_nombre" },
                { data: "dotr_cantidad" },
                { data: "dotr_orden" },
                { data: "est_codigo" },
              ],
            });
      
            $("#dotrIdCodigo").val(0);
            $("#dotrIdCodigoNombre").val("");
          }

          $(".loading").hide();
        },
      });
    }
    
  });

  // MODAL ASIGANCION PROCESO
  $("#dotrIdCodigoProcesoSelect").change(function () {
    var valor = $(this).val();
    $("#dotrIdCodigoProceso").val(valor);
  });

  // Dato Titulo
  $("#agregarOtDetalle").click(function () {
    $(".loading").show();

    var url = $(this).attr("data-url");
    var formulario = $("#formOtDetalle").serialize();
    $.ajax({
      url: url,
      type: "POST",
      data: formulario,
      success: function (mensaje) {
        Notify(mensaje, "Exito!", "success", "fas fa-check");
        // tabladpm.ajax.reload();
 
        //---- CARGA DE LA TABLA RELACION  -------
      
          var id = $("#idCodigoOrdenTrabajo").val();
          var iden = $("#idenOT").val();
      
          tabladotr.destroy();
      
          //Validacion de datos ingresados
          if (id == 0 && (iden == "" || iden == 0) ) {
            Notify(
              "Datos no validos. Ingrese un parametro de filtro.",
              "Error",
              "danger"
            );
      
            
            tabladotr = $("#tablaOtDetalle").DataTable({
              destroy: true, //Cada vez que se construya una nueva tabla, destruye la anterior
              processing: true, //En caso de que sea mucha data, aparecerá un texto "procesando"
              columns: [
                { data: "dotr_codigo" },
                { data: "pro_codigo" },
                { data: "pro_nombre" },
                { data: "dotr_cantidad" },
                { data: "dotr_orden" },
                { data: "est_codigo" },
              ],
            });
      
            $("#dotrIdCodigo").val(0);
            $("#dotrIdCodigoNombre").val("");
      
            $(".loading").hide();
          } else if (id != 0 && iden != "") {
            Notify("Datos no validos. Ingrese solo un parametro.", "Error", "danger");
      
      
            tabladotr = $("#tablaOtDetalle").DataTable({
              destroy: true, //Cada vez que se construya una nueva tabla, destruye la anterior
              processing: true, //En caso de que sea mucha data, aparecerá un texto "procesando"
              columns: [
                { data: "dotr_codigo" },
                { data: "pro_codigo" },
                { data: "pro_nombre" },
                { data: "dotr_cantidad" },
                { data: "dotr_orden" },
                { data: "est_codigo" },
              ],
            });
      
            $("#dotrIdCodigo").val(0);
            $("#dotrIdCodigoNombre").val("");
      
            $(".loading").hide();
          } else {
            //Se valida que los parametros de ingreso tengan datos
      
            // Valida si cuentan con datos
            var parametros = {
              id: id,
              idenP: iden,
            };
      
            $.ajax({
              url: "ajax.php?modulo=ordentrabajo&controlador=ordentrabajo&funcion=validaOtDetalle",
              type: "POST",
              data: parametros,
              success: function (error) {
                var errorJson = JSON.parse(error);
                // console.log(errorJson);
                // console.log(parametros); 
      
                // Validar si el proceso no existe
                if (errorJson[0]["vaOrdenTrabajo"] > 0) {
                  var idProductoConsultado = errorJson[1]["otr_codigo"];
                  var nombreProductoConsultado = errorJson[1]["otr_identificador"];
      
                  $("#dotrIdCodigo").val(idProductoConsultado);
                  $("#dotrIdCodigoNombre").val(
                    idProductoConsultado + "-" + nombreProductoConsultado
                  );
                  // El proceso si existe
                  // Validar si tiene maquinas asociadas
                  if (errorJson[1]["vaProceso"] > 0) {
                    // El proceso cuenta con maquinas asociadas
                    
      
                    if (id != 0 && iden != "") {
                      Notify(
                        "La consulta solo se realiza por un campo ingresado.",
                        "Error",
                        "danger"
                      );
      
                      tabladotr = $("#tablaOtDetalle").DataTable({
                        destroy: true, //Cada vez que se construya una nueva tabla, destruye la anterior
                        processing: true, //En caso de que sea mucha data, aparecerá un texto "procesando"
                        columns: [
                          { data: "dotr_codigo" },
                          { data: "pro_codigo" },
                          { data: "pro_nombre" },
                          { data: "dotr_cantidad" },
                          { data: "dotr_orden" },
                          { data: "est_codigo" },
                        ],
                      });
                
                      $("#dotrIdCodigo").val(0);
                      $("#dotrIdCodigoNombre").val("");
                    } else if (id == 0 && iden != "") {
                      // Consulta por identificador text
                     
      
                      tabladotr = $("#tablaOtDetalle").DataTable({
                        ajax: {
                          url:
                            "ajax.php?modulo=ordentrabajo&controlador=ordentrabajo&funcion=getTableProductoDetalle&id=" +
                            id +
                            "&idenP=" +
                            iden,
                          dataSrc: "",
                        },
                        columns: [
                          { data: "dotr_codigo" },
                          { data: "pro_codigo" },
                          { data: "pro_nombre" },
                          { data: "dotr_cantidad" },
                          { data: "dotr_orden" },
                          { data: "est_codigo" },
                        ],
                      });
                    } else if (id != 0 && iden == "") {
                      
                      // Consulta por id
                      tabladotr = $("#tablaOtDetalle").DataTable({
                        ajax: {
                          url:
                            "ajax.php?modulo=ordentrabajo&controlador=ordentrabajo&funcion=getTableProductoDetalle&id=" +
                            id +
                            "&idenP=" +
                            iden,
                          dataSrc: "",
                        },
                        columns: [
                          { data: "dotr_codigo" },
                          { data: "pro_codigo" },
                          { data: "pro_nombre" },
                          { data: "dotr_cantidad" },
                          { data: "dotr_orden" },
                          { data: "est_codigo" },
                        ],
                      });
                      // console.log("ajax.php?modulo=producto&controlador=productobase&funcion=getTableProductoDetalle&id=" +
                      // id +
                      // "&idenP=" +
                      // iden);
                    } else {
                      Notify("Datos no validos.", "Error", "danger");
                      tabladotr = $("#tablaOtDetalle").DataTable({
                        destroy: true, //Cada vez que se construya una nueva tabla, destruye la anterior
                        processing: true, //En caso de que sea mucha data, aparecerá un texto "procesando"
                        columns: [
                          { data: "dotr_codigo" },
                          { data: "pro_codigo" },
                          { data: "pro_nombre" },
                          { data: "dotr_cantidad" },
                          { data: "dotr_orden" },
                          { data: "est_codigo" },
                        ],
                      });
                    }
                  } else {
                    // El proceso no cuenta con maquinas asociadas
                    Notify(
                      "El producto no cuenta con procesos asociados.",
                      "Aviso",
                      "info"
                    );
                    tabladotr = $("#tablaOtDetalle").DataTable({
                      destroy: true, //Cada vez que se construya una nueva tabla, destruye la anterior
                      processing: true, //En caso de que sea mucha data, aparecerá un texto "procesando"
                      columns: [
                        { data: "dotr_codigo" },
                        { data: "pro_codigo" },
                        { data: "pro_nombre" },
                        { data: "dotr_cantidad" },
                        { data: "dotr_orden" },
                        { data: "est_codigo" },
                      ],
                    });
              
      
              
                    // $("#dprodIdCodigo").val(0);
                    // $("#dprodIdCodigoNombre").val("");
      
                    // Si debe de tener el retorno del proceso
                  }
                } else {
                  // El proceso no existe
                  Notify("El proceso ingresado no existe.", "Error", "danger");
                  tabladotr = $("#tablaOtDetalle").DataTable({
                    destroy: true, //Cada vez que se construya una nueva tabla, destruye la anterior
                    processing: true, //En caso de que sea mucha data, aparecerá un texto "procesando"
                    columns: [
                      { data: "dotr_codigo" },
                      { data: "pro_codigo" },
                      { data: "pro_nombre" },
                      { data: "dotr_cantidad" },
                      { data: "dotr_orden" },
                      { data: "est_codigo" },
                    ],
                  });
            
                  $("#dotrIdCodigo").val(0);
                  $("#dotrIdCodigoNombre").val("");
                }
      
                // $(".loading").hide();
              },
            });
          }
          
        

        //---------------------------------------------

        $(".loading").hide();
      },
    });

    $("#agregarOtDetalleModal").modal("hide");
  });

  // Eliminar relacion proceso maquina
  $("#tablaOtDetalle tbody").on(
    "click",
    "button.eliminar",
    function () {
      var data = tabladotr.row($(this).parents("tr")).data();

      var idOrdentrabajo = $("#dotrIdCodigo").val();
      // console.log(data);
      // console.log(idProceso);

      var titulo = "";
      // var dpm_codigo = data.est_codigo.substr(
      //   data.est_codigo.indexOf("<button dpm_codigo = ") + 18,
      //   1
      // );
      var urlEliminar =
        "ajax.php?modulo=ordentrabajo&controlador=ordentrabajo&funcion=elimiarDetalleProducto";

      titulo = "¿Desea eliminar el proceso para el producto?";

      swal({
        title: titulo,
        text: "Una vez realizada esta operación no puede volver a realizar el cambio.",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      }).then((willDelete) => {
        if (willDelete) {
          //Se le deja el control del tiempo de espera a la funcion
          eliminarRelacion(idOrdentrabajo, data.pro_codigo, urlEliminar, tabladotr);
        }
      });
    }
  );
});

// Proceso Gestionar Maquina
var obtener_data_editar_proceso = function (tbody, table) {
  $(tbody).on("click", "button.editar", function () {
    var data = table.row($(this).parents("tr")).data();
    // console.log(data);
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

function eliminarRelacion(idCampo1, idCampo2, url, table) {
  $(".loading").show();
  // Parametros enviados
  var parametros = {
    idCampo1: idCampo1,
    idCampo2: idCampo2,
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



$(document).ready(function () {
  $(".loading").hide();

  
  // Proceso de Producto Detalle
  var tabladprod = $("#tablaDetalleProducto").DataTable({
    destroy: true, //Cada vez que se construya una nueva tabla, destruye la anterior
    processing: true, //En caso de que sea mucha data, aparecerá un texto "procesando"
    columns: [
      { data: "pro_codigo" },
      { data: "pro_identificador" },
      { data: "pro_nombre" },
      { data: "dprod_orden" },
      { data: "est_codigo" },
    ],
  });

  // Limpiar variables y campos
  $("#limpiardprod").click(function () {
    // Limpiar variables
    $("#idCodigoProducto").val(0);
    $("#idenProductoA").val("");
    $("#pmidCodigo").val(0);
    $("#pmIdCodigoNombreProceso").val("");

    // Limpiar Data Table
    tabladprod.destroy();
    tabladprod = $("#tablaDetalleProducto").DataTable({
      destroy: true, //Cada vez que se construya una nueva tabla, destruye la anterior
      processing: true, //En caso de que sea mucha data, aparecerá un texto "procesando"
      columns: [
        { data: "pro_codigo" },
        { data: "pro_identificador" },
        { data: "pro_nombre" },
        { data: "dprod_orden" },
        { data: "est_codigo" },
      ],
    });
  });

  // Consultar asosiacion
  $("#consultardprod").click(function () {
    
    $(".loading").show();
    var id = $("#idCodigoProducto").val();
    var iden = $("#idenProductoA").val();

    tabladprod.destroy();

    //Validacion de datos ingresados
    if (id == 0 && (iden == "" || iden == 0) ) {
      Notify(
        "Datos no validos. Ingrese un parametro de filtro.",
        "Error",
        "danger",
        giconError
      );

      tabladprod = $("#tablaDetalleProducto").DataTable({
        destroy: true, //Cada vez que se construya una nueva tabla, destruye la anterior
        processing: true, //En caso de que sea mucha data, aparecerá un texto "procesando"
        columns: [
          { data: "pro_codigo" },
          { data: "pro_identificador" },
          { data: "pro_nombre" },
          { data: "dprod_orden" },
          { data: "est_codigo" },
        ],
      });

      $("#dprodIdCodigo").val(0);
      $("#dprodIdCodigoNombre").val("");
      $(".loading").hide();
    } else if (id != 0 && iden != "") {
      Notify("Datos no validos. Ingrese solo un parametro.", "Error", "danger",giconError);

      tabladprod = $("#tablaDetalleProducto").DataTable({
        destroy: true, //Cada vez que se construya una nueva tabla, destruye la anterior
        processing: true, //En caso de que sea mucha data, aparecerá un texto "procesando"
        columns: [
          { data: "pro_codigo" },
          { data: "pro_identificador" },
          { data: "pro_nombre" },
          { data: "dprod_orden" },
          { data: "est_codigo" },
        ],
      });

      $("#dprodIdCodigo").val(0);
      $("#dprodIdCodigoNombre").val("");
      $(".loading").hide();
    } else {
      //Se valida que los parametros de ingreso tengan datos

      // Valida si cuentan con datos
      var parametros = {
        id: id,
        idenP: iden,
      };

      $.ajax({
        url: "ajax.php?modulo=producto&controlador=productobase&funcion=validaDetalleProducto",
        type: "POST",
        data: parametros,
        success: function (error) {
          var errorJson = JSON.parse(error);
          // console.log(errorJson);
          // console.log(parametros); 

          // Validar si el proceso no existe
          if (errorJson[0]["vaProducto"] > 0) {
            var idProductoConsultado = errorJson[1]["prod_codigo"];
            var nombreProductoConsultado = errorJson[1]["prod_descripcion"];
            $("#dprodIdCodigo").val(idProductoConsultado);
            $("#dprodIdCodigoNombre").val(
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
                  "danger",
                  giconError
                );

                tabladprod = $("#tablaDetalleProducto").DataTable({
                  destroy: true, //Cada vez que se construya una nueva tabla, destruye la anterior
                  processing: true, //En caso de que sea mucha data, aparecerá un texto "procesando"
                  columns: [
                    { data: "pro_codigo" },
                    { data: "pro_identificador" },
                    { data: "pro_nombre" },
                    { data: "dprod_orden" },
                    { data: "est_codigo" },
                  ],
                });
          
                $("#dprodIdCodigo").val(0);
                $("#dprodIdCodigoNombre").val("");
              } else if (id == 0 && iden != "") {
                // Consulta por identificador text
               

                tabladprod = $("#tablaDetalleProducto").DataTable({
                  ajax: {
                    url:
                      "ajax.php?modulo=producto&controlador=productobase&funcion=getTableProductoDetalle&id=" +
                      id +
                      "&idenP=" +
                      iden,
                    dataSrc: "",
                  },
                  columns: [
                    { data: "pro_codigo" },
                    { data: "pro_identificador" },
                    { data: "pro_nombre" },
                    { data: "dprod_orden" },
                    { data: "est_codigo" },
                  ],
                });
              } else if (id != 0 && iden == "") {
                
                // Consulta por id
                tabladprod = $("#tablaDetalleProducto").DataTable({
                  ajax: {
                    url:
                      "ajax.php?modulo=producto&controlador=productobase&funcion=getTableProductoDetalle&id=" +
                      id +
                      "&idenP=" +
                      iden,
                    dataSrc: "",
                  },
                  columns: [
                    { data: "pro_codigo" },
                    { data: "pro_identificador" },
                    { data: "pro_nombre" },
                    { data: "dprod_orden" },
                    { data: "est_codigo" },
                  ],
                });
                // console.log("ajax.php?modulo=producto&controlador=productobase&funcion=getTableProductoDetalle&id=" +
                // id +
                // "&idenP=" +
                // iden);
              } else {
                Notify("Datos no validos.", "Error", "danger",giconError);
                tabladpm = $("#tablaDetalleProcesoMaquina").DataTable({
                  destroy: true, //Cada vez que se construya una nueva tabla, destruye la anterior
                  processing: true, //En caso de que sea mucha data, aparecerá un texto "procesando"
                  columns: [
                    { data: "pro_codigo" },
                    { data: "pro_identificador" },
                    { data: "pro_nombre" },
                    { data: "dprod_orden" },
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
              tabladprod = $("#tablaDetalleProducto").DataTable({
                destroy: true, //Cada vez que se construya una nueva tabla, destruye la anterior
                processing: true, //En caso de que sea mucha data, aparecerá un texto "procesando"
                columns: [
                  { data: "pro_codigo" },
                  { data: "pro_identificador" },
                  { data: "pro_nombre" },
                  { data: "dprod_orden" },
                  { data: "est_codigo" },
                ],
              });
        
              // $("#dprodIdCodigo").val(0);
              // $("#dprodIdCodigoNombre").val("");

              // Si debe de tener el retorno del proceso
            }
          } else {
            // El proceso no existe
            Notify("El proceso ingresado no existe.", "Error", "danger",giconError);
            tabladprod = $("#tablaDetalleProducto").DataTable({
              destroy: true, //Cada vez que se construya una nueva tabla, destruye la anterior
              processing: true, //En caso de que sea mucha data, aparecerá un texto "procesando"
              columns: [
                { data: "pro_codigo" },
                { data: "pro_identificador" },
                { data: "pro_nombre" },
                { data: "dprod_orden" },
                { data: "est_codigo" },
              ],
            });
      
            $("#dprodIdCodigo").val(0);
            $("#dprodIdCodigoNombre").val("");
          }

          $(".loading").hide();
        },
      });
    }
    
  });

  // MODAL ASIGANCION MAQUINA
  $("#dprodIdCodigoProcesoSelect").change(function () {
    var valor = $(this).val();
    $("#dprodIdCodigoProceso").val(valor);
  });

  // Dato Titulo
  $("#agregarProductoDetalle").click(function () {
    $(".loading").show();

    var url = $(this).attr("data-url");
    var formulario = $("#formProductoDetalle").serialize();
    $.ajax({
      url: url,
      type: "POST",
      data: formulario,
      success: function (mensaje) {
        if(mensaje == 'Insercion exitosa'){

        
        Notify(mensaje, "Exito!", "success", "fas fa-check");
        // tabladpm.ajax.reload();

        //---- CARGA DE LA TABLA RELACION  -------



    
          // $(".loading").show();
          var id = $("#idCodigoProducto").val();
          var iden = $("#idenProductoA").val();
      
          tabladprod.destroy();
      
          //Validacion de datos ingresados
          if (id == 0 && (iden == "" || iden == 0) ) {
            Notify(
              "Datos no validos. Ingrese un parametro de filtro.",
              "Error",
              "danger"
            );
      
            tabladprod = $("#tablaDetalleProducto").DataTable({
              destroy: true, //Cada vez que se construya una nueva tabla, destruye la anterior
              processing: true, //En caso de que sea mucha data, aparecerá un texto "procesando"
              columns: [
                { data: "pro_codigo" },
                { data: "pro_identificador" },
                { data: "pro_nombre" },
                { data: "dprod_orden" },
                { data: "est_codigo" },
              ],
            });
      
            $("#dprodIdCodigo").val(0);
            $("#dprodIdCodigoNombre").val("");
            $(".loading").hide();
          } else if (id != 0 && iden != "") {
            Notify("Datos no validos. Ingrese solo un parametro.", "Error", "danger",giconError);
      
            tabladprod = $("#tablaDetalleProducto").DataTable({
              destroy: true, //Cada vez que se construya una nueva tabla, destruye la anterior
              processing: true, //En caso de que sea mucha data, aparecerá un texto "procesando"
              columns: [
                { data: "pro_codigo" },
                { data: "pro_identificador" },
                { data: "pro_nombre" },
                { data: "dprod_orden" },
                { data: "est_codigo" },
              ],
            });
      
            $("#dprodIdCodigo").val(0);
            $("#dprodIdCodigoNombre").val("");
            $(".loading").hide();
          } else {
            //Se valida que los parametros de ingreso tengan datos
      
            // Valida si cuentan con datos
            var parametros = {
              id: id,
              idenP: iden,
            };
      
            $.ajax({
              url: "ajax.php?modulo=producto&controlador=productobase&funcion=validaDetalleProducto",
              type: "POST",
              data: parametros,
              success: function (error) {
                var errorJson = JSON.parse(error);
                // console.log(errorJson);
                // console.log(parametros); 
      
                // Validar si el proceso no existe
                if (errorJson[0]["vaProducto"] > 0) {
                  var idProductoConsultado = errorJson[1]["prod_codigo"];
                  var nombreProductoConsultado = errorJson[1]["prod_descripcion"];
                  $("#dprodIdCodigo").val(idProductoConsultado);
                  $("#dprodIdCodigoNombre").val(
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
      
                      tabladprod = $("#tablaDetalleProducto").DataTable({
                        destroy: true, //Cada vez que se construya una nueva tabla, destruye la anterior
                        processing: true, //En caso de que sea mucha data, aparecerá un texto "procesando"
                        columns: [
                          { data: "pro_codigo" },
                          { data: "pro_identificador" },
                          { data: "pro_nombre" },
                          { data: "dprod_orden" },
                          { data: "est_codigo" },
                        ],
                      });
                
                      $("#dprodIdCodigo").val(0);
                      $("#dprodIdCodigoNombre").val("");
                    } else if (id == 0 && iden != "") {
                      // Consulta por identificador text
                     
      
                      tabladprod = $("#tablaDetalleProducto").DataTable({
                        ajax: {
                          url:
                            "ajax.php?modulo=producto&controlador=productobase&funcion=getTableProductoDetalle&id=" +
                            id +
                            "&idenP=" +
                            iden,
                          dataSrc: "",
                        },
                        columns: [
                          { data: "pro_codigo" },
                          { data: "pro_identificador" },
                          { data: "pro_nombre" },
                          { data: "dprod_orden" },
                          { data: "est_codigo" },
                        ],
                      });
                    } else if (id != 0 && iden == "") {
                      
                      // Consulta por id
                      tabladprod = $("#tablaDetalleProducto").DataTable({
                        ajax: {
                          url:
                            "ajax.php?modulo=producto&controlador=productobase&funcion=getTableProductoDetalle&id=" +
                            id +
                            "&idenP=" +
                            iden,
                          dataSrc: "",
                        },
                        columns: [
                          { data: "pro_codigo" },
                          { data: "pro_identificador" },
                          { data: "pro_nombre" },
                          { data: "dprod_orden" },
                          { data: "est_codigo" },
                        ],
                      });
                      // console.log("ajax.php?modulo=producto&controlador=productobase&funcion=getTableProductoDetalle&id=" +
                      // id +
                      // "&idenP=" +
                      // iden);
                    } else {
                      Notify("Datos no validos.", "Error", "danger",giconError);
                      tabladpm = $("#tablaDetalleProcesoMaquina").DataTable({
                        destroy: true, //Cada vez que se construya una nueva tabla, destruye la anterior
                        processing: true, //En caso de que sea mucha data, aparecerá un texto "procesando"
                        columns: [
                          { data: "pro_codigo" },
                          { data: "pro_identificador" },
                          { data: "pro_nombre" },
                          { data: "dprod_orden" },
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
                    tabladprod = $("#tablaDetalleProducto").DataTable({
                      destroy: true, //Cada vez que se construya una nueva tabla, destruye la anterior
                      processing: true, //En caso de que sea mucha data, aparecerá un texto "procesando"
                      columns: [
                        { data: "pro_codigo" },
                        { data: "pro_identificador" },
                        { data: "pro_nombre" },
                        { data: "dprod_orden" },
                        { data: "est_codigo" },
                      ],
                    });
              
                    // $("#dprodIdCodigo").val(0);
                    // $("#dprodIdCodigoNombre").val("");
      
                    // Si debe de tener el retorno del proceso
                  }
                } else {
                  // El proceso no existe
                  Notify("El proceso ingresado no existe.", "Error", "danger",giconError);
                  tabladprod = $("#tablaDetalleProducto").DataTable({
                    destroy: true, //Cada vez que se construya una nueva tabla, destruye la anterior
                    processing: true, //En caso de que sea mucha data, aparecerá un texto "procesando"
                    columns: [
                      { data: "pro_codigo" },
                      { data: "pro_identificador" },
                      { data: "pro_nombre" },
                      { data: "dprod_orden" },
                      { data: "est_codigo" },
                    ],
                  });
            
                  $("#dprodIdCodigo").val(0);
                  $("#dprodIdCodigoNombre").val("");
                }
      
                // $(".loading").hide();
              },
            });
          }
          
        



        //---------------------------------------------
        }else{
          Notify(mensaje, "Error!", "danger", giconError);
        }
        $(".loading").hide();
      },
    });

    $("#agregarAsignacionMaquinaModal").modal("hide");
  });

  // Eliminar relacion proceso maquina
  $("#tablaDetalleProducto tbody").on(
    "click",
    "button.eliminar",
    function () {
      var data = tabladprod.row($(this).parents("tr")).data();

      var idProducto = $("#dprodIdCodigo").val();
      // console.log(data);
      // console.log(idProceso);

      var titulo = "";
      // var dpm_codigo = data.est_codigo.substr(
      //   data.est_codigo.indexOf("<button dpm_codigo = ") + 18,
      //   1
      // );
      var urlEliminar =
        "ajax.php?modulo=producto&controlador=productobase&funcion=elimiarDetalleProducto";

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
          eliminarRelacion(idProducto, data.pro_codigo, urlEliminar, tabladprod);
        }
      });
    }
  );
});



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
      if(mensaje == 'Insercion exitosa'){
        Notify(mensaje,'Exito!','success','fas fa-check');
        table.ajax.reload();
      }else{
        Notify(mensaje, "Error!", "danger", giconError);
      }
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
      if(mensaje == 'Insercion exitosa'){
        Notify(mensaje,'Exito!','success','fas fa-check');
        table.ajax.reload();
      }else{
        Notify(mensaje, "Error!", "danger", giconError);
      }
      $(".loading").hide();
    },
  });
}



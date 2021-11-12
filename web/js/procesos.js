$(document).ready(function () {
  $(".loading").hide();

  // Proceso de -- Gestionar Maquina
  // Se Crea la tabla y se deja activa para el resto de procesos

  var tablepro = $("#tablaGestionarProceso").DataTable({
    language: {
      "decimal": "",
      "emptyTable": "No hay información",
      "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
      "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
      "infoFiltered": "(Filtrado de _MAX_ total entradas)",
      "infoPostFix": "",
      "thousands": ",",
      "lengthMenu": "Mostrar _MENU_ Entradas",
      "loadingRecords": "Cargando...",
      "processing": "Procesando...",
      "search": "Buscar:",
      "zeroRecords": "Sin resultados encontrados",
      "paginate": {
          "first": "Primero",
          "last": "Ultimo",
          "next": "Siguiente",
          "previous": "Anterior"
          }
      },
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

  obtener_data_editar_proceso("#tablaGestionarProceso tbody", tablepro);

  $("#agregarProceso").click(function () {
    $(".loading").show();
    var url = $(this).attr("data-url");
    var formulario = $("#formAgregarProceso").serialize();
    $.ajax({
      url: url,
      type: "POST",
      data: formulario,
      success: function (mensaje) {
        if(mensaje == 'Insercion exitosa'){
          Notify(mensaje, "Exito!", "success", "fas fa-check");
          tablepro.ajax.reload();
        }else{
          Notify(mensaje, "Error!", "danger", giconError);
        }

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
        if(mensaje == 'Insercion exitosa'){
          Notify(mensaje, "Exito!", "success", "fas fa-check");
          tablepro.ajax.reload();
        }else{
          Notify(mensaje, "Error!", "danger", giconError);
        }
        $(".loading").hide();
      },
    });
    $("#editarProcesoModal").modal("hide");
  });

  // Deshabilitar Maquina

  $("#tablaGestionarProceso tbody").on("click", "button.eliminar", function () {
    var data = tablepro.row($(this).parents("tr")).data();
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
        cambioEstado(data.pro_codigo, est_codigo, urlEliminar, tablepro);
      }
    });
  });




  
  // Proceso de Asignacion de Maquina
  var tabladpm = $("#tablaDetalleProcesoMaquina").DataTable({
    language: {
      "decimal": "",
      "emptyTable": "No hay información",
      "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
      "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
      "infoFiltered": "(Filtrado de _MAX_ total entradas)",
      "infoPostFix": "",
      "thousands": ",",
      "lengthMenu": "Mostrar _MENU_ Entradas",
      "loadingRecords": "Cargando...",
      "processing": "Procesando...",
      "search": "Buscar:",
      "zeroRecords": "Sin resultados encontrados",
      "paginate": {
          "first": "Primero",
          "last": "Ultimo",
          "next": "Siguiente",
          "previous": "Anterior"
          }
      },
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
  $("#limpiar").click(function () {
    // Limpiar variables
    $("#idCodigoProceso").val(0);
    $("#idenProcesoA").val("");
    $("#pmidCodigo").val(0);
    $("#pmIdCodigoNombreProceso").val("");

    // Limpiar Data Table
    tabladpm.destroy();
    tabladpm = $("#tablaDetalleProcesoMaquina").DataTable({
      language: {
        "decimal": "",
        "emptyTable": "No hay información",
        "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
        "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
        "infoFiltered": "(Filtrado de _MAX_ total entradas)",
        "infoPostFix": "",
        "thousands": ",",
        "lengthMenu": "Mostrar _MENU_ Entradas",
        "loadingRecords": "Cargando...",
        "processing": "Procesando...",
        "search": "Buscar:",
        "zeroRecords": "Sin resultados encontrados",
        "paginate": {
            "first": "Primero",
            "last": "Ultimo",
            "next": "Siguiente",
            "previous": "Anterior"
            }
        },
      destroy: true, //Cada vez que se construya una nueva tabla, destruye la anterior
      processing: true, //En caso de que sea mucha data, aparecerá un texto "procesando"
      columns: [
        { data: "maq_codigo" },
        { data: "maq_identificador" },
        { data: "maq_nombre" },
        { data: "est_codigo" },
      ],
    });
  });

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
        "danger",
        giconError
      );

      tabladpm = $("#tablaDetalleProcesoMaquina").DataTable({
        language: {
          "decimal": "",
          "emptyTable": "No hay información",
          "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
          "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
          "infoFiltered": "(Filtrado de _MAX_ total entradas)",
          "infoPostFix": "",
          "thousands": ",",
          "lengthMenu": "Mostrar _MENU_ Entradas",
          "loadingRecords": "Cargando...",
          "processing": "Procesando...",
          "search": "Buscar:",
          "zeroRecords": "Sin resultados encontrados",
          "paginate": {
              "first": "Primero",
              "last": "Ultimo",
              "next": "Siguiente",
              "previous": "Anterior"
              }
          },
        destroy: true, //Cada vez que se construya una nueva tabla, destruye la anterior
        processing: true, //En caso de que sea mucha data, aparecerá un texto "procesando"
        columns: [
          { data: "maq_codigo" },
          { data: "maq_identificador" },
          { data: "maq_nombre" },
          { data: "est_codigo" },
        ],
      });

      $("#pmidCodigo").val(0);
      $("#pmIdCodigoNombreProceso").val("");
      $(".loading").hide();
    } else if (id != 0 && iden != "") {
      Notify("Datos no validos. Ingrese solo un parametro.", "Error", "danger", giconError);

      tabladpm = $("#tablaDetalleProcesoMaquina").DataTable({
        language: {
          "decimal": "",
          "emptyTable": "No hay información",
          "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
          "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
          "infoFiltered": "(Filtrado de _MAX_ total entradas)",
          "infoPostFix": "",
          "thousands": ",",
          "lengthMenu": "Mostrar _MENU_ Entradas",
          "loadingRecords": "Cargando...",
          "processing": "Procesando...",
          "search": "Buscar:",
          "zeroRecords": "Sin resultados encontrados",
          "paginate": {
              "first": "Primero",
              "last": "Ultimo",
              "next": "Siguiente",
              "previous": "Anterior"
              }
          },
        destroy: true, //Cada vez que se construya una nueva tabla, destruye la anterior
        processing: true, //En caso de que sea mucha data, aparecerá un texto "procesando"
        columns: [
          { data: "maq_codigo" },
          { data: "maq_identificador" },
          { data: "maq_nombre" },
          { data: "est_codigo" },
        ],
      });

      $("#pmidCodigo").val(0);
      $("#pmIdCodigoNombreProceso").val("");
      $(".loading").hide();
    } else {
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
            var idProcesoConsultado = errorJson[1]["pro_codigo"];
            var nombreProcesoConsultado = errorJson[1]["pro_descripcion"];
            $("#pmidCodigo").val(idProcesoConsultado);
            $("#pmIdCodigoNombreProceso").val(
              idProcesoConsultado + "-" + nombreProcesoConsultado
            );
            // El proceso si existe
            // Validar si tiene maquinas asociadas
            if (errorJson[1]["vaMaquina"] > 0) {
              // El proceso cuenta con maquinas asociadas

              if (id != 0 && iden != "") {
                Notify(
                  "La consulta solo se realiza por un campo ingresado.",
                  "Error",
                  "danger",
                  giconError
                );

                tabladpm = $("#tablaDetalleProcesoMaquina").DataTable({
                  language: {
                    "decimal": "",
                    "emptyTable": "No hay información",
                    "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                    "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
                    "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                    "infoPostFix": "",
                    "thousands": ",",
                    "lengthMenu": "Mostrar _MENU_ Entradas",
                    "loadingRecords": "Cargando...",
                    "processing": "Procesando...",
                    "search": "Buscar:",
                    "zeroRecords": "Sin resultados encontrados",
                    "paginate": {
                        "first": "Primero",
                        "last": "Ultimo",
                        "next": "Siguiente",
                        "previous": "Anterior"
                        }
                    },
                  destroy: true, //Cada vez que se construya una nueva tabla, destruye la anterior
                  processing: true, //En caso de que sea mucha data, aparecerá un texto "procesando"
                  columns: [
                    { data: "maq_codigo" },
                    { data: "maq_identificador" },
                    { data: "maq_nombre" },
                    { data: "est_codigo" },
                  ],
                });
                $("#pmidCodigo").val(0);
                $("#pmIdCodigoNombreProceso").val("");
              } else if (id == 0 && iden != "") {
                // Consulta por identificador text

                tabladpm = $("#tablaDetalleProcesoMaquina").DataTable({
                  language: {
                    "decimal": "",
                    "emptyTable": "No hay información",
                    "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                    "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
                    "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                    "infoPostFix": "",
                    "thousands": ",",
                    "lengthMenu": "Mostrar _MENU_ Entradas",
                    "loadingRecords": "Cargando...",
                    "processing": "Procesando...",
                    "search": "Buscar:",
                    "zeroRecords": "Sin resultados encontrados",
                    "paginate": {
                        "first": "Primero",
                        "last": "Ultimo",
                        "next": "Siguiente",
                        "previous": "Anterior"
                        }
                    },
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
                  language: {
                    "decimal": "",
                    "emptyTable": "No hay información",
                    "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                    "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
                    "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                    "infoPostFix": "",
                    "thousands": ",",
                    "lengthMenu": "Mostrar _MENU_ Entradas",
                    "loadingRecords": "Cargando...",
                    "processing": "Procesando...",
                    "search": "Buscar:",
                    "zeroRecords": "Sin resultados encontrados",
                    "paginate": {
                        "first": "Primero",
                        "last": "Ultimo",
                        "next": "Siguiente",
                        "previous": "Anterior"
                        }
                    },
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
                Notify("Datos no validos.", "Error", "danger",giconError);
                tabladpm = $("#tablaDetalleProcesoMaquina").DataTable({
                  language: {
                    "decimal": "",
                    "emptyTable": "No hay información",
                    "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                    "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
                    "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                    "infoPostFix": "",
                    "thousands": ",",
                    "lengthMenu": "Mostrar _MENU_ Entradas",
                    "loadingRecords": "Cargando...",
                    "processing": "Procesando...",
                    "search": "Buscar:",
                    "zeroRecords": "Sin resultados encontrados",
                    "paginate": {
                        "first": "Primero",
                        "last": "Ultimo",
                        "next": "Siguiente",
                        "previous": "Anterior"
                        }
                    },
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
                language: {
                  "decimal": "",
                  "emptyTable": "No hay información",
                  "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                  "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
                  "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                  "infoPostFix": "",
                  "thousands": ",",
                  "lengthMenu": "Mostrar _MENU_ Entradas",
                  "loadingRecords": "Cargando...",
                  "processing": "Procesando...",
                  "search": "Buscar:",
                  "zeroRecords": "Sin resultados encontrados",
                  "paginate": {
                      "first": "Primero",
                      "last": "Ultimo",
                      "next": "Siguiente",
                      "previous": "Anterior"
                      }
                  },
                destroy: true, //Cada vez que se construya una nueva tabla, destruye la anterior
                processing: true, //En caso de que sea mucha data, aparecerá un texto "procesando"
                columns: [
                  { data: "maq_codigo" },
                  { data: "maq_identificador" },
                  { data: "maq_nombre" },
                  { data: "est_codigo" },
                ],
              });

              // Si debe de tener el retorno del proceso
            }
          } else {
            // El proceso no existe
            Notify("El proceso ingresado no existe.", "Error", "danger",giconError);
            tabladpm = $("#tablaDetalleProcesoMaquina").DataTable({
              language: {
                "decimal": "",
                "emptyTable": "No hay información",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
                "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Entradas",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "Buscar:",
                "zeroRecords": "Sin resultados encontrados",
                "paginate": {
                    "first": "Primero",
                    "last": "Ultimo",
                    "next": "Siguiente",
                    "previous": "Anterior"
                    }
                },
              destroy: true, //Cada vez que se construya una nueva tabla, destruye la anterior
              processing: true, //En caso de que sea mucha data, aparecerá un texto "procesando"
              columns: [
                { data: "maq_codigo" },
                { data: "maq_identificador" },
                { data: "maq_nombre" },
                { data: "est_codigo" },
              ],
            });
            $("#pmidCodigo").val(0);
            $("#pmIdCodigoNombreProceso").val("");
          }

          $(".loading").hide();
        },
      });
    }
    
  });

  // MODAL ASIGANCION MAQUINA
  $("#pmIdCodigoMaquinaSelect").change(function () {
    var valor = $(this).val();
    $("#pmIdCodigoMaquina").val(valor);
  });

  // Dato Titulo
  $("#agregarAsignacionMaquina").click(function () {
    $(".loading").show();

    var url = $(this).attr("data-url");
    var formulario = $("#formAsociarMaquina").serialize();
    $.ajax({
      url: url,
      type: "POST",
      data: formulario,
      success: function (mensaje) {
        console.log(mensaje);
        if(mensaje == 'Insercion exitosa'){

        Notify(mensaje, "Exito!", "success", "fas fa-check");
        // tabladpm.ajax.reload();

        //---- CARGA DE LA TABLA RELACION  -------
          var id = $("#idCodigoProceso").val();
          var iden = $("#idenProcesoA").val() + "";     
          tabladpm.destroy();
          //Validacion de datos ingresados
          if (id == 0 && iden == "") {
            Notify(
              "Datos no validos. Ingrese un parametro de filtro.",
              "Error",
              "danger",
              giconError
            );
      
            tabladpm = $("#tablaDetalleProcesoMaquina").DataTable({
              language: {
                "decimal": "",
                "emptyTable": "No hay información",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
                "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Entradas",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "Buscar:",
                "zeroRecords": "Sin resultados encontrados",
                "paginate": {
                    "first": "Primero",
                    "last": "Ultimo",
                    "next": "Siguiente",
                    "previous": "Anterior"
                    }
                },
              destroy: true, //Cada vez que se construya una nueva tabla, destruye la anterior
              processing: true, //En caso de que sea mucha data, aparecerá un texto "procesando"
              columns: [
                { data: "maq_codigo" },
                { data: "maq_identificador" },
                { data: "maq_nombre" },
                { data: "est_codigo" },
              ],
            });
      
            $("#pmidCodigo").val(0);
            $("#pmIdCodigoNombreProceso").val("");
            $(".loading").hide();
          } else if (id != 0 && iden != "") {
            Notify("Datos no validos. Ingrese solo un parametro.", "Error", "danger",giconError);
      
            tabladpm = $("#tablaDetalleProcesoMaquina").DataTable({
              language: {
                "decimal": "",
                "emptyTable": "No hay información",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
                "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Entradas",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "Buscar:",
                "zeroRecords": "Sin resultados encontrados",
                "paginate": {
                    "first": "Primero",
                    "last": "Ultimo",
                    "next": "Siguiente",
                    "previous": "Anterior"
                    }
                },
              destroy: true, //Cada vez que se construya una nueva tabla, destruye la anterior
              processing: true, //En caso de que sea mucha data, aparecerá un texto "procesando"
              columns: [
                { data: "maq_codigo" },
                { data: "maq_identificador" },
                { data: "maq_nombre" },
                { data: "est_codigo" },
              ],
            });
      
            $("#pmidCodigo").val(0);
            $("#pmIdCodigoNombreProceso").val("");
            $(".loading").hide();
          } else {
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
                  var idProcesoConsultado = errorJson[1]["pro_codigo"];
                  var nombreProcesoConsultado = errorJson[1]["pro_descripcion"];
                  $("#pmidCodigo").val(idProcesoConsultado);
                  $("#pmIdCodigoNombreProceso").val(
                    idProcesoConsultado + "-" + nombreProcesoConsultado
                  );
                  // El proceso si existe
                  // Validar si tiene maquinas asociadas
                  if (errorJson[1]["vaMaquina"] > 0) {
                    // El proceso cuenta con maquinas asociadas
      
                    if (id != 0 && iden != "") {
                      Notify(
                        "La consulta solo se realiza por un campo ingresado.",
                        "Error",
                        "danger",
                        giconError
                      );
      
                      tabladpm = $("#tablaDetalleProcesoMaquina").DataTable({
                        language: {
                          "decimal": "",
                          "emptyTable": "No hay información",
                          "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                          "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
                          "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                          "infoPostFix": "",
                          "thousands": ",",
                          "lengthMenu": "Mostrar _MENU_ Entradas",
                          "loadingRecords": "Cargando...",
                          "processing": "Procesando...",
                          "search": "Buscar:",
                          "zeroRecords": "Sin resultados encontrados",
                          "paginate": {
                              "first": "Primero",
                              "last": "Ultimo",
                              "next": "Siguiente",
                              "previous": "Anterior"
                              }
                          },
                        destroy: true, //Cada vez que se construya una nueva tabla, destruye la anterior
                        processing: true, //En caso de que sea mucha data, aparecerá un texto "procesando"
                        columns: [
                          { data: "maq_codigo" },
                          { data: "maq_identificador" },
                          { data: "maq_nombre" },
                          { data: "est_codigo" },
                        ],
                      });
                      $("#pmidCodigo").val(0);
                      $("#pmIdCodigoNombreProceso").val("");
                    } else if (id == 0 && iden != "") {
                      // Consulta por identificador text
      
                      tabladpm = $("#tablaDetalleProcesoMaquina").DataTable({
                        language: {
                          "decimal": "",
                          "emptyTable": "No hay información",
                          "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                          "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
                          "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                          "infoPostFix": "",
                          "thousands": ",",
                          "lengthMenu": "Mostrar _MENU_ Entradas",
                          "loadingRecords": "Cargando...",
                          "processing": "Procesando...",
                          "search": "Buscar:",
                          "zeroRecords": "Sin resultados encontrados",
                          "paginate": {
                              "first": "Primero",
                              "last": "Ultimo",
                              "next": "Siguiente",
                              "previous": "Anterior"
                              }
                          },
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
                        language: {
                          "decimal": "",
                          "emptyTable": "No hay información",
                          "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                          "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
                          "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                          "infoPostFix": "",
                          "thousands": ",",
                          "lengthMenu": "Mostrar _MENU_ Entradas",
                          "loadingRecords": "Cargando...",
                          "processing": "Procesando...",
                          "search": "Buscar:",
                          "zeroRecords": "Sin resultados encontrados",
                          "paginate": {
                              "first": "Primero",
                              "last": "Ultimo",
                              "next": "Siguiente",
                              "previous": "Anterior"
                              }
                          },
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
                      Notify("Datos no validos.", "Error", "danger", giconError);
                      tabladpm = $("#tablaDetalleProcesoMaquina").DataTable({
                        language: {
                          "decimal": "",
                          "emptyTable": "No hay información",
                          "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                          "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
                          "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                          "infoPostFix": "",
                          "thousands": ",",
                          "lengthMenu": "Mostrar _MENU_ Entradas",
                          "loadingRecords": "Cargando...",
                          "processing": "Procesando...",
                          "search": "Buscar:",
                          "zeroRecords": "Sin resultados encontrados",
                          "paginate": {
                              "first": "Primero",
                              "last": "Ultimo",
                              "next": "Siguiente",
                              "previous": "Anterior"
                              }
                          },
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
                      language: {
                        "decimal": "",
                        "emptyTable": "No hay información",
                        "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                        "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
                        "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                        "infoPostFix": "",
                        "thousands": ",",
                        "lengthMenu": "Mostrar _MENU_ Entradas",
                        "loadingRecords": "Cargando...",
                        "processing": "Procesando...",
                        "search": "Buscar:",
                        "zeroRecords": "Sin resultados encontrados",
                        "paginate": {
                            "first": "Primero",
                            "last": "Ultimo",
                            "next": "Siguiente",
                            "previous": "Anterior"
                            }
                        },
                      destroy: true, //Cada vez que se construya una nueva tabla, destruye la anterior
                      processing: true, //En caso de que sea mucha data, aparecerá un texto "procesando"
                      columns: [
                        { data: "maq_codigo" },
                        { data: "maq_identificador" },
                        { data: "maq_nombre" },
                        { data: "est_codigo" },
                      ],
                    });
      
                    // Si debe de tener el retorno del proceso
                  }
                } else {
                  // El proceso no existe
                  Notify("El proceso ingresado no existe.", "Error", "danger", giconError);
                  tabladpm = $("#tablaDetalleProcesoMaquina").DataTable({
                    language: {
                      "decimal": "",
                      "emptyTable": "No hay información",
                      "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                      "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
                      "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                      "infoPostFix": "",
                      "thousands": ",",
                      "lengthMenu": "Mostrar _MENU_ Entradas",
                      "loadingRecords": "Cargando...",
                      "processing": "Procesando...",
                      "search": "Buscar:",
                      "zeroRecords": "Sin resultados encontrados",
                      "paginate": {
                          "first": "Primero",
                          "last": "Ultimo",
                          "next": "Siguiente",
                          "previous": "Anterior"
                          }
                      },
                    destroy: true, //Cada vez que se construya una nueva tabla, destruye la anterior
                    processing: true, //En caso de que sea mucha data, aparecerá un texto "procesando"
                    columns: [
                      { data: "maq_codigo" },
                      { data: "maq_identificador" },
                      { data: "maq_nombre" },
                      { data: "est_codigo" },
                    ],
                  });
                  $("#pmidCodigo").val(0);
                  $("#pmIdCodigoNombreProceso").val("");
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
  $("#tablaDetalleProcesoMaquina tbody").on(
    "click",
    "button.eliminar",
    function () {
      var data = tabladpm.row($(this).parents("tr")).data();

      var idProceso = $("#pmidCodigo").val();
      // console.log(data);
      // console.log(idProceso);

      var titulo = "";
      // var dpm_codigo = data.est_codigo.substr(
      //   data.est_codigo.indexOf("<button dpm_codigo = ") + 18,
      //   1
      // );
      var urlEliminar =
        "ajax.php?modulo=procesos&controlador=procesos&funcion=elimiarMaquinaProceso";

      titulo = "¿Desea eliminar la maquina para el proceso?";

      swal({
        title: titulo,
        text: "Una vez realizada esta operación no puede volver a realizar el cambio.",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      }).then((willDelete) => {
        if (willDelete) {
          //Se le deja el control del tiempo de espera a la funcion
          eliminarRelacion(idProceso, data.maq_codigo, urlEliminar, tabladpm);
        }
      });
    }
  );
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



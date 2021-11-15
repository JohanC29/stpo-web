  $(document).ready(function () {
 $(".loading").hide();
 // Se Crea la tabla y se deja activa para el resto de procesos
 var tableEmpleado = $("#tablaGestionarEmpleado").DataTable({
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
    "ajax":{
      "url" : "ajax.php?modulo=empleado&controlador=empleado&funcion=getTable",
      "dataSrc":""
    },
    "columns":[
        {"data":"emp_codigo"},
        {"data":"emp_cedula"},
        {"data":"emp_nombre"},
        {"data":"emp_apellido"},
        {"data":"emp_cargo"},
        {"data":"est_codigo"}
    ]
  });


  obtener_data_editar_empleado("#tablaGestionarEmpleado tbody",tableEmpleado);

  $("#btn-reload").on("click", function () {
    //table.ajax.reload();
  });

  $("#agregarEmpleado").click(function () {
    $(".loading").show();
    var url = $(this).attr("data-url");
    var formulario = $("#formAgregarEmpleado").serialize();
    $.ajax({
      url: url,
      type: "POST",
      data: formulario,
      success: function (mensaje) {
        if(mensaje == 'Insercion exitosa'){
          Notify(mensaje,'Exito!','success','fas fa-check');
          tableEmpleado.ajax.reload();
          limpiarCampoEmpleado();
        }else{
          Notify(mensaje, "Error!", "danger", giconError);
        }

        $(".loading").hide();
      },
    });
    $("#agregarEmpleadoModal").modal("hide");
  });

  //Editar maquina
  
  $("#editarEmpleado").click(function () {
    $(".loading").show();
    var url = $(this).attr("data-url");
    var formulario = $("#formEditarEmpleado").serialize();
    $.ajax({
      url: url,
      type: "POST",
      data: formulario,
      success: function (mensaje) {
        if(mensaje == 'Actualización exitosa'){
          Notify(mensaje,'Exito!','success','fas fa-check');
          tableEmpleado.ajax.reload();
        }else{
          Notify(mensaje, "Error!", "danger", giconError);
        }

        $(".loading").hide();
      },
    });
    $("#editarEmpleadoModal").modal("hide");
  });

  // Deshabilitar Maquina

  $("#tablaGestionarEmpleado tbody").on("click","button.eliminar",function() {
    var data = tableEmpleado.row( $(this).parents("tr")).data();
    //console.log(data.est_codigo);
    var titulo='';
    var est_codigo = data.est_codigo.substr(data.est_codigo.indexOf('<button estado = ')+18,1);
    var urlEliminar = 'ajax.php?modulo=empleado&controlador=empleado&funcion=eliminar';


    if(est_codigo  == 1){
      titulo = '¿Desea Deshabilidar el empleado '+data.emp_nombre+' '+data.emp_apellido+'?';
    }else{
      titulo = '¿Desea Habilitar el empleado '+data.emp_nombre+' '+data.emp_apellido+'?';
    }
    
    swal({
      title: titulo,
      text: "Una vez realizada esta operación puede volver a realizar el cambio.",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {

        //Se le deja el control del tiempo de espera a la funcion
        cambioEstadoEmpleado(data.emp_codigo,est_codigo,urlEliminar,tableEmpleado);
      }
    });

  });

});


var obtener_data_editar_empleado = function (tbody,table) {
  $(tbody).on("click","button.editar",function() {
    var data = table.row( $(this).parents("tr")).data();
    // console.log(data);
    
    $("#editCodigoEmpleado").val(data.emp_codigo);
    $("#editIdenEmpleado").val(data.emp_cedula);
    $("#editNomEmpleado").val(data.emp_nombre);
    $("#editApeEmpleado").val(data.emp_apellido);
    $("#editCarEmpleado").val(data.emp_cargo);
  })
}

function cambioEstadoEmpleado(id,est_codigo,url,table) {
  $(".loading").show();
  // Parametros enviados
  var parametros = {
    "id" : id,
    "est_codigo" : est_codigo
    };
  $.ajax({
    url: url,
    type: "POST",
    data: parametros,
    success: function (mensaje) {
      if(mensaje == 'Cambio de estado exitoso'){
        Notify(mensaje,'Exito!','success','fas fa-check');
        table.ajax.reload();
      }else{
        Notify(mensaje, "Error!", "danger", giconError);
      }

      $(".loading").hide();
    },
  });
}

function limpiarCampoEmpleado(){
  $('#idenEmpleado').val('');
  $('#nomEmpleado').val('');
  $('#apeEmpleado').val('');
  $('#carEmpleado').val('');
}




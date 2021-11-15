$(document).ready(function () {
 $(".loading").hide();
 // Se Crea la tabla y se deja activa para el resto de procesos
 var table = $("#tablaGestionarSeguimiento").DataTable({
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
      "url" : "ajax.php?modulo=seguimiento&controlador=seguimiento&funcion=getTable",
      "dataSrc":""
    },
    "columns":[
        {"data":"seg_codigo"},
        {"data":"emp_codigo"},
        {"data":"emp_nombre"},
        {"data":"emp_apellido"},
        {"data":"pro_codigo"},
        {"data":"pro_nombre"},
        {"data":"maq_codigo"},
        {"data":"maq_nombre"},
        {"data":"otr_identificador"},
        {"data":"prod_codigo"},
        {"data":"prod_descripcion"},
        {"data":"seg_fechaInicio"},
        {"data":"seg_fechaFinal"},
        {"data":"seg_tiempoEjecucion"},
        {"data":"seg_cantidad"},
        {"data":"est_descripcion"}
    ],
    "columnDefs":[
      {width : "10px", targets: [0,1,2,3,4,6,7,8,9,11,12,13,14,15]},
      // {style:"width:10px;",targets: "_all"},
      // {className: "JohanC", targets: "_all"},
      // {className: "width-200", targets: [0,2]},
      ]

  });


  obtener_data_editar_maquina("#tablaGestionarMaquina tbody",table);

  $("#btn-reload").on("click", function () {
    //table.ajax.reload();
  });

  $("#agregarMaquina").click(function () {
    $(".loading").show();
    var url = $(this).attr("data-url");
    var formulario = $("#formAgregarMaquina").serialize();
    $.ajax({
      url: url,
      type: "POST",
      data: formulario,
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
    $("#agregarMaquinaModal").modal("hide");
  });

  //Editar maquina
  
  $("#editarMaquina").click(function () {
    $(".loading").show();
    var url = $(this).attr("data-url");
    var formulario = $("#formEditarMaquina").serialize();
    $.ajax({
      url: url,
      type: "POST",
      data: formulario,
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
    $("#editarMaquinaModal").modal("hide");
  });

  // Deshabilitar Maquina

  $("#tablaGestionarMaquina tbody").on("click","button.eliminar",function() {
    var data = table.row( $(this).parents("tr")).data();
    //console.log(data.est_codigo);
    var titulo='';
    var est_codigo = data.est_codigo.substr(data.est_codigo.indexOf('<button estado = ')+18,1);
    var urlEliminar = 'ajax.php?modulo=maquina&controlador=maquina&funcion=eliminar';


    if(est_codigo  == 1){
      titulo = '¿Desea Deshabilidar la maquina '+data.maq_identificador+'?';
    }else{
      titulo = '¿Desea Habilitar la maquina '+data.maq_identificador+'?';
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
        cambioEstado(data.maq_codigo,est_codigo,urlEliminar,table);
      }
    });

  });

});


var obtener_data_editar_maquina = function (tbody,table) {
  $(tbody).on("click","button.editar",function() {
    var data = table.row( $(this).parents("tr")).data();
    // console.log(data);
    $("#editIdenMaquina").val(data.maq_identificador);
    $("#editNomMaquina").val(data.maq_nombre);
    $("#editCodigoMaquina").val(data.maq_codigo);
  })
}

function cambioEstado(id,est_codigo,url,table) {
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




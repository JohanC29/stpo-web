$(document).ready(function () {
 $(".loading").hide();
 // Se Crea la tabla y se deja activa para el resto de procesos
 var tableotr = $("#tablaGestionarOrdenTrabajo").DataTable({
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
      "url" : "ajax.php?modulo=ordentrabajo&controlador=ordentrabajo&funcion=getTable",
      "dataSrc":""
    },
    "columns":[
        {"data":"otr_codigo"},
        {"data":"otr_identificador"},
        {"data":"prod_codigo"},
        {"data":"prod_descripcion"},
        {"data":"est_codigo"}
    ]
  });


  obtener_data_editar_otr("#tablaGestionarOrdenTrabajo tbody",tableotr);



  $("#agregarOrdenTrabajo").click(function () {
    $(".loading").show();
    var url = $(this).attr("data-url");
    var formulario = $("#formAgregarOrdenTrabajo").serialize();
    $.ajax({
      url: url,
      type: "POST",
      data: formulario,
      success: function (mensaje) {
        if(mensaje == 'Insercion exitosa'){
          Notify(mensaje,'Exito!','success','fas fa-check');
          tableotr.ajax.reload();
        }else{
          Notify(mensaje, "Error!", "danger", giconError);
        }


        $(".loading").hide();
      },
    });
    $("#agregarOrdenTrabajoModal").modal("hide");
  });

  //Editar maquina
  
  $("#editarOrdenTrabajo").click(function () {
    $(".loading").show();
    var url = $(this).attr("data-url");
    var formulario = $("#formEditarOrdenTrabajo").serialize();
    $.ajax({
      url: url,
      type: "POST",
      data: formulario,
      success: function (mensaje) {
        if(mensaje == 'Insercion exitosa'){
          Notify(mensaje,'Exito!','success','fas fa-check');
          tableotr.ajax.reload();
        }else{
          Notify(mensaje, "Error!", "danger", giconError);
        }
        $(".loading").hide();
      },
    });
    $("#editarOrdenTrabajoModal").modal("hide");
  });

  // Deshabilitar Maquina

  $("#tablaGestionarOrdenTrabajo tbody").on("click","button.eliminar",function() {
    var data = tableotr.row( $(this).parents("tr")).data();
    // console.log(data);
    var titulo='';
    var est_codigo = data.est_codigo.substr(data.est_codigo.indexOf('<button estado = ')+18,1);
    var urlEliminar = 'ajax.php?modulo=ordentrabajo&controlador=ordentrabajo&funcion=eliminar';


    if(est_codigo  == 1){
      titulo = '¿Desea Deshabilidar la maquina '+data.otr_identificador+'?';
    }else{
      titulo = '¿Desea Habilitar la maquina '+data.otr_identificador+'?';
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
        cambioEstado(data.otr_codigo,est_codigo,urlEliminar,tableotr);
      }
    });

  });


  //Filtro SubCategoria
  
  $("#otrSubCategoriaId").change(function(){
    var id = $(this).val();
    var url = $(this).attr("data-url");
    var otrIdProducto = "#otrIdProducto";
    // console.log(url);
    filtroSubCategoria(id,url,otrIdProducto);
    
  });

  // Asignar Descripcion
  
  $("#otrIdProducto").change(function(){
    var id = $(this).val();
    var url = $(this).attr("data-url");
    var ortProdDescripcion = "#ortProdDescripcion";

    asignarDescripcion(id,url,ortProdDescripcion);

  });


  // --- Seccion Editar OTR
  //Filtro SubCategoria
  
  $("#editOtrSubCategoriaId").change(function(){
    var id = $(this).val();
    var url = $(this).attr("data-url");
    var otrIdProducto = "#editOtrIdProducto";
    // console.log(url);
    filtroSubCategoria(id,url,otrIdProducto);
    
  });

  // Asignar Descripcion
  
  $("#editOtrIdProducto").change(function(){
    var id = $(this).val();
    var url = $(this).attr("data-url");
    var ortProdDescripcion = "#editOrtProdDescripcion";

    asignarDescripcion(id,url,ortProdDescripcion);

  });


});


var obtener_data_editar_otr = function (tbody,table) {
  $(tbody).on("click","button.editar",function() {
    var data = table.row( $(this).parents("tr")).data();
    console.log(data);
    $("#editCodigoOrdenTrabajo").val(data.otr_codigo);
    $("#editidenOrdenTrabajo").val(data.otr_identificador);
    
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

function filtroSubCategoria(id,url,otrIdProducto){

  if(id == 0){
    var html = "<option value='0' selected>Seleccione Prodcuto</option>";
    $(otrIdProducto).html(html);
    $(otrIdProducto).val(0);
  }else{

    $(".loading").show();
    // Parametros enviados
    var parametros = {
      "id" : id
      };
    $.ajax({
      url: url,
      type: "POST",
      data: parametros,
      success: function (mensaje) {
        // Notify(mensaje,'Exito!','success','fas fa-check');
        $(otrIdProducto).html(mensaje);
        $(".loading").hide();
      },
    });

  }
}

function asignarDescripcion(id,url,ortProdDescripcion){
  if(id == 0){
    $(ortProdDescripcion).html();
  }else{

    // $(".loading").show();
    // Parametros enviados
    var parametros = {
      "id" : id
      };
    $.ajax({
      url: url,
      type: "POST",
      data: parametros,
      success: function (mensaje) {
        // Notify(mensaje,'Exito!','success','fas fa-check');
        // console.log(mensaje);
        $(ortProdDescripcion).html(mensaje);
        // $(".loading").hide();
      },
    });

  }
}





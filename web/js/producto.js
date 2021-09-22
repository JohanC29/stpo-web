$(document).ready(function () {
 $(".loading").hide();
 // Se Crea la tabla y se deja activa para el resto de procesos
 var table = $("#tablaGestionarProducto").DataTable({
    "ajax":{
      "url" : "ajax.php?modulo=producto&controlador=productobase&funcion=getTable",
      "dataSrc":""
    },
    "columns":[
        {"data":"prod_codigo"},
        {"data":"prod_descripcion"},
        {"data":"cat_descripcion"},
        {"data":"sub_descripcion"},
        {"data":"est_codigo"}
    ]
  });


  obtener_data_editar("#tablaGestionarProducto tbody",table);


  $("#agregarProducto").click(function () {
    $(".loading").show();
    var url = $(this).attr("data-url");
    var formulario = $("#formAgregarProducto").serialize();
    $.ajax({
      url: url,
      type: "POST",
      data: formulario,
      success: function (mensaje) {
        Notify(mensaje,'Exito!','success','fas fa-check');
        table.ajax.reload();
        $(".loading").hide();
      },
    });
    $("#agregarProductoModal").modal("hide");
  });

  //Editar Producto
  
  $("#editarProducto").click(function () {
    $(".loading").show();
    var url = $(this).attr("data-url");
    var formulario = $("#formEditarProducto").serialize();
    $.ajax({
      url: url,
      type: "POST",
      data: formulario,
      success: function (mensaje) {
        Notify(mensaje,'Exito!','success','fas fa-check');
        table.ajax.reload();
        $(".loading").hide();
      },
    });
    $("#editarProductoModal").modal("hide");
  });

  // Deshabilitar Maquina

  $("#tablaGestionarProducto tbody").on("click","button.eliminar",function() {
    var data = table.row( $(this).parents("tr")).data();
    //console.log(data.est_codigo);
    var titulo='';
    var est_codigo = data.est_codigo.substr(data.est_codigo.indexOf('<button estado = ')+18,1);
    var urlEliminar = 'ajax.php?modulo=producto&controlador=productobase&funcion=eliminar';


    if(est_codigo  == 1){
      titulo = '¿Desea Deshabilidar la producto '+data.prod_descripcion+'?';
    }else{
      titulo = '¿Desea Habilitar la producto '+data.prod_descripcion+'?';
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
        cambioEstado(data.prod_codigo,est_codigo,urlEliminar,table);
      }
    });

  });



  // Adicionales
  // Select Categoria, retorna el select de subcategoria
  $(".idCategoria").change(function(){
    var idCategoria = $(this).val();
    //alert(idCategoria);
    if(idCategoria != '0'){
      var parametros = {
        "id" : idCategoria
        };
      $.ajax({
        url: "ajax.php?modulo=producto&controlador=productobase&funcion=obtenerSubCategoria",
        type: "POST",
        data: parametros,
        success: function (mensaje) {
          //alert(mensaje);
          $(".idSubCategoria").html(mensaje);
          $(".idSubCategoria").removeAttr('disabled');
          //Notify(mensaje,'Exito!','success','fas fa-check');
          //table.ajax.reload();
          $(".loading").hide();
        },
      });
    }else{
      resetSubCategoria(".idCategoria",".idSubCategoria",'<option value="0">Seleccione Categoria</option>');
    }
  });

  $(".resetSubCategoria").click(function(){
    resetSubCategoria(".idCategoria",".idSubCategoria",'<option value="0">Seleccione Categoria</option>');
  });

});


var obtener_data_editar = function (tbody,table) {
  $(tbody).on("click","button.editar",function() {
    var data = table.row( $(this).parents("tr")).data();
    // console.log(data);
    $("#editCodigoProducto").val(data.prod_codigo);
    $("#editNomProducto").val(data.prod_descripcion);
    //$("#editCodigoMaquina").val(data.maq_codigo);
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
      Notify(mensaje,'Exito!','success','fas fa-check');
      table.ajax.reload();
      $(".loading").hide();
    },
  });
}

function resetSubCategoria(idSelectCategoria,idSelect,textDefault){
  $(idSelectCategoria).val(0);
  $(idSelect).attr('disabled','disabled');
  $(idSelect).html(textDefault);
}




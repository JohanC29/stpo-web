$(document).ready(function () {
 $(".loading").hide();
 // Se Crea la tabla y se deja activa para el resto de procesos
 var table = $("#tablaGestionarMaquina").DataTable({
    "ajax":{
      "url" : "ajax.php?modulo=maquina&controlador=maquina&funcion=getTable",
      "dataSrc":""
    },
    "columns":[
        {"data":"maq_codigo"},
        {"data":"maq_identificador"},
        {"data":"maq_nombre"},
        {"data":"est_codigo"}
    ]
  });


  obtener_data_editar("#tablaGestionarMaquina tbody",table);

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
        Notify(mensaje,'Exito!','success','fas fa-check');
        table.ajax.reload();
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
        Notify(mensaje,'Exito!','success','fas fa-check');
        table.ajax.reload();
        $(".loading").hide();
      },
    });
    $("#editarMaquinaModal").modal("hide");
  });
});


var obtener_data_editar = function (tbody,table) {
  $(tbody).on("click","button.editar",function() {
    var data = table.row( $(this).parents("tr")).data();
    console.log(data);
    $("#editIdenMaquina").val(data.maq_identificador);
    $("#editNomMaquina").val(data.maq_nombre);
    $("#editCodigoMaquina").val(data.maq_codigo);
  })
}





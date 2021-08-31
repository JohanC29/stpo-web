$(document).ready(function () {

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
    var url = $(this).attr("data-url");
    var formulario = $("#formAgregarMaquina").serialize();

    $.ajax({
      url: url,
      type: "POST",
      data: formulario,
      success: function (mensaje) {
        Notify(mensaje,'Exito!','success','flaticon-alarm-1');
        table.ajax.reload();
      },
    });

    $("#agregarMaquinaModal").modal("hide");
    
  });
});


var obtener_data_editar = function (tbody,table) {
  $(tbody).on("click","button.editar",function() {
    var data = table.row( $(this).parents("tr")).data();
    console.log(data);
  })
}





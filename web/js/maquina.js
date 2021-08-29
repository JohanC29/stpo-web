$(document).ready(function () {

 // Se Crea la tabla y se deja activa para el resto de procesos
  var table = $("#tablaGestionarMaquina").DataTable({
    ajax: "/test/0",
    processing: true,
    language: {
      loadingRecords: "&nbsp;",
      processing: "Loading...",
    },
  });

  $("#btn-reload").on("click", function () {
    table.ajax.reload();
  });

  $("#agregarMaquina").click(function () {
    var url = $(this).attr("data-url");
    var formulario = $("#formAgregarMaquina").serialize();

    $.ajax({
      url: url,
      type: "POST",
      data: formulario,
      success: function (vs) {
        alert(vs);
      },
    });

    $("#agregarMaquinaModal").modal("hide");
  });
});

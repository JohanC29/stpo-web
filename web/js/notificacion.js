$(document).ready(function () {
  // Peticion para actualizar informacion de
  // las actividades de usuario
  $.ajax({
    url: "ajax.php?modulo=notificacion&controlador=notificacion&funcion=actividadUsuariosNotificacion",
    type: "POST",
    // data: parametros,
    success: function (res) {
      // console.log(res);
      $("#homeActividadUsuario").html(res);
    },
  });
});

// EDITAR CLIENTE

$(document).on("click", ".btnEditarCliente", function () {
  var idCliente = $(this).attr("idCliente");

  var datos = new FormData();
  datos.append("idCliente", idCliente);

  $.ajax({
    url: "ajax/clientes.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function (respuesta) {
      //console.log(respuesta);
      $("#editarCedula").val(respuesta["ci"]);
      $("#editarNombre").val(respuesta["nombre"]);
      $("#editarEmail").val(respuesta["email"]);
      $("#editarTelefono").val(respuesta["telefono"]);
      $("#editarDireccion").val(respuesta["direccion"]);
      $("#editarFechaNacimiento").val(respuesta["fecha_nacimiento"]);
      $("#idCliente").val(respuesta["id"]);
    },
  });
});

// REVISAR SI EL CLIENTE YA ESTA REGISTRADO

$("#nuevaCedula").change(function () {
  $(".alert").remove();

  var cliente = $(this).val();

  var datos = new FormData();
  datos.append("validarCliente", cliente);

  $.ajax({
    url: "ajax/clientes.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function (respuesta) {
      if (respuesta) {
        $("#nuevaCedula")
          .parent()
          .after(
            '<div class="alert alert-danger">El número de cedula ya se encuentra registrado en el sistema</div>'
          );

        $("#nuevaCedula").val("");
      }
    },
  });
});

// ELIMINAR CLIENTE

$(document).on("click", ".btnEliminarCliente", function () {
  var idCliente = $(this).attr("idCliente");

  swal({
    title: "¿Está seguro de borrar el registro actual?",
    text: "¡Si no lo está puede cancelar la accíón!",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    cancelButtonText: "Cancelar",
    confirmButtonText: "Si, borrar cliente!",
  }).then(function (result) {
    if (result.value) {
      window.location = "index.php?ruta=clientes&idCliente=" + idCliente;
    }
  });
});

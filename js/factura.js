$(document).ready(function () {
  //abrir ready

  $(".btncliente").click(function (e) {
    e.preventDefault();
    $("#nomcliente").removeAttr("disabled");
    $("#apcliente").removeAttr("disabled");
    $("#dircliente").removeAttr("disabled");
    $("#telcliente").removeAttr("disabled");
    $("#emailcliente").removeAttr("disabled");

    $("#registrocliente").slideDown();
  });

  //buscarcliente
  $("#nitcliente").keyup(function (e) {
    e.preventDefault();
    var cl = $(this).val();
    var action = "searchCliente";

    $.ajax({
      type: "POST",
      url: "ajax.php",
      async: true,
      data: { action: action, cliente: cl },
      success: function (response) {
        if (response == 0) {
          $("#idcliente").val("");
          $("#nomcliente").val("");
          $("#apcliente").val("");
          $("#dircliente").val("");
          $("#telcliente").val("");
          $("#emailcliente").val("");
          //mostrar boton agregar
          $(".btncliente").slideDown();
        } else {
          var data = $.parseJSON(response);
          $("#idcliente").val(data.Id_cliente);
          $("#nomcliente").val(data.Nombre_cliente);
          $("#apcliente").val(data.Apellido_cliente);
          $("#dircliente").val(data.Direccion_cliente);
          $("#telcliente").val(data.Telefono_cliente);
          $("#emailcliente").val(data.Correo_cliente);
          //Ocultar boton agregar
          $(".btncliente").slideUp();

          //bloque campos
          $("#nomcliente").attr("disabled", "disabled");
          $("#apcliente").attr("disabled", "disabled");
          $("#dircliente").attr("disabled", "disabled");
          $("#telcliente").attr("disabled", "disabled");
          $("#emailcliente").attr("disabled", "disabled");

          //Oculta boton guardar
          $("#registrocliente").slideUp();
        }
      },
      error: function (error) {},
    });
  });

  //buscar producto
  $("#codprod").keyup(function (e) {
    e.preventDefault();

    var producto = $(this).val();
    var action = "infoProducto";

    $.ajax({
      type: "POST",
      url: "ajax.php",
      async: true,
      data: { action: action, producto: producto },
      success: function (response) {
        if (response == 0) {
          $("#producto").html("-");
          $("#cantprod").val("0");
          $("#precio").html("0.00");
          $("#preciototal").html("0.00");
          //mostrar boton agregar
          $(".btncliente").slideDown();
          //bloquear cantidad
          $("#cantprod").attr("disabled", "disabled");
          //ocultar boton agregar
          $("#aggprod").slideUp();
        } else {
          var data = $.parseJSON(response);
          $("#codprod").val(data.Id_producto);
          $("#producto").html(data.Nombre_producto);
          $("#cantprod").val("1");
          $("#precio").html(data.Valor_producto);
          $("#preciototal").html(data.Valor_producto);
          //Activar cantidad
          $("#cantprod").removeAttr("disabled");

          //mostrar boton agregar
          $("#aggprod").slideDown();
        }
      },
      error: function (error) {},
    });
  });

  //validar cantidad del producto antes de agg
  $("#cantprod").keyup(function (e) {
    e.preventDefault();

    var preciototal = $(this).val() * $("#precio").html();
    $("#preciototal").html(preciototal);

    //oculta el boton agregar si cantidad menor que 1
    if ($(this).val() < 1 || isNaN($(this).val())) {
      $("#aggprod").slideUp();
    } else {
      $("#aggprod").slideDown();
    }
  });
  //agregar cliente
  $("#newcliente").submit(function (e) {
    e.preventDefault();

    $.ajax({
      type: "POST",
      url: "ajax.php",
      async: true,
      data: $("#newcliente").serialize(),
      success: function (response) {
        if (response != "error") {
          //Bloque campos
          $("#nomcliente").attr("disabled", "disabled");
          $("#apcliente").attr("disabled", "disabled");
          $("#dircliente").attr("disabled", "disabled");
          $("#telcliente").attr("disabled", "disabled");
          $("#emailcliente").attr("disabled", "disabled");

          //Ocultar boton agregar
          $(".btncliente").slideUp();
          //Oculta boton guardar
          $("#registrocliente").slideUp();
        }
      },
      error: function (error) {},
    });
  });

  //almacenar productos en la tambla temporal
  $("#aggprod").click(function (e) {
    e.preventDefault();

    if ($("#cantprod").val() > 0) {
      var codprod = $("#codprod").val();
      var producto = $("#producto").html();
      var cantprod = $("#cantprod").val();
      var precio = $("#precio").html();
      var preciototal = $("#preciototal").html();
      var action = "aggProductotemp";

      $.ajax({
        type: "POST",
        url: "ajax.php",
        async: true,
        data: {
          action: action,
          codprod: codprod,
          producto: producto,
          cantprod: cantprod,
          precio: precio,
          preciototal: preciototal,
        },
        success: function (response) {
          if (response != "eror") {
            var info = JSON.parse(response);
            $("#detalleventa").html(info.detalle);
            $("#detalletotales").html(info.totales);

            $("#codprod").val("");
            $("#producto").html("-");
            $("#cantprod").val("0");
            $("#precio").html("0.00");
            $("#preciototal").html("0.00");

            //bloquear cantidad
            $("#cantprod").attr("disabled", "disabled");

            //ocultar boton agregar
            $("#aggprod").slideUp();
          } else {
            console.log("no data");
          }
          viewProcesar();
        },
        error: function (error) {},
      });
    }
  });

  //cancelar factura
  $("#cancelar").click(function (e) {
    e.preventDefault();

    var rows = $("#detalleventa").length;

    if (rows > 0) {
      var action = "cancelarVenta";

      $.ajax({
        type: "POST",
        url: "ajax.php",
        async: true,
        data: { action: action },
        success: function (response) {
          if (response != "error") {
            location.reload();
          }
        },
        error: function (error) {},
      });
    }
  });

  //facturar
  $("#facturar").click(function (e) {
    var campocliente = $("#nitcliente").val();
    var nitcliente = $("#idcliente").val();
    var descripcion = $("#descripcion").val();
    var fecha = $("#fecha").val();
    var total = $("#total").html();
    var action = "facturar";
    $.ajax({
      type: "POST",
      url: "ajax.php",
      async: true,
      data: {
        action: action,
        nitcliente: nitcliente,
        descripcion: descripcion,
        fecha: fecha,
        total: total,
      },
      success: function (response) {
        if (response != 'error') {
        var factura = JSON.parse(response);
        console.log(factura);
        generarPDF(factura.idfactura,factura.nitcliente);
        location.reload();

           } else {
            console.log('no data');
           }
      },
      error: function (error) {
        console.log(error);
      },
    });
  });
}); //fin del ready

//generar PDF
function generarPDF(factura, cliente) {
  var ancho = 1000;
  var alto = 800;
  //centrar ventana
  var x = parseInt(window.screen.width / 2 - ancho / 2);
  var y = parseInt(window.screen.height / 2 - alto / 2);

  $url = "../factura/generaFactura.php?f=" + factura + "&cl=" + cliente;
  window.open(
    $url,
    "Factura",
    "left=" +
      x +
      ",top=" +
      y +
      ",height=" +
      alto +
      ",width=" +
      ancho +
      ",scrollbar=si,location=no,resizable=si,menubar=no"
  );
}

//boton facturar
function viewProcesar() {
  if ($("#detalleventa").length > 0) {
    $("#facturar").show();
  } else {
    $("#facturar").hide();
  }
}

//mantener registros
function serchForDetalle() {
  var action = "serchForDetalle";

  $.ajax({
    type: "POST",
    url: "ajax.php",
    async: true,
    data: { action: action },
    success: function (response) {
      if (response != 'error') {
        var info = JSON.parse(response);
        $("#detalleventa").html(info.detalle);
        $("#detalletotales").html(info.totales);
      } else {
        console.log("no data");
      }
      viewProcesar();
    },
    error: function (error) {},
  });
}

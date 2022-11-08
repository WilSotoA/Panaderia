<?php 
include "include/verificaruser.php";
?>
<html>
<head>
  <title>Busqueda Factura</title>
  <link rel="short icon" href="../images/icon.png" />
  <link rel="stylesheet" href="../css/control.css" />
</head>

<body>
<header class="header">
        <div class="containernav">
        <div class="item volver">
          <a href="inicioadmin.php" class="btn btnvolver">Volver</a>
        </div>
        <nav class="nav">
          <ul class="list">
            <li class="item">
              <a href="../index.html#header" class="btn">Inicio</a>
            </li>
            <li class="item">
              <a href="../index.html#sobrenosotros" class="btn">Sobre Nosotros</a>
            </li>
            <li class="item">
              <a href="../index.html#contacto" class="btn">Contacto</a>
            </li>
          </ul>
        </nav>
        <div class="user">
            <p class="textuser"><?php echo $_SESSION['user']; ?> || </p>
            <img src="data:image/jpeg;base64,<?php echo base64_encode($_SESSION['imguser']); ?>" alt="Imagen usuario" class="imguser">
            <a href="include/cerrarsesion.php" class="btn btncerrar">Cerrar Sesión</a>
          </div>
      </div>
  </header>

  <section class="main">
    <h1 class="title">Consulta de Facturas</h1>
    <div class="busq">
      <label class="busqueda" for="caja_busqueda">Buscar Factura</label>
      <input class="caja_busqueda" type="text" name="caja_busqueda" id="caja_busqueda" placeholder="Ingrese codigo del cliente">
    </div>
    <div id="datos">

    </div>
  </section>
  <footer class="copy">
            <small class="textcopy">&copy; 2022 <b>WILMER, YEIMI , ALIRIO</b> - Todos los Derechos Reservados.</small>
        </footer>
  <script>
    function confirmacion(e) {
      if (confirm("¿Está seguro que desea eliminar este registro?")) {
        return true;
      } else {
        event.preventDefault();
      }
    }
    let linkdelete = document.queryselectorall(".item_link");

    for (var i = 0; i < linkdelete.length; i++) {
      linkdelete[i].addeventlistener('click', confirmacion);
    }
  </script>
  <script src="../js/jquery-3.6.0.min.js" type="text/javascript"></script>
  <script src="Buscar/con_factura.js" type="text/javascript"></script>
  <script>
    function generarPDF() {
      var ancho = 1000;
      var alto = 800;
      //centrar ventana
      var x = parseInt(window.screen.width / 2 - ancho / 2);
      var y = parseInt(window.screen.height / 2 - alto / 2);

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
  </script>
</body>

</html>
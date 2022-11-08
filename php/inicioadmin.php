<?php 
include "include/verificaruser.php";
?>
<html>
    <head>
        <title>Inicio ADMIN</title>
        <meta charset="UTF-8">
        <link rel="shortcut icon" href="../images/icon.png" type="image/x-icon">
        <link rel="stylesheet" href="../css/inicioadmin.css">
    </head>
    <body>    
        <header class="header">
        <div class="containernav">
        <picture class="containericon">
          <img src="../images/icon.jpeg" alt="icono panaderia" class="icon" />
        </picture>
        <nav class="nav">
          <ul class="list">
            <li class="item">
              <a href="../index.html#header" class="btn btninicio">Inicio</a>
            </li>
            <li class="item">
              <a href="../index.html#sobrenosotros" class="btn btnsobrenosotros"
                >Sobre Nosotros</a
              >
            </li>
            <li class="item">
              <a href="../index.html#contacto" class="btn btncontacto">Contacto</a>
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
    <div class="container">
        <div class="card">
            <h4>CONTROL CLIENTES</h4>
            <a href="controlcliente.php"><img src="../images/cliente.png"></a>
        </div>
        <div class="card">
            <h4>REGISTRO CLIENTE</h4>
            <div>
             <a href="registrocliente.php"><img src="../images/registro2.png"></a>
        </div>
        </div>  
        <div class="card">
            <h4>FACTURA</h4>
            <a href="factura.php"><img src="../images/factura.png"></a>
            <br>
            <br>
            <h4>CONTROL FACTURA</h4>
        <div>
             <a href="controlfactura.php"><img src="../images/factura2.png"></a>
        </div>
        </div>    
    </div>
        <footer class="copy">
            <small class="textcopy">&copy; 2022 <b>WILMER, YEIMI , ALIRIO</b> - Todos los Derechos Reservados.</small>
        </footer>
    </body>
</html>

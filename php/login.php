<?php 
include "include/ingresologin.php";
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="shortcut icon" href="../images/icon.png" type="image/x-icon">
  <link rel="stylesheet" href="../css/login.css">
  <import { ArrowLeftIcon } from '@iconbox/feather'></import>

</head>

<body>
  <header class="hero">
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
      </div>
  </header>
  <section class="containerform">
  <form action="" method="post" id="form">
    <div class="icon">
      <a href="../index.html" class="button"><img class="arrow" src="../images/svg/leftarrow.svg" width="40" height="40" /></a>
    </div>
    <div class="form">
      <h1>Registro</h1>
      <div class="grupo">
        <input type="text" name="logusuario" id="logusuario" required><span class="barra"></span>
        <label for="">ID</label>
      </div>
    </div>
    <div class="grupo">
      <input type="password" name="logcontraseña" id="logcontraseña" required><span class="barra"></span>
      <label for="">Contraseña</label>
    </div>
    <button type="submit" id="Ingresar" name="Ingresar">Ingresar</button>
    </div>
    <div>
      <button type="sutmit" id="refrescar">refrescar</button>
    </div>
  </form>
  </section>
  <footer class="copy">
            <small class="textcopy">&copy; 2022 <b>WILMER, YEIMI , ALIRIO</b> - Todos los Derechos Reservados.</small>
        </footer>
  </section>
  <?php
  if (isset($_POST['Ingresar'])) {
    $logusuario = $_POST['logusuario'];
    $logcontrasena = $_POST['logcontraseña'];
    // encriptar password
    $contraencript = password_hash($logcontrasena, PASSWORD_DEFAULT);

    //verificar contraseña
    if (password_verify($logcontrasena, $contraencript)) {
      $contrasecu = true;
    } else {
      $contrasecu = false;
    }

    session_start();
    include("include/conexion.php");
    $consul = "SELECT * FROM empleados WHERE  Id_empleado = '$logusuario'";
    $result = mysqli_query($conex, $consul);
    $arreglo = mysqli_fetch_array($result);
    //variables de sesión
    $_SESSION['idempleado'] = $arreglo['Id_empleado'];
    $_SESSION['user'] =  $arreglo['Nombre_empleado'] . ' ' . $arreglo['Apellido_empleado'];
    $_SESSION['rol'] =  $arreglo['ID_ROL'];
    $_SESSION['imguser'] = $arreglo['Foto_empleado'];

    $filas = mysqli_num_rows($result);
    if ($filas  && $contrasecu == true) {
      switch ($_SESSION['rol']) {
        case 1:
          header("location:inicioadmin.php");
          break;

        case 2:
          header("location:factura.php");
          break;
      }
    } else {
  ?>
      <h3>Eror de autenticacion</h3>
  <?php
    }
  }
  ?>
</body>

</html>
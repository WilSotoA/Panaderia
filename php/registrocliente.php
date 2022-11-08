<?php 
include "include/verificaruser.php";
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro Cliente</title>
    <link rel="stylesheet" href="../css/registro.css">
    <link rel="shortcut icon" href="../images/icon.png" type="image/x-icon">
    <import { ArrowLeftIcon } from '@iconbox/feather'></import>
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
        <section class="containerform">
        <form action="" method="POST" id="form">
        <div class="icon">
            <a href="index.html" class="button"><img class="arrow" src="../images/svg/leftarrow.svg"/></a>

        </div>
        <div class="form">
            <h1>Registro clientes</h1>
            <div class="grupo">
                <input type="text" name="idcliente" id="idcliente" required><span class="barra"></span>
                <label for="">ID</label>
            </div>
            </div>
            <div class="grupo">
                <input type="text" name="nomcliente" id="nomcliente" required><span class="barra"></span>
                <label for="">Nombre</label>
            </div>
            <div class="grupo">
                <input type="text" name="apecliente" id="apecliente" required><span class="barra"></span>
                <label for="">Apellido</label>
            </div>
            <div class="grupo">
                <input type="text" name="dircliente" id="dircliente" required><span class="barra"></span>
                <label for="">direccion</label>
            </div>
            <div class="grupo">
                <input type="tel" name="telcliente" id="telcliente" required><span class="barra"></span>
                <label for="">Telefono</label>
            </div>
            <div class="grupo">
                <input type="text" name="correocliente" id="correocliente" required><span class="barra"></span>
                <label for="">Correo</label>
            </div>
            <button type="submit" name="Ingresar" id="Ingresar">Registrar</button>
        </div>
        <div>
            <button type="submit" id="refrescar"> refrescar</button>
        </div>
    </form>
    </section>
    <footer class="copy">
            <small class="textcopy">&copy; 2022 <b>WILMER, YEIMI , ALIRIO</b> - Todos los Derechos Reservados.</small>
        </footer>
        <?php 
        include "include/conexion.php";
        if(isset($_POST['Ingresar'])){
          $idcliente = $_POST['idcliente'];
          $nomcliente = $_POST['nomcliente'];
          $apecliente = $_POST['apecliente'];
          $dircliente = $_POST['dircliente'];
          $telcliente = $_POST['telcliente'];
          $correocliente = $_POST['correocliente'];
          
          $query = mysqli_query($conex, "UPDATE clientes SET Id_cliente='$idcliente',Nombre_cliente='$nomcliente',Apellido_cliente='$apecliente',Direccion_cliente='$dircliente',Telefono_cliente='$telcliente',Correo_cliente='$correocliente' WHERE Id_cliente = $idcliente");
          if ($query) {
            echo '<script>alert("Se ha actualizado exitosamente")</script>';
          } else {
            echo '<script>alert("NO se ha actualizado exitosamente")</script>';
          }
        }

        ?>
</body>
</html>
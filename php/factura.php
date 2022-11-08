<?php 
include "include/verificaruser.php";
include "include/conexion.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facturacion</title>
    <link rel="shortcut icon" href="../images/icon.png" type="image/x-icon">
    <link rel="stylesheet" href="../css/factura.css">
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

<section class="container">
    <div class="cabezera">
        <h1 class="titulo">Facturación</h1>
        <img class="logo" src="../images/icon.jpeg" alt="Icono">
    </div>
    <div class="datoscliente">
        <div class="accioncliente">
            <a href="#" class="btnbody btncliente">Nuevo Cliente</a>
        </div>
    </div>
    <form id="newcliente" class="form" action="" method="post">
        <input type="hidden" name="action" value="aggcliente">
        <input type="hidden" id="idcliente" name="idcliente" value="" required>
        <div class="containerform">
            <label class="label">Id</label>
            <input class="inputs" type="text" name="nitcliente" id="nitcliente" required>
        </div>
        <div class="containerform">
            <label class="label">Nombre</label>
            <input class="inputs" type="text" name="nomcliente" id="nomcliente" disabled required>
        </div>
        <div class="containerform">
            <label class="label">Apellido</label>
            <input class="inputs" type="text" name="apcliente" id="apcliente" disabled required>
        </div>
        <div class="containerform">
            <label class="label">Dirección</label>
            <input class="inputs" type="text" name="dircliente" id="dircliente" disabled required>
        </div>
         <div class="containerform">
            <label class="label">Telefono</label>
            <input class="inputs" type="number" name="telcliente" id="telcliente" disabled required>
        </div>
        <div class="containerform">
            <label class="label" for="">Correo</label>
            <input class="inputs" type="email" name="emailcliente" id="emailcliente" disabled required>
        </div>
        <div id="registrocliente" class="containerform containerguardar">
            <input class="btnbody btnguardar" type="submit" value="guardar">
        </div>
    </form>
    <div class="datosventa">
        <h4 class="tituloventa">Informacion factura</h4>
        <div class="datos">
            <div class="containerventa">
                <label class="label">Vendedor</label>
                <p id="vendedor" class="vendedor"><?php echo $_SESSION['user']?></p>
            </div>
            <div class="containerventa">
                <label class="label">Descripción</label>
                <textarea class="inputs" name="descripcion" id="descripcion" required></textarea>
            </div>
        <div class="containerventa">
            <label class="label">Fecha</label>
            <input class="inputs" type="date" name="fecha" id="fecha" required>
        </div>
            <div class="containerventa">
                <label class="label">Acciones</label>
                <div class="accionventa" id="accionesventa">
                    <a href="#" class="btnbody btnacciones" id="facturar">Procesar</a>
                    <a href="#" class="btnbody btnacciones" id="cancelar">Cancelar</a>
                </div>
            </div>
        </div>
    </div>
    
 <table class="tbventa">
     <thead class="thead">
        <tr class="tcabeza">
            <th>Código</th>
            <th>Producto</th>
            <th>Cantidad</th>
            <th>Precio</th>
            <th>Precio TOTAL</th>
            <th>Acción</th>
        </tr>
        <tr class="prod">
             <td class="prods"><input type="number" class="txtprod" name="codprod" id="codprod"></td>
             <td class="prods" id="producto">-</td>
             <td class="prods"><input type="text" class="txtprod" name="cantprod" id="cantprod" value="0" min="1" disabled></td>
             <td id="precio" class="prods">0.00</td>
             <td id="preciototal" class="prods">0.00</td>
             <td class="prods"><a href="#" id="aggprod" class="txtprod aggprod">agregar</a></td>
        </tr>
        <tr class="tcabeza">
            <th>Código</th>
            <th>Producto</th>
            <th>Cantidad</th>
            <th>Precio</th>
            <th>Precio TOTAL</th>
            <th>Acción</th>
        </tr>
     </thead>
    <tbody id="detalleventa" class="tbody">
        <!-- contenido ajax -->
    </tbody>
    <tfoot id="detalletotales" class="tfoot">
        <!-- contenido ajax -->
    
    </tfoot>
 </table>
</section>
<footer class="copy">
            <small class="textcopy">&copy; 2022 <b>WILMER, YEIMI , ALIRIO</b> - Todos los Derechos Reservados.</small>
        </footer>
<script src="../js/jquery-3.6.0.min.js"></script>
<script src="../js/factura.js"></script>
<script>
        function confirmacion(e){
    if (confirm("¿Está seguro que desea eliminar este registro?")){
        return true;     
    } else {
        event.preventDefault();
    }
}
let linkdelete = document.querySelectorAll(".btnborrar");

for(var i = 0; i < linkdelete.length; i++) {
    linkdelete[i].addeventlistener('click', confirmacion);
}
</script>
<script>
    $(document).ready(function() { 
        serchForDetalle();
     });
</script>
</body>
</html>
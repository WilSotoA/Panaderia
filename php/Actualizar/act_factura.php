<?php
session_start();
error_reporting(0);
include "../include/conexion.php";
   $rol = $_SESSION['rol'];

                    switch($rol){
                        case 2:
                            echo "solo los ADMINS tiene ACESSO";
                            header('location:windows.history.go(-1)');
                        case 1:
                            break;
                            die();
                    }

        if(empty($_SESSION['user'])){
            echo 'Debe iniciar sesion para poder utilizar el sitio';
            header("location:../Login.php");
            die();  
        } 
    ?>
<html>
    <head>
        <title>Actualizar Factura</title>
       <link rel="short icon" href="../../images/icon.png"/> 
       <link rel="stylesheet" href="../../css/actualizar.css"/>
    <?php
    $salida = "";
    $id = $_GET["id"];
    $query = "SELECT * FROM facturas WHERE Id_factura= '$id'";
    ?>
    <body>
        <header class="header">
        <div class="item volver">
          <a href="../controlcliente.php" class="btn btnvolver">Volver</a>
        </div>
        </header>
        <main class="main">
        <h1 class="title">Actualizar Factura</h1>
        <form method="post">
        <?php
     
    $resultado=$conex->query($query);
    
    if($resultado){
        
        $salida.="<table class='tabla'>
                <tr class='tr'>
                <th class='th'>Descripción Factura</th>
                <th class='th'>Fecha Factura</th>
                <th class='th'>Total Factura</th>
                <th class='th'>Vendedor</th>
                <th class='th'>Cliente</th>"; 
        
        while($fila = $resultado->fetch_assoc()){
         $salida.="<tr class='tr'>
                    <input type='hidden' class='formu' value='".$fila['Id_factura']."' name= 'Codigo'>
                 <td class='td'><input type='text' class='formu' value='".$fila['Descripcion_factura']."' name='Descripcion' required></td>
                    <td class='td'><input type='text' class='formu' value='".$fila['Fecha_factura']."' name='Fecha' required></td>
                     <td class='td'><input type='number' class='formu' value='".$fila['Total_factura']."' name='Total' required></td>
                         <td class='td'><input type='number' class='formu' value='".$fila['ID_PERSONAL']."' name='Vendedor' disabled required></td>
                         <td class='td'><input type='number' class='formu' value='".$fila['ID_CLIENTE']."' name='Cliente'disabled required></td>
                             </tr>";           
        }      
        $salida.="</table>";
    }
    
    echo $salida;
    
    ?> 
        <div class="actualizar">
            <input type="submit" name="actualizar" value="actualizar" class="btn--actualizar">
            </div>
        </form>
        <?php

   if (isset($_POST['actualizar'])){
        $Codigo = $_POST['Codigo'];
        $Descripcion = $_POST['Descripcion'];
        $Fecha = $_POST['Fecha'];
        $Total = $_POST['Total'];
        $actualizar = "UPDATE facturas SET Descripcion_factura='$Descripcion',Fecha_factura='$Fecha',Total_factura='$Total' WHERE Id_Factura='$id'";   
        $resul = mysqli_query($conex, $actualizar);
        if ($resul) {

echo "<script>alert('Se ha actualizado los cambios exitosamente'); window.location='../controlfactura.php';</script>";
} else {

echo "<script>alert('NO se ha actualizado los cambios exitosamente'); window.history.go(-1)</script>";
}    
}
$conex->close();
     ?>
     </main>
    </body>
</html>
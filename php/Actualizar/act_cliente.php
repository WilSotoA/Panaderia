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
        <title>Actualizar Cliente</title>
       <link rel="short icon" href="../../images/icon.png"/> 
       <link rel="stylesheet" href="../../css/actualizar.css"/>
    <?php
    $salida = "";
    $id = $_GET["id"];
    $query = "SELECT * FROM clientes WHERE Id_cliente= '$id'";
    ?>
    <body>
        <header class="header">
        <div class="item volver">
          <a href="../controlcliente.php" class="btn btnvolver">Volver</a>
        </div>
        </header>
        <main class="main">
        <h1 class="title">Actualizar Cliente</h1>
        <form method="post">
        <?php
     
    $resultado=$conex->query($query);
    
    if($resultado){
        
        $salida.="<table class='tabla'>
                <tr class='tr'>
                <th class='th'>Id Cliente</th>
                <th class='th'>Nombre Cliente</th>
                <th class='th'>Apellido Cliente</th>
                <th class='th'>Direccion Cliente</th>
                <th class='th'>Telefono Cliente</th>
                <th class='th'>Correo Cliente</th>"; 
        
        while($fila = $resultado->fetch_assoc()){
         $salida.="<tr class='tr'>
            <td class='td'><input type='number' class='formu' value='".$fila['Id_cliente']."' name= 'Codigo'></td>
                 <td class='td'><input type='text' class='formu' value='".$fila['Nombre_cliente']."' name='Nombre' required></td>
                    <td class='td'><input type='text' class='formu' value='".$fila['Apellido_cliente']."' name='Apellido' required></td>
                     <td class='td'><input type='text' class='formu' value='".$fila['Direccion_cliente']."' name='Direccion' required></td>
                         <td class='td'><input type='number' class='formu' value='".$fila['Telefono_cliente']."' name='Telefono' required></td>
                         <td class='td'><input type='email' class='formu' value='".$fila['Correo_cliente']."' name='Correo' required></td>
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
        $Nombre = $_POST['Nombre'];
        $Apellido = $_POST['Apellido'];
        $Direccion = $_POST['Direccion'];
        $Telefono = $_POST['Telefono'];
        $Correo = $_POST['Correo'];
        $actualizar = "UPDATE clientes SET Id_cliente='$Codigo',Nombre_cliente='$Nombre',Apellido_cliente='$Apellido',Direccion_cliente='$Direccion',Telefono_cliente='$Telefono',Correo_cliente='$Correo' WHERE Id_cliente='$id'";   
        $resul = mysqli_query($conex, $actualizar);
        if ($resul) {

echo "<script>alert('Se ha actualizado los cambios exitosamente'); window.location='../controlcliente.php';</script>";
} else {

echo "<script>alert('NO se ha actualizado los cambios exitosamente'); window.history.go(-1)</script>";
}    
}
$conex->close();
     ?>
     </main>
    </body>
</html>
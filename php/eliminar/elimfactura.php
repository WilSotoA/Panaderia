<?php
include ("../include/conexion.php");

$id = $_GET['id'];
$eliminar = "DELETE FROM facturas WHERE Id_factura = '$id'";
$resultadoeliminar = mysqli_query($conex, $eliminar);
if ($resultadoeliminar) {
    echo "<script>alert('Se pudo eliminar'); window.history.go(-1)</script>";
} else {

    echo "<script>alert('NO se pudo eliminar'); window.history.go(-1)</script>";
}    
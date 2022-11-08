<?php 
session_start();
if (!empty($_SESSION['idempleado'])) {
    session_destroy();
    header("location:../../index.html");
} else {
    echo "algo ocurrio mal";
    header("location:../../index.html");
    die();
}
?>
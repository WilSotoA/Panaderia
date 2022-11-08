<?php 
session_start();
error_reporting(0);
        if(!empty($_SESSION['user'])){
                switch ($_SESSION['rol']) {
                        case 1:
                          header("location:inicioadmin.php");
                          break;
                
                        case 2:
                          header("location:factura.php");
                          break;
                      }
        }
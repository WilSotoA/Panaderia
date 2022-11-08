<?php
session_start();
error_reporting(0);
        if(empty($_SESSION['user'])){
            header("location:Login.php");
            die();  
        } 
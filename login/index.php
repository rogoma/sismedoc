<?php
    include("../config/conexion.php");

    if(isset($_SESSION["idusuarios"])){
        header("Location: http://localhost/sismedoc/view/Home/");
    }
    if(isset($_POST["enviar"]) and $_POST["enviar"]=="si"){
        require_once("../models/Usuario.php");
        $usuario = new Usuario();
        $usuario->login();
    }
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ingreso al Sistema</title>
    <link rel="stylesheet" href="../public/assets/css/login2.css">
    <link rel="shortcut icon" href="../public/assets/img/logo.png">
</head>

<body>
    <div class="formulario">        
        <img class="logo" src="../public/assets/img/logo6.jpg"/>        
        <h1>SISMEDOC</h1>
        <h3 style="text-align: center; font-size: 20px;font-style: italic;color: brown;">SISTEMA DE MESA DE ENTRADA</h3>
        <?php
                if (isset($_GET["m"])){
                     switch($_GET["m"]){
        case "1";
        ?>
                <div class="alert alert-danger" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <div class="d-flex align-items-center justify-content-start">
                        <i class="icon ion-ios-checkmark alert-icon tx-32 mg-t-5 mg-xs-t-0"></i>
                        <span style="font-size:14px; align-text:center;">&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;
                         Credenciales incorrectas! </span>
                    </div>
                </div>
        <?php
        break;

        case "2";
        ?>
                <div class="alert alert-danger" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <div class="d-flex align-items-center justify-content-start">
                        <i class="icon ion-ios-checkmark alert-icon tx-32 mg-t-5 mg-xs-t-0"></i>
                        <span style="font-size:14px; align-text:center;">&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;
                         Ingrese sus credenciales! </span>
                    </div>
                </div>
        <?php

        case "3";
        ?>
                <div class="alert alert-danger" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <div class="d-flex align-items-center justify-content-start">
                        <i class="icon ion-ios-checkmark alert-icon tx-32 mg-t-5 mg-xs-t-0"></i>
                        <span style="font-size:14px; align-text:center;">&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;
                        Usuario inactivo! </span>
                    </div>
                </div>
        <?php
        break;
        }
        }
        ?>
        <form method="post" action="">
            <!-- <br> -->
            <div class="username">
                <input type="text" name="usuario" required>
                <label>Cédula:</label>
            </div>
            <div class="username">
                <input type="password" required name="password">
                <label>Contraseña:</label>
            </div>

            <input type="hidden" name="enviar" value="si">
            <input type="submit" value="Ingresar"><br><br>
            <div class="recordar"><a href="../RecuperarContrasena/">¿Olvidó su contraseña?</a></div>
        </form>
    </div>
</body>

</html>
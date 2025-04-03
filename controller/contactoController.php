<?php

use model\Utils;
require_once "../model/Utils.php";

if(isset($_POST["email"])){
    $email = $_POST["email"];
    if(Utils::correo_contacto($email)){
       echo "<div class='alert alert-success' >Formulario enviado correctamente.</div>";
    }else{
        echo "<div class='alert alert-danger' >Ha habido un error inténtelo de nuevo.</div>";
    }
}
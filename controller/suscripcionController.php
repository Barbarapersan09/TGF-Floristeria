<?php

use model\Utils;
require_once "../model/Utils.php";

if(isset($_POST["email"])){
    $email = $_POST["email"];
    if(Utils::correo_suscripcion($email)){
        header("Location: mainFlorController.php");
    }
}
<?php

use model\Utils;
use model\Usuario;
require_once "../model/Usuario.php";
require_once "../model/Utils.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_pass = $_POST["new_pass"];
    $new_pass_confirm = $_POST["new_pass_confirm"];
    $email = $_POST["email"];
    if ($new_pass !== $new_pass_confirm) { 
        echo "Las contraseñas no coinciden.";
    } else {
        $usuarioModel = new Usuario();
        $resultado = $usuarioModel->cambiarPass($email, $new_pass);
        Utils::correo_cambiarPassword($email);
        echo $resultado;
    }                                       
}

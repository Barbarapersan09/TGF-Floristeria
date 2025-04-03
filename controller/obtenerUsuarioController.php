<?php

namespace controller;  // Define el espacio de nombres "controller" para organizar el código.

use \model\Usuario;   // Importa la clase Flor desde el espacio de nombres "model", que probablemente maneja las operaciones relacionadas con flores en la base de datos.
require_once "../model/Usuario.php";

if (isset($_GET["id_usuario"])) {
    $id_usuario = $_GET["id_usuario"];
    // Crea una instancia de la clase Flor para interactuar con la base de datos y realizar las operaciones.
    $gestorUsuarios = new Usuario();
    $usuario = $gestorUsuarios->getUsuarioById($id_usuario);
    if($usuario){
        //$usuario = $usuario[0];
        //include "mainUsuarioController.php";
        include "../view/modificarUsuario.php";

    }else{
        header("Location: ../view/perfil.php");
    }
}

if(isset($_GET["id"]) && $_GET["action"] === "mostrar") {

    $id_usuario = $_GET["id"];
    // Crea una instancia de la clase Flor para interactuar con la base de datos y realizar las operaciones.
    $gestorUsuarios = new Usuario();
    $usuario = $gestorUsuarios->getUsuarioById($id_usuario);
    if($usuario){
        //$usuario = $usuario[0];
        include "../view/detalles.php";
    }else{
        header("Location: ../view/perfil.php");
    }
}
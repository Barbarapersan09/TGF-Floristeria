<?php

namespace controller;  // Define el espacio de nombres "controller" para organizar el código.

use \model\Envio;   // Importa la clase Flor desde el espacio de nombres "model", que probablemente maneja las operaciones relacionadas con flores en la base de datos.
require_once "../model/Envio.php";

if (isset($_GET["id_envio"])) {
    $id_envio = $_GET["id_envio"];
    // Crea una instancia de la clase Flor para interactuar con la base de datos y realizar las operaciones.
    $gestorEnvio = new Envio();
    $envio = $gestorEnvio->getEnviosById($id_envio);
    if($envio){
        $envio = $envio[0];
        include "../view/modificarEnvio.php";
    }else{
        header("Location: ../view/Envio.php");
    }
}

if(isset($_GET["id"]) && $_GET["action"] === "mostrar") {

    $id_envio = $_GET["id"];
    // Crea una instancia de la clase Flor para interactuar con la base de datos y realizar las operaciones.
    $gestorEnvio = new Envio();
    $envio = $gestorEnvio->getEnviosById($id_envio);
    if($envio){
        $envio = $envio[0];
        include "../view/detalles.php";
    }else{
        header("Location: ../view/perfil.php");
    }
}
<?php

namespace controller;  // Define el espacio de nombres "controller" para organizar el código.

use \model\Pago;   // Importa la clase Flor desde el espacio de nombres "model", que probablemente maneja las operaciones relacionadas con flores en la base de datos.
require_once "../model/Pago.php";

if (isset($_GET["id_pago"])) {
    $id_pago = $_GET["id_pago"];
    // Crea una instancia de la clase Flor para interactuar con la base de datos y realizar las operaciones.
    $gestorPagos = new Pago();
    $pago = $gestorPagos->getPagosById($id_pago);
    if($pago){
        $pago = $pago[0];
        include "../view/modificarPago.php";
    }else{
        header("Location: ../view/Pago.php");
    }
}

if(isset($_GET["id"]) && $_GET["action"] === "mostrar") {

    $id_pago = $_GET["id"];
    // Crea una instancia de la clase Flor para interactuar con la base de datos y realizar las operaciones.
    $gestorPagos = new Pago();
    $pago = $gestorPagos->getPagosById($id_pago);
    if($pago){
        $pago = $pago[0];
        include "../view/detalles.php";
    }else{
        header("Location: ../view/perfil.php");
    }
}
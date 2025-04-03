<?php

namespace controller;  // Define el espacio de nombres "controller" para organizar el código.

use \model\Factura;   // Importa la clase Flor desde el espacio de nombres "model", que probablemente maneja las operaciones relacionadas con flores en la base de datos.
require_once "../model/Factura.php";

if (isset($_GET["id_factura"])) {
    $id_factura = $_GET["id_factura"];
    // Crea una instancia de la clase Flor para interactuar con la base de datos y realizar las operaciones.
    $gestorFacturas = new Factura();
    $factura = $gestorFacturas->getFacturaById($id_factura);
    var_dump($factura);
    if($factura){
        $factura = $factura[0];
        include "../view/modificarFactura.php";
    }else{
        header("Location: ../view/perfil.php");
    }
}


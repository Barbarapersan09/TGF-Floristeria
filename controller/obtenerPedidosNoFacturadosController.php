<?php

namespace controller;  // Define el espacio de nombres "controller" para organizar el código.

use \model\Factura;   // Importa la clase Flor desde el espacio de nombres "model", que probablemente maneja las operaciones relacionadas con flores en la base de datos.
require_once "../model/Factura.php";


function obtenerIds(){
    $gestorFactura = new Factura();

    $ids = $gestorFactura->obtenerPedidosCompletados();
    $ids = array_column($ids,"id_pedido");
    return $ids;
}
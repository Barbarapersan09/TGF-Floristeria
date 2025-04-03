<?php

namespace controller;  // Define el espacio de nombres "controller" para organizar el código.

use \model\Envio;   // Importa la clase Flor desde el espacio de nombres "model", que probablemente maneja las operaciones relacionadas con flores en la base de datos.
require_once "../model/Envio.php";


function obtenerIds(){
    $gestorEnvio = new Envio();

    $ids = $gestorEnvio->obtenerPedidosCompletados();
    $ids = array_column($ids,"id_pedido");
    return $ids;
}
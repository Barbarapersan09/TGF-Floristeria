<?php

namespace controller;  // Define el espacio de nombres "controller" para organizar el código.

use \model\Pedido;   // Importa la clase Flor desde el espacio de nombres "model", que probablemente maneja las operaciones relacionadas con flores en la base de datos.
require_once "../model/Pedido.php";

if (isset($_GET["id_pedido"])) {
    $id_pedido = $_GET["id_pedido"];
    // Crea una instancia de la clase Flor para interactuar con la base de datos y realizar las operaciones.
    $gestorPedido = new Pedido();
    $pedido = $gestorPedido->getPedidoById($id_pedido);
    if($pedido){
        $pedido = $pedido[0];
        include "../view/modificarPedido.php";
    }else{
        header("Location: ../view/perfil.php");
    }
}

if(isset($_GET["id"]) && $_GET["action"] === "mostrar") {

    $id_pedido = $_GET["id"];
    // Crea una instancia de la clase Flor para interactuar con la base de datos y realizar las operaciones.
    $gestorPedido = new Pedido();
    $pedido = $gestorPedido->getPedidoById($id_pedido);
    if($pedido){
        $pedido = $pedido[0];
        include "../view/detalles.php";
    }else{
        header("Location: ../view/perfil.php");
    }
}
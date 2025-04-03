<?php

if(session_status()=== PHP_SESSION_NONE){
    session_start();
   
}
require_once "../model/Carrito.php";

$carritoModel = new CarritoModel();
$action = isset($_GET["action"]) ? $_GET["action"]: null;

if ($action=== "add" && $_SERVER["REQUEST_METHOD"] === "POST") {
    $idProducto = $_POST["producto_id"];
    $nombre = $_POST["nombre"];
    $precio = $_POST["precio"];
    $cantidad = $_POST["cantidad"];
    $url_imagen = $_POST["url_imagen"];
    
    $carritoModel->addProduct($idProducto, $nombre, $precio, $cantidad,$url_imagen);
    header("Location: mainFlorController.php");
}
elseif ($action === "view"){
    $productos = $carritoModel->getCart();
    include "../view/cart.php";
}elseif($action === "remove"){
    $id_producto = isset($_GET["producto_id"]) ? $_GET["producto_id"]: null;
    $carritoModel -> deleteProduct($id_producto);
    header("Location: ../view/cart.php");
}

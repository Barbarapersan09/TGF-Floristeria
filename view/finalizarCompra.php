<?php

use model\Utils;
use model\Pago;

require_once "../model/Utils.php";
require_once "../model/Pago.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$subtotal = 3;
$productos = isset($_SESSION["carrito"]) ? $_SESSION["carrito"] : [];

foreach ($productos as $id => $producto) {
    $precio = floatval(str_replace("€", "", $producto["precio"]));
    $cantidad = intval($producto["cantidad"]);
    $subtotal += $precio * $cantidad;
    $productos[$id]["cantidad"] = $cantidad;
}

$id_pedido = Utils::crearPedido($subtotal);
if(!$id_pedido){
    die("Error al crear el pedido");
}
$id_usuario = $_SESSION["usuario"]["id_usuario"];
if(!$id_usuario){
    die("Error en el id del usuario");
}
$datos = [
    "id_pedido" => $id_pedido,
    "id_usuario" => $id_usuario,
    "metodo_pago" => "Tarjeta",
    "monto" => $subtotal,
    "estado_pago" => "Completado"
];

$respuesta_pago = Pago::addPago($datos);
if(!$respuesta_pago){
    die("Error en el pago");
}

if (!isset($_SESSION["carrito"]) || empty($_SESSION["carrito"])) {
    echo "Carrito vacío.";
    exit;
}

$email = $_SESSION["email"] ?? "barbarapersan09@gmail.com";
$nombre = $_SESSION["usuario"]["nombre"];

$usuario = [
    "email" => $email,
    "nombre" => $nombre
];
$carrito = $_SESSION["carrito"];
$_SESSION["carrito"] = [];
 
if (Utils::correoFinalizarCompra($usuario, $productos, $datos)) {
    echo "<div style='color: #155723; text-align: center; background: #d4edda; border: 1px solid rgb(140, 202, 154);border-radius: 5px; padding: 20px; font-size: 18px'>
        <strong> Compra finalizada.</strong>
    </div>
    <script> 
        setTimeout(()=>{
            window.location.href='../controller/mainFlorController.php';
        }, 4000);
    </script>
    ";
} else {
    die("Error al enviar el correo");
}

<?php

use model\Utils; // Importa la clase Utils desde el espacio de nombres "model". Contiene métodos de utilidad como la limpieza de datos.
use model\Pedido;  // Importa la clase Pedido desde el espacio de nombres "model". Maneja las operaciones relacionadas con las Pedidoes en la base de datos.

require_once "../model/Pedido.php";

function eliminarPedido() {
    // Comprueba si se ha recibido el parámetro 'id_Pedido' a través de una solicitud POST.
    if (isset($_GET["id_pedido"])) {
        // Limpia el dato recibido para evitar inyección de código o datos no deseados.
        $id_pedido = Utils::limpiar_datos($_GET["id_pedido"]);

        // Crea una instancia de la clase Pedido para interactuar con los datos de la tabla 'Pedido'.
        $gestorPedido = new Pedido();

        // Llama al método deletePedido() de la clase Pedido para eliminar el registro correspondiente en la base de datos.
        if ($gestorPedido->deletePedido($id_pedido)) {
            // Si la eliminación es exitosa, se muestra un mensaje de éxito.
            $mensaje = "Eliminado pedido";
            include "mainPedidoController.php";  // Incluye la vista 'Pedido.php' para actualizar la interfaz de usuario.
        } else {
            // Si la eliminación falla, se muestra un mensaje de error.
            $mensaje = "Error al eliminar el pedido";
            include "mainPedidoController.php";  // Incluye la vista 'Pedido.php' para actualizar la interfaz de usuario.
        }
    }
}
if ($_SERVER["REQUEST_METHOD"]== "GET") {
    echo "entra";
    eliminarPedido();
}
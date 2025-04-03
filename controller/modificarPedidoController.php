<?php


use model\Utils;  // Importa la clase Utils desde el espacio de nombres "model", utilizada para funciones de utilidad como la limpieza de datos.
use model\Pedido;   // Importa la clase Pedido desde el espacio de nombres "model", que probablemente maneja las operaciones relacionadas con Pedidoes en la base de datos.

require_once "../model/Pedido.php";

// Función para manejar la modificación de la información de una Pedido en la base de datos.
function modificarPedido()
{

    // Verifica si todos los campos necesarios han sido enviados a través del formulario (método POST).
    if (isset($_POST["id_pedido"], $_POST["id_usuario"], $_POST["monto_total"], $_POST["estado_pedido"])) {

        // Crea un array con los datos de la Pedido, limpiando cada uno de los valores antes de ser almacenados.
        $datosPedidos = [
            "id_pedido" => Utils::limpiar_datos($_POST["id_pedido"]),  // Limpia el ID de la Pedido.
            "id_usuario" => Utils::limpiar_datos($_POST["id_usuario"]),    // Limpia el nombre de la Pedido.
            "monto_total" => Utils::limpiar_datos($_POST["monto_total"]),  // Limpia la descripción de la Pedido.
            "estado_pedido" => Utils::limpiar_datos($_POST["estado_pedido"])
        ];
        
        // Crea una instancia de la clase Pedido para interactuar con la base de datos y realizar las operaciones.
        $gestorPedidos = new Pedido();

        // Llama al método `updatePedido` de la clase Pedido para actualizar los datos de la Pedido en la base de datos.
        if ($gestorPedidos->updatePedido($datosPedidos)) {
            // Si la actualización es exitosa, asigna un mensaje de éxito.
            $mensaje = "Pedido actualizado";
            include "mainPedidoController.php";  // Incluye el archivo de la vista que muestra el resultado (éxito).
        } else {
            // Si hay un error al actualizar, asigna un mensaje de error.
            $mensaje = "Error al actualizar el pedido";
            include "mainPedidoController.php";  // Incluye el archivo de la vista que muestra el resultado (éxito).
        }
    }
}
if ($_SERVER["REQUEST_METHOD"]== "POST") {
    modificarPedido();
}
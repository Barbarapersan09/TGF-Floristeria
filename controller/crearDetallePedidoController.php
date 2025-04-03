<?php

use model\Utils; // Importa la clase Utils desde el espacio de nombres "model". Contiene métodos de utilidad, como la limpieza de datos.
use model\DetallePedido;  // Importa la clase Envio desde el espacio de nombres "model". Gestiona las operaciones relacionadas con las Envioes en la base de datos.

function crearDetallePedido() {
    // Comprueba si se han recibido todos los campos requeridos a través de una solicitud POST.
    if (isset($_POST["id_pedido"], $_POST["id_flor"], $_POST["cantidad"], $_POST["precio"])) {
        
        // Crea un array asociativo `$datosEnvio` con los datos proporcionados por el usuario.
        // Limpia cada dato con el método `limpiar_datos` de la clase Utils para prevenir inyección de código y garantizar datos seguros.
        $datosDetalles = [
            "id_pedido" => Utils::limpiar_datos($_POST["id_pedido"]),
            "id_flor" => Utils::limpiar_datos($_POST["id_flor"]),
            "cantidad" => Utils::limpiar_datos($_POST["cantidad"]),
            "precio" => Utils::limpiar_datos($_POST["precio"])
        ];

        // Crea una instancia de la clase Envio para gestionar las operaciones relacionadas con la base de datos.
        $gestorDetalles = new DetallePedido();

        // Intenta agregar la nueva Envio a la base de datos utilizando el método `addEnvio`.
        if ($gestorDetalles->addDetallePedido($datosDetalles)) {
            // Si la operación es exitosa, define un mensaje de éxito.
            $mensaje = "Detalle del Pedido añadido";
            // Incluye la vista `Envioes.php` para mostrar el resultado.
            include "../view/detalles.php";
        } else {
            // Si ocurre un error al añadir la Envio, define un mensaje de error.
            $mensaje = "Error al añadir los detalles del pedido";
            // Incluye la vista `Envioes.php` para informar del fallo.
            include "../view/detalles.php";
        }
    }
}

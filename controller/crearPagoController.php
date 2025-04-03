<?php

use model\Utils; // Importa la clase Utils desde el espacio de nombres "model". Contiene métodos de utilidad, como la limpieza de datos.
use model\Pago;  // Importa la clase Pago desde el espacio de nombres "model". Gestiona las operaciones relacionadas con las Pagoes en la base de datos.

function crearPago() {
    // Comprueba si se han recibido todos los campos requeridos a través de una solicitud POST.
    if (isset($_POST["id_pedido"], $_POST["id_usuario"], $_POST["metodo_pago"], $_POST["monto"],
              $_POST["fecha_pago"], $_POST["estado_pago"])) {
        
        // Crea un array asociativo `$datosPago` con los datos proporcionados por el usuario.
        // Limpia cada dato con el método `limpiar_datos` de la clase Utils para prevenir inyección de código y garantizar datos seguros.
        $datosPago = [
            "id_pedido" => Utils::limpiar_datos($_POST["id_pedido"]),
            "id_usuario" => Utils::limpiar_datos($_POST["id_usuario"]),
            "metodo_pago" => Utils::limpiar_datos($_POST["metodo_pago"]),
            "monto" => Utils::limpiar_datos($_POST["monto"]),
            "fecha_pago" => Utils::limpiar_datos($_POST["fecha_pago"]),
            "estado_pago" => Utils::limpiar_datos($_POST["estado_pago"])
        ];

        // Crea una instancia de la clase Pago para gestionar las operaciones relacionadas con la base de datos.
        $gestorPagos = new Pago();

        // Intenta agregar la nueva Pago a la base de datos utilizando el método `addPago`.
        if ($gestorPagos->addPago($datosPago)) {
            // Si la operación es exitosa, define un mensaje de éxito.
            $mensaje = "Producto añadido";
            // Incluye la vista `Pago.php` para mostrar el resultado.
            include "../view/pago.php";
        } else {
            // Si ocurre un error al añadir la Pago, define un mensaje de error.
            $mensaje = "Error al añadir el producto";
            // Incluye la vista `Pago.php` para informar del fallo.
            include "../view/pago.php";
        }
    }
}

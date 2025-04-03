<?php

use model\Utils;  // Importa la clase Utils desde el espacio de nombres "model", utilizada para funciones de utilidad como la limpieza de datos.
use model\Pago;   // Importa la clase Pago desde el espacio de nombres "model", que probablemente maneja las operaciones relacionadas con Pagoes en la base de datos.

//require_once "../model/Utils.php";
require_once "../model/Pago.php";

// Función para manejar la modificación de la información de una Pago en la base de datos.
function modificarPago()
{
   
    // Verifica si todos los campos necesarios han sido enviados a través del formulario (método POST).
    if (isset(
        $_POST["id_pago"],
        $_POST["id_pedido"],
        $_POST["id_usuario"],
        $_POST["metodo_pago"],
        $_POST["monto"],
        $_POST["fecha_pago"],
        $_POST["estado_pago"]
    )) {
      
        // Crea un array con los datos de la Pago, limpiando cada uno de los valores antes de ser almacenados.
        $datosPago = [
            "id_pago" => Utils::limpiar_datos($_POST["id_pago"]),  // Limpia el ID de la Pago.
            "id_pedido" => Utils::limpiar_datos($_POST["id_pedido"]),    // Limpia el nombre de la Pago.
            "id_usuario" => Utils::limpiar_datos($_POST["id_usuario"]),  // Limpia la descripción de la Pago.
            "metodo_pago" => Utils::limpiar_datos($_POST["metodo_pago"]),  // Limpia el precio de la Pago.
            "monto" => Utils::limpiar_datos($_POST["monto"]),  // Limpia la URL de la imagen de la Pago.
            "fecha_pago" => Utils::limpiar_datos($_POST["fecha_pago"]),  // Limpia el color de la Pago.
            "estado_pago" => Utils::limpiar_datos($_POST["estado_pago"]),  // Limpia la ocasión de la Pago (por ejemplo, boda, cumpleaños).
        ];


        // Crea una instancia de la clase Pago para interactuar con la base de datos y realizar las operaciones.
        $gestorPagos = new Pago();

        // Llama al método `updatePago` de la clase Pago para actualizar los datos de la Pago en la base de datos.
        if ($gestorPagos->updatePago($datosPago)) {
            // Si la actualización es exitosa, asigna un mensaje de éxito.
            $mensaje = "Pago actualizado";
            include "mainPagoController.php";  // Incluye el archivo de la vista que muestra el resultado (éxito).
        } else {
            // Si hay un error al actualizar, asigna un mensaje de error.
            $mensaje = "Error al actualizar el pago";
            include "mainPagoController.php";  // Incluye el archivo de la vista que muestra el resultado (éxito).
        }
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    modificarPago();
}

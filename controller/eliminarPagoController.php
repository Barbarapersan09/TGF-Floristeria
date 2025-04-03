<?php

use model\Utils; // Importa la clase Utils desde el espacio de nombres "model". Contiene métodos de utilidad como la limpieza de datos.
use model\Pago;  // Importa la clase Pago desde el espacio de nombres "model". Maneja las operaciones relacionadas con las Pagoes en la base de datos.

//require_once "../model/Utils.php";
require_once "../model/Pago.php";

function eliminarPago() {
    // Comprueba si se ha recibido el parámetro 'id_Pago' a través de una solicitud POST.
    if (isset($_GET["id_pago"])) {
        // Limpia el dato recibido para evitar inyección de código o datos no deseados.
        $id_pago = Utils::limpiar_datos($_GET["id_pago"]);

        // Crea una instancia de la clase Pago para interactuar con los datos de la tabla 'Pago'.
        $gestorPago = new Pago();

        // Llama al método deletePago() de la clase Pago para eliminar el registro correspondiente en la base de datos.
        if ($gestorPago->deletePago($id_pago)) {
            // Si la eliminación es exitosa, se muestra un mensaje de éxito.
            $mensaje = "Eliminado pago";
            include "mainPagoController.php";  // Incluye la vista 'Pago.php' para actualizar la interfaz de usuario.
        } else {
            // Si la eliminación falla, se muestra un mensaje de error.
            $mensaje = "Error al eliminar el pago";
            include "mainPagoController.php";  // Incluye la vista 'Pago.php' para actualizar la interfaz de usuario.
        }
    }
}
if ($_SERVER["REQUEST_METHOD"]== "GET") {
    
    eliminarPago();
}
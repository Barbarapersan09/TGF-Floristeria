<?php

use model\Utils; // Importa la clase Utils desde el espacio de nombres "model". Contiene métodos de utilidad como la limpieza de datos.
use model\Envio;  // Importa la clase Envio desde el espacio de nombres "model". Maneja las operaciones relacionadas con las Envioes en la base de datos.
require_once "../model/Envio.php";


// Comprueba si se ha recibido el parámetro 'id_Envio' a través de una solicitud POST.
if (isset($_GET["id_envio"])) {
    // Limpia el dato recibido para evitar inyección de código o datos no deseados.
    $id_envio = Utils::limpiar_datos($_GET["id_envio"]);

    // Crea una instancia de la clase Envio para interactuar con los datos de la tabla 'Envioes'.
    $gestorEnvio = new Envio();

    // Llama al método deleteEnvio() de la clase Envio para eliminar el registro correspondiente en la base de datos.
    if ($gestorEnvio->deleteEnvio($id_envio)) {
        // Si la eliminación es exitosa, se muestra un mensaje de éxito.
        $mensaje = "Eliminado envio";
        header("Location: mainEnvioController.php");
    } else {
        // Si la eliminación falla, se muestra un mensaje de error.
        $mensaje = "Error al eliminar el envio";
        header("Location: mainEnvioController.php");
    }
}

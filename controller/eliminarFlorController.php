<?php

use model\Utils; // Importa la clase Utils desde el espacio de nombres "model". Contiene métodos de utilidad como la limpieza de datos.
use model\Flor;  // Importa la clase Flor desde el espacio de nombres "model". Maneja las operaciones relacionadas con las flores en la base de datos.

//require_once "../model/Utils.php";
require_once "../model/Flor.php";


function eliminarFlor() {
    // Comprueba si se ha recibido el parámetro 'id_flor' a través de una solicitud POST.
    if (isset($_GET["id_flor"])) {
        // Limpia el dato recibido para evitar inyección de código o datos no deseados.
        $id_flor = Utils::limpiar_datos($_GET["id_flor"]);

        // Crea una instancia de la clase Flor para interactuar con los datos de la tabla 'flores'.
        $gestorFlor = new Flor();

        // Llama al método deleteFlor() de la clase Flor para eliminar el registro correspondiente en la base de datos.
        if ($gestorFlor->deleteFlor($id_flor)) {
            // Si la eliminación es exitosa, se muestra un mensaje de éxito.
            $mensaje = "Eliminado producto";
            header("Location: mainFlorController.php") ;  // Incluye la vista 'flores.php' para actualizar la interfaz de usuario.
        } else {
            // Si la eliminación falla, se muestra un mensaje de error.
            $mensaje = "Error al eliminar el producto";
            header("Location: mainFlorController.php");  // Incluye la misma vista para mantener la consistencia.
        }
    }
}
if($_SERVER["REQUEST_METHOD"]== "GET"){
    eliminarFlor();
}
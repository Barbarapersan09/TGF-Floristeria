<?php

use model\Utils; // Importa la clase Utils desde el espacio de nombres "model". Contiene métodos de utilidad como la limpieza de datos.
use model\Factura;  // Importa la clase Factura desde el espacio de nombres "model". Maneja las operaciones relacionadas con las Facturaes en la base de datos.

//require_once "../model/Utils.php";
require_once "../model/Factura.php";

function eliminarFactura()
{
    // Comprueba si se ha recibido el parámetro 'id_Factura' a través de una solicitud POST.
    if (isset($_GET["id_factura"])) {
        // Limpia el dato recibido para evitar inyección de código o datos no deseados.
        $id_factura = Utils::limpiar_datos($_GET["id_factura"]);
      

        // Crea una instancia de la clase Factura para interactuar con los datos de la tabla 'Factura'.
        $gestorFacturas = new Factura();

        // Llama al método deleteFactura() de la clase Factura para eliminar el registro correspondiente en la base de datos.
        if ($gestorFacturas->deleteFacturas($id_factura)) {
            // Si la eliminación es exitosa, se muestra un mensaje de éxito.
            $mensaje = "Eliminado factura";
            header("Location: mainFacturasController.php") ; // Incluye la vista 'Factura.php' para actualizar la interfaz de usuario.
        } else {
            // Si la eliminación falla, se muestra un mensaje de error.
            $mensaje = "Error al eliminar la factura";
            header("Location: mainFacturasController.php") ; // Incluye la vista 'Factura.php' para actualizar la interfaz de usuario.
        }
    }
}
if($_SERVER["REQUEST_METHOD"]== "GET"){
    eliminarFactura();
}
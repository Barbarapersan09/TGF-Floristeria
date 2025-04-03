<?php

use model\Utils;  // Importa la clase Utils desde el espacio de nombres "model", utilizada para funciones de utilidad como la limpieza de datos.
use model\Factura;   // Importa la clase Facturas desde el espacio de nombres "model", que probablemente maneja las operaciones relacionadas con Facturases en la base de datos.

require_once "../model/Factura.php";

// Función para manejar la modificación de la información de una Facturas en la base de datos.
function modificarFacturas(){
echo "entra 1";
    // Verifica si todos los campos necesarios han sido enviados a través del formulario (método POST).
    if(isset($_POST["id_factura"], $_POST["id_pedido"], $_POST["fecha_factura"], $_POST["monto_total"])){

        // Crea un array con los datos de la Facturas, limpiando cada uno de los valores antes de ser almacenados.
        $datosFacturas = [
            "id_factura" => Utils::limpiar_datos($_POST["id_factura"]),  // Limpia el ID de la Facturas.
            "id_pedido" => Utils::limpiar_datos($_POST["id_pedido"]),    // Limpia el nombre de la Facturas.
            "fecha_factura" => Utils::limpiar_datos($_POST["fecha_factura"]),  // Limpia la descripción de la Facturas.
            "monto_total" => Utils::limpiar_datos($_POST["monto_total"])  // Limpia el precio de la Facturas.
            ];

        
        // Crea una instancia de la clase Facturas para interactuar con la base de datos y realizar las operaciones.
        $gestorFacturas = new Factura();

        // Llama al método `updateFacturas` de la clase Facturas para actualizar los datos de la Facturas en la base de datos.
        if ($gestorFacturas->updateFacturas($datosFacturas)) {
            // Si la actualización es exitosa, asigna un mensaje de éxito.
            $mensaje = "Producto actualizado";
            include "mainFacturasController.php";  // Incluye el archivo de la vista que muestra el resultado (éxito).
        } else {
            // Si hay un error al actualizar, asigna un mensaje de error.
            $mensaje = "Error al actualizar el producto";
            include "mainFacturasController.php";  // Incluye el archivo de la vista que muestra el resultado (éxito).
        }
    }
}

if ($_SERVER["REQUEST_METHOD"]== "POST") {
    echo "entra 0";
    modificarFacturas();
}

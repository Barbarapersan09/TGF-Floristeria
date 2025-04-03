<?php

use model\Utils; // Importa la clase Utils desde el espacio de nombres "model". Contiene métodos de utilidad, como la limpieza de datos.
use model\Factura;  // Importa la clase Factura desde el espacio de nombres "model". Gestiona las operaciones relacionadas con las Facturaes en la base de datos.

require_once '../model/Factura.php';

function crearFactura() {
    // Comprueba si se han recibido todos los campos requeridos a través de una solicitud POST.
    if (isset($_POST["id_pedido"], $_POST["monto_total"])) {
        
        // Crea un array asociativo `$datosFactura` con los datos proporcionados por el usuario.
        // Limpia cada dato con el método `limpiar_datos` de la clase Utils para prevenir inyección de código y garantizar datos seguros.
        $datosFacturas = [
            "id_pedido" => Utils::limpiar_datos($_POST["id_pedido"]),
            "monto_total" => Utils::limpiar_datos($_POST["monto_total"])
        ];  

        // Crea una instancia de la clase Factura para gestionar las operaciones relacionadas con la base de datos.
        $gestorFacturas = new Factura();

        // Intenta agregar la nueva Factura a la base de datos utilizando el método `addFactura`.
        if ($gestorFacturas->addFactura($datosFacturas)) {
            // Si la operación es exitosa, define un mensaje de éxito.
            $mensaje = "Factura añadida";
            // Incluye la vista `Facturaes.php` para mostrar el resultado.
            include "mainFacturasController.php";
        } else {
            // Si ocurre un error al añadir la Factura, define un mensaje de error.
            $mensaje = "Error al añadir la factura";
            // Incluye la vista `Facturaes.php` para informar del fallo.
            include "mainFacturasController.php";
        }
    }
}

if ($_SERVER["REQUEST_METHOD"]== "POST") {
    crearFactura();
}

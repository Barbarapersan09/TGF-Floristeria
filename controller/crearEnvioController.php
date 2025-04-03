<?php

use model\Utils; // Importa la clase Utils desde el espacio de nombres "model". Contiene métodos de utilidad, como la limpieza de datos.
use model\Envio;  // Importa la clase Envio desde el espacio de nombres "model". Gestiona las operaciones relacionadas con las Envioes en la base de datos.

//require_once '../model/Utils.php';
require_once '../model/Envio.php';

// Comprueba si se han recibido todos los campos requeridos a través de una solicitud POST.
if (isset($_POST["id_pedido"], $_POST["direccion_envio"])) {

    // Crea un array asociativo `$datosEnvio` con los datos proporcionados por el usuario.
    // Limpia cada dato con el método `limpiar_datos` de la clase Utils para prevenir inyección de código y garantizar datos seguros.
    $datosEnvio = [
        "id_pedido" => Utils::limpiar_datos($_POST["id_pedido"]),
        "direccion_envio" => Utils::limpiar_datos($_POST["direccion_envio"]),
        "estado_envio" => "Pendiente"
    ];

    // Crea una instancia de la clase Envio para gestionar las operaciones relacionadas con la base de datos.
    $gestorEnvios = new Envio();

    // Intenta agregar la nueva Envio a la base de datos utilizando el método `addEnvio`.
    if ($gestorEnvios->addEnvio($datosEnvio)) {
        // Si la operación es exitosa, define un mensaje de éxito.
        $mensaje = "Envio añadido";
        // Incluye la vista `Envioes.php` para mostrar el resultado.
        header("Location: mainEnvioController.php");
    } else {
        // Si ocurre un error al añadir la Envio, define un mensaje de error.
        $mensaje = "Error al añadir el envio";
        // Incluye la vista `Envioes.php` para informar del fallo.
        header("Location: mainEnvioController.php");
    }
}

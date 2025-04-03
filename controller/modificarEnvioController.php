<?php


use model\Utils;  // Importa la clase Utils desde el espacio de nombres "model", utilizada para funciones de utilidad como la limpieza de datos.
use model\Envio;   // Importa la clase Categoria desde el espacio de nombres "model", que probablemente maneja las operaciones relacionadas con Categoriaes en la base de datos.

//require_once "../model/Utils.php";
require_once "../model/Envio.php";

// Función para manejar la modificación de la información de una Categoria en la base de datos.
// function modificarCategoria(){

    // Verifica si todos los campos necesarios han sido enviados a través del formulario (método POST).
    if (isset($_POST["id_envio"], $_POST["id_pedido"], $_POST["direccion_envio"], $_POST["fecha_envio"], $_POST["estado_envio"])) {

        // Crea un array con los datos de la Categoria, limpiando cada uno de los valores antes de ser almacenados.
        $datosEnvios = [
            "id_envio" => Utils::limpiar_datos($_POST["id_envio"]),  // Limpia el ID de la Categoria.
            "id_pedido" => Utils::limpiar_datos($_POST["id_pedido"]),    // Limpia el nombre de la Categoria.
            "direccion_envio" => Utils::limpiar_datos($_POST["direccion_envio"]),  // Limpia la descripción de la Categoria.
            "fecha_envio" => Utils::limpiar_datos($_POST["fecha_envio"]),  // Limpia la descripción de la Categoria.
            "estado_envio" => Utils::limpiar_datos($_POST["estado_envio"]),  // Limpia la descripción de la Categoria.

        ];
        
        // Crea una instancia de la clase Categoria para interactuar con la base de datos y realizar las operaciones.
        $gestorEnvio = new Envio();

        // Llama al método `updateCategoria` de la clase Categoria para actualizar los datos de la Categoria en la base de datos.
        if ($gestorEnvio->updateEnvio($datosEnvios)) {
            // Si la actualización es exitosa, asigna un mensaje de éxito.
            $mensaje = "Categoria actualizado";
            include "mainEnvioController.php";  // Incluye el archivo de la vista que muestra el resultado (éxito).
        } else {
            // Si hay un error al actualizar, asigna un mensaje de error.
            $mensaje = "Error al actualizar la categoria";
            include "mainEnvioController.php";  // Incluye la vista con el mensaje de error.
        }
    }
// }

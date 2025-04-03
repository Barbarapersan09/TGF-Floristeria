<?php

use model\Utils; // Importa la clase Utils desde el espacio de nombres "model". Contiene métodos de utilidad como la limpieza de datos.
use model\Usuario;  // Importa la clase Usuario desde el espacio de nombres "model". Maneja las operaciones relacionadas con las Usuarioes en la base de datos.

require_once "../model/Usuario.php";

function eliminarUsuario()
{
    // Comprueba si se ha recibido el parámetro 'id_Usuario' a través de una solicitud POST.
    if (isset($_GET["id_usuario"])) {
        // Limpia el dato recibido para evitar inyección de código o datos no deseados.
        $id_usuario = Utils::limpiar_datos($_GET["id_usuario"]);
      
        // Crea una instancia de la clase Usuario para interactuar con los datos de la tabla 'Usuario'.
        $gestorUsuarios = new Usuario();

        // Llama al método deleteUsuario() de la clase Usuario para eliminar el registro correspondiente en la base de datos.
        if ($gestorUsuarios->deleteUsuario($id_usuario)) {
            // Si la eliminación es exitosa, se muestra un mensaje de éxito.
            $mensaje = "Eliminado usuario";
            include "mainUsuarioController.php";  // Incluye la vista 'Usuario.php' para actualizar la interfaz de usuario.
        } else {
            // Si la eliminación falla, se muestra un mensaje de error.
            $mensaje = "Error al eliminar el usuario";
            include "mainUsuarioController.php";  // Incluye la vista 'Usuario.php' para actualizar la interfaz de usuario.
        }
    }
}

if ($_SERVER["REQUEST_METHOD"]== "GET") {

    eliminarUsuario();
}

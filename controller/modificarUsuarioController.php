<?php

use model\Utils;  // Importa la clase Utils desde el espacio de nombres "model", utilizada para funciones de utilidad como la limpieza de datos.
use model\Usuario;   // Importa la clase Usuario desde el espacio de nombres "model", que probablemente maneja las operaciones relacionadas con Usuarioes en la base de datos.

require_once "../model/Usuario.php";

// Función para manejar la modificación de la información de una Usuario en la base de datos.
function modificarUsuario(){

    // Verifica si todos los campos necesarios han sido enviados a través del formulario (método POST).
    if(isset($_POST["id_usuario"], $_POST["nombre"], $_POST["apellido"], $_POST["email"])){

        // Crea un array con los datos de la Usuario, limpiando cada uno de los valores antes de ser almacenados.
        $datosUsuario = [
            "id_usuario" => Utils::limpiar_datos($_POST["id_usuario"]),  // Limpia el ID de la Usuario.
            "nombre" => Utils::limpiar_datos($_POST["nombre"]),    // Limpia el nombre de la Usuario.
            "apellido" => Utils::limpiar_datos($_POST["apellido"]),  // Limpia la descripción de la Usuario.
            "email" => Utils::limpiar_datos($_POST["email"])  // Limpia el precio de la Usuario.
            ];

        
        // Crea una instancia de la clase Usuario para interactuar con la base de datos y realizar las operaciones.
        $gestorUsuarios = new Usuario();

        // Llama al método `updateUsuario` de la clase Usuario para actualizar los datos de la Usuario en la base de datos.
        if ($gestorUsuarios->updateUsuario($datosUsuario)) {
            // Si la actualización es exitosa, asigna un mensaje de éxito.
            $mensaje = "Usuario actualizado";
            include "mainUsuarioController.php";  // Incluye el archivo de la vista que muestra el resultado (éxito).
        } else {
            // Si hay un error al actualizar, asigna un mensaje de error.
            $mensaje = "Error al actualizar el usuario";
            include "mainUsuarioController.php";  // Incluye el archivo de la vista que muestra el resultado (éxito).
        }
    }
}
if ($_SERVER["REQUEST_METHOD"]== "POST") {

    modificarUsuario();
}
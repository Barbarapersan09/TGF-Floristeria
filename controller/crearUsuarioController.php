<?php

use model\Utils; // Importa la clase Utils desde el espacio de nombres "model". Contiene métodos de utilidad, como la limpieza de datos.
use model\Usuario;  // Importa la clase Usuario desde el espacio de nombres "model". Gestiona las operaciones relacionadas con las Usuarioes en la base de datos.

require_once '../model/Usuario.php';

function crearUsuario() {
    // Comprueba si se han recibido todos los campos requeridos a través de una solicitud POST.
    if (isset($_POST["nombre"], $_POST["apellido"], $_POST["email"], $_POST["password"])) {
        
        // Crea un array asociativo `$datosUsuario` con los datos proporcionados por el usuario.
        // Limpia cada dato con el método `limpiar_datos` de la clase Utils para prevenir inyección de código y garantizar datos seguros.
        $datosUsuario = [
            "nombre" => Utils::limpiar_datos($_POST["nombre"]),
            "apellido" => Utils::limpiar_datos($_POST["apellido"]),
            "email" => Utils::limpiar_datos($_POST["email"]),
            "password" => Utils::limpiar_datos($_POST["password"])
        ];

        // Crea una instancia de la clase Usuario para gestionar las operaciones relacionadas con la base de datos.
        $gestorUsuarios = new Usuario();

        // Intenta agregar la nueva Usuario a la base de datos utilizando el método `addUsuario`.
        if ($gestorUsuarios->addUsuario($datosUsuario)) {
            // Si la operación es exitosa, define un mensaje de éxito.
            $mensaje = "Usuario añadido";
            // Incluye la vista `Usuarioes.php` para mostrar el resultado.
            include "../view/usuario.php";
        } else {
            // Si ocurre un error al añadir la Usuario, define un mensaje de error.
            $mensaje = "Error al añadir el usuario";
            // Incluye la vista `Usuarioes.php` para informar del fallo.
            include "../view/usuario.php";
        }
    }
}

if ($_SERVER["REQUEST_METHOD"]== "POST") {
    echo "entra 0";
    crearUsuario();
}
<?php
namespace controller;  // Define el espacio de nombres "controller", usado para organizar la lógica de control.

use \model\Usuario;  // Importa la clase Usuario desde el espacio de nombres "model".
use \model\Utils;  // Importa la clase Utils desde el espacio de nombres "model".

require_once "../model/Utils.php";
require_once "../model/Usuario.php";


// Función para manejar el proceso de inicio de sesión (login) del usuario.
function loginController(){
    session_start();  // Inicia una nueva sesión o reanuda la sesión actual, necesaria para gestionar datos del usuario durante la navegación.

    // Verifica si se han enviado los campos "email" y "pass" a través del formulario (método POST).
    if(isset($_POST["email"]) && isset($_POST["pass"])){
        // Limpia los datos del correo electrónico para prevenir inyecciones de código o caracteres no deseados.
        $email = Utils::limpiar_datos($_POST["email"]);
        $_SESSION["email"] = $email;
        // Recupera la contraseña proporcionada por el usuario.
        $pass = $_POST["pass"];
        
        // Crea una instancia de la clase Usuario para interactuar con la base de datos.
        $gestorUsuario = new Usuario();
        
        // Llama al método `getUsuarioByEmail` de la clase Usuario para obtener el usuario desde la base de datos por su email.
        $usuario = $gestorUsuario->getUsuarioByEmail($email);

        // Si el usuario existe y la contraseña proporcionada coincide con la almacenada en la base de datos (verificación de la contraseña hasheada).
        if($usuario && password_verify($pass, $usuario["password"])){
            // Si la verificación es exitosa, se guardan los datos del usuario en la sesión.
            $_SESSION["usuario"] = $usuario;  // Almacena todos los datos del usuario en la variable de sesión "usuario".
            $_SESSION["id"] = $usuario["id_usuario"];  // Almacena el ID del usuario en la variable de sesión "id".
            $_SESSION["Nombre"] = $usuario["Nombre"];  // Almacena el nombre del usuario en la variable de sesión "Nombre".
            $_SESSION["rol"] = $usuario["rol"];  // Almacena el nombre del usuario en la variable de sesión "Nombre".

            // Redirige al usuario a la página principal (indice.html) después de un inicio de sesión exitoso.
            header("Location: mainFlorController.php");
            exit;  // Asegura que el script se detenga después de la redirección.
        }else{
            $_SESSION["error"]= "Contraseña incorrecta";
            header("Location: ../view/login.php");
        }
    }

}

if ($_SERVER["REQUEST_METHOD"]== "POST") {
    echo "entra 1";
    loginController();
}
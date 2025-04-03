<?php

// Se importa la clase Usuario desde el espacio de nombres 'model'
use model\Usuario;

// Se incluye el archivo donde está definida la clase Usuario
require_once "../model/Usuario.php";

// Se crea una instancia de la clase Usuario
$usuario = new Usuario();

// Verifica si se ha enviado un formulario con un campo llamado "hash"
if (isset($_POST["hash"])) {
    // Se asigna el valor enviado en el campo "hash" del formulario a la variable $codigo
    $codigo = $_POST["hash"];
    $email = $_POST["email"];
    // Se llama al método 'verificarUsuario' de la clase Usuario, pasando el código como argumento,
    // y se almacena el resultado en la variable $mensaje
    $mensaje = $usuario->verificarUsuario($codigo);
    
    if($mensaje=="Tu cuenta ha sido activada correctamente"){
        session_start();  // Inicia una nueva sesión o reanuda la sesión actual, necesaria para gestionar datos del usuario durante la navegación.
        $datos = $usuario->getUsuarioByEmail($email);

        $_SESSION["usuario"] = $datos;  
        $_SESSION["id"] = $datos["id_usuario"];  
        $_SESSION["Nombre"] = $datos["Nombre"]; 
        $_SESSION["rol"] = $datos["rol"];  

        header("Location: mainFlorController.php");
        exit;  // Asegura que el script se detenga después de la redirección.
    } 

    // Se incluye el archivo de vista "activacion.php" para mostrar el resultado al usuario
    include "../view/activacion.php";
}

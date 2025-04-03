<?php
namespace controller;  // Define el espacio de nombres "controller" para organizar el código.

use \model\Usuario;  // Importa la clase Usuario desde el espacio de nombres "model".
use \model\Utils;  // Importa la clase Utils desde el espacio de nombres "model".

require_once "../model/Utils.php";
require_once "../model/Usuario.php";

// Función para registrar un nuevo usuario.
function registrarUsuario(){
    //var_dump($_POST);
    // Verifica si los campos necesarios han sido enviados a través del formulario (método POST).
    if(isset($_POST["nombre"], $_POST["apellido"], $_POST["email"], $_POST["password"])){

     
        // Limpia los datos recibidos para evitar inyecciones de código o caracteres no deseados.
        $nombre = Utils::limpiar_datos($_POST["nombre"]);
        $apellido = Utils::limpiar_datos($_POST["apellido"]);
        $email = Utils::limpiar_datos($_POST["email"]);
        
        // Recupera la contraseña proporcionada por el usuario.
        $pass = $_POST["password"];
        
        // Hashea la contraseña antes de almacenarla en la base de datos para seguridad.
        $passHash = password_hash($pass, PASSWORD_DEFAULT);

        // Genera un código de activación para el usuario, posiblemente para verificar el correo electrónico.
        $codigoActivacion = Utils::generar_codigo_activacion();

        // Crea un array con los datos del usuario a registrar.
        $usuario = [
            "nombre" => $nombre, 
            "apellido" => $apellido, 
            "email" => $email,
            "password" => $passHash,  // Considera almacenar el valor hasheado de la contraseña en lugar de la contraseña original.
            "hash"=>$codigoActivacion,
            "activo" => 0  // Se establece a 0 para indicar que el usuario no está activado aún.
        ];

        // Crea una instancia del modelo Usuario.
        $gestorUsuario = new Usuario();
        
        // Obtiene la conexión a la base de datos mediante la clase Utils.
        $conPDO = Utils::conectar();

        // Llama al método addUsuario del modelo Usuario para agregar el usuario a la base de datos.
        $resultado = $gestorUsuario->addUsuario($usuario);

        // Verifica si la inserción del usuario fue exitosa.
        if($resultado){
            // Si el registro fue exitoso, envía un correo al usuario para la activación de la cuenta.
            $mail = Utils::enviarCorreo($usuario);

            // Si el correo fue enviado correctamente, muestra un mensaje de éxito.
            if ($mail != null)
                $mensaje = "El Usuario se Registró Correctamente";
            else
                // Si hubo un error al enviar el correo, muestra un mensaje de error.
                $mensaje = "Ha habido un fallo al acceder a la Base de Datos\n salte por la ventana ya!";
        
            // Incluye el archivo de vistas `Activacion.php`, que contiene la interfaz de activación de cuenta.
            include("../view/activacion.php");
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica si la solicitud HTTP recibida es de tipo POST.
    // Esto asegura que el código dentro de este bloque solo se ejecutará
    // si el formulario o la solicitud fue enviada con el método POST.
    
    registrarUsuario(); // Llama a la función 'registrarUsuario'.
}


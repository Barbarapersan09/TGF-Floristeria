<?php

use \model\Utils; // Importa la clase Utils desde el espacio de nombres "model". Contiene métodos de utilidad, como la limpieza de datos.
use \model\Flor;  // Importa la clase Flor desde el espacio de nombres "model". Gestiona las operaciones relacionadas con las flores en la base de datos.

//require_once '../model/Utils.php';
require_once '../model/Flor.php';

var_dump(class_exists('model\Utils')); // Debe devolver true

function crearFlor() {
    // Comprueba si se han recibido todos los campos requeridos a través de una solicitud POST.
    echo "<pre>";
    print_r($_POST);
    print_r($_FILES);
    echo "</pre>";
    if (isset($_FILES["url_imagen"]) && $_FILES["url_imagen"]["error"] === UPLOAD_ERR_OK) {
        $destino = "../assets/img/products/";
        $nombre_imagen = basename($_FILES["url_imagen"]["name"]);
        $ruta_imagen = $destino . $nombre_imagen;
    
        if (!move_uploaded_file($_FILES["url_imagen"]["tmp_name"], $ruta_imagen)) {
            $mensaje = "Error: No se pudo subir la imagen.";
            include "../view/crearFlor.php";
            return;
        }
        // Añadir ruta de la imagen al array.
        $datosFlor["url_imagen"] = $ruta_imagen;
    } else {
        $mensaje = "Error: No se proporcionó una imagen o hubo un problema al subirla.";
        include "../view/crearFlor.php";
        return;
    }
    
    
        // Crea un array asociativo `$datosFlor` con los datos proporcionados por el usuario.
        // Limpia cada dato con el método `limpiar_datos` de la clase Utils para prevenir inyección de código y garantizar datos seguros.
        $datosFlor = [
            "nombre" => Utils::limpiar_datos($_POST["nombre"]),
            "descripcion" => Utils::limpiar_datos($_POST["descripcion"]),
            "precio" => Utils::limpiar_datos($_POST["precio"]),
            "url_imagen" => Utils::limpiar_datos($ruta_imagen),
            "color" => Utils::limpiar_datos($_POST["color"]),
            "ocasion" => Utils::limpiar_datos($_POST["ocasion"]),
            "stock" => Utils::limpiar_datos($_POST["stock"]),
            "id_categoria" => Utils::limpiar_datos($_POST["id_categoria"])
        ];

        // Crea una instancia de la clase Flor para gestionar las operaciones relacionadas con la base de datos.
        $gestorFlores = new Flor();

        // Intenta agregar la nueva flor a la base de datos utilizando el método `addFlor`.
        if ($gestorFlores->addFlor($datosFlor)) {
            echo "entra 3";
            // Si la operación es exitosa, define un mensaje de éxito.
            $mensaje = "Producto añadido";
            // Incluye la vista `flores.php` para mostrar el resultado.
            header("Location: mainFlorController.php");  // Incluye la misma vista para mantener la consistencia.
            
        } else {
            echo "entra 4";
            // Si ocurre un error al añadir la flor, define un mensaje de error.
            $mensaje = "Error al añadir el producto";
            // Incluye la vista `flores.php` para informar del fallo.
            header("Location: mainFlorController.php");  // Incluye la misma vista para mantener la consistencia.

        }
    }



if ($_SERVER["REQUEST_METHOD"]== "POST") {
    echo "entra 0";
    crearFlor();
}
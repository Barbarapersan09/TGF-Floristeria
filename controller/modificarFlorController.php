<?php

use model\Utils;  // Importa la clase Utils desde el espacio de nombres "model", utilizada para funciones de utilidad como la limpieza de datos.
use model\Flor;   // Importa la clase Flor desde el espacio de nombres "model", que probablemente maneja las operaciones relacionadas con flores en la base de datos.

//require_once "../model/Utils.php";
require_once "../model/Flor.php";

// Función para manejar la modificación de la información de una flor en la base de datos.
function modificarFLor(){

    // Verifica si todos los campos necesarios han sido enviados a través del formulario (método POST).
    if(isset($_POST["id_flor"], $_POST["nombre"], $_POST["descripcion"], $_POST["precio"], $_FILES["url_imagen"],
             $_POST["color"], $_POST["ocasion"], $_POST["stock"], $_POST["id_categoria"])){
        $url_imagen = $_POST["url_imagen"];
        if(isset($_FILES["url_imagen"]) && $_FILES["url_imagen"]["error"]=== UPLOAD_ERR_OK){
            $nombre_archivo = basename($_FILES["url_imagen"]["name"]);
            $ruta_temporal = $_FILES["url_imagen"]["tmp_name"];
            $destino = "../assets/img/products/". $nombre_archivo;
            if(move_uploaded_file($ruta_temporal,$destino)){
                $url_imagen = $destino;
            }else{
                echo "Error al mover archivo";
            }
        }
        // Crea un array con los datos de la flor, limpiando cada uno de los valores antes de ser almacenados.
        $datosFlor = [
            "id_flor" => Utils::limpiar_datos($_POST["id_flor"]),  // Limpia el ID de la flor.
            "nombre" => Utils::limpiar_datos($_POST["nombre"]),    // Limpia el nombre de la flor.
            "descripcion" => Utils::limpiar_datos($_POST["descripcion"]),  // Limpia la descripción de la flor.
            "precio" => Utils::limpiar_datos($_POST["precio"]),  // Limpia el precio de la flor.
            "url_imagen" => Utils::limpiar_datos($url_imagen),  // Limpia la URL de la imagen de la flor.
            "color" => Utils::limpiar_datos($_POST["color"]),  // Limpia el color de la flor.
            "ocasion" => Utils::limpiar_datos($_POST["ocasion"]),  // Limpia la ocasión de la flor (por ejemplo, boda, cumpleaños).
            "stock" => Utils::limpiar_datos($_POST["stock"]),  // Limpia la cantidad de stock disponible.
            "id_categoria" => Utils::limpiar_datos($_POST["id_categoria"])  // Limpia la categoría de la flor.
        ];

        
        // Crea una instancia de la clase Flor para interactuar con la base de datos y realizar las operaciones.
        $gestorFlores = new Flor();
        
        // Llama al método `updateFlor` de la clase Flor para actualizar los datos de la flor en la base de datos.
        if ($gestorFlores->updateFlor($datosFlor)) {
            // Si la actualización es exitosa, asigna un mensaje de éxito.
            
            $mensaje = "Producto actualizado";
            include "mainFlorController.php";  // Incluye el archivo de la vista que muestra el resultado (éxito).
        } else {
            
            // Si hay un error al actualizar, asigna un mensaje de error.
            $mensaje = "Error al actualizar el producto";
            include "../view/modificarFlor.php";  // Incluye la vista con el mensaje de error.
        }
    }
}
if ($_SERVER["REQUEST_METHOD"]== "POST") {
    echo "entra 0";
    modificarFLor();
}
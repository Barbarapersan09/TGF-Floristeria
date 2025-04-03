<?php


use model\Utils;  // Importa la clase Utils desde el espacio de nombres "model", utilizada para funciones de utilidad como la limpieza de datos.
use model\Categoria;   // Importa la clase Categoria desde el espacio de nombres "model", que probablemente maneja las operaciones relacionadas con Categoriaes en la base de datos.

//require_once "../model/Utils.php";
require_once "../model/Categoria.php";

// Función para manejar la modificación de la información de una Categoria en la base de datos.
// function modificarCategoria(){

    // Verifica si todos los campos necesarios han sido enviados a través del formulario (método POST).
    if (isset($_POST["id_categoria"], $_POST["nombre_categoria"], $_POST["descripcion"])) {

        // Crea un array con los datos de la Categoria, limpiando cada uno de los valores antes de ser almacenados.
        $datosCategoria = [
            "id_categoria" => Utils::limpiar_datos($_POST["id_categoria"]),  // Limpia el ID de la Categoria.
            "nombre_categoria" => Utils::limpiar_datos($_POST["nombre_categoria"]),    // Limpia el nombre de la Categoria.
            "descripcion" => Utils::limpiar_datos($_POST["descripcion"]),  // Limpia la descripción de la Categoria.
        ];
        
        // Crea una instancia de la clase Categoria para interactuar con la base de datos y realizar las operaciones.
        $gestorCategoria = new Categoria();

        // Llama al método `updateCategoria` de la clase Categoria para actualizar los datos de la Categoria en la base de datos.
        if ($gestorCategoria->updateCategoria($datosCategoria)) {
            // Si la actualización es exitosa, asigna un mensaje de éxito.
            $mensaje = "Categoria actualizado";
            include "mainCategoriaController.php";  // Incluye el archivo de la vista que muestra el resultado (éxito).
        } else {
            // Si hay un error al actualizar, asigna un mensaje de error.
            $mensaje = "Error al actualizar la categoria";
            include "mainCategoriaController.php";  // Incluye la vista con el mensaje de error.
        }
    }
// }

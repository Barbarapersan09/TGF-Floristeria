<?php

use model\Utils; // Importa la clase Utils desde el espacio de nombres "model". Contiene métodos de utilidad como la limpieza de datos.
use model\Categoria;  // Importa la clase Categoria desde el espacio de nombres "model". Maneja las operaciones relacionadas con las Categoriaes en la base de datos.

//require_once "../model/Utils.php";
require_once "../model/Categoria.php";

// Comprueba si se ha recibido el parámetro 'id_Categoria' a través de una solicitud POST.
if (isset($_GET["id_categoria"])) {
    // Limpia el dato recibido para evitar inyección de código o datos no deseados.
    $id_categoria = Utils::limpiar_datos($_GET["id_categoria"]);


    // Crea una instancia de la clase Categoria para interactuar con los datos de la tabla 'Categoriaes'.
    $gestorCategoria = new Categoria();

    // Llama al método deleteCategoria() de la clase Categoria para eliminar el registro correspondiente en la base de datos.
    if ($gestorCategoria->deleteCategoria($id_categoria)) {
        // Si la eliminación es exitosa, se muestra un mensaje de éxito.
        $mensaje = "Eliminado categoria";
        include "mainCategoriaController.php";  // Incluye la vista 'Categoriaes.php' para actualizar la interfaz de usuario.
    } else {
        // Si la eliminación falla, se muestra un mensaje de error.
        $mensaje = "Error al eliminar la categoria";
        include "mainCategoriaController.php";  // Incluye la misma vista para mantener la consistencia.
    }
}

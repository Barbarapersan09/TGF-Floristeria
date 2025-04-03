<?php

use model\Utils; // Importa la clase Utils desde el espacio de nombres "model". Contiene métodos de utilidad, como la limpieza de datos.
use model\Categoria;  // Importa la clase Categoria desde el espacio de nombres "model". Gestiona las operaciones relacionadas con las Categoriaes en la base de datos.

//require_once '../model/Utils.php';
require_once '../model/Categoria.php';

// function crearCategoria(){
// Comprueba si se han recibido todos los campos requeridos a través de una solicitud POST.
if (isset($_POST["nombre_categoria"], $_POST["descripcion"])) {

    // Crea un array asociativo `$datosCategoria` con los datos proporcionados por el usuario.
    // Limpia cada dato con el método `limpiar_datos` de la clase Utils para prevenir inyección de código y garantizar datos seguros.
    $datosCategoria = [
        "nombre_categoria" => Utils::limpiar_datos($_POST["nombre_categoria"]),
        "descripcion" => Utils::limpiar_datos($_POST["descripcion"])
    ];

    // Crea una instancia de la clase Categoria para gestionar las operaciones relacionadas con la base de datos.
    $gestorCategoria = new Categoria();

    // Intenta agregar la nueva Categoria a la base de datos utilizando el método `addCategoria`.
    if ($gestorCategoria->addCategoria($datosCategoria)) {
        // Si la operación es exitosa, define un mensaje de éxito.
        $mensaje = "Categoria añadido";
        // Incluye la vista `Categoria.php` para mostrar el resultado.
        include "mainCategoriaController.php";
    } else {
        // Si ocurre un error al añadir la Categoria, define un mensaje de error.
        $mensaje = "Error al añadir la Categoria";
        // Incluye la vista `Categoria.php` para informar del fallo.
        include "mainCategoriaController.php";
    }
}
// }

<?php

namespace controller;  // Define el espacio de nombres "controller" para organizar el código.

use \model\Categoria;   // Importa la clase Flor desde el espacio de nombres "model", que probablemente maneja las operaciones relacionadas con flores en la base de datos.
require_once "../model/Categoria.php";

if (isset($_GET["id_categoria"])) {
    $id_categoria = $_GET["id_categoria"];
    // Crea una instancia de la clase Flor para interactuar con la base de datos y realizar las operaciones.
    $gestorCategoria = new Categoria();
    $categoria = $gestorCategoria->getCategoriaById($id_categoria);
    if($categoria){
        $categoria = $categoria[0];
        include "../view/modificarCategoria.php";
    }else{
        header("Location: ../view/Categorias.php");
    }
}

if(isset($_GET["id"]) && $_GET["action"] === "mostrar") {

    $id_categoria = $_GET["id"];
    // Crea una instancia de la clase Flor para interactuar con la base de datos y realizar las operaciones.
    $gestorCategoria = new Categoria();
    $categoria = $gestorCategoria->getCategoriaById($id_categoria);
    if($categoria){
        $categoria = $categoria[0];
        include "../view/detalles.php";
    }else{
        header("Location: ../view/perfil.php");
    }
}
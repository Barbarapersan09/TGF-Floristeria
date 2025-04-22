<?php

namespace controller;  // Define el espacio de nombres "controller" para organizar el código.

use \model\Flor;   // Importa la clase Flor desde el espacio de nombres "model", que probablemente maneja las operaciones relacionadas con flores en la base de datos.
use \model\Categoria;
require_once "../model/Flor.php";
require_once "../model/Categoria.php";

if (isset($_GET["id_flor"])) {
    $id_flor = $_GET["id_flor"];
    // Crea una instancia de la clase Flor para interactuar con la base de datos y realizar las operaciones.
    $gestorFlores = new Flor();
    $flor = $gestorFlores->getFlorById($id_flor);
    $gestorCategoria = new Categoria();
    $categorias= $gestorCategoria->getAllCategorias();
    if($flor){
        $flor = $flor[0];
        include "../view/modificarFlor.php";
    }else{
        header("Location: ../view/perfil.php");
    }
}

if(isset($_GET["id"]) && $_GET["action"] === "mostrar") {

    $id_flor = $_GET["id"];
    // Crea una instancia de la clase Flor para interactuar con la base de datos y realizar las operaciones.
    $gestorFlores = new Flor();
    $flor = $gestorFlores->getFlorById($id_flor);
    if($flor){
        $flor = $flor[0];
        include "../view/detalles.php";
    }else{
        header("Location: ../view/perfil.php");
    }
}
function getCategorias(){
    $gestorCategoria = new Categoria();
    $categorias= $gestorCategoria->getAllCategorias();
    return $categorias;
}
//$categorias= getCategorias();
//var_dump($categorias);
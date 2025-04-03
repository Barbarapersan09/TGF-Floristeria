<?php

use \model\Flor;  // Importa la clase Flor desde el espacio de nombres "model", que maneja la lógica relacionada con las flores.
use \model\Utils; // Importa la clase Utils desde el espacio de nombres "model", que contiene funciones auxiliares como la conexión a la base de datos y otras utilidades.

// Incluimos los archivos necesarios para el funcionamiento del código, que contienen las clases Flor y Utils.
require_once "../model/Flor.php";
require_once "../model/Utils.php";
require_once "../config/config.php";

session_start();
$mensaje = null;  // Inicializa una variable para almacenar posibles mensajes de error o éxito (aunque en este caso no se usa).
$pagActual= isset($_REQUEST["pagina"])?(int)$_REQUEST["pagina"]:1;
if($pagActual<1)$pagActual = 1;
// Obtiene la conexión a la base de datos mediante la clase Utils.
$conPDO = Utils::conectar();
// Creamos una instancia de la clase Flor, que nos permitirá interactuar con los datos de las flores en la base de datos.
$gestorFlor = new Flor();
$productosPag = 6;
$inicio = ($pagActual - 1)*$productosPag;
$isAdmin = isset($_SESSION["rol"]) && $_SESSION["rol"]=== "admin";
if( $isAdmin){
    $flores = $gestorFlor->getFloresPag($conPDO, true, "id_flores", $pagActual, PHP_INT_MAX);
    $totalPaginas = 1 ;  // Extraemos el valor 'Paginas' del resultado del método totalPaginas().
    include "../view/perfil.php";
}else{
    $flores = $gestorFlor->getFloresPag($conPDO, true, "id_flores", $pagActual, $productosPag);
    $totalPaginas = $gestorFlor->totalPaginas($conPDO, $productosPag)["Paginas"];  // Extraemos el valor 'Paginas' del resultado del método totalPaginas().
    include "../view/shop.php";
}



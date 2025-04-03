<?php

use \model\Categoria;  // Importa la clase Flor desde el espacio de nombres "model", que maneja la lógica relacionada con las flores.
use \model\Utils; // Importa la clase Utils desde el espacio de nombres "model", que contiene funciones auxiliares como la conexión a la base de datos y otras utilidades.

// Incluimos los archivos necesarios para el funcionamiento del código, que contienen las clases Flor y Utils.
require_once("../model/Categoria.php");
require_once("../model/Utils.php");

$mensaje = null;  // Inicializa una variable para almacenar posibles mensajes de error o éxito (aunque en este caso no se usa).

// Comprobamos si se ha recibido el parámetro 'pagina' en la solicitud. Si no se recibe, asignamos el valor 1 por defecto.
if (isset($_REQUEST["pagina"])) {
    $pagina = $_REQUEST["pagina"];  // Si 'pagina' está presente, asignamos su valor.
} else {
    $pagina = 1;  // Si no está presente, asignamos la primera página como valor por defecto.
}

// Obtiene la conexión a la base de datos mediante la clase Utils.
$conPDO = Utils::conectar();

// Creamos una instancia de la clase Flor, que nos permitirá interactuar con los datos de las flores en la base de datos.
$gestorCategoria = new Categoria();

// Llamamos al método getFloresPag() de la clase Flor para obtener un conjunto de flores de la base de datos.
// Este método toma los siguientes parámetros: la conexión a la base de datos ($db), un valor booleano para indicar si se deben ordenar los resultados (true), el nombre del campo de ordenación ("id_flores"), el número de la página ($pagina) y la cantidad de elementos por página (10).
$categorias = $gestorCategoria->getCategoriasPag($conPDO, true, "id_categoria", $pagina, PHP_INT_MAX);
$categorias = array_reverse($categorias);
// Llamamos al método totalPaginas() de la clase Flor para obtener el número total de páginas disponibles según el número de elementos por página (10).
$totalPaginas = $gestorCategoria->totalPaginas($conPDO, PHP_INT_MAX)["Paginas"];  // Extraemos el valor 'Paginas' del resultado del método totalPaginas().


// En esta sección se podría incluir alguna depuración (comentada aquí), para comprobar los resultados de las flores obtenidas.
// var_dump($flores);
// echo "prueba";

// Finalmente, incluimos la vista "flores.php" para mostrar los datos en el navegador. 
// Esta vista probablemente mostrará las flores obtenidas y las opciones de navegación para paginarlas.

 include "../view/Categorias.php";
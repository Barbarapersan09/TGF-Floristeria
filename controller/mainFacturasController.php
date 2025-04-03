<?php

use \model\Factura;  // Importa la clase Factura desde el espacio de nombres "model", que maneja la lógica relacionada con las Facturaes.
use \model\Utils; // Importa la clase Utils desde el espacio de nombres "model", que contiene funciones auxiliares como la conexión a la base de datos y otras utilidades.

// Incluimos los archivos necesarios para el funcionamiento del código, que contienen las clases Factura y Utils.
require_once("../model/Factura.php");
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

// Creamos una instancia de la clase Factura, que nos permitirá interactuar con los datos de las Facturaes en la base de datos.
$gestorFacturas = new Factura();

// Llamamos al método getFacturaesPag() de la clase Factura para obtener un conjunto de Facturaes de la base de datos.
// Este método toma los siguientes parámetros: la conexión a la base de datos ($db), un valor booleano para indicar si se deben ordenar los resultados (true), el nombre del campo de ordenación ("id_Facturaes"), el número de la página ($pagina) y la cantidad de elementos por página (10).
$facturas = $gestorFacturas->getFacturasPag($conPDO, true, "id_factura", $pagina, PHP_INT_MAX);

// Llamamos al método totalPaginas() de la clase Factura para obtener el número total de páginas disponibles según el número de elementos por página (10).
$totalPaginas = $gestorFacturas->totalPaginas($conPDO, PHP_INT_MAX)["Paginas"];  // Extraemos el valor 'Paginas' del resultado del método totalPaginas().


// En esta sección se podría incluir alguna depuración (comentada aquí), para comprobar los resultados de las Facturaes obtenidas.
// var_dump($Facturaes);
// echo "prueba";

// Finalmente, incluimos la vista "Factura.php" para mostrar los datos en el navegador. 
// Esta vista mostrará las Factura obtenidas y las opciones de navegación para paginarlas.
include "../view/Facturas.php";

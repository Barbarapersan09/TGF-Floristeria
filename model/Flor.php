<?php

namespace model;

use \PDO; // Importa la clase PDO para interactuar con la base de datos
use \PDOException; // Importa la clase PDOException para manejar errores
require "Utils.php"; // Archivo necesario para la conexión con la base de datos

class Flor
{
    private $conPDO;

    // Constructor: inicializa la conexión a la base de datos
    public function __construct()
    {
        $this->conPDO = Utils::conectar(); // Conexión establecida utilizando una función en Utils.php
    }

    // Método para obtener todas las flores de la base de datos
    public function getFlores()
    {
        $consulta = "SELECT * FROM flores"; // Consulta SQL para obtener todas las flores
        $result = $this->conPDO->prepare($consulta); // Prepara la consulta
        $result->execute(); // Ejecuta la consulta
        return $result->fetchAll(PDO::FETCH_ASSOC); // Devuelve los resultados como un array asociativo
    }

   // Método público que permite obtener la información de una flor específica usando su ID
public function getFlorById($id_flor)
{
    // 1. Creamos una consulta SQL que selecciona:
    //    - Todos los campos de la tabla "flores" (por eso se usa "*")
    //    - El campo "nombre_categoria" de la tabla "categorias_flores"
    //    - Se hace un JOIN para unir ambas tablas a través de su relación (id_categoria)
    //    - El WHERE se asegura de que solo se muestre la flor que tiene el ID que le pasamos
    $consulta = "SELECT * , c.nombre_categoria 
        FROM flores f 
        JOIN categorias_flores c ON f.id_categoria = c.id_categoria
        WHERE id_flor=:id_flor";  // ":id_flor" es un marcador que luego sustituiremos por el valor real

    // 2. Usamos prepare() para preparar esa consulta antes de ejecutarla.
    //    Esto ayuda a evitar errores y protege contra ataques de inyección SQL.
    $result = $this->conPDO->prepare($consulta);

    // 3. Aquí le decimos a la consulta que el valor del marcador ":id_flor"
    //    será igual al valor que nos llega por el parámetro $id_flor
    $result->bindParam(":id_flor", $id_flor);

    // 4. Ejecutamos la consulta ya preparada y con el parámetro asignado
    $result->execute();

    // 5. Devolvemos el resultado como un array asociativo (clave => valor)
    //    Esto nos permite acceder fácilmente a cada dato de la flor por su nombre
    return $result->fetchAll(PDO::FETCH_ASSOC);

    // Nota: Aunque normalmente solo se devolverá una flor (porque el ID es único),
    //       usamos fetchAll() por si acaso en algún momento se quiere ampliar o reutilizar.
}


    // Método para agregar una nueva flor a la base de datos
    public function addFlor($flor)
    {
        $consulta = "INSERT INTO flores (nombre, descripcion, precio, url_imagen, color, ocasion, stock, fecha_creacion, id_categoria) 
                     VALUES (:nombre, :descripcion, :precio, :url_imagen, :color, :ocasion, :stock, :fecha_creacion, :id_categoria)";
        $result = $this->conPDO->prepare($consulta); // Prepara la consulta

        // Asocia cada valor de $flor a los parámetros de la consulta
        $result->bindParam(":nombre", $flor["nombre"]);
        $result->bindParam(":descripcion", $flor["descripcion"]);
        $result->bindParam(":precio", $flor["precio"]);
        $result->bindParam(":url_imagen", $flor["url_imagen"]);
        $result->bindParam(":color", $flor["color"]);
        $result->bindParam(":ocasion", $flor["ocasion"]);
        $result->bindParam(":stock", $flor["stock"]);
        $result->bindParam(":fecha_creacion", $flor["fecha_creacion"]);
        $result->bindParam(":id_categoria", $flor["id_categoria"]);

        return $result->execute(); // Ejecuta la consulta y devuelve el resultado
    }

    // Método para actualizar una flor existente
    public function updateFlor($flor)
    {
        $consulta = "UPDATE flores SET nombre=:nombre, descripcion=:descripcion, precio=:precio, url_imagen=:url_imagen,
                     color=:color, ocasion=:ocasion, stock=:stock, fecha_creacion=:fecha_creacion, id_categoria=:id_categoria 
                     WHERE id_flor=:id_flor";
        $result = $this->conPDO->prepare($consulta); // Prepara la consulta

        // Asocia los valores de $flor a los parámetros de la consulta
        $result->bindParam(":id_flor", $flor["id_flor"]);
        $result->bindParam(":nombre", $flor["nombre"]);
        $result->bindParam(":descripcion", $flor["descripcion"]);
        $result->bindParam(":precio", $flor["precio"]);
        $result->bindParam(":url_imagen", $flor["url_imagen"]);
        $result->bindParam(":color", $flor["color"]);
        $result->bindParam(":ocasion", $flor["ocasion"]);
        $result->bindParam(":stock", $flor["stock"]);
        $result->bindParam(":fecha_creacion", $flor["fecha_creacion"]);
        $result->bindParam(":id_categoria", $flor["id_categoria"]);

        return $result->execute(); // Ejecuta la consulta y devuelve el resultado
    }

    // Método para eliminar una flor por su ID
    public function deleteFlor($id_flor)
    {
        $consulta = "DELETE FROM flores WHERE id_flor=:id_flor"; // Consulta SQL para eliminar
        $result = $this->conPDO->prepare($consulta); // Prepara la consulta
        $result->bindParam(":id_flor", $id_flor); // Asocia el valor del ID al parámetro
        return $result->execute(); // Ejecuta la consulta y devuelve el resultado
    }

    // Método para obtener flores con paginación
    public function getFloresPag($conPDO, $ordAsc, string $campoOrd, int $numPag, int $cantElem)
    {
        if ($conPDO != null) {
            try {
                $query = "SELECT * FROM flores ORDER BY ? "; // Ordena por el campo especificado

                if (!$ordAsc) $query .= "DESC "; // Añade DESC si no es orden ascendente

                $query .= "LIMIT ? OFFSET ?"; // Agrega límite y desplazamiento para la paginación
                $sentencia = $conPDO->prepare($query);

                $sentencia->bindParam(1, $campoOrd);
                $sentencia->bindParam(2, $cantElem, PDO::PARAM_INT);
                $offset = ($numPag - 1) * $cantElem;
                $sentencia->bindParam(3, $offset, PDO::PARAM_INT);

                $sentencia->execute(); // Ejecuta la consulta
                return $sentencia->fetchAll(); // Devuelve los resultados
            } catch (PDOException $e) {
                print("Error al acceder a BD: " . $e->getMessage());
            }
        }
    }

    // Método para calcular el total de páginas basado en la cantidad de flores por página
    public function totalPaginas($conPDO, $cantidad)
    {
        if (isset($cantidad) && is_numeric($cantidad)) {
            if ($conPDO != null) {
                try {
                    $sentencia = $conPDO->prepare("SELECT CEIL(COUNT(*) / ?) AS Paginas FROM flores;");
                    $sentencia->bindParam(1, $cantidad);
                    $sentencia->execute(); // Ejecuta la consulta
                    return $sentencia->fetch(); // Devuelve el total de páginas
                } catch (PDOException $e) {
                    print("Error al acceder a BD: " . $e->getMessage());
                }
            }
        }
    }
}

<?php

namespace model;  // Define el espacio de nombres "model", utilizado para organizar el código.

use \PDO; // Clase PDO para manejar la conexión a la base de datos.
use \PDOException; // Clase para manejar excepciones relacionadas con PDO.

require "Utils.php"; // Incluye el archivo Utils.php, que contiene la función conectar() para la conexión a la base de datos.

class Categoria
{
    private $conPDO; // Propiedad privada que almacena la conexión PDO a la base de datos.

    // Constructor de la clase, que recibe un objeto PDO (conexion) y lo asigna a la propiedad $conPDO.
    public function __construct()
    {
        $this->conPDO = Utils::conectar(); // Establece la conexión con la base de datos utilizando la función conectar() del archivo Utils.php.
    }

    // Método para obtener todas las categorías de flores.
    public function getAllCategorias()
    {
        // Consulta SQL para obtener todos los registros de la tabla 'categorias_flores'.
        $sql = "SELECT * FROM categorias_flores";
        $stmt = $this->conPDO->prepare($sql); // Prepara la consulta SQL.
        $stmt->execute(); // Ejecuta la consulta preparada.
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Devuelve todos los resultados como un array asociativo.
    }

    // Método para obtener una categoría de flores específica por su ID.
    public function getCategoriaById($id_categoria)
    {
        // Consulta SQL para obtener una categoría filtrada por su ID.
        $sql = "SELECT * FROM categorias_flores WHERE id_categoria = :id_categoria";
        $stmt = $this->conPDO->prepare($sql); // Prepara la consulta SQL.
        $stmt->bindParam(':id_categoria', $id_categoria); // Vincula el parámetro de la consulta con el valor de $id_categoria.
        $stmt->execute(); // Ejecuta la consulta.
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Devuelve el resultado como un array asociativo.
    }

    // Método para agregar una nueva categoría de flores a la base de datos.
    public function addCategoria($categoria)
    {
        // Consulta SQL para insertar una nueva categoría de flores.
        $consulta = "INSERT INTO categorias_flores (nombre_categoria, descripcion) 
                     VALUES (:nombre_categoria, :descripcion)";
        $result = $this->conPDO->prepare($consulta); // Prepara la consulta SQL.

        // Asocia los valores del array $categoria con los parámetros de la consulta SQL.
        $result->bindParam(":nombre_categoria", $categoria["nombre_categoria"]);
        $result->bindParam(":descripcion", $categoria["descripcion"]);

        return $result->execute(); // Ejecuta la consulta e inserta la nueva categoría en la base de datos.
    }

    // Método para actualizar una categoría existente en la base de datos.
    public function updateCategoria($categoria)
    {
        // Consulta SQL para actualizar una categoría existente por su ID.
        $consulta = "UPDATE categorias_flores SET nombre_categoria=:nombre_categoria, descripcion=:descripcion 
                     WHERE id_categoria=:id_categoria";
        $result = $this->conPDO->prepare($consulta); // Prepara la consulta SQL.

        // Asocia los valores del array $categoria con los parámetros de la consulta SQL.
        $result->bindParam(":id_categoria", $categoria["id_categoria"]);
        $result->bindParam(":nombre_categoria", $categoria["nombre_categoria"]);
        $result->bindParam(":descripcion", $categoria["descripcion"]);

        return $result->execute(); // Ejecuta la consulta y actualiza la categoría en la base de datos.
    }

    // Método para eliminar una categoría de flores de la base de datos.
    public function deleteCategoria($categoria)
    {
        // Consulta SQL para eliminar una categoría de flores específica por su ID.
        $consulta = "DELETE FROM categorias_flores WHERE id_categoria=:id_categoria";
        $result = $this->conPDO->prepare($consulta); // Prepara la consulta SQL.

        // Asocia el parámetro de la consulta con el valor de $categoria.
        $result->bindParam(":id_categoria", $categoria);

        return $result->execute(); // Ejecuta la consulta y elimina la categoría de la base de datos.
    }

     // Método para obtener flores con paginación
     public function getCategoriasPag($conPDO, $ordAsc, string $campoOrd, int $numPag, int $cantElem)
     {
         if ($conPDO != null) {
             try {
                 $query = "SELECT * FROM categorias_flores ORDER BY ? "; // Ordena por el campo especificado
 
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
                     $sentencia = $conPDO->prepare("SELECT CEIL(COUNT(*) / ?) AS Paginas FROM categorias_flores;");
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

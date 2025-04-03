<?php

namespace model; // Define el namespace para organizar el código.
use \PDO; // Importa la clase PDO para manejar la conexión con la base de datos.
use \PDOException; // Importa la clase PDOException para manejar errores de base de datos.
require "Utils.php"; // Incluye el archivo Utils.php que contiene funciones auxiliares, como la conexión a la base de datos.

class Pago {
    private static $conPDO; // Propiedad que almacena la conexión a la base de datos.

    // Constructor: inicializa la conexión a la base de datos utilizando una función del archivo Utils.php.
    public function __construct() {
        self::$conPDO = Utils::conectar();
    }

    public static function iniciarConexion(){
        if(self::$conPDO=== null){
            self::$conPDO = Utils::conectar(); 
        }
    }
    // Obtiene todos los registros de la tabla 'pagos'.
    public function getPago() {
        $consulta = "SELECT * FROM pagos"; // Consulta para seleccionar todos los pagos.
        $result = self::$conPDO->prepare($consulta); // Prepara la consulta.
        $result->execute(); // Ejecuta la consulta.
        return $result->fetchAll(PDO::FETCH_ASSOC); // Devuelve todos los resultados como un arreglo asociativo.
    }

    // Obtiene un pago específico por su ID.
    public function getPagosById($id_pago) {
        $consulta = "SELECT * FROM pagos WHERE id_pago = :id_pago"; // Consulta con filtro por ID del pago.
        $result = self::$conPDO->prepare($consulta); // Prepara la consulta.
        $result->execute([":id_pago" => $id_pago]); // Ejecuta la consulta pasando el parámetro.
        return $result->fetchAll(PDO::FETCH_ASSOC); // Devuelve el resultado como un arreglo asociativo.
    }

    // Agrega un nuevo pago a la base de datos.
    public static function addPago($pago) {
        self::iniciarConexion();
        $consulta = "INSERT INTO pagos (id_pedido, id_usuario, metodo_pago, monto, estado_pago) 
                     VALUES (:id_pedido, :id_usuario, :metodo_pago, :monto,:estado_pago)"; // Consulta de inserción.
        $result = self::$conPDO->prepare($consulta); // Prepara la consulta.

        // Asocia los valores del arreglo $pago a los parámetros nombrados.
        $result->bindParam(":id_pedido", $pago["id_pedido"]);
        $result->bindParam(":id_usuario", $pago["id_usuario"]);
        $result->bindParam(":metodo_pago", $pago["metodo_pago"]);
        $result->bindParam(":monto", $pago["monto"]);
        $result->bindParam(":estado_pago", $pago["estado_pago"]);

        return $result->execute(); // Ejecuta la consulta y devuelve true si fue exitosa.
    }

    // Actualiza los datos de un pago existente.
    public function updatePago($pago) {
        $consulta = "UPDATE pagos 
                     SET id_pedido = :id_pedido, id_usuario = :id_usuario, metodo_pago = :metodo_pago, monto = :monto, 
                         fecha_pago = :fecha_pago, estado_pago = :estado_pago 
                     WHERE id_pago = :id_pago"; // Consulta de actualización.
        $result = self::$conPDO->prepare($consulta); // Prepara la consulta.

        // Asocia los valores del arreglo $pago a los parámetros nombrados.
        $result->bindParam(":id_pago", $pago["id_pago"]);
        $result->bindParam(":id_pedido", $pago["id_pedido"]);
        $result->bindParam(":id_usuario", $pago["id_usuario"]);
        $result->bindParam(":metodo_pago", $pago["metodo_pago"]);
        $result->bindParam(":monto", $pago["monto"]);
        $result->bindParam(":fecha_pago", $pago["fecha_pago"]);
        $result->bindParam(":estado_pago", $pago["estado_pago"]);

        return $result->execute(); // Ejecuta la consulta y devuelve true si fue exitosa.
    }

    // Elimina un pago por su ID.
    public function deletePago($id_pago) {
        $consulta = "DELETE FROM pagos WHERE id_pago = :id_pago"; // Consulta de eliminación.
        $result = self::$conPDO->prepare($consulta); // Prepara la consulta.
        $result->bindParam(":id_pago", $id_pago); // Asocia el valor del parámetro.
        return $result->execute(); // Ejecuta la consulta y devuelve true si fue exitosa.
    }

     // Método para obtener flores con paginación
     public function getPagoPag($conPDO, $ordAsc, string $campoOrd, int $numPag, int $cantElem)
     {
         if ($conPDO != null) {
             try {
                 $query = "SELECT * FROM pagos ORDER BY ? "; // Ordena por el campo especificado
 
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
                     $sentencia = $conPDO->prepare("SELECT CEIL(COUNT(*) / ?) AS Paginas FROM pagos;");
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

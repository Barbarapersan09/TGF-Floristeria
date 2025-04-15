<?php

namespace model;  // Define el espacio de nombres "model", utilizado para organizar el código.

use \PDO; // Clase PDO para manejar la conexión a la base de datos.
use \PDOException; // Clase para manejar excepciones relacionadas con PDO.

require "Utils.php"; // Incluye el archivo Utils.php, donde probablemente se encuentra la función para la conexión a la base de datos.

class Envio
{
    private $conPDO; // Propiedad privada que almacenará la conexión PDO.

    // Constructor de la clase, se ejecuta cuando se crea una nueva instancia de Envio.
    // Inicializa la conexión a la base de datos usando la función conectar de la clase Utils.
    public function __construct()
    {
        $this->conPDO = Utils::conectar(); // Establece la conexión a la base de datos.
    }

    // Método para obtener todos los registros de la tabla 'envios'.
    public function getEnvio()
    {
        // Consulta SQL para obtener todos los envíos.
        $consulta = "SELECT * FROM envios";
        $result = $this->conPDO->prepare($consulta); // Prepara la consulta SQL.
        $result->execute(); // Ejecuta la consulta preparada.
        return $result->fetchAll(PDO::FETCH_ASSOC); // Devuelve todos los resultados en formato de array asociativo.
    }

    // Método para obtener un envío específico por su ID.
    public function getEnviosById($id_envio)
    {
        // Consulta SQL para obtener un solo envío filtrado por el ID.
        $consulta = "SELECT * FROM envios WHERE id_envio=:id_envio";
        $result = $this->conPDO->prepare($consulta); // Prepara la consulta SQL.
        $result->execute([":id_envio" => $id_envio]); // Ejecuta la consulta pasando el parámetro de ID de envío.
        return $result->fetchAll(PDO::FETCH_ASSOC); // Devuelve el resultado como un array asociativo.
    }

    // Método para agregar un nuevo envío a la base de datos.
    public function addEnvio($envio)
    {
        // Consulta SQL para insertar un nuevo envío en la tabla 'envios'.
        $consulta = "INSERT INTO envios (id_pedido, direccion_envio, estado_envio) 
                     VALUES (:id_pedido, :direccion_envio, :estado_envio)";
        $result = $this->conPDO->prepare($consulta); // Prepara la consulta SQL.

        // Asocia los parámetros de la consulta con los valores del array $envio.
        $result->bindParam(":id_pedido", $envio["id_pedido"]);
        $result->bindParam(":direccion_envio", $envio["direccion_envio"]);
        $result->bindParam(":estado_envio", $envio["estado_envio"]);

        return $result->execute(); // Ejecuta la consulta e inserta los datos en la base de datos.
    }

    // Método para actualizar un envío existente en la base de datos.
    public function updateEnvio($envio)
    {
        // Consulta SQL para actualizar un envío con nuevos datos.
        $consulta = "UPDATE envios SET id_pedido=:id_pedido, direccion_envio=:direccion_envio, fecha_envio=:fecha_envio,
                     estado_envio=:estado_envio WHERE id_envio=:id_envio";
        $result = $this->conPDO->prepare($consulta); // Prepara la consulta SQL.

        // Asocia los parámetros de la consulta con los valores del array $envio.
        $result->bindParam(":id_envio", $envio["id_envio"]);
        $result->bindParam(":id_pedido", $envio["id_pedido"]);
        $result->bindParam(":direccion_envio", $envio["direccion_envio"]);
        $result->bindParam(":fecha_envio", $envio["fecha_envio"]);
        $result->bindParam(":estado_envio", $envio["estado_envio"]);

        return $result->execute(); // Ejecuta la consulta y actualiza el registro en la base de datos.
    }

    // Método para eliminar un envío de la base de datos por su ID.
    public function deleteEnvio($id_envio)
    {
        // Consulta SQL para eliminar un envío específico por su ID.
        $consulta = "DELETE FROM envios WHERE id_envio=:id_envio";
        $result = $this->conPDO->prepare($consulta); // Prepara la consulta SQL.

        // Asocia el parámetro de la consulta con el ID del envío.
        $result->bindParam(":id_envio", $id_envio);

        return $result->execute(); // Ejecuta la consulta y elimina el registro de la base de datos.
    }

    // Método para obtener flores con paginación
    public function getEnviosPag($conPDO, $ordAsc, string $campoOrd, int $numPag, int $cantElem)
    {
        if ($conPDO != null) {
            try {
                $query = "SELECT * FROM envios ORDER BY ? "; // Ordena por el campo especificado

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
                    $sentencia = $conPDO->prepare("SELECT CEIL(COUNT(*) / ?) AS Paginas FROM envios;");
                    $sentencia->bindParam(1, $cantidad);
                    $sentencia->execute(); // Ejecuta la consulta
                    return $sentencia->fetch(); // Devuelve el total de páginas
                } catch (PDOException $e) {
                    print("Error al acceder a BD: " . $e->getMessage());
                }
            }
        }
    }
    public function obtenerPedidosCompletados(){
        try {
            $sql = $this->conPDO->prepare('SELECT p.* FROM pedidos p
            LEFT JOIN envios e on p.id_pedido= e.id_pedido 
            WHERE p.estado_pedido = "Pendiente" AND e.id_pedido IS NULL;');
            $sql->execute();
            return $sql->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            print("Error al acceder a BD: " . $e->getMessage());
        }
    }
}

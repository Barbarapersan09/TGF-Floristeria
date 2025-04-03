<?php

namespace model;

use \PDO; // Se utiliza para manejar la conexión a la base de datos
use \PDOException; // Maneja errores relacionados con PDO

require "Utils.php"; // Incluye el archivo que contiene funciones auxiliares, como la conexión

class Factura
{
    private $conPDO;

    // Constructor que inicializa la conexión a la base de datos
    public function __construct()
    {
        $this->conPDO = Utils::conectar(); // Establece la conexión mediante una función en Utils.php
    }

    // Método para obtener todas las facturas
    public function getFactura()
    {
        $consulta = "SELECT * FROM facturas"; // Consulta SQL para obtener todas las facturas
        $result = $this->conPDO->prepare($consulta); // Prepara la consulta
        $result->execute(); // Ejecuta la consulta
        return $result->fetchAll(PDO::FETCH_ASSOC); // Devuelve los resultados como un array asociativo
    }

    // Método para obtener una factura específica por su ID
    public function getFacturaById($id_facturas)
    {
        $consulta = "SELECT * FROM facturas WHERE id_factura=:id_factura"; // Consulta SQL con un parámetro
        $result = $this->conPDO->prepare($consulta); // Prepara la consulta
        $result->execute([":id_factura" => $id_facturas]); // Ejecuta la consulta pasando el ID como parámetro
        return $result->fetchAll(PDO::FETCH_ASSOC); // Devuelve el resultado
    }

    // Método para agregar una nueva factura
    public function addFactura($factura)
    {
        $consulta = "INSERT INTO facturas (id_pedido, monto_total) 
                     VALUES (:id_pedido, :monto_total)";
        $result = $this->conPDO->prepare($consulta); // Prepara la consulta

        // Asocia los valores de $factura a los parámetros de la consulta
        $result->bindParam(":id_pedido", $factura["id_pedido"]);
        $result->bindParam(":monto_total", $factura["monto_total"]);

        return $result->execute(); // Ejecuta la consulta y devuelve el resultado (true o false)
    }

    // Método para actualizar una factura existente
    public function updateFacturas($factura)
    {
        $consulta = "UPDATE facturas SET id_pedido=:id_pedido, fecha_factura=:fecha_factura, monto_total=:monto_total 
                     WHERE id_factura=:id_factura";
        $result = $this->conPDO->prepare($consulta); // Prepara la consulta

        // Asocia los valores de $factura a los parámetros de la consulta
        $result->bindParam(":id_factura", $factura["id_factura"]);
        $result->bindParam(":id_pedido", $factura["id_pedido"]);
        $result->bindParam(":fecha_factura", $factura["fecha_factura"]);
        $result->bindParam(":monto_total", $factura["monto_total"]);

        return $result->execute(); // Ejecuta la consulta y devuelve el resultado
    }

    // Método para eliminar una factura por su ID
    public function deleteFacturas($id_facturas)
    {
        $consulta = "DELETE FROM facturas WHERE id_factura=:id_factura"; // Consulta SQL para eliminar
        $result = $this->conPDO->prepare($consulta); // Prepara la consulta
        $result->bindParam(":id_factura", $id_facturas); // Asocia el valor del ID al parámetro
        return $result->execute(); // Ejecuta la consulta y devuelve el resultado
    }

    // Método para obtener flores con paginación
    public function getFacturasPag($conPDO, $ordAsc, string $campoOrd, int $numPag, int $cantElem)
    {
        if ($conPDO != null) {
            try {
                $query = "SELECT * FROM facturas ORDER BY ? "; // Ordena por el campo especificado

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
                    $sentencia = $conPDO->prepare("SELECT CEIL(COUNT(*) / ?) AS Paginas FROM facturas;");
                    $sentencia->bindParam(1, $cantidad);
                    $sentencia->execute(); // Ejecuta la consulta
                    return $sentencia->fetch(); // Devuelve el total de páginas
                } catch (PDOException $e) {
                    print("Error al acceder a BD: " . $e->getMessage());
                }
            }
        }
    }

    public function obtenerPedidosCompletados()
    {
        try {
            $sql = $this->conPDO->prepare('SELECT p.* FROM pedidos p
            LEFT JOIN facturas f on p.id_pedido= f.id_pedido 
            WHERE p.estado_pedido = "Completado" AND f.id_pedido IS NULL;');
            $sql->execute();
            return $sql->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            print("Error al acceder a BD: " . $e->getMessage());
        }
    }
}

<?php

namespace model; // Define el namespace para organizar el código.
use \PDO; // Importa la clase PDO para manejar la conexión con la base de datos.
use \PDOException; // Importa la clase PDOException para manejar errores de base de datos.

require "Utils.php"; // Incluye el archivo Utils.php que contiene funciones auxiliares, como la conexión a la base de datos.

class Pedido
{
    private $conPDO; // Propiedad para almacenar la conexión PDO.

    // Constructor: inicializa la conexión a la base de datos utilizando la función Utils::conectar().
    public function __construct()
    {
        $this->conPDO = Utils::conectar();
    }

    // Obtiene todos los pedidos almacenados en la tabla 'pedidos'.
    public function getPedidos()
    {
        $sql = "SELECT * FROM pedidos"; // Consulta para seleccionar todos los pedidos.
        $stmt = $this->conPDO->prepare($sql); // Prepara la consulta.

        $stmt->execute(); // Ejecuta la consulta.
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Devuelve los resultados como un arreglo asociativo.
    }

    // Crea un nuevo pedido con los datos proporcionados.
    public function createPedido($id_usuario, $monto_total, $estado_pedido, $metodo_pago)
    {
        $sql = "INSERT INTO pedidos (id_usuario, monto_total, estado_pedido, metodo_pago) 
                VALUES (:id_usuario, :monto_total, :estado_pedido, :metodo_pago)"; // Consulta de inserción.
        $stmt = $this->conPDO->prepare($sql); // Prepara la consulta.

        // Asocia los valores a los parámetros nombrados en la consulta.
        $stmt->bindParam(':id_usuario', $id_usuario);
        $stmt->bindParam(':monto_total', $monto_total);
        $stmt->bindParam(':estado_pedido', $estado_pedido);
        $stmt->bindParam(':metodo_pago', $metodo_pago);

        if($stmt->execute()){
            return $this->conPDO->lastInsertId();
        }else{
            return false;
        }
    }

    // Obtiene todos los pedidos de un usuario específico.
    public function getPedidosByUsuario($id_usuario)
    {
        $sql = "SELECT * FROM pedidos WHERE id_usuario = :id_usuario"; // Consulta con filtro por usuario.
        $stmt = $this->conPDO->prepare($sql); // Prepara la consulta.

        $stmt->bindParam(':id_usuario', $id_usuario); // Asocia el valor del parámetro.
        $stmt->execute(); // Ejecuta la consulta.
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Devuelve los resultados como un arreglo asociativo.
    }

    // Obtiene un pedido específico por su ID.
    public function getPedidoById($id_pedido)
    {
        $sql = "SELECT * FROM pedidos WHERE id_pedido = :id_pedido"; // Consulta con filtro por ID del pedido.
        $stmt = $this->conPDO->prepare($sql); // Prepara la consulta.

        $stmt->bindParam(':id_pedido', $id_pedido); // Asocia el valor del parámetro.
        $stmt->execute(); // Ejecuta la consulta.
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Devuelve los resultados como un arreglo asociativo.
    }

    // Actualiza los datos de un pedido existente.
    public function updatePedido($pedido)
    {
        $id_pedido = $pedido["id_pedido"];
        $id_usuario = $pedido["id_usuario"];
        $monto_total = $pedido["monto_total"];
        $estado_pedido = $pedido["estado_pedido"];

        $sql = "UPDATE pedidos 
                SET id_usuario = :id_usuario, monto_total = :monto_total, estado_pedido = :estado_pedido
                WHERE id_pedido = :id_pedido"; // Consulta de actualización.
        $stmt = $this->conPDO->prepare($sql); // Prepara la consulta.

        // Asocia los valores a los parámetros nombrados en la consulta.
        $stmt->bindParam(':id_pedido', $id_pedido);
        $stmt->bindParam(':id_usuario', $id_usuario);
        $stmt->bindParam(':monto_total', $monto_total);
        $stmt->bindParam(':estado_pedido', $estado_pedido);
        

        return $stmt->execute(); // Ejecuta la consulta y devuelve true si fue exitosa.
    }

    // Elimina un pedido por su ID.
    public function deletePedido($id_pedido)
    {
        $this->conPDO->beginTransaction();
        $tablasRelacionadas = [
            "detalles_pedido",
            "pagos",
            "facturas",
            "envios"
        ];
        foreach ($tablasRelacionadas as $tabla) {
            $sql = "DELETE FROM $tabla WHERE id_pedido = :id_pedido"; // Consulta de eliminación.
            $stmt = $this->conPDO->prepare($sql); // Prepara la consulta.
            $stmt->bindParam(':id_pedido', $id_pedido); // Asocia el valor del parámetro.
            $stmt->execute(); // Ejecuta la consulta y devuelve true si fue exitosa.
        }
        $sql = "DELETE FROM pedidos WHERE id_pedido = :id_pedido"; // Consulta de eliminación.
        $stmt = $this->conPDO->prepare($sql); // Prepara la consulta.
        $stmt->bindParam(':id_pedido', $id_pedido); // Asocia el valor del parámetro.
        $stmt->execute(); // Ejecuta la consulta y devuelve true si fue exitosa.
        $this->conPDO->commit();
        return true;
    }

    // Método para obtener flores con paginación
    public function getPedidosPag($conPDO, $ordAsc, string $campoOrd, int $numPag, int $cantElem)
    {
        if ($conPDO != null) {
            try {
                $query = "SELECT * FROM pedidos ORDER BY ? "; // Ordena por el campo especificado

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
                    $sentencia = $conPDO->prepare("SELECT CEIL(COUNT(*) / ?) AS Paginas FROM pedidos;");
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

<?php

namespace model;  // Define el espacio de nombres "model", utilizado para organizar el código.

use \PDO; // Clase PDO para manejar la conexión a la base de datos.
use \PDOException; // Clase para manejar excepciones relacionadas con PDO.

require "Utils.php"; // Incluye el archivo Utils.php, que contiene la función conectar() para la conexión a la base de datos.

class DetallePedido
{
    private $conPDO; // Propiedad privada que almacena la conexión PDO a la base de datos.

    // Constructor de la clase, se ejecuta al crear una nueva instancia de DetallePedido.
    // Establece la conexión a la base de datos mediante la función conectar() de la clase Utils.
    public function __construct()
    {
        $this->conPDO = Utils::conectar(); // Establece la conexión con la base de datos utilizando la función conectar() del archivo Utils.php.
    }

    // Método para obtener todos los detalles de pedidos.
    public function getDetallePedido()
    {
        // Consulta SQL para obtener todos los registros de la tabla 'detalles_pedido'.
        $consulta = "SELECT * FROM detalles_pedido";
        $result = $this->conPDO->prepare($consulta); // Prepara la consulta SQL.
        $result->execute(); // Ejecuta la consulta preparada.
        return $result->fetchAll(PDO::FETCH_ASSOC); // Devuelve todos los resultados como un array asociativo.
    }

    // Método para obtener un detalle de pedido específico por su ID.
    public function getDetallePedidoById($id_detalle_pedido)
    {
        // Consulta SQL para obtener un detalle de pedido filtrado por su ID.
        $consulta = "SELECT * FROM detalles_pedido WHERE id_detalle_pedido=:id_detalle_pedido";
        $result = $this->conPDO->prepare($consulta); // Prepara la consulta SQL.
        $result->execute([":id_detalle_pedido" => $id_detalle_pedido]); // Ejecuta la consulta pasando el ID como parámetro.
        return $result->fetchAll(PDO::FETCH_ASSOC); // Devuelve el resultado como un array asociativo.
    }

    // Método para agregar un nuevo detalle de pedido a la base de datos.
    public function addDetallePedido($detalle)
    {
        // Consulta SQL para insertar un nuevo detalle de pedido.
        $consulta = "INSERT INTO detalles_pedido (id_pedido, id_flor, cantidad, precio) 
                     VALUES (:id_pedido, :id_flor, :cantidad, :precio)";
        $result = $this->conPDO->prepare($consulta); // Prepara la consulta SQL.

        // Asocia los valores del array $detalle con los parámetros de la consulta SQL.
        $result->bindParam(":id_pedido", $detalle["id_pedido"]);
        $result->bindParam(":id_flor", $detalle["id_flor"]);
        $result->bindParam(":cantidad", $detalle["cantidad"]);
        $result->bindParam(":precio", $detalle["precio"]);

        return $result->execute(); // Ejecuta la consulta e inserta el nuevo detalle de pedido en la base de datos.
    }

    // Método para actualizar un detalle de pedido existente.
    public function updateDetallePedido($detalle)
    {
        // Consulta SQL para actualizar un detalle de pedido con nuevos valores.
        $consulta = "UPDATE detalles_pedido SET id_pedido=:id_pedido, id_flor=:id_flor, cantidad=:cantidad, 
                     precio=:precio WHERE id_detalle_pedido=:id_detalle_pedido";
        $result = $this->conPDO->prepare($consulta); // Prepara la consulta SQL.

        // Asocia los valores del array $detalle con los parámetros de la consulta SQL.
        $result->bindParam(":id_detalle_pedido", $detalle["id_detalle_pedido"]);
        $result->bindParam(":id_pedido", $detalle["id_pedido"]);
        $result->bindParam(":id_flor", $detalle["id_flor"]);
        $result->bindParam(":cantidad", $detalle["cantidad"]);
        $result->bindParam(":precio", $detalle["precio"]);

        return $result->execute(); // Ejecuta la consulta y actualiza el registro de detalle de pedido en la base de datos.
    }

    // Método para eliminar un detalle de pedido de la base de datos por su ID.
    public function deleteDetallePedido($id_detalle_pedido)
    {
        // Consulta SQL para eliminar un detalle de pedido específico por su ID.
        $consulta = "DELETE FROM detalles_pedido WHERE id_detalle_pedido=:id_detalle_pedido";
        $result = $this->conPDO->prepare($consulta); // Prepara la consulta SQL.

        // Asocia el parámetro de la consulta con el ID del detalle de pedido.
        $result->bindParam(":id_detalle_pedido", $id_detalle_pedido);

        return $result->execute(); // Ejecuta la consulta y elimina el detalle de pedido de la base de datos.
    }

     // Método para obtener flores con paginación
     public function getDetallePag($conPDO, $ordAsc, string $campoOrd, int $numPag, int $cantElem)
     {
         if ($conPDO != null) {
             try {
                 $query = "SELECT * FROM detalles_pedido ORDER BY ? "; // Ordena por el campo especificado
 
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
                     $sentencia = $conPDO->prepare("SELECT CEIL(COUNT(*) / ?) AS Paginas FROM detalles_pedido;");
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
<?php

namespace model;  // Define el espacio de nombres "model", utilizado para organizar el código.

use \PDO; // Clase PDO para manejar la conexión a la base de datos.
use \PDOException; // Clase para manejar excepciones relacionadas con PDO.

require "Utils.php"; // Incluye el archivo Utils.php, que contiene la función conectar() para la conexión a la base de datos.

class DetallePedido
{
    private $conPDO; // Propiedad privada que almacena la conexión PDO a la base de datos.

    // Constructor de la clase, se ejecuta al crear una nueva instancia de DetallePedido.
    // Establece la conexión a la base de datos mediante la función conectar() de la clase Utils.
    public function __construct()
    {
        $this->conPDO = Utils::conectar(); // Establece la conexión con la base de datos utilizando la función conectar() del archivo Utils.php.
    }

    // Método para obtener todos los detalles de pedidos.
    public function getDetallePedido()
    {
        // Consulta SQL para obtener todos los registros de la tabla 'detalles_pedido'.
        $consulta = "SELECT * FROM detalles_pedido";
        $result = $this->conPDO->prepare($consulta); // Prepara la consulta SQL.
        $result->execute(); // Ejecuta la consulta preparada.
        return $result->fetchAll(PDO::FETCH_ASSOC); // Devuelve todos los resultados como un array asociativo.
    }

    // Método para obtener un detalle de pedido específico por su ID.
    public function getDetallePedidoById($id_detalle_pedido)
    {
        // Consulta SQL para obtener un detalle de pedido filtrado por su ID.
        $consulta = "SELECT * FROM detalles_pedido WHERE id_detalle_pedido=:id_detalle_pedido";
        $result = $this->conPDO->prepare($consulta); // Prepara la consulta SQL.
        $result->execute([":id_detalle_pedido" => $id_detalle_pedido]); // Ejecuta la consulta pasando el ID como parámetro.
        return $result->fetchAll(PDO::FETCH_ASSOC); // Devuelve el resultado como un array asociativo.
    }

    // Método para agregar un nuevo detalle de pedido a la base de datos.
    public function addDetallePedido($detalle)
    {
        // Consulta SQL para insertar un nuevo detalle de pedido.
        $consulta = "INSERT INTO detalles_pedido (id_pedido, id_flor, cantidad, precio) 
                     VALUES (:id_pedido, :id_flor, :cantidad, :precio)";
        $result = $this->conPDO->prepare($consulta); // Prepara la consulta SQL.

        // Asocia los valores del array $detalle con los parámetros de la consulta SQL.
        $result->bindParam(":id_pedido", $detalle["id_pedido"]);
        $result->bindParam(":id_flor", $detalle["id_flor"]);
        $result->bindParam(":cantidad", $detalle["cantidad"]);
        $result->bindParam(":precio", $detalle["precio"]);

        return $result->execute(); // Ejecuta la consulta e inserta el nuevo detalle de pedido en la base de datos.
    }

    // Método para actualizar un detalle de pedido existente.
    public function updateDetallePedido($detalle)
    {
        // Consulta SQL para actualizar un detalle de pedido con nuevos valores.
        $consulta = "UPDATE detalles_pedido SET id_pedido=:id_pedido, id_flor=:id_flor, cantidad=:cantidad, 
                     precio=:precio WHERE id_detalle_pedido=:id_detalle_pedido";
        $result = $this->conPDO->prepare($consulta); // Prepara la consulta SQL.

        // Asocia los valores del array $detalle con los parámetros de la consulta SQL.
        $result->bindParam(":id_detalle_pedido", $detalle["id_detalle_pedido"]);
        $result->bindParam(":id_pedido", $detalle["id_pedido"]);
        $result->bindParam(":id_flor", $detalle["id_flor"]);
        $result->bindParam(":cantidad", $detalle["cantidad"]);
        $result->bindParam(":precio", $detalle["precio"]);

        return $result->execute(); // Ejecuta la consulta y actualiza el registro de detalle de pedido en la base de datos.
    }

    // Método para eliminar un detalle de pedido de la base de datos por su ID.
    public function deleteDetallePedido($id_detalle_pedido)
    {
        // Consulta SQL para eliminar un detalle de pedido específico por su ID.
        $consulta = "DELETE FROM detalles_pedido WHERE id_detalle_pedido=:id_detalle_pedido";
        $result = $this->conPDO->prepare($consulta); // Prepara la consulta SQL.

        // Asocia el parámetro de la consulta con el ID del detalle de pedido.
        $result->bindParam(":id_detalle_pedido", $id_detalle_pedido);

        return $result->execute(); // Ejecuta la consulta y elimina el detalle de pedido de la base de datos.
    }

     // Método para obtener flores con paginación
     public function getDetallePag($conPDO, $ordAsc, string $campoOrd, int $numPag, int $cantElem)
     {
         if ($conPDO != null) {
             try {
                 $query = "SELECT * FROM detalles_pedido ORDER BY ? "; // Ordena por el campo especificado
 
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
                     $sentencia = $conPDO->prepare("SELECT CEIL(COUNT(*) / ?) AS Paginas FROM detalles_pedido;");
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
<?php

namespace model;  // Define el espacio de nombres "model", utilizado para organizar el código.

use \PDO; // Clase PDO para manejar la conexión a la base de datos.
use \PDOException; // Clase para manejar excepciones relacionadas con PDO.

require "Utils.php"; // Incluye el archivo Utils.php, que contiene la función conectar() para la conexión a la base de datos.

class DetallePedido
{
    private $conPDO; // Propiedad privada que almacena la conexión PDO a la base de datos.

    // Constructor de la clase, se ejecuta al crear una nueva instancia de DetallePedido.
    // Establece la conexión a la base de datos mediante la función conectar() de la clase Utils.
    public function __construct()
    {
        $this->conPDO = Utils::conectar(); // Establece la conexión con la base de datos utilizando la función conectar() del archivo Utils.php.
    }

    // Método para obtener todos los detalles de pedidos.
    public function getDetallePedido()
    {
        // Consulta SQL para obtener todos los registros de la tabla 'detalles_pedido'.
        $consulta = "SELECT * FROM detalles_pedido";
        $result = $this->conPDO->prepare($consulta); // Prepara la consulta SQL.
        $result->execute(); // Ejecuta la consulta preparada.
        return $result->fetchAll(PDO::FETCH_ASSOC); // Devuelve todos los resultados como un array asociativo.
    }

    // Método para obtener un detalle de pedido específico por su ID.
    public function getDetallePedidoById($id_detalle_pedido)
    {
        // Consulta SQL para obtener un detalle de pedido filtrado por su ID.
        $consulta = "SELECT * FROM detalles_pedido WHERE id_detalle_pedido=:id_detalle_pedido";
        $result = $this->conPDO->prepare($consulta); // Prepara la consulta SQL.
        $result->execute([":id_detalle_pedido" => $id_detalle_pedido]); // Ejecuta la consulta pasando el ID como parámetro.
        return $result->fetchAll(PDO::FETCH_ASSOC); // Devuelve el resultado como un array asociativo.
    }

    // Método para agregar un nuevo detalle de pedido a la base de datos.
    public function addDetallePedido($detalle)
    {
        // Consulta SQL para insertar un nuevo detalle de pedido.
        $consulta = "INSERT INTO detalles_pedido (id_pedido, id_flor, cantidad, precio) 
                     VALUES (:id_pedido, :id_flor, :cantidad, :precio)";
        $result = $this->conPDO->prepare($consulta); // Prepara la consulta SQL.

        // Asocia los valores del array $detalle con los parámetros de la consulta SQL.
        $result->bindParam(":id_pedido", $detalle["id_pedido"]);
        $result->bindParam(":id_flor", $detalle["id_flor"]);
        $result->bindParam(":cantidad", $detalle["cantidad"]);
        $result->bindParam(":precio", $detalle["precio"]);

        return $result->execute(); // Ejecuta la consulta e inserta el nuevo detalle de pedido en la base de datos.
    }

    // Método para actualizar un detalle de pedido existente.
    public function updateDetallePedido($detalle)
    {
        // Consulta SQL para actualizar un detalle de pedido con nuevos valores.
        $consulta = "UPDATE detalles_pedido SET id_pedido=:id_pedido, id_flor=:id_flor, cantidad=:cantidad, 
                     precio=:precio WHERE id_detalle_pedido=:id_detalle_pedido";
        $result = $this->conPDO->prepare($consulta); // Prepara la consulta SQL.

        // Asocia los valores del array $detalle con los parámetros de la consulta SQL.
        $result->bindParam(":id_detalle_pedido", $detalle["id_detalle_pedido"]);
        $result->bindParam(":id_pedido", $detalle["id_pedido"]);
        $result->bindParam(":id_flor", $detalle["id_flor"]);
        $result->bindParam(":cantidad", $detalle["cantidad"]);
        $result->bindParam(":precio", $detalle["precio"]);

        return $result->execute(); // Ejecuta la consulta y actualiza el registro de detalle de pedido en la base de datos.
    }

    // Método para eliminar un detalle de pedido de la base de datos por su ID.
    public function deleteDetallePedido($id_detalle_pedido)
    {
        // Consulta SQL para eliminar un detalle de pedido específico por su ID.
        $consulta = "DELETE FROM detalles_pedido WHERE id_detalle_pedido=:id_detalle_pedido";
        $result = $this->conPDO->prepare($consulta); // Prepara la consulta SQL.

        // Asocia el parámetro de la consulta con el ID del detalle de pedido.
        $result->bindParam(":id_detalle_pedido", $id_detalle_pedido);

        return $result->execute(); // Ejecuta la consulta y elimina el detalle de pedido de la base de datos.
    }

     // Método para obtener flores con paginación
     public function getDetallePag($conPDO, $ordAsc, string $campoOrd, int $numPag, int $cantElem)
     {
         if ($conPDO != null) {
             try {
                 $query = "SELECT * FROM detalles_pedido ORDER BY ? "; // Ordena por el campo especificado
 
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
                     $sentencia = $conPDO->prepare("SELECT CEIL(COUNT(*) / ?) AS Paginas FROM detalles_pedido;");
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

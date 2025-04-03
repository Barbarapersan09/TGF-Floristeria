<?php

namespace model; // Define el namespace para organizar el código.
use \PDO; // Importa la clase PDO para manejar la conexión con la base de datos.
use \PDOException; // Importa la clase PDOException para manejar errores de la base de datos.

require_once "../model/Utils.php";

class Usuario
{
    private $conPDO; // Propiedad que almacenará la conexión a la base de datos.

    // Constructor: inicializa la conexión a la base de datos utilizando una función del archivo Utils.php.
    public function __construct()
    {
        $this->conPDO = Utils::conectar();
    }

    // Obtiene todos los registros de la tabla 'usuarios'.
    public function getUsuario()
    {
        $consulta = "SELECT * FROM usuario"; // Consulta para seleccionar todos los registros.
        $result = $this->conPDO->prepare($consulta); // Prepara la consulta para su ejecución.
        $result->execute(); // Ejecuta la consulta.
        return $result->fetchAll(PDO::FETCH_ASSOC); // Retorna todos los resultados como un arreglo asociativo.
    }

    // Obtiene un registro específico por ID.
    public function getUsuarioById($id_usuario)
    {
        $consulta = "SELECT * FROM usuarios WHERE id_usuario = :id_usuario"; // Consulta con parámetro nombrado.
        $result = $this->conPDO->prepare($consulta); // Prepara la consulta.
        $result->execute([":id_usuario" => $id_usuario]); // Ejecuta la consulta pasando el parámetro.
        return $result->fetch(PDO::FETCH_ASSOC); // Retorna el resultado como un arreglo asociativo.
    }

    // Obtiene un registro específico por correo electrónico.
    public function getUsuarioByEmail($email)
    {
        $consulta = "SELECT * FROM usuarios WHERE email = :email"; // Consulta con parámetro nombrado.
        $result = $this->conPDO->prepare($consulta); // Prepara la consulta.
        $result->execute([":email" => $email]); // Ejecuta la consulta pasando el parámetro.
        return $result->fetch(PDO::FETCH_ASSOC); // Retorna el resultado como un arreglo asociativo.
    }

    // Agrega un nuevo usuario a la base de datos.
    public function addUsuario($usuario)
    {
        $consulta = "INSERT INTO usuarios(nombre, apellido, email, password, hash, activo) 
                     VALUES (:nombre, :apellido, :email, :password, :hash, :activo)"; // Consulta de inserción.
        $result = $this->conPDO->prepare($consulta); // Prepara la consulta.

        // Asocia los valores del arreglo $usuario a los parámetros nombrados.
        $result->bindParam(":nombre", $usuario["nombre"]);
        $result->bindParam(":apellido", $usuario["apellido"]);
        $result->bindParam(":email", $usuario["email"]);
        $result->bindParam(":password", $usuario["password"]);
        $result->bindParam(":hash", $usuario["hash"]);
        $result->bindParam(":activo", $usuario["activo"]);

        return $result->execute(); // Ejecuta la consulta y retorna true si fue exitosa.
    }

    // Actualiza los datos de un usuario existente.
    public function updateUsuario($usuario)
    {
        $consulta = "UPDATE usuarios 
                     SET nombre = :nombre, apellido = :apellido, email = :email
                     WHERE id_usuario = :id_usuario"; // Consulta de actualización.
        $result = $this->conPDO->prepare($consulta); // Prepara la consulta.

        // Asocia los valores del arreglo $usuario a los parámetros nombrados.
        $result->bindParam(":id_usuario", $usuario["id_usuario"]);
        $result->bindParam(":nombre", $usuario["nombre"]);
        $result->bindParam(":apellido", $usuario["apellido"]);
        $result->bindParam(":email", $usuario["email"]);
        

        return $result->execute(); // Ejecuta la consulta y retorna true si fue exitosa.
    }

    // Elimina un usuario de la base de datos por su ID
    public function deleteUsuario($id_usuario)
    {
        $consulta = "DELETE FROM usuarios WHERE id_usuario = :id_usuario"; // Consulta de eliminación.
        $result = $this->conPDO->prepare($consulta); // Prepara la consulta.

        // Asocia el valor del parámetro $id_usuario.
        $result->bindParam(":id_usuario", $id_usuario);
        return $result->execute(); // Ejecuta la consulta y retorna true si fue exitosa.
    }

    // Método para obtener flores con paginación
    public function getUsuariosPag($conPDO, $ordAsc, string $campoOrd, int $numPag, int $cantElem)
    {
        if ($conPDO != null) {
            try {
                $query = "SELECT * FROM usuarios ORDER BY ? "; // Ordena por el campo especificado

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
                    $sentencia = $conPDO->prepare("SELECT CEIL(COUNT(*) / ?) AS Paginas FROM usuarios;");
                    $sentencia->bindParam(1, $cantidad);
                    $sentencia->execute(); // Ejecuta la consulta
                    return $sentencia->fetch(); // Devuelve el total de páginas
                } catch (PDOException $e) {
                    print("Error al acceder a BD: " . $e->getMessage());
                }
            }
        }
    }
    public static function verificarUsuario($codigo) {
        $conPDO = Utils::conectar();

        try {
            $sql="SELECT * FROM usuarios WHERE hash=:hash AND activo=0";
            $sentencia=$conPDO->prepare($sql);
            $sentencia->bindParam(":hash",$codigo,PDO::PARAM_STR);
            $sentencia->execute();
            if ($sentencia->rowCount()=== 1) {
                $sql2="UPDATE usuarios SET activo=1 WHERE hash=:hash";
                $sentencia2=$conPDO->prepare($sql2);
                $sentencia2->bindParam(":hash",$codigo,PDO::PARAM_STR);
                if($sentencia2->execute()){
                    return "Tu cuenta ha sido activada correctamente";
                }else{
                    return "Error al activar la cuenta";
                }

            }else{
                return "Codigo no válido o cuenta ya activada";
            }
        } catch (PDOException $e) {
            return "Error en la base de datos". $e-> getMessage();
        }
    }
    public function cambiarPass($email_usuario, $new_pass){
        try {
            $new_pass_hash = password_hash($new_pass, PASSWORD_BCRYPT); 
            $sql = "UPDATE usuarios SET password=:new_pass WHERE email=:email_usuario";
            $stmt = $this -> conPDO->prepare($sql);
            $stmt -> bindParam(":new_pass",$new_pass_hash,PDO::PARAM_STR);
            $stmt -> bindParam(":email_usuario",$email_usuario,PDO::PARAM_INT);
            if ( $stmt -> execute()) {
               header("Location: ../view/login.php");
            }else{
                return "Error al cambiar la contraseña.";
            }
        } catch (PDOException $e) {
            return "Error en la base de datos". $e-> getMessage();
        }
    }
}

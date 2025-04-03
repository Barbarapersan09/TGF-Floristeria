<?php

use model\Utils; // Importa la clase Utils desde el espacio de nombres "model". Contiene métodos de utilidad como la limpieza de datos.
use model\DetallePedido;  // Importa la clase DetallePedido desde el espacio de nombres "model". Maneja las operaciones relacionadas con las DetallePedidoes en la base de datos.

function eliminarDetalle() {
    // Comprueba si se ha recibido el parámetro 'id_DetallePedido' a través de una solicitud POST.
    if (isset($_POST["id_detalle_pedido"])) {
        // Limpia el dato recibido para evitar inyección de código o datos no deseados.
        $id_detalle = Utils::limpiar_datos($_POST["id_detalle_pedido"]);

        // Crea una instancia de la clase DetallePedido para interactuar con los datos de la tabla 'DetallePedido'.
        $gestorDetalle = new DetallePedido();

        // Llama al método deleteDetallePedido() de la clase DetallePedido para eliminar el registro correspondiente en la base de datos.
        if ($gestorDetalle->deleteDetallePedido($id_detalle)) {
            // Si la eliminación es exitosa, se muestra un mensaje de éxito.
            $mensaje = "Eliminado detalle del pedido";
            include "../view/detalle.php";  // Incluye la vista 'DetallePedido.php' para actualizar la interfaz de usuario.
        } else {
            // Si la eliminación falla, se muestra un mensaje de error.
            $mensaje = "Error al eliminar el detalle del pedido";
            include "../view/detalle.php";  // Incluye la misma vista para mantener la consistencia.
        }
    }
}

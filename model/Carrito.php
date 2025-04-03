<?php

class CarritoModel{
    public function __construct()
    {
        if(!isset($_SESSION["carrito"])){
            $_SESSION["carrito"] = [];
        }
    }

    public function addProduct($idProducto, $nombre, $precio, $cantidad, $url_imagen){
        
        if(isset($_SESSION["carrito"][$idProducto])){
            $_SESSION["carrito"][$idProducto]["cantidad"]+= $cantidad;
            //$cantidad= $cantidad + 1
            //$cantidad = 2 + 1 
        }else{
            $_SESSION["carrito"][$idProducto] = [
                "producto_id"=> $idProducto,
                "nombre"=>$nombre,
                "precio"=>$precio,
                "cantidad"=>$cantidad,
                "url_imagen"=>$url_imagen
            ];
        }
        
    }

    public function getCart(){
        return $_SESSION["carrito"];
    }

    public function deleteProduct($idProducto){
        if(isset($_SESSION["carrito"][$idProducto])){
            unset($_SESSION["carrito"][$idProducto]);
        }
    }

    public function deleteCart(){
        $_SESSION["carrito"] = [];
    }
}
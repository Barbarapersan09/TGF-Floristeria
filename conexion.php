<?php

error_reporting(E_ALL);


$DB_SERVER = "sql310.infinityfree.com";
$DB_PORT = 3306;
$DB_USER = "if0_38345535";
$DB_PASSWD = "Jf2w1XQakIG";
$DB_SCHEMA = "if0_38345535_floristeria";

$conexion = new mysqli($DB_SERVER,$DB_USER, $DB_PASSWD, $DB_SCHEMA, $DB_PORT);
if(!$conexion){
    echo "Error conectar a la base de datos".$conexion->connect_error;
}else{
    echo "Exito";
}

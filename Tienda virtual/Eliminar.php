<?php

require "vendor/autoload.php";
include 'functions.php';
include 'modelo/Carrito.php';

$bd_user = "root";
$bd_password = "";
$bd_name = "pow";

try {
    $dsn = "mysql:host=localhost;dbname=$bd_name";
    $bd = new PDO($dsn, $bd_user, $bd_password);
} catch (Exception $e) {
    $texto = "Error de conexion";
    echo $blade->run("inicio", ["title" => "Pow", "texto" => $texto]);
    exit();
}


$views = __DIR__ . '/views';
$cache = __DIR__ . '/cache';

use eftec\bladeone\BladeOne;

$blade = new BladeOne($views, $cache);
session_start();

//ELIMINA UN PRODUCTO DEL CARRITO
if (isset($_GET['id'])) {


    $id = filter_input(INPUT_GET, 'id');
    Carrito::eliminar_producto($bd, $id);
    $carrito = Carrito::muestra_carrito($bd);
    $precio_total = 0;
    $usuario0bj = unserialize($_SESSION['usuarioObj']);
    $usuario = $usuario0bj;
    foreach ($carrito as $producto) {
        $precio_total += $producto->getPrecio();
    }
    echo $blade->run("Cesta", ["usuario" => $usuario, "carrito" => $carrito, "precio_total" => $precio_total]);
}

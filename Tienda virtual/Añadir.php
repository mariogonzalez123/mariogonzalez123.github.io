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

//AÑADE PRODUCTOS AL CARRITO
if (isset($_GET['id'])) {

    $usuario0bj = unserialize($_SESSION['usuarioObj']);
    if (empty($usuario0bj)) {
        $usuario = "";
        $id_producto = filter_input(INPUT_GET, 'id');
        $nombre = filter_input(INPUT_GET, 'nombre');
        $cantidad = filter_input(INPUT_GET, 'cantidad');
        $precio = filter_input(INPUT_GET, 'precio');
        $imagen = filter_input(INPUT_GET, 'imagen');
        $tipo_producto = filter_input(INPUT_GET, 'tipo');
        $stock = filter_input(INPUT_GET, 'stock');
        Carrito::registrar_producto($bd, $nombre, $precio, $cantidad, $imagen, $id_producto, $tipo_producto);
        $carrito = Carrito::muestra_carrito($bd);
        $precio_total = 0;
        foreach ($carrito as $producto) {
            $precio_total += $producto->getPrecio();
        }
        echo $blade->run("Cesta", ["usuario" => $usuario, "carrito" => $carrito, "precio_total" => $precio_total, "usuario" => $usuario]);
    } else {
        $usuario = $usuario0bj;

        $id_producto = filter_input(INPUT_GET, 'id');
        $nombre = filter_input(INPUT_GET, 'nombre');
        $cantidad = filter_input(INPUT_GET, 'cantidad');
        $precio = filter_input(INPUT_GET, 'precio');
        $imagen = filter_input(INPUT_GET, 'imagen');
        $tipo_producto = filter_input(INPUT_GET, 'tipo');
        $stock = filter_input(INPUT_GET, 'stock');
        Carrito::registrar_producto($bd, $nombre, $precio, $cantidad, $imagen, $id_producto, $tipo_producto);
        $carrito = Carrito::muestra_carrito($bd);
        $precio_total = 0;
        foreach ($carrito as $producto) {
            $precio_total += $producto->getPrecio();
        }
        echo $blade->run("Cesta", ["usuario" => $usuario, "carrito" => $carrito, "precio_total" => $precio_total, "usuario" => $usuario]);
    }
}

<?php

require "vendor/autoload.php";
include 'functions.php';
include 'modelo/Producto.php';

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

//EN ESTE CODIGO SE RECIBE LA INFORMACIÓN DE UN PRODUCTO Y  SE REDIRIGE A LA PAGINA DONDE PUEDAS AÑADIR EL PRODUCTO AL CARRITO.
if (isset($_GET['id'])) {

    $usuario0bj = unserialize($_SESSION['usuarioObj']);
    if (empty($usuario0bj)) {
        $usuario = "";
    } else {
        $usuario = $usuario0bj;
    }
    $tipo = filter_input(INPUT_GET, 'tipo');
    $id = filter_input(INPUT_GET, 'id');
    $nombre = filter_input(INPUT_GET, 'nombre');
    $precio = filter_input(INPUT_GET, 'precio');
    $stock = filter_input(INPUT_GET, 'stock');
    $imagen = filter_input(INPUT_GET, 'imagen');
    $cont = count(Producto::listar_productos($bd));

    
    
    
    
    
    $otros_productos = [];
    $contador = 0;
    while ($contador != 5) {
        $id1 = mt_rand(1, $cont);
      

        $producto = Producto::busca_productos($bd,$id1);

        if (in_array($producto, $otros_productos) || $id1 == $id) {
            $id1 = mt_rand(1, $cont);
            $producto = Producto::busca_productos($bd, $id1);
            if($id1 == $id){
            $id1 = mt_rand(1, $cont);
            $producto = Producto::busca_productos($bd, $id1); 
            }
        }


        $otros_productos [] = $producto;

        $contador++;
    }



    echo $blade->run("Producto", ["usuario" => $usuario, 'id' => $id, "nombre" => $nombre, "precio" => $precio, "stock" => $stock, "imagen" => $imagen, "tipo" => $tipo,
        "otros_productos" => $otros_productos]);
}
?>
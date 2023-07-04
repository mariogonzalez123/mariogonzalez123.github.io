




<?php
require "vendor/autoload.php";
include 'functions.php';
include 'modelo/Usuario.php';
include 'modelo/Carrito.php';
include 'modelo/Ciudad.php';
include 'modelo/Producto.php';

$bd_user = "root";
$bd_password = "";
$bd_name = "pow";

//CONEXION  CON LA BASE DE DATOS.

try {
    $dsn = "mysql:host=localhost;dbname=$bd_name";
    $bd = new PDO($dsn, $bd_user, $bd_password);
} catch (Exception $e) {
    $texto = "Error de conexion";
    echo $blade->run("inicio", ["title" => "Pow", "texto" => $texto]);
    exit();
}


//Blade Import

$views = __DIR__ . '/views';
$cache = __DIR__ . '/cache';

use eftec\bladeone\BladeOne;

$blade = new BladeOne($views, $cache);
//INICIO DE SESION
session_start();

//PAGINA INICIO





if (empty($_POST['Enviar'])) {
    $usuarioObj = "";
    $_SESSION['usuarioObj'] = serialize($usuarioObj);

    //GENERA IDS ALEATORIOS Y EL METODO BUSCA PRODUCTOS CON ESTE ID PARA AÑADIRLOS A LA VISTA.
    $cont = count(Producto::listar_productos($bd));
    $id = mt_rand(1, $cont);
    $id2 = mt_rand(1, $cont);
    $id3 = mt_rand(1, $cont);
    $id4 = mt_rand(1, $cont);

    while ($id == $id2 || $id == $id3 || $id == $id4 || $id2 == $id3 || $id2 == $id4 || $id3 == $id4) {
        $id = mt_rand(1, $cont);
        $id2 = mt_rand(1, $cont);
        $id3 = mt_rand(1, $cont);
        $id4 = mt_rand(1, $cont);
    }
    $mangasObj = Producto::busca_productos($bd, $id);
    $discosObj = Producto::busca_productos($bd, $id2);
    $comicsObj = Producto::busca_productos($bd, $id3);
    $vinilosObj = Producto::busca_productos($bd, $id4);
    $_SESSION['mangasObj'] = serialize($mangasObj);

    //SELECCIONADO PRODUCTOS ALEATORIOS Y LOS GUARDA EN UN ARRAY , UTILIZADO EN LA VISTA.
    $productos_random = [];
    $productos_sugeridos = [];
    $productos_sugeridos2 = [];
    $contador = 0;
    while ($contador != 5) {
        $id = mt_rand(1, $cont);
        $id2 = mt_rand(1, $cont);
        $id3 = mt_rand(1, $cont);

        $producto = Producto::busca_productos($bd, $id);
        $producto2 = Producto::busca_productos($bd, $id2);
        $producto3 = Producto::busca_productos($bd, $id3);
        if (in_array($producto, $productos_random)) {
            $id = mt_rand(1, $cont);
            $producto = Producto::busca_productos($bd, $id);
        }
        if (in_array($producto2, $productos_sugeridos)) {
            $id2 = mt_rand(1, $cont);
            $producto2 = Producto::busca_productos($bd, $id);
        }
        if (in_array($producto3, $productos_sugeridos2)) {
            $id3 = mt_rand(1, $cont);
            $producto3 = Producto::busca_productos($bd, $id);
        }
        $productos_random [] = $producto;
        $productos_sugeridos [] = $producto2;
        $productos_sugeridos2 [] = $producto3;
        $contador++;
    }
    //GUARDO LOS ARRAYS EN UNA SESION PARA UTILIZARLOS EN OTRAS PARTES DEL CÓDIGO.
    $_SESSION['productos_random'] = $productos_random;
    $_SESSION['productos_sugeridos'] = $productos_sugeridos;
    $_SESSION['productos_sugeridos2'] = $productos_sugeridos2;

    echo $blade->run("inicio", ["mangasObj" => $mangasObj, "discosObj" => $discosObj, "comicsObj" => $comicsObj, "vinilosObj" => $vinilosObj, "productos_random" => $productos_random, "productos_sugeridos" => $productos_sugeridos,
        "productos_sugeridos2" => $productos_sugeridos2]);
} else {

    $enviar = $_POST['Enviar'];
    switch ($enviar) {

        //RECOGE TODA LA INFORMACIÓN DEL CARRITO Y LA MUESTRA.
        case "Mi cesta":
            $carrito = Carrito::muestra_carrito($bd);
            $precio_total = 0;
            $usuario0bj = unserialize($_SESSION['usuarioObj']);
            $usuario = $usuario0bj;
            foreach ($carrito as $producto) {
                $precio_total += $producto->getPrecio();
            }
            echo $blade->run("Cesta", ["usuario" => $usuario, "carrito" => $carrito, "precio_total" => $precio_total]);
            break;
        //RECOGE TODA LA INFORMACIÓN DE LOS COMICS Y LA MUESTRA.
        case "Comics":
            $usuario0bj = unserialize($_SESSION['usuarioObj']);
            $usuario = $usuario0bj;
            $comics = Producto::comics($bd);
            $cont = 0;
            $diponibilidad = [];

            foreach ($comics as $producto) {

                $nombre = Carrito::busca_nombre($bd, $producto->getNombre());

                if (isset($nombre)) {
                    if ($producto->getNombre() == $nombre->getNombre()) {

                        $diponibilidad [] = "true";
                    } else {

                        $diponibilidad [] = "false";
                    }
                } else {
                    $diponibilidad [] = "false";
                }
            }

            echo $blade->run("Comics", ["comics" => $comics, "usuario" => $usuario0bj, "disponibilidad" => $diponibilidad, "cont" => $cont]);
            break;
        //RECOGE TODA LA INFORMACIÓN DE LOS MANGAS Y LA MUESTRA.
        case "Mangas":
            $usuario0bj = unserialize($_SESSION['usuarioObj']);
            $usuario = $usuario0bj;
            $mangas = Producto::mangas($bd);
            $cont = 0;
            $diponibilidad = [];

            //BUSCA LOS PRODUCTOS REGISTRADOS EN EL CARRITO, PARA VERIFICAR SI LOS PRODUCTOS ESTAN DISPONIBLES PARA AÑADIR AL CARRITO O NO.
            foreach ($mangas as $producto) {

                $nombre = Carrito::busca_nombre($bd, $producto->getNombre());

                if (isset($nombre)) {
                    if ($producto->getNombre() == $nombre->getNombre()) {

                        $diponibilidad [] = "true";
                    } else {

                        $diponibilidad [] = "false";
                    }
                } else {
                    $diponibilidad [] = "false";
                }
            }

            echo $blade->run("Mangas", ["mangas" => $mangas, "usuario" => $usuario0bj, "disponibilidad" => $diponibilidad, "cont" => $cont]);
            break;
        //RECOGE TODA LA INFORMACIÓN DE LOS DISCOS Y LA MUESTRA.
        case "Discos":
            $usuario0bj = unserialize($_SESSION['usuarioObj']);
            $usuario = $usuario0bj;
            $discos = Producto::discos($bd);
            $cont = 0;
            $diponibilidad = [];

            foreach ($discos as $producto) {

                $nombre = Carrito::busca_nombre($bd, $producto->getNombre());

                if (isset($nombre)) {
                    if ($producto->getNombre() == $nombre->getNombre()) {

                        $diponibilidad [] = "true";
                    } else {

                        $diponibilidad [] = "false";
                    }
                } else {
                    $diponibilidad [] = "false";
                }
            }
            echo $blade->run("Discos", ["discos" => $discos, "usuario" => $usuario0bj, "disponibilidad" => $diponibilidad, "cont" => $cont]);
            break;
        //RECOGE TODA LA INFORMACIÓN DE LOS VINILOS Y LA MUESTRA.
        case "Vinilos":
            $usuario0bj = unserialize($_SESSION['usuarioObj']);
            $usuario = $usuario0bj;
            $vinilos = Producto::vinilos($bd);
            $cont = 0;
            $diponibilidad = [];

            foreach ($vinilos as $producto) {

                $nombre = Carrito::busca_nombre($bd, $producto->getNombre());

                if (isset($nombre)) {
                    if ($producto->getNombre() == $nombre->getNombre()) {

                        $diponibilidad [] = "true";
                    } else {

                        $diponibilidad [] = "false";
                    }
                } else {
                    $diponibilidad [] = "false";
                }
            }
            echo $blade->run("Vinilos", ["vinilos" => $vinilos, "usuario" => $usuario0bj, "disponibilidad" => $diponibilidad, "cont" => $cont]);
            break;
        //TE REDIGIRE A LA VENTA LOGIN
        case "Mi cuenta":
            echo $blade->run("Login");
            break;

        //RECOGE LA INFORMACIÓN QUE INTRODUCE EL USUARIO Y LOGEA SI ES CORRECTA.
        case "Iniciar sesión":
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
            $password = filter_input(INPUT_POST, 'passw', FILTER_SANITIZE_STRING);
            $usuario0bj = Usuario::login($bd, $email, $password);
            $_SESSION['usuarioObj'] = serialize($usuario0bj);
            if ($usuario0bj == true) {
                $cont = count(Producto::listar_productos($bd));
                $id = mt_rand(1, $cont);
                $id2 = mt_rand(1, $cont);
                $id3 = mt_rand(1, $cont);
                $id4 = mt_rand(1, $cont);

                while ($id == $id2 || $id == $id3 || $id == $id4 || $id2 == $id3 || $id2 == $id4 || $id3 == $id4) {
                    $id = mt_rand(1, $cont);
                    $id2 = mt_rand(1, $cont);
                    $id3 = mt_rand(1, $cont);
                    $id4 = mt_rand(1, $cont);
                }
                $mangasObj = Producto::busca_productos($bd, $id);
                $discosObj = Producto::busca_productos($bd, $id2);
                $comicsObj = Producto::busca_productos($bd, $id3);
                $vinilosObj = Producto::busca_productos($bd, $id4);
                $usuario = $usuario0bj->getNombre();

                $productos_random = $_SESSION['productos_random'];
                $productos_sugeridos = $_SESSION['productos_sugeridos'];
                $productos_sugeridos2 = $_SESSION['productos_sugeridos2'];

                echo $blade->run("inicio", ["usuario" => $usuario, "mangasObj" => $mangasObj, "discosObj" => $discosObj, "comicsObj" => $comicsObj, "vinilosObj" => $vinilosObj, "productos_random" => $productos_random,
                    "productos_sugeridos" => $productos_sugeridos, "productos_sugeridos2" => $productos_sugeridos2]);
            } else {
                //SI LA INFORMACIÓN NO ES CORRECTA O NO EXISTE ENVIA UN MENSAJE DE ERROR
                $mensaje = "Usuario no encontrado o contraseña incorrecta.";
                echo $blade->run("Login", ['mensaje' => $mensaje]);
            }
            break;

        case "Has olvidado la contraseña":
            echo $blade->run("MContraseña");
            break;

        case "Cambiar contraseña":

            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $contra = filter_input(INPUT_POST, 'passw', FILTER_SANITIZE_STRING);
            $contra_repe = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

            $usuario = Usuario::comprueba_usuario($bd, $email);

            if (!empty($usuario)) {
                if ($contra == "" || $contra != $contra_repe) {

                    $mensaje = "Contraseñas introducidas diferentes";
                    echo $blade->run("MContraseña", ["mensaje" => $mensaje]);
                } else {
                    Usuario::cambiar_contra($bd, $contra, $email);
                    if (unserialize($_SESSION['usuarioObj']) == "") {
                        $cont = count(Producto::listar_productos($bd));
                        $id = mt_rand(1, $cont);
                        $id2 = mt_rand(1, $cont);
                        $id3 = mt_rand(1, $cont);
                        $id4 = mt_rand(1, $cont);

                        while ($id == $id2 || $id == $id3 || $id == $id4 || $id2 == $id3 || $id2 == $id4 || $id3 == $id4) {
                            $id = mt_rand(1, $cont);
                            $id2 = mt_rand(1, $cont);
                            $id3 = mt_rand(1, $cont);
                            $id4 = mt_rand(1, $cont);
                        }
                        $mangasObj = Producto::busca_productos($bd, $id);
                        $discosObj = Producto::busca_productos($bd, $id2);
                        $comicsObj = Producto::busca_productos($bd, $id3);
                        $vinilosObj = Producto::busca_productos($bd, $id4);
                        $usuario0bj = unserialize($_SESSION['usuarioObj']);

                        $productos_random = $_SESSION['productos_random'];
                        $productos_sugeridos = $_SESSION['productos_sugeridos'];
                        $productos_sugeridos2 = $_SESSION['productos_sugeridos2'];

                        echo $blade->run("inicio", ["mangasObj" => $mangasObj, "discosObj" => $discosObj, "comicsObj" => $comicsObj, "vinilosObj" => $vinilosObj, "productos_random" => $productos_random,
                            "productos_sugeridos" => $productos_sugeridos, "productos_sugeridos2" => $productos_sugeridos2]);
                    } else {

                        $usuario0bj = unserialize($_SESSION['usuarioObj']);
                        $usuario = $usuario0bj;
                        $cont = count(Producto::listar_productos($bd));
                        $id = mt_rand(1, $cont);
                        $id2 = mt_rand(1, $cont);
                        $id3 = mt_rand(1, $cont);
                        $id4 = mt_rand(1, $cont);

                        while ($id == $id2 || $id == $id3 || $id == $id4 || $id2 == $id3 || $id2 == $id4 || $id3 == $id4) {
                            $id = mt_rand(1, $cont);
                            $id2 = mt_rand(1, $cont);
                            $id3 = mt_rand(1, $cont);
                            $id4 = mt_rand(1, $cont);
                        }
                        $mangasObj = Producto::busca_productos($bd, $id);
                        $discosObj = Producto::busca_productos($bd, $id2);
                        $comicsObj = Producto::busca_productos($bd, $id3);
                        $vinilosObj = Producto::busca_productos($bd, $id4);

                        $productos_random = $_SESSION['productos_random'];
                        $productos_sugeridos = $_SESSION['productos_sugeridos'];
                        $productos_sugeridos2 = $_SESSION['productos_sugeridos2'];

                        echo $blade->run("inicio", ["usuario0bj" => $usuario0bj, "usuario" => $usuario, "mangasObj" => $mangasObj, "discosObj" => $discosObj, "comicsObj" => $comicsObj, "vinilosObj" => $vinilosObj,
                            "productos_random" => $productos_random, "productos_sugeridos" => $productos_sugeridos, "productos_sugeridos2" => $productos_sugeridos2]);
                    }
                }
            } else {



                $mensaje = "Correo electronico no encontrado";
                echo $blade->run("MContraseña", ["mensaje" => $mensaje]);
            }

            break;

        //EL USUARIO INTRODUCE EL NOMBRE DE UN PRODUCTO Y SE BUSCA LA INFORMACIÓN RELACIONADO CON ESTE
        case "buscar":

            $usuario0bj = unserialize($_SESSION['usuarioObj']);
            $usuario = $usuario0bj;
            $busqueda = filter_input(INPUT_POST, 'busqueda');
            $query = Producto::busqueda($bd, $busqueda);
            $count = count($query);

            $cont = 0;
            $diponibilidad = [];

            foreach ($query as $producto) {

                $nombre = Carrito::busca_nombre($bd, $producto->getNombre());

                if (isset($nombre)) {
                    if ($producto->getNombre() == $nombre->getNombre()) {

                        $diponibilidad [] = "true";
                    } else {

                        $diponibilidad [] = "false";
                    }
                } else {
                    $diponibilidad [] = "false";
                }
            }



            echo $blade->run("Buscador", ["query" => $query, "usuario" => $usuario, "busqueda" => $busqueda, "count" => $count, "cont" => $cont, "disponibilidad" => $diponibilidad]);

            break;
        //TE REDIRIGE A LA VENTANA CREAR CUENTA.
        case "Crear cuenta":
            echo $blade->run("Register");
            break;
        //RECOGE LA INFORMACIÓN QUE INTRODUCE EL USUARIO Y SE REGISTRA EN EL SISTEMA
        case "Registrar":
            $nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_STRING);
            $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
            $password = filter_input(INPUT_POST, 'passw', FILTER_SANITIZE_STRING);
            $tarjeta = filter_input(INPUT_POST, 'card', FILTER_SANITIZE_STRING);
            $RepPassword = filter_input(INPUT_POST, 'pass', FILTER_SANITIZE_STRING);

            //COMPROBACIÓN DE QUE LOS DATOS INTRODUCIDOS POR EL USUARIO SON CORRECTOS EN CASO DE QUE NO LO SEAN ENVIAN UN AVISO.
            $nombre_valido = nombreValido($nombre);
            if ($email) {
                $email_valido = true;
            } else {
                $email_valido = false;
            }
            $password_valida = passwordValida($password);

            $contraseña_correcta = false;

            if ($RepPassword == $password) {
                $contraseña_correcta = true;
            }
            $todo_valido = false;
            if ($nombre_valido == true && $email_valido == true && $password_valida == true && $contraseña_correcta) {
                $todo_valido = true;
            }

            if ($todo_valido == true) {

                $comprueba_usuario = Usuario::comprueba_usuario($bd, $email);
                if ($comprueba_usuario == null) {
                    $usuario = Usuario::registrar_usuario($bd, $nombre, $email, $password, $tarjeta);
                    $cont = count(Producto::listar_productos($bd));
                    $id = mt_rand(1, $cont);
                    $id2 = mt_rand(1, $cont);
                    $id3 = mt_rand(1, $cont);
                    $id4 = mt_rand(1, $cont);

                    while ($id == $id2 || $id == $id3 || $id == $id4 || $id2 == $id3 || $id2 == $id4 || $id3 == $id4) {
                        $id = mt_rand(1, $cont);
                        $id2 = mt_rand(1, $cont);
                        $id3 = mt_rand(1, $cont);
                        $id4 = mt_rand(1, $cont);
                    }
                    $mangasObj = Producto::busca_productos($bd, $id);
                    $discosObj = Producto::busca_productos($bd, $id2);
                    $comicsObj = Producto::busca_productos($bd, $id3);
                    $vinilosObj = Producto::busca_productos($bd, $id4);

                    $productos_random = $_SESSION['productos_random'];
                    $productos_sugeridos = $_SESSION['productos_sugeridos'];
                    $productos_sugeridos2 = $_SESSION['productos_sugeridos2'];

                    echo $blade->run("inicio", ["mangasObj" => $mangasObj, "discosObj" => $discosObj, "comicsObj" => $comicsObj, "vinilosObj" => $vinilosObj, "productos_random" => $productos_random, "productos_sugeridos" => $productos_sugeridos
                        , "productos_sugeridos2" => $productos_sugeridos2]);
                } else {
                    //MENSAJE DE EMAIL EN USO.
                    $mensaje = "Email en uso";
                    echo $blade->run("Register", ['mensaje' => $mensaje]);
                }
            } else {
                $error_nombre = "";
                $error_email = "";
                $error_password = "";
                $error_tarjeta = "";
                $error_contra = "";

                if ($nombre_valido == false) {
                    $error_nombre = "Nombre incorrecto";
                }
                if ($email_valido == false) {
                    $error_email = "Email incorrecto";
                }
                if ($password_valida == false) {
                    $error_password = "Contraseña no valida, debe empezar por mayuscula y tener una longitud de minimo 4 caracteres";
                }

                if ($error_contra == false) {
                    $error_contra = "Contraseña distinta";
                }


                echo $blade->run("Register", ['error_nombre' => $error_nombre, 'error_email' => $error_email, 'error_password' => $error_password, 'error_tarjeta' => $error_tarjeta,
                    "error_contra" => $error_contra, "RepPassword" => $RepPassword, "nombre" => $nombre, "email" => $email, "password" => $password, "tarjeta" => $tarjeta]);
            }
            break;
        //TE REDIRIGE A LA PÁGINA PRINCIPAL DE LA PÁGINA.
        case "Volver":

            if (unserialize($_SESSION['usuarioObj']) == "") {
                $cont = count(Producto::listar_productos($bd));
                $id = mt_rand(1, $cont);
                $id2 = mt_rand(1, $cont);
                $id3 = mt_rand(1, $cont);
                $id4 = mt_rand(1, $cont);

                while ($id == $id2 || $id == $id3 || $id == $id4 || $id2 == $id3 || $id2 == $id4 || $id3 == $id4) {
                    $id = mt_rand(1, $cont);
                    $id2 = mt_rand(1, $cont);
                    $id3 = mt_rand(1, $cont);
                    $id4 = mt_rand(1, $cont);
                }
                $mangasObj = Producto::busca_productos($bd, $id);
                $discosObj = Producto::busca_productos($bd, $id2);
                $comicsObj = Producto::busca_productos($bd, $id3);
                $vinilosObj = Producto::busca_productos($bd, $id4);
                $usuario0bj = unserialize($_SESSION['usuarioObj']);

                $productos_random = $_SESSION['productos_random'];
                $productos_sugeridos = $_SESSION['productos_sugeridos'];
                $productos_sugeridos2 = $_SESSION['productos_sugeridos2'];

                echo $blade->run("inicio", ["mangasObj" => $mangasObj, "discosObj" => $discosObj, "comicsObj" => $comicsObj, "vinilosObj" => $vinilosObj, "productos_random" => $productos_random,
                    "productos_sugeridos" => $productos_sugeridos, "productos_sugeridos2" => $productos_sugeridos2]);
            } else {

                $usuario0bj = unserialize($_SESSION['usuarioObj']);
                $usuario = $usuario0bj;
                $cont = count(Producto::listar_productos($bd));
                $id = mt_rand(1, $cont);
                $id2 = mt_rand(1, $cont);
                $id3 = mt_rand(1, $cont);
                $id4 = mt_rand(1, $cont);

                while ($id == $id2 || $id == $id3 || $id == $id4 || $id2 == $id3 || $id2 == $id4 || $id3 == $id4) {
                    $id = mt_rand(1, $cont);
                    $id2 = mt_rand(1, $cont);
                    $id3 = mt_rand(1, $cont);
                    $id4 = mt_rand(1, $cont);
                }
                $mangasObj = Producto::busca_productos($bd, $id);
                $discosObj = Producto::busca_productos($bd, $id2);
                $comicsObj = Producto::busca_productos($bd, $id3);
                $vinilosObj = Producto::busca_productos($bd, $id4);

                $productos_random = $_SESSION['productos_random'];
                $productos_sugeridos = $_SESSION['productos_sugeridos'];
                $productos_sugeridos2 = $_SESSION['productos_sugeridos2'];

                echo $blade->run("inicio", ["usuario0bj" => $usuario0bj, "usuario" => $usuario, "mangasObj" => $mangasObj, "discosObj" => $discosObj, "comicsObj" => $comicsObj, "vinilosObj" => $vinilosObj,
                    "productos_random" => $productos_random, "productos_sugeridos" => $productos_sugeridos, "productos_sugeridos2" => $productos_sugeridos2]);
            }
            break;
        //REDIRIGE A LA PÁGINA PRINCIPAL 
        case "Seguir Comprando":

            $usuario0bj = unserialize($_SESSION['usuarioObj']);
            $usuario = $usuario0bj;
            $cont = count(Producto::listar_productos($bd));
            $id = mt_rand(1, $cont);
            $id2 = mt_rand(1, $cont);
            $id3 = mt_rand(1, $cont);
            $id4 = mt_rand(1, $cont);

            while ($id == $id2 || $id == $id3 || $id == $id4 || $id2 == $id3 || $id2 == $id4 || $id3 == $id4) {
                $id = mt_rand(1, $cont);
                $id2 = mt_rand(1, $cont);
                $id3 = mt_rand(1, $cont);
                $id4 = mt_rand(1, $cont);
            }
            $mangasObj = Producto::busca_productos($bd, $id);
            $discosObj = Producto::busca_productos($bd, $id2);
            $comicsObj = Producto::busca_productos($bd, $id3);
            $vinilosObj = Producto::busca_productos($bd, $id4);

            $productos_random = $_SESSION['productos_random'];
            $productos_sugeridos = $_SESSION['productos_sugeridos'];
            $productos_sugeridos2 = $_SESSION['productos_sugeridos2'];
            echo $blade->run("inicio", ["usuario0bj" => $usuario0bj, "usuario" => $usuario, "mangasObj" => $mangasObj, "discosObj" => $discosObj, "comicsObj" => $comicsObj, "vinilosObj" => $vinilosObj,
                "productos_random" => $productos_random, "productos_sugeridos" => $productos_sugeridos, "productos_sugeridos2" => $productos_sugeridos2]);
            break;

        //AÑADE EL PRODUCTO AL CARRITO Y TE REDIRIGE A ESTE.
        case "Comprar":
            $tipo_producto = filter_input(INPUT_POST, 'tipo');
            $id_producto = filter_input(INPUT_POST, 'id');
            $nomb = filter_input(INPUT_POST, 'nomb');
            $precio_unidad = filter_input(INPUT_POST, 'precio');
            $cantidad = filter_input(INPUT_POST, 'cantidad');
            $imagen = filter_input(INPUT_POST, 'imagen');
            $stock = filter_input(INPUT_POST, 'stock');

            $nombre = Carrito::busca_nombre($bd, $nomb);

            if (!empty($nombre)) {
                if (empty($usuario0bj)) {
                    $usuario = "";
                } else {
                    $usuario = $usuario0bj;
                }

                $tipo = filter_input(INPUT_POST, 'tipo');
                $id = filter_input(INPUT_POST, 'id');
                $nombre = filter_input(INPUT_POST, 'nomb');
                $precio = filter_input(INPUT_POST, 'precio');
                $stock = filter_input(INPUT_POST, 'stock');
                $imagen = filter_input(INPUT_POST, 'imagen');
                $aviso = "Este producto ya esta añadido en el carrito";
                $otros_productos = [];
                $contador = 0;
                $cont = count(Producto::listar_productos($bd));
                while ($contador != 5) {
                    $id1 = mt_rand(1, $cont);

                    $producto = Producto::busca_productos($bd, $id1);

                    if (in_array($producto, $otros_productos) || $id1 == $id) {
                        $id1 = mt_rand(1, $cont);
                        $producto = Producto::busca_productos($bd, $id1);
                        if ($id1 == $id) {
                            $id1 = mt_rand(1, $cont);
                            $producto = Producto::busca_productos($bd, $id1);
                        }
                    }


                    $otros_productos [] = $producto;

                    $contador++;
                }




                echo $blade->run("Producto", ["usuario" => $usuario, 'id' => $id, "nombre" => $nombre, "precio" => $precio, "stock" => $stock, "imagen" => $imagen, "tipo" => $tipo,
                    "otros_productos" => $otros_productos, "aviso" => $aviso]);
            } else {





                if ($stock >= $cantidad) {


                    $precio = $precio_unidad * $cantidad;
                    Carrito::registrar_producto($bd, $nomb, $precio, $cantidad, $imagen, $id_producto, $tipo_producto);

                    $carrito = Carrito::muestra_carrito($bd);

                    $precio_total = 0;

                    foreach ($carrito as $producto) {
                        $precio_total += $producto->getPrecio();
                    }
                    $usuario0bj = unserialize($_SESSION['usuarioObj']);
                    $usuario = $usuario0bj;
                    echo $blade->run("Cesta", ["usuario" => $usuario, "carrito" => $carrito, "precio_total" => $precio_total]);
                } else {
                    $usuario0bj = unserialize($_SESSION['usuarioObj']);
                    if (empty($usuario0bj)) {
                        $usuario = "";
                    } else {
                        $usuario = $usuario0bj;
                    }

                    $tipo = filter_input(INPUT_POST, 'tipo');
                    $id = filter_input(INPUT_POST, 'id');
                    $nombre = filter_input(INPUT_POST, 'nomb');
                    $precio = filter_input(INPUT_POST, 'precio');
                    $stock = filter_input(INPUT_POST, 'stock');
                    $imagen = filter_input(INPUT_POST, 'imagen');
                    $aviso = "No hay suficiente stock para la cantidad seleccionada";
                    $otros_productos = [];
                    $contador = 0;
                    $cont = count(Producto::listar_productos($bd));
                    while ($contador != 5) {
                        $id1 = mt_rand(1, $cont);

                        $producto = Producto::busca_productos($bd, $id1);

                        if (in_array($producto, $otros_productos) || $id1 == $id) {
                            $id1 = mt_rand(1, $cont);
                            $producto = Producto::busca_productos($bd, $id1);
                            if ($id1 == $id) {
                                $id1 = mt_rand(1, $cont);
                                $producto = Producto::busca_productos($bd, $id1);
                            }
                        }


                        $otros_productos [] = $producto;

                        $contador++;
                    }




                    echo $blade->run("Producto", ["usuario" => $usuario, 'id' => $id, "nombre" => $nombre, "precio" => $precio, "stock" => $stock, "imagen" => $imagen, "tipo" => $tipo,
                        "otros_productos" => $otros_productos, "aviso" => $aviso]);
                }
            }

            break;
        //AÑADE EL PRODUCTO AL CARRITO Y REDIRIGE A LA PÁGINA PRINCIPAL.
        case "Añadir al carrito":

            $tipo_producto = filter_input(INPUT_POST, 'tipo');
            $id_producto = filter_input(INPUT_POST, 'id');
            $nomb = filter_input(INPUT_POST, 'nomb');
            $precio_unidad = filter_input(INPUT_POST, 'precio');
            $cantidad = filter_input(INPUT_POST, 'cantidad');
            $imagen = filter_input(INPUT_POST, 'imagen');
            $stock = filter_input(INPUT_POST, 'stock');
            $precio = $precio_unidad * $cantidad;
            $nombre = Carrito::busca_nombre($bd, $nomb);
            //SI LA CANTIDAD SELECCIONADA  ES MAYOR QUE EL STOCK , SE ENVIA UN AVISO DE ERROR.
            if (!empty($nombre)) {
                if (empty($usuario0bj)) {
                    $usuario = "";
                } else {
                    $usuario = $usuario0bj;
                }

                $tipo = filter_input(INPUT_POST, 'tipo');
                $id = filter_input(INPUT_POST, 'id');
                $nombre = filter_input(INPUT_POST, 'nomb');
                $precio = filter_input(INPUT_POST, 'precio');
                $stock = filter_input(INPUT_POST, 'stock');
                $imagen = filter_input(INPUT_POST, 'imagen');
                $aviso = "Este producto ya esta añadido en el carrito";
                $otros_productos = [];
                $contador = 0;
                $cont = count(Producto::listar_productos($bd));
                while ($contador != 5) {
                    $id1 = mt_rand(1, $cont);

                    $producto = Producto::busca_productos($bd, $id1);

                    if (in_array($producto, $otros_productos) || $id1 == $id) {
                        $id1 = mt_rand(1, $cont);
                        $producto = Producto::busca_productos($bd, $id1);
                        if ($id1 == $id) {
                            $id1 = mt_rand(1, $cont);
                            $producto = Producto::busca_productos($bd, $id1);
                        }
                    }


                    $otros_productos [] = $producto;

                    $contador++;
                }




                echo $blade->run("Producto", ["usuario" => $usuario, 'id' => $id, "nombre" => $nombre, "precio" => $precio, "stock" => $stock, "imagen" => $imagen, "tipo" => $tipo,
                    "otros_productos" => $otros_productos, "aviso" => $aviso]);
            } else {
                if ($stock >= $cantidad) {

                    Carrito::registrar_producto($bd, $nomb, $precio, $cantidad, $imagen, $id_producto, $tipo_producto);
                    $usuario0bj = unserialize($_SESSION['usuarioObj']);
                    $usuario = $usuario0bj;
                    $cont = count(Producto::listar_productos($bd));
                    $id = mt_rand(1, $cont);
                    $id2 = mt_rand(1, $cont);
                    $id3 = mt_rand(1, $cont);
                    $id4 = mt_rand(1, $cont);

                    while ($id == $id2 || $id == $id3 || $id == $id4 || $id2 == $id3 || $id2 == $id4 || $id3 == $id4) {
                        $id = mt_rand(1, $cont);
                        $id2 = mt_rand(1, $cont);
                        $id3 = mt_rand(1, $cont);
                        $id4 = mt_rand(1, $cont);
                    }
                    $mangasObj = Producto::busca_productos($bd, $id);
                    $discosObj = Producto::busca_productos($bd, $id2);
                    $comicsObj = Producto::busca_productos($bd, $id3);
                    $vinilosObj = Producto::busca_productos($bd, $id4);

                    $productos_random = $_SESSION['productos_random'];
                    $productos_sugeridos = $_SESSION['productos_sugeridos'];
                    $productos_sugeridos2 = $_SESSION['productos_sugeridos2'];
                    echo $blade->run("inicio", ["usuario" => $usuario0bj, "mangasObj" => $mangasObj, "discosObj" => $discosObj, "comicsObj" => $comicsObj, "vinilosObj" => $vinilosObj, "productos_random" => $productos_random,
                        "productos_sugeridos" => $productos_sugeridos, "productos_sugeridos2" => $productos_sugeridos2]);
                } else {
                    $usuario0bj = unserialize($_SESSION['usuarioObj']);
                    if (empty($usuario0bj)) {
                        $usuario = "";
                    } else {
                        $usuario = $usuario0bj;
                    }

                    $tipo = filter_input(INPUT_POST, 'tipo');
                    $id = filter_input(INPUT_POST, 'id');
                    $nombre = filter_input(INPUT_POST, 'nomb');
                    $precio = filter_input(INPUT_POST, 'precio');
                    $stock = filter_input(INPUT_POST, 'stock');
                    $imagen = filter_input(INPUT_POST, 'imagen');
                    $aviso = "No hay suficiente stock";
                    $otros_productos = [];
                    $contador = 0;
                    $cont = count(Producto::listar_productos($bd));
                    while ($contador != 5) {
                        $id1 = mt_rand(1, $cont);

                        $producto = Producto::busca_productos($bd, $id1);

                        if (in_array($producto, $otros_productos) || $id1 == $id) {
                            $id1 = mt_rand(1, $cont);
                            $producto = Producto::busca_productos($bd, $id1);
                            if ($id1 == $id) {
                                $id1 = mt_rand(1, $cont);
                                $producto = Producto::busca_productos($bd, $id1);
                            }
                        }


                        $otros_productos [] = $producto;

                        $contador++;
                    }

                    echo $blade->run("Producto", ["usuario" => $usuario, 'id' => $id, "nombre" => $nombre, "precio" => $precio, "stock" => $stock, "imagen" => $imagen, "tipo" => $tipo,
                        "otros_productos" => $otros_productos, "aviso" => $aviso]);
                }
            }



            break;
        //VACIA TODOS LOS PRODUCTOS DEL CARRITO.
        case "Vaciar Cesta":
            Carrito::vaciar_cesta($bd);
            $carrito = Carrito::muestra_carrito($bd);
            $precio_total = 0;
            echo $blade->run("Cesta", ["carrito" => $carrito, "precio_total" => $precio_total]);
            break;
        //REDIRIGE A LA VISTA COMPROMISOS.
        case "Compromisos":
            $usuario0bj = unserialize($_SESSION['usuarioObj']);
            if (empty($usuario0bj)) {
                $usuario = "";
            } else {
                $usuario = $usuario0bj;
            }
            echo $blade->run("Compromisos", ["usuario" => $usuario]);
            break;

        //REDIRIGE LA VENTANA DE PAGO.
        case "Guardar y comprar":

            $provincias = Ciudad::muestra_provincias($bd);

            echo $blade->run("Pago", ["provincias" => $provincias]);
            break;
        //EL USUARIO INTRODUCE LA INFORMACIÓN DE COMPRA Y SI ES CORRECTA TE REDIRIGE A LA VISTA RESUMEN.
        case "Pagar":

            $nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_STRING);
            $ciudad = filter_input(INPUT_POST, 'provincia', FILTER_SANITIZE_STRING);
            $cp = filter_input(INPUT_POST, 'cp', FILTER_SANITIZE_STRING);
            $tarjeta = filter_input(INPUT_POST, 'card', FILTER_SANITIZE_STRING);
            $caducidad = filter_input(INPUT_POST, 'caducidad', FILTER_SANITIZE_STRING);
            $cvv = filter_input(INPUT_POST, 'cvv', FILTER_SANITIZE_STRING);
            $direccion = filter_input(INPUT_POST, 'direccion', FILTER_SANITIZE_STRING);
            $via = filter_input(INPUT_POST, 'via', FILTER_SANITIZE_STRING);

            $nombre_valido = nombreValido($nombre);

            $cp_valido = cpValido($cp);
            $tarjeta_valida = tarjetaValida($tarjeta);
            $caducidad_valida = caducidadValida($caducidad);
            $cvv_valido = cvvValido($cvv);

            $error_nombre = "";

            $error_cp = "";
            $error_tarjeta = "";
            $error_caducidad = "";
            $error_cvv = "";
            $error_direccion = "";

            if ($nombre_valido == false) {
                $error_nombre = "Nombre incorrecto";
            }

            if ($cp_valido == false) {
                $error_cp = "Codigo postal incorrecto";
            }
            if ($tarjeta_valida == false) {
                $error_tarjeta = "Tarjeta incorrecta";
            }
            if ($caducidad_valida == false) {
                $error_caducidad = "Caducidad incorrecta";
            }
            if ($cvv_valido == false) {
                $error_cvv = "Cvv incorrecto";
            }
            if (!nombreValido($direccion)) {
                $error_direccion = "Dirección incorrecta";
            }





            if ($nombre_valido == true && $cp_valido == true && $tarjeta_valida == true &&
                    $caducidad_valida == true && $cvv_valido == true) {
                $carrito = Carrito::muestra_carrito($bd);
                foreach ($carrito as $producto) {
                    // EL PROGRAMA DISTINGUE QUE TIPO DE PRODUCTO ES Y RESTA LA CANTIDAD SELECCIONADA DEL STOCK.
                    if ($producto->getTipo_producto() == "comic") {
                        $id = $producto->getId_producto();
                        $unidades = $producto->getCantidad();

                        $comic = Producto::obtener_stock_por_id($bd, $id);
                        $stock = $comic->getStock();
                        $stockFinal = $stock - $unidades;
                        Producto::quitar_stock($bd, $id, $stockFinal);
                    } else if ($producto->getTipo_Producto() == "vinilo") {
                        $id = $producto->getId_producto();
                        $unidades = $producto->getCantidad();
                        $vinilo = Producto::obtener_stock_por_id($bd, $id);
                        $stock = $vinilo->getStock();
                        $stockFinal = $stock - $unidades;
                        Producto::quitar_stock($bd, $id, $stockFinal);
                    } else if ($producto->getTipo_Producto() == "disco") {
                        $id = $producto->getId_producto();
                        $unidades = $producto->getCantidad();
                        $discos = Producto::obtener_stock_por_id($bd, $id);
                        $stock = $discos->getStock();
                        $stockFinal = $stock - $unidades;
                        Producto::quitar_stock($bd, $id, $stockFinal);
                    } else if ($producto->getTipo_Producto() == "manga") {
                        $id = $producto->getId_producto();
                        $unidades = $producto->getCantidad();
                        $mangas = Producto::obtener_stock_por_id($bd, $id);
                        $stock = $mangas->getStock();
                        $stockFinal = $stock - $unidades;
                        Producto::quitar_stock($bd, $id, $stockFinal);
                    }
                }

                $precio_total = 0;

                foreach ($carrito as $producto) {
                    $precio_total += $producto->getPrecio();
                }
                //UNA VEZ RESTADO EL STOCK SE BORRA LOS PRODUCTOS DEL CARRITO.
                Carrito::vaciar_cesta($bd);
                echo $blade->run("Resumen", ["precio_total" => $precio_total, "nombre" => $nombre, "ciudad" => $ciudad, "cp" => $cp, "direccion" => $direccion, "via" => $via]);
            } else {
                $provincias = Ciudad::muestra_provincias($bd);
                echo $blade->run("Pago", ['error_nombre' => $error_nombre, 'provincias' => $provincias, 'cp_valido' => $cp_valido, 'error_tarjeta' => $error_tarjeta, "error_cp" => $error_cp,
                    "error_caducidad" => $error_caducidad, "error_cvv" => $error_cvv, "nombre" => $nombre, "ciudad" => $ciudad, "cp" => $cp, "tarjeta" => $tarjeta, "caducidad" => $caducidad,
                    "cvv" => $cvv, "direccion" => $direccion, "error_direccion" => $error_direccion]);
            }



            break;
        //CIERRA LA SESIÓN DEL USUARIO.
        case "Cerrar sesión":
            $usuarioObj = "";
            $_SESSION['usuarioObj'] = serialize($usuarioObj);
            $cont = count(Producto::listar_productos($bd));
            $id = mt_rand(1, $cont);
            $id2 = mt_rand(1, $cont);
            $id3 = mt_rand(1, $cont);
            $id4 = mt_rand(1, $cont);

            while ($id == $id2 || $id == $id3 || $id == $id4 || $id2 == $id3 || $id2 == $id4 || $id3 == $id4) {
                $id = mt_rand(1, $cont);
                $id2 = mt_rand(1, $cont);
                $id3 = mt_rand(1, $cont);
                $id4 = mt_rand(1, $cont);
            }
            $mangasObj = Producto::busca_productos($bd, $id);
            $discosObj = Producto::busca_productos($bd, $id2);
            $comicsObj = Producto::busca_productos($bd, $id3);
            $vinilosObj = Producto::busca_productos($bd, $id4);

            $productos_random = $_SESSION['productos_random'];
            $productos_sugeridos = $_SESSION['productos_sugeridos'];
            $productos_sugeridos2 = $_SESSION['productos_sugeridos2'];
            //SI CIERRRAS SESIÓN LOS PRODUCTOS DEL CARRITO SON BORRADOS
            Carrito::vaciar_cesta($bd);
            echo $blade->run("inicio", ["mangasObj" => $mangasObj, "discosObj" => $discosObj, "comicsObj" => $comicsObj, "vinilosObj" => $vinilosObj, "productos_random" => $productos_random,
                "productos_sugeridos" => $productos_sugeridos, "productos_sugeridos2" => $productos_sugeridos2]);
            break;

        //PAGINA PRINCIPAL.
        default:
            $usuarioObj = "";
            $_SESSION['usuarioObj'] = serialize($usuarioObj);
            $cont = count(Producto::listar_productos($bd));
            $id = mt_rand(1, $cont);
            $id2 = mt_rand(1, $cont);
            $id3 = mt_rand(1, $cont);
            $id4 = mt_rand(1, $cont);

            while ($id == $id2 || $id == $id3 || $id == $id4 || $id2 == $id3 || $id2 == $id4 || $id3 == $id4) {
                $id = mt_rand(1, $cont);
                $id2 = mt_rand(1, $cont);
                $id3 = mt_rand(1, $cont);
                $id4 = mt_rand(1, $cont);
            }
            $mangasObj = Producto::busca_productos($bd, $id);
            $discosObj = Producto::busca_productos($bd, $id2);
            $comicsObj = Producto::busca_productos($bd, $id3);
            $vinilosObj = Producto::busca_productos($bd, $id4);

            $productos_random = $_SESSION['productos_random'];
            $productos_sugeridos = $_SESSION['productos_sugeridos'];
            $productos_sugeridos2 = $_SESSION['productos_sugeridos2'];

            echo $blade->run("inicio", ["mangasObj" => $mangasObj, "discosObj" => $discosObj, "comicsObj" => $comicsObj, "vinilosObj" => $vinilosObj, "productos_random" => $productos_random,
                "productos_sugeridos" => $productos_sugeridos, "productos_sugeridos2" => $productos_sugeridos2]);
    }
}
?>







<script>
//PEQUEÑO SCRIPT PARA PODER VER LA CONTRASEÑA DEL LOGIN Y EL REGISTER
    function toggle(id) {
        var x = document.getElementById(id);
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
</script>





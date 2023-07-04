<?php

class Carrito {

    private $id;
    private $nombre;
    private $precio;
    private $cantidad;
    private $imagen;
    private $id_producto;
    private $tipo_producto;

    function __construct(int $id = null, string $nombre = null, float $precio = null, int $cantidad = null, string $imagen = null, int $id_producto = null, string $tipo_producto = null) {

        if (!is_null($id)) {
            $this->id = $id;
        }
        if (!is_null($nombre)) {
            $this->nombre = $nombre;
        }
        if (!is_null($precio)) {
            $this->precio = $precio;
        }
        if (!is_null($cantidad)) {
            $this->cantidad = $cantidad;
        }
        if (!is_null($imagen)) {
            $this->imagen = $imagen;
        }
        if (!is_null($id_producto)) {
            $this->id_producto = $id_producto;
        }

        if (!is_null($tipo_producto)) {
            $this->tipo_producto = $tipo_producto;
        }
    }

    public function getId() {
        return $this->id;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getPrecio() {
        return $this->precio;
    }

    public function getCantidad() {
        return $this->cantidad;
    }

    public function getImagen() {
        return $this->imagen;
    }

    public function setId($id): void {
        $this->id = $id;
    }

    public function setNombre($nombre): void {
        $this->nombre = $nombre;
    }

    public function setPrecio($precio): void {
        $this->precio = $precio;
    }

    public function setCantidad($cantidad): void {
        $this->cantidad = $cantidad;
    }

    public function setImagen($imagen): void {
        $this->imagen = $imagen;
    }

    public function getId_producto() {
        return $this->id_producto;
    }

    public function setId_producto($id_producto): void {
        $this->id_producto = $id_producto;
    }

    public function getTipo_producto() {
        return $this->tipo_producto;
    }

    public function setTipo_producto($tipo_producto): void {
        $this->tipo_producto = $tipo_producto;
    }

    //REGISTRO DE PRODUCTO
    public static function registrar_producto(PDO $bd, $nombre, $precio, $cantidad, $imagen, $id_producto, $tipo_producto) {
        $sql = "insert into carrito(nombre,precio,cantidad,imagen,id_producto,tipo_producto) values " .
                "(:nombre,:precio,:cantidad,:imagen,:id_producto,:tipo_producto)";

        $stmt = $bd->prepare($sql);
        $stmt->execute([":nombre" => $nombre, ":precio" => $precio, ":cantidad" => $cantidad, ":imagen" => $imagen, ":id_producto" => $id_producto, ":tipo_producto" => $tipo_producto]);
    }

    //LISTAR CARRITO   
    public static function muestra_carrito(PDO $bd): ?array {
        $sql = "select * from  carrito";
        $stmt = $bd->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, Carrito::class);
        $carrito = $stmt->fetchAll();
        return $carrito;
    }

    
    public static function busca_nombre(PDO $bd , $nombre): ?Carrito{
         $sql = "select * from carrito where nombre = :nombre";
        $stmt = $bd->prepare($sql);
        $stmt->execute([":nombre" => $nombre]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, Carrito::class);
        $producto = ($stmt->fetch()) ?: null;
        return $producto;
    } 
    //VACIAR CESTA
    public static function vaciar_cesta(PDO $bd) {
        $sql = "delete  from carrito";
        $stmt = $bd->prepare($sql);
        $stmt->execute();
    }

    //ELIMINA PRODUCTOS DEL CARRITO
    public static function eliminar_producto(PDO $bd, $id) {

        $sql = "delete from carrito WHERE id=:id";
        $stmt = $bd->prepare($sql);
        $stmt->execute([":id" => $id]);
    }

}

?>
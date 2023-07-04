<?php

class Producto {

    private $id;
    private $nombre;
    private $precio;
    private $stock;
    private $imagen;
    private $tipo;

    function __construct(int $id = null, string $nombre = null, float $precio = null, int $stock = null, string $imagen = null, string $tipo = null) {

        if (!is_null($id)) {
            $this->id = $id;
        }
        if (!is_null($nombre)) {
            $this->nombre = $nombre;
        }
        if (!is_null($precio)) {
            $this->precio = $precio;
        }
        if (!is_null($stock)) {
            $this->stock = $stock;
        }
        if (!is_null($imagen)) {
            $this->imagen = $imagen;
        }
        if (!is_null($tipo)) {
            $this->tipo = $tipo;
        }
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id): void {
        $this->id = $id;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getPrecio() {
        return $this->precio;
    }

    public function getStock() {
        return $this->stock;
    }

    public function getImagen() {
        return $this->imagen;
    }

    public function setNombre($nombre): void {
        $this->nombre = $nombre;
    }

    public function setPrecio($precio): void {
        $this->precio = $precio;
    }

    public function setStock($stock): void {
        $this->stock = $stock;
    }

    public function setImagen($imagen): void {
        $this->imagen = $imagen;
    }

    public function getTipo() {
        return $this->tipo;
    }

    public function setTipo($tipo): void {
        $this->tipo = $tipo;
    }

    // LISTAR PRODUCTOS

    public static function listar_productos(PDO $bd): ?array {
        $sql = "select * from  productos";
        $stmt = $bd->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, Producto::class);
        $listar = $stmt->fetchAll();
        return $listar;
    }

    //BUSCA PRODUCTOS DE LA BASE DE DATOS.
    public static function busqueda(PDO $bd, $busqueda): ?array {
        $sql = "SELECT * from productos where nombre Like '%$busqueda%'";
        $stmt = $bd->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, Producto::class);
        $listar = $stmt->fetchAll();
        return $listar;
    }

    //MUESTRA TODOS LOS COMICS DE LA BASE DE DATOS.
    public static function comics(PDO $bd): ?array {
        $sql = "SELECT * from productos where tipo LIKE '%comic%'";
        $stmt = $bd->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, Producto::class);
        $listar = $stmt->fetchAll();
        return $listar;
    }

    //MUESTRA TODOS LOS MANGAS DE LA BASE DE DATOS.
    public static function mangas(PDO $bd): ?array {
        $sql = "SELECT * from productos where tipo LIKE '%manga%'";
        $stmt = $bd->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, Producto::class);
        $listar = $stmt->fetchAll();
        return $listar;
    }

    //MUESTRA TODOS LOS DISCOS DE LA BASE DE DATOS.
    public static function discos(PDO $bd): ?array {
        $sql = "SELECT * from productos where tipo LIKE '%disco%'";
        $stmt = $bd->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, Producto::class);
        $listar = $stmt->fetchAll();
        return $listar;
    }

    //MUESTRA TODOS LOS VINILOS DE LA BASE DE DATOS.
    public static function vinilos(PDO $bd): ?array {
        $sql = "SELECT * from productos where tipo LIKE '%vinilo%'";
        $stmt = $bd->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, Producto::class);
        $listar = $stmt->fetchAll();
        return $listar;
    }

    //BUSCA PRODUCTOS POR ID.
    public static function busca_productos(PDO $bd, $id): ?Producto {
        $sql = "select * from productos where id = :id";
        $stmt = $bd->prepare($sql);
        $stmt->execute([":id" => $id]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, Producto::class);
        $producto = ($stmt->fetch()) ?: null;
        return $producto;
    }

    public static function busca_nombre(PDO $bd , $nombre): ?Producto{
         $sql = "select * from productos where nombre = :nombre";
        $stmt = $bd->prepare($sql);
        $stmt->execute([":nombre" => $nombre]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, Producto::class);
        $producto = ($stmt->fetch()) ?: null;
        return $producto;
    } 
    
    
    
    
    //OBTIENE EL STOCK DEL PRODUCTO CON UN ID.
    public static function obtener_stock_por_id(PDO $bd, $id) {
        $sql = "select stock from productos where id = :id";
        $stmt = $bd->prepare($sql);
        $stmt->execute([":id" => $id]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, Producto::class);
        $stock = ($stmt->fetch()) ?: null;
        return $stock;
    }

    //QUITA STOCK DE UN PRODUCTO.

    public static function quitar_stock(PDO $bd, $id, $stock) {
        $sql = "UPDATE productos SET stock=:stock WHERE id=:id";
        $stmt = $bd->prepare($sql);
        $stmt->execute([":id" => $id, ":stock" => $stock]);
    }

}

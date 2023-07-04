<?php

class Ciudad {

    private $nombre;

    function __construct(String $nombre = null) {
        if (!is_null($nombre)) {
            $this->nombre = $nombre;
        }
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function setNombre($nombre): void {
        $this->nombre = $nombre;
    }

    //MUESTRA TODAS LAS PROVINCIAS DE ESPAÑA.

    public static function muestra_provincias(PDO $bd): ?array {
        $sql = "select * from  ciudades";
        $stmt = $bd->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, Ciudad::class);
        $ciudad = $stmt->fetchAll();
        return $ciudad;
    }

}

?>
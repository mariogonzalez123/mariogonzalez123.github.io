<?php

class Usuario {

    private $Nombre;
    private $Email;
    private $Password;
    private $Tarjeta;

    function __construct(int $id = null, string $Nombre = null, string $Email = null, string $Password = null, string $Tarjeta = null) {

        if (!is_null($id)) {
            $this->id = $id;
        }
        if (!is_null($Nombre)) {
            $this->Nombre = $Nombre;
        }
        if (!is_null($Email)) {
            $this->Email = $Email;
        }
        if (!is_null($Password)) {
            $this->Password = $Password;
        }
        if (!is_null($Tarjeta)) {
            $this->Tarjeta = $Tarjeta;
        }
    }

    public function getNombre() {
        return $this->Nombre;
    }

    public function getEmail() {
        return $this->Email;
    }

    public function getPassword() {
        return $this->Password;
    }

    public function getTarjeta() {
        return $this->Tarjeta;
    }

    public function setNombre($Nombre): void {
        $this->Nombre = $Nombre;
    }

    public function setEmail($Email): void {
        $this->Email = $Email;
    }

    public function setPassword($Password): void {
        $this->Password = $Password;
    }

    public function setTarjeta($Tarjeta): void {
        $this->Tarjeta = $Tarjeta;
    }

    //REGISTRA UN USUARIO EN LA BASE DATOS.
    public static function registrar_usuario(PDO $bd, $Nombre, $Email, $Password, $Tarjeta) {
        $sql = "insert into usuarios(Nombre,Email,Password) values " .
                "(:Nombre,:Email,:Password)";
        $stmt = $bd->prepare($sql);
        $stmt->execute([":Nombre" => $Nombre, ":Email" => $Email, ":Password" => $Password]);
    }

    //COMPRUEBA SI UN EMAIL YA ESTA REGISTRADO EN LA BASE DE DATOS.
    public static function comprueba_usuario(PDO $bd, $Email): ?Usuario {
        $sql = "select * from usuarios where Email = :Email";
        $stmt = $bd->prepare($sql);

        $stmt->execute([":Email" => $Email]);

        $stmt->setFetchMode(PDO::FETCH_CLASS, Usuario::class);
        $Usuario = ($stmt->fetch()) ?: null;
        return $Usuario;
    }

    //INICIA SESION SI LOS DATOS QUE INTRODUCE EL USUARIO ESTAN EN LA BASE DATOS.
    public static function login(PDO $bd, $email, $password): ?Usuario {
        $sql = "select * from usuarios where Email = :Email and Password = :Password";
        $stmt = $bd->prepare($sql);

        $stmt->execute([":Email" => $email, ":Password" => $password]);

        $stmt->setFetchMode(PDO::FETCH_CLASS, Usuario::class);
        $usuario = ($stmt->fetch()) ?: null;
        return $usuario;
    }
    
   
    public static function cambiar_contra(PDO $bd, $passw, $email) {
        $sql = "UPDATE usuarios SET Password=:Password WHERE email=:email";
        $stmt = $bd->prepare($sql);
        $stmt->execute([":Password" => $passw, ":email" => $email]);
    }


}

?>
<?php

class Usuario
{
    
    public $id;
    public $nombre;
    public $apellido;
    public $rol;
    public $clave;
    public $usuario;
    public $estado;

    /* Consulta a la Base de Datos para crear un usuario */
    public function crearUsuario()
    {
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta("INSERT INTO usuarios (nombre, apellido, rol, clave, usuario, estado) VALUES (:nombre, :apellido, :rol, :clave, :usuario, :estado)");
        $claveHash = password_hash($this->clave, PASSWORD_DEFAULT);
        
        $consulta->bindValue(':nombre', $this->nombre, PDO::PARAM_STR);
        $consulta->bindValue(':apellido', $this->apellido, PDO::PARAM_STR);
        $consulta->bindValue(':rol', $this->rol, PDO::PARAM_STR);
        $consulta->bindValue(':clave', $claveHash);
        $consulta->bindValue(':usuario', $this->usuario, PDO::PARAM_STR);
        $consulta->bindValue(':estado', $this->estado, PDO::PARAM_STR);
        $consulta->execute();

        return $objAccesoDatos->obtenerUltimoId();
    }
    /* Consulta a la Base de datos para obtener todos los usuarios */
    public static function obtenerTodos()
    {
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta("SELECT * FROM usuarios");
        $consulta->execute();
        
        return $consulta->fetchAll(PDO::FETCH_CLASS, 'Usuario');
    }
    /* Consulta a la Base de datos para verificar si hay un usuario repetido comparando nombre, apellido y nombre de usuario */
    public static function buscarRepetido($usuarios) {
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta("SELECT * FROM usuarios WHERE (nombre = :nombre OR apellido = :apellido) AND usuario = :usuario");
        $consulta->bindValue(':nombre', $usuarios->nombre, PDO::PARAM_STR);
        $consulta->bindValue(':apellido', $usuarios->apellido, PDO::PARAM_STR);
        $consulta->bindValue(':usuario', $usuarios->usuario, PDO::PARAM_STR);
        $consulta->execute();

        return $consulta->fetchAll(PDO::FETCH_CLASS, 'Usuario');
    }
    public static function verificarId($usuarios) {
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta("SELECT * FROM usuarios WHERE id = :id");
        $consulta->bindValue(':id', $usuarios->id, PDO::PARAM_INT);
        
        $consulta->execute();

        return $consulta->fetchAll(PDO::FETCH_CLASS, 'Usuario');
    }
    /* Obtengo un usuario por id */
    public static function obtenerUsuario($usuario)
    {
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta("SELECT * FROM usuarios WHERE id = :id");
        $consulta->bindValue(':id', $usuario, PDO::PARAM_STR);
        $consulta->execute();

        return $consulta->fetchObject('Usuario');
    }
    public static function obtenerPorUsuario($usuario)
    {
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta("SELECT * FROM usuarios WHERE usuario = :usuario AND clave = :clave");
        $consulta->bindValue(':usuario', $usuario->usuario, PDO::PARAM_INT);
        $consulta->bindValue(':clave', $usuario->clave, PDO::PARAM_INT);
        
        $consulta->execute();

        return $consulta->fetchAll(PDO::FETCH_CLASS, 'Usuario');
    }
    /* Modifico un usuario segun su id */
    public static function modificarUsuario($usuario)
    {
        $objAccesoDato = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDato->prepararConsulta("UPDATE usuarios SET nombre = :nombre, apellido = :apellido, rol = :rol, usuario = :usuario, clave = :clave, estado = :estado WHERE id = :id");
        $claveHash = password_hash($usuario->clave, PASSWORD_DEFAULT);
        $consulta->bindValue(':nombre', $usuario->nombre, PDO::PARAM_STR);
        $consulta->bindValue(':apellido', $usuario->apellido, PDO::PARAM_STR);
        $consulta->bindValue(':rol', $usuario->rol, PDO::PARAM_STR);
        $consulta->bindValue(':usuario', $usuario->usuario, PDO::PARAM_STR);
        $consulta->bindValue(':clave', $claveHash, PDO::PARAM_STR);
        $consulta->bindValue(':estado', $usuario->estado, PDO::PARAM_STR);
        $consulta->bindValue(':id', $usuario->id, PDO::PARAM_STR);
        $consulta->execute(); 
    }

    public static function bajaUsuario($usuario)
    {
        $objAccesoDato = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDato->prepararConsulta("UPDATE usuarios SET estado = :estado WHERE id = :id");
        $consulta->bindValue(':estado', $usuario->estado, PDO::PARAM_STR);
        $consulta->bindValue(':id', $usuario->id, PDO::PARAM_STR);
        $consulta->execute();
    }
}
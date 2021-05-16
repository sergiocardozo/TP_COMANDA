<?php

class Mesa
{

    public $id;
    public $codigoMesa;
    public $idEstadoMesa;

    public function crearMesa()
    {
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta("INSERT INTO mesas (codigoMesa, idEstadoMesa) VALUES (:codigoMesa, :idEstadoMesa)");
        $consulta->bindValue(':codigoMesa', $this->codigoMesa, PDO::PARAM_STR);
        $consulta->bindValue(':idEstadoMesa', $this->idEstadoMesa, PDO::PARAM_INT);
        $consulta->execute();

        return $objAccesoDatos->obtenerUltimoId();
    }

    public static function obtenerTodos()
    {
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta("SELECT * FROM mesas");
        $consulta->execute();

        return $consulta->fetchAll(PDO::FETCH_CLASS, 'Mesa');
    }

    public static function obtenerMesa($mesa)
    {
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta("SELECT * FROM mesas WHERE codigoMesa = :codigoMesa");
        $consulta->bindValue(':codigoMesa', $mesa, PDO::PARAM_STR);
        $consulta->execute();

        return $consulta->fetchObject('Mesa');
    }

    public static function modificarMesa($mesa)
    {
        $objAccesoDato = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDato->prepararConsulta("UPDATE mesas SET idEstadoMesa = :idEstadoMesa WHERE codigoMesa = :codigoMesa");
        $consulta->bindValue(':idEstadoMesa', $mesa->idEstadoMesa, PDO::PARAM_INT);
        $consulta->bindValue(':codigoMesa', $mesa->codigoMesa, PDO::PARAM_INT);
        $consulta->execute(); 
    }

    public static function borrarMesa($mesa)
    {
        $objAccesoDato = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDato->prepararConsulta("DELETE FROM mesas WHERE id = :id");
        $consulta->bindValue(':id', $mesa, PDO::PARAM_INT);
        $consulta->execute();
    }
}
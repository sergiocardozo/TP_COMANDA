<?php

class Pedido
{
    public $id;
    public $idEstadoPedido;
    public $codigoPedido;
    public $codigoMesa;
    public $idUsuario;
    public $producto;
    public $nombreCliente;
    public $imagen;
    public $tiempo;

    public function crearPedido()
    {
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta("INSERT INTO pedidos (idEstadoPedido, codigoPedido, codigoMesa, idUsuario, producto, nombreCliente, imagen, tiempo) VALUES (:idEstadoPedido, :codigoPedido, :codigoMesa, :idUsuario, :producto, :nombreCliente, :imagen, :tiempo)");
        $consulta->bindValue(':idEstadoPedido', $this->idEstadoPedido, PDO::PARAM_INT);
        $consulta->bindValue(':codigoPedido', $this->codigoPedido, PDO::PARAM_STR);
        $consulta->bindValue(':codigoMesa', $this->codigoMesa, PDO::PARAM_STR);
        $consulta->bindValue(':idUsuario', $this->idUsuario, PDO::PARAM_INT);
        $consulta->bindValue(':producto', $this->producto, PDO::PARAM_STR);
        $consulta->bindValue(':nombreCliente', $this->nombreCliente, PDO::PARAM_STR);
        $consulta->bindValue(':imagen', $this->imagen, PDO::PARAM_STR);
        $consulta->bindValue(':tiempo', $this->tiempo, PDO::PARAM_INT);
        $consulta->execute();

        return $objAccesoDatos->obtenerUltimoId();
    }

    public static function obtenerTodos()
    {
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta("SELECT * FROM pedidos");
        $consulta->execute();

        return $consulta->fetchAll(PDO::FETCH_CLASS, 'Pedido');
    }

    public static function obtenerPedido($pedido)
    {
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta("SELECT * FROM pedidos WHERE nombreCliente = :nombreCliente");
        $consulta->bindValue(':nombreCliente', $pedido, PDO::PARAM_STR);
        $consulta->execute();

        return $consulta->fetchObject('Pedido');
    }

    public static function modificarPedido($pedido)
    {
        $objAccesoDato = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDato->prepararConsulta("UPDATE pedidos SET idEstadoPedido = :idEstadoPedido, codigoMesa = :codigoMesa, idUsuario = :idUsuario, producto = :producto WHERE codigoPedido = :codigoPedido");
        $consulta->bindValue(':idEstadoPedido', $pedido->idEstadoPedido, PDO::PARAM_INT);
        $consulta->bindValue(':codigoMesa', $pedido->codigoMesa, PDO::PARAM_STR);
        $consulta->bindValue(':idUsuario', $pedido->idUsuario, PDO::PARAM_INT);
        $consulta->bindValue(':producto', $pedido->producto, PDO::PARAM_STR);
        $consulta->bindValue(':codigoPedido', $pedido->codigoPedido, PDO::PARAM_STR);
        $consulta->execute(); 
    }

    public static function borrarPedido($pedido)
    {
        $objAccesoDato = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDato->prepararConsulta("DELETE FROM pedidos WHERE id = :id");
        $consulta->bindValue(':id', $pedido, PDO::PARAM_INT);
        $consulta->execute();
    }
}
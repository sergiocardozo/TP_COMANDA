<?php

class Productos_pedidos {
    public $id;
    public $codigoPedido;
    public $idProducto;
    public $estadoProducto;

    public function crearPedidoProducto() {
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta("INSERT INTO productos_pedidos (codigoPedido, idProducto, estadoProducto) VALUES (:codigoPedido, :idProducto, :estadoProducto)");
        $consulta->bindValue(':codigoPedido', $this->codigoPedido, PDO::PARAM_STR);
        $consulta->bindValue(':idProducto', $this->idProducto, PDO::PARAM_INT);
        $consulta->bindValue(':estadoProducto', $this->estadoProducto, PDO::PARAM_STR);
        
        $consulta->execute();

        return $objAccesoDatos->obtenerUltimoId();
    }
}
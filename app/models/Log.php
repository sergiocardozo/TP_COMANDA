<?php

class Log {
    public $usuario;
    public $ruta;
    public $metodo;
    public $ip;

    public function CrearLog() {
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta("INSERT INTO logs(usuario, ruta, metodo, ip) VALUES (:usuario, :ruta, :metodo, :ip)");
        $consulta->bindValue(':usuario', $this->usuario, PDO::PARAM_STR);
        $consulta->bindValue(':ruta', $this->ruta, PDO::PARAM_STR);
        $consulta->bindValue(':metodo', $this->metodo, PDO::PARAM_STR);
        $consulta->bindValue(':ip', $this->ip, PDO::PARAM_STR);
        $consulta->execute();
        return $objAccesoDatos->obtenerUltimoId();
    }
}
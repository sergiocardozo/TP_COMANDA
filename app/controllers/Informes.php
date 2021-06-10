<?php
require __DIR__ . '/Clases/FileManager.php';
require_once __DIR__ . './ManejoArchivos.php';

use App\Models\Log;
use \App\Models\Pedido;
use App\Models\Venta;

class Informes
{

    public function TraerMesaMasUsada($request, $response, $args)
    {
        $mesasIguales = false;
        $codigoMesa = [];
        $mayor = 0;
        $mesaMasUsada = "";
        $pedidos = Pedido::all();
        foreach ($pedidos as $pedido) {
            array_push($codigoMesa, $pedido->codigoMesa);
        }

        $valores = array_count_values($codigoMesa);

        foreach ($valores as $key => $value) {
            if ($value > $mayor) {
                $mayor = $value;
                $mesaMasUsada = $key;
                $mesasIguales = false;
            } elseif ($value == $mayor) {
                $mesasIguales = true;
            }
        }
        if ($mesasIguales == false) {
            $payload = json_encode(array("mensaje" => "La mesa mas usada es: " . $mesaMasUsada));
        } else {
            $payload = json_encode(array("mensaje" => "No hay una mesa que se haya usado mas que la otra"));
        }
        $response->getBody()->write($payload);
        return $response
            ->withHeader('Content-Type', 'application/json');
    }
    public function TraerMesaMenosUsada($request, $response, $args)
    {
        $mesasIguales = false;
        $primerVuelta = true;
        $codigosMesa = [];
        $menor = "";
        $mesaMenosUsada = "";
        $pedidos = Pedido::all();
        foreach ($pedidos as $pedido) {
            array_push($codigosMesa, $pedido->codigoMesa);
        }

        $valores = array_count_values($codigosMesa);

        foreach ($valores as $key => $value) {
            if ($value < $menor || $primerVuelta == true) {
                $menor = $value;
                $mesaMenosUsada = $key;
                $primerVuelta = false;
                $mesasIguales = false;
            } elseif ($value == $menor) {
                $mesasIguales = true;
            }
        }
        if ($mesasIguales == false) {
            $payload = json_encode(array("mensaje" => "La mesa mas usada es: " . $mesaMenosUsada));
        } else {
            $payload = json_encode(array("mensaje" => "No hay una mesa que se haya usado mas que la otra"));
        }
        $response->getBody()->write($payload);
        return $response
            ->withHeader('Content-Type', 'application/json');
    }
    public function TraerMesaConElMayorImporte($request, $response, $args)
    {
        $mesasIguales = false;
        $mayor = 0;
        $mesaQueMasFacturo = "";
        $venta = Venta::all();

        foreach ($venta as $value) {
            if ($value->precioTotal > $mayor) {
                $mayor = $value->precioTotal;
                $mesaQueMasFacturo = $value->mesa;
                $mesasIguales = false;
            } elseif ($value->precioTotal == $mayor) {
                $mesasIguales = true;
            }
        }
        if ($mesasIguales == false) {
            $payload = json_encode(array("La mesa que mas facturo es la: " . $mesaQueMasFacturo . " y la cantidad es de: " . $mayor));
        } else {
            $payload = json_encode(array("No hay una mesa que haya facturado mas que la otra"));
        }
        $response->getBody()->write($payload);
        return $response
            ->withHeader('Content-Type', 'application/json');
    }
    public function TraerMesaConElMenorImporte($request, $response, $args)
    {
        $primerVuelta = true;
        $mesasIguales = false;
        $menor = "";
        $mesaQueMenosFacturo = "";
        $venta = Venta::all();

        foreach ($venta as $value) {
            if ($value->precioTotal < $menor || $primerVuelta == true) {
                $menor = $value->precioTotal;
                $mesaQueMenosFacturo = $value->mesa;
                $mesasIguales = false;
                $primerVuelta = false;
            } elseif ($value->precioTotal == $menor) {
                $mesasIguales = true;
            }
        }
        if ($mesasIguales == false) {
            $payload = json_encode(array("La mesa que mas facturo es la: " . $mesaQueMenosFacturo . " y la cantidad es de: " . $menor));
        } else {
            $payload = json_encode(array("No hay una mesa que haya facturado menos que la otra"));
        }
        $response->getBody()->write($payload);
        return $response
            ->withHeader('Content-Type', 'application/json');
    }
    public function TraerTodosLogs($request, $response, $args)
    {
        $lista = Log::all();
        if (count($lista) > 0) {
            FileManager::guardarJson($lista, './archivos/logs.csv');
            $payload = json_encode(array("mensaje" => "archivo guardado /archivos/logs.csv"));
        } else {
            $payload = json_encode(array("mensaje" => "No hubo movimientos"));
        }

        $response->getBody()->write($payload);
        return $response
            ->withHeader('Content-Type', 'application/json');
    }
    public function TraerTodasVentas($request, $response, $args)
    {
        $lista = Venta::all();
        $payload = json_encode(array("listaVenta" => $lista));
    
        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json');
    }
    public function GenerarPDF($request, $response, $args)
    {
        
        
    }
}

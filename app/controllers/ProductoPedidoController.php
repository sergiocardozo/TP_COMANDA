<?php 

use \App\Models\Productos_pedidos;
use \App\Models\Producto;


require_once './models/Productos_pedidos.php';
require_once './models/Producto.php';
require_once './interfaces/IApiUsable.php';

class ProductoPedidoController {
    public static function CambiarEstado($codigo, $encargado, $estadoInicial, $estadoactual)
    {
        $ret = false;
        $data = Productos_pedidos::where('estadoProducto', '=', $estadoInicial)
            ->where('codigoPedido', '=', $codigo)
            ->get();
        foreach ($data as $value) {
            $prod = Producto::where('id', '=', $value->idProducto)->first();
            if($encargado == "Socio")
            {
                $value->idEstadoProducto = $estadoactual;
                $value->save();
                $ret = true;  
            }
            else if ($prod->rol == $encargado) {
                $value->estadoProducto = $estadoactual;
                $value->save();
                $ret = true;
            }
        }
        return $ret;
    }
}
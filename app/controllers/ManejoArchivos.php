<?php

use App\Models\Pedido;
use App\Models\Productos_pedidos;
use App\Models\Usuario;
use App\Models\Venta;
use Fpdf\Fpdf;
use Illuminate\Support\Facades\Date;


class ManejoArchivos
{

    public function DescargaPDF($request, $response, $args)
    {
        $parametros = $request->getParsedBody();
        $codigoPedido = $parametros['codigoPedido'];

        $pedido = Pedido::where('codigoPedido', '=', $codigoPedido)->first();
        if ($pedido != null) {
            $productos = Productos_pedidos::join('productos', 'productos.id', 'productos_pedidos.idProducto')
                ->where('codigoPedido', '=', $parametros['codigoPedido'])->get();

            $usuarioPedido = Usuario::where('id', '=', $pedido->idUsuario)->first();

            $datos = Venta::where('codigoPedido', '=', $parametros['codigoPedido'])->first();

            $pdf = new FPDF('P', 'mm', array(80, 150));
            $pdf->AddPage();
            $pdf->SetFont('Helvetica', 'B', 12);
            $pdf->Cell(60, 4, 'Trabajo Practico Comanda', 0, 1, 'C');
            $pdf->SetFont('Helvetica', '', 8);
            $pdf->Cell(60, 4, 'Socio: ' . $usuarioPedido->usuario, 0, 1, 'C');
            $pdf->Cell(60, 4, 'C.P.: 1846 Buenos Aires, Adrogue', 0, 1, 'C');
            $pdf->Cell(60, 4, '999 888 777', 0, 1, 'C');
            $pdf->Cell(60, 4, 'scardozo.sc@gmail.com', 0, 1, 'C');

            // DATOS FACTURA        
            $pdf->Ln(5);
            $pdf->Cell(60, 4, 'Codigo Pedido: ' . $datos->codigoPedido, 0, 1, '');
            $pdf->Cell(60, 4, 'Fecha: ' . date("Y-m-d h:i:sa"), 0, 1, '');

            // COLUMNAS
            $pdf->SetFont('Helvetica', 'B', 7);
            $pdf->Cell(30, 10, 'Producto', 0);
            $pdf->Cell(10, 10, 'Precio', 0, 0, 'R');
            $pdf->Cell(15, 10, 'Total', 0, 0, 'R');
            $pdf->Ln(8);
            $pdf->Cell(60, 0, '', 'T');
            $pdf->Ln(3);

            foreach ($productos as $producto) {
                $pdf->Ln(1);

                $pdf->SetFont('Helvetica', '', 7);
                $pdf->Cell(30, 4, $producto->descripcion);
                $pdf->Cell(7, 4, $producto->precio, 0, 0, 'R');
                $pdf->Cell(17, 4, $producto->precio, 0, 0, 'R');
                $pdf->ln(3);
            }

            $pdf->Ln(6);
            $pdf->Cell(60, 0, '', 'T');
            $pdf->Ln(2);
            $pdf->Cell(25, 10, 'TOTAL: ', 0);
            $pdf->Cell(20, 10, '', 0);
            $pdf->Cell(10, 10, $datos->precioTotal, 0, 0, 'R');
            
            $pdf->Ln(15);
            $pdf->Cell(55, 0, 'GRACIAS POR ELEGIRNOS VUELVA PRONTO!', 0, 1, 'C');
            $pdf->Ln(3);
            $pdf->Output('F', './archivos/ticket'.$datos->codigoPedido.'.pdf', 'I');
            $payload = json_encode(array("mensaje"));


            $response->getBody()->write($payload);
            return $response
                ->withHeader('Content-Type', 'application/json');
        }
    }
}

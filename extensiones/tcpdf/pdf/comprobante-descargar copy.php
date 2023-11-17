<?php

require_once "../../../controladores/ventas.controlador.php";
require_once "../../../modelos/ventas.modelo.php";

require_once "../../../controladores/clientes.controlador.php";
require_once "../../../modelos/clientes.modelo.php";

require_once "../../../controladores/usuarios.controlador.php";
require_once "../../../modelos/usuarios.modelo.php";

require_once "../../../controladores/productos.controlador.php";
require_once "../../../modelos/productos.modelo.php";

class imprimirFactura{

public $codigo;

public function traerImpresionFactura(){

//TRAEMOS LA INFORMACIÓN DE LA VENTA

$itemVenta = "codigo";
$valorVenta = $this->codigo;

$respuestaVenta = ControladorVentas::ctrMostrarVentas($itemVenta, $valorVenta);

$fecha = substr($respuestaVenta["fecha"], 0);
$fechaFormateada = date("Y-m-d h:i:s A", strtotime($fecha));
$productos = json_decode($respuestaVenta["cantidadproductos"], true);
$total = number_format($respuestaVenta["total"],2);
$mensajeqr= $respuestaVenta ["qr"];

$observacion= $respuestaVenta["observacion"];



$suma = 0;


foreach ($productos as $key => $item) {
    $suma += $item["cantidad"];
}

$valorVenta2 = $valorVenta + ($suma - 1);



//TRAEMOS LA INFORMACIÓN DEL CLIENTE

$itemCliente = "idcliente";
$valorCliente = $respuestaVenta["idcliente"];

$respuestaCliente = ControladorClientes::ctrMostrarClientes($itemCliente, $valorCliente);

//TRAEMOS LA INFORMACIÓN DEL VENDEDOR

$itemVendedor = "idusuario";
$valorVendedor = $respuestaVenta["idvendedor"];

$respuestaVendedor = ControladorUsuarios::ctrMostrarUsuarios($itemVendedor, $valorVendedor);

//REQUERIMOS LA CLASE TCPDF

require_once('tcpdf_include.php');

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->startPageGroup();

$pdf->AddPage();

// ---------------------------------------------------------

$bloque1 = <<<EOF

	<table>
	<h1>Festival Viva Perú 2023 - 28 de Julio</h1>
	<p style="font-size: 16px; margin-bottom: 10px;">¡No te pierdas el evento del año!</p>
		
	<hr style="border: 1px solid #ccc; margin: 20px auto; width: 50%;">
		<tr>
		
			<td>
			
			<div style="font-size: 14px; text-align: left;">
				<strong>Productora:</strong> Conecta Producciones<br>
				<strong>Teléfono:</strong> +51935776619 <br>
				<strong>Correo:</strong> conectatv23@gmail.com <br>
			</div>
		
			</td>

			<td>
				<strong>Fecha de Ticket:</strong> $fechaFormateada 
			</td>
		</tr>
	</table>

EOF;

$pdf->writeHTML($bloque1, false, false, false, false, '');

// ---------------------------------------------------------

$bloque2 = <<<EOF

	<table>
	
	</table>

	<table style="font-size:10px; padding:5px 10px;">
	
		<tr>
		
			<td style="border: 1px solid #666; background-color:white; width:390px">

				<strong>Cliente:</strong> $respuestaCliente[nombre] - $respuestaCliente[dni]<br>
				<strong>Vendedor:</strong> $respuestaVendedor[nombre] <br>
				<strong>Lugar:</strong> Explanada del Estadio San Marcos
			</td>
			<td>
				<strong>Entrada Serie:</strong> $valorVenta hasta: $valorVenta2  <br>
				<strong>Observación:</strong>$observacion <br>
				<strong>Fecha:</strong> 28 de Julio 2023 - Desde las 11:00 am
			</td>

			<hr style="border: 1px solid #ccc; margin: 20px auto; width: 50%;">

		</tr>

		<tr>
		
		<td style="border-bottom: 1px solid #666; background-color:white; width:540px"></td>

		</tr>

	</table>

EOF;

$pdf->writeHTML($bloque2, false, false, false, false, '');

// ---------------------------------------------------------

$bloque3 = <<<EOF

	<table style="font-size:10px; padding:5px 10px;">

		<tr>
		
		<td style="border: 1px solid #666; background-color:white; width:260px; text-align:center"><strong>Tipo Entrada</strong></td>
		<td style="border: 1px solid #666; background-color:white; width:80px; text-align:center"><strong>Cantidad</strong></td>
		<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center"><strong>Valor Unidad.</strong></td>
		<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center"><strong>Valor Total</strong></td>

		</tr>

	</table>

EOF;

$pdf->writeHTML($bloque3, false, false, false, false, '');

// ---------------------------------------------------------

foreach ($productos as $key => $item) {
    $itemProducto = "descripcion";
    $valorProducto = $item["descripcion"];
    $orden = null;

    $respuestaProducto = ControladorProductos::ctrMostrarProductos($itemProducto, $valorProducto, $orden);

    $valorUnitario = number_format($respuestaProducto["precio_venta"], 2);

    $precioTotal = number_format($item["total"], 2);

    if ($precioTotal == 0) {
        $precioTotalTexto = "Gratuito";
    } else {
        $precioTotalTexto = "S/. " . $precioTotal;
    }

    $bloque4 = <<<EOF
    <table style="font-size:10px; padding:5px 10px;">
        <tr>
            <td style="border: 1px solid #666; color:#333; background-color:white; width:260px; text-align:center">
                $item[descripcion]
            </td>
            <td style="border: 1px solid #666; color:#333; background-color:white; width:80px; text-align:center">
                $item[cantidad]
            </td>
            <td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">
                $valorUnitario
            </td>
            <td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">
                $precioTotalTexto
            </td>
        </tr>
    </table>
EOF;

    $pdf->writeHTML($bloque4, false, false, false, false, '');
}


// ---------------------------------------------------------

$bloque5 = <<<EOF

	<table style="font-size:10px; padding:5px 10px;">

		<tr>

			<td style="color:#333; background-color:white; width:340px; text-align:center"></td>

			<td style="border-bottom: 1px solid #666; background-color:white; width:100px; text-align:center"></td>

			<td style="border-bottom: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center"></td>

		</tr>
		

		<tr>
		
			<td style="border-right: 1px solid #666; color:#333; background-color:white; width:340px; text-align:center"></td>

			<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">
				Total:
			</td>
			
			<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">
				S/. $total
			</td>

		</tr>


	</table>

	EOF;

$pdf->writeHTML($bloque5, false, false, false, false, '');

// ---------------------------------------------------------



// set style for barcode
$style = array(
    'border' => false,
    'vpadding' => '3',
    'hpadding' => '3',
    'fgcolor' => array(0,0,0),
    'bgcolor' => false, //array(255,255,255)
    'module_width' => 1, // width of a single module in points
    'module_height' => 1 // height of a single module in points
);

$QR = $mensajeqr;

$pdf->write2DBarcode($QR, 'QRCODE,L', 140,9, 30, 30, $style);
//$pdf->Text(20, 25, 'QRCODE L');

// ---------------------------------------------------------
//SALIDA DEL ARCHIVO 

//$pdf->Output('factura.pdf', 'D');
$nombreCliente = $respuestaCliente['dni'] . '-' . $respuestaCliente['nombre'];
$nombreVendedor = $respuestaVendedor['nombre'];

$pdf->Output('COD' . $valorVenta . '-COD' . $valorVenta2 . '-' . $nombreCliente . '.pdf');

}

}

$factura = new imprimirFactura();
$factura -> codigo = $_GET["codigo"];
$factura -> traerImpresionFactura();

?>
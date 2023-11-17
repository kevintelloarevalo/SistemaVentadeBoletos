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


foreach ($productos as $key => $item) {
    $itemProducto = "descripcion";
    $valorProducto = $item["descripcion"];
    $orden = null;

    $respuestaProducto = ControladorProductos::ctrMostrarProductos($itemProducto, $valorProducto, $orden);

    $valorUnitario = number_format($respuestaProducto["precio_venta"], 2);

    $precioTotal = number_format($item["total"], 2);

    if ($precioTotal == 0) {
        $precioTotalTexto = "Gratuito-Cortesía";
    } else {
        $precioTotalTexto = "S/. " . $precioTotal;
    }

}


// ---------------------------------------------------------


$pdf->SetFont('helvetica', 'B', 25);
$pdf->SetTextColor(0, 0, 0); // Negro

// Fila 1: Festival Viva el Perú en grande

$pdf->SetFillColor(232, 2, 9); // Color de Borde
$pdf->SetXY(10, 10); // Alinear a la derecha de la columna 1, debajo de la barra de separación
$pdf->Cell(140, 8, ' ', 0, 0, 'A',true);

$pdf->SetTextColor(0, 0, 0); // Negro LETRAS
$pdf->SetFillColor(255, 255, 255); // Color de fondo Roj0
$pdf->SetXY(10, 18); // Alinear a la derecha de la columna 1, debajo de la barra de separación
$pdf->Cell(140, 12, ' FESTIVAL', 0, 0, 'A',true);

$pdf->SetXY(10, 28); // Ajustar la posición XY para el contenido
$pdf->Cell(140, 20, ' VIVA EL PERÚ', 0, 1, 'A',true);


$pdf->SetFillColor(232, 2, 9);  // Color de Borde
$pdf->SetXY(10, 43); // Alinear a la derecha de la columna 1, debajo de la barra de separación
$pdf->Cell(140, 8, ' ', 0, 0, 'A',true);

// Una barra paralela que divide las filas (vertical)
$pdf->SetFillColor(255, 0, 0); // Rojo
$pdf->Rect(82, 18, 0.8, 25, 'F'); // Dibujar la barra de separación vertical

$pdf->SetFont('helvetica', '', 12);
$pdf->SetTextColor(0, 0, 0); // Negro LETRAS

// Fila 2: Viernes 28 de Julio 2023 / 11:00 AM

$pdf->SetXY(85, 17); // Alinear a la derecha de la columna 1, debajo de la barra de separación
$pdf->Cell(0, 10, 'Viernes 28 de Julio 2023', 0, 1, 'A');

$pdf->SetXY(85, 22); // Ajustar la posición XY para el contenido
$pdf->Cell(0, 10, '/11:00 AM', 0, 1, 'A');

$pdf->SetXY(84, 30); // Ajustar la posición XY para el contenido
$pdf->Cell(0, 10, ' EXPLANADA DEL ESTADIO', 0, 1, 'A');

$pdf->SetXY(84, 34); // Ajustar la posición XY para el contenido
$pdf->Cell(0, 10, ' SAN MARCOS', 0, 1, 'A');

// Fila 3: Código QR (Espacio reservado)
$pdf->SetXY(10, 12); // Posicionar en la columna 1
$pdf->Cell(0, 30, '', 0, 1); //CELDA

//Nº DE Ticket
$pdf->SetFont('helvetica', '', 6);
$pdf->SetTextColor(0, 0, 0); // Negro LETRAS
$pdf->SetXY(160, 45); // Ajustar la posición XY para el contenido
$pdf->Cell(0, 10, 'Nº Orden: ' . $valorVenta . ' - Hasta: ' . $valorVenta2, 0, 1, 'A');


// Agregar espacios en blanco debajo de la tabla
$pdf->Ln(2);

//$bloque1 = <<<EOF

	//<table>
		
	//<hr style="border: 1px solid #ccc; margin: 20px auto; width: 50%;">
		//<tr>
	
			//<td>
			
			//<div style="font-size: 14px; text-align: left;">
				//<strong>Productora:</strong> Conecta Producciones<br>
				//<strong></strong> $respuestaCliente[nombre]<br>
				//$precioTotalTexto
			//</div>
		
			//</td>

			//<td>
				//<strong>Fecha de Ticket:</strong> $fechaFormateada
				//<strong>Entrada Serie:</strong> $valorVenta<br>
				//<strong>Lugar:</strong> Explanada del Estadio San Marcos <br>
				//<strong>Fecha:</strong> 28 de Julio 2023 - Desde las 11:00 am
				
			//</td>
		//</tr>
	//<hr style="border: 1px solid #ccc; margin: 20px auto; width: 50%;">
	//</table>

//EOF;

//$pdf->writeHTML($bloque1, false, false, false, false, '');

// Agregar un bloque con color de fondo para el texto "YA TIENES TU E-TICKET!"
$pdf->SetFillColor(0, 48, 239); // Morado oscuro
$pdf->SetFont('helvetica', 'B', 19);
$pdf->SetTextColor(255, 255, 255); // Blanco

$pdf->Cell(0, 10, 'YA TIENES TU E-TICKET!', 0, 1, 'C', true);


// Agregar el texto "DISFRUTA DE LOS MEJORES ESPECTÁCULOS CON NOSOTROS"

$pdf->SetFont('helvetica', 'B', 8);
$pdf->SetTextColor(0, 0, 0); // Negro (color de texto por defecto)

$pdf->Cell(0, 10, 'DISFRUTA DE LOS MEJORES ESPECTÁCULOS CON NOSOTROS', 0, 1, 'C');

//TABLA DEL EVENTO

$pdf->SetFont('helvetica', 'B', 10);
$pdf->SetFillColor(0, 48, 239); // Morado oscuro
$pdf->SetTextColor(255, 255, 255); // Blanco

// Encabezados de la tabla
$pdf->SetDrawColor(255, 255, 255); // Blanco

$pdf->Cell(110, 7, 'Sector', 1, 0, 'L', true);
$pdf->Cell(40, 7, 'Fila', 1, 0, 'L', true);
$pdf->Cell(40, 7, 'Asiento', 1, 1, 'L', true);

$pdf->SetFont('helvetica', '', 8);
$pdf->SetTextColor(0, 0, 0); // Negro (color de texto por defecto)

// Valores de la tabla
$pdf->SetFillColor(230, 230, 230); // Gris
$pdf->Cell(110, 8, 'GENERAL                                                General: S/. 38.00   Niños: S/. 8.00', 1, 0, 'L', true); // Celda con color de fondo gris
$pdf->Cell(40, 8, '', 1, 0, 'L', true); // Celda vacía debajo de "GENERAL"
$pdf->Cell(40, 8, '', 1, 1, 'L', true); // Celda vacía debajo de "GENERAL"

$pdf->SetFillColor(230, 230, 230); // Gris  
$pdf->Cell(110, 6, 'Categoría: ' . $item['descripcion']          , 1, 0, 'L', true);
$pdf->Cell(40, 6, '', 1, 0, 'L', true); // Celda con color de fondo gris
$pdf->Cell(40, 6, '', 1, 1, 'L', true); // Celda vacía debajo de "Asiento"

// Agregar espacios en blanco debajo de la tabla
$pdf->Ln(2);



// Agregar información adicional
$pdf->SetFont('helvetica', 'B', 10);
$pdf->SetTextColor(128, 0, 128); // Morado oscuro

$pdf->Cell(30, 10, 'Evento:', 0, 0, 'L');
$pdf->SetTextColor(0, 0, 0); // Negro (color de texto por defecto)
$pdf->SetX($pdf->GetX() - 15); // Ajustar la posición X para alinear con el contenido
$pdf->Cell(0, 10, 'Festival Viva el Perú', 0, 1, 'L');

$pdf->SetTextColor(128, 0, 128); // Morado oscuro
$pdf->Cell(30, 10, 'Produce:', 0, 0, 'L');
$pdf->SetTextColor(0, 0, 0); // Negro (color de texto por defecto)
$pdf->SetX($pdf->GetX() - 10); // Ajustar la posición X para alinear con el contenido
$pdf->Cell(0, 10, 'Conecta Producciones', 0, 1, 'L');

$pdf->SetTextColor(128, 0, 128); // Morado oscuro
$pdf->SetXY(10, 120); // Posicionar en la columna 1
$pdf->Cell(30, 10, 'Ruc:', 0, 0, 'L');
$pdf->SetTextColor(0, 0, 0); // Negro (color de texto por defecto)
$pdf->Cell(0, 10, '20607506044', 0, 1, 'L');

$pdf->SetTextColor(128, 0, 128); // Morado oscuro
$pdf->SetXY(110, 100); // Posicionar en la columna 1
$pdf->Cell(30, 10, 'Fecha Nº Orden:', 0, 0, 'L');
$pdf->SetTextColor(0, 0, 0); // Negro (color de texto por defecto)
$pdf->SetXY(139, 100); // Posicionar en la columna 1
$pdf->Cell(0, 10, ''. $fechaFormateada, 0, 1, 'L');

$pdf->SetTextColor(128, 0, 128); // Morado oscuro
$pdf->SetXY(110, 110); // Posicionar en la columna 1
$pdf->Cell(30, 10, 'Cliente:', 0, 0, 'L');
$pdf->SetTextColor(0, 0, 0); // Negro (color de texto por defecto)

$pdf->SetX($pdf->GetX() - 15); // Ajustar la posición X para alinear con el contenido
$pdf->Cell(0, 10, $respuestaCliente['nombre'] . '' . $respuestaCliente['apellido'], 0, 1, 'L');

$pdf->SetTextColor(128, 0, 128); // Morado oscuro
$pdf->SetXY(110, 120); // Posicionar en la columna 1
$pdf->Cell(30, 10, 'Precio:', 0, 0, 'L');
$pdf->SetTextColor(0, 0, 0); // Negro (color de texto por defecto)

$pdf->SetX($pdf->GetX() - 15); // Ajustar la posición X para alinear con el contenido
$pdf->Cell(0, 10, '' . $precioTotalTexto, 0, 1, 'L');


// Agregar un bloque con color de fondo para el texto "IMPORTANTE"
// Agregar espacios en blanco debajo de la tabla
$pdf->Ln(10);

$pdf->SetFillColor(255, 255, 255); // Blanco
$pdf->SetFont('helvetica', 'B', 12);
$pdf->SetTextColor(255, 0, 0); // Rojo

$pdf->Cell(0, 10, 'IMPORTANTE', 0, 1, 'A', true);

$pdf->SetFont('helvetica', '', 7);
$pdf->SetFillColor(255, 255, 255); // Blanco
$pdf->SetTextColor(155, 155, 155); // Plomo (color de texto por defecto)

$contenido = "El E-ticket es un comprobante válido de tu compra, por lo que no será canjeado por una entrada tradicional en el punto de venta o boletería.\n".
    "En caso tu e-ticket haya sido sustraído o replicado, Conecta Producciones no asume ninguna responsabilidad ni está obligada a expedir un nuevo e-ticket o efectuar la devolución del costo del mismo. Al elegir E-ticket, estás aceptando no divulgar el ticket, ni compartirlo con terceros, ya que esto podría afectar tu ingreso al evento.\n".
    "Con el E-ticket puedes acercarte directamente al evento portando una copia impresa y legible o, de manera virtual desde tu celular, la cual será escaneada para el acceso.\n".
    "El ingreso después de la hora señalada en la entrada está sujeto a las reglas del Organizador y del establecimiento donde se llevará a cabo el evento. El día del evento, al ingresar al establecimiento, el público podrá estar sujeto a verificaciones adicionales por razones de seguridad, de acuerdo a lo establecido por el organizador o la autoridad correspondiente. Conecta Producciones no tiene injerencia en la determinación de las condiciones de seguridad del establecimiento, las que serán de exclusiva responsabilidad del organizador.\n".
    "En caso de detectarse indicios de falsificación de entradas, el organizador podrá NO AUTORIZAR el ingreso al recinto. Conecta Producciones no se hace responsable por Tickets adquiridos en puntos de ventas no oficiales. En caso estos sean falsos o adulterados, no se permitirá el ingreso al evento.";

$pdf->SetXY(10, 148); // Ajustar la posición XY para el contenido
$pdf->MultiCell(0, 5, $contenido, 0, 'L', false);

// ---------------------------------------------------------


$bloque2 = <<<EOF

	<table>

	</table>

EOF;

$pdf->writeHTML($bloque2, false, false, false, false, '');

// ---------------------------------------------------------

//$bloque3 = <<<EOF

	//<table style="font-size:10px; padding:5px 10px;">

		//<tr>
		//<hr style="border: 1px solid #ccc; margin: 20px auto; width: 50%;">
		//<td style="border: 1px solid #666; background-color:white; width:260px; text-align:center"><strong>Tipo Entrada</strong></td>
		//<td style="border: 1px solid #666; background-color:white; width:80px; text-align:center"><strong>Cantidad</strong></td>
		//<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center"><strong>Valor Unidad.</strong></td>
		//</tr>

	//</table>

//EOF;

//$pdf->writeHTML($bloque3, false, false, false, false, '');

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

    //$bloque4 = <<<EOF
   // <table style="font-size:10px; padding:5px 10px;">
      //  <tr>
        //    <td style="border: 1px solid #666; color:#333; background-color:white; width:260px; text-align:center">
        //        $item[descripcion]
        //    </td>
        //    <td style="border: 1px solid #666; color:#333; background-color:white; width:80px; text-align:center">
        //        $item[cantidad]
        //    </td>
         //   <td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">
          //      $valorUnitario
          //  </td>
         //   <td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">
        //        $precioTotalTexto
        //    </td>
      //  </tr>
    //</table>
//EOF;

   // $pdf->writeHTML($bloque4, false, false, false, false, '');
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

			<!-----
			<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">
				Total:
			</td>
			
			<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">
				S/. $total
			</td>
			--->
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

$pdf->write2DBarcode($QR, 'QRCODE,L', 155,10, 40, 40, $style);
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
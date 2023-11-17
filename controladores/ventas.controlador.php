<?php
class ControladorVentas{

/*=============================================
MOSTRAR VENTAS
=============================================*/

static public function ctrMostrarVentas($item, $valor){

    $tabla = "ventas";

    $respuesta = ModeloVentas::mdlMostrarVentas($tabla, $item, $valor);

    return $respuesta;

}



/*=============================================
	CREAR VENTA
=============================================*/

	static public function ctrCrearVenta(){
		if(isset($_POST["nuevaVenta"])){

			/*=============================================
			 REDUCIR EL STOCK 
			=============================================*/

			if($_POST["listaProductos"] == ""){

					echo'<script>

				swal({
					  type: "error",
					  title: "La venta no se ha ejecuta si no hay productos",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "ventas";

								}
							})

				</script>';

				return;
			}


			$listaProductos = json_decode($_POST["listaProductos"], true);

			$totalProductosComprados = array();

			foreach ($listaProductos as $key => $value) {

				array_push($totalProductosComprados, $value["cantidad"]);
				 
				$tablaProductos = "productos";
 
				 $item = "idproducto";
				 $valor = $value["id"];
 
				 $traerProducto = ModeloProductos::mdlMostrarProductos($tablaProductos, $item, $valor);
 
				 $item1b = "stock";
				 $valor1b = $value["stock"];
 
				 $nuevoStock = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1b, $valor1b, $valor);
 
			 }

			/*=============================================
			GUARDAR LA COMPRA
			=============================================*/	

			$tabla = "ventas";

			$datos = array("idvendedor"=>$_POST["idVendedor"],
						   "idcliente"=>$_POST["seleccionarCliente"],
						   "codigo"=>$_POST["nuevaVenta"],
						   "cantidadproductos"=>$_POST["listaProductos"],
						   "total"=>$_POST["totalVenta"],
						   "metodo_pago"=>$_POST["listaMetodoPago"],
						   "observacion"=>$_POST["nuevaObservacion"],
						   "seguimiento"=>$_POST["nuevoSeguimiento"],
						   "qr"=>$_POST["qr"]);
						   

			$respuesta = ModeloVentas::mdlIngresarVenta($tabla, $datos);

			if($respuesta == "ok"){
	
				echo'<script>

				swal({
					  type: "success",
					  title: "La venta ha sido guardada correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "ventas";

								}
							})

				</script>';

			}

		}

}



/*=============================================
	EDITAAR VENTA 
=============================================*/

	static public function ctrEditarVenta(){
		
		if(isset($_POST["editarVenta"])){

			/*=============================================
			FORMATEAR TABLA DE PRODUCTOS Y LA DE CLIENTES
			=============================================*/
			$tabla = "ventas";

			$item = "codigo";
			$valor = $_POST["editarVenta"];

			$traerVenta = ModeloVentas::mdlMostrarVentas($tabla, $item, $valor);

			/*=============================================
			REVISAR SI VIENE PRODUCTOS EDITADOS
			=============================================*/

			if($_POST["listaProductos"] == ""){

				$listaProductos = $traerVenta["cantidadproductos"]; // le pasamos el json de Cantidad de productos de esa venta
				$cambioProducto = false;


			}else{

				$listaProductos = $_POST["listaProductos"];
				$cambioProducto = true;
			}

			if($cambioProducto){

				$productos =  json_decode($traerVenta["cantidadproductos"], true);

				$totalProductosComprados = array();

				foreach ($productos as $key => $value) {

					array_push($totalProductosComprados, $value["cantidad"]);
					
					$tablaProductos = "productos";

					$item = "idproducto";
					$valor = $value["id"];

					$traerProducto = ModeloProductos::mdlMostrarProductos($tablaProductos, $item, $valor);


					$item1b = "stock";
					$valor1b = $value["cantidad"] - $traerProducto["stock"];   // AQUI ES CUANDO QUEREMOS DEVOLVER EL STOCK POR EJEMPLO TENEMOS 5 Y SOLO QUISIMOS COMPRAR 4 DEVUELVE EL STOCK DEL PRODUCTO

					$nuevoStock = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1b, $valor1b, $valor);

				}

					$listaProductos_2 = json_decode($listaProductos, true);

					$totalProductosComprados_2 = array();

					foreach ($listaProductos_2 as $key => $value) {

						array_push($totalProductosComprados_2, $value["cantidad"]);  // le pasamos el json de Cantidad de productos de esa venta
						
						$tablaProductos_2 = "productos";

						$item_2 = "idproducto";
						$valor_2 = $value["id"];

						$traerProducto_2 = ModeloProductos::mdlMostrarProductos($tablaProductos_2, $item_2, $valor_2);

						$item1b_2= "stock";
						$valor1b_2 = $value["stock"];

						$nuevoStock = ModeloProductos::mdlActualizarProducto($tablaProductos_2, $item1b_2, $valor1b_2, $valor_2);

					}
				}
					/*=============================================
					EDITAR VENTA
					=============================================*/	

					$datos = array("idvendedor"=>$_POST["idVendedor"],
								"idcliente"=>$_POST["seleccionarCliente"],
								"codigo"=>$_POST["editarVenta"],
								"cantidadproductos"=>$listaProductos,
								"total"=>$_POST["totalVenta"],
								"metodo_pago"=>$_POST["listaMetodoPago"]);

					$respuesta = ModeloVentas::mdlEditarVenta($tabla, $datos);

						if($respuesta == "ok"){

							echo'<script>

							localStorage.removeItem("rango");

							swal({
								type: "success",
								title: "La venta ha sido editada correctamente",
								showConfirmButton: true,
								confirmButtonText: "Cerrar"
								}).then((result) => {
											if (result.value) {

											window.location = "ventas";

											}
										})

							</script>';

						}

		}
	}


	/*=============================================
	ELIMINAR VENTA
	=============================================*/

	static public function ctrEliminarVenta(){

			if(isset($_GET["idVenta"])){

				$tabla = "ventas";

				$item = "id";
				$valor = $_GET["idVenta"];

				$traerVenta = ModeloVentas::mdlMostrarVentas($tabla, $item, $valor);

				$itemVentas = null;
				$valorVentas = null;

				$traerVentas = ModeloVentas::mdlMostrarVentas($tabla, $itemVentas, $valorVentas);

				/*=============================================
				FORMATEAR TABLA DE PRODUCTOS 
				=============================================*/

				$productos =  json_decode($traerVenta["cantidadproductos"], true);  // le pasamos el json de Cantidad de productos de esa venta

				$totalProductosComprados = array();

				foreach ($productos as $key => $value) {

					array_push($totalProductosComprados, $value["cantidad"]);
					
					$tablaProductos = "productos";

					$item = "idproducto";
					$valor = $value["id"];

					$traerProducto = ModeloProductos::mdlMostrarProductos($tablaProductos, $item, $valor);

					$item1b = "stock";
					$valor1b = $value["cantidad"] + $traerProducto["stock"];

					$nuevoStock = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1b, $valor1b, $valor);

				}

				/*=============================================
				ELIMINAR VENTA
				=============================================*/

				$respuesta = ModeloVentas::mdlEliminarVenta($tabla, $_GET["idVenta"]);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						type: "success",
						title: "La venta ha sido borrada correctamente",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false
						}).then((result) => {
									if (result.value) {

									window.location = "ventas";

									}
								})

					</script>';

				}		
			}

	}

	/*=============================================
	RANGO FECHAS
	=============================================*/	

	static public function ctrRangoFechasVentas($fechaInicial, $fechaFinal){

		$tabla = "ventas";

		$respuesta = ModeloVentas::mdlRangoFechasVentas($tabla, $fechaInicial, $fechaFinal);

		return $respuesta;
		
	}
	
	/*=============================================
		SUMA TOTAL VENTAS
	=============================================*/

	static public function ctrSumaTotalVentas(){

			$tabla = "ventas";

			$respuesta = ModeloVentas::mdlSumaTotalVentas($tabla);

			return $respuesta;

		}
	
	/*=============================================
		EDITAR VENTAS seguimiento y observacion
	=============================================*/

	static public function ctrEditarVentaSeguimiento(){

		if(isset($_POST["editarSeguimiento"])){


			   	$tabla = "ventas";

			   	$datos = array("id"=>$_POST["idVenta"],
					           "seguimiento"=>$_POST["editarSeguimiento"],
					           "observacion"=>$_POST["editarObservacion"]);

			   	$respuesta = ModeloVentas::mdlEditarVenta2($tabla, $datos);

			   	if($respuesta == "ok"){  /*si se cumple todo muestra alerta */

					echo'<script>

					swal({
						  type: "success",
						  title: "Los datos fueron actualizados correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "ventas";

									}
								})

					</script>';

				}

				else{

					echo'<script>

						swal({
							type: "error",
							title: "¡El proveedor no puede ir vacío o llevar caracteres especiales!",
							showConfirmButton: true,
							confirmButtonText: "Cerrar"
							}).then(function(result){
								if (result.value) {

								window.location = "ventas";

								}
							})

					</script>';



				}

		}

	}

	/*=============================================
	DESCARGAR EXCEL
	=============================================*/

	public function ctrDescargarReporte(){

		if(isset($_GET["reporte"])){

			$tabla = "ventas";

			if(isset($_GET["fechaInicial"]) && isset($_GET["fechaFinal"])){

				$ventas = ModeloVentas::mdlRangoFechasVentas($tabla, $_GET["fechaInicial"], $_GET["fechaFinal"]);

			}else{

				$item = null;
				$valor = null;

				$ventas = ModeloVentas::mdlMostrarVentas($tabla, $item, $valor);

			}


			/*=============================================
			CREAMOS EL ARCHIVO DE EXCEL
			=============================================*/

			$Name = $_GET["reporte"].'.xls';  /*Nombre del archivo*/

			header('Expires: 0');
			header('Cache-control: private');
			header("Content-type: application/vnd.ms-excel"); // Archivo de Excel
			header("Cache-Control: cache, must-revalidate"); 
			header('Content-Description: File Transfer');
			header('Last-Modified: '.date('D, d M Y H:i:s'));
			header("Pragma: public"); 
			header('Content-Disposition:; filename="'.$Name.'"');
			header("Content-Transfer-Encoding: binary");
		
			echo utf8_decode("<table border='0'> 

					<tr> 
					<td style='font-weight:bold; border:1px solid #eee;'>CÓDIGO</td> 
					<td style='font-weight:bold; border:1px solid #eee;'>CLIENTE</td>
					<td style='font-weight:bold; border:1px solid #eee;'>VENDEDOR</td>
					<td style='font-weight:bold; border:1px solid #eee;'>N° ENTRADAS</td>
					<td style='font-weight:bold; border:1px solid #eee;'>TIPO ENTRADA</td>
					<td style='font-weight:bold; border:1px solid #eee;'>TOTAL</td>		
					<td style='font-weight:bold; border:1px solid #eee;'>PAGO</td	
					<td style='font-weight:bold; border:1px solid #eee;'>FECHA</td>
					<td style='font-weight:bold; border:1px solid #eee;'>QR</td>			
					</tr>");

			foreach ($ventas as $row => $item){

				$cliente = ControladorClientes::ctrMostrarClientes("idcliente", $item["idcliente"]);
				$vendedor = ControladorUsuarios::ctrMostrarUsuarios("idusuario", $item["idvendedor"]);

			 echo utf8_decode("<tr>
			 			<td style='border:1px solid #eee;'>".$item["codigo"]."</td> 
			 			<td style='border:1px solid #eee;'>".$cliente["nombre"]."</td>
			 			<td style='border:1px solid #eee;'>".$vendedor["nombre"]."</td>
			 			<td style='border:1px solid #eee;'>");

			 	$productos =  json_decode($item["cantidadproductos"], true);

			 	foreach ($productos as $key => $valueProductos) {
			 			
			 			echo utf8_decode($valueProductos["cantidad"]."<br>");
			 		}

			 	echo utf8_decode("</td><td style='border:1px solid #eee;'>");	

		 		foreach ($productos as $key => $valueProductos) {
			 			
		 			echo utf8_decode($valueProductos["descripcion"]."<br>");
		 		
		 		}

		 		echo utf8_decode("</td>	
					<td style='border:1px solid #eee;'>S/. ".number_format($item["total"],2)."</td>
					<td style='border:1px solid #eee;'>".$item["metodo_pago"]."</td>
					<td style='border:1px solid #eee;'>".substr($item["fecha"],0,10)."</td>		
					<td style='border:1px solid #eee;'>".$item["qr"]."</td>		
		 			</tr>");


			}


			echo "</table>";

		}

	}



}

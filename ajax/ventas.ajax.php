<?php

require_once "../controladores/ventas.controlador.php";
require_once "../modelos/ventas.modelo.php";

class AjaxVentas{

	/*=============================================
	EDITAR VENTA
	=============================================*/	

	public $idVenta;

	public function ajaxEditarVenta(){

		$item = "id";
		$valor = $this->idVenta;

		$respuesta = ControladorVentas::ctrMostrarVentas($item, $valor);

		echo json_encode($respuesta);


	}

}

/*=============================================
EDITAR VENTA
=============================================*/	

if(isset($_POST["idVenta"])){

	$empleado = new AjaxVentas();
	$empleado -> idVenta = $_POST["idVenta"];
	$empleado -> ajaxEditarVenta();

}
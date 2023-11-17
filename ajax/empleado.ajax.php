<?php

require_once "../controladores/empleado.controlador.php";
require_once "../modelos/empleados.modelo.php";

class AjaxEmpleados{

	/*=============================================
	EDITAR CLIENTE
	=============================================*/	

	public $idEmpleado;

	public function ajaxEditarEmpleado(){

		$item = "idempleado";
		$valor = $this->idEmpleado;

		$respuesta = ControladorEmpleados::ctrMostrarEmpleados($item, $valor);

		echo json_encode($respuesta);


	}

}

/*=============================================
EDITAR CLIENTE
=============================================*/	

if(isset($_POST["idEmpleado"])){

	$empleado = new AjaxEmpleados();
	$empleado -> idEmpleado = $_POST["idEmpleado"];
	$empleado -> ajaxEditarEmpleado();

}
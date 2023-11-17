<?php

class ControladorEmpleados{

	/*=============================================
	CREAR CLIENTES >>
	=============================================*/

	static public function ctrCrearEmpleado(){

		if(isset($_POST["nuevoEmpleado"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoEmpleado"]) &&
			   preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoApellido"]) &&
			   preg_match('/^[0-9{9}]+$/', $_POST["nuevoTelefono"]) && 
			   preg_match('/^[#\.\-a-zA-Z0-9 ]+$/', $_POST["nuevaDireccion"])){

			   	$tabla = "empleados";

			   	$datos = array("nombre"=>$_POST["nuevoEmpleado"],   /* recolecta información de los inputs del form */
				   			   "apellido"=>$_POST["nuevoApellido"],
							   "dni"=>$_POST["nuevoDocumentoId"], 
					           "telefono"=>$_POST["nuevoTelefono"],
							   "trabajo"=>$_POST["nuevoTrabajo"], 
							   "sueldo"=>$_POST["nuevoSueldo"], 
					           "direccion"=>$_POST["nuevaDireccion"],
					           "ciudad"=>$_POST["nuevaCiudad"]);

			   	$respuesta = ModeloEmpleados::mdlIngresarEmpleado($tabla, $datos);
 
			   	if($respuesta == "ok"){  /*si se cumple todo muestra alerta */

					echo'<script>

					swal({    
						  type: "success",
						  title: "El Empleado ha sido guardado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "empleados";

									}
								})

					</script>';

				}

			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡El proveedor no puede ir vacío o llevar caracteres incorrectos!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "empleados";

							}
						})

			  	</script>';



			}

		}

	}

	/*=============================================
	MOSTRAR PROVEEDORES>>
	=============================================*/

	static public function ctrMostrarEmpleados($item, $valor){

		$tabla = "empleados";

		$respuesta = ModeloEmpleados::mdlMostrarEmpleados($tabla, $item, $valor);

		return $respuesta;

	}

	/*=============================================
	EDITAR EMPLEADO
	=============================================*/

	static public function ctrEditarEmpleado(){

		if(isset($_POST["editarEmpleado"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarEmpleado"]) &&
			   preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarApellido"]) &&
			   preg_match('/^[()\-0-9 ]+$/', $_POST["editarTelefono"]) && 
			   preg_match('/^[#\.\-a-zA-Z0-9 ]+$/', $_POST["editarDireccion"])){

			   	$tabla = "empleados";

			   	$datos = array("idempleado"=>$_POST["idEmpleado"],
			   				   "nombre"=>$_POST["editarEmpleado"],
							   "apellido"=>$_POST["editarApellido"],
							   "dni"=>$_POST["editarDocumentoId"],
					           "telefono"=>$_POST["editarTelefono"],
							   "trabajo"=>$_POST["editarTrabajo"],
							   "sueldo"=>$_POST["editarSueldo"],
					           "direccion"=>$_POST["editarDireccion"],
					           "ciudad"=>$_POST["editarCiudad"]);

			   	$respuesta = ModeloEmpleados::mdlEditarEmpleado($tabla, $datos);

			   	if($respuesta == "ok"){  /*si se cumple todo muestra alerta */

					echo'<script>

					swal({
						  type: "success",
						  title: "El empleado ha sido cambiado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "empleados";

									}
								})

					</script>';

				}

			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡El empleado no puede ir vacío o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "empleados";

							}
						})

			  	</script>';



			}

		}

	}

	/*=============================================
	ELIMINAR EMPLEADO  >>
	=============================================*/

	static public function ctrEliminarEmpleado(){

		if(isset($_GET["idEmpleado"])){

			$tabla ="empleados";
			$datos = $_GET["idEmpleado"];

			$respuesta = ModeloEmpleados::mdlEliminarEmpleado($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "El Empleado ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar",
					  closeOnConfirm: false
					  }).then(function(result){
								if (result.value) {

								window.location = "empleados";

								}
							})

				</script>';

			}		

		}

	}

}
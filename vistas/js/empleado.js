/*=============================================
EDITAR EMPLEADO
=============================================*/
$(".tablas").on("click", ".btnEditarEmpleado", function(){

	var idCliente = $(this).attr("idEmpleado");

	var datos = new FormData();
    datos.append("idEmpleado", idCliente);

    $.ajax({

      url:"ajax/empleado.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType:"json",
      success:function(respuesta){
      
      	 $("#idEmpleado").val(respuesta["idempleado"]);
	       $("#editarEmpleado").val(respuesta["nombre"]);
         $("#editarApellido").val(respuesta["apellido"]);
	       $("#editarDocumentoId").val(respuesta["dni"]);
	       $("#editarTelefono").val(respuesta["telefono"]);
         $("#editarTrabajo").val(respuesta["trabajo"]);
         $("#editarSueldo").val(respuesta["sueldo"]);
	       $("#editarDireccion").val(respuesta["direccion"]);
         $("#editarCiudad").val(respuesta["ciudad"]);
	  }

  	})

})

/*=============================================
ELIMINAR CLIENTE
=============================================*/
$(".tablas").on("click", ".btnEliminarEmpleado", function(){

	var idCliente = $(this).attr("idEmpleado");
	
	swal({
        title: '¿Está seguro de borrar el empleado?',
        text: "¡Si no lo está puede cancelar la acción!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar Empleado!'
      }).then(function(result){
        if (result.value) {
          
            window.location = "index.php?ruta=empleados&idEmpleado="+idCliente;
        }

  })

})
<?php
/*llamamos al controlador plantilla_controlador*/
require_once "controladores/plantilla.controlador.php";
require_once "controladores/usuarios.controlador.php";
require_once "controladores/categorias.controlador.php";
require_once "controladores/productos.controlador.php";
require_once "controladores/clientes.controlador.php";
require_once "controladores/proveedor.controlador.php";
require_once "controladores/empleado.controlador.php";
require_once "controladores/ventas.controlador.php";
require_once "controladores/tipopago.controlador.php";

require_once "modelos/usuarios.modelo.php";
require_once "modelos/categorias.modelo.php";
require_once "modelos/productos.modelo.php";
require_once "modelos/clientes.modelo.php";
require_once "modelos/proveedor.modelo.php";
require_once "modelos/empleados.modelo.php";
require_once "modelos/ventas.modelo.php";
require_once "modelos/tipopago.modelo.php";

/*creamos un objeto de la clase ControladorPlantilla */
$plantilla = new ControladorPlantilla();
/*una vez instaciado podemos usar los metodos de la clase*/
$plantilla -> ctrPlantilla();   /*es un metodo de controlador ctrPlantilla*/

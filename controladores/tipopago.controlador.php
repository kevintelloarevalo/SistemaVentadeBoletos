<?php
class ControladorTipo{

    /*=============================================
    MOSTRAR TIPOS PAGOS
    =============================================*/

    static public function ctrMostrarTipos($item, $valor){

        $tabla = "tipo_pago";

        $respuesta = ModeloTipo::mdlMostrarTipopago($tabla, $item, $valor);

        return $respuesta;

    }
}
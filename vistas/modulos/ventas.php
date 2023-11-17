<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Administrar ventas
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar ventas</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

    <div class="box-header with-border">
  
      <a href="crear-venta">

        <button class="btn btn-primary">
          
          Agregar venta

        </button>

      </a>

      <?php

        if(isset($_GET["fechaInicial"])){

          echo '<a href="vistas/modulos/descargar-reporte.php?reporte=reporte&fechaInicial='.$_GET["fechaInicial"].'&fechaFinal='.$_GET["fechaFinal"].'">';

        }else{

          echo '<a href="vistas/modulos/descargar-reporte.php?reporte=reporte">';

        }         

      ?>

        <button class="btn btn-success" >Descargar reporte en Excel</button>

        </a>

      <!--Rango de Fechas---->

      <button type="button" class="btn btn-default pull-right" id="daterange-btn">
        
          <span>
            <i class="fa fa-calendar"></i> 

            <?php

              if(isset($_GET["fechaInicial"])){

                echo $_GET["fechaInicial"]." - ".$_GET["fechaFinal"];
              
              }else{
              
                echo 'Rango de fecha';

              }

            ?>
          </span>

          <i class="fa fa-caret-down"></i>

      </button>

      <div class="box-tools pull-left">

      </div>

    </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablas " width="100%">
         
        <thead>
         
         <tr>
           
           <th style="width:10px">#</th>
           <th>N° Boletos</th>
           <th>Total de Entradas</th>
           <th>Cliente</th>
           <th>Vendedor</th>
           <th>Pago</th>
           <th>Total</th>
           <!-----
           <th>Fecha</th>
           <th>QR</th>--->
           <th>Observación</th>
           <th>Seguimiento</th>
           <th>Acciones</th>

         </tr> 

        </thead>

        <tbody>
          
        <?php

          if(isset($_GET["fechaInicial"])){

            $fechaInicial = $_GET["fechaInicial"];
            $fechaFinal = $_GET["fechaFinal"];

          }else{

            $fechaInicial = null;
            $fechaFinal = null;

          }

          $respuesta = ControladorVentas::ctrRangoFechasVentas($fechaInicial, $fechaFinal);

                foreach ($respuesta as $key => $value) {
                  $cantidadProductosUltimaVenta = 0;
                  $productosUltimaVenta = json_decode($value['cantidadproductos'], true);
                  foreach ($productosUltimaVenta as $item) {
                      $cantidadProductosUltimaVenta += $item['cantidad'];
                  }
              
                  $codigo2 = $value['codigo'] + $cantidadProductosUltimaVenta - 1;
              
                  echo '<tr>
                          <td>'.($key+1).'</td>
                          <td>COD-'.$value["codigo"].' - COD-'.$codigo2.'</td>
                          <td>'.$cantidadProductosUltimaVenta.'</td>';
                          
              
                  $itemCliente = "idcliente";
                  $valorCliente = $value["idcliente"];

                  $respuestaCliente = ControladorClientes::ctrMostrarClientes($itemCliente, $valorCliente);

                  echo '<td>'.$respuestaCliente["nombre"].' '.$respuestaCliente["apellido"].'</td>';

                  $itemUsuario = "idusuario";
                  $valorUsuario = $value["idvendedor"];

                  $respuestaUsuario = ControladorUsuarios::ctrMostrarUsuarios($itemUsuario, $valorUsuario);

                  echo '<td>'.$respuestaUsuario["nombre"].'</td>

                        <td>'.$value["metodo_pago"].'</td>

                        <td>S/. '.number_format($value["total"],2).'</td>

                        <td>'.$value["observacion"].'</td>

                        <td>'.$value["seguimiento"].'</td>

                      <td>
                      

                    <div class="btn-group">
                    
                      <button class="btn btn-info btnImprimirFactura" codigoVenta="'.$value["codigo"].'"> <i class="fa fa-print"></i>

                      <button class="btn btn-dark btnEditarSeguimiento" idVenta="'.$value["id"].'"data-toggle="modal" data-target="#modalEditarSeguimiento" data-dismiss="modal"><i class="fa fa-file"></i>
                      
                      </button>';
                    

                    if($_SESSION["perfil"] == "Administrador"){

                    echo '<button class="btn btn-warning btnEditarVenta" idVenta="'.$value["id"].'"><i class="fa fa-pencil"></i></button>

                    <button class="btn btn-danger btnEliminarVenta" idVenta="'.$value["id"].'"><i class="fa fa-times"></i></button>';

                  }

                  echo '</div>  

                  </td>

                </tr>';
            }

        ?>
          
        </tbody>

       </table>

       <?php

        $eliminarVenta = new ControladorVentas();
        $eliminarVenta -> ctrEliminarVenta();

      ?>

      </div>

    </div>

  </section>

</div>


<!--=====================================
MODAL EDITAR SEEGUIMIENTO
======================================-->

<div id="modalEditarSeguimiento" class="modal fade" role="dialog">

<div class="modal-dialog">

  <div class="modal-content">

    <form  class="needs-validation" role="form" method="post" enctype="multipart/form-data" novalidate>

      <!--=====================================
      CABEZA DEL MODAL
      ======================================-->

      <div class="modal-header" style="background:#3c8dbc; color:white">

        <h4 class="modal-title">Editar Seguimiento</h4>

      </div>

      <!--=====================================
      CUERPO DEL MODAL
      ======================================-->

      <div class="modal-body">

        <div class="box-body">

          <!-- ENTRADA PARA LA OBSERVACIÓN-->
          
          <div class="form-group">
            
            <div class="input-group">
                <span class="input-group-text"><i class="fa fa-user fa fa-fw"></i></span>
                <input type="text" class="form-control input-lg form-control-lg" id="editarObservacion" name="editarObservacion" value=" " required><!-- Sivalida solo se aceptara letrasmayusominus-->              
                <input type="hidden" id="idVenta" name="idVenta">
            </div>

          </div>
          
          <!-- ENTRADA PARA SELECCIONAR EL ESTADO-->

          <div class="form-group">
            
            <div class="input-group">
            
              <span class="input-group-text"><i class="fa fa-users fa-fw"></i></span> 

              <select class="form-control input-lg form-control-lg" name="editarSeguimiento" required="">
                
                <option value="" id="editarSeguimiento">--Selecionar opción--</option>

                <option value="Cortesia">Cortesia</option>

                <option value="Pagado">Pagado</option>
                
              </select>

            </div>

          </div>

        </div>

      </div>

      <!--=====================================
      PIE DEL MODAL
      ======================================-->

      <div class="modal-footer">

        <button type="button" class="btn btn-success pull-left" data-bs-dismiss="modal">Salir</button>

        <button type="submit" class="btn btn-primary">Guardar cambios</button>

      </div>
      
      <?php

        $editarVenta = new ControladorVentas();
        $editarVenta -> ctrEditarVentaSeguimiento(); /*Asi se llama mi controlador */
      ?> 

    </form>

  </div>

</div>

</div>
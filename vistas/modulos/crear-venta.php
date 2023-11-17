
<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Crear venta
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Crear venta</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="row">

      <!--=====================================
      EL FORMULARIO
      ======================================-->
      
      <div class="col-lg-5 col-xs-12">
        
        <div class="box box-success">
          
          <div class="box-header with-border"></div>

          <form role="form" method="post" class="formularioVenta">

            <div class="box-body">
  
              <div class="box">

                <!--=====================================
                ENTRADA DEL VENDEDOR
                ======================================-->
            
                <div class="form-group">
                
                  <div class="input-group">
                    
                    <span class="input-group-text"><i class="fa fa-user fa-fw"></i></span> 

                    <input type="text" class="form-control input-lg form-control-lg" id="nuevoVendedor" value="<?php echo $_SESSION["nombre"]; ?>" readonly>

                    <input type="hidden" name="idVendedor" value="<?php echo $_SESSION["idusuario"]; ?>">
                  
                  </div>

                </div> 

                <!--=====================================
                ENTRADA DEL CODIGO
                ======================================--> 

                <div class="form-group">
                  
                  <div class="input-group">
                    
                    <span class="input-group-text"><i class="fa fa-key fa-fw"></i></span>

                    <?php

                      $item = null;
                      $valor = null;

                      $ventas = ControladorVentas::ctrMostrarVentas($item, $valor);

                      if (!$ventas) {
                          echo '<input type="text" class="form-control input-lg form-control-lg" id="nuevaVenta" name="nuevaVenta" value="10000" readonly>';
                      } else {
                          $ultimaVenta = end($ventas);
                          $cantidadProductosUltimaVenta = 0;

                          $productosUltimaVenta = json_decode($ultimaVenta['cantidadproductos'], true);
                          foreach ($productosUltimaVenta as $item) {
                              $cantidadProductosUltimaVenta += $item['cantidad'];
                          }

                          $codigo = $ultimaVenta['codigo'] + $cantidadProductosUltimaVenta;

                          $codigo2 = $codigo + $cantidadProductosUltimaVenta;

                          echo '<input type="text" class="form-control input-lg form-control-lg" id="nuevaVenta" name="nuevaVenta" value="'.$codigo.'" readonly>';

                      }

                      ?>


                  </div>
                
                </div>

                <!--Entrada Buscar por DNI-->
                
                <select class="form-control input-lg form-control-lg" id="seleccionarClientee" name="seleccionarCliente" required>
                    <option value="">Seleccionar cliente</option>
                    <?php
                      $item = null;
                      $valor = null;
                      $clientes = ControladorClientes::ctrMostrarClientes($item, $valor);

                      foreach ($clientes as $key => $value) {
                        echo '<option value="'.$value["idcliente"].'" data-dni="'.$value["dni"].'">'.$value["nombre"].' '.$value["apellido"].'</option>';
                      }
                    ?>
                </select>

                <div class="form-group">
                  
                  <div class="input-group">
                    
                    <span class="input-group-text"><i class="fa fa-key fa-fw"></i></span>
                  <!-- Campo de entrada para introducir el DNI a buscar -->
                  <input  class="form-control input-lg form-control-lg" type="text" id="dniBuscar" name="dniBuscar" placeholder="Introduce el DNI a buscar">

                  <button class="btn btn-success btn-xs" type="button" onclick="buscarCliente()">Buscar</button>

                  </div>
                </div>
                <script>
                  function buscarCliente() {
                    var dniBuscado = document.getElementById("dniBuscar").value;
                    var selectCliente = document.getElementById("seleccionarClientee");
                    var clienteEncontrado = false;

                    for (var i = 0; i < selectCliente.options.length; i++) {
                      var option = selectCliente.options[i];

                      if (option.dataset.dni === dniBuscado) {
                        option.selected = true;
                        clienteEncontrado = true;
                        break;
                      }
                    }

                    if (!clienteEncontrado) {
                      // Mostrar la alerta de SweetAlert indicando que el cliente no existe
                      swal({
                        title: "Error, Cliente No encontrado",
                        text: "No se encontró ningún cliente con el DNI proporcionado.",
                        type: "error",
                        confirmButtonText: "¡Cerrar!"
                      });
                    } else {
                      // Disparar el evento change manualmente para actualizar el mensaje
                      var event = new Event("change");
                      selectCliente.dispatchEvent(event);
                    }
                  }
                </script>


                <input type="hidden" id="mensaje" name="qr" value="">

                <script>
                  // Obtener el elemento select y el input oculto
                  var selectCliente = document.getElementById("seleccionarClientee");
                  var inputMensaje = document.getElementById("mensaje");

                  // Escuchar el evento change en el select
                  selectCliente.addEventListener("change", function () {
                    // Obtener el nombre del cliente seleccionado
                    var nombreCliente = selectCliente.options[selectCliente.selectedIndex].text;

                    // Construir el mensaje y establecerlo en el input oculto
                    var mensaje =
                      "Hola " +
                      nombreCliente +
                      ", separaste las entradas a partir del COD-<?php echo $codigo; ?>. Recuerda que eres responsable de la lista de entradas asignadas a tu persona.";
                    inputMensaje.value = mensaje;
                  });
                </script>
                <!--=====================================
                ENTRADA DEL CLIENTE
                ======================================--> 

                <div class="form-group">
                    
                    <span class="input-group-text"><button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#modalAgregarCliente" data-dismiss="modal">Agregar cliente</button></span>

                </div>

                <!--=====================================
                ENTRADA PARA AGREGAR PRODUCTO
                ======================================--> 
 
                <div class="form-group nuevoProducto">  <!--Borre row--->

                </div>

                <input type="hidden" id="listaProductos" name="listaProductos">

                <!--=====================================
                BOTÓN PARA AGREGAR PRODUCTO
                ======================================-->

                <hr>

                <div class="row">

                  <!--=====================================
                  ENTRADA IMPUESTOS Y TOTAL
                  ======================================-->
                  
                  <div class="col-8">
                    
                    <table class="table">

                      <thead>

                        <tr>
                          <th>Total</th>      
                        </tr>

                      </thead>

                      <tbody>
                      
                        <tr>
                          

                           <td>
                            
                            <div class="input-group">
                           
                              <span class="input-group-text"><i class="ion ion-social-usd fa-fw"></i></span>

                              <input type="text" class="form-control input-lg form-control-lg" id="nuevoTotalVenta" name="nuevoTotalVenta" total="" placeholder="00000" readonly required>

                              <input type="hidden" name="totalVenta" id="totalVenta">
                              
                        
                            </div>

                          </td>

                        </tr>

                      </tbody>

                    </table>

                  </div>

                </div>

                <hr>

                
                <!-- ENTRADA PARA LA OBSERVACIÓN -->
            
                <div class="form-group">
                  
                  <div class="input-group">

                    <input type="text" class="form-control input-lg form-control-lg" name="nuevaObservacion" placeholder="Ingresa la Observación" required><!-- Sivalida-->

                  </div>

                </div>
              <!-- ENTRADA PARA SELECCIONAR EL ESTADO-->

              <!-- ENTRADA PARA SELECCIONAR EL ESTADO -->
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-text"><i class="fa fa-users fa-fw"></i></span> 
                  <select class="form-control input-lg form-control-lg" name="nuevoSeguimiento" id="nuevoSeguimiento" required="">
                    <option value="">--Seleccionar opción--</option>
                    <option value="Pagado">Pagado</option>
                    <option value="Cortesia">Cortesia</option>
                  </select>
                </div>
              </div>

                <!--=====================================
                ENTRADA MÉTODO DE PAGO
                ======================================-->
                <div class="form-group" id="metodoPagoContainer" style="display: none;">
                  <div class="col-xs-8">
                    <div class="input-group">
                      <select class="form-control-lg" id="nuevoMetodoPago" name="nuevoMetodoPago">
                        <option value="">Seleccione método de pago</option>
                        <option value="Efectivo">Efectivo</option>
                        <!---<option value="TC">Tarjeta Crédito</option>-->
                        <option value="TB">Transferencia Bancaria</option>                  
                      </select>
                    </div>
                  </div>
                  <div class="cajasMetodoPago"></div>
                  <input type="hidden" id="listaMetodoPago" name="listaMetodoPago">
                </div>

                <br>

              </div>

              <script>
                var estadoSelect = document.getElementById("nuevoSeguimiento");
                var metodoPagoContainer = document.getElementById("metodoPagoContainer");
                var listaMetodoPago = document.getElementById("listaMetodoPago");

                estadoSelect.addEventListener("change", function() {
                  if (estadoSelect.value === "Pagado") {
                    metodoPagoContainer.style.display = "block";
                  } else {
                    metodoPagoContainer.style.display = "none";
                    if (estadoSelect.value === "Cortesia") {
                      listaMetodoPago.value = "Gratuito Cortesia";
                    } else {
                      listaMetodoPago.value = "";
                    }
                  }
                });
              </script>

          </div>

          <div class="box-footer">

            <button type="submit" class="btn btn-primary pull-right">Guardar venta</button>

          </div>

        </form>

        <?php

          $guardarVenta = new ControladorVentas();
          $guardarVenta -> ctrCrearVenta();
          
        ?>
        </div>
            
      </div>

      <!--=====================================
      LA TABLA DE PRODUCTOS
      ======================================-->

      <div class="col-lg-7 hidden-md hidden-sm hidden-xs">
        
        <div class="box box-warning">

          <div class="box-header with-border"></div>

          <div class="box-body">
            
            <table class="table table-bordered table-striped dt-responsive tablaVentas" width="100%">
              
               <thead>

                 <tr>
                  <th style="width: 10px">#</th>
                  <th>Imagen</th>
                  <th>Código</th>
                  <th>Descripcion</th>
                  <th>Stock</th>
                  <th>Acciones</th>
                </tr>

              </thead>

            </table>

          </div>

        </div>


      </div>

    </div>
   
  </section>

</div>

<!--=====================================
MODAL AGREGAR CLIENTE
======================================-->

<div id="modalAgregarCliente" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form class="needs-validation" role="form" method="post" novalidate>

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-bs-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar cliente</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-text"><i class="fa fa-user fa-fw"></i></span> 

                <input type="text" class="form-control input-lg form-control-lg" name="nuevoCliente" placeholder="Ingresar nombre" pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{2,64}" required><!-- Sivalida-->

                <!-- Mensajes para validación   -->
                <div class="valid-feedback">¡Campo válido!</div>
                <div class="invalid-feedback">El nombre puede tener mayúsculas, minúsculas, tildes.</div>

              </div>

            </div>
            
            <!-- ENTRADA PARA los Apellidos-->
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-text"><i class="fa fa-user fa-fw"></i></span> 

                <input type="text" class="form-control input-lg form-control-lg" name="nuevoApellido" placeholder="Ingresar apellido paterno" pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{2,64}" required><!-- Sivalida-->

                <!-- Mensajes para validación   -->
                <div class="valid-feedback">¡Campo válido!</div>
                <div class="invalid-feedback">El nombre puede tener mayúsculas, minúsculas, tildes.</div>

              </div>

            </div>

            <!-- ENTRADA PARA DNI -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-text"><i class="fa fa-key fa-fw"></i></span> 

                <input type="text" class="form-control input-lg form-control-lg" name="nuevoDocumentoId" placeholder="Ingresar el Dni" data-inputmask="'mask':'9999999'" data-mask required ="" pattern="[0-9]{8}"><!-- NOvalida-->

                <!-- Mensajes para validación   -->
                <div class="valid-feedback">¡Campo válido!</div>
                <div class="invalid-feedback">Solo se permite 8 números.</div>

              </div>

            </div>

            <!-- ENTRADA PARA EL EMAIL -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-text"><i class="fa fa-envelope fa-fw"></i></span> 

                <input type="email" class="form-control input-lg form-control-lg" name="nuevoEmail"  placeholder="Ingresar email" required=" "><!-- Sivalida-->

                <!-- Mensajes para validación   -->
                <div class="valid-feedback">¡Campo válido!</div>
                <div class="invalid-feedback">Ej.luis@gmail.com</div>

              </div>

            </div>

            <!-- ENTRADA PARA EL TELÉFONO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-text"><i class="fa fa-phone fa-fw"></i></span> 

                <input type="text" class="form-control input-lg form-control-lg" name="nuevoTelefono" placeholder="Ingresar teléfono" data-inputmask="'mask':'99999999'" data-mask required ="" pattern="[0-9]{9}"> <!-- Sivalida-->

                <!-- Mensajes para validación   -->
                <div class="valid-feedback">¡Campo válido!</div>
                <div class="invalid-feedback">Solo se permite 9 números.</div>

              </div>

            </div>

            <!-- ENTRADA PARA LA DIRECCIÓN -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-text"><i class="fa fa-map-marker fa-fw"></i></span> 

                <input type="text" class="form-control input-lg form-control-lg" name="nuevaDireccion" placeholder="Ingresar dirección" pattern="[a-zA-Z0-9.,#*-_ ]{4,80}" required=""> <!-- Sivalida-->
                <!-- Mensajes para validación   -->
                <div class="valid-feedback">¡Campo válido!</div>
                <div class="invalid-feedback">Ejemplo. Av.Miguel Graú #545-Pacasmayo</div>

              </div>

            </div>

             <!-- ENTRADA PARA LA FECHA DE NACIMIENTO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-text"><i class="fa fa-calendar fa-fw"></i></span> 

                <input type="text" class="form-control input-lg form-control-lg" name="nuevaFechaNacimiento" placeholder="Ingresar fecha nacimiento" pattern="([0-9]{4}\/[0-9]{2}\/[0-9]{2})"required>  <!-- Sivalida-->

                <!-- Mensajes para validación   -->
                <div class="valid-feedback">¡Campo válido!</div>
                <div class="invalid-feedback">Solo se permite el sgt formato: yyyy/mm/dd</div>
              
              </div>

            </div>
  
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-bs-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar cliente</button>

        </div>
        <?php

          $crearCliente = new ControladorClientes();
          $crearCliente -> ctrCrearCliente();

        ?>


      </form>

    </div>

  </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script>      
    (function () {
      'use strict'
      // Obtener todos los formularios a los que queremos aplicar estilos de validación de Bootstrap personalizados
      var forms = document.querySelectorAll('.needs-validation')
      //Recorremos los forms y evitamos en envío sin validacion
      Array.prototype.slice.call(forms)
        .forEach(function (form) {
          form.addEventListener('submit', function (event) {            
            if (!form.checkValidity()) {
              event.preventDefault()
              event.stopPropagation()
            }
            form.classList.add('was-validated')
          }, false)
        })
    })()
</script>    


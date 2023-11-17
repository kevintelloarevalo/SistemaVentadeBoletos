<link rel="stylesheet" href="style.css">

<div class="content-wrapper">
    
  <section class="content-header">

    <h1>

      Administrar clientes

    </h1>

    <ol class="breadcrumb">

      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
        
      <li class="active">Administrar clientes</li>
        
    </ol>

  </section>

    <!-- comienza desde aqui -->
  <section class="content">

    <div class="box">

      <div class="box-header with-border">

        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAgregarCliente">

            Agregar Clientes

        </button> <!-- creamos un botton y el nombre del modal -->
      
      </div>
       <!-- Cuerpo de nuestra pagina de usuario -->
       <div class="box-body">
        
        <table class="table table-bordered table-striped dt-responsive tablas" width="100%"> 
          
          <thead> 
            
            <tr> <!-- columnas titulos -->
              
              <th style="width:10px">#</th>
              <th>Nombre</th>
              <th>Apellidos</th>
              <th>DNI</th>
              <th>Email</th>
              <th>Teléfono</th>
              <th>Acciones</th>
  
            </tr> 

          <thead>
          
          <tbody>   <!-- filas Contenido fictisio-->

          <?php

            $item = null;
            $valor = null;

            $clientes = ControladorClientes::ctrMostrarClientes($item, $valor);

            foreach ($clientes as $key => $value) {
              

              echo '<tr>

                      <td>'.($key+1).'</td>

                      <td>'.$value["nombre"].'</td>

                      <td>'.$value["apellido"].'</td>

                      <td>'.$value["dni"].'</td>

                      <td>'.$value["email"].'</td>

                      <td>'.$value["telefono"].'</td>          

                      <td>

                        <div class="btn-group">
                            
                          <button class="btn btn-warning btnEditarCliente" data-toggle="modal" data-target="#modalEditarCliente" idCliente="'.$value["idcliente"].'"><i class="fa fa-pencil"></i></button>';

                        if($_SESSION["perfil"] == "Administrador"){

                            echo '<button class="btn btn-danger btnEliminarCliente" idCliente="'.$value["idcliente"].'"><i class="fa fa-times"></i></button>';

                        }

                        echo '</div>  

                      </td>

                    </tr>';

              }

          ?>

          </tbody>
          
        </table> 

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

                <input type="text" class="form-control input-lg form-control-lg" name="nuevoDocumentoId" placeholder="Ingresar el Dni"><!-- NOvalida-->

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

                <input type="text" class="form-control input-lg form-control-lg" name="nuevoTelefono" placeholder="Ingresar teléfono"> <!-- Sivalida-->

                <!-- Mensajes para validación   -->
                <div class="valid-feedback">¡Campo válido!</div>
                <div class="invalid-feedback">Solo se permite 9 números.</div>

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

<!--=====================================
MODAL EDITAR CLIENTE
======================================-->

<div id="modalEditarCliente" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form class="needs-validation" role="form" method="post" novalidate>

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-bs-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar cliente</h4>

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

                <input type="text" class="form-control input-lg form-control-lg" name="editarCliente" id="editarCliente" placeholder="Ingresar nombre" pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{2,64}" readonly><!-- Sivalida-->
                
                <input type="hidden" id="idCliente" name="idCliente">
                <!-- Mensajes para validación   -->
                <div class="valid-feedback">¡Campo válido!</div>
                <div class="invalid-feedback">El nombre puede tener mayúsculas, minúsculas, tildes.</div>

              </div>

            </div>
             <!-- ENTRADA PARA EL APELLIDO  -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-text"><i class="fa fa-user fa-fw"></i></span> 

                <input type="text" class="form-control input-lg form-control-lg" name="editarApellido" id="editarApellido" placeholder="Ingresar los apellidos" pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{2,64}" required><!-- Sivalida-->
                
                <!-- Mensajes para validación   -->
                <div class="valid-feedback">¡Campo válido!</div>
                <div class="invalid-feedback">El apellido puede tener mayúsculas, minúsculas, tildes.</div>

              </div>

            </div>

            <!-- ENTRADA PARA DNI -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-text"><i class="fa fa-key fa-fw"></i></span> 

                <input type="text" class="form-control input-lg form-control-lg" name="editarDocumentoId" id="editarDocumentoId" placeholder="Ingresar el Dni" readonly><!-- NOvalida-->

                <!-- Mensajes para validación   -->
                <div class="valid-feedback">¡Campo válido!</div>
                <div class="invalid-feedback">Solo se permite números.</div>

              </div>

            </div>

            <!-- ENTRADA PARA EL EMAIL -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-text"><i class="fa fa-envelope fa-fw"></i></span> 

                <input type="email" class="form-control input-lg form-control-lg" name="editarEmail" id="editarEmail" placeholder="Ingresar email" required=" "><!-- Sivalida-->

                <!-- Mensajes para validación   -->
                <div class="valid-feedback">¡Campo válido!</div>
                <div class="invalid-feedback">Ej.luis@gmail.com</div>

              </div>

            </div>

            <!-- ENTRADA PARA EL TELÉFONO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-text"><i class="fa fa-phone fa-fw"></i></span> 

                <input type="text" class="form-control input-lg form-control-lg" name="editarTelefono" id="editarTelefono" placeholder="Ingresar teléfono" data-inputmask="'mask':'99999999'" data-mask required ="" pattern="[0-9]{9}"> <!-- Sivalida-->

                <!-- Mensajes para validación   -->
                <div class="valid-feedback">¡Campo válido!</div>
                <div class="invalid-feedback">Solo se permiten números.</div>

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

        $editarCliente = new ControladorClientes();
        $editarCliente -> ctrEditarCliente();

        ?>
      </form>

    </div>

  </div>

</div>

<?php

  $eliminarCliente = new ControladorClientes();
  $eliminarCliente -> ctrEliminarCliente();

?>

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
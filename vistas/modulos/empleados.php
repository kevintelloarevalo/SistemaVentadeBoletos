<link rel="stylesheet" href="style.css">

<div class="content-wrapper">
    
  <section class="content-header">

    <h1>

      Administrar Empleados

    </h1>

    <ol class="breadcrumb">

      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
        
      <li class="active">Administrar Empleados</li>
        
    </ol>

  </section>

    <!-- comienza desde aqui -->
  <section class="content">

    <div class="box">

      <div class="box-header with-border">

        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAgregarEmpleado">

            Agregar Empleados

        </button> <!-- creamos un botton y el nombre del modal -->
      
      </div>
       <!-- Cuerpo de nuestra pagina de usuario -->
       <div class="box-body">
        
        <table class="table table-bordered table-striped dt-responsive tablas" width="100%"> 
          
          <thead> 
            
            <tr> <!-- columnas titulos -->
              
              <th style="width:10px">#</th>
              <th>Nombres</th>
              <th>Apellidos</th>
              <th>DNI</th>
              <th>Teléfono</th>
              <th>Trabajo</th>
              <th>Sueldo/Mes</th>
              <th>Dirección</th>
              <th>Ciudad</th>
              <th>Acciones</th>
  
            </tr> 

          <thead>
          
          <tbody>   <!-- filas Contenido fictisio-->

          <?php

            $item = null;
            $valor = null;

            $empleados = ControladorEmpleados::ctrMostrarEmpleados($item, $valor);

            foreach ($empleados as $key => $value) {
              

              echo '<tr>

                      <td>'.($key+1).'</td>

                      <td>'.$value["nombre"].'</td>

                      <td>'.$value["apellido"].'</td>

                      <td>'.$value["dni"].'</td>

                      <td>'.$value["telefono"].'</td>

                      <td>'.$value["trabajo"].'</td>

                      <td>'.$value["sueldo"].'</td>    
                      
                      <td>'.$value["direccion"].'</td>
                      
                      <td>'.$value["ciudad"].'</td>   

                      <td>

                        <div class="btn-group">
                            
                          <button class="btn btn-warning btnEditarEmpleado" data-toggle="modal" data-target="#modalEditarEmpleado" idEmpleado="'.$value["idempleado"].'"><i class="fa fa-pencil"></i></button>';

                        if($_SESSION["perfil"] == "Administrador"){

                            echo '<button class="btn btn-danger btnEliminarEmpleado" idEmpleado="'.$value["idempleado"].'"><i class="fa fa-times"></i></button>';

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
MODAL AGREGAR EMPLEADO
======================================-->

<div id="modalAgregarEmpleado" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form class="needs-validation" role="form" method="post" novalidate>

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-bs-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar Empleados</h4>

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

                <input type="text" class="form-control input-lg form-control-lg" name="nuevoEmpleado" placeholder="Ingresar nombre" pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{2,64}" required><!-- Sivalida-->

                <!-- Mensajes para validación   -->
                <div class="valid-feedback">¡Campo válido!</div>
                <div class="invalid-feedback">Los nombres pueden tener mayúsculas, minúsculas, tildes.</div>

              </div>

            </div>
            
            <!-- ENTRADA PARA los Apellidos-->
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-text"><i class="fa fa-user fa-fw"></i></span> 

                <input type="text" class="form-control input-lg form-control-lg" name="nuevoApellido" placeholder="Ingresar apellido paterno" pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{2,64}" required><!-- Sivalida-->

                <!-- Mensajes para validación   -->
                <div class="valid-feedback">¡Campo válido!</div>
                <div class="invalid-feedback">Los apellidos pueden tener mayúsculas, minúsculas, tildes.</div>

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

            <!-- ENTRADA PARA El trabajo-->
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-text"><i class="fa fa-user fa-fw"></i></span> 

                <input type="text" class="form-control input-lg form-control-lg" name="nuevoTrabajo" placeholder="Ingresar  el trabajo" pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{2,15}" required><!-- Sivalida-->

                <!-- Mensajes para validación   -->
                <div class="valid-feedback">¡Campo válido!</div>
                <div class="invalid-feedback">El trabajo puede tener mayúsculas, minúsculas, tildes.</div>

              </div>

            </div>

            <!-- ENTRADA PARA SUELDO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-text"><i class="fa fa-key fa-fw"></i></span> 

                <input type="text" class="form-control input-lg form-control-lg" name="nuevoSueldo" placeholder="Ingresar el Sueldo" data-inputmask="'mask':'9999'" data-mask required ="" pattern="[0-9]{3,5}"><!-- NOvalida-->

                <!-- Mensajes para validación   -->
                <div class="valid-feedback">¡Campo válido!</div>
                <div class="invalid-feedback">Solo se permite números.</div>

              </div>

            </div>

            <!-- ENTRADA PARA LA DIRECCIÓN -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-text"><i class="fa fa-map-marker fa-fw"></i></span> 

                <input type="text" class="form-control input-lg form-control-lg" name="nuevaDireccion" placeholder="Ingresar su dirección" pattern="[a-zA-Z0-9.,#*-_ ]{4,80}" required=""> <!-- Sivalida-->
                <!-- Mensajes para validación   -->
                <div class="valid-feedback">¡Campo válido!</div>
                <div class="invalid-feedback">Ejemplo. Av.Miguel Graú #545-Pacasmayo</div>

              </div>

            </div>
 
            <!-- ENTRADA PARA LA CIUDAD -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-text"><i class="fa fa-map-marker fa-fw"></i></span> 

                <input type="text" class="form-control input-lg form-control-lg" name="nuevaCiudad" placeholder="Ingresar su ciudad" pattern="[a-zA-Z0-9 ]{4,20}" required=""> <!-- Sivalida-->
                <!-- Mensajes para validación   -->
                <div class="valid-feedback">¡Campo válido!</div>
                <div class="invalid-feedback">Ejemplo. Pacasmayo</div>

              </div>

            </div>
  
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-bs-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar Empleado</button>

        </div>
        <?php

          $crearEmpleado = new ControladorEmpleados();
          $crearEmpleado -> ctrCrearEmpleado();

        ?>


      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR EMPLEADO
======================================-->

<div id="modalEditarEmpleado" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form class="needs-validation" role="form" method="post" novalidate>

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-bs-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar Empleado</h4>

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

                <input type="text" class="form-control input-lg form-control-lg" name="editarEmpleado" id="editarEmpleado" placeholder="Ingresar nombre" pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{2,64}" required><!-- Sivalida-->
                
                <input type="hidden" id="idEmpleado" name="idEmpleado">
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

                <input type="text" class="form-control input-lg form-control-lg" name="editarDocumentoId" id="editarDocumentoId" placeholder="Ingresar el Dni"data-inputmask="'mask':'9999999'" data-mask required ="" pattern="[0-9]{8}" ><!-- NOvalida-->

                <!-- Mensajes para validación   -->
                <div class="valid-feedback">¡Campo válido!</div>
                <div class="invalid-feedback">Solo se permite 8 números.</div>

              </div>

            </div>

            <!-- ENTRADA PARA EL TELÉFONO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-text"><i class="fa fa-phone fa-fw"></i></span> 

                <input type="text" class="form-control input-lg form-control-lg" name="editarTelefono" id="editarTelefono" placeholder="Ingresar teléfono" data-inputmask="'mask':'99999999'" data-mask required ="" pattern="[0-9]{9}"> <!-- Sivalida-->

                <!-- Mensajes para validación   -->
                <div class="valid-feedback">¡Campo válido!</div>
                <div class="invalid-feedback">Solo se permite 9 números.</div>

              </div>

            </div>
            <!-- ENTRADA PARA El trabajo-->
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-text"><i class="fa fa-user fa-fw"></i></span> 

                <input type="text" class="form-control input-lg form-control-lg" name="editarTrabajo" id="editarTrabajo" placeholder="Ingresar el trabajo" pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{2,15}" required><!-- Sivalida-->

                <!-- Mensajes para validación   -->
                <div class="valid-feedback">¡Campo válido!</div>
                <div class="invalid-feedback">El trabajo puede tener mayúsculas, minúsculas, tildes.</div>

              </div>

            </div>

            <!-- ENTRADA PARA SUELDO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-text"><i class="fa fa-key fa-fw"></i></span> 

                <input type="text" class="form-control input-lg form-control-lg" name="editarSueldo" id="editarSueldo" placeholder="Ingresar el Sueldo" data-inputmask="'mask':'9999999'" data-mask required ="" pattern="[0-9]{3,5}"><!-- NOvalida-->

                <!-- Mensajes para validación   -->
                <div class="valid-feedback">¡Campo válido!</div>
                <div class="invalid-feedback">Solo se permite números.</div>

              </div>

            </div>

            <!-- ENTRADA PARA LA DIRECCIÓN -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-text"><i class="fa fa-map-marker fa-fw"></i></span> 

                <input type="text" class="form-control input-lg form-control-lg" name="editarDireccion" id="editarDireccion" placeholder="Ingresar dirección" pattern="[a-zA-Z0-9.,#*-_ ]{4,80}" required=""> <!-- Sivalida-->
                <!-- Mensajes para validación   -->
                <div class="valid-feedback">¡Campo válido!</div>
                <div class="invalid-feedback">Ejemplo. Av.Miguel Graú #545-Pacasmayo</div>

              </div>

            </div>

            <!-- ENTRADA PARA LA CIUDAD -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-text"><i class="fa fa-map-marker fa-fw"></i></span> 

                <input type="text" class="form-control input-lg form-control-lg" name="editarCiudad" id="editarCiudad" placeholder="Ingresar su ciudad" pattern="[a-zA-Z0-9 ]{4,20}" required=""> <!-- Sivalida-->
                <!-- Mensajes para validación   -->
                <div class="valid-feedback">¡Campo válido!</div>
                <div class="invalid-feedback">Ejemplo. Pacasmayo</div>

              </div>

            </div>
  
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-bs-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Editar empleado</button>

        </div>
        <?php

        $editarEmpleado = new ControladorEmpleados();
        $editarEmpleado -> ctrEditarEmpleado();

        ?>
      </form>

    </div>

  </div>

</div>

<?php

  $eliminarEmpleado = new ControladorEmpleados();
  $eliminarEmpleado -> ctrEliminarEmpleado();

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

<div class="content-wrapper">

<section class="content-header">
  
  <h1>Administrar usuarios</h1>

  <ol class="breadcrumb">
    
    <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
    
    <li class="active">Administrar usuarios</li>
  
  </ol>

</section>

<section class="content">

  <div class="box">

    <div class="box-header with-border">

      <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAgregarUsuario">
        
        Agregar usuario

      </button>

    </div>

    <div class="box-body">
      
     <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
       
      <thead>
       
       <tr>
         
         <th style="width:10px">#</th>
         <th>Nombre</th>
         <th>DNI</th> <!--le agrege -->
         <th>Email</th>
         <th>Foto</th>
         <th>Perfil</th>
         <th>Estado</th>
         <th>Acciones</th>

       </tr> 

      </thead>

      <tbody>

      <?php

      $item = null;
      $valor = null;

      $usuarios = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);

      foreach ($usuarios as $key => $value){
 
        echo ' <tr>
                <td>'.($key+1).'</td>
                <td>'.$value["nombre"].'</td>
                <td>'.$value["dni"].'</td>
                <td>'.$value["usuario"].'</td>';
              
                if($value["foto"] != ""){

                  echo '<td><img src="'.$value["foto"].'" class="img-thumbnail" width="40px"></td>';

                }else{

                  echo '<td><img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail" width="40px"></td>';

                }

                echo '<td>'.$value["perfil"].'</td>';

                if($value["estado"] != 0){

                  echo '<td><button class="btn btn-success btn-xs btnActivar" idUsuario="'.$value["idusuario"].'" estadoUsuario="0">Activado</button></td>';

                }else{

                  echo '<td><button class="btn btn-danger btn-xs btnActivar" idUsuario="'.$value["idusuario"].'" estadoUsuario="1">Desactivado</button></td>';

                }             

                echo '</div>  
                <td>

                  <div class="btn-group">
                      
                    <button class="btn btn-warning btnEditarUsuario" idUsuario="'.$value["idusuario"].'" data-bs-toggle="modal" data-bs-target="#modalEditarUsuario"><i class="fa fa-pencil"></i></button>

                    <button class="btn btn-danger btnEliminarUsuario" idUsuario="'.$value["idusuario"].'" fotoUsuario="'.$value["foto"].'" usuario="'.$value["usuario"].'"><i class="fa fa-times"></i></button>

                  </div>  

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
MODAL AGREGAR USUARIO
======================================-->

<div id="modalAgregarUsuario" class="modal fade" role="dialog">

<div class="modal-dialog">

  <div class="modal-content">

    <form  class="needs-validation" role="form" method="post" enctype="multipart/form-data" novalidate>

      <!--=====================================
      CABEZA DEL MODAL
      ======================================-->

      <div class="modal-header" style="background:#3c8dbc; color:white">

        <h4 class="modal-title">Agregar usuario</h4>

      </div>

      <!--=====================================
      CUERPO DEL MODAL
      ======================================-->

      <div class="modal-body">

        <div class="box-body">

          <!-- ENTRADA PARA EL NOMBRE -->
          
          <div class="form-group">
            
            <div class="input-group">

                <span class="input-group-text"><i class="fa fa-user fa fa-fw"></i></span>
                <input type="text" class="form-control input-lg form-control-lg" name="nuevoNombre" placeholder="Ingresar nombre" pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{2,64}" required><!-- Sivalida solo se aceptara letrasmayusominus-->
                <!-- Mensajes para validación   -->
                <div class="valid-feedback">¡Campo válido!</div>
                <div class="invalid-feedback">El nombre puede tener mayúsculas, minúsculas, tildes.</div>
              
              
            </div>

          </div>

          <!-- ENTRADA PARA DNI -->
            
          <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-text"><i class="fa fa-key fa-fw"></i></span> 

                <input type="text" class="form-control input-lg form-control-lg" name="nuevoDni" placeholder="Ingresar el Dni"data-inputmask="'mask':'9999999'" data-mask required ="" pattern="[0-9]{8}"><!-- NOvalida-->

                <!-- Mensajes para validación   -->
                <div class="valid-feedback">¡Campo válido!</div>
                <div class="invalid-feedback">Solo se permite 8 números.</div>

              </div>

          </div>

          <!-- ENTRADA PARA EL CORREO -->

           <div class="form-group">
            
            <div class="input-group">

                <span class="input-group-text"><i class="fa fa-key fa-fw"></i></span> 
                <input type="text" class="form-control input-lg form-control-lg" name="nuevoUsuario" placeholder="Ingresar correo" id="nuevoUsuario" pattern="[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}" required> <!-- Sivalida el correo-->
                <div class="valid-feedback">¡Campo válido!</div>
                <div class="invalid-feedback">Solo se permite 6 a 15 dígitos, puede contener letras y números.</div>

            </div>

          </div>

          <!-- ENTRADA PARA LA CONTRASEÑA -->

           <div class="form-group">
            
            <div class="input-group">

                <span class="input-group-text"><i class="fa fa-lock fa-fw "></i></span>
                <input type="password" class="form-control input-lg form-control-lg" name="nuevoPassword" placeholder= "Ingresar contraseña" required =" " pattern="[A-Za-z0-9!?@.*|-]{8,12}">
                <div class="valid-feedback">¡Campo válido!</div>
                <div class="invalid-feedback">Debe completar los datos mínimo contraseña de 8 caracteres y máximo 12.</div>
              
            </div>

          </div>

          <!-- ENTRADA PARA SELECCIONAR SU PERFIL -->

          <div class="form-group">
            
            <div class="input-group">
            
              <span class="input-group-text"><i class="fa fa-users fa-fw"></i></span> 

              <select class="form-control input-lg form-control-lg" name="nuevoPerfil" required="">
                
                <option value="">Selecionar perfil</option>

                <option value="Administrador">Administrador</option>

                <option value="Almacenero">Almacenero</option>

                <option value="Vendedor">Vendedor</option>
                
              </select>
                <div class="valid-feedback">¡Campo válido!</div>
                <div class="invalid-feedback">Debes seleccionar una opción.</div>

            </div>

          </div>

          <!-- ENTRADA PARA SUBIR FOTO -->

          <div class="form-group">
            
            <div class="panel">SUBIR FOTO</div>

            <input type="file" class="nuevaFoto" name="nuevaFoto" required =" ">

            <p class="help-block">Peso máximo de la foto 2MB</p>

            <div class="invalid-feedback">Debes seleccionar una imagén.</div>

            <img src="vistas/img/usuarios/default/usuario.png" class="img-thumbnail previsualizar" width="100px">

            <input type="hidden" name="fotoActual" id="fotoActual">

          </div>

        </div>

      </div>

      <!--=====================================
      PIE DEL MODAL
      ======================================-->

      <div class="modal-footer">

        <button type="button" class="btn btn-success pull-left" data-bs-dismiss="modal">Salir</button>

        <button type="submit" class="btn btn-primary">Guardar usuario</button>

      </div>

      <?php

            $crearUsuario=new ControladorUsuarios();

            $crearUsuario -> ctrCrearUsuario();

      ?>

    </form>

  </div>

</div>

</div>

<!--=====================================
MODAL EDITAR USUARIO
======================================-->

<div id="modalEditarUsuario" class="modal fade" role="dialog">

<div class="modal-dialog">

  <div class="modal-content">

    <form  class="needs-validation" role="form" method="post" enctype="multipart/form-data" novalidate>

      <!--=====================================
      CABEZA DEL MODAL
      ======================================-->

      <div class="modal-header" style="background:#3c8dbc; color:white">

        <h4 class="modal-title">Editar usuario</h4>

      </div>

      <!--=====================================
      CUERPO DEL MODAL
      ======================================-->

      <div class="modal-body">

        <div class="box-body">

          <!-- ENTRADA PARA EL NOMBRE -->
          
          <div class="form-group">
            
            <div class="input-group">

                <span class="input-group-text"><i class="fa fa-user fa fa-fw"></i></span>
                <input type="text" class="form-control input-lg form-control-lg" id="editarNombre" name="editarNombre" value=" " pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{2,64}" required><!-- Sivalida solo se aceptara letrasmayusominus-->
                <!-- Mensajes para validación   -->
                <div class="valid-feedback">¡Campo válido!</div>
                <div class="invalid-feedback">El nombre puede tener mayúsculas, minúsculas, tildes.</div>
              
              
            </div>

          </div>
          
          <!-- ENTRADA PARA DNI -->
            
          <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-text"><i class="fa fa-key fa-fw"></i></span> 

                <input type="text" class="form-control input-lg form-control-lg" name="editarDni" id="editarDni" placeholder="Ingresar el Dni"data-inputmask="'mask':'9999999'" data-mask required ="" pattern="[0-9]{8}"><!-- NOvalida-->

                <!-- Mensajes para validación   -->
                <div class="valid-feedback">¡Campo válido!</div>
                <div class="invalid-feedback">Solo se permite 8 números.</div>

              </div>

          </div>

          <!-- ENTRADA PARA EL CORREO -->

           <div class="form-group">
            
            <div class="input-group">

                <span class="input-group-text"><i class="fa fa-key fa-fw"></i></span> 
                <input type="text" class="form-control input-lg form-control-lg" id="editarUsuario" name="editarUsuario" value=" " pattern="[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}" readonly> <!-- Sivalida solo se aceptara letrasmayusominus-->
                <div class="valid-feedback">¡Campo válido!</div>
                <div class="invalid-feedback">Solo se permite 6 a 15 dígitos, puede contener letras y números.</div>

            </div>

          </div>

          <!-- ENTRADA PARA LA CONTRASEÑA -->

           <div class="form-group">
            
            <div class="input-group">

                <span class="input-group-text"><i class="fa fa-lock fa-fw "></i></span>
                
                <input type="password" class="form-control input-lg form-control-lg" name="editarPassword" placeholder= "Escriba la nueva contraseña" pattern="[A-Za-z0-9!?@.*|-]{8,12}" required>
                
                <input type="hidden" id="passwordActual" name="passwordActual">
                
                <div class="valid-feedback">¡Campo válido!</div>
                <div class="invalid-feedback">Debe completar los datos mínimo contraseña de 8 caracteres y máximo 12.</div>
              
            </div>

          </div>

          <!-- ENTRADA PARA SELECCIONAR SU PERFIL -->

          <div class="form-group">
            
            <div class="input-group">
            
              <span class="input-group-text"><i class="fa fa-users fa-fw"></i></span> 

              <select class="form-control input-lg form-control-lg" name="editarPerfil" required="">
                
                <option value="" id="editarPerfil">Selecionar perfil</option>

                <option value="Administrador">Administrador</option>

                <option value="Almacenero">Almacenero</option>

                <option value="Vendedor">Vendedor</option>
                
              </select>
                <div class="valid-feedback">¡Campo válido!</div>
                <div class="invalid-feedback">Debes seleccionar una opción.</div>

            </div>

          </div>

          <!-- ENTRADA PARA SUBIR FOTO -->

          <div class="form-group">
            
            <div class="panel">SUBIR FOTO</div>

            <input type="file" class="nuevaFoto" name="editarFoto" required>

            <p class="help-block">Peso máximo de la foto 2MB</p>

            <div class="invalid-feedback">Debes seleccionar una imagén.</div>

            <img src="vistas/img/usuarios/default/usuario.png" class="img-thumbnail previsualizar" width="100px">

            <input type="hidden" name="fotoActual" id="fotoActual">

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

        $editarUsuario = new ControladorUsuarios();
        $editarUsuario -> ctrEditarUsuario();
      ?> 

    </form>

  </div>

</div>

</div>
<?php

  $borrarUsuario = new ControladorUsuarios();
  $borrarUsuario -> ctrBorrarUsuario();

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
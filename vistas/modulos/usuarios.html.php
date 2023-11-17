
<div class="content-wrapper">

<section class="content-header">
  
  <h1>
    
    Administrar usuarios
  
  </h1>

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
      
     <table class="table table-bordered table-striped dt-responsive tablas">
       
      <thead>
       
       <tr>
         
         <th style="width:10px">#</th>
         <th>Nombre</th>
         <th>Usuario</th>
         <th>Foto</th>
         <th>Perfil</th>
         <th>Estado</th>
         <th>Último login</th>
         <th>Acciones</th>

       </tr> 

      </thead>

      <tbody>
        
        <tr>
          <td>1</td>
          <td>Usuario uusauiasui</td>
          <td>admin</td>
          <td><img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail" width="40px"></td>
          <td>Administrador</td>
          <td><button class="btn btn-success btn-xs">Activado</button></td>
          <td>2022-06-11 12:05:32</td>
          <td>

            <div class="btn-group">
                
              <button class="btn btn-warning"><i class="fa fa-pencil"></i></button>

              <button class="btn btn-danger"><i class="fa fa-times"></i></button>

            </div>  

          </td>

        </tr>

         <tr>
          <td>1</td>
          <td>Usuario Administrador</td>
          <td>admin</td>
          <td><img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail" width="40px"></td>
          <td>Administrador</td>
          <td><button class="btn btn-success btn-xs">Activado</button></td>
          <td>2022-08-11 12:05:32</td>
          <td>

            <div class="btn-group">
                
              <button class="btn btn-warning"><i class="fa fa-pencil"></i></button>

              <button class="btn btn-danger"><i class="fa fa-times"></i></button>

            </div>  

          </td>

        </tr>

         <tr>
          <td>1</td>
          <td>Usuario Administrador</td>
          <td>admin</td>
          <td><img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail" width="40px"></td>
          <td>Administrador</td>
          <td><button class="btn btn-danger btn-xs">Desactivado</button></td>
          <td>2022-07-11 12:05:32</td>
          <td>

            <div class="btn-group">
                
              <button class="btn btn-warning"><i class="fa fa-pencil"></i></button>

              <button class="btn btn-danger"><i class="fa fa-times"></i></button>

            </div>  

          </td>

        </tr>

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

          <!-- ENTRADA PARA EL USUARIO -->

           <div class="form-group">
            
            <div class="input-group">

                <span class="input-group-text"><i class="fa fa-key fa-fw"></i></span> 
                <input type="text" class="form-control input-lg form-control-lg" name="nuevoUsuario" placeholder="Ingresar usuario" pattern="[a-zA-Z0-9 ]{6,15}" required> <!-- Sivalida solo se aceptara letrasmayusominus-->
                <div class="valid-feedback">¡Campo válido!</div>
                <div class="invalid-feedback">Solo se permite 6 a 15 dígitos, puede contener letras y números.</div>

            
            </div>

          </div>

          <!-- ENTRADA PARA LA CONTRASEÑA -->

           <div class="form-group">
            
            <div class="input-group">

                <span class="input-group-text"><i class="fa fa-lock fa-fw "></i></span>
                <input type="password" class="form-control input-lg form-control-lg" name="nuevoPassword" placeholder= "Ingresar contraseña" required =" " pattern="[A-Za-z0-9!?@.*|-]{8,12}"">
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

                <option value="Especial">Almacenero</option>

                <option value="Vendedor">Vendedor</option>
                
              </select>
                <div class="valid-feedback">¡Campo válido!</div>
                <div class="invalid-feedback">Debes seleccionar una opción.</div>

            </div>

          </div>

          <!-- ENTRADA PARA SUBIR FOTO -->

          <div class="form-group">
            
            <div class="panel">SUBIR FOTO</div>

            <input type="file" id="nuevaFoto" name="nuevaFoto" required =" ">
            <div class="invalid-feedback">Debes seleccionar una imagén.</div>

            <img src="vistas/img/usuarios/default/usuario.png" class="img-thumbnail" width="100px">

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
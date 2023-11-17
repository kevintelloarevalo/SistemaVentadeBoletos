<div class="content-wrapper">
    
  <section class="content-header"> 

    <h1>

      Administrar categorías

    </h1>

    <ol class="breadcrumb">

      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
        
      <li class="active">Administrar categorías</li>
        
    </ol>

  </section>

    <!-- comienza desde aqui -->
  <section class="content">

    <div class="box">

      <div class="box-header with-border">

        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAgregarCategoria">

            Agregar Categoría

        </button> <!-- creamos un botton y el nombre del modal -->
      
      </div>
       <!-- Cuerpo de nuestra pagina de usuario -->
       <div class="box-body">
        
        <table class="table table-bordered table-striped tablas">  
          
          <thead> 
            
            <tr> <!-- columnas titulos -->
              
              <th style="width:10px">#</th>
              <th>Categoria</th>
              <th>Acciones</th>
  
            </tr> 

          <thead>
          
          <tbody>   <!-- filas Contenido fictisio-->
          <?php

            $item = null;
            $valor = null;

            $categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor);

            foreach ($categorias as $key => $value) {
            
              echo ' <tr>

                      <td>'.($key+1).'</td>

                      <td>'.$value["categoria"].'</td>

                      <td>

                        <div class="btn-group">
                            
                          <button class="btn btn-warning btnEditarCategoria" idCategoria="'.$value["id"].'" data-bs-toggle="modal" data-bs-target="#modalEditarCategoria"><i class="fa fa-pencil"></i></button>';

                          if($_SESSION["perfil"] == "Administrador"){

                            echo '<button class="btn btn-danger btnEliminarCategoria" idCategoria="'.$value["id"].'"><i class="fa fa-times"></i></button>';

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
   MODAL AGREGAR CATEGORIA
======================================-->
<div id="modalAgregarCategoria"class="modal fade" tabindex="-1" role="dialog">

    <div class="modal-dialog" role="document">

      <div class="modal-content">

      <form class="needs-validation" role="form" enctype="multipart/form-data" method="post" novalidate> <!--ese ectype esta para sacarlo xd>

      <!--=====================================
          Cabeza DEL MODAL
      ======================================-->

        <div class="modal-header" style="background: #605ca8; color: white">

          <h4 class="modal-title">Agregar Categoría</h4>

          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">

            <span aria-hidden="true">&times;</span>

          </button>

        </div>
      <!--=====================================
              CUERPO DEL MODAL
      ======================================-->
          <div class="modal-body">

            <div class="box-body">

                  <!-- ENTRADA CATEGORIA -->

              <div class="form-group">
            
                <div class="input-group">

                  <span class="input-group-text"><i class="fa fa-user fa-fw"></i></span>
                  <input type="text" class="form-control input-lg form-control-lg" name="nuevaCategoria" placeholder="Ingresar categoria" pattern="[a-zA-Z ]{4,15}" required>
                  <!-- Mensajes para validación   -->
                  <div class="valid-feedback">¡Campo válido!</div>
                  <div class="invalid-feedback">La categoría solo podra contener letras no mayor a 15 digitos.</div>
              
                </div>

              </div>

            </div> 

          </div>

        <!--=====================================
          PIE DEL MODAL
          ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-success pull-left" data-bs-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar categoría</button>

        </div>

        <?php

          $crearCategoria = new ControladorCategorias();
          $crearCategoria -> ctrCrearCategoria();

        ?>

      </form>

    </div>

  </div>

</div>



 <!--=====================================
 MODAL EDITAR CATEGORIA
 ======================================-->
<div id="modalEditarCategoria"class="modal fade" role="dialog">

  <div class="modal-dialog" role="document">

    <div class="modal-content">

      <form class="needs-validation" role="form" enctype="multipart/form-data" method="post" novalidate> 

      <!--=====================================
          Cabeza DEL MODAL
      ======================================-->

        <div class="modal-header" style="background: #605ca8; color: white">

          <h4 class="modal-title">Editar Categoría</h4>

          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">

            <span aria-hidden="true">&times;</span>

          </button>

        </div>
      <!--=====================================
              CUERPO DEL MODAL
      ======================================-->
          <div class="modal-body">

            <div class="box-body">

                  <!-- ENTRADA PARA EDITAR CATEGORIA -->

              <div class="form-group">
            
                <div class="input-group">

                  <span class="input-group-text"><i class="fa fa-user fa-fw"></i></span>

                  <input type="text" class="form-control input-lg form-control-lg" name="editarCategoria" id="editarCategoria" required>
                  
                    <input type="hidden"  name="idCategoria" id="idCategoria" required>

                  <!-- Mensajes para validación   -->
                  <div class="valid-feedback">¡Campo válido!</div>
                  <div class="invalid-feedback">La categoría solo podra contener letras no mayor a 15 digitos.</div>
              
                </div>

              </div>

            </div> 

          </div>

        <!--=====================================
          PIE DEL MODAL
          ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-success pull-left" data-bs-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar Cambios</button>

        </div>

        <?php

          $editarCategoria = new ControladorCategorias();
          $editarCategoria -> ctrEditarCategoria();

        ?> 
      </form>

    </div>

  </div>

</div>

<?php

$borrarCategoria = new ControladorCategorias();
$borrarCategoria -> ctrBorrarCategoria();

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
            }else{
              eventt('FORM VALIDADO')
            }
            form.classList.add('was-validated')
          }, false)
        })
    })()

    </script>    
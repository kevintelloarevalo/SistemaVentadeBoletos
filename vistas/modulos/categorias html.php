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
              <th>Nombre</th>
              <th>Acciones</th>
  
            </tr> 

          <thead>
          
          <tbody>   <!-- filas Contenido fictisio-->
          
            <tr>   

              <td>1</td>

              <td>Gaseosas</td>

              <td>

                <div class="btn-group">
                    
                  <button class="btn btn-warning"><i class="fa fa-pencil"></i></button>

                  <button class="btn btn-danger"><i class="fa fa-times"></i></button>

                </div>  

              </td>

            </tr>

            <tr>   

              <td>2</td>

              <td>Licores</td>

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
<div id="modalAgregarCategoria"class="modal fade" tabindex="-1" role="dialog">

    <div class="modal-dialog" role="document">

      <div class="modal-content">

      <form class="needs-validation" role="form" enctype="multipart/form-data" method="post" novalidate> 

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
            }else{
              eventt('FORM VALIDADO')
            }
            form.classList.add('was-validated')
          }, false)
        })
    })()
    </script>    
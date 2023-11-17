
<div class="login-box">

  <div class="login-logo">

    <img src="vistas/img/plantilla/logoo.png" class="img-responsive" style ="">

  </div>
  <!-- /.login-logo -->
  <div class="card">

    <div class="card-body login-card-body">

        <p class="login-box-msg"><b>Ingresar al sistema</b></p>

        <form class="needs-validation" method="post" novalidate>

            <div class="form-group has-feedback">

                <input type="text" class="form-control" placeholder="Ingresa el Email" name="ingUsuario" required>
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
                <div class="valid-feedback"></div>
                <div class="invalid-feedback"><b>LLene el campo Email.</b></div>

            </div>

            <div class="form-group has-feedback">

                <input type="password" class="form-control" placeholder="Ingresa la Contraseña" name="ingPassword" required>
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                <div class="valid-feedback"></div>
                <div class="invalid-feedback"><b>LLene el campo Contraseña.</b></div>

            </div>
            
            <div class="row">
        
                <div class="col-xs-4">

                    <button type="submit" class="btn btn-success">Ingresar</button>
        
                </div>

            </div>

            <?php

                $login = new ControladorUsuarios();   /* creamos un objeto */
                $login -> ctrIngresoUsuario(); /* instaciamos el metodo ingresoUsuario de la clase */

            ?>

        </form>

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

<!-- /.login-box -->
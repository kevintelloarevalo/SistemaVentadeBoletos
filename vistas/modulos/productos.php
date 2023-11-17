<?php

if($_SESSION["perfil"] == "Vendedor"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

?>

<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Administrar Entradas
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar productos</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAgregarProducto">
          
          Agregar producto

        </button>

      </div>

      <div class="box-body">
        
        <table class="table table-bordered table-striped dt-responsive tablaProductos" width="98%"> 
         
        <thead>
         
        <tr>
           
           <th style="width:10px">#</th>
           <th>Imagen</th>
           <th>Código</th>
           <th>Descripción</th>
           <th>Proveedor</th>
           <th>Categoría</th>
           <th>Stock</th>
           <th>Precio de compra</th>
           <th>Precio de venta</th>
           <th>Acciones</th>
           
         </tr> 

        </thead>      

       </table>

      </div>

    </div>

  </section>

</div>

<!--=====================================
MODAL AGREGAR PRODUCTO
======================================-->

<div id="modalAgregarProducto" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form class="needs-validation" role="form" enctype="multipart/form-data" method="post" novalidate> 

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-bs-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar producto</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL CÓDIGO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-text"><i class="fa fa-code fa-fw"></i></span> 

                <input type="text" class="form-control input-lg form-control-lg" id="nuevoCodigo" name="nuevoCodigo" placeholder="Ingresar código" pattern="[0-9a-zA-ZáéíñóúüÁÉÍÑÓÚÜ_-]{8}" required>

                <!-- Mensajes para validación   -->
                <div class="valid-feedback">¡Campo válido!</div>
                <div class="invalid-feedback">Solo se acepta ##-00000</div>
              
              </div>

            </div>

            <!-- ENTRADA PARA LA DESCRIPCIÓN -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-text"><i class="fa fa-product-hunt fa-fw"></i></span> 

                <input type="text" class="form-control input-lg form-control-lg" name="nuevaDescripcion" placeholder="Ingresar descripción" pattern="[a-zA-Z ]{4,25}" required>
                    <!-- Mensajes para validación   -->
                <div class="valid-feedback">¡Campo válido!</div>
                <div class="invalid-feedback">Solo se acepta letras máximo 20 dígitos.</div>
              
              </div>

            </div>

            <!-- ENTRADA PARA SELECCIONAR PROVEEDOR -->

            <div class="form-group">

              <div class="input-group">
              
                <span class="input-group-text"><i class="fa fa-th fa-fw"></i></span> 

                <select class="form-control input-lg form-control-lg" id="nuevoProveedor" name="nuevoProveedor" required>
                  
                <option value="">Selecionar proveedor</option>

                  <?php

                  $item = null;
                  $valor = null;

                  $proveedores = ControladorProveedores::ctrMostrarProveedor($item, $valor);

                  foreach ($proveedores as $key => $value) {
                    
                    echo '<option value="'.$value["idproveedor"].'">'.$value["proveedor"].'</option>';
                  }

                  ?>

                </select>

                  <div class="valid-feedback">¡Campo válido!</div>
                  <div class="invalid-feedback">Debes seleccionar una categoría.</div>

                  </div>
            </div>

            <!-- ENTRADA PARA SELECCIONAR CATEGORÍA -->

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-text"><i class="fa fa-th fa-fw"></i></span> 

                <select class="form-control input-lg form-control-lg" id="nuevaCategoria" name="nuevaCategoria" required>
                  
                <option value="">Selecionar categoría</option>

                  <?php

                  $item = null;
                  $valor = null;

                  $categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor);

                  foreach ($categorias as $key => $value) {
                    
                    echo '<option value="'.$value["id"].'">'.$value["categoria"].'</option>';  /*evalua el id de la tabla categoria y muestra la categoria */
                  }

                  ?>

                </select>

                  <div class="valid-feedback">¡Campo válido!</div>
                  <div class="invalid-feedback">Debes seleccionar una categoría.</div>

                  </div>

            </div>

             <!-- ENTRADA PARA STOCK -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-text"><i class="fa fa-check fa-fw"></i></span> 

                <input type="text" class="form-control input-lg form-control-lg" name="nuevoStock" min="0" placeholder="Stock" pattern="[0-9]{1,4}"required>

                  <div class="valid-feedback">¡Campo válido!</div>
                  <div class="invalid-feedback">Solo se acepta números.</div>
              </div>

            </div>

             <!-- ENTRADA PARA PRECIO COMPRA -->

            <div class="form-group row">

                <div class="col-10">
                
                  <div class="input-group">
                  
                    <span class="input-group-text"><i class="fa fa-arrow-up fa-fw "></i></span> 

                    <input type="number" class="form-control input-lg form-control-lg" id="nuevoPrecioCompra" name="nuevoPrecioCompra" step="any" min="0" placeholder="Precio Compra" required>
                    <div class="valid-feedback">¡Campo válido!</div>
                    <div class="invalid-feedback">Solo se acepta números.</div>
                  
                  </div>

                </div>

                <!-- ENTRADA PARA PRECIO VENTA -->

                <div class="col-10">
                
                  <div class="input-group">
                  
                    <span class="input-group-text"><i class="fa fa-arrow-down fa-fw"></i></span> 

                    <input type="number" class="form-control input-lg form-control-lg" id="nuevoPrecioVenta" name="nuevoPrecioVenta" step="any" min="0" placeholder="Precio Venta" required>
                    <div class="valid-feedback">¡Campo válido!</div>
                    <div class="invalid-feedback">Solo se acepta números.</div>
                  
                  </div>
                
                </div>
                
            </div>

            <!-- ENTRADA PARA SUBIR FOTO -->

            <div class="form-group">
              
              <div class="panel">SUBIR IMAGEN</div>

              <input type="file" class="nuevaImagen" name="nuevaImagen">


              <img src="vistas/img/productos/default/producto.png" class="img-thumbnail previsualizar" width="100px">

              
            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-success pull-left" data-bs-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar producto</button>

        </div>

      </form>

      <?php

      $crearProducto = new ControladorProductos();
      $crearProducto -> ctrCrearProducto();

      ?>  

    </div>

  </div>

</div>


<!--=====================================
MODAL EDITAR PRODUCTO
======================================-->

<div id="modalEditarProducto" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form class="needs-validation" role="form" enctype="multipart/form-data" method="post" novalidate> 

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-bs-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar producto</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL CÓDIGO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-text"><i class="fa fa-code fa-fw"></i></span> 

                <input type="text" class="form-control input-lg form-control-lg" id="editarCodigo" name="editarCodigo" readonly required>

                <!-- Mensajes para validación   -->
                <div class="valid-feedback">¡Campo válido!</div>
                <div class="invalid-feedback">Solo se acepta números mínimo 2 máximo 5.</div>
              
              </div>

            </div>

            <!-- ENTRADA PARA LA DESCRIPCIÓN -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-text"><i class="fa fa-product-hunt fa-fw"></i></span> 

                <input type="text" class="form-control input-lg form-control-lg" id ="editarDescripcion" name="editarDescripcion" placeholder="Ingresar descripción" required>
                    <!-- Mensajes para validación   -->
                <div class="valid-feedback">¡Campo válido!</div>
                <div class="invalid-feedback">Solo se acepta letras máximo 20 dígitos.</div>
              
              </div>

            </div>

            <!-- ENTRADA PARA SELECCIONAR PROVEEDOR -->

            <div class="form-group">

                <div class="input-group">
                
                  <span class="input-group-text"><i class="fa fa-th fa-fw"></i></span> 

                    <select class="form-control input-lg form-control-lg" name="editarProveedor" readonly required>
                      
                        <option id="editarProveedor"></option>

                    </select>

                        <div class="valid-feedback"></div>

                </div>

            </div>

            <!-- ENTRADA PARA SELECCIONAR CATEGORÍA -->

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-text"><i class="fa fa-th fa-fw"></i></span> 

                  <select class="form-control input-lg form-control-lg"  name="editarCategoria" readonly required>
                    
                    <option id="editarCategoria"></option>

                  </select>

              </div>

            </div>

             <!-- ENTRADA PARA STOCK -->

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-text"><i class="fa fa-check fa-fw"></i></span> 

                <input type="number" class="form-control input-lg form-control-lg" id="editarStock" name="editarStock" min="0" placeholder="Stock" required>

                  <div class="valid-feedback">¡Campo válido!</div>
                  <div class="invalid-feedback">Solo se acepta números.</div>
              </div>

            </div>

             <!-- ENTRADA PARA PRECIO COMPRA -->

            <div class="form-group row">

                <div class="col-10">
                
                  <div class="input-group">
                  
                    <span class="input-group-text"><i class="fa fa-arrow-up fa-fw "></i></span> 

                    <input type="number" class="form-control input-lg form-control-lg" id="editarPrecioCompra" name="editarPrecioCompra" step="any" min="0" placeholder="Precio Compra" required>
                    <div class="valid-feedback">¡Campo válido!</div>
                    <div class="invalid-feedback">Solo se acepta números.</div>
                  
                  </div>

                </div>

                <!-- ENTRADA PARA PRECIO VENTA -->

                <div class="col-10">
                
                  <div class="input-group">
                  
                    <span class="input-group-text"><i class="fa fa-arrow-down fa-fw"></i></span> 

                    <input type="number" class="form-control input-lg form-control-lg" id="editarPrecioVenta" name="editarPrecioVenta" step="any" min="0" placeholder="Precio Venta" pattern="" required>
                    <div class="valid-feedback">¡Campo válido!</div>
                    <div class="invalid-feedback">Solo se acepta números.</div>
                  
                  </div>
                
                </div>
                
            </div>

            <!-- ENTRADA PARA SUBIR FOTO -->

            <div class="form-group">
              
              <div class="panel">SUBIR IMAGEN</div>

              <input type="file" class="nuevaImagen"  name="editarImagen">

                <p class="help-block">Peso máximo de la imagen 2MB</p>

                  <img src="vistas/img/productos/default/producto.png" class="img-thumbnail previsualizar" width="100px">

                  <input type="hidden" name="imagenActual" id="imagenActual">
              
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

      </form>


      <?php

        $editarProducto = new ControladorProductos();
        $editarProducto -> ctrEditarProducto();
      ?>    

    </div>

  </div>

</div>
<?php

  $eliminarProducto = new ControladorProductos();
  $eliminarProducto -> ctrEliminarProducto();

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
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
      
      Administrar productos
    
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
        
        <table class="table table-bordered table-striped dt-responsive tablas" width="100%"> 
         
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

        <tbody>
        <?php

          $item = null;
          $valor = null;

          $productos = ControladorProductos::ctrMostrarProductos($item, $valor);

          foreach ($productos as $key => $value) {
            

            echo '<tr>

                    <td>'.($key+1).'</td>

                    <td>'.$value["imagen"].'</td>

                    <td>'.$value["codigo"].'</td>

                    <td>'.$value["descripcion"].'</td>';
                    
                    $item = "idproveedor";
                    $valor = $value ["idproveedor"];

                    $categoria = ControladorProveedores::ctrMostrarProveedor($item, $valor);

                    echo '<td>'.$categoria["proveedor"].'</td>';


                    $item = "id";
                    $valor = $value ["idcategoria"];

                    $categoria = ControladorCategorias::ctrMostrarCategorias($item, $valor);

                    echo '<td>'.$categoria["categoria"].'</td>

                    <td>'.$value["stock"].'</td>

                    <td>$ '.$value["precio_compra"].'</td>           

                    <td>$ '.$value["precio_venta"].'</td>

                    <td>

                      <div class="btn-group">
                          
                        <button class="btn btn-warning btnEditarCliente" data-toggle="modal" data-target="#modalEditarCliente" idProducto="'.$value["idproducto"].'"><i class="fa fa-pencil"></i></button>';

                      if($_SESSION["perfil"] == "Administrador"){

                          echo '<button class="btn btn-danger btnEliminarCliente" idProducto="'.$value["idproducto"].'"><i class="fa fa-times"></i></button>';

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

                <input type="text" class="form-control input-lg form-control-lg" id="nuevoCodigo" name="nuevoCodigo" placeholder="Ingresar código" pattern="[0-9]{2,5}" required>

                <!-- Mensajes para validación   -->
                <div class="valid-feedback">¡Campo válido!</div>
                <div class="invalid-feedback">Solo se acepta números mínimo 2 máximo 5.</div>
              
              </div>

            </div>

            <!-- ENTRADA PARA LA DESCRIPCIÓN -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-text"><i class="fa fa-product-hunt fa-fw"></i></span> 

                <input type="text" class="form-control input-lg form-control-lg" name="nuevaDescripcion" placeholder="Ingresar descripción" pattern="[a-zA-Z ]{4,15}" required>
                    <!-- Mensajes para validación   -->
                <div class="valid-feedback">¡Campo válido!</div>
                <div class="invalid-feedback">Solo se acepta letras máximo 20 dígitos.</div>
              
              </div>

            </div>

            <!-- ENTRADA PARA SELECCIONAR PROVEEDOR -->

            <div class="form-group">

            <div class="col-12">
              
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

            </div>

            <!-- ENTRADA PARA SELECCIONAR CATEGORÍA -->

            <div class="form-group">

            <div class="col-12">
              
              <div class="input-group">
              
                <span class="input-group-text"><i class="fa fa-th fa-fw"></i></span> 

                <select class="form-control input-lg form-control-lg" id="nuevaCategoria" name="nuevaCategoria" required>
                  
                <option value="">Selecionar categoría</option>

                  <?php

                  $item = null;
                  $valor = null;

                  $categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor);

                  foreach ($categorias as $key => $value) {
                    
                    echo '<option value="'.$value["idcategoria"].'">'.$value["categoria"].'</option>';
                  }

                  ?>

                </select>

                  <div class="valid-feedback">¡Campo válido!</div>
                  <div class="invalid-feedback">Debes seleccionar una categoría.</div>

                  </div>
                </div>

            </div>

             <!-- ENTRADA PARA STOCK -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-text"><i class="fa fa-check fa-fw"></i></span> 

                <input type="text" class="form-control input-lg form-control-lg" name="nuevoStock" min="0" placeholder="Stock" pattern="[0-9]{2,5}"required>

                  <div class="valid-feedback">¡Campo válido!</div>
                  <div class="invalid-feedback">Solo se acepta números.</div>
              </div>

            </div>

             <!-- ENTRADA PARA PRECIO COMPRA -->

            <div class="form-group row">

                <div class="col-10">
                
                  <div class="input-group">
                  
                    <span class="input-group-text"><i class="fa fa-arrow-up fa-fw "></i></span> 

                    <input type="number" class="form-control input-lg form-control-lg" id="nuevoPrecioCompra" name="nuevoPrecioCompra" step="any" min="0" placeholder="Precio Compra" data-inputmask="'mask':'99999999'" data-mask required ="999.999" required>
                    <div class="valid-feedback">¡Campo válido!</div>
                    <div class="invalid-feedback">Solo se acepta números.</div>
                  
                  </div>

                </div>

                <!-- ENTRADA PARA PRECIO VENTA -->

                <div class="col-10">
                
                  <div class="input-group">
                  
                    <span class="input-group-text"><i class="fa fa-arrow-down fa-fw"></i></span> 

                    <input type="number" class="form-control input-lg form-control-lg" id="nuevoPrecioVenta" name="nuevoPrecioVenta" step="any" min="0" placeholder="Precio Venta" pattern="" required>
                    <div class="valid-feedback">¡Campo válido!</div>
                    <div class="invalid-feedback">Solo se acepta números.</div>
                  
                  </div>
                
                </div>
                
            </div>

            <!-- ENTRADA PARA SUBIR FOTO -->

             <div class="form-group">
              
              <div class="panel">SUBIR IMAGEN</div>

              <input type="file" id="nuevaImagen" name="nuevaImagen">


              <img src="vistas/img/productos/default/producto.png" class="img-thumbnail" width="100px">
              
            
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
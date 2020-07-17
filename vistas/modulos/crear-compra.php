<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
        <span><i class="fa fa-shopping-cart"></i></span>
        Crear compra
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Crear compra</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="row">

      <!--=====================================
      EL FORMULARIO
      ======================================-->
      
      <div class="col-lg-5 col-xs-12">
        
        <div class="box box-primary">
          
          <div class="box-header with-border"></div>

          <form role="form" method="post" class="formularioCompra">

            <div class="box-body">
  
              <div class="box">

                <!--=====================================
                ENTRADA DEL COMPRADOR
                ======================================-->
            
                <div class="form-group">
                
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                    <!-- <input type="text" class="form-control" id="nuevoComprador" name="nuevoComprador" value="Usuario Administrador" readonly> -->

                    <input type="text" class="form-control" id="nuevoComprador" value="<?php echo $_SESSION["nombre"]; ?>" readonly>

                    <input type="hidden" name="idComprador" value="<?php echo $_SESSION["id"]; ?>">

                  </div>

                </div> 

                <!--=====================================
                ENTRADA DEL CODIGO FACTURA
                ======================================--> 

                <div class="form-group">
                  
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-key"></i></span>

                    <?php

                    $item = null;
                    $valor = null;

                    $compras = ControladorCompras ::ctrMostrarCompras($item, $valor);

                    if(!$compras){
                      echo'<input type="text" class="form-control" id="nuevaCompra" name="nuevaCompra" value="10001" readonly>';
                    }else{
                      foreach($compras as $key => $value){

                      }

                      $codigo = $value["codigo"]+1;
                      echo'<input type="text" class="form-control" id="nuevaCompra" name="nuevaCompra" value="'.$codigo.'" readonly>';
                    }
                    
                    ?>
                    
                    <!-- <input type="text" class="form-control" id="nuevaCompra" name="nuevaCompra" value="10002343" readonly> -->
                  
                  </div>
                
                </div>

                <!--=====================================
                ENTRADA DEL PROVEEDOR
                ======================================--> 

                <div class="form-group">
                  
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-users"></i></span>
                    
                    <select class="form-control" id="seleccionarProveedor" name="seleccionarProveedor" required>

                    <option value="">Seleccionar proveedor</option>

                    <?php
                    
                      $item = null;
                      $valor = null;

                      $categorias = ControladorProveedores::ctrMostrarProveedores($item, $valor);

                      foreach($categorias as $key => $value){

                        echo'<option value="'.$value["id"].'">'.$value["nombre"].'</option>';

                      }
                    
                    ?>

                    </select>
                    
                    <span class="input-group-addon"><button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#modalAgregarProveedor" data-dismiss="modal">Agregar proveedor</button></span>
                  
                  </div>
                
                </div>

                <!--=====================================
                ENTRADA PARA AGREGAR PRODUCTO
                ======================================--> 

                <div class="form-group row nuevoProducto">


                </div>

                <input type="hidden" id="listaProductosC" name="listaProductosC">

                <!--=====================================
                BOTÓN PARA AGREGAR PRODUCTO
                ======================================-->

                <button type="button" class="btn btn-default hidden-lg btnAgregarProductoC">Agregar producto</button>

                <hr>

                <div class="row">

                  <!--=====================================
                  ENTRADA IMPUESTOS Y TOTAL
                  ======================================-->
                  
                  <div class="col-xs-8 pull-right">
                    
                    <table class="table">

                      <thead>

                        <tr>
                          <th>Impuesto</th>
                          <th>Total</th>      
                        </tr>

                      </thead>

                      <tbody>
                      
                        <tr>
                          
                          <td style="width: 50%">
                            
                            <div class="input-group">
                           
                              <input type="number" class="form-control input-lg" min="0" id="nuevoImpuestoCompra" name="nuevoImpuestoCompra" placeholder="0" required>

                              <input type="hidden" name="nuevoPrecioImpuestoC" id="nuevoPrecioImpuestoC" required>
                              <input type="hidden" name="nuevoPrecioNetoC" id="nuevoPrecioNetoC" required>

                              <span class="input-group-addon"><i class="fa fa-percent"></i></span>
                        
                            </div>

                          </td>

                           <td style="width: 50%">
                            
                            <div class="input-group">
                           
                              <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>

                              <input type="text" class="form-control input-lg" id="nuevoTotalCompra" name="nuevoTotalCompra" total="" placeholder="00000" readonly required>
                              <input type="hidden" name="totalCompra" id="totalCompra">
                        
                            </div>

                          </td>

                        </tr>

                      </tbody>

                    </table>

                  </div>

                </div>

                <hr>

                <!--=====================================
                ENTRADA MÉTODO DE PAGO
                ======================================-->

                <div class="form-group row">
                  
                  <div class="col-xs-6" style="padding-right:0px">
                    
                     <div class="input-group">
                  
                      <select class="form-control" id="nuevoMetodoPagoC" name="nuevoMetodoPagoC" required>
                        <option value="">Seleccione método de pago</option>
                        <option value="Efectivo">Efectivo</option>
                        <option value="TC">Tarjeta Crédito</option>
                        <option value="TD">Tarjeta Débito</option>                  
                      </select>    

                    </div>

                  </div>

                  <div class="cajasMetodoPagoC"></div>

                  <input type="hidden" id="listaMetodoPagoC" name="listaMetodoPagoC">

                  <!-- <div class="col-xs-6" style="padding-left:0px">
                        
                    <div class="input-group">
                         
                      <input type="text" class="form-control" id="nuevoCodigoTransaccionC" name="nuevoCodigoTransaccionC" placeholder="Código transacción"  required>
                           
                      <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                      
                    </div>

                  </div> -->

                </div>

                <br>
      
              </div>

          </div>

          <div class="box-footer">

            <button type="submit" class="btn btn-flat btn-dark pull-right">Guardar compra</button>

          </div>

        </form>

        <?php
          $guardarCompra = new ControladorCompras();
          $guardarCompra -> ctrCrearCompra();
        ?>

        </div>
            
      </div>

      <!--=====================================
      LA TABLA DE PRODUCTOS
      ======================================-->

      <div class="col-lg-7 hidden-md hidden-sm hidden-xs">
        
        <div class="box box-primary">

          <div class="box-header with-border"></div>

          <div class="box-body">
            
            <table class="table table-bordered table-striped dt-responsive tablaCompras" width="100%">
              
               <thead>

                 <tr>
                  <th style="width: 10px">#</th>
                  <th>Imagen</th>
                  <th>Código</th>
                  <th>Nombre</th>
                  <th>Stock</th>
                  <th>Acciones</th>
                </tr>

              </thead>

<!-- 
              <tbody>

                <tr>
                  <td>1.</td>                 
                  <td><img src="vistas/img/productos/default/anonymous.png" class="img-thumbnail" width="40px"></td>
                  <td>00123</td>
                  <td>Lorem ipsum dolor sit amet</td>       
                  <td>20</td>                 
                  <td>                 
                    <div class="btn-group">
                      <button type="button" class="btn btn-primary">Agregar</button> 
                    </div>
                  </td>
                </tr>

              </tbody>
 -->

            </table>

          </div>

        </div>


      </div>

    </div>
   
  </section>

</div>

<!--=====================================
MODAL AGREGAR PROVEEDORES
======================================-->

<div id="modalAgregarProveedor" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#00a65a; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar proveedor</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoProveedor" placeholder="Ingresar nombre de proveedor" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL DOCUMENTO ID -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-key"></i></span> 

                <input type="number" min="0" class="form-control input-lg" name="nuevoDocumentoProveedor" placeholder="Ingresar documento" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL EMAIL -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-envelope"></i></span> 

                <input type="email" class="form-control input-lg" name="nuevoEmail" placeholder="Ingresar email">

              </div>

            </div>

            <!-- ENTRADA PARA EL TELÉFONO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-phone"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoTelefono" placeholder="Ingresar teléfono" data-inputmask="'mask':'(999) 999-9999'" data-mask>

              </div>

            </div>

            <!-- ENTRADA PARA LA DIRECCIÓN -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevaDireccion" placeholder="Ingresar dirección" required>

              </div>

            </div>

            <!-- ENTRADA PARA LA CIUDAD -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevaCiudad" placeholder="Ingresar ciudad" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL NOMBRE CONTACTO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoContacto" placeholder="Ingresar nombre del contacto">

              </div>

            </div>

            <!-- ENTRADA PARA EL TELÉFONO CONTACTO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-phone"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoTelefonoContacto" placeholder="Ingresar teléfono" data-inputmask="'mask':'(999) 999 99 99'" data-mask>

              </div>

            </div>

            <!-- ENTRADA PARA NOTA -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-clipboard"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevaNota" placeholder="Ingresar notas">

              </div>

            </div>

<!-- ==================================================== -->
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-dark">Guardar proveedor</button>

        </div>

      </form>

      <?php

        $crearProveedor = new ControladorProveedores();
        $crearProveedor -> ctrCrearProveedor();

      ?>

    </div>

  </div>

</div>

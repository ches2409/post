<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
        <span><i class="fa fa-shopping-cart"></i></span>
        Editar compra
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Editar compra</li>
    
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

                <?php

                    $item = "id";
                    $valor = $_GET["idCompra"];

                    $compra = ControladorCompras::ctrMostrarCompras($item, $valor);

                    $itemUsuario = "id";
                    $valorUsuario = $compra["id_usuario"];

                    $comprador = ControladorUsuarios::ctrMostrarUsuarios($itemUsuario, $valorUsuario);

                    $itemProveedor = "id";
                    $valorProveedor = $compra["id_proveedor"];

                    $proveedor = ControladorProveedores::ctrMostrarProveedores($itemProveedor, $valorProveedor);

                    $porcentajeImpuestoC = $compra["impuesto"] * 100 / $compra["neto"];

                ?>

                <!--=====================================
                ENTRADA DEL COMPRADOR
                ======================================-->
            
                <div class="form-group">
                
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                    <!-- <input type="text" class="form-control" id="nuevoComprador" name="nuevoComprador" value="Usuario Administrador" readonly> -->

                    <input type="text" class="form-control" id="nuevoComprador" value="<?php echo $comprador["nombre"]; ?>" readonly>

                    <input type="hidden" name="idComprador" value="<?php echo $comprador["id"]; ?>">

                  </div>

                </div> 

                <!--=====================================
                ENTRADA DEL CODIGO FACTURA
                ======================================--> 

                <div class="form-group">
                  
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-key"></i></span>


                    <input type="text" class="form-control" id="nuevaCompra" name="editarCompra" value="<?php echo $compra["codigo"]; ?>" readonly>
                    
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

                    <option value="<?php echo $proveedor["id"]; ?>"><?php echo $proveedor["nombre"]; ?></option>

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

                <?php
                
                    $listaProductoC = json_decode($compra["productos"], true);
                    // var_dump($listaProductoC);

                    foreach($listaProductoC as $key =>$value){

                        $item = "id";
                        $valor = $value["id"];
                        $orden = "id";

                        $respuesta = ControladorProductos::ctrMostrarProductos($item, $valor, $orden);
                        // var_dump($respuesta);
                        $stockAntiguo = $respuesta["stock"] - $value["cantidad"];

                        echo'
                        
                            <div class="row" style="padding:5px 15px">
                    
                                

                                <div class="col-xs-6" style="padding-right:0px">

                                    <div class="input-group">

                                        <span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarProducto" idProducto="'.$value["id"].'"><i class="fa fa-times"></i></button></span>

                                        <input type="text" class="form-control agregarProductoCompra" idProducto="'.$value["id"].'" name="agregarProductoCompra" value="'.$value["nombre"].'" readOnly required>

                                    </div>

                                </div>

                                

                                <div class="col-xs-3">

                                    <input type="number" class="form-control nuevaCantidadProductoC" name="nuevaCantidadProductoC" min="1" value="'.$value["cantidad"].'" stock="'.$stockAntiguo.'" nuevoStockC="'.$value["stock"].'" required>

                                </div>

                                

                                <div class="col-xs-3 ingresoPrecioC" style="padding-left:0px">

                                    <div class="input-group">

                                        <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>

                                        <input type="text" class="form-control nuevoPrecioProductoC" precioRealC="'.$respuesta["precio_compra"].'" name="nuevoPrecioProductoC" value="'.$value["total"].'" readonly required>
                        
                                    </div>

                                </div>

                            </div> 

                        ';

                    }

                ?>

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
                           
                              <input type="number" class="form-control input-lg" min="0" id="nuevoImpuestoCompra" name="nuevoImpuestoCompra" value="<?php echo $porcentajeImpuestoC; ?>" required>

                              <input type="hidden" name="nuevoPrecioImpuestoC" id="nuevoPrecioImpuestoC" value="<?php echo $compra["impuesto"]; ?>" required>
                              <input type="hidden" name="nuevoPrecioNetoC" id="nuevoPrecioNetoC" value="<?php echo $compra["neto"]; ?>" required>

                              <span class="input-group-addon"><i class="fa fa-percent"></i></span>
                        
                            </div>

                          </td>

                           <td style="width: 50%">
                            
                            <div class="input-group">
                           
                              <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>

                              <input type="text" class="form-control input-lg" id="nuevoTotalCompra" name="nuevoTotalCompra" total="" value="<?php echo $compra["total"]; ?>" readonly required>
                              <input type="hidden" name="totalCompra" value="<?php echo $compra["total"]; ?>" id="totalCompra">
                        
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

            <button type="submit" class="btn btn-flat btn-dark pull-right">Guardar cambios</button>

          </div>

        </form>

        <?php
          $editarCompra = new ControladorCompras();
          $editarCompra -> ctrEditarCompra();
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

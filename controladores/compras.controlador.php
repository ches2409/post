<?php

class ControladorCompras{

    // =====================================
    //     MOSTRAR COMPRAS
    // ====================================== 

    static public function ctrMostrarCompras($item, $valor){
        $tabla = "compras";
        $respuesta = ModeloCompras::mdlMostrarCompras($tabla, $item, $valor);

        return $respuesta;
    }

    /*=====================================
        CREAR COMPRA
    =====================================*/ 

    static public function ctrCrearCompra(){
        
        if(isset($_POST["nuevaCompra"])){

            /*=====================================
                ACTUALIZAR LAS VENTAS DEL PROVEEDOR, AUMENTAR EL STOCK Y AUMENTAR LAS COMPRAS DE LOS PRODUCTOS
            =====================================*/ 

            $listaProductosC = json_decode($_POST["listaProductosC"], true);

            $totalProductosVendidos = array();

            foreach($listaProductosC as $key => $value){

                array_push($totalProductosVendidos, $value["cantidad"]);

                $tablaProductos = "productos";

                $item = "id";
                $valor = $value["id"];
                $orden = "id";

                $traerProducto = ModeloProductos::mdlMostrarProductos($tablaProductos, $item, $valor, $orden);

                $item1a = "compras";
                $valor1a = $value["cantidad"] + $traerProducto["compras"];

                $nuevasCompras= ModeloProductos::mdlActualizarProducto($tablaProductos, $item1a, $valor1a, $valor);

                $item1b = "stock";
                $valor1b = $value["stock"];

                $nuevoStock = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1b, $valor1b, $valor);


            }

            $tablaProveedores = "proveedores";

            $item= "id";
            $valor= $_POST["seleccionarProveedor"];

            $traerProveedor = ModeloProveedores::mdlMostrarProveedores($tablaProveedores, $item, $valor);

            $item1a= "ventas";
            $valor1a = array_sum($totalProductosVendidos) + $traerProveedor["ventas"];

            $ventasProveedor = ModeloProveedores::mdlActualizarProveedor($tablaProveedores, $item1a, $valor1a, $valor);

            $item1b= "ultima_venta";
            date_default_timezone_set('America/Bogota');

			$fecha = date('Y-m-d');
			$hora = date('H:i:s');
			$valor1b = $fecha.' '.$hora;

            $fechaProveedor = ModeloProveedores::mdlActualizarProveedor($tablaProveedores, $item1b, $valor1b, $valor);
        

            /*=====================================
                GUARDAR LA COMPRA
            =====================================*/ 

            $tabla = "compras";
            // var_dump($tabla);


            $datos = array("id_usuario"=>$_POST["idComprador"],
                        "id_proveedor"=>$_POST["seleccionarProveedor"],
                        "codigo"=>$_POST["nuevaCompra"],
                        "productos"=>$_POST["listaProductosC"],
                        "impuesto"=>$_POST["nuevoPrecioImpuestoC"],
                        "neto"=>$_POST["nuevoPrecioNetoC"],
                        "total"=>$_POST["totalCompra"],
                        "metodo_pago"=>$_POST["listaMetodoPagoC"]);

            $respuesta = ModeloCompras::mdlIngresarCompra($tabla, $datos);

            if($respuesta == "ok"){

                echo'<script>
                    localStorage.removeItem("rango");

                    swal({
                        type: "success",
                        title: "La compra ha sido guardada correctamente",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
                        }).then((result)=>{
                            if(result.value){
                                window.location = "compras";
                            }
                        })
                    </script>';
            }
        
        }
    }


    
    /*=====================================
        EDITAR COMPRA
    =====================================*/ 

    static public function ctrEditarCompra(){
        
        if(isset($_POST["editarCompra"])){

            /*=====================================
                FORMATEAR LA TABLA DE PRODUCTOS Y DE PROVEEDORES
            =====================================*/ 

            $tabla = "compras";

            $item = "codigo";
            $valor = $_POST["editarCompra"];
            $orden = "id";

            $traerCompra = ModeloCompras::mdlMostrarCompras($tabla, $item, $valor, $orden);

            $productosC = json_decode($traerCompra["productos"], true);
            // var_dump($productosC);

            $totalProductosVendidos = array();

            foreach($productosC as $key => $value){

                array_push($totalProductosVendidos, $value["cantidad"]);

                $tablaProductos = "productos";

                $item = "id";
                $valor = $value["id"];
                $orden = "id";

                $traerProducto = ModeloProductos::mdlMostrarProductos($tablaProductos, $item, $valor, $orden);

                $item1a = "compras";
                $valor1a = $traerProducto["compras"] - $value["cantidad"];

                $nuevasCompras= ModeloProductos::mdlActualizarProducto($tablaProductos, $item1a, $valor1a, $valor);

                $item1b = "stock";
                $valor1b = $traerProducto["stock"] - $value["cantidad"];

                $nuevoStockC = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1b, $valor1b, $valor);
                // var_dump($valor1b);

            }
            $tablaProveedores = "proveedores";

            $itemProveedor= "id";
            $valorProveedor= $_POST["seleccionarProveedor"];

            $traerProveedor = ModeloProveedores::mdlMostrarProveedores($tablaProveedores, $itemProveedor, $valorProveedor);

            $item1a= "ventas";
            $valor1a = $traerProveedor["ventas"] - array_sum($totalProductosVendidos);

            $ventasProveedor = ModeloProveedores::mdlActualizarProveedor($tablaProveedores, $item1a, $valor1a, $valor);

            /*=====================================
                ACTUALIZAR LAS VENTAS DEL PROVEEDOR, AUMENTAR EL STOCK Y AUMENTAR LAS COMPRAS DE LOS PRODUCTOS
            =====================================*/ 

            $listaProductosC_2 = json_decode($_POST["listaProductosC"], true);

            $totalProductosVendidos_2 = array();

            foreach($listaProductosC_2 as $key => $value){

                array_push($totalProductosVendidos_2, $value["cantidad"]);

                $tablaProductos_2 = "productos";

                $item_2 = "id";
                $valor_2 = $value["id"];
                $orden = "id";

                $traerProducto_2 = ModeloProductos::mdlMostrarProductos($tablaProductos, $item, $valor, $orden);

                $item1a_2 = "compras";
                $valor1a_2 = $value["cantidad"] + $traerProducto["compras"];

                $nuevasCompras_2= ModeloProductos::mdlActualizarProducto($tablaProductos, $item1a, $valor1a, $valor);

                $item1b_2 = "stock";
                $valor1b_2 = $value["stock"];

                $nuevoStockC_2 = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1b, $valor1b, $valor);


            }

            $tablaProveedores_2 = "proveedores";

            $item_2= "id";
            $valor_2= $_POST["seleccionarProveedor"];

            $traerProveedor_2 = ModeloProveedores::mdlMostrarProveedores($tablaProveedores, $item, $valor);

            $item1a_2= "ventas";
            $valor1a_2 = array_sum($totalProductosVendidos) + $traerProveedor["ventas"];

            $ventasProveedor_2 = ModeloProveedores::mdlActualizarProveedor($tablaProveedores, $item1a, $valor1a, $valor);

            $item1b_2= "ultima_venta";
            date_default_timezone_set('America/Bogota');

			$fecha = date('Y-m-d');
			$hora = date('H:i:s');
			$valor1b_2 = $fecha.' '.$hora;

            $fechaProveedor_2 = ModeloProveedores::mdlActualizarProveedor($tablaProveedores, $item1b, $valor1b, $valor);
        

            /*=====================================
                GUARDAR CAMBIOS DE LA COMPRA
            =====================================*/ 

            $tabla = "compras";
            // var_dump($tabla);


            $datos = array("id_usuario"=>$_POST["idComprador"],
                        "id_proveedor"=>$_POST["seleccionarProveedor"],
                        "codigo"=>$_POST["editarCompra"],
                        "productos"=>$_POST["listaProductosC"],
                        "impuesto"=>$_POST["nuevoPrecioImpuestoC"],
                        "neto"=>$_POST["nuevoPrecioNetoC"],
                        "total"=>$_POST["totalCompra"],
                        "metodo_pago"=>$_POST["listaMetodoPagoC"]);

            $respuesta = ModeloCompras::mdlEditarCompra($tabla, $datos);

            if($respuesta == "ok"){

                echo'<script>
                    localStorage.removeItem("rango");

                    swal({
                        type: "success",
                        title: "La compra ha sido editada correctamente",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
                        }).then((result)=>{
                            if(result.value){
                                window.location = "compras";
                            }
                        })
                    </script>';
            }
        
        }
    }

}
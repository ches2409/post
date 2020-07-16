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
}
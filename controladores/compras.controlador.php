<?php

class ControladorCompras{

    // =====================================
    //     MOSTRAR COMPRAS
    // ====================================== 

    static public function ctrMostrarCompras ($item, $valor){
        $tabla = "compras";
        $respuesta = ModeloCompras::mdlMostrarCompras($tabla, $item, $valor);

        return $respuesta;
    }

    /*=====================================
        CREAR COMPRA
    =====================================*/ 

    static public function ctrCrearCompra (){
        
        if(isset($_POST["nuevaCompra"])){

            /*=====================================
                ACTUALIZAR LAS VENTAS DEL PROVEEDOR, AUMENTAR EL STOCK Y AUMENTAR LAS COMPRAS DE LOS PRODUCTOS
            =====================================*/ 

            $listaProductosC = json_decode($_POST["listaProductosC"], true);
            // var_dump($listaProductosC);

            $totalProductosVendidos = array();

            foreach($listaProductosC as $key => $value){

                array_push($totalProductosVendidos, $value["cantidad"]);

                $tablaProductos = "productos";

                $item = "id";
                $valor = $value["id"];
                $orden = "id";

                $traerProductoC = ModeloProductos::mdlMostrarProductos($tablaProductos, $item, $valor, $orden);

                $item1a = "compras";
                $valor1a = $value["cantidad"] + $traerProductoC["compras"];

                $nuevasCompras= ModeloProductos::mdlActualizarProducto($tablaProductos, $item1a, $valor1a, $valor);

                $item1b = "stock";
                $valor1b = $value["stock"];

                $nuevoStock = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1b, $valor1b, $valor);



            }

            $tablaProveedores = "proveedores";

            $item= "id";
            $valor= $_POST["seleccionarProveedor"];

            $traerProveedor = ModeloProveedores::mdlMostrarProveedores($tablaProveedores, $item, $valor);
            // var_dump($traerProveedor["ventas"]);

            $item1= "ventas";
            $valor1 = array_sum($totalProductosVendidos) + $traerProveedor["ventas"];

            $ventasProveedor = ModeloProveedores::mdlActualizarProveedor($tablaProveedores, $item1, $valor1, $valor);
        }

    }
}
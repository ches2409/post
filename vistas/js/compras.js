/*=============================================
CARGAR LA TABLA DINÁMICA DE PRODUCTOS
=============================================*/

// $.ajax({

// 	url: "ajax/datatable-compras.ajax.php",
// 	success:function(respuesta){

// 		console.log("respuesta", respuesta);

// 	}

// })


$('.tablaCompras').DataTable({
    "ajax": "ajax/datatable-compras.ajax.php",
    "deferRender": true,
    "retrieve": true,
    "processing": true,
    "language": {

        "sProcessing": "Procesando...",
        "sLengthMenu": "Mostrar _MENU_ registros",
        "sZeroRecords": "No se encontraron resultados",
        "sEmptyTable": "Ningún dato disponible en esta tabla",
        "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
        "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0",
        "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix": "",
        "sSearch": "Buscar:",
        "sUrl": "",
        "sInfoThousands": ",",
        "sLoadingRecords": "Cargando...",
        "oPaginate": {
            "sFirst": "Primero",
            "sLast": "Último",
            "sNext": "Siguiente",
            "sPrevious": "Anterior"
        },
        "oAria": {
            "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        }

    }

});

/*=============================================
AGREGANDO PRODUCTOS A LA COMPRA DESDE LA TABLA
=============================================*/

$(".tablaCompras tbody").on("click", "button.agregarProducto", function(){

    let idProducto = $(this).attr("idProducto");
    // console.log('idProducto:', idProducto)
    
    $(this).removeClass("btn-primary agregarProducto");
    $(this).addClass("btn-default");

    let datos = new FormData();
    datos.append("idProducto", idProducto);

    $.ajax({
        url:"ajax/productos.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success:function(respuesta){
            
            // console.log('respuesta:', respuesta);

            let nombre = respuesta["nombre"];
            let stock = respuesta["stock"];
            let precio = respuesta["precio_compra"];

            $(".nuevoProducto").append(

                '<div class="row" style="padding:5px 15px">'+
                
                    '<!--Descripción del producto-->'+

                    '<div class="col-xs-6" style="padding-right:0px">'+

                        '<div class="input-group">'+

                            '<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarProducto" idProducto="'+idProducto+'"><i class="fa fa-times"></i></button></span>'+

                            '<input type="text" class="form-control" id="agregarProductoCompra" name="agregarProductoCompra" value="'+nombre+'" readOnly required>'+

                        '</div>'+

                    '</div>'+

                    '<!-- Cantidad del producto -->'+

                    '<div class="col-xs-3">'+

                        '<input type="number" class="form-control" id="nuevaCantidadProductoC" name="nuevaCantidadProductoC" min="1" value="1" stock="'+stock+'" required>'+

                    '</div>'+

                    '<!-- Precio del producto -->'+

                    '<div class="col-xs-3" style="padding-left:0px">'+

                        '<div class="input-group">'+

                            '<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+

                            '<input type="number" min="1" class="form-control" id="nuevoPrecioProductoC" name="nuevoPrecioProductoC" value="'+precio+'" readonly required>'+
            
                        '</div>'+

                    '</div>'+

                '</div>'             
            )
        }
    })
});

/*=============================================
    QUITAR PRODUCTOS DE LA COMPRA Y RECUPERAR BOTON
=============================================*/
$(".formularioCompra").on("click", "button.quitarProducto", function () {

    $(this).parent().parent().parent().parent().remove();

    let idProducto = $(this).attr("idProducto");
    $("button.recuperarBoton[idProducto='"+idProducto+"']").removeClass('btn-default');
    $("button.recuperarBoton[idProducto='"+idProducto+"']").addClass('btn-primary agregarProducto');

})
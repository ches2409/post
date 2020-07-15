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

                            '<input type="text" class="form-control agregarProductoCompra" name="agregarProductoCompra" value="'+nombre+'" readOnly required>'+

                        '</div>'+

                    '</div>'+

                    '<!-- Cantidad del producto -->'+

                    '<div class="col-xs-3">'+

                        '<input type="number" class="form-control nuevaCantidadProductoC" name="nuevaCantidadProductoC" min="1" value="1" stock="'+stock+'" required>'+

                    '</div>'+

                    '<!-- Precio del producto -->'+

                    '<div class="col-xs-3 ingresoPrecioC" style="padding-left:0px">'+

                        '<div class="input-group">'+

                            '<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+

                            '<input type="number" min="1" class="form-control nuevoPrecioProductoC" precioRealC="'+precio+'" name="nuevoPrecioProductoC" value="'+precio+'" readonly required>'+
            
                        '</div>'+

                    '</div>'+

                '</div>'             
            )
        }
    })
});
/*=============================================
    CARGAR LA TABLA AL NAVEGAR EN ELLA
=============================================*/

$(".tablaCompras").on("draw.dt", function(){
    
    if(localStorage.getItem("quitarProducto")!=null){
        let listaIdProductos = JSON.parse(localStorage.getItem("quitarProducto"));
        for(let i = 0; i<listaIdProductos.length; i++){
            $("button.recuperarBoton[idProducto='"+listaIdProductos[i]["idProducto"]+"']").removeClass('btn-default');
            $("button.recuperarBoton[idProducto='"+listaIdProductos[i]["idProducto"]+"']").addClass('btn-primary agregarProducto');
        }
    }
})

/*=============================================
    QUITAR PRODUCTOS DE LA COMPRA Y RECUPERAR BOTON
=============================================*/

// let idQuitarProducto = [];


$(".formularioCompra").on("click", "button.quitarProducto", function () {

    $(this).parent().parent().parent().parent().remove();

    let idProducto = $(this).attr("idProducto");

/*=============================================
ALMACENAR EN LOCALSTORAGE EL ID DEL PRODUCTOS A QUITAR
=============================================*/

    if(localStorage.getItem("quitarProducto")==null){
        idQuitarProducto=[];
    }else{
        idQuitarProducto.concat(localStorage.getItem("quitarProducto"))
    }
    idQuitarProducto.push({"idProducto":idProducto});
    localStorage.setItem("quitarProducto", JSON.stringify(idQuitarProducto));

    $("button.recuperarBoton[idProducto='"+idProducto+"']").removeClass('btn-default');
    $("button.recuperarBoton[idProducto='"+idProducto+"']").addClass('btn-primary agregarProducto');

})

/*=============================================
AGREGANDO PRODUCTOS DESDE EL BOTON PARA DISPOSITVOS
=============================================*/

//  let numProducto = 0;

$(".btnAgregarProductoC").click(function(){

    numProducto ++;

    let datos = new FormData();
    datos.append("traerProductos", "ok");

    $.ajax({

        url: "ajax/productos.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            
            $(".nuevoProducto").append(

                '<div class="row" style="padding:5px 15px">' +

                    '<!--Nombre del producto-->' +

                    '<div class="col-xs-6" style="padding-right:0px">' +

                        '<div class="input-group">' +

                            '<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarProducto" idProducto><i class="fa fa-times"></i></button></span>' +

                            '<select class="form-control nuevoNombreProducto" id="productoC'+numProducto+'" idProducto name="nuevoNombreProducto" required>' +

                                '<option>Seleccione el producto</option>' +

                            '</select>'+

                        '</div>' +

                    '</div>' +

                    '<!-- Cantidad del producto -->' +

                    '<div class="col-xs-3 ingresoCantidadC">' +

                        '<input type="number" class="form-control nuevaCantidadProductoC" name="nuevaCantidadProductoC" min="1" value="1" stock required>' +

                    '</div>' +

                    '<!-- Precio del producto -->' +

                    '<div class="col-xs-3 ingresoPrecioC" style="padding-left:0px">' +

                        '<div class="input-group">' +

                            '<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>' +

                            '<input type="number" min="1" class="form-control nuevoPrecioProductoC" precioRealC name="nuevoPrecioProductoC" readonly required>' +

                        '</div>' +

                    '</div>' +

                '</div>'
            );

            // AGREGAR PRODUCTOS AL SELECT

            respuesta.forEach(funcionForEach);

            function funcionForEach(item, index){

                $("#productoC"+numProducto).append(

                    '<option idProducto="'+item.id+'" value="'+item.nombre+'">'+item.nombre+'</option>'

                )

            }

        }


    })
})

/*=============================================
    SELECCIONAR PRODUCTO
=============================================*/

$(".formularioCompra").on("change", "select.nuevoNombreProducto", function () {

    let nombreProducto = $(this).val();
    let nuevoPrecioProductoC = $(this).parent().parent().parent().children(".ingresoPrecioC").children().children(".nuevoPrecioProductoC");
    let nuevaCantidadProductoC = $(this).parent().parent().parent().children(".ingresoCantidadC").children(".nuevaCantidadProductoC");

    // console.log('nombreProducto:', nombreProducto)


    let datos = new FormData();
    datos.append("nombreProducto", nombreProducto);

    $.ajax({

        url: "ajax/productos.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            
            $(nuevaCantidadProductoC).attr("stock", respuesta["stock"]);
            $(nuevoPrecioProductoC).val(respuesta["precio_compra"]);
            $(nuevoPrecioProductoC).attr("precioRealC", respuesta["precio_Compra"]);

        }
    })
})

/*=============================================
    MODIFICAR LA CANTIDAD
=============================================*/

$(".formularioCompra").on("change", "input.nuevaCantidadProductoC", function () {

    let precioC = $(this).parent().parent().children(".ingresoPrecioC").children().children(".nuevoPrecioProductoC");
     
    let precioFinalC = $(this).val() * precioC.attr("precioRealC");

    precioC.val(precioFinalC);

})
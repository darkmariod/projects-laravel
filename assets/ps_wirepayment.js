$(document).ready(function () {

    function validate_stock_contifico(){
        var id_cart = $('input[name="id_cart_comp"]').val();

        if(id_cart>0 && id_cart!=null){
            $.ajax({
                type: "POST",
                accepts: "application/json",
                data: {
                   proceso: 'ValidarStockCarritoCompras',
                   id_cart: id_cart
                },
                 url: "/modules/contifico/ajax.php",
                 beforeSend: function(){
                     
                 },
                 success: function(data){
                    if(data.length != null){
                       response = $.parseJSON(data);
                       if(response.result){
                            var URL_CARRITO_DE_COMPRAS= response.URL_CARRITO_DE_COMPRAS;
                            var REDIRIGIR_SIN_STOCK = response.REDIRIGIR_SIN_STOCK
    
                            if(REDIRIGIR_SIN_STOCK){
                                // Redirige la pestaña actual a la URL_CARRITO_DE_COMPRAS
                                setTimeout(function() {
                                    window.location.href = URL_CARRITO_DE_COMPRAS;
                                }, 3000);

                                $('#mensaje_validacion_stock').html('Hay productos en tu carrito sin stock. Serás redirigido a tu carrito de compras.');
                                
                            } else {
                                // Oculta el modal si no es necesario redirigir
                                $('#validate-stock-modal').modal('hide');
                            }
                         
                       }else{
                           //$('#message_factura').html(response.StatusMessage);
                           //$('#message_factura').css('color','red');
                           console.log(response.StatusMessage);
                           $('#validate-stock-modal').modal('hide');
    
       
                       }
                    }else{
                      console.log("Error de servicio, vuelva a intentarlo en unos minutos");
                      $('#validate-stock-modal').modal('hide');
    
                       //$('#message_factura').html("Error de servicio, vuelva a intentarlo en unos minutos");
                    }
                 },
                 error: function(data){
                   console.log("Error de servicio, vuelva a intentarlo en unos minutos");
                   $('#validate-stock-modal').modal('hide');
    
                 }
             });
        }else{
            $('#validate-stock-modal').modal('hide');

        }
    }

    

    $('#btn_validate_stock_modal').click(function(){
        
        validate_stock_contifico();
    });


    $('input[data-module-name="ps_wirepayment"]').click(function(){
        var payment = $('input[name="payment-option"]:checked').data('module-name');
        var valida_payment = $('input[name="validado_comp"]').val();

        if(payment === 'ps_wirepayment' && valida_payment === '0'){
            $("#payment-confirmation > div.ps-shown-by-js > button").attr('disabled','disabled');
            return true;
        }else{
            $("#payment-confirmation > div.ps-shown-by-js > button").removeAttr('disabled');
            return true;
        }
    });
    
    $('input[name="conditions_to_approve[terms-and-conditions]"]').click(function(){
        var payment = $('input[name="payment-option"]:checked').data('module-name');
        var valida_payment = $('input[name="validado_comp"]').val();
        
        console.log('seleccionado ' + payment + ' ' + valida_payment);

        if(payment === 'ps_wirepayment' && valida_payment === '0'){
            alert("Tiene que subir primero el comprobante de transferencia de pago para continuar, presiona el boton 'Click aqui para subir comprobante.' para poder continuar con el pedido!");
            $("#payment-confirmation > div.ps-shown-by-js > button").attr('disabled','disabled');
            return false;
        }else { 
            $("#payment-confirmation > div.ps-shown-by-js > button").removeAttr('disabled');
            return true;
        }

        
        return false;
    });

    $('#payment-confirmation > div.ps-shown-by-js > button').click(function(){
        var payment = $('input[name="payment-option"]:checked').data('module-name');
        var valida_payment = $('input[name="validado_comp"]').val();

        console.log(payment);
        console.log(valida_payment);

        if(payment === 'ps_wirepayment' && valida_payment === '0'){
            alert("Tiene que subir primero el comprobante de transferencia de pago para continuar, presiona el boton 'Click aqui para subir comprobante.' para poder continuar con el pedido!");
            $("#payment-confirmation > div.ps-shown-by-js > button").attr('disabled','disabled');
            return false;
        }else{
            return true;
        }

    });

    $('input[name="payment-option"]').on('change', function () {
        // Obtener el valor del atributo 'data-module-name' de la opci�n de pago seleccionada
        var payment = $(this).data('module-name');
        var valida_payment = $('input[name="validado_comp"]').val();

        if(payment === 'ps_wirepayment' && valida_payment === '0'){
            $("#payment-confirmation > div.ps-shown-by-js > button").attr('disabled','disabled');
            return true;
        }else{
            $("#payment-confirmation > div.ps-shown-by-js > button").removeAttr('disabled');
            return true;
        }
    });

    // Verifica si el elemento con el ID checkout-payment-step tiene la clase js-current-step
    if ($('#checkout-payment-step').hasClass('js-current-step')) {
        // Busca el siguiente botón con el ID btn_validate_stock_modal y haz clic en él
        var nextButton = $('#btn_validate_stock_modal');
        if (nextButton.length > 0) {
            nextButton.click();
            validate_stock_contifico();
        } else {
            console.error('No se pudo encontrar el botón con el ID btn_validate_stock_modal.');
        }
    }
    /*$('input[data-module-name="ps_wirepayment"]').click(function(){
        var payment = $(this).data('module-name');
        var valida_payment = $('input[name="validado_comp"]').val();
        if(payment === 'ps_wirepayment' && valida_payment === '0'){
            //alert('Tiene que subir primero el comprobante de transferencia de pago para continuar, en Mas Informacion!');
            $("#payment-confirmation > div.ps-shown-by-js > button").attr('disabled','disabled');
            return false;
        }else{
            $("#payment-confirmation > div.ps-shown-by-js > button").removeAttr('disabled');
            return true;
        }
        return false;
    });*/
        
});
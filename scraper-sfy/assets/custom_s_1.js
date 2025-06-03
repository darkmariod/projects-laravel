 $(document).ready(function(){
    if ($('input[name="address1"]').length > 0) {
        $('input[name="address1"]').attr('placeholder', 'Ej: Av. Primera 506 Entre Calle Segunda y Calle Tercera');
        console.log('Existe Direccion');
        $('div input[name="address1"]').after('Si no ingresa su dirección completa puede atrasar la entrega');
    }
    
    if ($('input[name="address2"]').length > 0) {
        $('input[name="address2"]').attr('placeholder', 'Mz y Villa | Bloque o Piso | Referencia de Entrega');
    }

    if ($('input[name="alias"]').length > 0) {
        $('input[name="alias"]').attr('placeholder', 'Casa, Oficina, etc');
    }

    if ($('body[id="product"]').length > 0) {
        $('#product-infos-tabs > li:nth-child(2) > a').click();
        console.log('Entra aquí');
    }

    if ($('input[name="vat_number"]').length > 0) {
        $('input[name="vat_number"]').attr('required', true);
        $('input[name="vat_number"]').attr('maxlength', '13');
        $('#field-dni').on('input', function () { 
            this.value = this.value.replace(/[^0-9]/g,'');
        });
    }
});

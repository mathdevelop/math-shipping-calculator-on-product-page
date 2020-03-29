jQuery(document).ready(function($) {
    $('#mscpp-calculator button').click(function() {
        $('#mscpp-calculator .result table').hide();

        var postal_code = $('#mscpp-calculator input').val();

        if(/^[0-9]{5}-[0-9]{3}$/.test(postal_code)) {
            var variation_id = $('[name=variation_id]');

            if(variation_id.length && !parseInt(variation_id.val())) {
                $('#mscpp-calculator > span').html('Escolha uma variação para calcular');
            } else {
                $('#mscpp-calculator > span').html('');
                $('#mscpp-calculator .result span').show();
                var data = {
                    'action': 'mscpp_calculate',
                    'product': variation_id.length ? variation_id.val() : $('[name=add-to-cart]').val(),
                    'quantity': $('.qty').val(),
                    'postal_code': postal_code
                };

                $.post(ajax_object.ajax_url, data, function(response) {
                    var html = '';

                    $.each(response, function(index, value) {
                        html += `<tr><td>${ value.label }</td><td>R$ ${ value.cost.replace('.', ',') }</td><td>Entrega em ${ value.delivery_forecast } dias úteis</td></tr>`;
                    });

                    $('#mscpp-calculator .result table tbody').html(html);

                    $('#mscpp-calculator .result span').hide();
                    $('#mscpp-calculator .result table').slideDown('slow');
                }, 'json');
            }
        } else {
            $('#mscpp-calculator > span').html('Informe um CEP válido (Ex: 00000-000)');
        }
    });

    $('#mscpp-calculator .result table').click(function() {
        $(this).slideUp('slow');
    });
});
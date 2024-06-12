$(document).ready(function() {
    function updateCart(id, quantity, url, row) {
        $.ajax({
            url: url,
            type: 'POST',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                quantity: quantity
            },
            success: function(response) {
                if (response.success) {
                    if (response.remove) {
                        row.remove();
                        if(response.overall == 0){
                            $('#cart-table').remove();
                            $('.table-responsive').append('<p>Your cart is empty</p>');
                        }
                        updateOverallTotal(response.overall);
                    } else {
                        var price = parseFloat(row.find('.product-price').text());
                        var total = price * quantity;
                        row.find('.product-total').text(total.toFixed(2));

                        // Update overall cart total
                        updateOverallTotal(response.overall);
                    }
                }
            }
        });
    }

    function updateOverallTotal(overall) {
        $('.product-total').text(overall.toFixed(2));
        $('.product-total-2').text(overall.toFixed(2));
    }

    $('.btn-minus').click(function() {
        var row = $(this).closest('tr');
        var input = row.find('.cart-quantity');
        var quantity = parseInt(input.val()) - 1;
        var url = $(this).data('url');
        var id = $(this).data('id');
        if (quantity >= 0) {
            input.val(quantity);
            updateCart(id, quantity, url, row);
        }
    });

    $('.btn-plus').click(function() {
        var row = $(this).closest('tr');
        var input = row.find('.cart-quantity');
        var quantity = parseInt(input.val()) + 1;
        var url = $(this).data('url');
        var id = $(this).data('id');
        input.val(quantity);
        updateCart(id, quantity, url, row);
    });

    $('.cart-quantity').change(function() {
        var row = $(this).closest('tr');
        var quantity = parseInt($(this).val());
        var url = $(this).data('url');
        var id = $(this).data('id');
        if (quantity >= 0) {
            updateCart(id, quantity, url, row);
        } else {
            $(this).val(0);
        }
    });

});

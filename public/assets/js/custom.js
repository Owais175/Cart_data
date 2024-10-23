$(document).ready(function () {

    // Assume this is your shipping cost (you can calculate it based on conditions)
    var shippingCost = 15.00; // Example shipping cost

    // Update shipping cost when the cart is updated
    function updateShipping() {
        // You can set the shipping based on conditions or calculations
        $('#shipping').text(shippingCost.toFixed(2));
        // Update the overall total
        updateTotal();
    }

    // Increment quantity
    $('.increment').click(function () {
        var counter = $(this).parent().find('input');
        var count = parseInt(counter.val()) || 0;
        count++;
        counter.val(count);
        updatecount(counter);  // Update individual row subtotal
        updateSubtotal();      // Update overall subtotal
    });

    // Decrement quantity
    $('.decrement').click(function () {
        var counter = $(this).parent().find('input');
        var count = parseInt(counter.val()) || 0;

        // Ensure count doesn't go below 1
        if (count > 1) {
            count--;
        }
        counter.val(count);
        updatecount(counter);  // Update individual row subtotal
        updateSubtotal();      // Update overall subtotal
    });

    // Update the subtotal for an individual row
    function updatecount(counter) {
        var row = counter.closest('.main_cart');
        var priceText = row.find('.price').text();
        var price = parseFloat(priceText.replace('$', '').replace(',', ''));
        var product_qty = parseInt(counter.val());

        // Validate price and quantity
        if (isNaN(price) || isNaN(product_qty)) {
            console.log('Invalid price or quantity');
            return;
        }

        // Calculate the total price for the row and update the subtotal
        var totalPrice = price * product_qty;
        row.find('.subtotal').text(totalPrice.toFixed(2));
    }

    // Update the overall subtotal
    function updateSubtotal() {
        var subtotal = 0;

        // Loop through each `.subtotal` cell and add the value to the subtotal
        $('.subtotal').each(function () {
            var rowSubtotal = parseFloat($(this).text().replace('$', '').replace(',', ''));

            if (!isNaN(rowSubtotal)) {
                subtotal += rowSubtotal;
            }
        });

        // Update the total subtotal on the page
        $('#total-subtotal').text(subtotal.toFixed(2));
    }

    function updateTotal() {
        var subtotal = parseFloat($('#total-subtotal').text());
        var shipping = parseFloat($('#shipping').text());
        var total = subtotal + (isNaN(shipping) ? 0 : shipping);

        $('#total-amount').text(total.toFixed(2)); // Assuming you have an element with ID `total-amount` for the final total
    }

    updateShipping();
});









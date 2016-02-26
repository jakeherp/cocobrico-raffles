$(document).ready(function() {
	$.ajaxSetup({
	    headers: {
	        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    }
	});

	calculatePrice('#priceTotal','.orderPalletOption');

	$('.orderPalletOption').bind('click keyup', function(){
        calculatePrice('#priceTotal','.orderPalletOption');
    });

    $('.modalOrderPalletOption').bind('click keyup', function(){
        calculatePrice('#modalPriceTotal','.modalOrderPalletOption');
    });

	// Functionality for cancelling orders:
	$('#table').on('click', '.cancelOrderModalButton', function() {
		cancelOrderModal(this);
	});

	$('.cancelOrderModalButton').on('click', null, function() {
		cancelOrderModal(this);
	});

	// Functionality for copying orders:
	$('#table').on('click', '.copyOrderModalButton', function() {
		copyOrderModal(this);
	});

	$('.copyOrderModalButton').on('click', null, function() {
		copyOrderModal(this);
	});

	// Functionality for editing orders:
	$('#table').on('click', '.editOrderModalButton', function() {
    	editOrderModal(this);
    });

    $('.editOrderModalButton').on('click', null, function() {
		editOrderModal(this);
	});
});

function calculatePrice(targetObject, sourceClass){
    var sum = 0;
    $(sourceClass).each(function() {
        sum += $(this).val() * Number($(this).attr('unitsperbox')) * Number($(this).attr('boxesperpallet')) * Number($(this).attr('mass')) * Number($(this).attr('price'));
    });
    sum = sum.toFixed(2);
    $(targetObject).text(sum);
}

function editOrderModal(obj){
	$('#orderModalHeadline').text('Edit an order');
	$('#putOrderModal').html('<input type="hidden" name="_method" value="PUT">');
	$('#orderModalButton').text('Save Changes');
    var reference = $(obj).attr('orderReference');
	var request = $.get('pallets/' + reference + '/get');
	request.done(function(response) {
	    $.each(response, function(k, v) {
			$('#order_'+k).val(v);
		});
		$('#order_remark').val('');
		calculatePrice('#modalPriceTotal','.modalOrderPalletOption');
	});	
}

function copyOrderModal(obj){
	$('#orderModalHeadline').text('Copy a previous order');
	$('#orderModalButton').text('Place Order');
	var reference = $(obj).attr('orderReference');
	var request = $.get('pallets/' + reference + '/get');
	request.done(function(response) {
		$.each(response, function(k, v) {
			$('#order_'+k).val(v);
		});
		calculatePrice('#modalPriceTotal','.modalOrderPalletOption');
	});
}

function cancelOrderModal(obj){
	var reference = $(obj).attr('orderReference');
	$('#orderReference').val(reference);
	$('.orderReferenceSpan').text(reference);
}
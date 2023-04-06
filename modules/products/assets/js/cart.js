var OrderUI = { 
	changeCartURL: '/index.php?module=products&view=cart&task=change&raw=1',
	 init: function (loadUserData) {
        this._initCalculateCart();
        this.recalculateCart();
    },
    _initCalculateCart: function () {
        var _self = this;
	  	$(document).on('click', '.trigger-amount', function () {
	        var $this = $(this),
	            amountBlock = $this.closest('.amount'),
	            amountControl = amountBlock.find('.amount__input'),
	            amount = parseInt(amountControl.val()),
	            elDecrease = $(this).closest('div').children('.trigger-amount[rel="decrease"]');

	        if (!isNaN(amount)) {
	            if ($this.attr('rel') == 'increase') {
	                amount++;
	                elDecrease.removeClass('hide');
	            } else if (amount == 1) {
	                amount = 1;
	                elDecrease.addClass('hide');
	            } else {
	                amount--;
	                if (amount == 1) {
	                    elDecrease.addClass('hide');
	                }
	            }
	        } else {
	            amount = 1;
	            elDecrease.addClass('hide');
	        }
	        var manu_id = $this.siblings('[name=manu_id]').val();
	        var product_id = $this.siblings('[name=product_id]').val();
	        var stock_map = $this.siblings('[name=stock_map]').val();

	        amountControl.val((amount < 10 ? '0' + amount : amount));

	        $.post(_self.changeCartURL, {product_id: product_id, quantity: amount,stock_map:stock_map,manu_id:manu_id}, function (data) {
	        	//$('#cart_item_count').text(data.total_count);
	        	//$('#basket__total__amount_'+manu_id).text(data.total_count);
	        	$('.amount__count_group_'+product_id).val(data.group_count);
	        	$('.amount__count_manu_'+manu_id).val(data.count_manu);
	            _self.recalculateCart();
	        }, 'json');
	        return false;
	    });
	},
	recalculateCart: function () {
		var total_manu = $('#total_manu').val();
		for (i = 0; i < total_manu; i++) { 
		    var totalPrice = 0,
	        orderTotalPriceEl = $('.basket__total__price__value_'+i),
	        orderTotalPrice;
	        $('.amount_'+i).each(function () {
	            var $this = $(this),
	                tr = $this.closest('.item'),
	                table = $this.closest('.shoppingcart-shop'),

	                productPrice = parseFloat($this.find('.amount__price').val()),
	                amount__range = parseFloat($this.find('.amount__range').val()),
	                amount_wholesale = parseFloat($this.find('.amount__wholesale').val()),
	                product_count_group = parseFloat($this.find('.amount__count_group').val()),
	                amount__count_manu = parseFloat($this.find('.amount__count_manu').val()),

	                amount = parseInt($this.find('.amount__input').val());
	            if(amount__count_manu >= amount__range ){
	            	productTotalPrice = amount_wholesale * amount ;
	            	tr.find('.basket__price_unit').text(amount_wholesale.formatMoney(0, '.', ',') + 'đ');
	            }else{
	            	productTotalPrice = productPrice * amount ;
	            	tr.find('.basket__price_unit').text(productPrice.formatMoney(0, '.', ',') + 'đ');
	            }
	            tr.find('.basket__price').text(productTotalPrice.formatMoney(0, '.', ',') + 'đ');
	            totalPrice += productTotalPrice;
	           	// table.find('.basket__total__price__value').text('1000'.formatMoney(0, '.', ',') + 'đ');
	        });
	        orderTotalPrice = totalPrice   ;
	        orderTotalPriceEl.text(orderTotalPrice.formatMoney(0, '.', ',') + 'đ');
	    }
  
    }
};	
$(function () {
    OrderUI.init();
});
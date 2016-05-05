(function() {

	var StripeBilling = {
		init: function() {
			this.form = $('#billing-form');
			this.submitButton = this.form.find('input[type=submit]');
			this.submitButtonValue = this.submitButton.val();

			var stripeKey = $('meta[name=publishable-key]').attr('content');

			Stripe.setPublishableKey(stripeKey);

			this.bindEvents();
		},

		bindEvents: function() {
			this.form.on('submit', $.proxy(this.sendToken, this));
		},

		sendToken: function(event) {
			this.submitButton.val('One Moment...').prop('disabled',true);

			Stripe.createToken(this.form, $.proxy(this.stripeResponseHandler, this));
			event.preventDefault();

		},

		stripeResponseHandler: function(status, response) {
			//console.log(status, response);
			if(response.error) {
				this.submitButton.prop('disabled',false).val(this.submitButtonValue);
				return this.form.find('.payment-errors').show().text(response.error.message);
			}

			

			$('<input>', {
				type: 'hidden',
				name: 'stripe-token',
				value: response.id
			}).appendTo(this.form);

			this.form[0].submit();

		}
	};

	StripeBilling.init();

	$('.select-plan .membership-level').click(function(){
		if($('#price-block').is(':hidden')) $('#price-block').slideDown();
		$('#price').html($(this).attr('price'));
		$('.select-plan .membership-level').css('background-color','rgba(212,125,63,0.25)');
		$(this).css('background-color','#70E440');
		$('button#subscribe').attr('plan', $(this).attr('id'));
		//window.open(window.base_url+'/add_plan?plan='+$(this).attr('id'),'_self');
	});

	$('button#subscribe').click(function(){
		window.open(window.base_url+'/add_plan?plan='+$(this).attr('plan'),'_self');
	});


})();
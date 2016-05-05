(function() {
	$(document).ready(function(){
		$('#create-plan').click(function(){
			$('#create-plan-form').submit();
		});

		$('.delete-plan').click(function(){
			planId = $(this).attr('plan-id');
			stripeId = $(this).attr('stripe-id');
			rowHead = $(this).parent().parent();
			token = $(this).attr('token');
			backgroundColor = rowHead.css('background-color');
			textColor = rowHead.css('color');
			rowHead.css({'background-color':'red','color':'white'});

			$.ajax({
				url: base_url+'/plan/subscribers/'+stripeId,
				method: 'POST',
				data: '_token='+token,
				success: function(data) {
					$('#users-on-plan-count').html(data.length);
					
					$('table#users-on-plan tbody').html('');
					if(data.length > 0) {
						for(user in data)
						{
							row = '<tr><td>'+data[user].name+'</td><td>'+data[user].email+'</td></tr>';
							$('table#users-on-plan tbody').append(row);
						}
					}
					$('#myModal').modal('show');
					$('#myModal').attr('plan-id',planId);
					$('#myModal').attr('stripe-id',stripeId);
					$('#myModal').modal('handleUpdate');
				}
			});
		});

		$('.delete-plan-confirm').click(function(){
			$('.modal-title').html('Deleting plan ...')
			$('.modal-body').html('<img src="'+window.base_url+'/images/preloader.gif">');
			stripeId = $('#myModal').attr('stripe-id');

			$.ajax({
				url: base_url+'/plan/delete/'+stripeId,
				method: 'POST',
				data: '_token='+token,
				success: function(data) {
					$('#myModal').modal('hide');
					$('button[stripe-id="'+stripeId+'"]').parent().parent().fadeOut();
				}
			});

			//$('').fadeOut();
		});

		$('.delete-plan-cancel').click(function(){
			$('button[plan-id="'+$('#myModal').attr('plan-id')+'"]').parent().parent().removeAttr('style');
			//remove style attribute from row
		});

		$('#update-plan').click(function(){
			$('#update-plan-form').submit();
		});

		$('[name="custom"]').click(function(){
			if($(this).is(':checked')) {
				//console.log('checked');
				$.ajax({
					url: base_url+'/users',
					success: function(data) {

						$('[name="custom"]').after(function(){
							var options = '';

							for(user in data)
							{
								console.log(data[user].id,data[user].name,data[user].email);
								options += '<option value="cheese">'+data[user].name+' '+data[user].email+'</option>'+"\n";
							}
							options = '<select name="users" multiple="multiple">'+"\n"+options+'</select>'+"\n";
							return options;
						});

					}
				});

				$('[name="users"]').multiselect();
			} else {
				if($('[name="users"]')) $('[name="users"]').remove();
			}

		});
	});
})();
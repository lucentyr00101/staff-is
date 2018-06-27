$(document).ready(function(){
	$('.submit_company').attr('disabled', true);
});

$('#password_confirmation_company').on('keyup', function(){
	var password = $('#password_company').val();
	var confirm = $(this).val();
	if(confirm != password) {
		$('.submit_company').attr('disabled', true);
	} else {
		$('.submit_company').attr('disabled', false);
	}
});

$(document).ready(function(){
	$('.submit_employee').attr('disabled', true);
});

$('#password_confirmation_employee').on('keyup', function(){
	var password = $('#password_employee').val();
	var confirm = $(this).val();
	if(confirm != password) {
		$('.submit_employee').attr('disabled', true);
	} else {
		$('.submit_employee').attr('disabled', false);
	}
});
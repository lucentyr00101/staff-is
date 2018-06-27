$('#same_address').on('change', function(){
	if ($(this).is(':checked')){
		var country = $('.country_company').val();
		var state = $('.state_company').val();
		var address = $('.address_company').val();
		var zip_code = $('.zip_company').val();

		$('#branch_address').attr('readonly', true);
		$('#branch_zip').attr('readonly', true);
		$('#branch_address').val(address);
		$('#branch_zip').val(zip_code);

		$('div.not-same').addClass('hidden');
		$('div.same').removeClass('hidden');

		$('div.not-same').find('select#branch_country').removeAttr('name').removeAttr('required');
		$('div.same').find('input#branch_country_2').attr('name', 'branch_country').attr('required', true);

		$('div.not-same').find('select#branch_state').removeAttr('name').removeAttr('required');
		$('div.same').find('input#branch_state_2').attr('name', 'branch_state').attr('required', true);

		$('div.same').find('input#branch_country_2').val(country);
		$('div.same').find('input#branch_state_2').val(state);
	} else {

		$('#branch_country').attr('readonly', false);
		$('#branch_address').attr('readonly', false);
		$('#branch_state').attr('readonly', false);
		$('#branch_zip').attr('readonly', false);

		$('#branch_address').val('');
		$('#branch_zip').val('');

		$('div.not-same').removeClass('hidden');
		$('div.same').addClass('hidden');

		$('div.same').find('input#branch_country_2').removeAttr('name').removeAttr('required');
		$('div.same').find('input#branch_state_2').removeAttr('name').removeAttr('required');

		$('div.not-same').find('select#branch_country').attr('name', 'branch_country').attr('required', true);
		$('div.not-same').find('select#branch_state').attr('name', 'branch_state').attr('required', true);
	}
});
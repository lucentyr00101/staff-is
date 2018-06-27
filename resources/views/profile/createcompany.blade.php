<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Create Your Profile</title>
	<link href="{{ asset('css/createprofile.css') }}" rel="stylesheet">
	<link href="{{ asset('css/app.css') }}" rel="stylesheet">
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<link rel="stylesheet" href="{{ asset('css/intlTelInput.css') }}"><!-- https://github.com/jackocnr/intl-tel-input -->
	<script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="{{ asset('css/jquery.simple-dtpicker.css') }}">
	<link rel="stylesheet" href="{{ asset('css/timepicker.css') }}">
	<link rel="stylesheet" href="{{ asset('css/multiselect.css') }}">
	<script src="{{ asset('js/country.js') }}"></script>
	<style>
	.iti-flag {background-image: url("/img/flags/flags.png");}

	@media only screen and (-webkit-min-device-pixel-ratio: 2), only screen and (min--moz-device-pixel-ratio: 2), only screen and (-o-min-device-pixel-ratio: 2 / 1), only screen and (min-device-pixel-ratio: 2), only screen and (min-resolution: 192dpi), only screen and (min-resolution: 2dppx) {
		.iti-flag {background-image: url("/img/flags/flags@2x.png");}
	}
</style>
</head> 

<body>
	@if ($errors->any())
	<div class="alert alert-danger">
		<ul>
			@foreach ($errors->all() as $error)
			<li>{{ $error }}</li>
			@endforeach
		</ul>
	</div>
	@endif
	<div class="row">
		<div class="form-container">
			{!! Form::open(['files' => true, 'method' => 'put', 'id' => 'msform', 'url' => url('company/'.$company->id)]) !!}
			<!-- fieldsets -->
			<div class="field-container">
				<h2 class="fs-title">Basic Details</h2>

				<div class="row">
					<div class="staff-field col-md-6">
						<div class="field-label">
							{{Form::label('fullname', 'Company Name')}} <span style="color:Red;">*</span>
						</div>
						<div class="field-content">
							{{Form::text('fullname', $company->fullname , ['required', 'placeholder' => 'Company Name', 'class' => 'form-control'])}}
						</div>
					</div>

					<div class="staff-field col-md-6">
						<div class="field-label">
							{{Form::label('contact_person', 'Contact Person')}}
						</div>
						<div class="field-content">
							{{Form::text('contact_person', null , ['placeholder' => 'Contact Person', 'class' => 'form-control'])}}
						</div>
					</div>
				</div>

				<div class="row">
					<div class="staff-field col-md-6">
						<div class="field-label">
							{{Form::label('department', 'Department')}} <span style="color:Red;">*</span>
						</div>
						<div class="field-content">
							{{ Form::text('department', null ,['required', 'class' => 'form-control', 'placeholder' => 'Department']) }}
						</div>
					</div>

					<div class="staff-field col-md-6">
						<div class="field-label">
							{{Form::label('idnumber', 'ID Number')}} <span style="color:Red;">*</span>
						</div>
						<div class="field-content">
							{{Form::text('id_p2', null , ['required', 'placeholder' => 'e.g. (123456-7890)', 'class' => 'form-control', 'id' => 'id_p2'])}}
						</div>
					</div>
				</div>

				<div class="row">
					<div class="staff-field col-md-6">
						<div class="field-label">
							{{Form::label('contact_number', 'Mobile Number')}} <span style="color:Red;">*</span>
						</div>
						<div class="field-content">
							{{Form::text('contact_number2', $company->user->contact_number , ['required', 'placeholder' => 'Contact Number', 'class' => 'form-control', 'id' => 'mb_no'])}}
							<input type="hidden" id="mb_no2" name="contact_number">
						</div>
					</div>
					<div class="staff-field col-md-6">
						<div class="field-label">
							{{Form::label('telephone_number', 'Telephone Number')}}
						</div>
						<div class="field-content">
							<input type="tel" id="phone" class='form-control' name='telephone_no'>
							<input type="hidden" id='phone-2' class='form-control' name='telephone'>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="staff-field col-md-6">
						<div class="field-label">
							{{Form::label('email', 'Email')}} <span style="color:Red;">*</span>
						</div>
						<div class="field-content">
							{{Form::text('email', $company->user->email , ['readonly', 'required', 'placeholder' => 'Email Address', 'class' => 'form-control', 'id' => 'email'])}}
						</div>
					</div>

					<div class="staff-field col-md-6">
						<div class="field-label">
							{{Form::label('email_confirmation', 'Confirm Email')}} <span style="color:Red;">*</span>
						</div>
						<div class="field-content">
							{{Form::text('email_confirmation', null, ['required', 'placeholder' => 'Confirm your Email Address', 'class' => 'form-control', 'id' => 'email_confirmation'])}}
							<p class='validation-error'></p>
						</div>
					</div>
				</div>
			</div>

			<div class="field-container">
				<h2 class="fs-title">Company Address</h2>

				<div class="row">
					<div class="staff-field col-md-6">
						<div class="field-label">
							<label for="country">Select Country:</label> <span style="color:Red;">*</span>
						</div>
						<div class="field-content">
							<select class='form-control country_company' id="country" name ="company_country" required></select>
						</div>
					</div>

					<div class="staff-field col-md-6">
						<div class="field-label">
							<label for="state">Select State/City:</label> <span style="color:Red;">*</span>
						</div>
						<div class="field-content">
							<select class='form-control state_company' id="state" name="company_state" required></select>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="staff-field col-md-6">
						<div class="field-label">
							<label for="">Block/Lot/Street/Number</label> <span style="color:Red;">*</span>
						</div>
						<div class="field-content">
							{{Form::text('company_address', null, ['class' => 'form-control address_company', 'placeholder' => 'Block/Lot/Street/Number', 'required'])}}
						</div>
					</div>

					<div class="staff-field col-md-6">
						<div class="field-label">
							<label for="">Zip Code</label> <span style="color:Red;">*</span>
						</div>
						<div class="field-content">
							{{Form::text('company_zip_code', null, ['class' => 'form-control zip_company', 'placeholder' => 'Zip Code', 'required'])}}
						</div>
					</div>
				</div>
			</div>

			<div class="field-container">
				<div style="margin: 10px 0 0 20px;">
					<input type="checkbox" value='yes' id='same_address' name='same_address'><label for="same_address">Same as Company Address?</label>
				</div>
				<h2 class="fs-title">Branch Address</h2>

				<div class="not-same">
					<div class="row">
						<div class="staff-field col-md-6">
							<div class="field-label">
								<label for="country">Select Country:</label> <span style="color:Red;">*</span>
							</div>
							<div class="field-content"">
								<select class='form-control' id="branch_country" name ="branch_country" required></select>
							</div>
						</div>

						<div class="staff-field col-md-6">
							<div class="field-label">
								<label for="state">Select State/City:</label> <span style="color:Red;">*</span>
							</div>
							<div class="field-content">
								<select class='form-control' id="branch_state" name="branch_state" required></select>
							</div>
						</div>
					</div>
				</div>

				<div class="same hidden">
					<div class="row">
						<div class="staff-field col-md-6">
							<div class="field-label">
								<label for="country">Select Country:</label> <span style="color:Red;">*</span>
							</div>
							<div class="field-content">
								<input type="text" class="form-control" id='branch_country_2' readonly>
							</div>
						</div>

						<div class="staff-field col-md-6">
							<div class="field-label">
								<label for="state">Select State/City:</label> <span style="color:Red;">*</span>
							</div>
							<div class="field-content">
								<input type="text" class="form-control" id='branch_state_2' readonly>
							</div>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="staff-field col-md-6">
						<div class="field-label">
							<label for="">Branch Address</label> <span style="color:Red;">*</span>
						</div>
						<div class="field-content">
							{{Form::text('branch_address', null, ['id' => 'branch_address', 'class' => 'form-control', 'placeholder' => 'Block/Lot/Street/Number', 'required'])}}
						</div>
					</div>

					<div class="staff-field col-md-6">
						<div class="field-label">
							<label for="">Zip Code</label> <span style="color:Red;">*</span>
						</div>
						<div class="field-content">
							{{Form::text('branch_zip_code', null, ['id' => 'branch_zip', 'class' => 'form-control', 'placeholder' => 'Zip Code', 'required'])}}
						</div>
					</div>
				</div>
			</div>

			<div class="field-container">
				<h2 class="fs-title">Upload Company Logo<span style="color:red; font-style: italic; font-size:16px;">*(optional)</span></h2>
				{{ Form::file('profile_image', ['class' => 'file-upload']) }}
			</div>

			<div class="field-container">
				<h2 class="fs-title">Other Details</h2>
				<div class="row">
					<div class="staff-field col-md-6">
						<div class="field-label">
							{{Form::label('type_of_work', 'Type of Work')}} <span style="color:Red;">*</span>
						</div>
						<div class="field-content">
							{{Form::select('type_of_work', ['Computer Jobs' => 'Computer Jobs', 'Driving Jobs' => 'Driving Jobs',  'Industrial Jobs' => 'Industrial Jobs',  'Management Jobs' => 'Management Jobs', 'Office Jobs' => 'Office Jobs', 'Sales Jobs' => 'Sales Jobs', 'Service Jobs' => 'Service Jobs', 'Teaching Jobs' => 'Teaching Jobs'], null, ['class' => 'form-control', 'required'])}}
						</div>
					</div>
					<div class="staff-field col-md-6">
						<div class="field-label">
							{{Form::label('working_location', 'Working Location')}} <span style="color:Red;">*</span>
						</div>
						<div class="field-content">
							{{ Form::text('working_location_state', null, ['class' => 'form-control', 'required']) }}
						</div>
					</div>
				</div>
			</div>
			<div>
				{{ Form::submit('Submit', array('class' => 'submit action-button btn theme-btn-dk cst-sbmt', 'name' => 'submit', 'id' => 'submit_btn')) }}
			</div>
			{!! Form::close() !!}
		</div>
	</div>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="{{ asset('js/createprofile.js') }}"></script>
	<script src="{{ asset('js/admin.js') }}"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>
	<script src="{{ asset('js/jquery.simple-dtpicker.js') }}"></script>
	<script src="{{ asset('js/timepicker.js') }}"></script>
	<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.13/jquery.mask.min.js'></script>
	<script src='{{ asset("js/multiselect.js") }}'></script>
	<script>
		$( "#datepicker" ).datepicker({
			changeMonth: true,
			changeYear: true,
			yearRange: "-100:+0",
			dateFormat: 'dd/mm/y',
		});
	</script>

	<!-- Auto-Populate Countries and State -->
	<script language="javascript">
		populateCountries("country", "state");
		populateCountries('branch_country', 'branch_state');
	</script>

	<script src="{{ asset('js/intlTelInput.js') }}"></script>
	<script src="{{ asset('js/utils.js') }}"></script>
	<script>
		$("#phone").intlTelInput();
		$("#mb_no").intlTelInput();
		$('#phone').on('change keydown blur', function(){
			var intlNumber = $("#phone").intlTelInput("getNumber");
			$('#phone-2').val(intlNumber);
		});

		$('#mb_no').on('change keydown blur', function(){
			var intlNumber = $("#mb_no").intlTelInput("getNumber");
			$('#mb_no2').val(intlNumber);
		});

		$(document).ready(function(){
			var intlNumber = $("#mb_no").intlTelInput("getNumber");
			$('#mb_no2').val(intlNumber);
		});
	</script>
	<script>
		$("#id_p2").mask("999999-9999");
	</script>

	<!-- Work Schedule Start and End -->
	<script>
		$('.schedule_time').timepicker({
			'timeFormat': 'H:i',
			'step': 15,
		});
	</script>
	<script>
		$(document).ready(function(){
			$('.multiselect-ui').multiselect();
		})
		$(document).on('change',function() {
			$('.multiselect-ui').multiselect();
		});
	</script>

	<script>
		$(document).ready(function(){
			$('#submit_btn').attr('disabled', true);
		});
		$('#email_confirmation').on('blur', function(){
			var confirm = $(this).val();
			var pw = $('#email').val();
			if(confirm != pw){
				$('p.validation-error').show().text('Email does not match!');
				$(this).css('border', '2px solid red');
				$('#submit_btn').attr('disabled', true);
			} else {
				$('p.validation-error').hide();
				$(this).css('border', '2px solid green');
				$('#submit_btn').attr('disabled', false);
			}
		});
	</script>

	<script src='{{ asset("js/sameaddress.js") }}'></script>
</body>
</html>
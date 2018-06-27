<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Create Your Profil</script>e</title>
	<link href="{{ asset('css/createprofile.css') }}" rel="stylesheet">
	<link href="{{ asset('css/app.css') }}" rel="stylesheet">
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<link rel="stylesheet" href="{{ asset('css/intlTelInput.css') }}"><!-- https://github.com/jackocnr/intl-tel-input -->
	<link rel="stylesheet" href="{{ asset('css/multiselect.css') }}">
	<script src="{{ asset('js/country.js') }}"></script>
	<style>
	.iti-flag {
		background-image: url("/img/flags/flags.png");
	}

	@media only screen and (-webkit-min-device-pixel-ratio: 2), only screen and (min--moz-device-pixel-ratio: 2), only screen and (-o-min-device-pixel-ratio: 2 / 1), only screen and (min-device-pixel-ratio: 2), only screen and (min-resolution: 192dpi), only screen and (min-resolution: 2dppx) {
		.iti-flag {
			background-image: url("/img/flags/flags@2x.png");
		}
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

	@if(session()->has('error'))
	<div class="alert alert-danger">
		<ul>
			<li>{{ session()->get('error') }}</li>
		</ul>
	</div>
	@endif
	
	<div class="row">
		<div class="container">
			<p style="text-decoration: underline; font-style: italic; color:red;"><strong>Note:</strong> fields with (*) are required.</p>
			{!! Form::open(['files' => true, 'method' => 'put', 'id' => 'msform', 'url' => url('employee/'.$employee->id)]) !!}
			

			<div class="field-container">
				<h2 class="fs-title">Basic Details</h2>

				<div class="row">
					<div class="staff-field col-md-6">
						<div class="field-label col-md-12">
							{{Form::label('fullname', 'Full Name')}} <span style="color:Red;">*</span>
						</div>
						<div class="field-content col-md-12">
							{{Form::text('fullname', $employee->fullname , ['required', 'placeholder' => 'Full Name', 'class' => 'form-control'])}}
						</div>
					</div>

					<div class="staff-field id_number_container col-md-6">
						<div class="col-md-12">
							<label for="">Do you have a valid Iceland ID?</label>
							<input type="radio" name="has_id" value="1" id="yes_id"><label for="yes_id">Yes</label>
							<input type="radio" name="has_id" value="0" id="no_id" checked><label for="no_id">No</label>
						</div>
						<div class="non-is-resident-div">
							<div class="field-label col-md-12">
								{{Form::label('idnumber', 'ID Number / Birthday')}} <span style="color:Red;">*</span>
							</div>
							<div class="field-content">
								<!-- {{Form::text('id_p1', null , ['readonly', 'required', 'id' => 'datepicker-non-is', 'placeholder' => 'Birthday', 'class' => 'datepicker-non-is form-control'])}} -->
								<div class="col-md-3">
									{{ Form::select('id_month',['01' => 'January', '02' => 'February', '03' => 'March', '04' => 'April', '05' => 'May', '06' => 'June', '07' => 'July', '08' => 'August', '09' => 'September', '10' => 'October', '11' => 'November', '12' => 'December'] ,null, ['class' => 'form-control', 'id' => 'id_month']) }}
								</div>
								<div class="col-md-3">
									<select name="" id="id_day" class="form-control"></select>
								</div>
								<div class="col-md-3">
									<select name="" id="id_year" class="form-control"></select>
								</div>
								<div class="col-md-3">
									<input type="text" class="form-control" id="id_number_non_is_resident" name="non_is_id" readonly>
								</div>
								<input type="hidden" name='birthday' id="birthday" readonly>
							</div>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="staff-field col-md-6">
						<div class="field-label">
							{{Form::label('age', 'Age')}} <span style="color:Red;">*</span>
						</div>
						<div class="field-content">
							{{ Form::text('age', null, ['required', 'placeholder' => 'Age', 'class' => 'form-control', 'readonly', 'id' => 'age']) }}
						</div>
					</div>

					<div class="staff-field col-md-6">
						<div class="field-label">
							{{Form::label('gender', 'Gender')}} <span style="color:Red;">*</span>
						</div>
						<div class="field-content">
							{{Form::select('gender', ['M' => 'M', 'F' => 'F'], $employee->gender, ['required', 'class' => 'form-control'])}}
						</div>
					</div>
				</div>

				<div class="row">
					<div class="staff-field col-md-6">
						<div class="field-label">
							{{Form::label('civil_status', 'Civil Status')}} <span style="color:Red;">*</span>
						</div>
						<div class="field-content">
							{{Form::select('civil_status', ['single' => 'Single', 'married' => 'Married', 'widowed' => 'Widowed'], $employee->civil_status, ['required', 'class' => 'form-control'])}}
						</div>
					</div>

					<div class="staff-field nationality-grp col-md-6">
						<div class="field-label">
							{{Form::label('nationality', 'Nationality')}} <span style="color:Red;">*</span>
						</div>
						<div class="field-content">
							<select name="nationality" class="form-control nationality" required>
								<option value="">-- select one --</option>
								<option value="Afghan">Afghan</option>
								<option value="Albanian">Albanian</option>
								<option value="Algerian">Algerian</option>
								<option value="American">American</option>
								<option value="Andorran">Andorran</option>
								<option value="Angolan">Angolan</option>
								<option value="Antiguans">Antiguans</option>
								<option value="Argentinean">Argentinean</option>
								<option value="Armenian">Armenian</option>
								<option value="Australian">Australian</option>
								<option value="Austrian">Austrian</option>
								<option value="Azerbaijani">Azerbaijani</option>
								<option value="Bahamian">Bahamian</option>
								<option value="Bahraini">Bahraini</option>
								<option value="Bangladeshi">Bangladeshi</option>
								<option value="Barbadian">Barbadian</option>
								<option value="Barbudans">Barbudans</option>
								<option value="Batswana">Batswana</option>
								<option value="Belarusian">Belarusian</option>
								<option value="Belgian">Belgian</option>
								<option value="Belizean">Belizean</option>
								<option value="Beninese">Beninese</option>
								<option value="Bhutanese">Bhutanese</option>
								<option value="Bolivian">Bolivian</option>
								<option value="Bosnian">Bosnian</option>
								<option value="Brazilian">Brazilian</option>
								<option value="British">British</option>
								<option value="Bruneian">Bruneian</option>
								<option value="Bulgarian">Bulgarian</option>
								<option value="Burkinabe">Burkinabe</option>
								<option value="Burmese">Burmese</option>
								<option value="Burundian">Burundian</option>
								<option value="Cambodian">Cambodian</option>
								<option value="Cameroonian">Cameroonian</option>
								<option value="Canadian">Canadian</option>
								<option value="Cape verdean">Cape Verdean</option>
								<option value="Central african">Central African</option>
								<option value="Chadian">Chadian</option>
								<option value="Chilean">Chilean</option>
								<option value="Chinese">Chinese</option>
								<option value="Colombian">Colombian</option>
								<option value="Comoran">Comoran</option>
								<option value="Congolese">Congolese</option>
								<option value="Costa rican">Costa Rican</option>
								<option value="Croatian">Croatian</option>
								<option value="Cuban">Cuban</option>
								<option value="Cypriot">Cypriot</option>
								<option value="Czech">Czech</option>
								<option value="Danish">Danish</option>
								<option value="Djibouti">Djibouti</option>
								<option value="Dominican">Dominican</option>
								<option value="Dutch">Dutch</option>
								<option value="East timorese">East Timorese</option>
								<option value="Ecuadorean">Ecuadorean</option>
								<option value="Egyptian">Egyptian</option>
								<option value="Emirian">Emirian</option>
								<option value="Equatorial guinean">Equatorial Guinean</option>
								<option value="Eritrean">Eritrean</option>
								<option value="Estonian">Estonian</option>
								<option value="Ethiopian">Ethiopian</option>
								<option value="Fijian">Fijian</option>
								<option value="Filipino">Filipino</option>
								<option value="Finnish">Finnish</option>
								<option value="French">French</option>
								<option value="Gabonese">Gabonese</option>
								<option value="Gambian">Gambian</option>
								<option value="Georgian">Georgian</option>
								<option value="German">German</option>
								<option value="Ghanaian">Ghanaian</option>
								<option value="Greek">Greek</option>
								<option value="Grenadian">Grenadian</option>
								<option value="Guatemalan">Guatemalan</option>
								<option value="Guinea-bissauan">Guinea-Bissauan</option>
								<option value="Guinean">Guinean</option>
								<option value="Guyanese">Guyanese</option>
								<option value="Haitian">Haitian</option>
								<option value="Herzegovinian">Herzegovinian</option>
								<option value="Honduran">Honduran</option>
								<option value="Hungarian">Hungarian</option>
								<option value="Icelander">Icelander</option>
								<option value="Indian">Indian</option>
								<option value="Indonesian">Indonesian</option>
								<option value="Iranian">Iranian</option>
								<option value="Iraqi">Iraqi</option>
								<option value="Irish">Irish</option>
								<option value="Israeli">Israeli</option>
								<option value="Italian">Italian</option>
								<option value="Ivorian">Ivorian</option>
								<option value="Jamaican">Jamaican</option>
								<option value="Japanese">Japanese</option>
								<option value="Jordanian">Jordanian</option>
								<option value="Kazakhstani">Kazakhstani</option>
								<option value="Kenyan">Kenyan</option>
								<option value="Kittian and nevisian">Kittian and Nevisian</option>
								<option value="Kuwaiti">Kuwaiti</option>
								<option value="Kyrgyz">Kyrgyz</option>
								<option value="Laotian">Laotian</option>
								<option value="Latvian">Latvian</option>
								<option value="Lebanese">Lebanese</option>
								<option value="Liberian">Liberian</option>
								<option value="Libyan">Libyan</option>
								<option value="Liechtensteiner">Liechtensteiner</option>
								<option value="Lithuanian">Lithuanian</option>
								<option value="Luxembourger">Luxembourger</option>
								<option value="Macedonian">Macedonian</option>
								<option value="Malagasy">Malagasy</option>
								<option value="Malawian">Malawian</option>
								<option value="Malaysian">Malaysian</option>
								<option value="Maldivan">Maldivan</option>
								<option value="Malian">Malian</option>
								<option value="Maltese">Maltese</option>
								<option value="Marshallese">Marshallese</option>
								<option value="Mauritanian">Mauritanian</option>
								<option value="Mauritian">Mauritian</option>
								<option value="Mexican">Mexican</option>
								<option value="Micronesian">Micronesian</option>
								<option value="Moldovan">Moldovan</option>
								<option value="Monacan">Monacan</option>
								<option value="Mongolian">Mongolian</option>
								<option value="Moroccan">Moroccan</option>
								<option value="Mosotho">Mosotho</option>
								<option value="Motswana">Motswana</option>
								<option value="Mozambican">Mozambican</option>
								<option value="Namibian">Namibian</option>
								<option value="Nauruan">Nauruan</option>
								<option value="Nepalese">Nepalese</option>
								<option value="New zealander">New Zealander</option>
								<option value="Ni-vanuatu">Ni-Vanuatu</option>
								<option value="Nicaraguan">Nicaraguan</option>
								<option value="Nigerien">Nigerien</option>
								<option value="North korean">North Korean</option>
								<option value="Northern irish">Northern Irish</option>
								<option value="Norwegian">Norwegian</option>
								<option value="Omani">Omani</option>
								<option value="pakistani">Pakistani</option>
								<option value="Palauan">Palauan</option>
								<option value="Panamanian">Panamanian</option>
								<option value="Papua new guinean">Papua New Guinean</option>
								<option value="Paraguayan">Paraguayan</option>
								<option value="Peruvian">Peruvian</option>
								<option value="Polish">Polish</option>
								<option value="Portuguese">Portuguese</option>
								<option value="Qatari">Qatari</option>
								<option value="Romanian">Romanian</option>
								<option value="Russian">Russian</option>
								<option value="Rwandan">Rwandan</option>
								<option value="Saint lucian">Saint Lucian</option>
								<option value="Salvadoran">Salvadoran</option>
								<option value="Samoan">Samoan</option>
								<option value="San marinese">San Marinese</option>
								<option value="Sao tomean">Sao Tomean</option>
								<option value="Saudi">Saudi</option>
								<option value="Scottish">Scottish</option>
								<option value="Senegalese">Senegalese</option>
								<option value="Serbian">Serbian</option>
								<option value="Seychellois">Seychellois</option>
								<option value="Sierra leonean">Sierra Leonean</option>
								<option value="Singaporean">Singaporean</option>
								<option value="Slovakian">Slovakian</option>
								<option value="Slovenian">Slovenian</option>
								<option value="Solomon islander">Solomon Islander</option>
								<option value="Somali">Somali</option>
								<option value="South african">South African</option>
								<option value="South korean">South Korean</option>
								<option value="Spanish">Spanish</option>
								<option value="Sri lankan">Sri Lankan</option>
								<option value="Sudanese">Sudanese</option>
								<option value="Surinamer">Surinamer</option>
								<option value="Swazi">Swazi</option>
								<option value="Swedish">Swedish</option>
								<option value="Swiss">Swiss</option>
								<option value="Syrian">Syrian</option>
								<option value="Taiwanese">Taiwanese</option>
								<option value="Tajik">Tajik</option>
								<option value="Tanzanian">Tanzanian</option>
								<option value="Thai">Thai</option>
								<option value="Togolese">Togolese</option>
								<option value="Tongan">Tongan</option>
								<option value="Trinidadian or tobagonian">Trinidadian or Tobagonian</option>
								<option value="Tunisian">Tunisian</option>
								<option value="Turkish">Turkish</option>
								<option value="Tuvaluan">Tuvaluan</option>
								<option value="Ugandan">Ugandan</option>
								<option value="Ukrainian">Ukrainian</option>
								<option value="Uruguayan">Uruguayan</option>
								<option value="Uzbekistani">Uzbekistani</option>
								<option value="Venezuelan">Venezuelan</option>
								<option value="Vietnamese">Vietnamese</option>
								<option value="Welsh">Welsh</option>
								<option value="Yemenite">Yemenite</option>
								<option value="Zambian">Zambian</option>
								<option value="Zimbabwean">Zimbabwean</option>
							</select>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="staff-field number_of_children col-md-6">
						<div class="field-label">
							{{Form::label('number_of_children', 'Number of Children')}}
						</div>
						<div class="field-content">
							{{Form::text('number_of_children', '0', ['placeholder' => 'Number of children', 'class' => 'form-control'])}}
						</div>
					</div>

					<div class="staff-field col-md-6">
						<div class="field-label">
							{{Form::label('criminal_record', 'Clean Criminal Record?')}} <span style="color:Red;">*</span>
						</div>
						<div class="field-content">
							<!-- {{Form::select('criminal_record', ['1' => 'Yes', '0' => 'No'],null, ['class' => 'form-control'])}} -->
							{{ Form::radio('criminal_record', 1, true, ['class' => '', 'id' => '', 'onclick']) }}Yes<br>
							{{ Form::radio('criminal_record', 0, null, ['class' => '', 'id' => '', 'onclick']) }}No
						</div>
					</div>
				</div>

				<div class="row">
					<div class="staff-field">
						<div class="license-wrap col-md-4">
							{{ Form::label('hasDriverLicense','Has Driver\'s License?') }} <span style="color:Red;">*</span>
							@if($employee->hasDriverLicense == 1)
							<div>{{ Form::radio('license', 1, true, ['class' => 'yes-radio', 'id' => 'yes-radio-l', 'onclick' => 'yesnoCheck()']) }}Yes</div>
							<div>{{ Form::radio('license', 0, false, ['class' => 'no-radio', 'id' => 'no-radio-l', 'onclick' => 'yesnoCheck()']) }}No</div>
							@else
							<div>{{ Form::radio('license', 1, false, ['class' => 'yes-radio', 'id' => 'yes-radio-l', 'onclick' => 'yesnoCheck()']) }}Yes</div>
							<div>{{ Form::radio('license', 0, true, ['class' => 'no-radio', 'id' => 'no-radio-l', 'onclick' => 'yesnoCheck()']) }}No</div>
							@endif
						</div>
						<div class="car-wrap col-md-4" id='license-wrap-div' style="display: none;">
							{{ Form::label('type_of_license','What type of driver\'s license?') }}
							{{Form::select('type_of_license[]', ['AM' => 'AM', 'A1' => 'A1', 'A2' => 'A2', 'A' => 'A', 'B1' => 'B1', 'B' => 'B', 'BE' => 'BE', 'C1' => 'C1', 'C1E' => 'C1E', 'C' => 'C', 'CE' => 'CE', 'D1' => 'D1', 'D1E' => 'D1E', 'D' => 'D', 'DE' => 'DE', 'T' => 'T'], null, ['class' => 'form-control multiselect-ui', 'multiple' => 'multiple'])}}
						</div>
						<div class="car-wrap col-md-4" id='car-wrap-div' style="display: none;">
							{{ Form::label('hasCar','Has Car?') }}
							@if($employee->hasCar == 1)
							<div>{{ Form::radio('car', 1, true) }}Yes</div>
							<div>{{ Form::radio('car', 0) }}No</div>
							@else
							<div>{{ Form::radio('car', 1, false) }}Yes</div>
							<div>{{ Form::radio('car', 0, true) }}No</div>
							@endif
						</div>
					</div>
				</div>

				<div class="row">
					<div class="staff-field col-md-12">
						<div class="field-label">
							{{Form::label('smoking', 'Smoking?')}} <span style="color:Red;">*</span>
						</div>
						<div class="field-content">
							<!-- {{Form::select('smoking', ['1' => 'Yes', '0' => 'No'],null, ['class' => 'form-control'])}} -->
							{{ Form::radio('smoking', 1, null, ['class' => '', 'id' => '', 'onclick']) }}Yes<br>
							{{ Form::radio('smoking', 0, true, ['class' => '', 'id' => '', 'onclick']) }}No
						</div>
					</div>
				</div>

				<div class="row">
					<div class="staff-field-2 col-md-12">
						<div class="field-label">
							{{Form::label('smoking', 'Health Problems:')}} <span style="font-style:italic; font-size:12px; font-weight: 100;">(Leave empty if none.)</span>
						</div>
						<div class="field-content">
							{{Form::textarea('health_problem[]', null, ['placeholder' => 'Health Problem', 'class' => 'form-control', 'id' => 'health_problem'])}}
						</div>
					</div>
				</div>
			</div>

			<div class="field-container">
				<h2 class="fs-title">Basic Skills</h2> 
				<div class="row">
					<div class="col-md-12">
						<div class="input_fields_wrap">
							<div>{{ Form::label('language', "Language") }} <span style="color:Red;">*</span></div>
							<button class="add_field_button btn theme-btn-lt">Add language</button>
							<div class='language-container'>
								<select id="language-select" class='language-select' name="language[]"></select>
								{{Form::select('lang_proficiency[]', ['basic' => 'Basic', 'moderate' => 'Moderate', 'high' => 'High'], $employee->proficiency, ['class' => 'language-select'])}}
								<a href="#" class="remove_field btn theme-btn-dk">Remove</a>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="field-container">
				<h2 class="fs-title">Contact Details</h2> 

				<div class="row">
					<div class="staff-field col-md-6">
						<div class="field-label">
							<label for="country">Select Country:</label> <span style="color:Red;">*</span>
						</div>
						<div class="field-content">
							<select class='form-control' id="country" name ="country" required></select>
						</div>
					</div>

					<div class="staff-field col-md-6">
						<div class="field-label">
							<label for="state">Select State/City:</label> <span style="color:Red;">*</span>
						</div>
						<div class="field-content">
							<select class='form-control' id="state" name="state" required></select>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="staff-field col-md-6">
						<div class="field-label">
							<label for="">Home Address</label> <span style="color:Red;">*</span>
						</div>
						<div class="field-content">
							{{Form::text('home_address', null, ['required', 'class' => 'form-control', 'placeholder' => 'Home Address'])}}
						</div>
					</div>

					<div class="staff-field col-md-6">
						<div class="field-label">
							<label for="">Zip Code</label> <span style="color:Red;">*</span>
						</div>
						<div class="field-content">
							{{Form::text('zip_code', null, ['required', 'class' => 'form-control', 'placeholder' => 'Zip Code'])}}
						</div>
					</div>
				</div>

				<div class="row">
					<div class="staff-field col-md-6">
						<div class="field-label">
							{{Form::label('contact_number', 'Mobile Number')}} <span style="color:Red;">*</span>
						</div>
						<div class="field-content">
							{{Form::text('contact_number_2', $employee->user->contact_number , ['required', 'placeholder' => 'Contact Number', 'class' => 'form-control', 'id' => 'contact_number'])}}
							<input type="hidden" id='contact_number_2' name='contact_number'>
						</div>
					</div>

					<div class="staff-field col-md-6">
						<div class="field-label">
							{{Form::label('contact_number', 'Telephone Number')}} <span style="color:Red;"></span>
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
							{{Form::email('email', $employee->user->email , ['readonly', 'required', 'placeholder' => 'Email Address', 'class' => 'form-control', 'id' => 'email'])}}
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

				<div class="row">
					<div class="staff-field col-md-6">
						<div class="field-label">
							{{Form::label('emergency_contact_name', 'Emergency Contact Name')}} <span style="color:Red;">*</span>
						</div>
						<div class="field-content">
							{{Form::text('emergency_contact_name', null, ['required', 'class' => 'form-control'])}}
						</div>
					</div>
					<div class="staff-field col-md-6">
						<div class="field-label">
							{{Form::label('emergency_contact_number', 'Emergency Contact Number')}} <span style="color:Red;">*</span>
						</div>
						<div class="field-content">
							{{Form::text('emergency_contact_number_2', null, ['required', 'placeholder' => 'Emergency Contact Number', 'class' => 'form-control', 'id' => 'emergency_contact_number'])}}
							<input type="hidden" id='em-contact-2' class='form-control' name='emergency_contact_number'>
						</div>
					</div>
				</div>
			</div>

			<div class="field-container">
				<h2 class="fs-title">Banking Information </h2> 
				{{Form::label('account_number', 'Account Number')}}<span style="font-size:10px; font-style: italic; text-decoration:underline;"> *Dashes will be added automatically.*</span>
				{{Form::text('account_number', null , ['id' => 'account_number', 'placeholder' => 'XXXX-XX-XXXXXX', 'class' => 'form-control', 'maxlength' => 14])}}
			</div>

			<div class="field-container">
				<h2 class="fs-title">Upload Profile Image<span style="color:red; font-style: italic; font-size:16px;">*(optional)</span></h2>
				{{ Form::file('profile_image', ['class' => 'file-upload', 'accept' => 'image/*']) }}
			</div>
			<div class="field-container">
				<h2 class="fs-title">Summary</h2>
				<div class="summary-content">
					{{ Form::textarea('summary', $employee->summary, ['class' => 'form-control']) }}
				</div>
			</div>

			<div class="field-container">
				<table class="table history">
					<thead>
						<th colspan='99'><h2 class='fs-title'>Employment History</h2></th>
					</thead>
					<tbody>
						<tr>
							<th>Job Title</th>
							<th>Job Description</th>
							<th>Job Duration</th>
							<th>Company</th>
						</tr>

						<tfoot>
							<tr>
								<td colspan = '6'><input type="button" class='pull-right add-history btn theme-btn-lt' value='+' /></td>
							</tr>
						</tfoot>
					</tbody>
				</table>
			</div>

			<div class="field-container">
				<table class="table location">
					<thead><th colspan='99'><h2 class='fs-title'>Prefered Work Location and Schedule of Work</h2></th></thead>
					<tbody>
						<tr>
							<td class="table-label">Location: <span style="color:Red;">*</span></td>
							<td><select class='form-control' id="state0" name ="location[]"></select></td>
							<td><input type='button' class='pull-right delete-location btn theme-btn-dk' value='-'/></td>
						</tr>
					</tbody>
					<tfoot>
						<tr>
							<td colspan = '6'><input type="button" class='pull-right add-location btn theme-btn-lt' value='+' /></td>
						</tr>
						<tr>
							<td class="table-label">Prefered Work Schedule <span style="color:Red;">*</span></td>
							<td>{{Form::select('schedule_of_work', ['Full Time Job' => 'Full Time Job', 'Part Time Job' => 'Part Time Job', 'Weekend Job' => 'Weekend Job'], null, ['class' => 'form-control'])}}</td>
						</tr>
						<tr>
							<td class="table-label">Prefered Shift Schedule <span style="color:Red;">*</span></td>
							<td>{{Form::select('shift', ['Morning Shift' => 'Morning Shift', 'Afternoon Shift' => 'Afternoon Shift', 'Night Shift' => 'Night Shift'], null, ['class' => 'form-control'])}}</td>
						</tr>
					</tfoot>
				</table>
			</div>

			<div class="field-container">
				<table class="table educ">
					<thead>
						<th colspan='99'><h2 class='fs-title'>Education History</h2></th>
					</thead>
					<tbody>
						<tr>
							<th class="table-label">School Name</th>
							<th class="table-label">Course/Degree</th>
							<th class="table-label">Highest Degree Attained</th>
							<th class="table-label">Year Graduated</th>
						</tr>
						<select id="hidden_hda" style="display: none">
							@foreach($degree as $d)
							<option value="{{ $d }}"> {{ $d }} </option>
							@endforeach
						</select>
						<tfoot>
							<tr>
								<td colspan = '6'><input type="button" class='pull-right add-educ btn theme-btn-lt' value='+' /></td>
							</tr>
						</tfoot>
					</tbody>
				</table>
			</div>
			<div class="field-container">
				<table class="table cert">
					<thead>
						<th colspan="99"><h2 class='fs-title'>Resume / Certificate</h2></th>
					</thead>
					<tbody>
						<tr>
							<th>{{Form::label('cv','Upload a resume or a certificate:', ['required', 'class' => 'table-label'])}} <span style="color:Red;">*</span> {{Form::file('cv[]', ['accept' => 'application/pdf, application/msword, .docx, .doc'] )}}</th>
							<td>{{Form::label('emp_cv', 'Resume / Certificate', ['table-label'])}} <span style="color:Red;">*</span> {{Form::select('cv_type[]', ['resume' => 'Resume', 'certificate' => 'Certificate'], null, ['required', 'class' => 'form-control'])}}</td>
							<td><input type='button' class='pull-right delete-cert btn theme-btn-dk' value='-'/></td>
						</tr>
					</tbody>
					<tfoot>
						<tr>
							<td colspan = '6'><input type="button" class='pull-right add-cert btn theme-btn-lt' value='+' /></td>
						</tr>
					</tfoot>
				</table>
			</div>
			<div>
				{{ Form::submit('Submit', array('id' => 'submit_btn', 'class' => 'submit action-button btn theme-btn-dk cst-sbmt', 'name' => 'submit')) }}
			</div>
			{!! Form::close() !!}
		</div>
	</div>

</div>
<script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="{{ asset('js/createprofile.js') }}"></script>
<script src="{{ asset('js/admin.js') }}"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>
<!-- auto add dashes for account number field -->
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.13/jquery.mask.min.js'></script>
<script>
	
</script>

<script language="javascript">
	populateCountries("country", "state");
	populateIcelandicStates("state0");
</script>

<script src="{{ asset('js/intlTelInput.js') }}"></script>
<script src="{{ asset('js/utils.js') }}"></script>
<script>
	$("#phone").intlTelInput();
	$('#phone').on('keyup keydown', function(){
		var intlNumber = $("#phone").intlTelInput("getNumber");
		$('#phone-2').val(intlNumber);
	});

	$("#emergency_contact_number").intlTelInput();
	$('#emergency_contact_number').on('keyup keydown', function(){
		var intlNumber = $("#emergency_contact_number").intlTelInput("getNumber");
		$('#em-contact-2').val(intlNumber);
	});

	$("#contact_number").intlTelInput();
	$('#contact_number').on('keyup keydown', function(){
		var intlNumber = $("#contact_number").intlTelInput("getNumber");
		$('#contact_number_2').val(intlNumber);
	});
</script>
<script>
	$("#account_number").mask("9999-99-999999");
</script>
<script src='{{ asset("js/multiselect.js") }}'></script>
<script>
//	$(document).ready(function() {
//		$('.multiselect-ui').multiselect();
//	});
</script>
<script>
	$('#submit_btn').attr('disabled', true);
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

<script>
	$(document).on('change', 'input[type=radio][name=has_id]', function(){

		var is_resident = $('<div class="is-resident-div"><div class="field-label col-md-12"><label for="idnumber">ID Number / Birthday</label> <span style="color:Red;">*</span></div><div class="col-md-3"><select class="form-control" name="id_month" id="id_month"><option value="01">January</option><option value="02">February</option><option value="03">March</option><option value="04">April</option><option value="05">May</option><option value="06">June</option><option value="07">July</option><option value="08">August</option><option value="09">September</option><option value="10">October</option><option value="11">November</option><option value="12">December</option></select></div><div class="col-md-3"><select name="" id="id_day" class="form-control"></select></div><div class="col-md-3"><select name="" id="id_year" class="form-control"></select></div><div class="col-md-3"><input type="text" class="form-control" placeholder="e.g.(1234)" required name="is_resident_id_ext" id="id_number_is_resident"></div><div class="col-md-6"><input type="hidden" class="form-control" name="birthday" id="birthday" readonly></div><div class="col-md-6"><input type="hidden" class="form-control" id="is_resident_id_number" name="is_resident_id_number" /></div></div>');

		var non_is_resident = $('<div class="non-is-resident-div"><div class="field-label col-md-12"><label for="idnumber">ID Number / Birthday</label> <span style="color:Red;">*</span></div><div class="col-md-3"><select class="form-control" name="id_month" id="id_month"><option value="01">January</option><option value="02">February</option><option value="03">March</option><option value="04">April</option><option value="05">May</option><option value="06">June</option><option value="07">July</option><option value="08">August</option><option value="09">September</option><option value="10">October</option><option value="11">November</option><option value="12">December</option></select></div><div class="col-md-3"><select name="" id="id_day" class="form-control"></select></div><div class="col-md-3"><select name="" id="id_year" class="form-control"></select></div><div class="col-md-3"><input type="text" class="form-control" id="id_number_non_is_resident" name="non_is_id" readonly></div><input type="hidden" class="form-control" name="birthday" id="birthday" readonly></div>');

		if($(this).val() == '1'){
			$('#age').val('');
			$('div.is-resident-div').remove();
			$('div.non-is-resident-div').remove();
			is_resident.appendTo('.id_number_container');
			for (i = new Date().getFullYear(); i > 1900; i--)
			{
				$('#id_year').append($('<option />').val(i).html(i));
			}

			for (var i = 1; i <= 31; i++)
			{
				i = i > 9 ? i : '0' + i;
				$('#id_day').append($('<option />').val(i).html(i));
			}
			
			$("#id_number_is_resident").mask("9999");
		} else {
			$('#age').val('');
			$('div.is-resident-div').remove();
			$('div.non-is-resident-div').remove();
			non_is_resident.appendTo('.id_number_container');
			for (i = new Date().getFullYear(); i > 1900; i--)
			{
				$('#id_year').append($('<option />').val(i).html(i));
			}

			for (var i = 1; i <= 31; i++)
			{
				i = i > 9 ? i : '0' + i;
				$('#id_day').append($('<option />').val(i).html(i));
			}
		}
	});
</script>
<script>
	$(document).ready(function(){
		for (i = new Date().getFullYear(); i > 1900; i--)
		{
			$('#id_year').append($('<option />').val(i).html(i));
		}

		for (var i = 1; i <= 31; i++)
		{
			i = i > 9 ? i : '0' + i;
			$('#id_day').append($('<option />').val(i).html(i));
		}
	});
</script>
</body>
</html>
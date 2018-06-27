@extends('layouts.admin')
@section('content')
<link rel="stylesheet" href="http://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.1.3/css/fixedHeader.dataTables.min.css">
<link rel="stylesheet" href="{{ asset('css/multiselect.css') }}">
<link rel="stylesheet" href="{{ asset('css/searchbreadcrumbs.css') }}">

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#adv-s-modal">
	Advanced Search ...
</button>

<!-- Modal -->
<div class="modal fade" id="adv-s-modal" role="dialog" aria-labelledby="adv-s-modal-label" aria-hidden="true">
	{{ Form::open(['url' => url('/search/employee/'), 'method' => 'get']) }}
	<div class="modal-dialog modal-md centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title" style="display:inline-block;">Search...</h3>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				
				<div>
					<label for="">Name: </label>
					<input class="form-control" type="text" name='search_fullname' placeholder="Any name">
				</div>
				<div>
					<label for="">Age: </label>
					<input class="form-control" type="text" name="search_age" placeholder="Any age">
				</div>
				<div>
					<label for="">Gender: </label>
					<select class="form-control" name="search_gender">
						<option value="">Any</option>
						<option value="M">Male</option>
						<option value="F">Female</option>
					</select>
				</div>
				<div>
					<label for="">Civil Status: </label>
					<select class="form-control" name="search_civil_status" id="">
						<option value="">Any</option>
						<option value="single">Single</option>
						<option value="married">Married</option>
						<option value="widowed">Widowed</option>
					</select>
				</div>
				<div>
					<label for="">Country: </label>
					<select class="form-control" name="search_country" id="country"></select>
				</div>
				<div>
					<label for="">State: </label>
					<select class="form-control" name="search_state" id="state"></select>
				</div>
				<div class="">
					<label for="">Nationality:</label>
					<select class="form-control" name="search_nationality" id="">
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
				<div>
					<label for="">Has Driver's License? </label>
					<input type="radio" name='search_has_license' value='' checked> Any
					<input type="radio" name='search_has_license' value="1" /> Yes
					<input type="radio" name='search_has_license' value="0" /> No
				</div>
				<div>
					<label for="">Type of License</label>
					{{Form::select('search_type_of_license[]', ['AM' => 'AM', 'A1' => 'A1', 'A2' => 'A2', 'A' => 'A', 'B1' => 'B1', 'B' => 'B', 'BE' => 'BE', 'C1' => 'C1', 'C1E' => 'C1E', 'C' => 'C', 'CE' => 'CE', 'D1' => 'D1', 'D1E' => 'D1E', 'D' => 'D', 'DE' => 'DE', 'T' => 'T'], null, ['class' => 'form-control multiselect-ui', 'multiple' => 'multiple'])}}
				</div>
				<div>
					<label for="">Has Car?</label>
					<input type="radio" name='search_has_car' value='' checked> Any
					<input type="radio" name='search_has_car' value="1" /> Yes
					<input type="radio" name='search_has_car' value="0" /> No
				</div>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-primary" id='search-submit'>Search</button>
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
	{{ Form::close() }}
</div>
<!-- Modal end -->

@if(session()->get('user_type') == 'admin')
<table class="table table-striped table-bordered text-center" id='data-table'>
	<thead>
		<tr>
			<th>ID</th>
			<th>Full Name</th>
			<th>Age</th>
			<th>Gender</th>
			<th>Civil Status</th>
			<th>Number of Children</th>
			<th>Nationality</th>
			<th>Address</th>
			<th>Emergency Contact Number</th>
			<th>E-Mail Address</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
		@foreach($employees as $employee)
		<tr>
			<td>{{ $employee->id }}</td>
			<td>{{ $employee->fullname }}</td>
			<td>{{ $employee->age }}</td>
			<td>{{ $employee->gender }}</td>
			<td>{{ $employee->civil_status }}</td>
			<td>{{ $employee->number_of_children }}</td>
			<td>{{ $employee->nationality }}</td>
			<td> {{$employee->address}}, {{$employee->zip_code}}, {{$employee->state}}, {{$employee->country}}</td>
			<td>{{ $employee->emergency_contact_number }}</td>
			<td>{{ $employee->email_confirmation }}</td>

			<!-- we will also add show, edit, and delete buttons -->
			<td>
				<!-- delete the employee (uses the destroy method DESTROY /employee/{id} -->
				<!-- we will add this later since its a little more complicated than the other two buttons -->
				@if(session()->get('user_type') == 'employee' || session()->get('user_type') == 'admin')
				{{ Form::open(array('url' => url('employee/' . $employee->id))) }}
				{{ Form::hidden('_method', 'DELETE') }}
				{{ Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i>', ['type' => 'submit', 'class' => 'btn btn-danger'] )  }}
				@endif

				{{ Form::close() }}
				<!-- show (uses the show method found at GET /employee/{id} -->
				<a class="btn btn-small btn-success" href="{{ URL::to('employee/' . $employee->id) }}"><i class="fa fa-eye" aria-hidden="true"></i></a>

				@if(session()->get('user_type') == 'employee' || session()->get('user_type') == 'admin')
				<!-- edit (uses the edit method found at GET /employee/{id}/edit -->
				<a class="btn btn-small btn-info" href="{{ URL::to('employee/' . $employee->id . '/edit') }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
				@endif
			</td>
		</tr>
		@endforeach
	</tbody>
</table>
@elseif(session()->get('user_type') == 'company')
<table class="table table-striped table-bordered text-center" id='data-table'>
	<thead>
		<tr>
			<th>ID</th>
			<th>Full Name</th>
			<th>Age</th>
			<th>Gender</th>
			<th>Civil Status</th>
			<th>Number of Children</th>
			<th>Nationality</th>
			<th>Address</th>
			<th>Emergency Contact Number</th>
			<th>E-Mail Address</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
		@if(!empty($workforce->taskassignments))
		@foreach($workforce->taskassignments as $taskassignment)
		<tr>
			<td>{{ $taskassignment->employee->id }}</td>
			<td>{{ $taskassignment->employee->fullname }}</td>
			<td>{{ $taskassignment->employee->age }}</td>
			<td>{{ $taskassignment->employee->gender }}</td>
			<td>{{ $taskassignment->employee->civil_status }}</td>
			<td>{{ $taskassignment->employee->number_of_children }}</td>
			<td>{{ $taskassignment->employee->nationality }}</td>
			<td> {{$taskassignment->employee->address}}, {{$taskassignment->employee->zip_code}}, {{$taskassignment->employee->state}}, {{$taskassignment->employee->country}}</td>
			<td>{{ $taskassignment->employee->emergency_contact_number }}</td>
			<td>{{ $taskassignment->employee->email_confirmation }}</td>

			<!-- we will also add show, edit, and delete buttons -->
			<td>
				<!-- delete the employee (uses the destroy method DESTROY /employee/{id} -->
				<!-- we will add this later since its a little more complicated than the other two buttons -->
				@if(session()->get('user_type') == 'employee' || session()->get('user_type') == 'admin')
				{{ Form::open(array('url' => url('employee/' . $taskassignment->employee->id))) }}
				{{ Form::hidden('_method', 'DELETE') }}
				{{ Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i>', ['type' => 'submit', 'class' => 'btn btn-danger'] )  }}
				@endif

				{{ Form::close() }}
				<!-- show (uses the show method found at GET /employee/{id} -->
				<a class="btn btn-small btn-success" href="{{ URL::to('employee/' . $taskassignment->employee->id) }}"><i class="fa fa-eye" aria-hidden="true"></i></a>

				@if(session()->get('user_type') == 'employee' || session()->get('user_type') == 'admin')
				<!-- edit (uses the edit method found at GET /employee/{id}/edit -->
				<a class="btn btn-small btn-info" href="{{ URL::to('employee/' . $taskassignment->employee->id . '/edit') }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
				@endif
			</td>
		</tr>
		@endforeach
		@endif
	</tbody>
</table>
@endif

<script src='http://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js'></script>
<script src='https://cdn.datatables.net/fixedheader/3.1.3/js/dataTables.fixedHeader.min.js'></script>
<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'></script>
<script>
	$(document).ready(function(){
		$('table#data-table').DataTable({
			pageLength: 5,
			lengthMenu: [[5,10, 20], [5,10, 20]],
			aaSorting: [],
		});
	});
</script>
<script src='{{ asset("js/multiselect.js") }}'></script>
<script>
	$(document).ready(function() {
		$('.multiselect-ui').multiselect();
	});
</script>
<script src="{{ asset('js/country.js') }}"></script>
<script>
	populateCountries("country", "state");
</script>
@endsection
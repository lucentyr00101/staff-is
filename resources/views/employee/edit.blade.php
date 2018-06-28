<!-- if user is not admin --> 
@if(Auth::user()->user_type != 'admin') 
<!-- if user type is employee -->
@if(Auth::user()->user_type == 'employee')
<!-- if logged in employee doesn't have the same id with the employee on view -->
@if(Auth::user()->employee->id != $employee->id)
<script type="text/javascript">
    window.location = "{{ url('/404') }}";
</script>
@endif
@elseif(Auth::user()->user_type == 'company')
<script type="text/javascript">
    window.location = "{{ url('/404') }}";
</script>
@endif
@endif

@extends('layouts.admin')

@section('content')
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>
<link rel="stylesheet" href="{{ asset('css/dashboard_styles.css') }}">
<link rel="stylesheet" href="{{ asset('css/intlTelInput.css') }}">
<link rel="stylesheet" href="{{ asset('css/jquery.fancybox.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/multiselect.css') }}">
<style>
.iti-flag {background-image: url("/img/flags/flags.png");}

@media only screen and (-webkit-min-device-pixel-ratio: 2), only screen and (min--moz-device-pixel-ratio: 2), only screen and (-o-min-device-pixel-ratio: 2 / 1), only screen and (min-device-pixel-ratio: 2), only screen and (min-resolution: 192dpi), only screen and (min-resolution: 2dppx) {
    .iti-flag {background-image: url("/img/flags/flags@2x.png");}
}
</style>
{!! Form::open(['files' => true, 'method' => 'put', 'id' => 'msform', 'url' => url('employee/'.$employee->id)]) !!}
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
@if (Session::has('error_message'))
<div class="alert alert-danger">
    {{ Session::get('error_message') }}
</div>
@endif
<?php
if($employee->dp != null){
    $dp = basename($employee->dp);
} else {
    $dp = null;
}
?>
<div class="row">
    <div class="col-lg-12 toppad" >
        <div class="row">
            @if($dp == null)
            <div class="col-md-3 col-lg-3 profile-pic" align="center">
                <img width='200' height='200' alt="User Pic" src="https://static1.squarespace.com/static/562fb847e4b046e5c5d56b5c/t/5922934659cc68282fc56d1e/1446118163559/" class="img-circle img-responsive">
                <div class="edit"><a href="#" data-toggle='modal' data-target="#editModal"><i class="fa fa-pencil fa-lg"></i></a></div>
                <h3>{{$employee->fullname}}</h3>
            </div>
            @else
            <div class="col-md-3 col-lg-3 profile-pic" align="center"> <a id='pp' href="<?php echo asset("storage/profile_pictures") . '/' . $dp; ?>"><img alt="User Pic" src="<?php echo asset("storage/profile_pictures") . '/' . $dp; ?>" class="img-circle img-responsive"></a>
                <div class="edit"><a href="#" data-toggle='modal' data-target="#editModal"><i class="fa fa-pencil fa-lg"></i></a></div>
                <h3>{{$employee->fullname}}</h3>
            </div>
            @endif

            <div class=" col-md-9 col-lg-9 ">
                <table class="table">
                    <h2 style="border-bottom:2px solid #a9a9a9;">Basic Details</h2>
                    <tbody>
                        <tr>
                            <th>Full Name:</th>
                            <td>{{Form::text('fullname', $employee->fullname , ['placeholder' => 'Job Title', 'class' => 'form-control'])}}</td>
                        </tr>
                        <tr class="nationality-row">
                            <th>Nationality:</th>
                            <input type="hidden" id='get_nationality' value="{{ $employee->nationality }}">
                            <td>
                                <select name="nationality" id="nationality_container" class="form-control nationality">
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
                                    <option value="Kittian and Nevisian">Kittian and Nevisian</option>
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
                                    <option value="New Zealander">New Zealander</option>
                                    <option value="Ni-Vanuatu">Ni-Vanuatu</option>
                                    <option value="Nicaraguan">Nicaraguan</option>
                                    <option value="Nigerien">Nigerien</option>
                                    <option value="North Korean">North Korean</option>
                                    <option value="Northern Irish">Northern Irish</option>
                                    <option value="Norwegian">Norwegian</option>
                                    <option value="Omani">Omani</option>
                                    <option value="Pakistani">Pakistani</option>
                                    <option value="Palauan">Palauan</option>
                                    <option value="Panamanian">Panamanian</option>
                                    <option value="Papua New Guinean">Papua New Guinean</option>
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
                                    <option value="Trinidadian or Tobagonian">Trinidadian or Tobagonian</option>
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
                            </td>
                        </tr>
                        <tr style="display: none;">
                            <th>Hidden Birthday: </th>
                            <td><input type="text" readonly id="birthday" name="birthday" /></td>
                        </tr>
                        <tr>
                            <th>Age:</th>
                            <td>{{ Form::text('age', $employee->age, ['placeholder' => 'Age', 'class' => 'form-control', 'readonly', 'id' => 'age']) }}</td>
                        </tr>

                        <tr>
                            <th>Gender:</th>
                            <td>{{Form::select('gender', ['M' => 'M', 'F' => 'F'], $employee->gender, ['class' => 'form-control'])}}</td>
                        </tr>
                        <tr>
                            <th>Civil Status:</th>
                            <td>{{Form::select('civil_status', ['single' => 'Single', 'married' => 'Married', 'widowed' => 'Widowed'], $employee->civil_status, ['class' => 'form-control'])}}</td>
                        </tr>
                        <tr>
                            <th>Number of Children:</th>
                            <td>{{Form::text('number_of_children', $employee->number_of_children , ['placeholder' => 'Number of Children', 'class' => 'form-control'])}}</td>
                        </tr>
                        <tr>
                            <th>Home Address:</th>
                            <td>{{Form::text('home_address', $employee->address , ['placeholder' => 'Address', 'class' => 'form-control'])}}</td>
                        </tr>
                        <tr>
                            <th>Country</th>
                            <td>{{Form::select('country', ['' => ''],null , ['class' => 'form-control', 'id' => 'country'])}}</td>
                            <input id='hidden_country' type="hidden" value="{{ $employee->country }}">
                        </tr>
                        <tr class='state-container'>
                            <th>State</th>
                            <td><select class='form-control' id="state" name="state"></select></td>
                            <input type="hidden" value="{{ $employee->state }}" id="from_state">
                        </tr>
                        <tr>
                            <th>Zip Code</th>
                            <td>{{Form::text('zip_code', $employee->zip_code, ['required', 'class' => 'form-control', 'placeholder' => 'Zip Code'])}}</td>
                        </tr>

                        <!-- driverslicense start -->

                        @if($employee->hasDriverLicense == 1)
                        <tr>
                            <th>Has Driver's License?</th>
                            <td>
                                <div>{{ Form::radio('license', 1, true, ['class' => 'yes-radio', 'id' => 'yes-radio-l', 'onclick' => 'yesnoCheck();']) }}Yes</div>
                                <div>{{ Form::radio('license', 0, false, ['class' => 'no-radio', 'id' => 'no-radio-l', 'onclick' => 'yesnoCheck();']) }}No</div>
                            </td>
                        </tr>
                        <tr>
                            <th>Type of License</th>
                            <td>
                                {{Form::select('type_of_license[]', ['AM' => 'AM', 'A1' => 'A1', 'A2' => 'A2', 'A' => 'A', 'B1' => 'B1', 'B' => 'B', 'BE' => 'BE', 'C1' => 'C1', 'C1E' => 'C1E', 'C' => 'C', 'CE' => 'CE', 'D1' => 'D1', 'D1E' => 'D1E', 'D' => 'D', 'DE' => 'DE', 'T' => 'T'], explode(',', $employee->type_of_license), ['class' => 'form-control multiselect-ui', 'multiple' => 'multiple'])}}
                            </td>
                        </tr>
                        <tr>
                            <th>Has Car?</th>
                            <td>
                                @if($employee->hasCar == 1)
                                <div>{{ Form::radio('car', 1, true) }}Yes</div>
                                <div>{{ Form::radio('car', 0) }}No</div>
                                @else
                                <div>{{ Form::radio('car', 1, false) }}Yes</div>
                                <div>{{ Form::radio('car', 0, true) }}No</div>
                                @endif
                            </td>
                        </tr>
                        @else
                        <tr>
                            <th>Has Driver's License?</th>
                            <td>
                                <div>{{ Form::radio('license', 1, false, ['class' => 'yes-radio', 'id' => 'yes-radio-l', 'onclick' => 'yesnoCheck();']) }}Yes</div>
                                <div>{{ Form::radio('license', 0, true, ['class' => 'no-radio', 'id' => 'no-radio-l', 'onclick' => 'yesnoCheck();']) }}No</div>
                            </td>
                        </tr>
                        <tr>
                            <th>Type of License</th>
                            <td>
                                {{Form::select('type_of_license[]', ['' => 'N/A', 'AM' => 'AM', 'A1' => 'A1', 'A2' => 'A2', 'A' => 'A', 'B1' => 'B1', 'B' => 'B', 'BE' => 'BE', 'C1' => 'C1', 'C1E' => 'C1E', 'C' => 'C', 'CE' => 'CE', 'D1' => 'D1', 'D1E' => 'D1E', 'D' => 'D', 'DE' => 'DE', 'T' => 'T'], $employee->type_of_license, ['class' => 'form-control', 'multiple' => 'multiple'])}}
                            </td>
                        </tr>
                        <tr>
                            <th>Has Car?</th>
                            <td>
                                <div>{{ Form::radio('car', 1) }}Yes</div>
                                <div>{{ Form::radio('car', 0, true) }}No</div>
                            </td>
                        </tr>
                        @endif
                        <!-- drivers license end-->

                        <tr>
                            <th>Summary:</th>
                            <td>{{Form::textarea('summary', $employee->summary , ['placeholder' => 'Summary', 'class' => 'form-control'])}}</td>
                        </tr>
                        <tr>
                            <th>{{Form::label('criminal_record', 'Clean Criminal Record?')}}</th>
                            <td>{{Form::select('criminal_record', ['1' => 'Yes', '0' => 'No'], $employee->clean_criminal_record, ['class' => 'form-control'])}}</td>
                        </tr>
                        <tr>
                            <th>{{Form::label('smoking', 'Smoking?')}}</th>
                            <td>{{Form::select('smoking', ['1' => 'Yes', '0' => 'No'],$employee->smoking, ['class' => 'form-control'])}}</td>
                        </tr>
                        <tr class='health-problems'>
                            <th>Health Problems:</th>
                            <td>{{Form::textarea('health_problem[]', $employee->health_problem->health_problem, ['placeholder' => 'Health Problem', 'class' => 'form-control', 'id' => 'health_problem'])}}</td>
                        </tr>
                    </tbody>
                </table>

                @if(Auth::user()->user_type != 'admin')
                    <table class="table">
                        <h2 style="border-bottom:2px solid #a9a9a9;">Account Details</h2>
                        <tbody>
                            <tr>
                                <th>Old Password:</th>
                                <td>{{Form::password('old_password', ['placeholder' => 'Old Password', 'class' => 'form-control'])}}</td>
                            </tr>
                            <tr>
                                <th>New Password:</th>
                                <td>{{Form::password('password', ['placeholder' => 'New Password', 'class' => 'form-control'])}}</td>
                            </tr>
                            <tr>
                                <th>Confirm Password:</th>
                                <td>{{Form::password('password_confirmation', ['placeholder' => 'Confirm Password', 'class' => 'form-control'])}}</td>
                            </tr>
                        </tbody>
                    </table>
                @endif

                <table class="table">
                    <h2 style="border-bottom:2px solid #a9a9a9;">Contact Details</h2>
                    <tbody>
                        <tr>
                            <th>Email Address:</th>
                            <td>{{Form::text('email', $employee->user->email , ['readonly', 'placeholder' => 'Email Address', 'class' => 'form-control'])}}</td>
                        </tr>
                        <tr>
                            <th>Confirm Email Address:</th>
                            <td>{{Form::text('email_confirmation', $employee->email_confirmation , ['placeholder' => 'Email Address', 'class' => 'form-control'])}}</td>
                        </tr>
                        <tr>
                            <th>Mobile / Telephone Number: </th>
                            <td>
                                <input type="tel" id="phone" class='form-control' name='telephone_no' value='{{ $employee->telephone }}'>
                                <input type="hidden" id='phone-2' class='form-control' name='telephone' value='{{ $employee->telephone }}'>
                            </td>
                        </tr>
                        <tr>
                            <th>Emergency Contact Name:</th>
                            <td>{{Form::text('emergency_contact_name', $employee->emergency_contact_name, ['placeholder' => 'Emergency Contact Name', 'class' => 'form-control'])}}</td>
                        </tr>
                        <tr>
                            <th>Emergency Contact Number:</th>
                            <td>
                                <input type="tel" id="emergency_contact_number" class='form-control' name='emergency_contact_number_2' value='{{ $employee->emergency_contact_number }}'>
                                <input type="hidden" id='em-contact-2' class='form-control' name='emergency_contact_number' value="{{ $employee->emergency_contact_number }}">
                            </td>
                        </tr>
                    </tbody>
                </table>

                <table class="table">
                    <thead>
                        <th colspan='99'><h2 style="border-bottom:2px solid #a9a9a9;">Banking Information</h2></th>
                    </thead>
                    <tbody class=''>
                        <tr>
                            <th>Account Number:</th>
                            <td>{{Form::text('account_number', $employee->account_number , ['placeholder' => 'XXXX-XX-XXXXXX', 'class' => 'form-control', 'maxlength' => 14, 'id' => 'account_number'])}}</td>
                        </tr>
                    </tbody>
                </table>
                <table class="table">
                    <thead>
                        <th colspan='99'><h2 style="border-bottom:2px solid #a9a9a9;">Languages</h2></th>
                    </thead>
                    <tbody class='language-body'>
                        <tr>
                            <th>Language</th>
                            <th>Proficiency</th>
                        </tr>
                        @foreach($employee->employeelanguage as $language)
                        <tr>
                            <td>
                                <select name="language[]" class="language-select form-control" id="language-select"></select>
                                <input class='get_languages' type="hidden" value='{{ $language->language }}'>
                            </td>
                            <td>{{Form::select('lang_proficiency[]', ['basic' => 'Basic', 'moderate' => 'Moderate', 'high' => 'High'], $language->proficiency, ['class' => 'language-select form-control'])}}</td>
                            <td><input type='button' class='pull-right delete-lang btn theme-btn-dk' value='-'/></td>
                        </tr>
                        @endforeach
                        <tfoot>
                            <tr>
                                <td colspan = '6'><input type="button" class='pull-right add-lang btn theme-btn-lt' value='+' /></td>
                            </tr>
                        </tfoot>
                    </tbody>
                </table>
                <table class="table history">
                    <thead>
                        <th colspan='99'><h2 style="border-bottom:2px solid #a9a9a9;">Employment History</h2></th>
                    </thead>
                    <tbody>
                        <tr>
                            <th>Job Title</th>
                            <th>Job Description</th>
                            <th>Job Duration</th>
                            <th>Company</th>
                        </tr>
                        @foreach($employee->employment_history as $exp)
                        @if($exp->job_duration != null)
                        <tr>
                            <td>
                                {{ Form::select('job_title[]', array(

                                'Computer Jobs' => array(
                                ),
                                'Graphic Design' => array(
                                'Freehand' => 'Freehand',
                                'Illustrator' => 'Illustrator',
                                'InDesign' => 'InDesign',
                                'Photoshop' => 'Photoshop',
                                ),
                                'Software' => array(
                                'Acrobat' => 'Acrobat',
                                'Autocad' => 'Autocad',
                                'Axapta' => 'Axapta',
                                'Concord' => 'Concord',
                                'DK' => 'DK',
                                'Excel' => 'Excel',
                                'Lotus Notes / IBM Notes' => 'Lotus Notes / IBM Notes',
                                'Navision' => 'Navision',
                                'Outlook' => 'Outlook',
                                'Powerpoint' => 'Powerpoint',
                                'Publisher' => 'Publisher',
                                'Word' => 'Word',
                                ),
                                'System Management' => array(
                                'Mac OS' => 'Mac OS',
                                'Linux' => 'Linux',
                                'Oracle' => 'Oracle',
                                'Windows' => 'Windows',
                                ),
                                'Web Development/Design' => array(
                                'Codeigniter' => 'Codeigniter',
                                'Dreamweaver' => 'Dreamweaver',
                                'Joomla' => 'Joomla',
                                'Laravel' => 'Laravel',
                                'Wordpress' => 'Wordpress',
                                ),
                                'Webmaster' => array(
                                'Webmaster' => 'Webmaster',
                                ),

                                'Driving Jobs' => array(
                                'Driver' => 'Driver',
                                ),

                                'Industrial Jobs' => array(
                                'Bifreiðasmiður' => 'Bifreiðasmiður',
                                'Bílamálun' => 'Bílamálun',
                                'Building Jobs' => 'Building Jobs',
                                'Car Mechanics' => 'Car Mechanics',
                                'Carpentry' => 'Carpentry',
                                'Device Controller' => 'Device Controller',
                                'Electrical' => 'Electrical',
                                'Electronic' => 'Electronic',
                                'Engineering' => 'Engineering',
                                'Farm Work' => 'Farm Work',
                                'Gardening' => 'Gardening',
                                'House Painting' => 'House Painting',
                                'Joinery' => 'Joinery',
                                'Machinery' => 'Machinery',
                                'Mechanics' => 'Mechanics',
                                'Metal Products' => 'Metal Products',
                                'Paint Jobs' => 'Paint Jobs',
                                ),

                                'Management Jobs' => array(
                                'CFO' => 'CFO',
                                'Chief Executive Officer' => 'Chief Executive Officer',
                                'Director' => 'Director',
                                'Foreman' => 'Foreman',
                                'Head of Department' => 'Head of Department',
                                'Inventory Manager' => 'Inventory Manager',
                                'Manager' => 'Manager',
                                'Marketing' => 'Marketing',
                                'Marketing Manager' => 'Marketing Manager',
                                'Office Manager' => 'Office Manager',
                                'Project Manager' => 'Project Manager',
                                'Purchasing' => 'Purchasing',
                                ),

                                'Office Jobs' => array(
                                'Accounting' => 'Accounting',
                                'Billing' => 'Billing',
                                'Clerk' => 'Clerk',
                                'Personnel' => 'Personnel',
                                'Reception' => 'Reception',
                                'Secretarial' => 'Secretarial',
                                'Shipping Fleet' => 'Shipping Fleet',
                                'Shopping' => 'Shopping',
                                'Treasurer' => 'Treasurer',
                                'Service Center' => 'Service Center',
                                ),

                                'Sales Jobs' => array(
                                'Phone Sales' => 'Phone Sales',
                                'Sales Management' => 'Sales Management',
                                'Sales Outside' => 'Sales Outside',
                                ),

                                'Service Jobs' => array(
                                'Culinary Jobs' => 'Culinary Jobs',
                                'Janitor' => 'Janitor',
                                'Reception' => 'Reception',
                                'Security Patrols' => 'Security Patrols',
                                ),

                                'Trade Jobs' => array(
                                'Public Service' => 'Public Service',
                                'Trade Management' => 'Trade Management',
                                ),

                                'Teaching Jobs' => array(
                                'College Professor/Instructor' => 'College Professor/Instructor',
                                'Primary School Teacher' => 'Primary School Teacher',
                                'Kindergarten Teacher' => 'Kindergarten Teacher',
                                ),

                                'Others' => array(
                                'Advertising Model' => 'Advertising Model',
                                'Architect' => 'Architect',
                                'Business Administration' => 'Business Administration',
                                'Economics' => 'Economics',
                                'Engineering Jobs' => 'Engineering Jobs',
                                'Fish Processing' => 'Fish Processing',
                                'Jobs Market' => 'Jobs Market',
                                'Lagerstörf' => 'Lagerstörf',
                                'Law' => 'Law',
                                'Logistics' => 'Logistics',
                                'Nursing' => 'Nursing',
                                'Paramedic' => 'Paramedic',
                                'Pharmacy' => 'Pharmacy',
                                'Pharmacy Technician' => 'Pharmacy Technician',
                                'Production Jobs' => 'Production Jobs',
                                'Public Relations' => 'Public Relations',
                                'Publications' => 'Publications',
                                'Seafaring' => 'Seafaring',
                                'Social Care' => 'Social Care',
                                'Technical Drawing' => 'Technical Drawing',
                                'Verkamannastörf' => ' Verkamannastörf',
                                ),

                                ),$exp->job_title ,['class' => 'form-control'])}}
                            </td>
                            <td>{{Form::textarea('job_description[]', $exp->job_description, ['class' => 'form-control'])}}</td>
                            <td>
                                <?php
                                $jd = explode(' ', $exp->job_duration);
                                ?>
                                {{ Form::text('jdn[]', $jd[0], ['class' => 'form-control col-md-4']) }}
                                {{ Form::select('jdmmyy[]', ['year/s' => 'year/s', 'month/s' => 'month/s'], $jd[1], ['class' => 'form-control']) }}
                            </td>
                            <td>{{Form::text('company[]', $exp->company, ['class' => 'form-control'])}}</td>
                            <td><input type='button' class='pull-right delete-history btn theme-btn-dk' value='-'/></td>
                        </tr>
                        @endif
                        @endforeach
                        <tfoot>
                            <tr>
                                <td colspan = '6'><input type="button" class='pull-right add-history btn theme-btn-lt' value='+' /></td>
                            </tr>
                        </tfoot>
                    </tbody>
                </table>
                <table class="table location">
                    <thead>
                        <th colspan='99'><h2 style="border-bottom:2px solid #a9a9a9;">Prefered Work Location and Schedule of Work</h2></th>
                    </thead>
                    <tbody>
                        <tr class='work_location_row'>
                            <th>Location</th>
                        </tr>
                        @foreach($employee->preferable_work as $loc)
                        <tr>
                            <td> </td>
                            <td>
                                <select name="location[]" class="state_location form-control" id="state_location"></select>
                                <input class='get_location' type="hidden" value='{{ $loc->location }}'>
                            </td>
                            <td><input type='button' class='pull-right delete-location btn theme-btn-dk' value='-'/></td>
                        </tr>
                        @endforeach
                        <tfoot>
                            <tr>
                                <td colspan = '6'><input type="button" class='pull-right add-location btn theme-btn-lt' value='+' /></td>
                            </tr>
                            <tr>
                                <th>Prefered Schedule of Work</th>
                                <td>{{Form::select('schedule_of_work', ['Full Time Job' => 'Full Time Job', 'Part Time Job' => 'Part Time Job', 'Weekend Job' => 'Weekend Job'], null, ['class' => 'form-control'])}}</td>
                            </tr>
                            <tr>
                                <th>Prefered Shift Schedule</th>
                                <td>{{Form::select('shift', ['Morning Shift' => 'Morning Shift', 'Afternoon Shift' => 'Afternoon Shift', 'Night Shift' => 'Night Shift'], null, ['class' => 'form-control'])}}</td>
                            </tr>
                        </tfoot>
                    </tbody>
                </table>

                <table class="table educ">
                    <thead>
                        <th colspan='99'><h2 style="border-bottom:2px solid #a9a9a9;">Education History</h2></th>
                    </thead>
                    <tbody>
                        <tr>
                            <th>School Name</th>
                            <th>Course/Degree</th>
                            <th>Highest Degree Attained</th>
                            <th>Year Graduated</th>
                        </tr>
                        <div>
                            {!! Form::select('', $degree, null, ['style' => 'display:none', 'id' => 'hidden_hda']) !!}
                        </div>

                        @foreach($employee->education_history as $educ)
                        @if($educ->school_name != null)
                        <tr>
                            <td>{{Form::text('school_name[]', $educ->school_name, ['class' => 'form-control'])}}</td>
                            <td>{{Form::text('degree[]',$educ->degree , ['placeholder' => 'Course/Degree', 'class' => 'form-control'])}}</td>
                            <td>
                                {{ Form::select('highest_degree_attained[]', $degree, $educ->highest_degree_attained, ['class' => 'form-control']) }}
                            </td>
                            <td><select name="year_graduated[]" class="yearpicker form-control"></select></td>
                            <input type="hidden" value="{{ $educ->year_graduated }}" class="hidden_year">
                            <td><input type='button' class='pull-right delete-educ btn theme-btn-dk' value='-'/></td>
                        </tr>
                        @endif
                        @endforeach

                        <tfoot>
                            <tr>
                                <td colspan = '6'><input type="button" class='pull-right add-educ btn theme-btn-lt' value='+' /></td>
                            </tr>
                        </tfoot>
                    </tbody>
                </table>

                <table class="table cert">
                    <h2 style="border-bottom:2px solid #a9a9a9;">Resume / Certificate</h2>
                    <tbody>
                        <tr>
                            <th>{{Form::label('cv','Upload a resume or a certificate:')}} {{Form::file('cv[]', ['accept' => 'application/pdf, application/msword, .docx, .doc'])}}</th>
                            <td>{{Form::label('emp_cv', 'Resume / Certificate')}} {{Form::select('cv_type[]', ['resume' => 'Resume', 'certificate' => 'Certificate'], $employee->highest_degree_attained, ['class' => 'form-control'])}}</td>
                            <td><input type='button' class='pull-right delete-cert btn theme-btn-dk' value='-'/></td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td> </td><td> </td>
                            <td><input type='button' class='pull-right add-cert btn theme-btn-lt' value='+'/></td>
                        </tr>
                    </tfoot>
                </table>
                {{ Form::submit('Save', array('class' => 'btn btn-primary')) }}
            </div>
        </div>
    </div>
</div>

<input type="hidden" value="{{$employee->id}}" id='hidden_id'/> 

{{ Form::close() }}


<div class="modal fade" id="editModal" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit Profile Picture</h4>
            </div>
            <div class="modal-body">
                <div id="change-profile-picture">
                    {{ Form::open(['url' => url('/employee-change-picture/' . $employee->id), 'method' => 'put', 'files' => true]) }}
                    {{Form::file('new_profile_picture', ['accept' => 'image/*']) }}
                    {{ Form::submit('Submit', ['class' => 'btn btn-success', 'style' => 'width:100%; margin-top:5%;']) }}
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        $( "#datepicker_is, #datepicker_non_is" ).datepicker({
            changeMonth: true,
            changeYear: true,
            yearRange: "-60:+0",
            dateFormat: 'dd/mm/y',
        });
    });
    $('#datepicker_is, #datepicker_non_is').on('change', function(){
        var getbirthday = $(this).val().split(/\//);

        var newformat = [getbirthday[1], getbirthday[0], getbirthday[2]].join('/');
        var showbday = String([getbirthday[0]+getbirthday[1]+getbirthday[2]]);
        var birthday = new Date(newformat);

        var day = birthday.getDate();
        day = day > 9 ? day : '0' + day;

        var month = birthday.getMonth() + 1;
        month = month > 9 ? month : '0' + month;

        var year = birthday.getFullYear();

        var newbirthday = String(month)+String(day)+String(year);

        var today = new Date();
        var age = today.getFullYear() - birthday.getFullYear();
        var m = today.getMonth() - birthday.getMonth();
        if (m < 0 || (m === 0 && today.getDate() < birthday.getDate())) {
            age--;
        }
        $('#age').val(age);
        $('#birthday').val($(this).val());
        $(this).val(showbday);
    });
</script>
<script src="{{ asset('js/intlTelInput.js') }}"></script>
<script src="{{ asset('js/utils.js') }}"></script>

<script>
    $("#phone").intlTelInput();
    $('#phone').on('keydown keyup', function(){
        var intlNumber = $("#phone").intlTelInput("getNumber");
        $('#phone-2').val(intlNumber);
    });

    $("#emergency_contact_number").intlTelInput();
    $('#emergency_contact_number').on('keydown keyup', function(){
        var intlNumber = $("#emergency_contact_number").intlTelInput("getNumber");
        $('#em-contact-2').val(intlNumber);
    });
</script>

<script src="{{ asset('js/country.js') }}"></script>
<script language="javascript">
    populateCountries("country", "state");
</script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.13/jquery.mask.min.js'></script>
<script>
    $("#account_number").mask("9999-99-999999");
    $("#id_p2").mask("9999");
</script>

<script language="javascript">
    populateCountries("country", "state");
</script>
<script>
//remove another option from highest degree attained
$("#hda-s option").val(function(idx, val) {
    $(this).siblings("[value='"+ val +"']").remove();
});
</script>
<!-- multiselect dropdown -->
<script src='{{ asset("js/multiselect.js") }}'></script>
<script>
    $('.multiselect-ui').multiselect();
</script>
<script>
    $(document).ready(function(){
        var country = $('#hidden_country').val();
        $('#country option[value="'+country+'"]').attr('selected', true);
        populateStates('country', 'state');

        var from_state = $('#from_state').val();
        $('.state-container').find('#state option[value="'+from_state+'"]').attr('selected', true);

        var nationality = $('#get_nationality').val();
        $('#nationality_container').find('option[value="'+nationality+'"]').attr('selected', true);

        populateStates('country', 'state_location');
        $('.state_location:first option').clone().appendTo('.state_location:gt(0)');
        $('.state_location').each(function(){
            var test = $(this).parent().find('.get_location').val();
            $(this).find('option[value="'+test+'"]').attr('selected', true);
        });
    });
</script>
<script src='{{ asset("js/jquery.fancybox.min.js") }}'></script>
<script type="text/javascript">
    $('#pp').fancybox({
      buttons : [
      'zoom',
      'close'
      ]
  });
</script>
<script>
    $(document).ready(function(){
        for (i = new Date().getFullYear(); i > 1900; i--)
        {
            $('.yearpicker').append($('<option />').val(i).html(i));
        }

        $('.yearpicker').each(function(){
            var l = $(this).parent().parent().find('.hidden_year').val();
            console.log(l);
            $(this).find('option[value="'+l+'"]').attr('selected', true);
        });
    });
</script>
@endsection
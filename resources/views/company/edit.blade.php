<!-- if user is not admin --> 
@if(Auth::user()->user_type != 'admin') 
<!-- if user type is company -->
@if(Auth::user()->user_type == 'company')
<!-- if logged in company doesn't have the same id with the company on view -->
@if(Auth::user()->company->id != $company->id)
<script type="text/javascript">
    window.location = "{{ url('/404') }}";
</script>
@endif
@elseif(Auth::user()->user_type == 'employee')
<script type="text/javascript">
    window.location = "{{ url('/404') }}";
</script>
@endif
@endif

@extends('layouts.admin')

@section('content')
<!-- JQuery UI CSS -->
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="{{ asset('css/timepicker.css') }}">
<link rel="stylesheet" href="{{ asset('css/multiselect.css') }}">
<style>
.theme-btn-dk {
    color: #fff !important;
    background: #2f0e46 !important;
    border: 0 !important;
    font-size: 13px;
    transition: background 0.3s linear, color 0.3s linear;
}


.theme-btn-lt {
    background: #6f2ca1 !important;
    color: #fff !important;
    border: 0 !important;
    font-size: 13px;
    transition: background 0.3s linear, color 0.3s linear;
}

.theme-btn-lt:hover {
    background: #2f0e46 !important;
}

.theme-btn-dk:hover {
    background: #6f2ca1 !important;
}
</style>

<!-- Area Code for Mobile Numbers CSS -->
<link rel="stylesheet" href="{{ asset('css/intlTelInput.css') }}">
<style>
.iti-flag {background-image: url("/img/flags/flags.png");}
@media only screen and (-webkit-min-device-pixel-ratio: 2), only screen and (min--moz-device-pixel-ratio: 2), only screen and (-o-min-device-pixel-ratio: 2 / 1), only screen and (min-device-pixel-ratio: 2), only screen and (min-resolution: 192dpi), only screen and (min-resolution: 2dppx) {
    .iti-flag {background-image: url("/img/flags/flags@2x.png");}
}
</style>

<!-- DateTime Picker JQuery Plugin CSS -->
<link rel="stylesheet" href="{{ asset('css/jquery.simple-dtpicker.css') }}">

<!-- START -->
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
if($company->profile_image_filepath != null){
    $path = decrypt($company->profile_image_filepath);
    $dp = basename($path);
} else {
    $dp = null;
}
?>
<div class="row">
    <div class="col-lg-12 toppad">
        <div class="row">
            @if($dp == null)
            <div class="col-md-3 col-lg-3 profile-pic" align="center">
                <img width='200' height='200' alt="User Pic" src="https://static1.squarespace.com/static/562fb847e4b046e5c5d56b5c/t/5922934659cc68282fc56d1e/1446118163559/" class="img-circle img-responsive">
                <div class="edit"><a href="#" data-toggle='modal' data-target="#editModal"><i class="fa fa-pencil fa-lg"></i></a></div>
                <h3>{{$company->fullname}}</h3>
            </div>
            @else
            <div class="col-md-3 col-lg-3 profile-pic" align="center"> <img width='200' height='200' alt="User Pic" src="<?php echo asset("storage/profile_pictures") . '/' . $dp; ?>" class="img-circle img-responsive">
                <div class="edit"><a href="#" data-toggle='modal' data-target="#editModal"><i class="fa fa-pencil fa-lg"></i></a></div>
                <h3>{{$company->fullname}}</h3>
            </div>
            @endif
            {!! Form::open(['files' => true, 'method' => 'put', 'url' => url('company/'.$company->id)]) !!}
            <div class="col-md-9 col-lg-9">
                <h2 style="border-bottom:2px solid #a9a9a9">Company Details</h2>

                <div class="form-group">
                    {{ Form::label('fullname', 'Full Name') }}
                    {{Form::text('fullname', $company->fullname , ['placeholder' => 'Full Name', 'class' => 'form-control'])}}
                </div>

                <div class="form-group">
                    {{ Form::label('contact_person', 'Contact Person') }}
                    {{ Form::text('contact_person', $company->contact_person, ['placeholder' => 'Contact Person', 'class' => 'form-control']) }}
                </div>

                <div class="form-group">
                    {{ Form::label('department', 'Department') }}
                    {{ Form::text('department', $company->department, ['class' => 'form-control']) }}
                </div>

                <div class="form-group">
                    {{ Form::label('id_number', 'ID Number') }}
                    {{Form::text('id_p2',  $company->id_number  , ['placeholder' => 'ID Number', 'class' => 'form-control', 'id' => 'id_p2'])}}
                </div>
                
                <div class="form-group">
                    {{ Form::label('contact_number', 'Mobile Number') }}
                    <input type="tel" id="mbn" class='form-control' value="{{ $company->user->contact_number }}">
                    <input type="hidden" id='mbn-2' class='form-control' name='contact_number' value="{{ $company->user->contact_number }}">
                </div>

                <div class="form-group">
                    {{ Form::label('telephone_no', 'Telephone Number') }}
                    <input type="tel" id="phone" class='form-control' name='telephone_no' value="{{ $company->telephone_number }}">
                    <input type="hidden" id='phone-2' class='form-control' name='telephone' value="{{ $company->telephone_number }}">
                </div>

                <div class="form-group">
                    {{ Form::label('email', 'Email Address') }}
                    {{ Form::text('email', $company->user->email, ['readonly', 'class' => 'form-control']) }}
                </div>

                <div class="form-group">
                    {{ Form::label('working_location_state', 'Working Location') }}
                    {{ Form::text('working_location_state', $company->working_location, ['class' => 'form-control']) }}
                </div>

                <div>
                    <input type="hidden" value='{{ $company->schedule_start }}' id='start_datetime'><br>
                    <input type="hidden" value="{{ $company->schedule_end }}" id="end_datetime">
                </div>

                <!-- Company Address Section -->
                <div class="form-group">
                    <h1>Company Address</h1>
                </div>

                <div class="form-group">
                    {{ Form::label('company_address', 'Company Address') }}
                    {{ Form::text('company_address', $company->company_address, ['placeholder' => 'Block/Lot/Street/Number', 'class' => 'form-control']) }}
                </div>

                <div class="form-group">
                    {{ Form::label('company_country', 'Country') }}
                    {{ Form::select('company_country', [], null, ['class' => 'form-control', 'id' => 'company_country']) }}
                    <input type="hidden" id='cc' value="{{ $company->company_country }}" />
                </div>

                <div class="form-group">
                    {{ Form::label('company_state'), 'State' }}
                    {{ Form::select('company_state', [], null, ['class' => 'form-control', 'id' => 'company_state']) }}
                    <input type="hidden" id='cs' value="{{ $company->company_state }}">
                </div>

                <div class="form-group">
                    {{ Form::label('company_zip_code', 'Zip Code') }}
                    {{ Form::text('company_zip_code', $company->company_zip_code, ['class' => 'form-control']) }}
                    <input type="hidden" id='czc' value="{{ $company->company_zip_code }}">
                </div>

                <!-- Branch Address Section -->
                <div class="form-group">
                    <h1>Branch Address</h1>
                </div>

                <div class="form-group">
                    {{ Form::label('branch_address', 'Branch Address') }}
                    {{ Form::text('branch_address', $company->branch_address, ['placeholder' => 'Block/Lot/Street/Number', 'class' => 'form-control']) }}
                </div>

                <div class="form-group">
                    {{ Form::label('branch_country', 'Country') }}
                    {{ Form::select('branch_country', [], null, ['class' => 'form-control', 'id' => 'branch_country']) }}
                    <input type="hidden" id="bc" value="{{ $company->branch_country }}">
                </div>

                <div class="form-group">
                    {{ Form::label('branch_state'), 'State' }}
                    {{ Form::select('branch_state', [], null, ['class' => 'form-control', 'id' => 'branch_state']) }}
                    <input type="hidden" id="bs" value="{{ $company->branch_state }}">
                </div>

                <div class="form-group">
                    {{ Form::label('branch_zip_code', 'Zip Code') }}
                    {{ Form::text('branch_zip_code', $company->branch_zip_code, ['class' => 'form-control']) }}
                    <input type="hidden" id="bzc" value="{{ $company->branch_zip_code }}">
                </div>


                <!-- Account Details (Password Reset) -->
                @if(Auth::user()->user_type != 'admin')
                    <h2 style="border-bottom:2px solid #a9a9a9">Account Details</h2>
                    <div class="form-group">
                        {{ Form::label('password', 'Old Password') }} <i>Leave this field empty if you don't want to change your password</i>
                        {{Form::password('old_password', ['placeholder' => 'Old Password', 'class' => 'form-control']) }}
                    </div>

                    <div class="form-group">
                        {{ Form::label('password', 'Password') }} <i>Leave this field empty if you don't want to change your password</i>
                        {{Form::password('password', ['placeholder' => 'New Password', 'class' => 'form-control']) }}
                    </div>

                    <div class="form-group">
                        {{ Form::label('password_confirmation') }} <i>Leave this field empty if you don't want to change your password</i>
                        {{Form::password('password_confirmation', ['placeholder' => 'Password Confirmation', 'class' => 'form-control']) }}
                    </div>
                @endif

                {{ Form::submit('Save', array('class' => 'btn btn-primary')) }}                
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>

<div class="modal fade" id="editModal" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit Profile Picture</h4>
            </div>
            <div class="modal-body">
                <div id="change-profile-picture">
                    {{ Form::open(['url' => url("/company-change-picture".$company->id), 'method' => 'put', 'files' => true]) }}
                    {{Form::file('new_profile_picture')}}
                    {{ Form::submit('Submit', ['class' => 'btn btn-success', 'style' => 'width:100%; margin-top:5%;']) }}
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>

<!-- JQuery -->
<script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>

<!-- Dynamic Country and State List -->
<script src="{{ asset('js/country.js') }}"></script>
<script>
    populateCountries("company_country", "company_state");
    populateCountries('branch_country', 'branch_state');
</script>

<!-- DatePicker JQuery -->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>

<!-- Multi Select Plugin -->
<script src='{{ asset("js/multiselect.js") }}'></script>

<!-- Timepicker Plugin -->
<script src="{{ asset('js/timepicker.js') }}"></script>

<script>
    $('.schedule_time').timepicker({
        'timeFormat': 'H:i',
        'step': 15,
    });
</script>

<script>
    $(document).ready(function(){
        $('.multiselect-ui').multiselect();
    });
</script>
<script>
    $( "#datepicker" ).datepicker({
        changeMonth: true,
        changeYear: true,
        yearRange: "-100:+0",
        dateFormat: 'dd/mm/y',
    });

    $('#datepicker').on('change', function(){
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
        $('#id_p1').val(showbday);
        $('#id_p1_s').val(showbday);
    });
</script>

<!-- Area Codes for Mobile Numbers -->
<script src="{{ asset('js/intlTelInput.js') }}"></script>
<script src="{{ asset('js/utils.js') }}"></script>
<script>
    $("#phone").intlTelInput();
    $('#phone').on('change', function(){
        var intlNumber = $("#phone").intlTelInput("getNumber");
        $('#phone-2').val(intlNumber);
    });

    $("#mbn").intlTelInput();
    $('#mbn').on('change', function(){
        var intlNumber = $("#mbn").intlTelInput("getNumber");
        $('#mbn-2').val(intlNumber);
        console.log(intlNumber);
    });
</script>

<!-- Onload values of hidden fields -->
<script>
    $(document).ready(function(){
        $('#telephone').val
    });
</script>

<!-- ID Number Masking  -->
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.13/jquery.mask.min.js'></script>
<script>
    $("#id_p2").mask("999999-9999");
</script>

<script>
    $(document).ready(function(){
        var cc = $('#cc').val();
        $('#company_country option[value="'+cc+'"]').attr('selected', true);
        populateStates('company_country', 'company_state');

        var cs = $('#cs').val();
        $(document).find('#company_state option[value="'+cs+'"]').attr('selected', true);

        var bc = $('#bc').val();
        $('#branch_country option[value="'+bc+'"]').attr('selected', true);
        populateStates('branch_country', 'branch_state');

        var bs = $('#bs').val();
        $(document).find('#branch_state option[value="'+bs+'"]').attr('selected', true);
    });
</script>
<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'></script>
@endsection
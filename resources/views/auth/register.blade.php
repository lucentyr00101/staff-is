@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/intlTelInput.css') }}"><!-- https://github.com/jackocnr/intl-tel-input -->
<style>
.iti-flag {
    background-image: url("{{ asset('img/flags/flags.png') }}");
}

@media only screen and (-webkit-min-device-pixel-ratio: 2), only screen and (min--moz-device-pixel-ratio: 2), only screen and (-o-min-device-pixel-ratio: 2 / 1), only screen and (min-device-pixel-ratio: 2), only screen and (min-resolution: 192dpi), only screen and (min-resolution: 2dppx) {
    .iti-flag {
        background-image: url("{{ asset('img/flags/flags@2x.png') }}");
    }
}
</style>
@if (Session::has('message'))
<div class="alert alert-success">{{ Session::get('message') }}</div>
@endif

<div class="container">
    <div class="form-outer-container">
        <div class="form-container">
            <div class="form-header">
                <h1>Register</h1>
            </div>
            <div class="form-body">
                <ul class="nav nav-tabs nav-justified">
                    <li class="active"><a href="#employeePane" data-toggle="tab">as Employee</a></li>
                    <li><a href="#companyPane" data-toggle="tab">as Company</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade in active" id="employeePane">
                        <form class="form" action="{{ route('register') }}" method="POST">
                            {{ csrf_field() }}
                            <input id="user_type" type="text" class="form-control form-input" name="user_type" value="employee" required style="visibility: hidden">

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email">E-Mail Address</label>
                                <input type="email" name="email" id="email" class="form-control form-input" placeholder="E-Mail Address" value="{{ old('email') }}" required>
                                @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('contactno') ? ' has-error' : '' }}">
                                <label for="contactno">Contact Number</label>
                                <input type="text" id="contactno_emp" class="form-control form-input" value="{{ old('contactno') }}" required>
                                <input type="hidden" id="contactno2_emp" name='contactno'>
                                @if ($errors->has('contactno'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('contactno') }}</strong>
                                </span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password">Password</label>
                                <input type="password" name="password" id="password_employee" class="form-control form-input" placeholder="Password" required>
                                @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                <label for="password_confirmation">Confirm Password</label>
                                <input type="password" name="password_confirmation" id="password_confirmation_employee" class="form-control form-input" placeholder="Confirm Password" required>
                            </div>

                            <div class="form-group text-center">
                                <button type="submit" class="form-submit btn btn-lg submit_employee">Register as Employee</button>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="companyPane">
                        <form class="form" action="{{ route('register') }}" method="POST">
                            {{ csrf_field() }}
                            <input id="user_type" type="text" class="form-control form-input" name="user_type" value="company" required style="visibility: hidden">
                            <div class="form-group{{ $errors->has('fullname') ? ' has-error' : '' }}">
                                <label for="fullname">Company Name</label>
                                <input type="text" name="fullname" id="fullname" class="form-control form-input" placeholder="Full Name" value="{{ old('fullname') }}" required>
                                @if ($errors->has('fullname'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('fullname') }}</strong>
                                </span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email">E-Mail Address</label>
                                <input type="email" name="email" id="email" class="form-control form-input" placeholder="E-Mail Address" value="{{ old('email') }}" required>
                                @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('contactno') ? ' has-error' : '' }}">
                                <label for="contactno">Contact Number</label>
                                <input type="text" id="contactno_company" class="form-control form-input" value="{{ old('contactno') }}" required>
                                <input type="hidden" id='contactno2_company' name="contactno">
                                @if ($errors->has('contactno'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('contactno') }}</strong>
                                </span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password">Password</label>
                                <input type="password" name="password" id="password_company" class="form-control form-input" placeholder="Password" required>
                                @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                <label for="password_confirmation">Confirm Password</label>
                                <input type="password" name="password_confirmation" id="password_confirmation_company" class="form-control form-input" placeholder="Confirm Password" required>
                            </div>

                            <div class="form-group text-center">
                                <button type="submit" class="form-submit btn btn-lg submit_company">Register as Company</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('jquery')
<!-- scripts -->
<script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
<script src="{{ asset('js/intlTelInput.js') }}"></script>
<script src="{{ asset('js/utils.js') }}"></script>
<script src="{{ asset('js/register.js') }}"></script>
<script>
    $('#contactno_emp').intlTelInput();
    $('#contactno_emp').on('keyup keydown', function(){
        var intlNumber = $("#contactno_emp").intlTelInput("getNumber");
        $('#contactno2_emp').val(intlNumber);
    });

    $('#contactno_company').intlTelInput();
    $('#contactno_company').on('keyup keydown', function(){
        var intlNumber = $("#contactno_company").intlTelInput("getNumber");
        $('#contactno2_company').val(intlNumber);
    });

</script>
@endsection

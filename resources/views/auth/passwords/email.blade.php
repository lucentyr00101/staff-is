@extends('layouts.app')

@section('content')
<div class="container">
    <div class="form-outer-container">
        <div class="form-container">
            <div class="form-header">
                <h1>Reset Password</h1>
            </div>
            <div class="form-body">
                @if(session()->has('status'))
                <div class="alert-container">
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        {{ Session::get('status') }}
                    </div>
                </div>
                @endif
                <form class="form" action="{{ route('password.email') }}" method="POST">
                    {{ csrf_field() }}

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">

                        <label for="email">E-Mail Address</label>
                        <input type="text" name="email" id="email" class="form-control form-input" value="{{ old('email') }}" placeholder="E-Mail Address" required autofocus>
                        @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                        @endif
                    </div>

                    <div class="form-group text-center">
                        <button type="submit" class="form-submit btn btn-lg">Send Reset Password Link</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



@endsection

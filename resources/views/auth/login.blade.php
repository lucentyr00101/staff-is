@extends('layouts.app')

@section('content')
<div class="container">
    <div class="form-outer-container">
        <div class="form-container">
            <div class="form-header">
                <h1>Login</h1>
            </div>
            @if (Session::has('message'))
            <div class="alert-container">
                <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    {{ Session::get('message') }}
                </div>
            </div>
            @elseif (Session::has('success'))
            <div class="alert-container">
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    {{ Session::get('success') }}
                </div>
            </div>
            @endif
            <div class="form-body">
                <form class="form" action="{{ route('login') }}" method="POST">
                    {{ csrf_field() }}
                    <?php
                    if(!empty($_GET['re'])){
                        $url = decrypt($_GET['url']);
                        $id = decrypt($_GET['id']); ?>
                        <input type="hidden" value="<?php echo $url; ?>" name="hidden_redirect_url">
                        <input type="hidden" value="<?php echo $id; ?>" name="hidden_id">
                        <?php
                    }
                    ?>
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email">E-Mail Address</label>
                        <input type="text" name="email" id="email" class="form-control form-input" value="{{ old('email') }}" placeholder="E-Mail Address" required autofocus>
                        <p>*For employees, you can also use your mobile number for login.</p>

                        @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                        @endif
                    </div>

                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" class="form-control form-input" placeholder="Password" required>

                        @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="user_type">Login As</label>
                        <select name="user_type" id="user_type" class="form-control form-input">
                            <option value="employee">Employee</option>
                            <option value="company">Company</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <div class="checkbox">
                            <label for="remember">
                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                            </label>
                        </div>
                    </div>

                    <div class="form-group text-center">
                        <button type="submit" class="form-submit btn btn-lg">Login</button>
                    </div>

                    <div class="form-group">
                        <a class="form-link" href="{{ route('password.request') }}">
                            Forgot Your Password?
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

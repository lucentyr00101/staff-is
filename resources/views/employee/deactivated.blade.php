@extends('layouts.app')

@section('content')
<div class="container">
    <div class="form-outer-container">
        <div class="form-container">
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

                    <div class="well">
                        <h4>Your account is currently deactivated. Would you like to reactivate?</h4>
                    </div>

                    <div class="form-group text-center">
                        <a href="{{ url('/deactivated/yes') }}" class="form-submit btn btn-lg">Yes</a>
                    </div>
                    <div class="form-group text-center">
                        <a href="{{ url('/deactivated/no') }}" class="form-submit btn btn-lg">No</a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection

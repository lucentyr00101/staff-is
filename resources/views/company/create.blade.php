@extends('layouts.admin')


@section('content')
@if ($errors->any())
<div class="alert alert-danger">
	<ul>
		@foreach ($errors->all() as $error)
		<li>{{ $error }}</li>
		@endforeach
	</ul>
</div>
@endif
{!! Form::open(['files' => true, 'method' => 'post', 'url' => url('company')]) !!}

<div class="form-group">
	{{ Form::label('fullname', 'Company Full Name') }}
	{{Form::text('fullname', '' , ['placeholder' => 'Full Name', 'class' => 'form-control'])}}
</div>

<div class="form-group">
	{{ Form::label('email', 'Company Email Address') }}
	{{Form::text('email', '' , ['placeholder' => 'Company Email Address', 'class' => 'form-control'])}}
</div>

<div class="form-group">
	{{ Form::label('contactno', 'Company Contact Number') }}
	{{Form::text('contactno', '' , ['placeholder' => 'Company Contact Number', 'class' => 'form-control'])}}
</div>

<div class="form-group">
	{{ Form::label('password', 'Password') }}
	{{ Form::password('password', ['class' => 'form-control']) }}
</div>

{{ Form::submit('Create Company', array('class' => 'btn btn-primary')) }}
@endsection



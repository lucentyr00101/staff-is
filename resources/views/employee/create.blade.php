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

<div class="row">
	<div class="well">
		{{ Form::open(['url' => url('employee'), 'method' => 'post']) }}
		<div>
			{{ Form::label('email', 'Email Address') }}
			{{ Form::text('email', null, ['class' => 'form-control']) }}
		</div>
		<div>
			{{ Form::label('password', 'Password') }}
			{{ Form::password('password', ['class' => 'form-control']) }}
		</div>
		<div>
			{{ Form::label('contact_number', 'Contact Number') }}
			{{ Form::text('contact_number', null, ['class' => 'form-control']) }}
		</div>
		<div>
			{{ Form::submit('Submit', ['class' => 'btn btn-success']) }}
		</div>
		{{ Form::close() }}
	</div>
</div>
@endsection
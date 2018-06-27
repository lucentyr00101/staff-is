@extends('layouts.admin')
@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="{{ asset('js/ckeditor/ckeditor.js') }}"></script>
<style>
ul{
	list-style-type: unset;
}
</style>
{{ Form::open(array('url' => url('/settings/customize-email-notifications/update/'), 'method' => 'put')) }}
<div class="container">
	<ul class="nav nav-tabs">
		<li class="active"><a data-toggle="tab" href="#home">New Employee Email Notification</a></li>
		<li><a data-toggle="tab" href="#menu1">New Company Email Notification</a></li>
	</ul>

	<div class="tab-content">
		<div id="home" class="tab-pane fade in active">
			<h3>New Employee Email Notification</h3>
			{{ Form::label('emp_email_subject', 'Email Subject') }}
			{{ Form::text('emp_email_subject', $email_employee->subject, ['class' => 'form-control']) }}
			{{ Form::label('emp_email_body', 'Email Body') }}
			{{ Form::textarea('emp_email_body', $email_employee->body, ['class' => 'form-control', 'id' => 'editor1']) }}
		</div>
		<div id="menu1" class="tab-pane fade">
			<h3>New Company Email Notification</h3>
			{{ Form::label('company_email_subject', 'Email Subject') }}
			{{ Form::text('company_email_subject', $email_company->subject, ['class' => 'form-control']) }}
			{{ Form::label('company_email_body', 'Email Body') }}
			{{ Form::textarea('company_email_body', $email_company->body, ['class' => 'form-control', 'id' => 'editor2']) }}
		</div>
	</div>
	<div>
		{{ Form::submit('Submit', ['class' => 'btn btn-success']) }}
	</div>
</div>
<script>
	CKEDITOR.replace( 'editor1' );
	CKEDITOR.replace( 'editor2' );
</script>

{{ Form::close() }}
@endsection
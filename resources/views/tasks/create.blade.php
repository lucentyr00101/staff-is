@extends('layouts.admin')

@section('content')
<link rel="stylesheet" href="{{ asset('css/timepicker.css') }}">
<link rel="stylesheet" href="{{ asset('css/createprofile.css') }}">
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="{{ asset('css/multiselect.css') }}">
@if ($errors->any())
<div class="alert alert-danger">
	<ul>
		@foreach ($errors->all() as $error)
		<li>{{ $error }}</li>
		@endforeach
	</ul>
</div>
@endif
{{Form::open(array('url' => url('tasks'), 'method' => 'post'))}}
<div class="row">
	<div>
		{{Form::label('work_type', 'Work Type')}}
		{{Form::select('work_type', ['Computer Jobs' => 'Computer Jobs', 'Driving Jobs' => 'Driving Jobs',  'Industrial Jobs' => 'Industrial Jobs',  'Management Jobs' => 'Management Jobs', 'Office Jobs' => 'Office Jobs', 'Sales Jobs' => 'Sales Jobs', 'Service Jobs' => 'Service Jobs', 'Teaching Jobs' => 'Teaching Jobs', 'Other' => 'Other'], null, ['class' => 'form-control', 'required', 'id' => 'work_type_selector'])}}
	</div>

	<div id="other_work_type_container" style="display: none;">
		{{Form::label('work_type_other', 'Other work type:')}}
		{{ Form::text('work_type_other', null, ['class' => 'form-control', 'id' => 'work_type_other']) }}
	</div>
	
	<div>
		{{ Form::label('work_location', 'Work Location') }}
		{{Form::text('work_location', null , ['placeholder' => 'Work Location', 'class' => 'form-control'])}}
	</div>
	<div>
		{{Form::label('extra_requirements', 'Extra Requirements')}}
		{{Form::textarea('extra_requirements', '', ['class' => 'form-control', 'placeholder' => 'Extra Requirements'])}}
	</div>
	<div>
		{{Form::label('employee_required', 'Employee Required')}}
		{{Form::text('employee_required', '', ['class' => 'form-control', 'placeholder' => 'Employee Required'])}}
	</div>
</div>
<div class="row">
	<h2 class="fs-title">Schedule <span class='note'>You can select multiple days that has the same time schedule, then add a new row for a day that has a different time schedule.</span> </h2>
	<table class="table table-striped table-responsive schedule-tbl">
		<thead>
			<tr>
				<th>Day <span style="color:Red;">*</span></th>
				<th>Time In <span style="color:Red;">*</span></th>
				<th>Time Out <span style="color:Red;">*</span></th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<tr class='schedule_row'>
				<input type="hidden" name='hidden_row[]' value='x' />
				<td>{{ Form::select('schedule_day1[]', ['Sunday' => 'Sunday', 'Monday' => 'Monday', 'Tuesday' => 'Tuesday', 'Wednesday' => 'Wednesday', 'Thursday' => 'Thursday', 'Friday' => 'Friday', 'Saturday' => 'Saturday'], null, ['class' => 'form-control multiselect-ui', 'multiple', 'required']) }}</td>
				<td>{{ Form::text('schedule_time_in1', null, ['class' => 'form-control schedule_time', 'required']) }}</td>
				<td>{{ Form::text('schedule_time_out1', null, ['class' => 'form-control schedule_time', 'required']) }}</td>
				<td><input type="button" value="-" class="theme-btn-dk btn pull-right rem-schedule" /></td>
				<td><input type="hidden" class='hidden_schedule_counter' value="1"></td>
			</tr>
		</tbody>
		<tfoot>
			<td colspan="4">
				<input type="button" value="+" class="theme-btn-lt btn pull-right add-schedule" />
			</td>
		</tfoot>
	</table>
</div>
<div class="row">
	{{ Form::submit('Submit', array('class' => 'submit action-button btn btn-success', 'name' => 'submit')) }}
</div>
{{Form::close()}}
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>
<script src="{{ asset('js/app.js') }}"></script>
<script src='{{ asset("js/multiselect.js") }}'></script>
<script src="{{ asset('js/timepicker.js') }}"></script>
<script src="{{ asset('js/workforces.js') }}"></script>
@endsection
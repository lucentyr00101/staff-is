@extends('layouts.admin')

@section('content')
<link rel="stylesheet" href="{{ asset('css/timesheet.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
<link rel="stylesheet" href="{{ asset('css/timepicker.css') }}">
{{ Form::open(['url' => url('/timesheets/store/employee_id=' . $employee->id . '&task_id=' . $task->id) , 'method' => 'post']) }}

@if(session()->get('user_type') == 'employee')
<div class="top-head">
	<div class='text-box-container'>
		{{ Form::label('id_number', 'ID Number: ') }}
		{{ Form::text('id_number', $employee->id_number, ['readonly', 'class' => 'form-control text-box']) }}
	</div>

	<div class='text-box-container'>
		{{ Form::label('name', 'Name') }}
		{{ Form::text('name', $employee->fullname, ['readonly', 'class' => 'form-control text-box']) }}
	</div>

	<div class='text-box-container'>
		{{ Form::label('mobile_number', 'Mobile Number') }}
		{{ Form::text('mobile_number', $employee->user->contact_number, ['readonly', 'class' => 'form-control text-box']) }}
	</div>

	<div class='text-box-container'>
		{{ Form::label('email', 'Email Address:') }}
		{{ Form::text('email', $employee->user->email, ['readonly', 'class' => 'form-control text-box']) }}
	</div>
</div>
@else
<div class="top-head">
	<div class='text-box-container'>
		{{ Form::label('id_number', 'ID Number: ') }}
		{{ Form::text('id_number', $employee->id_number, ['readonly', 'class' => 'form-control text-box']) }}
	</div>

	<div class='text-box-container'>
		{{ Form::label('name', 'Name') }}
		{{ Form::text('name', $employee->fullname, ['readonly', 'class' => 'form-control text-box']) }}
	</div>

	<div class='text-box-container'>
		{{ Form::label('mobile_number', 'Mobile Number') }}
		{{ Form::text('mobile_number', $employee->user->contact_number, ['readonly', 'class' => 'form-control text-box']) }}
	</div>

	<div class='text-box-container'>
		{{ Form::label('email', 'Email Address:') }}
		{{ Form::text('email', $employee->user->email, ['readonly', 'class' => 'form-control text-box']) }}
	</div>
</div>
@endif
<?php
$current_day = date('l');
foreach($task->task_schedule as $schedule){
	if($schedule->schedule_day == $current_day && $schedule->schedule_time_in == '08:00'){ ?>
	<input type="hidden" class='work_schedule_end_hidden' value="16:00">
	<?php }
}
?>
<div class="main">
	<table class="table table-responsive table-striped timesheet">
		<thead>
			<th>Date xtest</th>
			<th>Code</th>
			<th>Job Description</th>
			<th>Time In</th>	
			<th>Time Out</th>
			<th>Reg Time</th>
			<th>Overtime</th>
			<th>Remarks from Employee</th>
			<th>Remarks from Company</th>
			<th> </th>
		</thead>
		<tbody>
			@foreach($timesheet as $t)
			<tr>
				<td>{{ Form::text('date[]', $t->date, ['required', 'class' => 'form-control timesheet-datepicker']) }}</td>
				<td>{{ Form::text('code[]', $t->code, ['required', 'class' => 'form-control']) }}</td>
				<td>{{ Form::text('jd[]', $t->job_description, ['class' => 'form-control']) }}</td>
				<td>{{ Form::text('time_in[]', $t->time_in, ['required', 'class' => 'form-control timesheet-time-in']) }}</td>
				<td>{{ Form::text('time_out[]', $t->time_out, ['required', 'class' => 'form-control timesheet-time-out']) }}</td>
				<td>{{ Form::text('reg_time[]', $t->reg_time, ['required', 'readonly', 'class' => 'form-control reg_time', 'id' => 'reg_time']) }}</td>
				<td>{{ Form::text('overtime[]', $t->overtime, ['required', 'readonly', 'class' => 'form-control overtime', 'id' => 'overtime']) }}</td>

				@if(session()->get('user_type') == 'employee' || session()->get('user_type') == 'admin')
				<td>{{ Form::text('remarks_emp[]', $t->remarks_from_emp, ['required', 'class' => 'form-control']) }}</td>
				@else
				<td>{{ Form::text('remarks_emp[]', $t->remarks_from_emp, ['readonly', 'required', 'class' => 'form-control']) }}</td>
				@endif

				@if(session()->get('user_type') == 'employee')
					<td>{{ Form::text('remarks_company[]', $t->remarks_from_company, ['readonly', 'class' => 'form-control']) }}</td>
				@else
					<td>{{ Form::text('remarks_company[]', $t->remarks_from_company, ['required', 'class' => 'form-control']) }}</td> 
				@endif
				
				<td><input type='button' value='-' class='btn btn-danger delete-row'></td>
			</tr>
			@endforeach
		</tbody>
		@if(session()->get('user_type') == 'employee')
		<tfoot>
			<tr>
				<td colspan="99">
					<input id='add-row' type="button" class="btn-info btn pull-right" value='+'>
				</td>
			</tr>
		</tfoot>
		@endif
	</table>
</div>

<div>
	{{ Form::submit('Submit', ['class' => 'btn btn-success']) }}
</div>

<div class="pull-right">
	<div>
		<label for="">Total Reg Time</label>
		<input readonly type="text" value="" id='total-reg-time-txt' class='form-control'>
	</div>
	<div>
		<label for="">Total Overtime</label>
		<input readonly type="text" value='' id='total-overtime-txt' class='form-control'>
	</div>
</div>

{{ Form::close() }}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="{{ asset('js/timepicker.js') }}"></script>

<!-- moment.js cdn -->
<script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/moment.min.js'></script>
<script src="{{ asset('js/timesheet.js') }}"></script>

@endsection
@extends('layouts.admin')

@section('content')
<link rel="stylesheet" href="http://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
<script src='http://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js'></script>
<script>
	$(document).ready(function(){
		$('table#data-table').DataTable({
			responsive: true,
			pageLength: 5,
			lengthMenu: [[5,10, 20], [5,10, 20]],
		});
	});
</script>
@if(session()->get('user_type') == 'admin')
<div class="row">
	<div class=" well col-lg-12 toppad">
		<h1>Task Details</h1>
		<table class="table">
			<tbody>
				<tr class='clickable-row' data-href='{{ url("/company/".$workforces->company->id) }}'>
					<th>Company Name:</th>
				<td><a href="{{ url('/company/'.$workforces->company->id) }}">{{ $workforces->company->fullname }}</a></td>
				</tr>
				<tr>
					<th>ID:</th>
					<td>{{$workforces->id}}</td>
				</tr>
				<tr>
					<th>Work Type:</th>
					<td>{{$workforces->work_type}}</td>
				</tr>
				<tr>
					<th>Work Location:</th>
					<td>{{$workforces->work_location}}</td>
				</tr>
				<tr>
					<th>Extra Requirements:</th>
					<td>{{$workforces->extra_requirements}}</td>
				</tr>
				<tr>
					<th>Employee Required:</th>
					<td>{{$workforces->employee_required}}</td>
				</tr>
				<tr>
					<th>Status:</th>
					<td>{{$workforces->status}}</td>
				</tr>
			</tbody>
		</table>
		<div>
			<a class="btn btn-small btn-info" href="{{ URL::to('tasks/' . $workforces->id . '/edit') }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
			{{ Form::open(array('url' => url('tasks/' . $workforces->id), 'style' => 'display:inline-block;')) }}
			{{ Form::hidden('_method', 'DELETE') }}
			{{ Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i>', ['type' => 'submit', 'class' => 'btn btn-danger'] )  }}
			{{ Form::close() }}
		</div>
	</div>
</div>
<div class="row ">
	<div class="col-md-12">
		<table class="table">
			<h2 style="border-bottom:2px solid #a9a9a9">Task Schedule</h2>
			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th>Day/s</th>
						<th>Time In</th>
						<th>Time Out</th>
					</tr>
				</thead>
				<tbody>

					@if(!empty($workforces->result))
					@foreach($workforces->result as $result_item)
					<tr>
						<td>{{ $result_item[0]['days'] }}</td>
						<td>{{ $result_item[0]['time_in'] }}</td>
						<td>{{ $result_item[0]['time_out'] }}</td>
					</tr>
					@endforeach
					@endif

				</tbody>
			</table>
		</table>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="row" style="margin-bottom:50px;">
			<h1>Assigned Employees</h1>
			<table id="data-table" class="display" cellspacing='0' width="100%">
				<thead>
					<tr>
						<th>ID</th>
						<th>Full Name</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach($accepted as $list)
					<tr>
						<td>{{$list->employee->id}}</td>
						<td>{{$list->employee->fullname}}</td>
						<td>
							<a href="{{ URL::to('employee/' . $list->employee->id) }}" class="btn btn-info"><span class="fa fa-eye"></span><span> View Profile</span></a>
							<a href="{{ URL::to('/timesheets/edit/employee_id=' . $list->employee->id . '&task_id=' . $list->workforce_id) }}" class="btn btn-primary"><span class="fa fa-file-text"> View Timesheet</span></a>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
		<div class="row">
			<h1>Available Employees for Invitation</h1>
			<table id='data-table' class='display' cellspacing="0" width="100%">
				<thead>
					<tr>
						<th>ID</th>
						<th>Full Name</th>
						<th>Age</th>
						<th>Gender</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach($employees as $employee)
					<tr class='clickable-row' data-href="{{ URL::to('employee/' . $employee->id)}}">
						<td>{{$employee->id}}</td>
						<td>{{$employee->fullname}}</td>
						<td>{{$employee->age}}</td>
						<td>{{$employee->gender}}</td>
						<td><a href="{{ url('/invite/task=' . $workforces->id . '&employee=' . $employee->id) }}" class="btn btn-success">Send Invite</a></td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>
@elseif(session()->get('user_type') == 'company')
<div class="row">
	<div class="col-lg-12 well">
		<h1>Task Details</h1>
		<table class="table">
			<tbody>
				<tr class='clickable-row' data-href='{{ url("/company/".$workforces->company->id) }}'>
					<th>Company Name:</th>
				<td><a href="{{ url('/company/'.$workforces->company->id) }}">{{ $workforces->company->fullname }}</a></td>
				</tr>
				<tr>
					<th>ID:</th>
					<td>{{$workforces->id}}</td>
				</tr>
				<tr>
					<th>Work Type:</th>
					<td>{{$workforces->work_type}}</td>
				</tr>
				<tr>
					<th>Work Location:</th>
					<td>{{$workforces->work_location}}</td>
				</tr>
				<tr>
					<th>Extra Requirements:</th>
					<td>{{$workforces->extra_requirements}}</td>
				</tr>
				<tr>
					<th>Employee Required:</th>
					<td>{{$workforces->employee_required}}</td>
				</tr>
				<tr>
					<th>Status:</th>
					<td>{{$workforces->status}}</td>
				</tr>
			</tbody>
		</table>
		
		<div>
			<a class="btn btn-small btn-info" href="{{ URL::to('tasks/' . $workforces->id . '/edit') }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
			{{ Form::open(array('url' => url('tasks/' . $workforces->id), 'style' => 'display:inline-block;')) }}
			{{ Form::hidden('_method', 'DELETE') }}
			{{ Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i>', ['type' => 'submit', 'class' => 'btn btn-danger'] )  }}
			{{ Form::close() }}
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<table class="table">
			<h2 style="border-bottom:2px solid #a9a9a9">Task Schedule</h2>
			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th>Date</th>
						<th>Time In</th>
						<th>Time Out</th>
					</tr>
				</thead>
				<tbody>

					@if(!empty($workforces->result))
					@foreach($workforces->result as $result_item)
					<tr>
						<td>{{ $result_item[0]['date'] }}</td>
						<td>{{ $result_item[0]['time_in'] }}</td>
						<td>{{ $result_item[0]['time_out'] }}</td>
					</tr>
					@endforeach
					@endif

				</tbody>
			</table>
		</table>
	</div>
</div>
<div class="col-md-12">
	<div class="row" style="margin-bottom:50px;">
		<h1>Assigned Employees</h1>
		<table id="data-table" class="display" cellspacing='0' width="100%">
			<thead>
				<tr>
					<th>ID</th>
					<th>Full Name</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				@foreach($accepted as $list)
				<tr>
					<td>{{$list->employee->id}}</td>
					<td>{{$list->employee->fullname}}</td>
					<td>
						<a href="{{ URL::to('employee/' . $list->employee->id) }}" class="btn btn-info"><i class="fa fa-eye"></i><span> View Profile</span></a>
						<a href="{{ URL::to('/timesheets/edit/employee_id=' . $list->employee->id . '&task_id=' . $list->workforce_id) }}" class="btn btn-primary"><span class="fa fa-file-text"> View Timesheet</span></a>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>

@else <!-- user_type == 'employee' -->
<div class="row">
	<div class="col-md-12 well">
		<h1>Task Details</h1>
		<table class="table">
			<tbody>
				<tr class='clickable-row' data-href='{{ url("/company/".$workforces->company->id) }}'>
					<th>Company Name:</th>
					<td><a href="{{ url('/company/'.$workforces->company->id) }}">{{ $workforces->company->fullname }}</a></td>
				</tr>
				<tr>
					<th>ID:</th>
					<td>{{$workforces->id}}</td>
				</tr>
				<tr>
					<th>Work Type:</th>
					<td>{{$workforces->work_type}}</td>
				</tr>
				<tr>
					<th>Work Location:</th>
					<td>{{$workforces->work_location}}</td>
				</tr>
				<tr>
					<th>Extra Requirements:</th>
					<td>{{$workforces->extra_requirements}}</td>
				</tr>
				<tr>
					<th>Employee Required:</th>
					<td>{{$workforces->employee_required}}</td>
				</tr>
				<tr>
					<th>Status:</th>
					<td>{{$workforces->status}}</td>
				</tr>
			</tbody>
		</table>
		<h1>Task Schedule</h1>
		<table class="table">
			<thead>
				<th>Date</th>
				<th>Time In</th>
				<th>Time Out</th>
			</thead>
			<tbody>
				@if(!empty($workforces->result))
					@foreach($workforces->result as $result_item)
					<tr>
						<td>{{ $result_item[0]['date'] }}</td>
						<td>{{ $result_item[0]['time_in'] }}</td>
						<td>{{ $result_item[0]['time_out'] }}</td>
					</tr>
					@endforeach
				@endif
			</tbody>
		</table>
	</div>
</div>
<a href="{{ url('/employee/accept/task=' . $workforces->id . '&employee=' . session()->get('employee_id')) }}" class='btn btn-success'>Accept</a>

<a href="{{ url('/employee/reject/task=' . $workforces->id . '&employee=' . session()->get('employee_id')) }}" class='btn btn-danger'>Reject</a>
@endif

@endsection
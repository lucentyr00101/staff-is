@extends('layouts.admin')

@section('content')
<link rel="stylesheet" href="http://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="{{ asset('css/multiselect.css') }}">
<link rel="stylesheet" href="{{ asset('css/timepicker.css') }}">
<script src='http://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js'></script>
<script>
	$(document).ready(function(){
		$('table#data-table').DataTable({
			responsive: true,
			pageLength: 5,
			lengthMenu: [[5,10, 25, 50, -1], [5,10, 25, 50, "All"]],
			aaSorting: [],
		});
	});
</script>
<!-- Button trigger modal -->
<div class="col-md-3 pull-right">
	<div class="col-md-12">
		<button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#adv-s-modal">
			Advanced Search ...
		</button>
	</div>
	<div class="col-md-12">
		<button type="button" class="btn btn-xs btn-warning pull-right"><a href="{{ url('/tasks/employee/'.$employee->id.'/task-invitations') }}" style="color: #000;">Clear filters...</a></button>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="adv-s-modal" role="dialog" aria-labelledby="adv-s-modal-label" aria-hidden="true">
	{{ Form::open(['url' => '/search/tasks/accepted', 'method' => 'get']) }}
	<div class="modal-dialog modal-md centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title" style="display:inline-block;">Search...</h3>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<!-- Company Related -->
				<div class="row">
					<div class="col-md-12">
						<label for="">Company Name: </label>
						<input class="form-control" type="text" name='search_company_name'>
					</div>
					<div class="col-md-12">
						<label for="">Contact Person: </label>
						<input class="form-control" type="text" name='search_contact_person'>
					</div>
					<div class="col-md-12">
						<label for="">Department: </label>
						<input class="form-control" type="text" name='search_department'>
					</div>
					<div class="col-md-12">
						<label for="">ID Number: </label>
						<input class="form-control" type="text" name='search_id_number'>
					</div>
					<div class="col-md-12">
						<label for="">Company Address: </label>
						<input class="form-control" type="text" name='search_company_address'>
					</div>
					<div class="col-md-12">
						<label for="">Company Country: </label>
						<input class="form-control" type="text" name='search_company_country'>
					</div>
					<div class="col-md-12">
						<label for="">Company State: </label>
						<input class="form-control" type="text" name='search_company_state'>
					</div>
					<div class="col-md-12">
						<label for="">Company Zip Code: </label>
						<input class="form-control" type="text" name='search_company_zip_code'>
					</div>
					<div class="col-md-12">
						<label for="">Branch Address: </label>
						<input class="form-control" type="text" name='search_branch_address'>
					</div>
					<div class="col-md-12">
						<label for="">Branch Country: </label>
						<input class="form-control" type="text" name='search_branch_country'>
					</div>
					<div class="col-md-12">
						<label for="">Branch Zip Code: </label>
						<input class="form-control" type="text" name='search_branch_zip_code'>
					</div>
					<div class="col-md-12">
						<label for="">Working Location: </label>
						<input class="form-control" type="text" name='search_work_location'>
					</div>
					<div class="col-md-12">
						<label for="">Telephone Number: </label>
						<input class="form-control" type="text" name='search_telephone_number'>
					</div>
				</div>
				<!-- Task Related -->
				<div class="row">
					<div class="col-md-12">
						<label for="">Work Type: </label>
						<input class="form-control" type="text" name='search_work_type' placeholder="Any Work Type">
					</div>
					<div class="col-md-12">
						<label for="">Work Location: </label>
						<input class="form-control" type="text" name='search_work_location' placeholder="Any Location">
					</div>
					<div class="col-md-12">
						<label for="">Extra Requirements: </label>
						<input class="form-control" type="text" name='search_extra_requirements' placeholder="Any Requirements">
					</div>
					<div class="col-md-12">
						<label for="">Employee Required: </label>
						<input class="form-control" type="text" name='search_employee_required' placeholder="Any">
					</div>
					<div class="col-md-12">
						<label for="">Status: </label>
						<select class="form-control" name="search_status" id="">
							<option value="In Progress">In Progress</option>
							<option value="Completed">Completed</option>
						</select>
					</div>
					<div class="col-md-4">
						<label for="">Schedule: </label>
						{{ Form::select('search_schedule_day[]', ['Sunday' => 'Sunday', 'Monday' => 'Monday', 'Tuesday' => 'Tuesday', 'Wednesday' => 'Wednesday', 'Thursday' => 'Thursday', 'Friday' => 'Friday', 'Saturday' => 'Saturday'], null, ['class' => 'form-control multiselect-ui', 'multiple']) }}
					</div>
					<div class="col-md-4">
						<label for="">Time In: </label>
						<input class="form-control search_time_in" type="text" name='search_time_in' placeholder="Any">
					</div>
					<div class="col-md-4">
						<label for="">Time Out: </label>
						<input class="form-control search_time_out" type="text" name='search_time_out' placeholder="Any">
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-primary" id='search-submit'>Search</button>
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
	{{ Form::close() }}
</div>
<!-- Modal end -->
<div>
	<h1>Accepted Invitations</h1>
	<table class="table table-striped table-hover"  id="data-table">
		<thead>
			<tr>
				<th>Company Name</th>
				<th>Company Code</th>
				<th>Type of Work</th>
				<th>Extra Requirements</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			@foreach($accepted_tasks as $task)
			<tr>
				<td>{{$task->workforce->company->fullname}}</td>
				<td>{{$task->workforce->company->id}}</td>
				<td>{{$task->workforce->work_type}}</td>
				<td>{{$task->workforce->extra_requirements}}</td>
				<td><a href="{{ url('/timesheets/edit/employee_id='.session()->get('employee_id').'&task_id='.$task->workforce->id) }}" class="btn btn-info"><span class="fa fa-file"></span> Timesheet</a></td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>
<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'></script>
<script src='{{ asset("js/multiselect.js") }}'></script>
<script src="{{ asset('js/timepicker.js') }}"></script>
<script>
	$(document).ready(function() {
		$('.multiselect-ui').multiselect();
		$('.search_time_in, .search_time_out').timepicker({
			'timeFormat': 'H:i',
			'step': 15,
		});

		$('span.multiselect-native-select div.btn-group').addClass('col-md-12');
	});
</script>
@endsection
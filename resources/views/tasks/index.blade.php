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

@if(session()->get('user_type') == 'admin')
<!-- Button trigger modal -->
<div class="col-md-3 pull-right">
	<div class="col-md-12">
		<button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#adv-s-modal">
			Advanced Search ...
		</button>
	</div>
	<div class="col-md-12">
		<button type="button" class="btn btn-xs btn-warning pull-right"><a href="{{ url('/tasks') }}" style="color: #000;">Clear filters...</a></button>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="adv-s-modal" role="dialog" aria-labelledby="adv-s-modal-label" aria-hidden="true">
	{{ Form::open(['url' => url("/search/tasks"), 'method' => 'get']) }}
	<div class="modal-dialog modal-md centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title" style="display:inline-block;">Search...</h3>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
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
	<h1>All Tasks</h1>
	<table class="table table-striped table-bordered text-center" id='data-table'>
		<thead>
			<tr>
				<th>ID</th>
				<th>Work Type</th>
				<th>Work Location</th>
				<th>Extra Requirements</th>
				<th>Employee Required</th>
				<th>Status</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			@foreach($workforces as $a)
			<tr>
				<td>{{ $a->id }}</td>
				<td>{{ $a->work_type }}</td>
				<td>{{ $a->work_location }}</td>
				<td>{{ $a->extra_requirements }}</td>
				<td>{{ $a->employee_required }}</td>
				<td>{{ $a->status }}</td>

				<!-- we will also add show, edit, and delete buttons -->
				<td>

					<!-- delete the tasks (uses the destroy method DESTROY /tasks/{id} -->
					<!-- we will add this later since its a little more complicated than the other two buttons -->
					{{ Form::open(array('url' => url('tasks/' . $a->id))) }}
					{{ Form::hidden('_method', 'DELETE') }}
					{{ Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i>', ['type' => 'submit', 'class' => 'btn btn-danger'] )  }}

					{{ Form::close() }}
					<!-- show (uses the show method found at GET /tasks/{id} -->
					<a class="btn btn-small btn-success" href="{{ URL::to('tasks/' . $a->id) }}"><i class="fa fa-eye" aria-hidden="true"></i></a>

					<!-- edit (uses the edit method found at GET /tasks/{id}/edit -->
					<a class="btn btn-small btn-info" href="{{ URL::to('tasks/' . $a->id . '/edit') }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>
@elseif(session()->get('user_type') == 'company')
<div>
	<h1>All Tasks</h1>
	<table class="table table-striped table-bordered text-center" id='data-table'>
		<thead>
			<tr>
				<th>ID</th>
				<th>Work Type</th>
				<th>Work Location</th>
				<th>Extra Requirements</th>
				<th>Employee Required</th>
				<th>Status</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			@foreach($workforces as $a)
			<tr>
				<td>{{ $a->id }}</td>
				<td>{{ $a->work_type }}</td>
				<td>{{ $a->work_location }}</td>
				<td>{{ $a->extra_requirements }}</td>
				<td>{{ $a->employee_required }}</td>
				<td>{{ $a->status }}</td>

				<!-- we will also add show, edit, and delete buttons -->
				<td>

					<!-- delete the tasks (uses the destroy method DESTROY /tasks/{id} -->
					<!-- we will add this later since its a little more complicated than the other two buttons -->
					{{ Form::open(array('url' => url('tasks/' . $a->id))) }}
					{{ Form::hidden('_method', 'DELETE') }}
					{{ Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i>', ['type' => 'submit', 'class' => 'btn btn-danger'] )  }}

					{{ Form::close() }}
					<!-- show (uses the show method found at GET /tasks/{id} -->
					<a class="btn btn-small btn-success" href="{{ URL::to('tasks/' . $a->id) }}"><i class="fa fa-eye" aria-hidden="true"></i></a>

					<!-- edit (uses the edit method found at GET /tasks/{id}/edit -->
					<a class="btn btn-small btn-info" href="{{ URL::to('tasks/' . $a->id . '/edit') }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>
@endif
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
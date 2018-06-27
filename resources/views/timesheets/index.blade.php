@extends('layouts.admin')

@section('content')
<table class="table table-striped table-bordered text-center">
	<thead>
		<tr>
			<th>ID</th>
			<th>Employee ID</th>
			<th>Workforce ID</th>
			<th>Date Available</th>
			<th>Work Hours</th>
		</tr>
	</thead>
	<tbody>
		@foreach($timesheets as $key => $value)
		<tr>
			<td>{{ $value->id }}</td>
			<td>{{ $value->employee_id }}</td>
			<td>{{ $value->workforce_id }}</td>
			<td>{{ $value->date_available }}</td>
			<td>{{ $value->work_hours }}</td>

			<!-- we will also add show, edit, and delete buttons -->
			<td>

				<!-- delete the timesheets (uses the destroy method DESTROY /timesheets/{id} -->
				<!-- we will add this later since its a little more complicated than the other two buttons -->
				{{ Form::open(array('url' => url('timesheets/' . $value->id), 'style' => 'display:inline-block;')) }}
				{{ Form::hidden('_method', 'DELETE') }}
				{{ Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i>', ['type' => 'submit', 'class' => 'btn btn-danger'] )  }}

				{{ Form::close() }}
				<!-- show (uses the show method found at GET /timesheets/{id} -->
				<a class="btn btn-small btn-success" href="{{ URL::to('timesheets/' . $value->id) }}"><i class="fa fa-eye" aria-hidden="true"></i></a>

				<!-- edit (uses the edit method found at GET /timesheets/{id}/edit -->
				<a class="btn btn-small btn-info" href="{{ URL::to('timesheets/' . $value->id . '/edit') }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
			</td>
		</tr>
		@endforeach
	</tbody>
</table>
@endsection
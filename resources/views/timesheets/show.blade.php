@extends('layouts.admin')

@section('content')

<div class="row">
	<div class="col-lg-12 toppad" >
		
		<div class="row">
			<div class=" col-md-9 col-lg-9 "> 
				<table class="table">
					<tbody>
						<tr>
							<th>ID:</th>
							<td>{{ $timesheet->id }}</td>
						</tr>
						<tr>
							<th>Employee ID:</th>
							<td>{{ $timesheet->employee_id }}</td>
						</tr>
						<tr>
							<th>Workforce ID:</th>
							<td>{{ $timesheet->workforce_id }}</td>
						</tr>
						<tr>
							<th>Date Available:</th>
							<td>{{ $timesheet->date_available }}</td>
						</tr>
					</tbody>
				</table>
			</div>
			<div>
				<a class="btn btn-small btn-info" href="{{ URL::to('timesheets/' . $timesheet->id . '/edit') }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
				{{ Form::open(array('url' => url('timesheets/' . $timesheet->id), 'style' => 'display:inline-block;')) }}
				{{ Form::hidden('_method', 'DELETE') }}
				{{ Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i>', ['type' => 'submit', 'class' => 'btn btn-danger'] )  }}
			</div>
		</div>
	</div>
</div>


@endsection
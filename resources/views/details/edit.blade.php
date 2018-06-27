@extends('layouts.admin')

@section('content')
{!! Form::open(['method' => 'put', 'id' => 'msform', 'url' => 'details/'.$employee->id]) !!}
<div class="row">
	<div class="col-lg-12 toppad" >
		<div class="row">
			<div class="col-md-3 col-lg-3 " align="center"> <img width='200' height='200' alt="User Pic" src="https://static1.squarespace.com/static/562fb847e4b046e5c5d56b5c/t/5922934659cc68282fc56d1e/1446118163559/" class="img-circle img-responsive">
				<h3>{{$employee->fullname}}</h3>
			</div>
			<div class=" col-md-9 col-lg-9 "> 
				<table class="table">
					<h2 style="border-bottom:2px solid #a9a9a9;">Background Details</h2>
					<tbody>
						<tr>
							<th>Job Title:</th>
							<td>{{Form::text('job_title', $employee->job_title , ['placeholder' => 'Job Title', 'class' => 'form-control'])}}</td>
						</tr>
						<tr>
							<th>Job Description:</th>
							<td>{{Form::text('job_description', $employee->job_description , ['placeholder' => 'Job Description', 'class' => 'form-control'])}}</td>
						</tr>
						<tr>
							<th>Job Duration:</th>
							<td>{{Form::text('job_duration', $employee->job_duration , ['placeholder' => 'Job Duration', 'class' => 'form-control'])}}</td>
						</tr>
						<tr>
							<th>Company:</th>
							<td>{{Form::text('company', $employee->company , ['placeholder' => 'Company', 'class' => 'form-control'])}}</td>
						</tr>
						<tr>
							<th>Salary:</th>
							<td>{{Form::text('salary', $employee->salary , ['placeholder' => 'Salary', 'class' => 'form-control'])}}</td>
						</tr>
						<tr>
							<th>Location:</th>
							<td>{{Form::text('location', $employee->location , ['placeholder' => 'Location', 'class' => 'form-control'])}}</td>
						</tr>
						<tr>
							<th>Health Problems:</th>
							<td>{{Form::text('health_problem', $employee->health_problem , ['placeholder' => 'Job Title', 'class' => 'form-control'])}}</td>
						</tr>
					</tbody>
				</table>
				<table class="table">
					<h2 style="border-bottom:2px solid #a9a9a9;">Education History</h2>
					<tbody>
						<tr>
							<th>School Name:</th>
							<td>{{Form::text('school_name', $employee->school_name , ['placeholder' => 'Job Title', 'class' => 'form-control'])}}</td>
						</tr>
						<tr>
							<th>Highest Degree Attained:</th>
							<td>{{Form::text('highest_degree_attained', $employee->highest_degree_attained , ['placeholder' => 'Job Title', 'class' => 'form-control'])}}</td>
						</tr>
						<tr>
							<th>Year Graduated:</th>
							<td>{{Form::text('year_graduated', $employee->year_graduated , ['placeholder' => 'Job Title', 'class' => 'form-control'])}}</td>
						</tr>
						<tr>
							<th>GPA:</th>
							<td>{{Form::text('gpa', $employee->gpa , ['placeholder' => 'Job Title', 'class' => 'form-control'])}}</td>
						</tr>
					</tbody>
				</table>
				
				<div>
					<a class="btn btn-small btn-info" href="{{ URL::to('details/' . $employee->id . '/edit') }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
					{{ Form::open(array('url' => 'details/' . $employee->id, 'style' => 'display:inline-block;')) }}
					{{ Form::hidden('_method', 'DELETE') }}
					{{ Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i>', ['type' => 'submit', 'class' => 'btn btn-danger'] )  }}
				</div>
			</div>
		</div>
	</div>
</div>
{!! Form::close() !!}
@endsection
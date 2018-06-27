	@extends('layouts.admin')

@section('content')

<div class="row">
	<div class="col-lg-12 toppad" >
		<div class="row">
			<div class="col-md-3 col-lg-3 " align="center"> <img width='200' height='200' alt="User Pic" src="https://static1.squarespace.com/static/562fb847e4b046e5c5d56b5c/t/5922934659cc68282fc56d1e/1446118163559/" class="img-circle img-responsive">
				<h3>{{$employee->fullname}}</h3>
			</div>
			<div class=" col-md-9 col-lg-9 "> 
				<table class="table">
					<h2 style="border-bottom:2px solid #a9a9a9;">Basic Details</h2>
					<tbody>
						<tr>
							<th>Age:</th>
							<td>{{$employee->age}}</td>
						</tr>
						<tr>
							<th>Gender:</th>
							<td>{{$employee->gender}}</td>
						</tr>
						<tr>
							<th>Civil Status:</th>
							<td>{{$employee->civil_status}}</td>
						</tr>
						<tr>
							<th>Number of Children:</th>
							<td>{{$employee->number_of_children}}</td>
						</tr>
						<tr>
							<th>Nationality:</th>
							<td>{{$employee->nationality}}</td>
						</tr>
						@if($employee->hasDriverLicense == 1)
						<tr>
							<th>Has Driver's License:</th>
							<td>Yes</td>
						</tr>
						@if($employee->hasCar == 1)
						<tr>
							<th>Has Car:</th>
							<td>Yes</td>
						</tr>
						@else
						<tr>
							<th>Has Car:</th>
							<td>No</td>
						</tr>
						@endif
						@else
						<tr>
							<th>Has Driver's License:</th>
							<td>No</td>
						</tr>
						@endif
						<tr>
							<th>Address</th>
							<td>{{$employee->address}}</td>
						</tr>
						<tr>
							<th>E-Mail Address</th>
							<td>{{$employee->email_confirmation}}</td>
						</tr>
						<tr>
							<th>Emergency Contact Number:</th>
							<td>{{$employee->emergency_contact_number}}</td>
						</tr>
					</tbody>
				</table>
				<table class="table">
					<h2 style="border-bottom:2px solid #a9a9a9;">Language</h2>
					<tbody>
						<tr>
							<th>Language</th>
							<th>Proficiency</th>
						</tr>
						@foreach($languages as $language)
						<tr>
							<td>{{$language->language}}</td>
							<td>{{$language->proficiency}}</td>
						</tr>
						@endforeach
					</tbody>
				</table>
				<div>
					<a class="btn btn-small btn-info" href="{{ URL::to('employee/' . $employee->id . '/edit') }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
					{{ Form::open(array('url' => 'employee/' . $employee->id, 'style' => 'display:inline-block;')) }}
					{{ Form::hidden('_method', 'DELETE') }}
					{{ Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i>', ['type' => 'submit', 'class' => 'btn btn-danger'] )  }}
				</div>
				
				<table class="table">
					<h2 style="border-bottom:2px solid #a9a9a9;">Background Details</h2>
					<tbody>
						<tr>
							<th>Job Title:</th>
							<td>{{$employee->job_title}}</td>
						</tr>
						<tr>
							<th>Job Description:</th>
							<td>{{$employee->job_description}}</td>
						</tr>
						<tr>
							<th>Job Duration:</th>
							<td>{{$employee->job_duration}}</td>
						</tr>
						<tr>
							<th>Company:</th>
							<td>{{$employee->company}}</td>
						</tr>
						<tr>
							<th>Salary:</th>
							<td>{{$employee->salary}}</td>
						</tr>
						<tr>
							<th>Location:</th>
							<td>{{$employee->location}}</td>
						</tr>
						<tr>
							<th>Health Problems:</th>
							<td>{{$employee->health_problem}}</td>
						</tr>
					</tbody>
				</table>
				<table class="table">
					<h2 style="border-bottom:2px solid #a9a9a9;">Education History</h2>
					<tbody>
						<tr>
							<th>School Name:</th>
							<td>{{$employee->school_name}}</td>
						</tr>
						<tr>
							<th>Highest Degree Attained:</th>
							<td>{{$employee->highest_degree_attained}}</td>
						</tr>
						<tr>
							<th>Year Graduated:</th>
							<td>{{$employee->year_graduated}}</td>
						</tr>
						<tr>
							<th>GPA:</th>
							<td>{{$employee->gpa}}</td>
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
@endsection
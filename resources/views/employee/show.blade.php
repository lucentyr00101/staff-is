<!-- if user is not admin --> 
@if(Auth::user()->user_type != 'admin') 
<!-- if user type is employee -->
@if(Auth::user()->user_type == 'employee')
<!-- if logged in employee doesn't have the same id with the employee on view -->
@if(Auth::user()->employee->id != $employee->id)
<script type="text/javascript">
	window.location = "{{ url('/404') }}";
</script>
@endif
@endif
@endif
@extends('layouts.admin')

@section('content')
<?php
if($employee->profile_image_filepath != null){
	$path = decrypt($employee->profile_image_filepath);
	$dp = basename($path);
} else {
	$dp = null;
}
?>
<div class="row">
	<div class="col-lg-12 toppad" >
		<div class="row">
			@if($dp == null)
			<div class="col-md-3 col-lg-3 profile-pic" align="center">
				<img width='200' height='200' alt="User Pic" src="https://static1.squarespace.com/static/562fb847e4b046e5c5d56b5c/t/5922934659cc68282fc56d1e/1446118163559/" class="img-circle img-responsive">
				<h3>{{$employee->fullname}}</h3>
			</div>
			@else
			<div class="col-md-3 col-lg-3 profile-pic" align="center">
				<img width='200' height='200' alt="User Pic" src="<?php echo asset("storage/profile_pictures") . '/' . $dp; ?>" class="img-circle img-responsive">
				<h3>{{$employee->fullname}}</h3>
			</div>
			@endif
			<div class=" col-md-9 col-lg-9 "> 
				<table class="table">
					<h2 style="border-bottom:2px solid #a9a9a9;">Basic Details</h2>
					<tbody>
						<tr>
							<th>ID Number:</th>
							<td>{{$employee->id_number}}</td>
						</tr>
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
						@if($employee->clean_criminal_record == 1)
						<tr>
							<th>Clean Criminal Record</th>
							<td>Yes</td>
						</tr>
						@else 
						<tr>
							<th>Clean Criminal Record</th>
							<td>No</td>
						</tr>
						@endif
						@if($employee->smoking == 1)
						<tr>
							<th>Smoking</th>
							<td>Yes</td>
						</tr>
						@else
						<tr>
							<th>Smoking</th>
							<td>No</td>
						</tr>
						@endif
						@if($employee->hasDriverLicense == 1)
						<tr>
							<th>Has Driver's License:</th>
							<td>Yes</td>
						</tr>
						<tr>
							<th>Type of Driver's License:</th>
							<td>{{$employee->type_of_license}}</td>
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
							<td>{{$employee->address}}, {{$employee->zip_code}}, {{$employee->state}}, {{$employee->country}} </td>
						</tr>
						<tr>
							<th>Summary:</th>
							<td>{{$employee->summary}}</td>
						</tr>
						<tr>
							<th>Health Problem/s: </th>
							<tr>
								<td>{{$employee->health_problem->health_problem}}</td>
							</tr>
						</tr>
					</tbody>
				</table>

				<table class="table">
					<h2 style="border-bottom:2px solid #a9a9a9;">Contact Details</h2>
					<tbody>
						<tr>
							<th>E-Mail Address</th>
							<td>{{$employee->email_confirmation}}</td>
						</tr>
						<tr>
							<th>Mobile Number: </th>
							<td>{{ $employee->user->contact_number }}</td>
						</tr>
						<tr>
							<th>Telephone Number: </th>
							<td>{{ $employee->telephone }}</td>
						</tr>
						<tr>
							<th>Emergency Contact Name:</th>
							<td>{{$employee->emergency_contact_name}}</td>
						</tr>
						<tr>
							<th>Emergency Contact Number:</th>
							<td>{{$employee->emergency_contact_number}}</td>
						</tr>
					</tbody>
				</table>

				<table class="table language">
					<h2 style="border-bottom:2px solid #a9a9a9;">Banking Information</h2>
					<tbody>
						<tr>
							<th>Account Number</th>
							<td>{{$employee->account_number}}</td>
						</tr>
					</tbody>
				</table>

				<table class="table language">
					<h2 style="border-bottom:2px solid #a9a9a9;">Language</h2>
					<tbody>
						<tr>
							<th>Language</th>
							<th>Proficiency</th>
						</tr>
						@foreach($employee->employeelanguage as $language)
						<tr>
							<td>{{$language->language}}</td>
							<td>{{$language->proficiency}}</td>
						</tr>
						@endforeach
					</tbody>
				</table>
				<table class="table">
					<h2 style="border-bottom:2px solid #a9a9a9;">Employment History</h2>
					<tbody>
						<tr>
							<th>Job Title</th>
							<th>Job Description</th>
							<th>Job Duration</th>
							<th>Company</th>
						</tr>
						@foreach($employee->employment_history as $exp)
						<tr>
							<td>{{$exp->job_title}}</td>
							<td>{{$exp->job_description}}</td>
							<td>{{$exp->job_duration}}</td>
							<td>{{$exp->company}}</td>
						</tr>
						@endforeach
					</tbody>		
				</table>
				<table class="table">
					<h2 style="border-bottom:2px solid #a9a9a9;">Preferable Work Location/s and Schedule of Work</h2>
					<tbody>
						<tr>
							<th>Location</th>
						</tr>
						@foreach($employee->preferable_work as $location)
						<tr>
							<td>{{$location->location}}</td>
						</tr>
						@endforeach
						<tr>
							<th>Schedule of Work</th>
							<td>{{$employee->schedule_of_work}}</td>
						</tr>
						<tr>
							<th>Shift Schedule</th>
							<td>{{$employee->shift}}</td>
						</tr>
					</tbody>
				</table>

				<table class="table">
					<h2 style="border-bottom:2px solid #a9a9a9;">Education History</h2>
					<tbody>
						<tr>
							<th>School Name:</th>
							<th>Course/Degree:</th>
							<th>Highest Degree Attained</th>
							<th>Year Graduated</th>
						</tr>
						@foreach($employee->education_history as $educ)
						<tr>
							<td>{{$educ->school_name}}</td>
							<td>{{$educ->degree}}</td>
							<td>{{$educ->highest_degree_attained}}</td>
							<td>{{$educ->year_graduated}}</td>
						</tr>
						@endforeach
					</tbody>		
				</table>

				<table class="table">
					<h2 style="border-bottom:2px solid #a9a9a9;">Resume / Certificates</h2>
					<tbody>
						<tr>
							<th>File:</th>
							<th>Type:</th>
						</tr>
						@foreach($employee->cv as $cv)
						<tr>
							<?php
							$filepath = decrypt($cv->file_name);
							$filename = basename($filepath);
							?>
							<td><a href="{{ url('/download/'.$cv->file_name) }}"><i class="fa fa-download" aria-hidden="true"></i> {{ $filename }}</a></td>
							<td>{{ $cv->file_type }}</td>
						</tr>
						@endforeach
					</tbody>
				</table>

				<div>
					@if(session()->get('user_type') == 'admin' || session()->get('user_type') == 'employee')
					<a class="btn btn-small btn-info" href="{{ URL::to('employee/' . $employee->id . '/edit') }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
					@endif

					@if(session()->get('user_type') == 'admin')
					{{ Form::open(array('url' => url('employee/' . $employee->id), 'style' => 'display:inline-block;')) }}
					{{ Form::hidden('_method', 'DELETE') }}
					{{ Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i>', ['type' => 'submit', 'class' => 'btn btn-danger'] )  }}
					{{Form::close()}}
					@endif

				</div>
			</div>
		</div>
	</div>
</div>


@endsection
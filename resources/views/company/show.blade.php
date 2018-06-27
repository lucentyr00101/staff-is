<!-- if user is not admin --> 
@if(Auth::user()->user_type != 'admin') 
<!-- if user type is company -->
@if(Auth::user()->user_type == 'company')
<!-- if logged in company doesn't have the same id with the company on view -->
@if(Auth::user()->company->id != $company->id)
<script type="text/javascript">
	window.location = "{{ url('/404') }}";
</script>
@endif
@endif
@endif

@extends('layouts.admin')

@section('content')
<?php
if($company->profile_image_filepath != null){
	$path = decrypt($company->profile_image_filepath);
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
				<h3>{{$company->fullname}}</h3>
			</div>
			@else
			<div class="col-md-3 col-lg-3 profile-pic" align="center"> <img width='200' height='200' alt="User Pic" src="<?php echo asset("storage/profile_pictures") . '/' . $dp; ?>" class="img-circle img-responsive">
				<h3>{{$company->fullname}}</h3>
			</div>
			@endif

			<div class=" col-md-9 col-lg-9 "> 
				<table class="table">
					<h2 style="border-bottom:2px solid #a9a9a9">Company Details</h2>
					<tbody>
						<tr>
							<th>Company Name:</th>
							<td>{{ $company->fullname }}</td>
						</tr>
						<tr>
							<th>Contact Person:</th>
							<td>{{ $company->contact_person }}</td>
						</tr>
						<tr>
							<th>Department</th>
							<td>{{ $company->department }}</td>
						</tr>
						<tr>
							<th>ID Number</th>
							<td>{{ $company->id_number }}</td>
						</tr>
						<tr>
							<th>Company Address</th>
							<td>{{ $company->company_address . ',' . $company->company_zip_code . ',' . $company->company_state . ',' . $company->company_country }}</td>
						</tr>
						<tr>
							<th>Branch Address</th>
							<td>{{ $company->branch_address . ',' . $company->branch_zip_code . ',' . $company->branch_state . ',' . $company->branch_country }}</td>
						</tr>
						<tr>
							<th>Mobile Number</th>
							<td>{{ $company->user->contact_number }}</td>
						</tr>
						<tr>
							<th>Telephone Number</th>
							<td>{{ $company->telephone_number }}</td>
						</tr>
						<tr>
							<th>Email Address:</th>
							<td>{{ $company->user->email }}</td>
						</tr>
					</tbody>
				</table>
			</div>
			<div>
				@if(session()->get('user_type') == 'company')
				<a class="btn btn-small btn-info" href="{{ URL::to('company/' . $company->id . '/edit') }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
				@endif
				@if(session()->get('user_type') == 'admin')
				{{ Form::open(array('url' => url('company/'.$company->id), 'style' => 'display:inline-block;')) }}
				{{ Form::hidden('_method', 'DELETE') }}
				{{ Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i>', ['type' => 'submit', 'class' => 'btn btn-danger'] )  }}
				{{ Form::close() }}
				@if($company->is_approved != 1)
				<a href="{{ url('/company/approve/'.$company->id) }}" class="btn btn-success">Approve</a>
				@endif
				@endif
			</div>
		</div>
	</div>
</div>


@endsection
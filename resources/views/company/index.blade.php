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
			aaSorting: [],
		});
	});
</script>

@if(session()->get('user_type') == 'admin')
<h1>Approved Companies</h1>
<table class="table table-striped table-bordered text-center" id='data-table'>
	<thead>
		<tr>
			<th class='text-center'>ID Number</th>
			<th class='text-center'>Full Name</th>
			<th class='text-center'>Department</th>
			<th class='text-center'>ID Number</th>
			<th class='text-center'>Company Address</th>
			<th class='text-center'>Branch Address</th>
			<th class="text-center">Action</th>
		</tr>
	</thead>
	<tbody>
		@foreach($companies as $company)
		<tr>
			<td>{{ $company->id_number }}</td>
			<td>{{ $company->fullname }}</td>
			<td>{{ $company->department }}</td>
			<td>{{ $company->id_number }}</td>
			<td>{{ $company->company_address . ',' . $company->company_zip_code . ',' . $company->company_state . ',' . $company->company_country}}</td>
			<td>{{ $company->branch_address . ',' . $company->branch_zip_code . ',' . $company->branch_state . ',' . $company->branch_country}}</td>
			<td>
				{{ Form::open(array('url' => url('/company'.$company->id), 'style' => 'display:inline-block;')) }}
				{{ Form::hidden('_method', 'DELETE') }}
				{{ Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i>', ['type' => 'submit', 'class' => 'btn btn-danger'] )  }}
				{{ Form::close() }}

				<a class="btn btn-small btn-success" href="{{ URL::to('company/' . $company->id) }}"><i class="fa fa-eye" aria-hidden="true"></i></a>

				<a class="btn btn-small btn-info" href="{{ URL::to('company/' . $company->id . '/edit') }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
			</td>
		</tr>
		@endforeach
	</tbody>
</table>
<h1>Companies Waiting for Approval</h1>
<table class="table table-striped table-bordered text-center" id='data-table-with-custom-search'>
	<thead>
		<tr>
			<th></th>
			<th class='text-center'>ID Number</th>
			<th class='text-center'>Full Name</th>
			<th class='text-center'>Department</th>
			<th class='text-center'>Company Address</th>
			<th class='text-center'>Branch Address</th>
			<th class="text-center">Action</th>
		</tr>
	</thead>
	<tbody>
		@foreach($pendings as $pending)
		@if($pending->is_read_by_admin == 1)
		<tr>
			<td></td>
			<td>{{ $pending->id_number }}</td>
			<td>{{ $pending->fullname }}</td>
			<td>{{ $pending->department }}</td>
			<td>{{ $pending->company_address . ',' . $pending->company_zip_code . ',' . $pending->company_state . ',' . $pending->company_country}}</td>
			<td>{{ $pending->branch_address . ',' . $pending->branch_zip_code . ',' . $pending->branch_state . ',' . $pending->branch_country}}</td>
			<td>
				<a class="btn btn-small btn-success" href="{{ URL::to('company/' . $pending->id) }}">View Profile</a>
			</td>
		</tr>
		@else
		<tr>
			<td><span class="fa fa-circle" style="color:red; font-size: 10px;"></span></td>
			<td>{{ $pending->id_number }}</td>
			<td>{{ $pending->fullname }}</td>
			<td>{{ $pending->department }}</td>
			<td>{{ $pending->company_address . ',' . $pending->company_zip_code . ',' . $pending->company_state . ',' . $pending->company_country}}</td>
			<td>{{ $pending->branch_address . ',' . $pending->branch_zip_code . ',' . $pending->branch_state . ',' . $pending->branch_country}}</td>
			<td>
				<a class="btn btn-small btn-success" href="{{ URL::to('company/' . $pending->id) }}">View Profile</a>
			</td>
		</tr>
		@endif
		@endforeach
	</tbody>
</table>
@else
<h1>Company List</h1>
<table class="table table-striped table-bordered text-center" id='data-table'>
	<thead>
		<tr>
			<th class='text-center'>ID</th>
			<th class='text-center'>Full Name</th>
			<th class='text-center'>Department</th>
			<th class='text-center'>Company Address</th>
			<th class='text-center'>Branch Address</th>
			<th class="text-center">Action</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$arr = array();
		foreach($employee->tasks as $task){
			$arr[] = $task->company;
		}
		$unique_array = array_unique($arr);
		foreach($unique_array as $company){ ?>
		<tr>
			<td>{{ $company->id_number }}</td>
			<td>{{ $company->fullname }}</td>
			<td>{{ $company->department }}</td>
			<td>{{ $company->company_address . ',' . $company->company_zip_code . ',' . $company->company_state . ',' . $company->company_country}}</td>
			<td>{{ $company->branch_address . ',' . $company->branch_zip_code . ',' . $company->branch_state . ',' . $company->branch_country}}</td>
			<td>
				<a class="btn btn-small btn-success" href="{{ URL::to('company/' . $company->id) }}"><i class="fa fa-eye" aria-hidden="true"></i></a>
			</td>
		</tr>
		<?php } ?>
	</tbody>
</table>
@endif
<script>
	var table_search = $('table#data-table-with-custom-search').DataTable({
		responsive: true,
		pageLength: 5,
		lengthMenu: [[5,10, 20], [5,10, 20]],
		aaSorting: [],
	});
	/*$(document).ready(function(){
		$('table#data-table-with-custom-search tfoot th').each(function() {
			var title = $(this).text();
			$(this).html( '<input class="search-filter" style="width:100%;" type="text" placeholder="Search '+title+'" />' );
		});

		var table_search = $('table#data-table-with-custom-search').DataTable({
			responsive: true,
			pageLength: 5,
			lengthMenu: [[5,10, 20], [5,10, 20]],
			aaSorting: [],
		});

		table_search.columns().every(function(){
			var that = this;
			$('input', this.footer()).on('keyup change', function(){
				if ( that.search() !== this.value ) {
					that
					.search( this.value )
					.draw();
				}
			});
		});
	});*/
</script>

@endsection
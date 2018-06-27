@extends('layouts.admin')

@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<h1>Selection Option Manager</h1>
<style>
.option-field, .delete-company{
	display: inline-block;
}
.option-field{
	width: 50% !important;
}
</style>
{{ Form::open(array('url' => url("/settings/selection-option-manager/update"), 'method' => 'put')) }}
<div class="container">

	<ul class="nav nav-tabs">
		<li class="active"><a data-toggle="tab" href="#menu2">Highest Degree Selection List</a></li>
	</ul>

	<div class="tab-content well">
		<div id="menu2" class="tab-pane fade in active">
			<h3>Highest Degree Selection List</h3>
			<input type="hidden" value="Degree" name='degree_hidden'>
			<div id='degree-container'>
				@foreach($degree as $d)
				<div>
					<input type="text" name="degree[]" value="{{ $d->value }}" class='form-control option-field'>
					<a class="delete-degree btn btn-danger">-</a>
				</div>
				@endforeach
			</div>
			<a class='add-degree btn btn-success'>+</a>
		</div>
	</div>
	<div>
		{{ Form::submit('Save', ['class' => 'btn btn-success']) }}
	</div>
</div>
{{ Form::close() }}
<script type="text/javascript">
	//add company option
	$(".add-company").click(function(){
		$("div#company-container").append('<div><input type="text" name="company_type[]" class="form-control option-field"> <a class="delete-company btn btn-danger">-</a></div>');
	});

	$("div#company-container").on('click','.delete-company',function(){
		$(this).parent().remove();
	});

	//add industry option
	$(".add-industry").click(function(){
		$("div#industry-container").append('<div><input type="text" name="industry_type[]" class="form-control option-field"> <a class="delete-industry btn btn-danger">-</a></div>');
	});

	$("div#industry-container").on('click','.delete-industry',function(){
		$(this).parent().remove();
	});

	//add degree option
	$(".add-degree").click(function(){
		$("div#degree-container").append('<div><input type="text" name="degree[]" class="form-control option-field"> <a class="delete-degree btn btn-danger">-</a></div>');
	});

	$("div#degree-container").on('click','.delete-degree',function(){
		$(this).parent().remove();
	});
</script>
@endsection
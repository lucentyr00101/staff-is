@extends('layouts.admin')

@section('content')
<link rel="stylesheet" href="{{ asset('css/timepicker.css') }}">
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="{{ asset('css/multiselect.css') }}">
<link rel="stylesheet" href="{{ asset('css/createprofile.css') }}">
{!! Form::open(['files' => true, 'method' => 'put', 'id' => 'msform', 'url' => url('tasks/'.$workforces->id)]) !!}

<div class="form-group">
    {{ Form::label('work_type', 'Work Type') }}
    {{Form::select('work_type', ['Computer Jobs' => 'Computer Jobs', 'Driving Jobs' => 'Driving Jobs',  'Industrial Jobs' => 'Industrial Jobs',  'Management Jobs' => 'Management Jobs', 'Office Jobs' => 'Office Jobs', 'Sales Jobs' => 'Sales Jobs', 'Service Jobs' => 'Service Jobs', 'Teaching Jobs' => 'Teaching Jobs'], $workforces->work_type, ['class' => 'form-control', 'required'])}}
</div>

<div class="form-group">
    {{ Form::label('work_location', 'Work Location') }}
    {{Form::text('work_location', $workforces->work_location , ['placeholder' => 'Work Location', 'class' => 'form-control'])}}
</div>

<div class="form-group">
    {{ Form::label('extra_requirements', 'Extra Requirements') }}
    {{Form::textarea('extra_requirements', $workforces->extra_requirements , ['placeholder' => 'Extra Requirements', 'class' => 'form-control'])}}
</div>

<div class="form-group">
    {{ Form::label('employee_required', 'Employee Required') }}
    {{Form::text('employee_required', $workforces->employee_required, ['placeholder' => 'Employee Required', 'class' => 'form-control'])}}
</div>

<div class="form-group">
    {{ Form::label('status', 'Status') }}
    {{ Form::select('status', ['In Progress' => 'In Progress', 'Completed' => 'Completed'], $workforces->status, ['class' => 'form-control']) }}
</div>
<!-- Task Schedule -->
<h2 style="border-bottom:2px solid #a9a9a9">Task Schedule</h2>
<div class="form-group">
    <table class="table table-hover table-responsive table-striped schedule-tbl">
        <thead>
            <tr>
                <th>Days</th>
                <th>Time In</th>
                <th>Time Out</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
            if(!empty($workforces->result)){
                $i = 1;
                foreach($workforces->result as $result_item){ ?>
                <tr class="schedule_row">
                    <input type="hidden" name='hidden_row[]' value='x' />
                    <td>{{ Form::select('schedule_day'.$i.'[]', ['Sunday' => 'Sunday', 'Monday' => 'Monday', 'Tuesday' => 'Tuesday', 'Wednesday' => 'Wednesday', 'Thursday' => 'Thursday', 'Friday' => 'Friday', 'Saturday' => 'Saturday'], explode(', ', $result_item[0]['days']), ['class' => 'form-control multiselect-ui', 'multiple', 'required']) }}</td>
                    <td>{{ Form::text('schedule_time_in'.$i , $result_item[0]['time_in'], ['class' => 'form-control schedule_time']) }}</td>
                    <td>{{ Form::text('schedule_time_out'.$i ,$result_item[0]['time_out'], ['class' => 'form-control schedule_time']) }}</td>
                    <td><input type="button" value="-" class="theme-btn-dk btn pull-right rem-schedule" /></td>
                    <input type="hidden" class='hidden_schedule_counter' value="<?php echo $i; ?>">
                </tr>
                <?php $i++; }
            } else { ?>
            <tr class='schedule_row'>
                <input type="hidden" name='hidden_row[]' value='x' />
                <td>{{ Form::select('schedule_day1[]', ['Sunday' => 'Sunday', 'Monday' => 'Monday', 'Tuesday' => 'Tuesday', 'Wednesday' => 'Wednesday', 'Thursday' => 'Thursday', 'Friday' => 'Friday', 'Saturday' => 'Saturday'], null, ['class' => 'form-control multiselect-ui', 'multiple', 'required']) }}</td>
                <td>{{ Form::text('schedule_time_in1', null, ['class' => 'form-control schedule_time', 'required']) }}</td>
                <td>{{ Form::text('schedule_time_out1', null, ['class' => 'form-control schedule_time', 'required']) }}</td>
                <td><input type="button" value="-" class="theme-btn-dk btn pull-right rem-schedule" /></td>
                <input type="hidden" class='hidden_schedule_counter' value="1">
            </tr>
            <?php }
            ?>
        </tbody>
        <tfoot>
            <td colspan="5">
                <input type="button" value="+" class="theme-btn-lt btn pull-right add-schedule" />
            </td>
        </tfoot>
    </table>
</div>

{{ Form::submit('Update', array('class' => 'btn btn-primary')) }}

{{ Form::close() }}
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>
<script src="{{ asset('js/app.js') }}"></script>
<script src='{{ asset("js/multiselect.js") }}'></script>
<script src="{{ asset('js/timepicker.js') }}"></script>
<script src="{{ asset('js/workforces.js') }}"></script>
@endsection
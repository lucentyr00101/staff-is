$(document).ready(function(){
	$('.multiselect-ui').multiselect();
	$('.schedule_time').timepicker({
		'timeFormat': 'H:i',
		'step': 15,
	});
	$('.schedule_date').datepicker();
});

var sched_counter = parseInt($('.hidden_schedule_counter').last().val());
$(document).on('click', '.add-schedule', function(){
	sched_counter += 1;
	var row = $(`
	<tr class="schedule_row"><input type="hidden" value="x" name="hidden_row[]" />
		<td>
			<input class="form-control schedule_date" name="schedule_date`+sched_counter+`[]"
		</td>
		<td>
			<input class="form-control schedule_time" name="schedule_time_in`+sched_counter+`" type="text">
		</td>
		<td>
			<input class="form-control schedule_time" name="schedule_time_out`+sched_counter+`" type="text">
		</td>
		<td>
			<input type="button" value="-" class="theme-btn-dk btn pull-right rem-schedule" />
		</td>
	</tr>`);

	row.appendTo('table.schedule-tbl tbody');
	$('.multiselect-ui').multiselect();
	$('.schedule_time').timepicker({
		'timeFormat': 'H:i',
		'step': 15,
	});
	$('.schedule_date').datepicker();
});

$(document).on('click', '.rem-schedule', function(){
	sched_counter -= 1;
	$(this).parent().parent().remove();
});

$('#work_type_selector').on('change',function() {
	var value = $(this).val();
	value == 'Other' ? $('#other_work_type_container').show() : $('#other_work_type_container').hide();
});

$('#other_work_type_container input').on('keypress blur', function(){
	$(this).val() == '' ? $(this).css('border', '1px solid red') : $(this).css('border', '1px solid green');
});
$(document).ready(function(){
	$('.multiselect-ui').multiselect();
	$('.schedule_time').timepicker({
		'timeFormat': 'H:i',
		'step': 15,
	});
});

var sched_counter = parseInt($('.hidden_schedule_counter').last().val());
$(document).on('click', '.add-schedule', function(){
	sched_counter += 1;
	var row = $('<tr class="schedule_row"><input type="hidden" value="x" name="hidden_row[]" /><td><select class="form-control multiselect-ui" multiple name="schedule_day'+sched_counter+'[]"><option value="Sunday">Sunday</option><option value="Monday">Monday</option><option value="Tuesday">Tuesday</option><option value="Wednesday">Wednesday</option><option value="Thursday">Thursday</option><option value="Friday">Friday</option><option value="Saturday">Saturday</option></select></td><td><input class="form-control schedule_time" name="schedule_time_in'+sched_counter+'" type="text"></td><td><input class="form-control schedule_time" name="schedule_time_out'+sched_counter+'" type="text"></td><td><input type="button" value="-" class="theme-btn-dk btn pull-right rem-schedule" /></td></tr>');

	row.appendTo('table.schedule-tbl tbody');
	$('.multiselect-ui').multiselect();
	$('.schedule_time').timepicker({
		'timeFormat': 'H:i',
		'step': 15,
	});
	console.log(sched_counter);
});

$(document).on('click', '.rem-schedule', function(){
	sched_counter -= 1;
	$(this).parent().parent().remove();
	console.log(sched_counter);
});

$('#work_type_selector').on('change',function() {
	var value = $(this).val();
	if(value == 'Other'){
		$('#other_work_type_container').show();
	} else {
		$('#other_work_type_container').hide();
	}
});

$('#other_work_type_container input').on('keypress blur', function(){
	if($(this).val() == ''){
		$(this).css('border', '1px solid red');
	} else {
		$(this).css('border', '1px solid green');
	}
});
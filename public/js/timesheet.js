var datepickeroptions = {
	changeMonth: true,
	changeYear: true,
	yearRange: "-60:+0",
	dateFormat: 'dd/mm/y',
}
$('.timesheet-datepicker').datepicker(datepickeroptions);

$('.timesheet-time-in, .timesheet-time-out').timepicker({
	'timeFormat': 'H:i',
	'step': 15,
});

$('.text-box').keyup(function(){
	var count = $(this).val().replace(/\s/g, '').length;
	if(count != 0) {
		$(this).parent().addClass('changed');
	} else {
		$(this).parent().removeClass('changed');
	}
});

$('.text-box').blur(function(){
	if(!$(this).val()){
		$(this).parent().removeClass('changed');
	}
});
//add new row
$('#add-row').on('click', function(){
	$('table.timesheet tbody').append("<tr><td><input required type='text' name='date[]' class='form-control timesheet-datepicker'></td><td><input type='text' required name='code[]' class='form-control'></td><td><input type='text' required name='jd[]' class='form-control'></td><td><input type='text' required name='time_in[]' class='form-control timesheet-time-in'></td><td><input required type='text' name='time_out[]' class='form-control timesheet-time-out'></td><td><input type='text' required name='reg_time[]' id='reg_time' readonly class='reg_time form-control'></td><td><input type='text' required name='overtime[]' class='form-control overtime' id='overtime' readonly></td><td><input required type='text' name='remarks_emp[]' class='form-control'></td><td><input type='text' required name='remarks_company[]' class='form-control'></td><td><input type='button' value='-' required class='btn btn-danger delete-row'></td></tr>");
	var datepickeroptions = {
		changeMonth: true,
		changeYear: true,
		yearRange: "-60:+0",
		dateFormat: 'dd/mm/y',
	}
	$('.timesheet-datepicker').datepicker(datepickeroptions);
	$('.timesheet-datepicker:last').datepicker().datepicker('setDate', new Date()); //set today's date as default value
	$('.timesheet-time-in, .timesheet-time-out').timepicker({
		'timeFormat': 'H:i',
		'step': 15,
	});
});

//remove row
$("table.timesheet tbody").on('click','.delete-row',function(){
	$(this).parent().parent().remove();
});

/****************************
** All Reg Time Calculator **
*****************************/
totalhrs = 0;
totalmins = 0;
function compute_reg_time(){
	$('.reg_time').each(function(){
		// First simply adding all of it together, total hours and total minutes
		var test = $(this).val();
		var time_array = test.split(':');
		var hr = parseInt(time_array[0]);
		var mins = parseInt(time_array[1]);
		totalhrs += hr;
		totalmins += mins;

		// If the minutes exceed 60
		if (totalmins >= 60) {
	        // Divide minutes by 60 and add result to hours
	        totalhrs += Math.floor(totalmins / 60);
	        // Add remainder of totalM / 60 to minutes
	        totalmins = totalmins % 60;

	    }
	});
}
//on page load, run function then display data
compute_reg_time();
$(document).ready(function(){
	console.log(totalhrs);
	totalmins = totalmins < 10 ? "0" + totalmins : totalmins
	$('#total-reg-time-txt').val(totalhrs + ':' + totalmins);
});

/****************************
** All overTime Calculator **
*****************************/
totalhrs_ot = 0;
totalmins_ot = 0;
function compute_ot_time(){
	$('.overtime').each(function(){
		// First simply adding all of it together, total hours and total minutes
		var ot_time = $(this).val();
		var array_ot = ot_time.split(':');
		var hr_ot = parseInt(array_ot[0]);
		var mins_ot = parseInt(array_ot[1]);
		totalhrs_ot += hr_ot;
		totalmins_ot += mins_ot;

		// If the minutes exceed 60
		if (totalmins_ot >= 60) {
	        // Divide minutes by 60 and add result to hours
	        totalhrs_ot += Math.floor(totalmins_ot / 60);
	        // Add remainder of totalM / 60 to minutes
	        totalmins_ot = totalmins_ot % 60;
	    }
	});
}
//on page load, run function then display data
compute_ot_time();
$(document).ready(function(){
	totalhrs_ot = totalhrs_ot < 10 ? "0" + totalhrs_ot : totalhrs_ot
	totalmins_ot = totalmins_ot < 10 ? "0" + totalmins_ot : totalmins_ot
	$('#total-overtime-txt').val(totalhrs_ot + ':' + totalmins_ot);
});

/*******************************
** Time Difference Calculator **
********************************/
$(document).on('change', '.timesheet-time-out', function(){
	//pass values to variables
	var time_in = $(this).parent().parent().find('.timesheet-time-in').val() + ':00';
	var time_out = $(this).val() + ':00';

	//find difference between time
	var startTime=moment(time_in, "HH:mm:ss");
	var endTime=moment(time_out, "HH:mm:ss");
	var duration = moment.duration(endTime.diff(startTime));
	var hours = parseInt(duration.asHours());
	hours = hours < 10 ? "0" + hours : hours
	var minutes = parseInt(duration.asMinutes())-hours*60;
	minutes = minutes < 10 ? "0" + minutes : minutes
	var v = hours +':'+ minutes;
	$(this).parent().parent().find('#reg_time').val(v);

	//for updating total reg_time value
	totalhrs = 0;
	totalmins = 0;
	compute_reg_time();
	totalmins = totalmins < 10 ? "0" + totalmins : totalmins
	$('#total-reg-time-txt').val(totalhrs + ':' + totalmins);

	//find difference between time(overtime)
	var end_time = $('.work_schedule_end_hidden').val();
	var out_time = $(this).val();
	var startTime=moment(end_time, "HH:mm:ss");
	var endTime=moment(out_time, "HH:mm:ss");
	var duration = moment.duration(endTime.diff(startTime));
	var hours = parseInt(duration.asHours());
	var minutes = parseInt(duration.asMinutes())-hours*60;

	if(hours < 0){
		hours = "00";
	} else {
		hours = hours < 10 ? "0" + hours : hours;
	}
	if(minutes < 0){
		minutes = "00";
	} else {
		minutes = minutes < 10 ? "0" + minutes : minutes;
	}
	
	if(isNaN(hours)){
		hours = 00;
	}
	if(isNaN(minutes)){
		minutes = 00;
	}
	var v = hours +':'+ minutes;

	console.log(v);
	$(this).parent().parent().find('#overtime').val(v);

	//for updating total overtime value
	totalhrs_ot = 0;
	totalmins_ot = 0;
	compute_ot_time();
	totalhrs_ot = totalhrs_ot < 10 ? "0" + totalhrs_ot : totalhrs_ot;
	totalmins_ot = totalmins_ot < 10 ? "0" + totalmins_ot : totalmins_ot;
	$('#total-overtime-txt').val(totalhrs_ot + ':' + totalmins_ot);
});
$(document).on('change', '.timesheet-time-in', function(){
	//pass values to variables
	var time_out = $(this).parent().parent().find('.timesheet-time-out').val() + ':00';
	var time_in = $(this).val() + ':00';

	//find difference between time
	var startTime=moment(time_in, "HH:mm:ss");
	var endTime=moment(time_out, "HH:mm:ss");
	var duration = moment.duration(endTime.diff(startTime));
	var hours = parseInt(duration.asHours());
	var minutes = parseInt(duration.asMinutes())-hours*60;

	if(hours < 0){
		hours = "00";
	} else {
		hours = hours < 10 ? "0" + hours : hours;
	}
	if(minutes < 0){
		minutes = "00";
	} else {
		minutes = minutes < 10 ? "0" + minutes : minutes;
	}

	if(isNaN(hours)){
		hours = 00;
	}
	if(isNaN(minutes)){
		minutes = 00;
	}
	var v = hours +':'+ minutes;
	$(this).parent().parent().find('#reg_time').val(v);

	//for updating total reg_time value
	totalhrs = 0;
	totalmins = 0;
	compute_reg_time();
	totalmins = totalmins < 10 ? "0" + totalmins : totalmins
	$('#total-reg-time-txt').val(totalhrs + ':' + totalmins);
});

$(document).on('keydown keypress keyup', 'input.timesheet-time-in, input.timesheet-time-out', function(e){
	e.preventDefault();
})
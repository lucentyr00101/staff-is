<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Muli:700" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
<link rel="stylesheet" href="{{ asset('css/paginator.css') }}">

<script src="http://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="{{ asset('js/paginator.js') }}"></script>

<style>
#featured-jobs-container {
	border:blue 2px solid;
	padding: 35px;
	border-radius:10px;
	width: 70%;
	padding: 20px;
	background: #eee;
}

.task-container {
	border: #542673 3px solid;
	margin:20px 0;
	border-radius: 5px;
	background: #ba93d4;
	padding: 3% 8%;
}

.task-header {
	border-bottom: 2px solid #542673;
}

.task-header span {
	font-size: 36px;
	font-family: Muli;
	font-weight: 700;
}

.task-details {
	font-family: Open Sans;
}

</style>



<ul id="api">
	<li id='loading-data'>Loading Data...</li>
</ul>
<div id="paginate"></div>

<!-- noformat on -->
<script>
	$.ajax({
		url: 'http://staff-is.test/api/tasks/',
		dataType: 'json',
		async: false,
		success: function(data) {
			$("#loading-data").hide();
			console.log(data);
			$.each(data['data'], function(k, value){
				var container = $("<li class='task-container'></li>");
				$('<div class="task-header"><span>' + value['work_type'] + '</span></div><div class="task-details"><div><p> ' + value['company'] + ' </p></div><div><i class="fa fa-map-marker" aria-hidden="true"></i><span> ' + value['work_location'] + '</span></div><div><p>' + value['extra_requirements'] + '</p></div><div><span> ' + value['created_at'] + ' </span></div>').appendTo(container);
				container.appendTo('#api');
			});

			var items = $('#api li');
			var numItems = items.length;
			var perPage = 6;
			console.log('numItems: ' + numItems)

			items.slice(perPage).hide();

			$(function() {
				$('#paginate').pagination({
					items: numItems,
					itemsOnPage: perPage,
					prevText: '<<',
					nextText: '>>',
					displayedPages: 3,
					cssStyle: 'compact-theme',
					// This is the actual page changing functionality.
					onPageClick: function(pageNumber) {
						var showFrom = perPage * (pageNumber - 1);
						var showTo = showFrom + perPage;
						items.hide()
						.slice(showFrom, showTo).show();
					}
				});
			});
		}
	});
</script>
<!-- noformat off -->
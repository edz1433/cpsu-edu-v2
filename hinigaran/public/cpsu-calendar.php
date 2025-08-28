<?php
include'assets/template/top-template.php';
?>
		<link href='calendar/fullcalendar/packages/core/main3.css' rel='stylesheet' />
		<link href='calendar/fullcalendar/packages/daygrid/main.css' rel='stylesheet' />

		<div class="container news-section pb-3">
			<div class='section-title' >
				<h1>Calendar of Activities</h1>
				<p>View the upcoming events of the CPSU Hinigaran Year of 2022.</p>
			</div>
			
			<div id='calendar-container'>
				<div id='calendar'></div>
			 </div>
			 
			<script src="calendar/js/jquery-3.3.1.min.js"></script>
			<script src="calendar/js/popper.min.js"></script>
			<script src="calendar/js/bootstrap.min.js"></script>
	
			<script src='calendar/fullcalendar/packages/core/main3.js'></script>
			<script src='calendar/fullcalendar/packages/interaction/main.js'></script>
			<script src='calendar/fullcalendar/packages/daygrid/main.js'></script>
			<script src='calendar/fullcalendar/packages/timegrid/main.js'></script>
			<script src='calendar/fullcalendar/packages/list/main.js'></script>
		</div>
		
		<script>
		document.addEventListener('DOMContentLoaded', function() {
		var calendarEl = document.getElementById('calendar');

		var calendar = new FullCalendar.Calendar(calendarEl, {
		  plugins: [ 'interaction', 'dayGrid', 'timeGrid', 'list' ],
		  height: 'parent',
		  header: {
			left: 'prev,next today',
			center: 'title',
			right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
		  },
		  backgroundColor:'#ff0000',
		  defaultView: 'dayGridMonth',
		  defaultDate: '<?php echo date('Y-m-d', $nowStrDate); ?>',
		  navLinks: true,
		  editable: false,
		  eventLimit: false, 
		  events: [
		  
			<?php
			$viewEvent = viewPOST('WHERE post_type="Events"');
			if(count($viewEvent) > 0){
				foreach($viewEvent as $eventKey => $updates){
					
					$post_title = $viewEvent[$eventKey]['post_title'];
					$post_start = $viewEvent[$eventKey]['post_start'];
					$post_end = $viewEvent[$eventKey]['post_end'];
					$postID = $viewEvent[$eventKey]['post_id'];
					
					echo '{';
						echo "title: '". str_replace("'","\'", $post_title) ."',
							  start: '". date('Y-m-d h:i:s', $post_start) ."',
							  end: '". date('Y-m-d h:i:s', $post_end) ."',
							  url: 'main-events?page=0&content=".$postID." '";
					echo '},';
				}
			}
			?>
			]
		});

		calendar.render();
	  });

		</script>
		
		
<?php 
include'assets/template/footer-template.php';
?>
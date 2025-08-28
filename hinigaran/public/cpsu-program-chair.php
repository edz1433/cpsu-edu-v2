<?php
include'assets/template/top-template.php';
?>

		<div class="container news-section pb-3">
			<div class='section-title' >
				<h1>Program Heads</h1>
				<p>Program Heads of each department</p>
			</div>
			
			<div class='row' >
				<div class='col-lg-8 small' >
					<div class='row' >
						<div class='col-lg-6 mb-3' >
							<center>
								<img src='assets/personnel/k-salvallon.png' width='150px' >
								<p class='fw-bold m-0 mt-2' >KARLA C. SALVALLON, Ph.D</p>
								<p class='m-0 small fst-italic text-success' >College of Teachers Education</p>
							</center>
						</div>
						
						<div class='col-lg-6 mb-3' >
							<center>
								<img src='assets/personnel/juance.png' width='150px' >
								<p class='fw-bold m-0 mt-2' >SHENAI F. JUANCE, MSCJ-Crim</p>
								<p class='m-0 small fst-italic text-success' >College of Criminal Justice Education</p>
							</center>
						</div>
						
						<div class='col-lg-6 mb-3' >
							<center>
								<img src='assets/personnel/navales.png' width='150px' >
								<p class='fw-bold m-0 mt-2' >REYNAN JAY S. NAVALES, MPA</p>
								<p class='m-0 small fst-italic text-success' >College of Business and Management</p>
							</center>
						</div>
						
						<div class='col-lg-6 mb-3' >
							<center>
								<img src='assets/personnel/alegia.png' width='150px' >
								<p class='fw-bold m-0 mt-2' >JEFREY G. ALEGIA, MSIT</p>
								<p class='m-0 small fst-italic text-success' >College of Computer Studies</p>
							</center>
						</div>
						
						<div class='col-lg-12 mb-3' >
							<center>
								<img src='assets/personnel/predo.png' width='150px' >
								<p class='fw-bold m-0 mt-2' >GREGORIO D. PREDO, MEM</p>
								<p class='m-0 small fst-italic text-success' >College of Agriculture and Forestry</p>
							</center>
						</div>
					</div>
				</div>
				
				<div class='col-lg-4 ps-4 pe-4' >
					<div class="card small mb-3">
						<div class="card-header bg-dark text-white">
							News
						</div>
					  
						<div class="card-body">
							<div class='list-group' >
								<?php
								$viewUpdates = viewPOST('WHERE post_type="Updates" LIMIT 0,4');
								if(count($viewUpdates) > 0){
									foreach($viewUpdates as $updateKey => $updates){
										echo"<a class='mb-2' href='main-updates?page=0&content=".$viewUpdates[$updateKey]['post_id']."' >
										<p class='card-text m-0'>".$viewUpdates[$updateKey]['post_title']."</p>
										<p class='card-text m-0'><small class='text-muted'><i class='far fa-calendar-alt' ></i> ".date('M d, Y', $viewUpdates[$updateKey]['post_date'])."</small></p>
										</a>";
									}
									if(count($viewUpdates) >= 4){
										echo"<a class='small' href='main-updates' >View More</a>";
									}
								}else{
									echo'<label class="small" >No Update</label>';
								}
								?>
							</div>
						</div>
					</div>
					
					<div class="card small mb-3">
						<div class="card-header bg-dark text-white">
							Announcement
						</div>
					  
						<div class="card-body">
							<div class='list-group' >
								<?php
								$viewAnnouncement = viewPOST('WHERE post_type="Announcements" LIMIT 0,4');
								if(count($viewAnnouncement) > 0){
									foreach($viewAnnouncement as $announcementKey => $announcement){
										echo"<a class='mb-2' href='main-updates?page=0&content=".$viewAnnouncement[$announcementKey]['post_id']."' >
										<p class='card-text m-0'>".$viewAnnouncement[$announcementKey]['post_title']."</p>
										<p class='card-text m-0'><small class='text-muted'><i class='far fa-calendar-alt' ></i> ".date('M d, Y', $viewAnnouncement[$announcementKey]['post_date'])."</small></p>
										</a>";
									}
									if(count($viewAnnouncement) >= 4){
										echo"<a class='small' href='main-announcements' >View More</a>";
									}
								}else{
									echo'<label class="small" >No Announcement</label>';
								}
								?>
							</div>
						</div>
					</div>
					
					<div class="card small mb-3">
						<div class="card-header bg-dark text-white">
							Related Links
						</div>
					  
						<div class="card-body">
							<div class='list-group' >
								<a href='main-key-official' >Key Officals</a>
								<a href='main-faculty' >Faculty</a>
								<a href='main-administrative-functions' >Administrative Functions</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		
		
<?php 
include'assets/template/footer-template.php';
?>
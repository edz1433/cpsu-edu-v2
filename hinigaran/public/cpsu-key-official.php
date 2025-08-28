<?php
include'assets/template/top-template.php';
?>

		<div class="container news-section pb-3">
			<div class='section-title' >
				<h1>Key Officals</h1>
				<p>Officials of CPSU Hinigaran Campus</p>
			</div>
			
			<div class='row' >
				<div class='col-lg-8 small' >
					<div class='row' >
						<div class='col-lg-12 mb-3' >
							<center>
								<img src='assets/personnel/moraca.png' width='150px' >
								<p class='fw-bold m-0 mt-2' >ALADINO C. MORACA, Ph.D</p>
								<p class='fw-bold m-0 text-primary small' >CPSU President</p>
								<p class='m-0 small fst-italic text-success' >Admin & Academic Council Chairman Board of Regents Vice Chair</p>
							</center>
						</div>
						
						<div class='col-lg-6 mb-3' >
							<center>
								<img src='assets/personnel/posadas.png' width='150px' >
								<p class='fw-bold m-0 mt-2' >MAE FLOR G. POSADAS, Ph.D</p>
								<p class='fw-bold m-0 text-primary small' >Vice President</p>
								<p class='m-0 small fst-italic text-success' >Research and Extension</p>
							</center>
						</div>
						
						<div class='col-lg-6 mb-3' >
							<center>
								<img src='assets/personnel/abello.png' width='150px' >
								<p class='fw-bold m-0 mt-2' >FERNANDO D. ABELLO, Ph.D</p>
								<p class='fw-bold m-0 text-primary small' >Vice President for Academic Affairs</p>
								<p class='m-0 small fst-italic text-success' >Alumni Representative, Board of Regents</p>
							</center>
						</div>
						
						<div class='col-lg-12 mb-3' >
							<center>
								<img src='assets/personnel/badajos.png' width='150px' >
								<p class='fw-bold m-0 mt-2' >MARC ALEXEI CAESAR B. BADAJOS, Ph.D</p>
								<p class='fw-bold m-0 text-primary small' >CPSU Vice President for Admin And Finance</p>
								<p class='m-0 small fst-italic text-success' >Vice Chairman, Admin Council</p>
							</center>
						</div>
						
						<div class='col-lg-6 mb-3' >
							<center>
								<img src='assets/personnel/predo.png' width='150px' >
								<p class='fw-bold m-0 mt-2' >GREGORIO D. PREDO, MEM</p>
								<p class='fw-bold m-0 text-primary small' >Campus Administrator</p>
								<p class='m-0 small fst-italic text-success' >CPSU-Hinigaran Campus</p>
							</center>
						</div>
						
						<div class='col-lg-6 mb-3' >
							<center>
								<img src='assets/personnel/k-salvallon.png' width='150px' >
								<p class='fw-bold m-0 mt-2' >KARLA C. SALVALLON, Ph.D</p>
								<p class='fw-bold m-0 text-primary small' >Dean of Instruction</p>
								<p class='m-0 small fst-italic text-success' >CPSU-Hinigaran Campus</p>
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
								<a href='main-program-chair' >Program Heads</a>
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
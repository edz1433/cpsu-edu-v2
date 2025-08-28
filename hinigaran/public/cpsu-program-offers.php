<?php
include'assets/template/top-template.php';
?>

		<div class="container news-section pb-3">
			<div class='section-title' >
				<h1>Program Offers</h1>
				<p>List of program offerred in campus.</p>
			</div>
			
			<div class='row' >
				<div class='col-lg-8' >
					<h5>Undergradutes Program</h5>
					<ul>
						<li>Bachelor in Elementary Education</li>
						<li>Bachelor in Secondary Education</li>
						<li>BS in Hospitality Management</li>
						<li>BS in Information Technology</li>
						<li>BS in Agribusiness</li>
					</ul>
					
					<h5>Graduates Program</h5>
					<ul>
						<li>Masters of Arts in Education Major in Education Management</li>
					</ul>
				</div>
				
				<div class='col-lg-4 ps-4 pe-4' >
					<div class="card small mb-3">
						<div class="card-header bg-dark text-white">
							Related Links
						</div>
					  
						<div class="card-body">
							<div class='list-group' >
								<a href='main-admission' >Admission</a>
								<a href='main-extension' >Extension</a>
								<a href='main-program-chair' >Program Heads</a>
							</div>
						</div>
					</div>
					
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
				</div>
			</div>
		</div>

		
		
<?php 
include'assets/template/footer-template.php';
?>
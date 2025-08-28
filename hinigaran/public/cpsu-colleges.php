<?php
include'assets/template/top-template.php';


if(isset($_GET['ccs'])){
	$colleges = viewCollege('ccs');
	$collgeName = $colleges[0]['college_name'];
	$collgeAcroU = strtoupper($colleges[0]['college_id']);
	$collgeAcroL = $colleges[0]['college_id'];
}

if(isset($_GET['cbm'])){
	$colleges = viewCollege('cbm');
	$collgeName = $colleges[0]['college_name'];
	$collgeAcroU = strtoupper($colleges[0]['college_id']);
	$collgeAcroL = $colleges[0]['college_id'];
}

if(isset($_GET['coted'])){
	$colleges = viewCollege('coted');
	$collgeName = $colleges[0]['college_name'];
	$collgeAcroU = strtoupper($colleges[0]['college_id']);
	$collgeAcroL = $colleges[0]['college_id'];
}

if(isset($_GET['caf'])){
	$colleges = viewCollege('caf');
	$collgeName = $colleges[0]['college_name'];
	$collgeAcroU = strtoupper($colleges[0]['college_id']);
	$collgeAcroL = $colleges[0]['college_id'];
}

if(isset($_GET['ccje'])){
	$colleges = viewCollege('ccje');
	$collgeName = $colleges[0]['college_name'];
	$collgeAcroU = strtoupper($colleges[0]['college_id']);
	$collgeAcroL = $colleges[0]['college_id'];
}

if(isset($_GET['gs'])){
	$colleges = viewCollege('gs');
	$collgeName = $colleges[0]['college_name'];
	$collgeAcroU = strtoupper($colleges[0]['college_id']);
	$collgeAcroL = $colleges[0]['college_id'];
}

?>
<!--
		<div id="carouselExampleCaptions" class="carousel slide carousel-fade" data-bs-ride="false">
			<div class="carousel-indicators">
				<button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
				<button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
			</div>

			<div class="carousel-inner">
				<div class="carousel-item active">
					<img style='width:100%;height:auto;' src="assets/img/test.png" class="d-block" alt="...">
					<div class="carousel-caption d-none d-md-block">
						<h5>First slide label</h5>
						<p>Some representative placeholder content for the first slide.</p>
					</div>
				</div>
				
				<div class="carousel-item">
					<img style='width:100%;height:auto;' src="assets/img/test.png" class="d-block" alt="...">
					<div class="carousel-caption d-none d-md-block">
						<h5>First slide label</h5>
						<p>Some representative placeholder content for the first slide.</p>
					</div>
				</div>
			</div>
			
			<button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
				<span class="carousel-control-prev-icon" aria-hidden="true"></span>
				<span class="visually-hidden">Previous</span>
			</button>

			<button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
				<span class="carousel-control-next-icon" aria-hidden="true"></span>
				<span class="visually-hidden">Next</span>
			</button>
		</div>
		
		-->
		
		
		<div>
			<img style='width:100%;height:auto;' src="assets/coverphoto/cover-<?php echo $collgeAcroL; ?>.jpg" class="d-block" alt="...">
		</div>
		

		<div class="container news-section pb-3">
			<div class='section-title' >
				<h1 class='border-start border-5 border-<?php echo $collgeAcroL; ?>' ><?php echo $collgeAcroU; ?></h1>
				<p><?php echo $collgeName; ?></p>
			</div>
			
			<div class='row' >
				<div class='col-lg-8' >
					<p class='h3' >Program Outcomes</p>
					
					<?php include'assets/template/program-outcomes.php'; ?>
					
					<p class='h3' >Program Offer</p>
					
					<div class="mb-5">
						<?php
						$programs = viewProgram($collgeAcroL);
						foreach($programs as $progKEY => $program){
							echo '<p class="card-text ms-3 m-1"><small class="text-'.$collgeAcroL.'">'.$programs[$progKEY]['program_name'].'</small></p>';
						}
						?>
						
					</div>
					
					<p class='h3' >Job Opportunites</p>
					
					<ul>
						<?php
						$jobs = viewJobs($collgeAcroL);
						foreach($jobs as $jobsKEY => $job){
							echo '<li>'.$jobs[$jobsKEY]['job_name'].'</li>';
						}
						?>
					</ul>
				</div>
				
				<div class='col-lg-4 ps-4 pe-4' >
					<center>
						<?php
						$SocialMedia = viewSocialMedia($collgeAcroL);
						foreach($SocialMedia as $SMKEY => $SM){
							echo $SocialMedia[$SMKEY]['sociallinks'];
						}
						?>
					</center>
					
					<div class='row m-1 small mb-3' >
						<?php
						$viewUpdates = viewPOST('WHERE post_type="Updates" AND post_for="'.$collgeAcroU.'" Order By post_id DESC  LIMIT 0,4');
						if(count($viewUpdates) > 0){
							foreach($viewUpdates as $updateKey => $updates){
								
								$doc = new DOMDocument();
								$postUpdateCon = $viewUpdates[$updateKey]['post_content'];
								$doc->loadHTML($postUpdateCon);
								$postUpdateConImg = $doc->getElementsByTagName('img');
								
								if(count($postUpdateConImg) > 0){
									$postUpdateConImgSRC = $postUpdateConImg[0]->getAttribute('src');
								}else{
									$postUpdateConImgSRC = 'assets/img/logo.png';
								}
								
								echo "<div class='col-lg-6 p-0' >
										<img src='".$postUpdateConImgSRC."' width='100%' height='100px' style='object-fit: cover;' >
										<a href='main-updates?page=0&content=".$viewUpdates[$updateKey]['post_id']."' class='text-dark' ><p class='m-0 p-0 small text-center' >".$viewUpdates[$updateKey]['post_title']."</p></a>
									</div>";
							}
							
							echo"<div class='col-lg-12 p-0 mb-1 text-center' >
									<a href='' >More</a>
								</div>";
						}
						?>
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
										echo'<a href="main-announcements" class="btn btn-outline-success btn-sm">View More</a>';
									}
								}else{
									echo'<label class="small text-muted" >No announcement</label>';
								}
								?>
							</div>
						</div>
					</div>
					
					<div class="card small mb-3">
						<div class="card-header bg-dark text-white">
							Upcoming Events
						</div>
					  
						<div class="card-body">
							<div class='list-group' >
								<?php
								$viewEvents = viewPOST('WHERE post_type="Events" LIMIT 0,4');
								if(count($viewEvents) > 0){
									foreach($viewEvents as $eventKey => $event){
										echo"<a class='mb-2' href='main-updates?page=0&content=".$viewEvents[$eventKey]['post_id']."' >
										<p class='card-text m-0'>".$viewEvents[$eventKey]['post_title']."</p>
										<p class='card-text m-0'><small class='text-muted'><i class='far fa-calendar-alt' ></i> ".date('M d, Y', $viewEvents[$eventKey]['post_date'])."</small></p>
										</a>";
									}
									
									if(count($viewEvents) >= 4){
										echo'<a href="main-announcements" class="btn btn-outline-success btn-sm">View More</a>';
									}
								}else{
									echo'<label class="small text-muted" >No event</label>';
								}
								?>
							</div>
						</div>
					</div>
					
					<div class="alert alert-success text-center mt-3" role="alert">
						<a href='main-calendar' class='link-dark' ><i class='fas fa-calendar-alt' ></i> Calendar of Activities</a>
					</div>
					
					<div class="card small mb-3">
						<div class="card-header bg-dark text-white">
							Related Links
						</div>
					  
						<div class="card-body">
							<div class='list-group' >
								<a href='main-colleges?ccs' >College of Computer Studies</a>
								<a href='main-colleges?cbm' >College of Business Management</a>
								<a href='main-colleges?coted' >College of Teacher Education</a>
								<a href='main-colleges?caf' >College of Agriculture and Forestry</a>
								<a href='main-colleges?ccje' >College of Criminal Justice Education</a>
							</div>
						</div>
					</div>
					
				</div>
			</div>
			
		</div>

		
		
		
<?php 
include'assets/template/footer-template.php';
?>
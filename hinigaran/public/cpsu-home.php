<?php
include'assets/template/top-template.php';
?>





		<div id='slide-master' class='bg-info row' >
			<div class='col-md-6 d-flex align-items-center ps-5 pe-5 pt-3' >
				<div id="carouselIMG" class="carousel slide carousel-fade" data-bs-ride="carousel">
					<div class="carousel-inner">
					  
						<?php
						$slideNum = 1;
						$viewUpdates = viewPOST('WHERE is_highlight="1" Order By post_id DESC  LIMIT 0,6');
						if(count($viewUpdates) > 0){
							foreach($viewUpdates as $updateKey => $updates){
							
								$postTITLE = $viewUpdates[$updateKey]['post_title'];
								
								if($slideNum++ == 1){
									$slideActive = 'active';
								}else{
									$slideActive = '';
								}
								echo'<div class="carousel-item '.$slideActive.'" data-bs-interval="10000">
										<p class="h1 fw-bold" style="color:#212121;text-shadow: 0px 0px 5px #fff;" >'.$postTITLE.'</p>
										<a href="main-updates?page=0&content='.$viewUpdates[$updateKey]['post_id'].'" class="btn btn-sm btn-outline-dark" >View</a>
									</div>';
							}
						}
						?>
						
					</div>
				</div>
			</div>
			
			<div class='col-md-6 pe-5 ps-5' >
				<div id="carouselIMG" class="carousel slide carousel-fade" data-bs-ride="carousel">
					<div class="carousel-inner carousel-inner-img">
					  
						<?php
						$slideNum = 1;
						if(count($viewUpdates) > 0){
							foreach($viewUpdates as $updateKey => $updates){
								$postUpdateCon = $viewUpdates[$updateKey]['post_content'];
								$doc->loadHTML($postUpdateCon);
								$postUpdateConImg = $doc->getElementsByTagName('img');
								if($postUpdateConImg->length != 0){
									$postUpdateConImgSRC = $postUpdateConImg[0]->getAttribute('src');
								}else{
									$postUpdateConImgSRC = 'assets/img/logo.png';
								}
								
								if($slideNum++ == 1){
									$slideActive = 'active';
								}else{
									$slideActive = '';
								}
								echo'<div class="carousel-item carousel-item-img '.$slideActive.'" data-bs-interval="10000">
										<img src="'.$postUpdateConImgSRC.'" class="d-block w-100" alt="...">
									</div>';
							}
						}
						?>
						
					</div>
				</div>
			</div>
		</div>

		
		<div class="container news-section">
			<div class='section-title' >
				<h1>Latest News</h1>
				<p>Check the latest updates and other activities</p>
			</div>
		
			<div class="row">
			<?php
			$viewUpdates = viewPOST('WHERE post_type="Updates" AND is_highlight="0" Order By post_id DESC  LIMIT 0,6');
			if(count($viewUpdates) > 0){
				foreach($viewUpdates as $updateKey => $updates){
				
					$postUpdateCon = $viewUpdates[$updateKey]['post_content'];
					$doc->loadHTML($postUpdateCon);
					$postUpdateConImg = $doc->getElementsByTagName('img');
					
					if($postUpdateConImg->length != 0){
						$postUpdateConImgSRC = $postUpdateConImg[0]->getAttribute('src');
					}else{
						$postUpdateConImgSRC = 'assets/img/logo-cpsu.png';
					}
							
					echo "<div class='col-lg-4 col-md-6 col-12 mb-2'>
							<div class='card h-100 w-100' style='width: 18rem;'>
								<img src='".$postUpdateConImgSRC."' class='card-img-top' alt='...'>
							  
								<div class='card-body'>
									<p class='card-text fw-bold text-uppercase'>".$viewUpdates[$updateKey]['post_title']."</p>
									<p class='card-text small'><i class='far fa-calendar-alt' ></i> ".date('M d, Y', $viewUpdates[$updateKey]['post_date'])."</p>
								</div>
								
								<div class='overlay-more'>
									<a href='main-updates?page=0&content=".$viewUpdates[$updateKey]['post_id']."' class='text'>Read</a>
								</div>
							</div>
						</div>";
				}
				if(count($viewUpdates) >= 6){
					echo'<a href="main-updates" class="btn btn-outline-success btn-sm">View More</a>';
				}
			}else{
				echo'<label class="small text-muted" >No news available</label>';
			}
			
			?>
			</div>
		</div>

		
		
		<div class="container">
			<div class="row">
				<div class='col-lg-6 announcement-event-section' >
					<div class='section-title' >
						<h1>Announcements</h1>
						<p>Keep up with the most recent announcements on campus.</p>
					</div>
					 
					<?php
					$viewAnnouncement = viewPOST('WHERE post_type="Announcements" ORDER BY post_id DESC LIMIT 0,4 ');
					if(count($viewAnnouncement) > 0){
						foreach($viewAnnouncement as $announcementKey => $announcement){
							$postAnnouncementCon = $viewAnnouncement[$announcementKey]['post_content'];
							$doc->loadHTML($postAnnouncementCon);
							$postAnnouncementImg = $doc->getElementsByTagName('img');
							
							if($postAnnouncementImg->length != 0){
								$postAnnouncementSRC = $postAnnouncementImg[0]->getAttribute('src');
							}else{
								$postAnnouncementSRC = 'assets/img/logo-cpsu.png';
							}
							
							echo"<div class='card mb-3 w-100' >
									<div class='row g-0'>
										<div class='col-md-4'>
											<img src='".$postAnnouncementSRC."' class='img-fluid rounded-start' alt='...'>
										</div>
										
										<div class='col-md-8'>
											<div class='card-body'>
												<p class='card-text m-0'>".$viewAnnouncement[$announcementKey]['post_title']."</p>
												<p class='card-text m-0'><small class='text-muted'><i class='far fa-calendar-alt' ></i> ".date('M d, Y', $viewAnnouncement[$announcementKey]['post_date'])."</small></p>
											</div>
										</div>
									</div>
									
									<div class='overlay-more'>
										<a href='main-announcements?page=0&content=".$viewAnnouncement[$announcementKey]['post_id']."' class='text'>Read</a>
									</div>
								</div>";
						}
						if(count($viewAnnouncement) >= 4){
							echo'<a href="main-announcements" class="btn btn-outline-success btn-sm">View More</a>';
						}
					}else{
						echo'<label class="small text-muted" >No announcement available</label>';
					}
					?>
				</div>
				
				
				<div class='col-lg-6 announcement-event-section' >
					<div class='section-title' >
						<h1>Upcoming Events</h1>
						<p>List of upcoming events of the CPSU Hinigaran</p>
					</div>
					
					<?php
					$viewEvent = viewPOST('WHERE post_type="Events" AND post_start >= "'.$nowStrDate.'" OR post_end >=  "'.$nowStrDate.'" LIMIT 0,4');
					if(count($viewEvent) > 0){
						foreach($viewEvent as $eventKey => $event){
							$postEventCon = $viewEvent[$eventKey]['post_content'];
							$eventDateS = $viewEvent[$eventKey]['post_start'];
							$eventDateE = $viewEvent[$eventKey]['post_end'];
							$doc->loadHTML($postEventCon);
							$postEventImg = $doc->getElementsByTagName('img');
							
							if($postEventImg->length != 0){
								$postEventImgSRC = $postEventImg[0]->getAttribute('src');
							}else{
								$postEventImgSRC = 'assets/img/logo-cpsu.png';
							}
							
							if(($eventDateS >= $nowStrDate || $eventDateE >= $nowStrDate) && ($eventDateS <= $nowStrDate || $eventDateE <= $nowStrDate)){
								$ongoingEvent = "<p class='card-text m-0'><small class='p-1' style='background-color:#33cc33;border-radius:4px;' >On-going</small></p>";
							}else{
								$ongoingEvent = "";
							}
							
							echo"<div class='card mb-3 w-100' >
									<div class='row g-0'>
										<div class='col-md-4'>
											<img src='".$postEventImgSRC."' class='img-fluid rounded-start' alt='...' >
										</div>
										
										<div class='col-md-8'>
											<div class='card-body'>
												<p class='card-text m-0'>".$viewEvent[$eventKey]['post_title']."</p>
												<p class='card-text m-0'><small class='text-muted'><i class='far fa-calendar-alt' ></i> ".date('M d, Y', $eventDateS)."</small></p>
												".$ongoingEvent."
											</div>
										</div>
									</div>
									
									<div class='overlay-more'>
										<a href='main-events?page=0&content=".$viewEvent[$eventKey]['post_id']."' class='text small'>Read</a>
									</div>
								</div>";
						}
						if(count($viewEvent) >= 4){
							echo'<a href="main-events" class="btn btn-outline-success btn-sm">View More</a>';
						}
					}else{
						echo'<label class="small text-muted" >No event available</label>';
					}
					?>
					
				</div>
			</div>
		</div>
		
		<div class='stats-section' >
			<div class='stats-overlay' >
				<div class="container">
					<div class="row">
						<div class='col-lg-6' >
							<img src="assets/coverphoto/cover-all.jpg" alt="" class="shadow-lg p-1 bg-dark rounded img-fluid" >
						</div>
						
						<div class='col-lg-6' >
							<div class='row' >
								<div class='col-sm-6' >
									<div class='d-flex justify-content-start align-items-center' >
										<div class='icon' ><p class='mdi mdi-grease-pencil' ></p></div>
										<div class='text-center' >
											<p class='total' >1,025</p>
											<p>Enrolled</p>
										</div>
									</div>
								</div>
								
								<div class='col-sm-6' >
									<div class='d-flex justify-content-start align-items-center' >
										<div class='icon' ><p class='mdi mdi-school' ></p></div>
										<div class='text-center' >
											<p class='total' >306</p>
											<p>Graduates <small style='font-size:16px;' >(2021-Present)</small></p>
										</div>
									</div>
								</div>
								
								<div class='col-sm-6' >
									<div class='d-flex justify-content-start align-items-center' >
										<div class='icon' ><p class='mdi mdi-book-multiple' ></p></div>
										<div class='text-center' >
											<p class='total' >4</p>
											<p>Course</p>
										</div>
									</div>
								</div>
								
								<div class='col-sm-6' >
									<div class='d-flex justify-content-start align-items-center' >
										<div class='icon' ><p class='mdi mdi-elevation-rise' ></p></div>
										<div class='text-center' >
											<p class='total' >9</p>
											<p>Commencement</p>
										</div>
									</div>
								</div>
							</div>
						
							
						</div>
					</div>
				</div>
			</div>
		</div>
		
		
		
		
		
		
		
		
		
		
		
		<div class='key-colleges-section' >
			<div class="container">
				<div class='row' >
					<div class='col-lg-8 colleges' >
						<div class='section-title' >
							<h1>Colleges</h1>
							<p>Colleges in CPSU Hinigaran Campus</p>
						</div>
						
						<div class='row' >
							<div class='col-lg-6' >
								<a href='main-colleges?ccs' >
									<div class="card mb-3 w-100 border-ccs" >
										<div class="row g-0">
											<div class="col-4">
												<img src="assets/img/logo-ccs.png" class="img-fluid" alt="CCS Logo">
											</div>
											
											<div class="col-8">
												<div class="card-body">
													<p class="card-text m-0 fw-bold text-dark">CCS</p>
													<p class="card-text m-0"><small class="text-ccs">College of Computer Studies</small></p>
												</div>
											</div>
										</div>
									</div>
								</a>
							</div>
							
							<div class='col-lg-6' >
								<a href='main-colleges?cbm' >
									<div class="card mb-3 w-100 border-cbm" >
										<div class="row g-0">
											<div class="col-4">
													<img src="assets/img/logo-cbm.png" class="img-fluid" alt="CBM Logo">
											</div>
											
											<div class="col-8">
												<div class="card-body">
													<p class="card-text m-0 fw-bold">CBM</p>
													<p class="card-text m-0"><small class="text-cbm">College of Business Management</small></p>
												</div>
											</div>
										</div>
										
									</div>
								</a>
							</div>
							
							<div class='col-lg-6' >
								<a href='main-colleges?coted' >
									<div class="card mb-3 w-100 border-coted" >
										<div class="row g-0">
											<div class="col-4">
												<img src="assets/img/logo-coted.png" class="img-fluid" alt="COTED Logo">
											</div>
											
											<div class="col-8">
												<div class="card-body">
													<p class="card-text m-0 fw-bold">COTED</p>
													<p class="card-text m-0"><small class="text-coted">College of Teachers Education</small></p>
												</div>
											</div>
										</div>
										
									</div>
								</a>
							</div>
							
							<div class='col-lg-6' >
								<a href='main-colleges?caf' >
									<div class="card mb-3 w-100 border-caf" >
										<div class="row g-0">
											<div class="col-4">
													<img src="assets/img/logo-caf.png" class="img-fluid" alt="CAF Logo">
											</div>
											
											<div class="col-8">
												<div class="card-body">
													<p class="card-text m-0 fw-bold">CAF</p>
													<p class="card-text m-0"><small class="text-cas">College of Agriculture and Forestry</small></p>
												</div>
											</div>
										</div>
										
									</div>
								</a>
							</div>
							
							<div class='col-lg-6' >
								<a href='main-colleges?ccje' >
									<div class="card mb-3 w-100 border-ccje" >
										<div class="row g-0">
											<div class="col-4">
													<img src="assets/img/logo-ccje.png" class="img-fluid" alt="ccje Logo">
											</div>
											
											<div class="col-8">
												<div class="card-body">
													<p class="card-text m-0 fw-bold">CCJE</p>
													<p class="card-text m-0"><small class="text-ccje">College of Criminal Justice Education</small></p>
												</div>
											</div>
										</div>
										
									</div>
								</a>
							</div>
							
							<div class='col-lg-6' >
								<a href='#' >
									<div class="card mb-3 w-100 border-primary" >
										<div class="row g-0">
											<div class="col-4">
												<img src="assets/img/logo-cpsu.png" class="img-fluid" alt="...">
											</div>
											
											<div class="col-8">
												<div class="card-body">
													<p class="card-text m-0 fw-bold">GS</p>
													<p class="card-text m-0"><small class="text-primary">Graduate School</small></p>
												</div>
											</div>
										</div>
										
									</div>
								</a>
							</div>
						</div>
					</div>
					
					<div class='col-lg-4' >
						<div class='section-title' >
							<h1>Administration</h1>
							<p></p>
						</div>
						
						<div class='row p-3' >
							<a href='main-key-official' class='w-100 bg-primary d-flex align-self-center justify-content-center p-3 pt-5 pb-5 text-white' >
								Key Officials
							</a>
							<a href='main-faculty' class='w-100 bg-success d-flex align-self-center justify-content-center p-3 pt-5 pb-5 text-white' >
								Faculty
							</a>
							<a href='main-administrative-functions' class='w-100 bg-secondary d-flex align-self-center justify-content-center p-3 pt-5 pb-5 text-white' >
								Administrative Functions
							</a>
						</div>
						
					</div>
				</div>
			</div>
		</div>
		
					
		
		
		
		
		<div class='key-colleges-section mb-5' >
			<div class="container">
				<div class='section-title' >
					<h1>Facebook Page</h1>
					<p>Follow on facebook page for the updates</p>
				</div>
						
				<div class='row' >
					
					<div class='col-lg-12' >	
						<div class="fb-page mt-1" data-href="https://www.facebook.com/CPSUHinigaran11" data-tabs="timeline" data-width="500" data-height="300" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/CPSUHinigaran11" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/CPSUHinigaran11">Facebook</a></blockquote></div>
						<div class="fb-page mt-1" data-href="https://www.facebook.com/profile.php?id=100091415714317" data-tabs="timeline" data-width="500" data-height="300" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/CPSUHinigaran11" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/CPSUHinigaran11">Facebook</a></blockquote></div>
					</div>
					
					<div class='col-lg-12' >		
						<div class="fb-group mt-1" data-href="https://www.facebook.com/groups/366219421878022" data-width="280" data-show-metadata="true"></div>
						<div class="fb-group mt-1" data-href="https://www.facebook.com/groups/1073979766575494/" data-width="245" data-show-metadata="true"></div>	
						<div class="fb-page mt-1" data-href="https://www.facebook.com/profile.php?id=100090108647275" data-tabs="timeline" data-width="280" data-height="257" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/CPSUHinigaran11" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/CPSUHinigaran11">Facebook</a></blockquote></div>
						<div class="fb-page mt-1" data-href="https://www.facebook.com/cpsuccjehinigaran" data-tabs="timeline" data-width="280" data-height="257" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/CPSUHinigaran11" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/CPSUHinigaran11">Facebook</a></blockquote></div>
					</div>
				</div>
			</div>
		</div>
		
		<div class='location-section' >
			<div class='location-content' >
				<div class="container">
					<div class="row">
						<div class='col-lg-6' >
							<center>
								<iframe style="border:0; width: 100%; height: 500px;" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!776m\50!2d122.8551027!3d60.7101282!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33aea5b2901341ab:0x67f28598e5db3e44!2sC+P+S+U+-+Hinigaran+Campus!5e1!3m2!1sen!2sph!4v1550405625014" frameborder="0" allowfullscreen ></iframe>
							</center>
						</div>
						
						<div class='col-lg-6' >
							<p>Central Philippines State University Hinigaran Campus is a public educational institution located in Barangay Gargato, in the municipality of Hinigaran. It is strategically located along the highway, 52 kilometres south of the province of Negros Occidental, 
							situated in more than 1.4 hectares land donated by the Local Government Unit of the municipality with a population of 827 based on recent records. It is one of the external campuses under the Central Philippines State University system. The campus was establish
							with the aim to extend the lifted expertise of the university to the other parts of the province. The Central Philippines State University Hinigaran has five colleges with seven undergraduate programs of
							 Elementary and Secondary Education, Information Technology, Criminology, and Hotel Management, Agri-Business and Agriculture major in Crop Science. Like its sister schools, the campus is duly recognized by the Commission on Higher Education (CHED). <a href='main-about' >Read More...</a></p>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		
		<div class='vmg-section' >
			<div class="container pt-5 pb-5">
				<div class="row">
					<div class='col-sm-4' >
						<h2>VISSION</h2>
						<p>CPSU as the leading technology-driven multi-disciplinary University by 2030</p>
					</div>
					
					<div class='col-sm-4' >
						<h2>MISSION</h2>
						<p>CPSU is committed to produce competent graduates who can generate and extend leading technologies in multi-disciplinary areas beneficial to the community.</p>
					</div>
					
					<div class='col-sm-4' >
						<h2>GOAL</h2>
						<p>To provide efficient, quality, technology-driven and gender-sensitive products and services</p>
					</div>
				</div>
			</div>
		</div>
		
<?php 
include'assets/template/footer-template.php';
?>
<?php
include'assets/template/top-template.php';
?>

		<div class="container news-section pb-3">
			<div class='section-title' >
				<h1>Admission</h1>
				<p>Check the admission and medical requirements.</p>
			</div>
			
			<div class='row' >
				<div class='col-lg-8' >
					<p class='lh-2' style='text-indent:50px;text-align:justify;text-justify: inter-word;' >Admission pertains to the system of assessing and evaluating students who may qualify to be admitted at Central Philippines State University. The goals and objectives of the admission process are: to screen prospective students both in the undergraduate and graduate levels for possible placement on the different courses offered by the university and to assist incoming students in their choice of course within the State College at the same time assess the students' potential for higher education based on the specialization of the State College (technological, agricultural, education, etc.)</p>
			
					<h5>Admission Requirements for First Year Students</h5>
					<ul>
						<li>Report Card/Form 138-A</li>
						<li>Certificate of Good Moral Character</li>
						<li>Transcript of Records (for Transferees)</li>
						<li>Honorable Dismissal (for Transferees)</li>
						<li>Birth Certificate (NSO Authenticated)</li>
						<li>CPSU Security Clearance</li>
						<li>6 pcs. 2X2 ID Picture</li>
						<li>4 pcs. long folder</li>
					</ul>
					
					<h5>Medical-Dental Health Unit Requirements</h5>
					<ul>
						<li>1 pc brown envelope (long)</li>
						<li>1 pc 1 x 1 ID picture</li>
						<li>1 copy of Medical Certificate duly signed by a government/private physician</li>
						<li>Copies of the following laboratory results:</li>
						<ul>
							<li>CBC platelet</li>
							<li>Chest x-ray urinalysis</li>
							<li>Fecalysis</li>
							<li>HBAg (Criminology and HRM only)</li>
							<li>Drug test (Criminology only)</li>
						</ul>
					</ul>
		
				</div>
				
				<div class='col-lg-4 ps-4 pe-4' >
					<div class="card small mb-3">
						<div class="card-header bg-dark text-white">
							Admission Results
						</div>
					  
						<div class="card-body">
							<div class='list-group' >
								<?php
								$viewAdmission = viewPOST('WHERE post_for="Admission"');
								if(count($viewAdmission) > 0){
									foreach($viewAdmission as $admissionKey => $admission){
										echo"<a class='mb-2' href='main-updates?page=0&content=".$viewAdmission[$admissionKey]['post_id']."' >
										<p class='card-text m-0'>".$viewAdmission[$admissionKey]['post_title']."</p>
										<p class='card-text m-0'><small class='text-muted'><i class='far fa-calendar-alt' ></i> ".date('M d, Y', $viewAdmission[$admissionKey]['post_date'])."</small></p>
										</a>";
									}
								}else{
									echo'<label class="small" >No Result</label>';
								}
								?>
							</div>
						</div>
					</div>
					
					<div class="card small mb-3">
						<div class="card-header bg-dark text-white">
							Announcements
						</div>
					  
						<div class="card-body">
							<div class='list-group' >
								<?php
								$viewAnnouncements = viewPOST('WHERE post_type="Announcements" LIMIT 0,4');
								if(count($viewAnnouncements) > 0){
									foreach($viewAnnouncements as $announcementKey => $updates){
										echo"<a class='mb-2' href='main-announcements?page=0&content=".$viewAnnouncements[$announcementKey]['post_id']."' >
										<p class='card-text m-0'>".$viewAnnouncements[$announcementKey]['post_title']."</p>
										<p class='card-text m-0'><small class='text-muted'><i class='far fa-calendar-alt' ></i> ".date('M d, Y', $viewAnnouncements[$announcementKey]['post_date'])."</small></p>
										</a>";
									}
									if(count($viewAnnouncements) >= 4){
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
				</div>
			</div>
		</div>

		
		
<?php 
include'assets/template/footer-template.php';
?>
<?php
include'assets/template/top-template.php';
?>

		<div class="container news-section pb-3">
			<div class='section-title' >
				<h1>Administrative Functions</h1>
				<p>Administrative In-charge</p>
			</div>
			
			<div class='row' >
				<div class='col-lg-8 small' >
					<div class='row' >
						<div class='col-lg-6 mb-3' >
							<center>
								<img src='assets/personnel/amaro.png' width='150px' >
								<p class='fw-bold m-0 mt-2' >ELGIE C. AMARO, MAEd</p>
								<p class='m-0 small fst-italic text-success' >Registrar's Office</p>
							</center>
						</div>
						
						<div class='col-lg-6 mb-3' >
							<center>
								<img src='assets/personnel/predo.png' width='150px' >
								<p class='fw-bold m-0 mt-2' >GREGORIO D. PREDO, MEM</p>
								<p class='m-0 small fst-italic text-success' >Assessment Office/Scholarship Office</p>
							</center>
						</div>
						
						<div class='col-lg-6 mb-3' >
							<center>
								<img src='assets/personnel/guanco.png' width='150px' >
								<p class='fw-bold m-0 mt-2' >JENNIFER T. GUANCO</p>
								<p class='m-0 small fst-italic text-success' >Accounting's Office/Cashiers' Office</p>
							</center>
						</div>
						
						<div class='col-lg-6 mb-3' >
							<center>
								<img src='assets/personnel/alegia.png' width='150px' >
								<p class='fw-bold m-0 mt-2' >JEFREY G. ALEGIA, MSIT</p>
								<p class='m-0 small fst-italic text-success' >Management Information System Office</p>
							</center>
						</div>
						
						<div class='col-lg-6 mb-3' >
							<center>
								<img src='assets/personnel/predo.png' width='150px' >
								<p class='fw-bold m-0 mt-2' >HANZEL N. PEDROSA</p>
								<p class='m-0 small fst-italic text-success' >Extension and Community Service Office</p>
							</center>
						</div>
						
						<div class='col-lg-6 mb-3' >
							<center>
								<img src='assets/personnel/mananap.png' width='150px' >
								<p class='fw-bold m-0 mt-2' >MANELYN L. MANANAP</p>
								<p class='m-0 small fst-italic text-success' >Research and Quality Assurance Office</p>
							</center>
						</div>
						
						<div class='col-lg-6 mb-3' >
							<center>
								<img src='assets/personnel/mananap.png' width='150px' >
								<p class='fw-bold m-0 mt-2' >MANELYN L. MANANAP</p>
								<p class='m-0 small fst-italic text-success' >Office of Student Services and Affairs</p>
							</center>
						</div>
						
						<div class='col-lg-6 mb-3' >
							<center>
								<img src='assets/personnel/mananap.png' width='150px' >
								<p class='fw-bold m-0 mt-2' >LORELY C. CURIO</p>
								<p class='m-0 small fst-italic text-success' >Medical and Dental Health Unit</p>
							</center>
						</div>
						
						<div class='col-lg-6 mb-3' >
							<center>
								<img src='assets/personnel/mananap.png' width='150px' >
								<p class='fw-bold m-0 mt-2' >PAUL DRAKE P. PELAGIO</p>
								<p class='m-0 small fst-italic text-success' >Guidance Office/ NSTP Coordinator</p>
							</center>
						</div>
						
						<div class='col-lg-6 mb-3' >
							<center>
								<img src='assets/personnel/lacaba.png' width='150px' >
								<p class='fw-bold m-0 mt-2' >JHON MICHAEL A. LACABA, MIT</p>
								<p class='m-0 small fst-italic text-success' >Security Office</p>
							</center>
						</div>
						
						<div class='col-lg-6 mb-3' >
							<center>
								<img src='assets/personnel/lacaba.png' width='150px' >
								<p class='fw-bold m-0 mt-2' >VICENTE L. BETINGO JR.</p>
								<p class='m-0 small fst-italic text-success' >Student Supreme Government Office</p>
							</center>
						</div>
						
						<div class='col-lg-6 mb-3' >
							<center>
								<img src='assets/personnel/magbanua.png' width='150px' >
								<p class='fw-bold m-0 mt-2' >JAKE C. MAGBANUA</p>
								<p class='m-0 small fst-italic text-success' >Future Leaders of The Philippines/ Supply and Property Custodian Office</p>
							</center>
						</div>
						
						<div class='col-lg-6 mb-3' >
							<center>
								<img src='assets/personnel/k-salvallon.png' width='150px' >
								<p class='fw-bold m-0 mt-2' >KARLA C. SALVALLON, Ph.D</p>
								<p class='m-0 small fst-italic text-success' >Sports and Cultural Office/ Human Resource Office</p>
							</center>
						</div>
						
						<div class='col-lg-6 mb-3' >
							<center>
								<img src='assets/personnel/juance.png' width='150px' >
								<p class='fw-bold m-0 mt-2' >SHENAI F. JUANCE, MSCJ-Crim</p>
								<p class='m-0 small fst-italic text-success' >Records Office/ Review and Licensure Office</p>
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
								<a href='main-program-chair' >Program Heads</a>
								<a href='main-faculty' >Faculty</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		
		
<?php 
include'assets/template/footer-template.php';
?>
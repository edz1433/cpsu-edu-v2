<?php
include'assets/template/top-template.php';
?>

		<div class="container news-section pb-3">
			<div class='section-title' >
				<h1>Announcements</h1>
				<p>Keep up with the most recent announcements on campus.</p>
			</div>
			
			<div class='row' >
				<div class='col-lg-8' >
					<div class="row">
					<?php
					$contentID = '';
					$pageContent = '0';
					$offset = '0';
					
					if(isset($_GET['content']) && isset($_GET['page'])){
						$pageContent = $_GET['page'];
						$contentID = $_GET['content'];
						$offset = $pageContent . 0;
						
						
						if($contentID != 0){
						
							$viewSingleUpdates = viewPOST('WHERE post_id="'.$contentID.'"');
							if(count($viewSingleUpdates) > 0){
								foreach($viewSingleUpdates as $singleUpdateKEY => $singleUpdate){
								
									echo "<div class='col-lg-12 border-5 border-top border-success p-3'>
											<h2 class='mt-3' >".$viewSingleUpdates[$singleUpdateKEY]['post_title']."</h2>
											<div class='d-flex justify-content-between pb-3'>
												<label class='text-muted small' ><i class='far fa-calendar-alt' ></i> ".date('M d, Y', $viewSingleUpdates[$singleUpdateKEY]['post_date'])."</label>
												<a class='text-muted small' ><i class='fas fa-eye' ></i> ". logs($contentID) ." reached</a>
												<div class='text-muted small dropdown'>
													<a role='button' data-bs-toggle='dropdown' aria-expanded='false'>
														<i class='fas fa-share' ></i> Share
													</a>
											
													<ul class='dropdown-menu'>
														<li><a onclick=\"fbShare('".$base_url.$request."','".$viewSingleUpdates[$singleUpdateKEY]['post_title']."');\" class='small dropdown-item' ><i class='mdi mdi-facebook-box' ></i> Facebook</a></li>
														<li><a onclick=\"twShare('".$base_url.$request."','".$viewSingleUpdates[$singleUpdateKEY]['post_title']."');\" class='small dropdown-item' ><i class='mdi mdi-twitter-box' ></i> Twitter</a></li>
														<li><a onclick=\"inShare('".$base_url.$request."','".$viewSingleUpdates[$singleUpdateKEY]['post_title']."');\" class='small dropdown-item' ><i class='mdi mdi-linkedin-box' ></i> LinkedIn</a></li>
													</ul>
												</div>
											</div>
											
											".$postUpdateCon = $viewSingleUpdates[$singleUpdateKEY]['post_content']."
										</div>";
								}
							}
						
						
						}else{
							noPageSelected();
						}
					}else{
						noPageSelected();
					}
					
					
					
					function noPageSelected(){
						$viewAnnouncement = viewPOST('WHERE post_type="Announcements" Order By post_id DESC  LIMIT 0,6');
						if(count($viewAnnouncement) > 0){
							foreach($viewAnnouncement as $announcementKey => $updates){
								
								$doc = new DOMDocument();
								$postUpdateCon = $viewAnnouncement[$announcementKey]['post_content'];
								$doc->loadHTML($postUpdateCon);
								$postAnnouncementConImg = $doc->getElementsByTagName('img');
								
								if($postAnnouncementConImg->length != 0){
									$postAnnouncementConImgSRC = $postAnnouncementConImg[0]->getAttribute('src');
								}else{
									$postAnnouncementConImgSRC = 'assets/img/logo.png';
								}
					
								echo "<div class='col-md-6 col-12 mb-2'>
										<div class='card h-100 w-100' style='width: 18rem;'>
											<img src='".$postAnnouncementConImgSRC."' class='card-img-top' alt='...'>
										  
											<div class='card-body'>
												<p class='card-text fw-bold text-uppercase'>".$viewAnnouncement[$announcementKey]['post_title']."</p>
												<p class='card-text small'><i class='far fa-calendar-alt' ></i> ".date('M d, Y', $viewAnnouncement[$announcementKey]['post_date'])."</p>
											</div>
											
											<div class='overlay-more'>
												<a href='main-announcements?page=0&content=".$viewAnnouncement[$announcementKey]['post_id']."' class='text'>Read</a>
											</div>
										</div>
									</div>";
							}
						}else{
							echo'<label class="small" >No Announcement</label>';
						}
					}
					
					?>
					</div>
				</div>
				
				<div class='col-lg-4 ps-4 pe-4' >
					<div class="card small mb-3">
						<div class="card-header bg-dark text-white">
							Announcements
						</div>
					
						<div class="card-body">
							<div class='list-group' >
							<?php
							$viewListUpdates = viewPOST('WHERE post_type="Announcements" Order By post_id DESC LIMIT '.$offset .',10');
							if(count($viewListUpdates) > 0){
								foreach($viewListUpdates as $listUpdateKEY => $listUpdate){
									$listID = $viewListUpdates[$listUpdateKEY]['post_id'];
									if($listID == $contentID){
										$listActive = 'bg-success text-white';
									}else{
										$listActive = '';
									}
									echo"<a href='main-announcements?page=".$pageContent."&content=".$listID."' class='".$listActive." ps-2 pt-1 pe-2 pb-1'>".$viewListUpdates[$listUpdateKEY]['post_title']."</a>";
								}
							}else{
								echo'<label class="small" >No Announcement</label>';
							}
							?>
							</div>
							
							
							
							
							<?php
							if(count($viewListUpdates) > 0){
								echo"<div class='p-2 small d-flex justify-content-center mt-3' >";
								$result = mysqli_query(connect(), "SELECT count(*) as total FROM tbl_post WHERE post_type='Announcements' ");
								$data = mysqli_fetch_assoc($result);
								$totalList = $data['total'];
								if($totalList >= 10){
									$totalPageNumber = floor($totalList / 10);
									if( ($totalList % 10) > 0){
										$totalPageNumber = $totalPageNumber + 1;
									}
								}else{
									$totalPageNumber = 1;
								}
									
								$startMaxRange = 3;
								$endMinRange = $totalPageNumber - 0;
								$startMinRange = 0;
								$endMaxRange = $totalPageNumber - 2;
								
								function pageTag($i, $active,$page,$conID){
									$activeStat = '';
									
									if($active){
										$activeStat = 'bg-success text-white';
									}
									return '<a href="main-announcements?page='.$page.'&content='.$conID.'" ><span class="'.$activeStat.' ps-3 pt-2 pe-3 pb-2" >'.$i.'</span></a>';
								}
								
								if($totalPageNumber > 0){
								
									if(0 == $pageContent){
										echo '<a><span class="ps-3 pt-2 pe-3 pb-2" >&laquo;</span></a>';
										if($totalPageNumber != 1){
											echo pageTag(1, true,0,$contentID);
										}
										
									}else{
										echo '<a href="main-announcements?page='.($pageContent - 1).'&content='.$contentID.'" ><span class="ps-3 pt-2 pe-3 pb-2" >&laquo;</span></a>';
										if($totalPageNumber != 1){
											echo pageTag(1, false,0,$contentID);
										}
										
									}
									
									if($totalPageNumber < 5){
										for($i=1; $i<($totalPageNumber - 1); $i++){
											$pageText = $i + 1;
											if($pageText == $pageContent){
												echo pageTag($pageText, true, $i, $contentID);
											}else{
												echo pageTag($pageText, false, $i, $contentID);
											}
										}
									}else{	
										if($pageContent > 2){
											echo pageTag('&#8226;', '','',$contentID);
										}
										for($i=1; $i<($totalPageNumber - 1); $i++){
											$pageText = $i + 1;
											if($pageContent < $startMaxRange){
												if($pageText <= $startMaxRange || $pageText >= $endMinRange){
													if($i == $pageContent){
														echo pageTag($pageText, true, $i, $contentID);
													}else{
														echo pageTag($pageText, false, $i, $contentID);
													}
												}
											}else if($pageContent >= $endMaxRange){
												if($pageText >= $endMaxRange || $pageText <= $startMinRange){
													if($i == $pageContent){
														echo pageTag($pageText, true, $i, $contentID);
													}else{
														echo pageTag($pageText, false, $i, $contentID);
													}
												}
												
											}else{
												if( $pageContent == $i ){
													echo pageTag($pageText, true, $i, $contentID);
												}
											}
										}
									
										if($totalPageNumber > 1){
											if($pageContent < $totalPageNumber - 2 ){
												echo pageTag('&#8226;', '','',$contentID);
											}
										}
									}
									
									if($totalPageNumber == ($pageContent + 1)){
										echo pageTag($totalPageNumber, true,($totalPageNumber - 1),$contentID);
										echo '<a><span class="ps-3 pt-2 pe-3 pb-2" >&raquo;</span></a>';
									}else{
										echo pageTag($totalPageNumber, false,($totalPageNumber - 1),$contentID);
										echo '<a href="main-announcements?page='.($pageContent + 1).'&content='.$contentID.'" style="" ><span class="ps-3 pt-2 pe-3 pb-2" >&raquo;</span></a>';
									}
								}
								echo"</div>";
							}
							?>
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
							Related Links
						</div>
					  
						<div class="card-body">
							<div class='list-group' >
								<a href='main-admission' >Admission</a>
								<a href='main-calendar' >Calendar of Activities</a>
								<a href='main-extension' >Extension</a>
								<a href='main-program-offers' >Program Offers</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			
		</div>

		
		
		
<?php 
include'assets/template/footer-template.php';
?>
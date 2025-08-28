<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
		<link rel="shortcut icon" href="assets/img/logo-cpsu.png" type="image/x-icon">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
		<title>CPSU Hinigaran Official Website</title>
		<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
		<link rel="stylesheet" href="assets/icon/materialdesignicons.min.css">
		<?php include 'public/css.php'; ?>
		
		<script>
        (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s);
            js.id = id;
            js.src = 'https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.11&appId=586757256682127&autoLogAppEvents=1';
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
		
		function fbShare(url, title) {
			var shareUrl = 'https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent(url) + '&t=' + encodeURIComponent(title);
			window.open(shareUrl, '_blank');
		}
		
		function twShare(url, title) {
			var shareUrl = 'https://twitter.com/intent/tweet?url=' + encodeURIComponent(url) + '&text=' + encodeURIComponent(title);
			window.open(shareUrl, '_blank');
		}
		
		function inShare(url, title) {
			var shareUrl = 'https://www.linkedin.com/sharing/share-offsite/?url=' + encodeURIComponent(url);
			window.open(shareUrl, '_blank');
		}
    </script>
	
	</head>

	<body>
		<div class='bg-dark d-flex justify-content-around p-2 small cpsu-contact-info' >
			<a target='_blank' href='https://www.facebook.com/CPSUHinigaran11' class='link-light' >
				<i class='mdi mdi-facebook-box' ></i> Facebook
			</a>
			
			<a href='' class='link-light' >
				<i class='mdi mdi-cellphone-android' ></i> +639173015565
			</a>
			
			<a href='' class='link-light' >
				<i class='mdi mdi-email-outline' ></i>
				cpsu.hinigaran@cpsu.edu.ph
			</a>
			
			<a href='' class='link-light' >
				<i class='mdi mdi-map-marker mt-2' ></i>
				Brgy. Gargato, Hinigaran, Negros Occidental 6106
			</a>
		</div>
			
		<div class='sticky-sm-top navbar-header bg-light d-flex justify-content-around align-items-center p-2 shadow-lg' >
			<div class='d-flex flex-row' >
				<img src="assets/img/logo-cpsu.png" class="img-fluid logo me-2" alt="">
				<img src="assets/img/cpsu.png" class="img-fluid cpsu-logo" alt="">
			</div>
			
			
			
			<div class='nav nav-header' >
				<ul class='less-page-links list-group list-group-horizontal border-0 fw-bold' >
					<a href='main-home' ><li class='border-0 list-group-item text-secondary'>
						Home</li></a>
					<a href='main-about' ><li class='border-0 list-group-item text-secondary'>
						About Us</li></a>
					
					<a class='dropdown'>
						<a class="border-0 list-group-item text-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
							Academics
						</a>

						<ul class='dropdown-menu'>
							<li><a class='dropdown-item' href='main-admission'>Admission</a></li>
							<li><a class='dropdown-item' href='main-program-offers'>Program Offers</a></li>
						</ul>
					</a>
						
						
					<a class='dropdown'>
						<a class="border-0 list-group-item text-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
							Administration
						</a>

						<ul class='dropdown-menu'>
							<li><a class='dropdown-item' href='main-key-official'>Key Official</a></li>
							<li><a class='dropdown-item' href='main-program-chair'>Program Heads</a></li>
							<li><a class='dropdown-item' href='main-faculty'>Faculty</a></li>
							<li><a class='dropdown-item' href='main-administrative-functions'>Administrative Functions</a></li>
						</ul>
					</a>
				</ul>
				
				<div class='more-page-links bg-dark' >
					<center>
						<img src="assets/img/logo-cpsu.png" class="img-fluid" style='height:200px;padding-bottom:50px;' >
					</center>
					<ul class="list-group list-group-flush">
						<a href='main-home' class='bg-dark text-white list-group-item' >Home</a>
						<a href='main-about' class='bg-dark text-white list-group-item' >About Us</a>
						
						<a class='dropdown' >
							<a class="bg-dark text-white list-group-item dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
								Academics
							</a>
							
							<ul class='dropdown-menu'>
								<li><a class='dropdown-item' href='main-admission'>Admission</a></li>
								<li><a class='dropdown-item' href='main-program-offers'>Program Offers</a></li>
							</ul>
						</a>
						
						<a class='dropdown' >
							<a class="bg-dark text-white list-group-item dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
								Administration
							</a>
							
							<ul class='dropdown-menu'>
								<li><a class='dropdown-item' href='main-key-official'>Key Official</a></li>
								<li><a class='dropdown-item' href='main-program-chair'>Program Heads</a></li>
								<li><a class='dropdown-item' href='main-faculty'>Faculty</a></li>
								<li><a class='dropdown-item' href='main-administrative-functions'>Administrative Functions</a></li>
							</ul>
						</a>
						
						<a href='main-extension' class='bg-dark text-white list-group-item' >Extension</a>
						<a href='' class='bg-dark text-white list-group-item' >Linkages</a>
						<a href='' class='bg-dark text-white list-group-item' >Production</a>
						<a href='' class='bg-dark text-white list-group-item' >Research</a>
						<a href='' class='bg-dark text-white list-group-item' >Support</a>
						<a href='' class='bg-dark text-white list-group-item' >Download</a>
						<li class='bg-dark text-white list-group-item small mt-5' >
							<p class='m-0' >&copy  2022-2023 CPSU Hinigaran</p>
							<p class='m-0' >Managed by: MISO & CCS</p>
							<p class='m-0' >Developed by: JLE</p>
						</li>
					</ul>
				</div>
				
				<ul class='list-group list-group-horizontal border-0 fw-bold' >
					<a class='more-page-links-toggle' ><li class='border-0 list-group-item text-secondary'>
						<i class='mdi mdi-menu' ></i></li></a>
				</ul>
			</div>
		</div>
		
		<script>
		$(document).ready(function(){
		  $(".more-page-links-toggle").click(function(){
			
			var morepagelinkdiv = $('.more-page-links');
			var position = morepagelinkdiv.position();
			
			if(position.left == '-300'){
				morepagelinkdiv.css('left', '0px');
			}else{
				morepagelinkdiv.css('left', '-300px');
			}
			
		  });
		});
		</script>
<style>
body{
	font-family: Arial, Helvetica, sans-serif;
}

a{
	text-decoration:none;
	cursor:pointer;
}

.contentimg{
	width:100%;
}

#slide-master{
	background-size: cover;
	background-image:url("assets/img/cpsu--topview.jpg");
	background-position: center -140px;	 
}

.carousel-inner-img{
	display: flex;
	align-items: center;
	height: 500px;
}

.carousel-item-img{
	border: 5px solid #022e09;
}

.carousel-item img {
	height: 400px;
	object-fit: cover;
}


.navbar-header .logo{
	width: 80px;
}

.navbar-header .cpsu-logo{
	width: 200px;
}

.nav-header .more-page-links{
	z-index:10;
	position:fixed;
	top:0px;
	left:-300px;
	bottom:0px;
	padding: 50px 20px 10px 20px;
	box-shadow: 2px 3px 10px rgba(0,0,0,0.5);
	transition: left 1s;
	min-width: 300px;
}

.nav-header .more-page-links .list-group{
	height:400px;
    overflow:auto;
    -webkit-overflow-scrolling: touch;
	padding-bottom:100px;
}


.section-title{
	width:100%;
}

.section-title h1{
	border-left: 6px solid green;
	padding:10px 0px 0px 20px;
	margin: 40px 0px 0px 0px;
	font-size:30px;
}

.section-title p{
	margin: 0px 0px 20px 0px;
	font-size:15px;
}




.news-section .card img{
	height: 200px;
	object-fit: cover;
}

.news-section .card .overlay-more{
	transition: .5s ease;
	opacity: 0;
	position: absolute;
	top: 30%;
	left: 50%;
	transform: translate(-50%, -50%);
	-ms-transform: translate(-50%, -50%)
}

.news-section .card .overlay-more .text{
	border: 1px solid #004708;
	color: #004708;
	font-size: 12px;
	padding: 6px 12px;
	cursor:pointer;
}

.news-section .card .overlay-more .text:hover{
	background-color: #004708;
	color: #fff;
	transition: background-color .5s;
}

.news-section .card:hover img{
	opacity: 0.3;
}

.news-section .card:hover .overlay-more{
	opacity: 1;
}









.announcement-event-section .card img{
	height: 100px;
	width:150px;
	object-fit: cover;
}

.announcement-event-section .card .overlay-more{
	transition: .5s ease;
	opacity: 0;
	position: absolute;
	top: 30%;
	left: 17%;
	transform: translate(-50%, -50%);
	-ms-transform: translate(-50%, -50%)
}

.announcement-event-section .card .overlay-more .text{
	border: 1px solid #004708;
	color: #004708;
	font-size: 12px;
	padding: 6px 12px;
	cursor:pointer;
}

.announcement-event-section .card .overlay-more .text:hover{
	background-color: #004708;
	color: #fff;
	transition: background-color .5s;
}

.announcement-event-section .card:hover img{
	opacity: 0.3;
}

.announcement-event-section .card:hover .overlay-more{
	opacity: 1;
}










/*--------------------------------------------------------------
# Stats section Section
--------------------------------------------------------------*/
.stats-section {
	margin:50px 0px 30px 0px;
	background-image:url('assets/img/cpsubuilding.jpg');
	background-position: center; 
	color:#fff;
}

.stats-overlay {
	background-color: rgb(38, 38, 38, 0.95);
	padding:50px 0px 30px 0px;
}

.stats-section .icon{
	font-size:40px;
	padding:17px;
	margin:10px;
	color:#fff;
	width:50px;
	height:90px;
}

.stats-section .d-flex .total{
	font-size:30px;
	margin:0px;
	font-weight:bold;
}



.vmg-section{
	text-align:center;
}


.key-colleges-section .colleges .card{
	border-style: none solid none none;
	border-width: medium;
	border-radius:0px !important;
}



.key-colleges-section .colleges .card img{
	height:100px;
	width:100px;
}










.location-section{
	background-image: url("https://www.netscribes.com/wp-content/uploads/2019/06/Technology-Watch.jpg");
}

.location-section .location-content{
	background-color: rgb(38, 38, 38, 0.95);
	padding:40px 0px 30px 0px;
}

.location-section .location-content p{
	color:#fff;
	text-indent: 50px;
	line-height: 1.7;
	letter-spacing:2px;
}


.footer-section{
	padding: 40px 0px 40px 0px;
	background-color: rgb(38, 38, 38);
}

.footer-section h1{
	font-size:20px;
	color:#ffffff;
}

.footer-section ul{
	list-style: none;
	padding:0px;
	font-size:15px;
}

.footer-section ul a{
	color:#ffffff;
}

.footer-section ul a:hover{
	color:#018008;
}




@media (max-width: 991px) {

	.cpsu-contact-info {
		display: none !important;
	}
	
	.nav-header .less-page-links{
		display:none !important;
	}
	
	.stats-counter img{
		display:none;
	}
} 







.border-ccs{ border-color: #990099 !important; } .text-ccs{ color: #990099; }

.border-cbm{ border-color: #b30059 !important; } .text-cbm{ color: #b30059; }

.border-coted{ border-color: #000080 !important; } .text-coted{ color: #000080; }

.border-caf{ border-color: #006600 !important; } .text-cas{ color: #006600; }

.border-ccje{ border-color: #732626 !important; } .text-ccje{ color: #732626; }
</style>
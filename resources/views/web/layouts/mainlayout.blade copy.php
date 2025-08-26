<!DOCTYPE html>
<html lang="en">
@include('web.layouts.header')
@include('web.layouts.footer')
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="" />
    <meta name="author" content="" />
    <meta name="robots" content="" />
    
    <!-- DESCRIPTION -->
    <meta name="description" content="CPSU Official Website" />
    
    <!-- FAVICONS ICON ============================================= -->
    <link rel="shortcut icon" href="{{ asset('assets/images/CPSU_L.png')}} " type="image/png">
    
    <!-- PAGE TITLE HERE ============================================= -->
    <title>CPSU || Official Website</title>
    
    <!-- MOBILE SPECIFIC ============================================= -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- All PLUGINS CSS ============================================= -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/assets.css')}}">
    
    <!-- TYPOGRAPHY ============================================= -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/typography.css')}}">
    
    <!-- SHORTCODES ============================================= -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/shortcodes/shortcodes.css')}}">
    
    <!-- STYLESHEETS ============================================= -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
    <link class="skin" rel="stylesheet" type="text/css" href="assets/css/color/color-1.css">
    
    <!-- REVOLUTION SLIDER CSS ============================================= -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/revolution/css/layers.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/revolution/css/settings.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/revolution/css/navigation.css')}}">
    <!-- REVOLUTION SLIDER END -->
    <style>
        /* Your existing styles */
        /* ... */
        .cookie-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5); /* Semi-transparent black */
            z-index: 999; /* Lower z-index than cookie popup */
        }

        .cookie-popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #ffffff;
            padding: 20px;
            border-radius: 5px;
            z-index: 1000; /* Higher z-index than overlay */
        }

		.cookie-content {
			padding: 10px;
			background-color: #ffffff;
			border: 1px solid #ccc;
			border-radius: 8px;
			box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
			display: flex;
			justify-content: space-between;
			align-items: center;
		}

		.cookie-content p {
			margin: 0;
			font-size: 12px;
			color: #8d8d8d;
		}

		.button-group {
			display: flex;
			align-items: center;
		}

		.cookie-popup button,
		.cookie-popup a {
			margin-left: 10px;
			padding: 8px 15px;
			border: none;
			border-radius: 5px;
			cursor: pointer;
			font-size: 10px;
		}
        
		.cookie-popup a {
			border: 1px solid rgb(64, 63, 63);
		}

		.cookie-popup button {
			background-color: #04401f;
			color: #fff;
		}

		.cookie-popup a {
			color: #0e0f0e;
			text-decoration: none;
		}

        .cookie-popup.show {
            display: block;
        }
    </style>
</head>

<body id="bg">
    <div class="page-wraper">
        <!--<div id="loading-icon-bx"></div>-->
        <!-- Header Top ==== -->
        @yield('header')
        <!-- Header Top END ==== -->
    
        <!-- Content -->
        @yield('content')
        <!-- Content END-->
    
        <!-- Footer ==== -->
        @yield('footer')
        <!-- Footer END ==== -->
        <button class="back-to-top fa fa-chevron-up" ></button>
        <div id="cookie-popup" class="cookie-popup">
            <div class="cookie-content">
                <p>This website uses cookies to ensure you get the best experience on our website.</p>
                <div class="button-group">
                    <button onclick="acceptCookies()">Accept</button>
                    <a href="https://cpsu.edu.ph/view-sublink-content/84" target="_blank">Privacy Policy</a>
                </div>
            </div>
        </div>
        <!-- Cookie Overlay -->
        <div class="cookie-overlay"></div>
    </div>

    @if(request('page') !== null)
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var latestUpdatesElement = document.querySelector(".latest-updates");
            if (latestUpdatesElement) {
                latestUpdatesElement.scrollIntoView({ behavior: "smooth" });
            }
        });
    </script>
    @endif
    <!-- External JavaScripts -->
    <script src="{{ asset('assets/js/jquery.min.js')}}"></script>
    <script src="{{ asset('assets/vendors/bootstrap/js/popper.min.js')}}"></script>
    <script src="{{ asset('assets/vendors/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{ asset('assets/vendors/bootstrap-select/bootstrap-select.min.js')}}"></script>
    <script src="{{ asset('assets/vendors/bootstrap-touchspin/jquery.bootstrap-touchspin.js')}}"></script>
    <script src="{{ asset('assets/vendors/magnific-popup/magnific-popup.js')}}"></script>
    <script src="{{ asset('assets/vendors/counter/waypoints-min.js')}}"></script>
    <script src="{{ asset('assets/vendors/counter/counterup.min.js')}}"></script>
    <script src="{{ asset('assets/vendors/imagesloaded/imagesloaded.js')}}"></script>
    <script src="{{ asset('assets/vendors/masonry/masonry.js')}}"></script>
    <script src="{{ asset('assets/vendors/masonry/filter.js')}}"></script>
    <script src="{{ asset('assets/vendors/owl-carousel/owl.carousel.js')}}"></script>
    <script src="{{ asset('assets/js/functions.js')}}"></script>
    <script src="{{ asset('assets/js/contact.js')}}"></script>
    <!-- <script src='assets/vendors/switcher/switcher.js'></script> -->
    <script>

    document.addEventListener("DOMContentLoaded", function () {
        const cookiePopup = document.getElementById("cookie-popup");
        const cookieOverlay = document.querySelector(".cookie-overlay");

        // Check if the user has already accepted cookies
        if (!localStorage.getItem("cookiesAccepted")) {
            cookiePopup.classList.add("show"); // Show the popup
            cookieOverlay.style.display = "block"; // Show the overlay
        }
    });

    function acceptCookies() {
        const cookiePopup = document.getElementById("cookie-popup");
        const cookieOverlay = document.querySelector(".cookie-overlay");

        // Hide the popup and overlay
        cookiePopup.classList.remove("show");
        cookieOverlay.style.display = "none";

        // Set a flag to remember that the user accepted cookies
        localStorage.setItem("cookiesAccepted", "true");
    }

    </script>
</body>
</html>

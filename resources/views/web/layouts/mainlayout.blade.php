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
    
    <!-- DESCRIPTION -->
    <title>CPSU</title>

    <!--====== Favicon Icon ======-->
    <link rel="shortcut icon" href="{{ asset('images/cpsu-logo.png') }}" type="image/png">
        
    <!--====== Slick css ======-->
    <link rel="stylesheet" href="{{ asset('css/slick.css') }}">

    <!--====== Animate css ======-->
    <link rel="stylesheet" href="{{ asset('css/animate.css') }}">

    <!--====== Nice Select css ======-->
    <link rel="stylesheet" href="{{ asset('css/nice-select.css') }}">

    <!--====== Nice Number css ======-->
    <link rel="stylesheet" href="{{ asset('css/jquery.nice-number.min.css') }}">

    <!--====== Magnific Popup css ======-->
    <link rel="stylesheet" href="{{ asset('css/magnific-popup.css') }}">

    <!--====== Bootstrap css ======-->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">

    <!--====== Fontawesome css ======-->
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">

    <!--====== Default css ======-->
    <link rel="stylesheet" href="{{ asset('css/default.css') }}">

    <!--====== Style css ======-->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <!--====== Responsive css ======-->
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">

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
    <!--====== FOOTER PART ENDS ======-->

    <!--====== BACK TO TOP PART START ======-->
    <a href="#" class="back-to-top"><i class="fa fa-angle-up"></i></a>
    <!--====== BACK TO TOP PART ENDS ======-->

    <!--====== jquery js ======-->
    <script src="{{ asset('js/vendor/modernizr-3.6.0.min.js') }}"></script>
    <script src="{{ asset('js/vendor/jquery-1.12.4.min.js') }}"></script>

    <!--====== Bootstrap js ======-->
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>

    <!--====== Slick js ======-->
    <script src="{{ asset('js/slick.min.js') }}"></script>

    <!--====== Magnific Popup js ======-->
    <script src="{{ asset('js/jquery.magnific-popup.min.js') }}"></script>

    <!--====== Counter Up js ======-->
    <script src="{{ asset('js/waypoints.min.js') }}"></script>
    <script src="{{ asset('js/jquery.counterup.min.js') }}"></script>

    <!--====== Nice Select js ======-->
    <script src="{{ asset('js/jquery.nice-select.min.js') }}"></script>

    <!--====== Nice Number js ======-->
    <script src="{{ asset('js/jquery.nice-number.min.js') }}"></script>

    <!--====== Count Down js ======-->
    <script src="{{ asset('js/jquery.countdown.min.js') }}"></script>

    <!--====== Validator js ======-->
    <script src="{{ asset('js/validator.min.js') }}"></script>

    <!--====== Ajax Contact js ======-->
    <script src="{{ asset('js/ajax-contact.js') }}"></script>

    <!--====== Main js ======-->
    <script src="{{ asset('js/main.js') }}"></script>

    <!--====== Map js ======-->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDC3Ip9iVC0nIxC6V14CKLQ1HZNF_65qEQ"></script>
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
    <script>
        $(document).ready(function () {
            var $slider = $('.slider-active');
            var hasIntro = $slider.find('.slider-intro').length > 0;

            $slider.slick({
                autoplay: !hasIntro,          // Off if intro exists
                autoplaySpeed: 1000,         // 1 second for normal slides
                arrows: false,
                fade: false,                 // Needed for drag/swipe
                speed: 800,
                pauseOnHover: false,
                pauseOnFocus: false,
                draggable: true,
                swipe: true,
                touchThreshold: 5,
                infinite: true
            });

            if (hasIntro) {
                setTimeout(function () {
                    $slider.slick('slickNext'); // Move to slide 2
                    $slider.slick('slickSetOption', 'autoplay', true, true); // Start 1s autoplay
                }, 120000); // 2 minutes
            }
        });
    </script>
    
</body>
</html>

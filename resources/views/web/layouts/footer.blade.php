@section('footer')
<footer id="footer-part">
    <div class="footer-top pt-40 pb-70">
        <div class="container">
            <div class="row">
                <!-- About -->
                <div class="col-4 col-md-4 col-lg-4">
                    <div class="footer-about mt-30">
                        <div class="logo">
                            <a href="#"><img src="{{ asset('images/logo-header.png') }}" alt="Logo"></a>
                        </div>
                        <p>
                            <b>Central Philippines State University (CPSU)</b> <br>
                            <span style="color: #fff; font-size: 13px; line-height: 1.6;">
                                is a catalyst for change in Negros Occidental empowering communities through innovation, education, and agriculture. With 10 ISO-accredited campuses, CPSU transforms local potential into lasting impact.
                            </span>
                        </p>
                        <ul class="mt-20">
                            <li><a href="#"><i class="fa fa-facebook-f"></i></a></li>
                            <li><a href="#"><i class="fa fa-youtube"></i></a></li>
                        </ul>
                    </div>
                </div>

                <!-- Support -->
                <div class="col-4 col-md-4 col-lg-4">
                    <div class="footer-link support mt-40">
                        <div class="footer-title pb-25">
                            <h6>Support</h6>
                        </div>
                        <ul>
                            <li><a href="https://cpsu.edu.ph/sublink/84"><i class="fa fa-angle-right"></i>Privacy Policy</a></li>
                            <li><a href="#"><i class="fa fa-angle-right"></i>Support</a></li>
                        </ul>
                    </div>
                </div>

                <!-- Contact -->
                <div class="col-4 col-md-4 col-lg-4">
                    <div class="footer-address mt-40">
                        <div class="footer-title pb-25">
                            <h6>Contact Us</h6>
                        </div>
                        <ul>
                            <li>
                                <div class="icon">
                                    <i class="fa fa-home"></i>
                                </div>
                                <div class="cont">
                                    <p>Central Philippines State University, Kabankalan City, Negros Occidental</p>
                                </div>
                            </li>
                            <li>
                                <div class="icon">
                                    <i class="fa fa-phone"></i>
                                </div>
                                <div class="cont">
                                    <p>+63 9173 015 565</p>
                                </div>
                            </li>
                            <li>
                                <div class="icon">
                                    <i class="fa fa-envelope-o"></i>
                                </div>
                                <div class="cont">
                                    <p><a href="mailto:cpsu_main@cpsu.edu.ph" class="no-style">cpsu_main@cpsu.edu.ph</a></p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div> <!-- row -->

            <!-- Visitor Stats Row -->
            <div class="row mt-4">
                <div class="col-12 text-center">
                    <p style="margin: 0; color: rgb(236, 233, 233);">
                        Online Visitors: <strong>{{ number_format($onlineVisitors) }}</strong> &nbsp;|&nbsp; 
                        Today's Visitors: <strong>{{ number_format($todaysVisitors) }}</strong> &nbsp;|&nbsp; 
                        Total Page Views: <strong>{{ number_format($totalPageViews) }}</strong>
                    </p>
                </div>
            </div>

        </div> <!-- container-fluid -->
    </div> <!-- footer top -->
</footer>

@endsection

@section('footer')
<footer>
    <div class="footer-top">
        <div class="pt-exebar">
            <div class="container">
                
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-lg-6 col-md-7 col-sm-12">
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="widget footer_widget">
                                <h5 class="footer-title">QUICK LINKS</h5>
                                <ul class="ul-footer">
                                    @foreach ($submenu as $sub)
                                        @if($sub->category == 7)
                                            <li>
                                                <a href="{{ route('view-content', ['id' => $sub->id]) }}">
                                                    <i class="fa fa-chevron-right fs-ico"></i>{{ $sub->title }}
                                                </a>
                                            </li>
                                        @endif
                                    @endforeach
                                    <li><a href="https://mail.google.com/" target="_blank"><i class="fa fa-chevron-right fs-ico"></i>Webmail Access</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="widget footer_widget">
                                <h5 class="footer-title">ACADEMICS</h5>
                                
                                @foreach($category as $cat)
                                    @if($cat->cat_name == "Academic")
                                        <ul class="ul-footer">
                                            @foreach($submenu as $sub)
                                                @if($sub->category == $cat->id)
                                                <li><a href="{{ route('view-content', ['id' => $sub->id]) }}"><i class="fa fa-chevron-right fs-ico"></i> {{ $sub->title }}</a></li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="widget footer_widget">
                                <h5 class="footer-title">GOVERNMENT AGENCY</h5>
                                <ul class="ul-footer">
                                    <li><a href="https://ched.gov.ph/" target="_blank"><i class="fa fa-chevron-right fs-ico"></i> CHED</a></li>
                                    <li><a href="https://aaccup.com/" target="_blank"><i class="fa fa-chevron-right fs-ico"></i> AACCUP</a></li>
                                    <li><a href="https://www.dbm.gov.ph/" target="_blank"><i class="fa fa-chevron-right fs-ico"></i> DBM</a></li>
                                    <li><a href="https://notices.philgeps.gov.ph/"><i class="fa fa-chevron-right fs-ico"></i> PHILGEPS</a></li>
                                    <li><a href="https://privacy.gov.ph/transparency-seal/"><i class="fa fa-chevron-right fs-ico"></i> Transparency Seal</a></li>
                                    <li><a href="https://pasuc.org.ph/"><i class="fa fa-chevron-right fs-ico"></i> PASUC</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="widget footer_widget">
                                <h5 class="footer-title">CONTACT US</h5>
                                <ul class="ul-footer">
                                    <li><a href="javascript:void(0);"><i class="fa fa-chevron-right fs-ico"></i> Brgy. Camingawan, Kabankalan City, Negros Occidental</a></li>
                                    <li><a href="javascript:void(0);"><i class="fa fa-chevron-right fs-ico"></i> Phone: (034) 702-9903</a></li>
                                    <li><a href="javascript:void(0);"><i class="fa fa-chevron-right fs-ico"></i> CP #: +639173015565</a></li>
                                    <li><a href="javascript:void(0);"><i class="fa fa-chevron-right fs-ico"></i> Email: cpsu_main@cpsu.edu.ph</a></li>
                                    <li><a href="https://cpsu.edu.ph/view-sublink-content/84" target="_blank"><i class="fa fa-chevron-right fs-ico"></i> Privacy Policy</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom" style="background-color: #222">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 text-center">© 2023 Central Philippines State University || Maintained by the Management Information System Office (MISO).</div>
                <span style="font-size:8px;" hidden>Layout by:</span><a href="#" rel="nofollow" style="font-size:8px;" hidden>Template Hub</a>
            </div>
        </div>
    </div>
</footer>
@endsection
@extends('web.layouts.mainlayout')
@section('content')
<style>
    body {
        background: #f8f9fa;
    }

    /* Make the row take full height */
    .facilities-wrapper {
    display: flex;
    align-items: stretch; /* makes both columns equal height */
}

   /* Facilities list scroll */
.facility-list {
    width: 280px;       /* fixed width */
    height: 100vh;      /* fixed full height of screen */
    overflow-y: auto;   /* enable scroll inside */
    padding-right: 8px;
    position: sticky;
    top: 0;             /* keep it pinned when scrolling */
    flex-shrink: 0;     /* prevent shrinking in flexbox */
}

    .facility-list .nav-link {
        background: #fff;
        border-radius: 12px;
        margin-bottom: 10px;
        padding: 14px 18px;
        font-weight: 500;
        color: #333;
        box-shadow: 0 3px 6px rgba(0,0,0,0.08);
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        font-size: 16px;
        white-space: nowrap;
    }
    .facility-list .nav-link:hover {
        background: #e6f4ff;
        transform: translateX(4px);
        color: #1f5036;
    }
    .facility-list .nav-link.active {
        background: #1f5036;
        color: #fff !important;
        box-shadow: 0 4px 12px rgba(0,0,0,0.2);
    }

    /* Tab content scroll */
    .tab-content {
    flex: 1;
    height: 100vh;   /* same height as left */
    overflow-y: auto;
    background: #fff;
    border-radius: 12px;
    padding: 30px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}
    .tab-content h3 {
        color: #1f5036;
        font-weight: 700;
        margin-bottom: 15px;
    }
    .tab-content p, .tab-content li {
        font-size: 15px;
        line-height: 1.7;
        color: #555;
    }
    .tab-content ul {
        padding-left: 20px;
    }
    .tab-content ul li {
        margin-bottom: 8px;
        position: relative;
    }
    .tab-content ul li::before {
        content: "•";
        color: #1f5036;
        font-weight: bold;
        display: inline-block;
        width: 1em;
        margin-left: -1em;
    }

    /* Responsive adjustments */
    @media (max-width: 767px) {
        .facilities-wrapper {
            flex-direction: column;
            height: auto;
        }
        .facility-list {
            max-height: 200px;
            overflow-y: auto;
        }
    }

    .facility-img .gallery {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
    gap: 10px;
}

.facility-img .gallery img {
    width: 100%;
    height: 100px;
    object-fit: cover;
    border-radius: 10px;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    cursor: pointer;
}

.facility-img .gallery img:hover {
    transform: scale(1.05);
    box-shadow: 0 4px 12px rgba(0,0,0,0.2);
}
</style>

<div class="container py-5">
    <div class="row">
        <!-- Facilities list -->
        <div class="col-md-4 facility-list">
            <ul class="nav flex-column nav-pills" id="facilityList" role="tablist">
                <li class="nav-item"><a class="nav-link active" data-toggle="pill" href="#cafeteria">🍴 Cafeteria/Restaurant</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="pill" href="#bookstore">📚 Bookstore</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="pill" href="#socialrooms">🏛️ Social Rooms</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="pill" href="#supportcenter">🤝 Support Center</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="pill" href="#religious">⛪ Religious Facilities</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="pill" href="#techclass">💻 Technology in the Classroom</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="pill" href="#Library"><i class="fa fa-book"></i>&nbsp;&nbsp;Library</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="pill" href="#printing">🖨️ Printing Services</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="pill" href="#audiovisual">🎥 AV Equipment Rooms</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="pill" href="#labs">🔬 Laboratories</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="pill" href="#Internet"> <i class="fa fa-wifi"></i> &nbsp;&nbsp;Coworking and Meeting Spaces with Internet Access</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="pill" href="#MDHU">⚕️ CPSU Medical-Dental Health Unit</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="pill" href="#Sports">🏀Sports Facilities </a></li>
            </ul>
        </div>

        <!-- Facilities content -->
        <div class="col-md-8">
            <div class="tab-content">
                <div class="tab-pane fade show active" id="cafeteria">
                    <h3> Cafeteria/Restaurant</h3>
                    <p>According to Abraham Maslow’s Hierarchy of Needs, requisites for human survival must be satisfied before higher requisites can be met. His five-tier triangular model cites physiological needs in the base. The university is committed to providing students with affordable yet safe and healthy food options via its cafeteria. With the relaxing sound of the water stream gushing nearby, students, faculty, staff, and stakeholders can enjoy diverse variety of local delicacies, street food, and drinks like coffee and iced teas to meet their basic food necessities. CPSU’s cafeteria showcases food options that reflect the Filipino country-side food culture. </p>
              
                         <div class="facility-img">
                                    <div class="gallery-grid">
                                     <a target="_blank" href="{{ asset('images/cafeteria1.jpg') }}"><img src="{{ asset('images/cafeteria1.jpg') }}" alt="cafeteria 1"></a>
                                    <a target="_blank" href="{{ asset('images/cafeteria2.jpg') }}"><img src="{{ asset('images/cafeteria2.jpg') }}" alt="cafeteria 2"></a>
                                    <a target="_blank" href="{{ asset('images/cafeteria3.jpg') }}"><img src="{{ asset('images/cafeteria3.jpg') }}" alt="cafeteria 3"></a>
                                    <a target="_blank" href="{{ asset('images/cafeteria4.jpg') }}"><img src="{{ asset('images/cafeteria4.jpg') }}" alt="cafeteria 4"></a>
                                    <a target="_blank" href="{{ asset('images/cafeteria5.jpg') }}"><img src="{{ asset('images/cafeteria5.jpg') }}" alt="cafeteria 5"></a>
                                    </div>
                        </div>
                </div>
                            
                <div class="tab-pane fade" id="bookstore">
                    <h3> Bookstore</h3>
                    <p>Central Philippines State University is located nineteen kilometers away from the business district within the City of Kabankalan. Bookstores are typically found in the metropolitan area which is accessible to stakeholders by multiple means of transportation i.e. bus, jeepney, and tricycle. Apart from that, the University’s library welcomes stakeholders and visitors, offering an array of references and media from diverse fields. Accommodating library staff provides clients with assistance in sourcing the references and other learning materials that they need. </p>
                         
                </div>
                <div class="tab-pane fade" id="socialrooms">
                            <h3>Social Rooms</h3>
                            <p>
                                Given the Philippines’ tropical climate with humid and warm dry seasons, open-air venues are not always ideal for university activities. To address this, the Accreditation Center, Mount Ballo Hall, and the Research Development and Extension Center Conference Room are fully air-conditioned and equipped with modern audio-visual systems. Comfortable seating ensures an optimal environment for both learning and social interaction.
                            </p>
                            <p>
                                The university recognizes the importance of social gathering spaces that can host diverse events. These venues are designed to prioritize attendee comfort, support event objectives, and foster a strong sense of community among students, faculty, and visitors.
                            </p>

                            <div class="facility-img">
                                <div class="gallery-grid">
                                    <a target="_blank" href="{{ asset('images/socialroom1.jpg') }}"><img src="{{ asset('images/socialroom1.jpg') }}" alt="Social Room 1"></a>
                                    <a target="_blank" href="{{ asset('images/socialroom2.jpg') }}"><img src="{{ asset('images/socialroom2.jpg') }}" alt="Social Room 2"></a>
                                    <a target="_blank" href="{{ asset('images/socialroom3.jpg') }}"><img src="{{ asset('images/socialroom3.jpg') }}" alt="Social Room 3"></a>
                                    <a target="_blank" href="{{ asset('images/socialroom4.jpg') }}"><img src="{{ asset('images/socialroom4.jpg') }}" alt="Social Room 4"></a>
                                    <a target="_blank" href="{{ asset('images/socialroom5.jpg') }}"><img src="{{ asset('images/socialroom5.jpg') }}" alt="Social Room 5"></a>
                                    <a target="_blank" href="{{ asset('images/socialroom6.jpg') }}"><img src="{{ asset('images/socialroom6.jpg') }}" alt="Social Room 6"></a>
                                </div>
                            </div>
                        </div>
                <div class="tab-pane fade" id="supportcenter">
                    <h3> Support Center for Minority Groups</h3>
                    <p>The Office of Student Services and Affairs has advocated the zeal of the student populace. Nevertheless, it has not only looked out for the welfare of the majority group of the body but is also a stronghold for support over the minority groups thriving in the University. 

                    The archipelagic structure of the country has cultivated rich cultural diversities and other political differences among Filipinos. With CPSU being a melting pot of the majority and minority groups in and beyond Negros Island, it recognizes the need for a safe space to ensure that these minorities can be heard and supported. 

                    The Office of Student Services and Affairs is a stronghold for the entirety of the student body, and with utmost care, functions as a physical, emotional, and psychological support center. Manned by licensed professionals with safe venues for consultations and group get-togethers, members from cultural, ethnic, and social minority groups are welcomed in the OSSA office. </p>
                </div>
                <div class="tab-pane fade" id="religious">
                    <h3> Religious Facilities</h3>
                    <p>The university’s chapel is situated in the university’s horseshoe park, which is an uphill area with an overlooking view of the city’s agricultural fields in the distance. The topography allows a short pilgrimage, modeled after significant religious events pilgrimages. 

                        Surrounded by trees and shrubs, solemn catholic masses are held from time to time in the facility. Welded steel materials were used as walls in the construction of the chapel, allowing visitors to see the vegetation outside and to have a meditative experience with nature.  

                        Behind the chapel, is the “CPSU Legacy Park” which houses flora and fauna protected by the university and can accommodate for more spiritual activities even overnight camps.</p>
                 <div class="facility-img">
                                <div class="gallery-grid">
                                    <a target="_blank" href="{{ asset('images/religious1.jpg') }}"><img src="{{ asset('images/religious1.jpg') }}" alt="religious 1"></a>
                                    <a target="_blank" href="{{ asset('images/religious2.jpg') }}"><img src="{{ asset('images/religious2.jpg') }}" alt="religious2"></a>
                                </div>
                 </div>
                    </div>
                <div class="tab-pane fade" id="techclass">
                    <h3> Technology in the Classroom</h3>
                    <ul>
                        <li>Computer-equipped teaching spaces</li>
                        <li>Modern audiovisual systems</li>
                        <li>Specialized laboratories</li>
                        <li>Speech and Criminal Justice Labs</li>
                    </ul>
                </div>
                <div class="tab-pane fade" id="Library">
                    <h3>  Library</h3>
                    <p>Established and nestled in the rich and biodiverse countryside of Negros Occidental, the University and its stakeholders enjoy a slow-paced and serene way of life far from the buzzing noise of commerce in the metro. With limited business establishments offering printing services, the CPSU Library and Office of Student Services and Affairs (OSSA) free printing services for students in need.  </p>
                         <div class="facility-img">
                                <div class="gallery-grid">
                                    <a target="_blank" href="{{ asset('images/lib 1.jpg') }}"><img src="{{ asset('images/lib 1.jpg') }}" alt="lib 1"></a>
                                    <a target="_blank" href="{{ asset('images/lib 2.jpg') }}"><img src="{{ asset('images/lib 2.jpg') }}" alt="lib 2"></a>
                                </div>
                         </div>
                </div>
                <div class="tab-pane fade" id="printing">
                    <h3> Printing Services</h3>
                    <p>The University understands that its students come from different backgrounds and thus experience diverse challenges. The free printing services its offices offer aim to address the needs of students who lack access to printing technology, encouraging them to stay resilient by providing ample support in their studies.</p>
                    <div class="facility-img ">
                                <div class="gallery-grid gallery-grid four-photos">
                                    <a target="_blank" href="{{ asset('images/print1.jpg') }}"><img src="{{ asset('images/print1.jpg') }}" alt="print 1"></a>
                                    <a target="_blank" href="{{ asset('images/print2.jpg') }}"><img src="{{ asset('images/print2.jpg') }}" alt="print 2"></a>
                                    <a target="_blank" href="{{ asset('images/print3.jpg') }}"><img src="{{ asset('images/print3.jpg') }}" alt="print 3"></a>
                                    <a target="_blank" href="{{ asset('images/print4.jpg') }}"><img src="{{ asset('images/print4.jpg') }}" alt="print 4"></a>
                                </div>
                         </div>
               
                </div>
                <div class="tab-pane fade" id="audiovisual">
                    <h3> Teaching Spaces with AV Equipment</h3>
                    <p>Central Philippines State University’s faculty incorporate different teaching strategies and use various teaching materials in their lectures to provide students with the best learning experiences. The university provides professors and instructors teaching spaces with modern audiovisual equipment to maximize the use of their teaching materials, especially those that appeal to multiple senses. 

                        Conducive teaching-learning spaces were constructed in the university to ensure student comfort during lectures. These dedicated spaces also help teachers in their class preparations as non-dedicated spaces that a significant amount of time to set-up and repurpose. 
                    </p>
                    <div class="facility-img ">
                                <div class="gallery-grid gallery-grid four-photos">
                                    <a target="_blank" href="{{ asset('images/av1.jpg') }}"><img src="{{ asset('images/av1.jpg') }}" alt="av 1"></a>
                                    <a target="_blank" href="{{ asset('images/av2.jpg') }}"><img src="{{ asset('images/av2.jpg') }}" alt="pav 2"></a>
                                    <a target="_blank" href="{{ asset('images/av3.jpg') }}"><img src="{{ asset('images/av3.jpg') }}" alt="av 3"></a>
                                    <a target="_blank" href="{{ asset('images/av4.jpg') }}"><img src="{{ asset('images/av4.jpg') }}" alt="av 4"></a>
                                </div>
                         </div>
                </div>
                <div class="tab-pane fade" id="labs">
                                    <h3>Laboratories</h3>
                                    <p>
                                        Central Philippines State University provides students with state-of-the-art laboratories across various disciplines. These labs are equipped with modern technologies and tools, giving students authentic and transformative learning experiences that prepare them for real-world challenges in their respective fields.
                                    </p>

                                    <ul class="labs-list">

                                        <!-- Agriculture Lab -->
                                        <li class="lab-item">
                                            <div class="facility-content">
                                                <div class="facility-text">
                                                    <h4>🌾 <b>Agriculture Laboratory</b></h4>
                                                </div>
                                                <div class="facility-img">
                                                    <div class="gallery lightgallery">
                                                        <a target="_blank" href="{{ asset('images/agri1.jpg') }}"><img src="{{ asset('images/agri1.jpg') }}" alt="Agriculture Lab 1"></a>
                                                        <a target="_blank" href="{{ asset('images/agri2.jpg') }}"><img src="{{ asset('images/agri2.jpg') }}" alt="Agriculture Lab 2"></a>
                                                        <a target="_blank" href="{{ asset('images/agri3.jpg') }}"><img src="{{ asset('images/agri3.jpg') }}" alt="Agriculture Lab 3"></a>
                                                        <a target="_blank" href="{{ asset('images/agri4.jpg') }}"><img src="{{ asset('images/agri4.jpg') }}" alt="Agriculture Lab 4"></a>
                                                        <a target="_blank" href="{{ asset('images/agri5.jpg') }}"><img src="{{ asset('images/agri5.jpg') }}" alt="Agriculture Lab 5"></a>
                                                        <a target="_blank" href="{{ asset('images/agri6.jpg') }}"><img src="{{ asset('images/agri6.jpg') }}" alt="Agriculture Lab 6"></a>
                                                        <a target="_blank" href="{{ asset('images/agri7.jpg') }}"><img src="{{ asset('images/agri7.jpg') }}" alt="Agriculture Lab 7"></a>
                                                        <a target="_blank" href="{{ asset('images/agri8.jpg') }}"><img src="{{ asset('images/agri8.jpg') }}" alt="Agriculture Lab 8"></a>
                                                        <a target="_blank" href="{{ asset('images/agri9.jpg') }}"><img src="{{ asset('images/agri9.jpg') }}" alt="Agriculture Lab 9"></a>
                                                        <a target="_blank" href="{{ asset('images/agri10.jpg') }}"><img src="{{ asset('images/agri10.jpg') }}" alt="Agriculture Lab 10"></a>
                                                        <a target="_blank" href="{{ asset('images/agri11.jpg') }}"><img src="{{ asset('images/agri11.jpg') }}" alt="Agriculture Lab 11"></a>
                                                        <a target="_blank" href="{{ asset('images/agri12.jpg') }}"><img src="{{ asset('images/agri12.jpg') }}" alt="Agriculture Lab 12"></a>
                                                        <a target="_blank" href="{{ asset('images/agri13.jpg') }}"><img src="{{ asset('images/agri13.jpg') }}" alt="Agriculture Lab 13"></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>

                                        <!-- Criminology Lab -->
                                        <li class="lab-item">
                                            <div class="facility-content">
                                                <div class="facility-text">
                                                    <h4>🕵️‍♂️ <b>Criminology Laboratory</b></h4>
                                                </div>
                                                <div class="facility-img">
                                                    <div class="gallery lightgallery">
                                                        <a target="_blank" href="{{ asset('images/crim1.jpg') }}"><img src="{{ asset('images/crim1.jpg') }}" alt="Criminology Lab 1"></a>
                                                        <a target="_blank" href="{{ asset('images/crim2.jpg') }}"><img src="{{ asset('images/crim2.jpg') }}" alt="Criminology Lab 2"></a>
                                                        <a target="_blank" href="{{ asset('images/crim3.jpg') }}"><img src="{{ asset('images/crim3.jpg') }}" alt="Criminology Lab 3"></a>
                                                        <a target="_blank" href="{{ asset('images/crim4.jpg') }}"><img src="{{ asset('images/crim4.jpg') }}" alt="Criminology Lab 4"></a>
                                                        <a target="_blank" href="{{ asset('images/crim5.jpg') }}"><img src="{{ asset('images/crim5.jpg') }}" alt="Criminology Lab 5"></a>
                                                        <a target="_blank" href="{{ asset('images/crim6.jpg') }}"><img src="{{ asset('images/crim6.jpg') }}" alt="Criminology Lab 6"></a>
                                                        <a target="_blank" href="{{ asset('images/crim7.jpg') }}"><img src="{{ asset('images/crim7.jpg') }}" alt="Criminology Lab 7"></a>
                                                        <a target="_blank" href="{{ asset('images/crim8.jpg') }}"><img src="{{ asset('images/crim8.jpg') }}" alt="Criminology Lab 8"></a>
                                                        <a target="_blank" href="{{ asset('images/crim9.jpg') }}"><img src="{{ asset('images/crim9.jpg') }}" alt="Criminology Lab 9"></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>

                                        <!-- Engineering Lab -->
                                        <li class="lab-item">
                                            <div class="facility-content">
                                                <div class="facility-text">
                                                    <h4>⚙️ <b>Engineering Laboratory</b></h4>
                                                </div>
                                                <div class="facility-img">
                                                    <div class="gallery lightgallery">
                                                        <a target="_blank" href="{{ asset('images/eng1.jpg') }}"><img src="{{ asset('images/eng1.jpg') }}" alt="Engineering Lab 1"></a>
                                                        <a target="_blank" href="{{ asset('images/eng4.jpg') }}"><img src="{{ asset('images/eng4.jpg') }}" alt="Engineering Lab 4"></a>
                                                        <a target="_blank" href="{{ asset('images/eng5.jpg') }}"><img src="{{ asset('images/eng5.jpg') }}" alt="Engineering Lab 5"></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>

                                        <!-- Science Lab -->
                                        <li class="lab-item">
                                            <div class="facility-content">
                                                <div class="facility-text">
                                                    <h4>🔬 <b>Science Laboratory</b></h4>
                                                </div>
                                                <div class="facility-img">
                                                    <div class="gallery lightgallery">
                                                        <a target="_blank" href="{{ asset('images/science1.jpg') }}"><img src="{{ asset('images/science1.jpg') }}" alt="Science Lab 1"></a>
                                                        <a target="_blank" href="{{ asset('images/science2.jpg') }}"><img src="{{ asset('images/science2.jpg') }}" alt="Science Lab 2"></a>

                                                    </div>
                                                </div>
                                            </div>
                                        </li>

                                        <!-- Speech Lab -->
                                        <li class="lab-item">
                                            <div class="facility-content">
                                                <div class="facility-text">
                                                    <h4>🗣️ <b>Speech Laboratory</b></h4>
                                                </div>
                                                <div class="facility-img">
                                                    <div class="gallery lightgallery">
                                                        <a target="_blank" href="{{ asset('images/speech1.jpg') }}"><img src="{{ asset('images/speech1.jpg') }}" alt="Speech Lab 1"></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>

                                    </ul>
                                </div>

                <div class="tab-pane fade" id="Internet">
                    <h3> Coworking and Meeting Spaces with Internet Access</h3>
                    <p>In the advent of digital technology where education has somehow migrated to cyberspace, the university is helping students adapt by providing free internet connectivity within the campus.  

                            The Free Wireless Fidelity (WiFi) features of CPSU are strategically installed in areas where they can still connect to nature and the community. Green areas with benches are used by students as communal spaces for work and meetings—helping them overcome the physical and social isolation that comes with increased digitalization. 

                            Under the decades-old trees, the youth can lounge and meet with their schoolmates for their projects, and other collaborative endeavors in a lax mood to recuperate despite their workloads.</p>
                        <div class="facility-img ">
                                <div class="gallery-grid gallery-grid four-photos">
                                    <a target="_blank" href="{{ asset('images/wifi1.jpg') }}"><img src="{{ asset('images/wifi1.jpg') }}" alt="wifi 1"></a>
                                    <a target="_blank" href="{{ asset('images/wifi2.jpg') }}"><img src="{{ asset('images/wifi2.jpg') }}" alt="wifi 2"></a>
                                    <a target="_blank" href="{{ asset('images/wifi3.jpg') }}"><img src="{{ asset('images/wifi3.jpg') }}" alt="wifi 3"></a>
                                    <a target="_blank" href="{{ asset('images/wifi4.jpg') }}"><img src="{{ asset('images/wifi4.jpg') }}" alt="wifi 4"></a>
                                </div>
                         </div>
                        </div>
                <div class="tab-pane fade" id="MDHU">
                    <h3>CPSU Medical-Dental Health Unit</h3>
                    <p>The University Clinic is equipped with numerous equipment and tools to provide efficient and effective medical and dental health services for its Cenphilian clientele.  

                        It has diagnostic equipment like BP Apparatus, Blood Glucose Monitoring Set, etc. which help assess the needs of the patients. The clinic also has a dental chair which is auxiliary for health unit personnel to provide various dental services to the community. 

                        In addition, the University Clinic also has emergency and life-saving equipment like oxygen tanks, Oropharyngeal airways, nebulizers, etc. for quick and effective emergency and crisis response. Emergency medicines can also be administered by qualified medical professionals who safeguard the medical and dental health of Cenphilians. 

                        Other health services offered in the facility are free consultation, free medicines, referrals, and more including free HIV testing which will be available soon. </p>
                <div class="facility-img ">
                                <div class="gallery-grid">
                                    <a target="_blank" href="{{ asset('images/mdhu1.jpg') }}"><img src="{{ asset('images/mdhu1.jpg') }}" alt="mdhu 1"></a>
                                    <a target="_blank" href="{{ asset('images/mdhu2.jpg') }}"><img src="{{ asset('images/mdhu2.jpg') }}" alt="mdhu 2"></a>
                                    <a target="_blank" href="{{ asset('images/mdhu3.jpg') }}"><img src="{{ asset('images/mdhu3.jpg') }}" alt="mdhu 3"></a>
                                 </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="Sports">
                    <h3>Sports Facilities</h3>
                    <ul class="sports-list">

                        <!-- Swimming Pool -->
                        <li class="sports-item">
                            <div class="facility-content">
                                <div class="facility-text">
                                    <h4>🏊 <b>Swimming Pool</b></h4>
                                    <p>Central Philippines State University’s undergraduate curriculum includes “Swimming” as an integral component for the kinesthetic development of its students. The university has a standard Olympic-sized swimming pool with a dimension of 165 feet (length) by 56 feet (width) that can accommodate the university’s undergraduate swimming lessons. A freshwater stream from the uplands within the CPSU reserve provides the pool with a sufficient, clean, and free-flowing water supply for its operation.</p>
                                    <p>In addition to being a part of its academic compliance, the swimming pool is also a key facility in honing co-curricular activities for students particularly students who are gifted with kinesthetic intelligence, providing athletes with more flexible options for their training regimen.</p>
                                    <p>Moreover, students also use the facility for their personal swimming exercises and as a recreational site as they bond with peers and other community members.</p>
                                    <p>The thick vegetation surrounding the pool area is a unique feature that the university is proud of. The cooling effect brought by the collective canopy of trees is a perk enjoyed by Cenphilians for upholding environment-friendly values and nature-preserving culture.</p>
                                </div>
                                <div class="facility-img">
                                    <div class="gallery">
                                        <a target="_blank" href="{{ asset('images/swimming1.jpg') }}"><img src="{{ asset('images/swimming1.jpg') }}" alt="Swimming Pool 1"></a>
                                        <a target="_blank" href="{{ asset('images/swimming2.jpg') }}"><img src="{{ asset('images/swimming2.jpg') }}" alt="Swimming Pool 2"></a>
                                        <a target="_blank" href="{{ asset('images/swimming3.jpg') }}"><img src="{{ asset('images/swimming3.jpg') }}" alt="Swimming Pool 3"></a>
                                     </div>
                                </div>
                            </div>
                        </li>

                        <!-- Fitness Gym -->
                        <li class="sports-item">
                            <div class="facility-content">
                                <div class="facility-text">
                                    <h4>💪 <b>Indoor or Outdoor Fitness Gym</b></h4>
                                    <p>One of the University facilities that cater to the physical exercise and training needs of its community is the “CPSU Fitness Lab” which testifies to the university's belief in the significance of holistic development of an individual.</p>
                                    <p>The equipment accessible in the indoor fitness gym are multifunctional gym equipment, stationary bikes, treadmills, and bench press. Moreover, it also has punching bags, medicine balls, kettlebells, barbells, fixed-weight barbells, dumbbells, hula-hoops, yoga mats, and jumping ropes.</p>
                                    <p>For the university’s students whose bachelor programs and future professions require high physical fitness, the gym is a facility that helps them in their muscle training, adrenaline, breathing technique gain, and stamina training.</p>
                                    <p>Apart from the trained staff actively assisting and on stand-by for gym goers, the Cenphilian collectiveness and unity have cultivated a warm culture of support, acceptance, and positive body image.</p>
                                </div>
                                <div class="facility-img">
                                    <div class="gallery lightgallery">
                                        <a target="_blank" href="{{ asset('images/gym1.jpg') }}"><img src="{{ asset('images/gym1.jpg') }}" alt="Fitness Gym 1"></a>
                                        <a target="_blank" href="{{ asset('images/gym2.jpg') }}"><img src="{{ asset('images/gym2.jpg') }}" alt="Fitness Gym 2"></a>
                                        <a target="_blank" href="{{ asset('images/gym3.jpg') }}"><img src="{{ asset('images/gym3.jpg') }}" alt="Fitness Gym 3"></a>
                                        <a target="_blank" href="{{ asset('images/gym4.jpg') }}"><img src="{{ asset('images/gym4.jpg') }}" alt="Fitness Gym 4"></a>
                                    </div>
                                </div>
                            </div>
                        </li>

                        <!-- Indoor Sports Courts -->
                        <li class="sports-item">
                            <div class="facility-content">
                                <div class="facility-text">
                                    <h4>🏓 <b>Indoor Sports Courts</b></h4>
                                    <p>Apart from the outdoor sports courts and outdoor sports fields that cater to team sports, the university also has indoor sports courts where students can play table tennis as a form of recreation. Cenphilians can access table tennis equipment and enjoy the sport with peers and teachers. The facility is spacious enough for onlookers to observe the ongoing games, fostering a unique synergy from the support of the community members.</p>
                                    <p>In addition, students can also play mental sports like chess on the university’s indoor sports courts. With chess mats and chess pieces available for student and teacher use, the university aims to provide its students with the basics with the hopes of being instrumental to the success of future Filipino chess grandmasters who will raise the university’s banner high in and outside the country.</p>
                                </div>
                                <div class="facility-img">
                                    <div class="gallery lightgallery">
                                        <a target="_blank" href="{{ asset('images/indoor1.jpg') }}"><img src="{{ asset('images/indoor1.jpg') }}" alt="Indoor Court 1"></a>
                                        <a target="_blank" href="{{ asset('images/indoor2.jpg') }}"><img src="{{ asset('images/indoor2.jpg') }}" alt="Indoor Court 2"></a>
                                        <a target="_blank" href="{{ asset('images/indoor3.jpg') }}"><img src="{{ asset('images/indoor3.jpg') }}" alt="Indoor Court 3"></a>
                                        <a target="_blank" href="{{ asset('images/indoor4.jpg') }}"><img src="{{ asset('images/indoor4.jpg') }}" alt="Indoor Court 4"></a>
                                      </div>
                                </div>
                            </div>
                        </li>

                        <!-- Outdoor Sports Courts -->
                        <li class="sports-item">
                            <div class="facility-content">
                                <div class="facility-text">
                                    <h4>🏀 <b>Outdoor Sports Courts</b></h4>
                                    <p>For a basketball and volleyball-crazed country like the Philippines, makeshift outdoor sports courts are a staple in Filipino neighborhoods. Inspired by this concept, Central Philippines State University provides outdoor sports courts for Basketball and Volleyball enthusiasts.</p>
                                    <p>The outdoor sports courts help students unwind from stressful academic activities by being a venue for de-stressing among team sports enthusiasts. It is also a venue for the members of the community to socialize and bond.</p>
                                    <p>Cenphilians spend early mornings and late afternoons engaging in team sports on the outdoor sports courts. The fresh air breezing through players and onlookers creates a lax atmosphere, mimicking laid-back Filipino mornings and afternoons where the community comes together and plays indigenous games.</p>
                                </div>
                               </div>
                        </li>

                        <!-- Outdoor Sports Field -->
                        <li class="sports-item">
                            <div class="facility-content">
                                <div class="facility-text">
                                    <h4>⚽ <b>Outdoor Sports Field</b></h4>
                                    <p>Passing through Abada Avenue and turning left to the Mahogany Avenue of Central Philippines State University, visitors can get a glimpse of the Cenphilian daily life seeing the university’s outdoor sports field.</p>
                                    <p>CPSU’s outdoor sports field can cater to several sports like sprinting events, relays, shotput, and javelin throw for athletic meets. It can also accommodate soccer practices and matches.</p>
                                    <p>Apart from being a sporting event venue, the outdoor sports field is also a venue for community events throughout the year. Bachelor of Science in Criminology students and Reserve Officers' Training Corps cadets conduct their epic field demonstrations.</p>
                                    <p>In addition, Cenphilians also engage in leisure activities like frisbee games, picnics, and more which fosters a tighter sense of community among stakeholders.</p>
                                </div>
                             </div>
                            </div>
                        </li>

                    </ul>
                </div>



            </div>
                        <style>
           .gallery-grid {
    display: grid;
    gap: 10px;
    justify-content: center; /* centers last row */
    grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
}

.gallery-grid img {
    width: 100%;
    height: auto;
    display: block;
    border-radius: 8px;
    object-fit: cover;
}

/* Special case: 4 photos → 2 per row */
.gallery-grid.four-photos {
    grid-template-columns: repeat(2, 1fr);
}

/* Responsive adjustments */
@media (max-width: 992px) {
    .gallery-grid {
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
    }
    .gallery-grid.four-photos {
        grid-template-columns: repeat(2, 1fr); /* still 2 per row */
    }
}

@media (max-width: 576px) {
    .gallery-grid {
        grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
    }
    .gallery-grid.four-photos {
        grid-template-columns: 1fr; /* stack vertically on mobile */
    }
}

            </style>
        </div>
    </div>

</div>
@endsection

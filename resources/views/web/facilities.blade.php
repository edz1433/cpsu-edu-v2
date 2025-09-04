@extends('web.layouts.mainlayout')
@section('content')
<style>
    body {
        background: #f8f9fa;
    }
    .facility-list .nav-link {
        background: #fff;
        border-radius: 10px;
        margin-bottom: 8px;
        padding: 12px 15px;
        font-weight: 500;
        color: #333;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
    }
    .facility-list .nav-link:hover {
        background: #e9f5ff;
        transform: translateX(3px);
    }
    .facility-list .nav-link.active {
        background: #1f5036;
        color: #fff !important;
    }
    .tab-content {
        background: #fff;
        border-radius: 10px;
        padding: 25px;
        box-shadow: 0 3px 8px rgba(0,0,0,0.15);
    }
    h2.section-title {
        text-align: center;
        margin-bottom: 40px;
        font-weight: 700;
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
        <li class="nav-item"><a class="nav-link" data-toggle="pill" href="#supportcenter">🤝 Support Center for Minority Groups</a></li>
        <li class="nav-item"><a class="nav-link" data-toggle="pill" href="#religious">⛪ Religious Facilities</a></li>
        <li class="nav-item"><a class="nav-link" data-toggle="pill" href="#techclass">💻 Technology in the Classroom</a></li>
        <li class="nav-item"><a class="nav-link" data-toggle="pill" href="#printing">🖨️ Printing Services</a></li>
        <li class="nav-item"><a class="nav-link" data-toggle="pill" href="#audiovisual">🎥 Teaching Spaces with Modern AV Equipment</a></li>
        <li class="nav-item"><a class="nav-link" data-toggle="pill" href="#labs">🔬 Laboratories with Specialized Equipment</a></li>
        <li class="nav-item"><a class="nav-link" data-toggle="pill" href="#speechlab">🎤 Speech Laboratory</a></li>
        <li class="nav-item"><a class="nav-link" data-toggle="pill" href="#justice">⚖️ Criminal Justice Laboratory</a></li>
      </ul>
    </div>

    <!-- Facilities content -->
    <div class="col-md-8">
      <div class="tab-content">
        <div class="tab-pane fade show active" id="cafeteria">
          <h3>🍴 Cafeteria/Restaurant</h3>
          <p>According to Abraham Maslow’s Hierarchy of Needs, requisites for human survival must be satisfied before higher requisites can be met. His five-tier triangular model cites physiological needs in the base. The university is committed to providing students with affordable yet safe and healthy food options via its cafeteria. With the relaxing sound of the water stream gushing nearby, students, faculty, staff, and stakeholders can enjoy diverse variety of local delicacies, street food, and drinks like coffee and iced teas to meet their basic food necessities. CPSU’s cafeteria showcases food options that reflect the Filipino country-side food culture.</p>
        </div>
        <div class="tab-pane fade" id="bookstore">
          <h3>📚 Bookstore</h3>
          <p>Central Philippines State University is located nineteen kilometers away from the business district within the City of Kabankalan. Bookstores are typically found in the metropolitan area which is accessible to stakeholders by multiple means of transportation i.e. bus, jeepney, and tricycle. Apart from that, the University’s library welcomes stakeholders and visitors, offering an array of references and media from diverse fields. Accommodating library staff provides clients with assistance in sourcing the references and other learning materials that they need.</p>
        </div>
        <div class="tab-pane fade" id="socialrooms">
          <h3>🏛️ Social Room(s)</h3>
          <p>The Philippines being a tropical country, experiences humid and warm dry seasons which delimits the use of open area mass-gathering facilities as conducive venues for the university’s activities. Taking this into consideration, the Accreditation Center, Mount Ballo Hall, and the Research Development and Extension Center Conference Room, are designed with sufficient air-conditioning to combat rising temperatures brought by the country's natural climate conditions. They are also equipped with audio-visual equipment and designed with comfortable seats to provide learners and visitors with the optimal learning and socializing experiences.</p>
          <p>The university perceives the importance of having social gathering venues to cater to multiple events, prioritizing the comfort of the attendees and attaining the objectives of the events and nurturing the sense of community among stakeholders through providing conducive physical environments.</p>
        </div>
        <div class="tab-pane fade" id="supportcenter">
          <h3>🤝 Support Center for Minority Groups</h3>
          <p>The CPSU Heritage Center has advocated the preservation of the university, the locality, and the country’s tangible and intangible culture. Nevertheless, it has not only looked out for the preservation culture of the majority group of the body but is also a stronghold for support over the minority groups thriving in the University. The archipelagic structure of the country has cultivated rich cultural diversities and other political differences among Filipinos. With CPSU being a melting pot of the majority and minority groups in and beyond Negros Island, it recognizes the need for a safe space to ensure that these minorities can be heard and supported.</p>
        </div>
        <div class="tab-pane fade" id="religious">
          <h3>⛪ Religious Facilities</h3>
          <p>The university’s chapel is situated in the university’s horseshoe park, which is an uphill area with an overlooking view of the city’s agricultural fields in the distance. The topography allows a short pilgrimage, modeled after significant religious events pilgrimages. Surrounded by trees and shrubs, solemn catholic masses are held from time to time in the facility. Welded steel materials were used as walls in the construction of the chapel, allowing visitors to see the vegetation outside and to have a meditative experience with nature. Behind the chapel, is the “CPSU Legacy Park” which houses flora and fauna protected by the university and can accommodate for more spiritual activities even overnight camps.</p>
        </div>
        <div class="tab-pane fade" id="techclass">
          <h3>💻 Technology in the Classroom</h3>
          <ul>
            <li>Computer Equipped Teaching Spaces</li>
            <li>Printing Services</li>
            <li>Teaching Spaces with Modern Audiovisual Equipment</li>
            <li>Laboratories with Specialized Equipment</li>
            <li>Speech Laboratory</li>
            <li>Criminal Justice Laboratory</li>
          </ul>
        </div>
        <div class="tab-pane fade" id="printing">
          <h3>🖨️ Printing Services</h3>
          <p>Established and nestled in the rich and biodiverse countryside of Negros Occidental, the University and its stakeholders enjoy a slow-paced and serene way of life far from the buzzing noise of commerce in the metro. With limited business establishments offering printing services, the CPSU Library and Office of Student Services and Affairs (OSSA) free printing services for students in need.</p>
          <p>The University understands that its students come from different backgrounds and thus experience diverse challenges. The free printing services its offices offer aim to address the needs of students who lack access to printing technology, encouraging them to stay resilient by providing ample support in their studies.</p>
        </div>
        <div class="tab-pane fade" id="audiovisual">
          <h3>🎥 Teaching Spaces with Modern Audiovisual Equipment</h3>
          <p>Central Philippines State University’s faculty incorporate different teaching strategies and use various teaching materials in their lectures to provide students with the best learning experiences. The university provides professors and instructors teaching spaces with modern audiovisual equipment to maximize the use of their teaching materials, especially those that appeal to multiple senses. Conducive teaching-learning spaces were constructed in the university to ensure student comfort during lectures. These dedicated spaces also help teachers in their class preparations as non-dedicated spaces that a significant amount of time to set-up and repurpose.</p>
        </div>
        <div class="tab-pane fade" id="labs">
          <h3>🔬 Laboratories with Specialized Equipment</h3>
          <p>Modern laboratory facilities with specialized equipment are provided to support diverse academic programs, helping students gain hands-on experience in their fields of study.</p>
        </div>
        <div class="tab-pane fade" id="speechlab">
          <h3>🎤 Speech Laboratory</h3>
          <p>The Speech Laboratory is equipped with audio tools and interactive systems to help students improve communication and public speaking skills.</p>
        </div>
        <div class="tab-pane fade" id="justice">
          <h3>⚖️ Criminal Justice Laboratory</h3>
          <p>The Criminal Justice Laboratory provides practical spaces for law and criminology students to simulate and study forensic processes and criminal investigations.</p>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

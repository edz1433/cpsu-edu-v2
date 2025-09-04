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
        min-height: 300px;
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
        <li class="nav-item"><a class="nav-link" data-toggle="pill" href="#supportcenter">🤝 Support Center</a></li>
        <li class="nav-item"><a class="nav-link" data-toggle="pill" href="#religious">⛪ Religious Facilities</a></li>
        <li class="nav-item"><a class="nav-link" data-toggle="pill" href="#techclass">💻 Technology in the Classroom</a></li>
        <li class="nav-item"><a class="nav-link" data-toggle="pill" href="#printing">🖨️ Printing Services</a></li>
        <li class="nav-item"><a class="nav-link" data-toggle="pill" href="#audiovisual">🎥 AV Equipment Rooms</a></li>
        <li class="nav-item"><a class="nav-link" data-toggle="pill" href="#labs">🔬 Laboratories</a></li>
        <li class="nav-item"><a class="nav-link" data-toggle="pill" href="#speechlab">🎤 Speech Lab</a></li>
        <li class="nav-item"><a class="nav-link" data-toggle="pill" href="#justice">⚖️ Criminal Justice Lab</a></li>
      </ul>
    </div>

    <!-- Facilities content -->
    <div class="col-md-8">
      <div class="tab-content">
        <div class="tab-pane fade show active" id="cafeteria">
          <h3>🍴 Cafeteria/Restaurant</h3>
          <p>The university provides students with affordable and healthy food options via its cafeteria. Visitors can enjoy local delicacies, snacks, and beverages in a relaxing environment.</p>
        </div>
        <div class="tab-pane fade" id="bookstore">
          <h3>📚 Bookstore</h3>
          <p>Located within the campus, the bookstore offers a range of academic references, supplies, and other learning resources accessible to students and faculty.</p>
        </div>
        <div class="tab-pane fade" id="socialrooms">
          <h3>🏛️ Social Rooms</h3>
          <p>Air-conditioned and fully equipped social rooms serve as gathering spaces for events, student activities, and community building.</p>
        </div>
        <div class="tab-pane fade" id="supportcenter">
          <h3>🤝 Support Center for Minority Groups</h3>
          <p>A safe space designed to support cultural diversity and provide assistance for minority groups within the university.</p>
        </div>
        <div class="tab-pane fade" id="religious">
          <h3>⛪ Religious Facilities</h3>
          <p>The chapel is located in a serene park area and is used for regular services and spiritual activities.</p>
        </div>
        <div class="tab-pane fade" id="techclass">
          <h3>💻 Technology in the Classroom</h3>
          <ul>
            <li>Computer-equipped teaching spaces</li>
            <li>Modern audiovisual systems</li>
            <li>Specialized laboratories</li>
            <li>Speech and Criminal Justice Labs</li>
          </ul>
        </div>
        <div class="tab-pane fade" id="printing">
          <h3>🖨️ Printing Services</h3>
          <p>The university library and student services office provide free and affordable printing services to students.</p>
        </div>
        <div class="tab-pane fade" id="audiovisual">
          <h3>🎥 Teaching Spaces with AV Equipment</h3>
          <p>Lecture halls are equipped with modern audiovisual tools to enhance teaching and learning experiences.</p>
        </div>
        <div class="tab-pane fade" id="labs">
          <h3>🔬 Laboratories</h3>
          <p>Well-equipped laboratories are provided for hands-on learning across science and technology disciplines.</p>
        </div>
        <div class="tab-pane fade" id="speechlab">
          <h3>🎤 Speech Laboratory</h3>
          <p>The speech lab is designed with interactive systems to improve communication and public speaking skills.</p>
        </div>
        <div class="tab-pane fade" id="justice">
          <h3>⚖️ Criminal Justice Laboratory</h3>
          <p>Provides practical training spaces for law and criminology students, simulating real-world scenarios.</p>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

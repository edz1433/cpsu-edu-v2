@extends('web.layouts.mainlayout')
@section('content')

<div class="container my-5">
    <div class="text-center mb-5">
        <h1 class="fw-bold" style="color:#1f5036;">🎓 Undergraduate Programs</h1>
        <p class="text-muted">Explore the wide range of undergraduate programs offered across different colleges at <strong>CPSU</strong>. Hover on each program to learn more.</p>
    </div>

    <div class="row g-4">
        <!-- College of Teacher Education -->
        <div class="col-md-6 col-lg-4">
            <div class="program-card shadow-sm border-0 rounded-4">
                <img src="{{ asset('images/COTEd.jpg') }}" class="card-img-top rounded-top-4" alt="Teacher Education">
                <div class="program-info">
                    <h5 class="fw-bold text-light">College of Teacher Education</h5>
                </div>
                <div class="program-overlay">
                    <h6 class="fw-bold text-light">Programs:</h6>
                    <ul class="list-unstyled small mb-0">
                        <li class="text-success">Bachelor of Elementary Education</li>
                        <li class="text-success">Bachelor of Physical Education</li>
                        <li class="text-success">Bachelor of Early Childhood Education</li>
                        <li class="text-success">Bachelor of Secondary Education major in English</li>
                        <li class="text-success">Bachelor of Secondary Education major in Filipino</li>
                        <li class="text-success">Bachelor of Secondary Education major in Mathematics</li>
                        <li class="text-success">Bachelor of Secondary Education major in Science</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- College of Agriculture and Forestry -->
        <div class="col-md-6 col-lg-4">
            <div class="program-card shadow-sm border-0 rounded-4">
                <img src="{{ asset('images/CAF-2.jpg') }}" class="card-img-top rounded-top-4" alt="Agriculture">
                <div class="program-info">
                    <h5 class="fw-bold text-light">College of Agriculture & Forestry</h5>
                </div>
                <div class="program-overlay">
                    <h6 class="fw-bold text-light">Programs:</h6>
                    <ul class="list-unstyled small mb-0">
                        <li class="text-success">Bachelor of Science in Agriculture</li>
                        <li class="text-success">Bachelor of Science in Animal Science</li>
                        <li class="text-success">Bachelor of Science in Agribusiness</li>
                        <li class="text-success">Bachelor of Science in Forestry</li>
                        <li class="text-success">Bachelor of Science in Sugar Technology</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- College of Arts and Sciences -->
        <div class="col-md-6 col-lg-4">
            <div class="program-card shadow-sm border-0 rounded-4">
                <img src="{{ asset('images/CAS.jpg') }}" class="card-img-top rounded-top-4" alt="Arts and Sciences">
                <div class="program-info">
                    <h5 class="fw-bold text-light">College of Arts & Sciences</h5>
                </div>
                <div class="program-overlay">
                    <h6 class="fw-bold text-light">Programs:</h6>
                    <ul class="list-unstyled small mb-0">
                        <li class="text-success">Bachelor of Arts in English</li>
                        <li class="text-success">Bachelor of Arts in Social Science</li>
                        <li class="text-success">Bachelor of Science in Statistics</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- College of Business and Hospitality Management -->
        <div class="col-md-6 col-lg-4">
            <div class="program-card shadow-sm border-0 rounded-4">
                <img src="{{ asset('images/CHM-thumbmnail.jpg') }}" class="card-img-top rounded-top-4" alt="Business">
                <div class="program-info">
                    <h5 class="fw-bold text-light">College of Business & Hospitality Management</h5>
                </div>
                <div class="program-overlay">
                    <h6 class="fw-bold text-light">Programs:</h6>
                    <ul class="list-unstyled small mb-0">
                        <li class="text-success">Bachelor of Science in Hotel and Restaurant Management</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- College of Information and Computing Studies -->
        <div class="col-md-6 col-lg-4">
            <div class="program-card shadow-sm border-0 rounded-4">
                <img src="{{ asset('images/CCS.jpg') }}" class="card-img-top rounded-top-4" alt="IT">
                <div class="program-info">
                    <h5 class="fw-bold text-light">College of Information & Computing Studies</h5>
                </div>
                <div class="program-overlay">
                    <h6 class="fw-bold text-light">Programs:</h6>
                    <ul class="list-unstyled small mb-0">
                        <li class="text-success">Bachelor of Science in Information Technology</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- College of Criminal Justice Education -->
        <div class="col-md-6 col-lg-4">
            <div class="program-card shadow-sm border-0 rounded-4">
                <img src="{{ asset('images/CCJE.jpg') }}" class="card-img-top rounded-top-4" alt="Criminology">
                <div class="program-info">
                    <h5 class="fw-bold text-light">College of Criminal Justice Education</h5>
                </div>
                <div class="program-overlay">
                    <h6 class="fw-bold text-light">Programs:</h6>
                    <ul class="list-unstyled small mb-0">
                        <li class="text-success">Bachelor of Science in Criminology</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- College of Engineering -->
        <div class="col-md-6 col-lg-4">
            <div class="program-card shadow-sm border-0 rounded-4">
                <img src="{{ asset('images/COE.jpg') }}" class="card-img-top rounded-top-4" alt="Engineering">
                <div class="program-info">
                    <h5 class="fw-bold text-light">College of Engineering</h5>
                </div>
                <div class="program-overlay">
                    <h6 class="fw-bold text-light">Programs:</h6>
                    <ul class="list-unstyled small mb-0">
                        <li class="text-success">Bachelor of Science in Agricultural & Biosystems Engineering</li>
                        <li class="text-success">Bachelor of Science in Mechanical Engineering</li>
                        <li class="text-success">Bachelor of Science in Electrical Engineering</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .program-card {
    position: relative;
    overflow: hidden;
    border-radius: 1rem;
    cursor: pointer;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    height: 300px;
    margin-bottom: 30px; /* Adds vertical breathing room */
    margin-left: 10px;   /* Optional horizontal spacing */
    margin-right: 10px;  /* Optional horizontal spacing */
}
    .program-card img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .program-info {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        background: rgba(31,80,54,0.9);
        color: #fff;
        padding: 10px 15px;
        text-align: center;
    }
    .program-overlay {
        position: absolute;
        inset: 0;
        background: rgba(255,255,255,0.95);
        color: #1f5036;
        padding: 20px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        opacity: 0;
        transition: opacity 0.3s ease;
        text-align: center;
    }
    .program-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.2);
    }
    .program-card:hover .program-overlay {
        opacity: 1;
    }
</style>

@endsection

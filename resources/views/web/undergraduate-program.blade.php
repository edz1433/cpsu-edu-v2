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
                <img src="{{ asset('images/default-thumbnail.png') }}" class="card-img-top rounded-top-4" alt="Teacher Education">
                <div class="program-info">
                    <h5 class="fw-bold text-light">College of Teacher Education</h5>
                </div>
                <div class="program-overlay">
                    <h6 class="fw-bold text-light">Programs:</h6>
                    <ul class="list-unstyled small mb-0">
                        <li>Bachelor in Elementary Education</li>
                        <li>Bachelor in Secondary Education</li>
                        <li>Bachelor in Physical Education</li>
                        <li>Bachelor in Early Childhood Education</li>
                        <li>BSEd major in English</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- College of Agriculture and Forestry -->
        <div class="col-md-6 col-lg-4">
            <div class="program-card shadow-sm border-0 rounded-4">
                <img src="{{ asset('images/default-thumbnail.png') }}" class="card-img-top rounded-top-4" alt="Agriculture">
                <div class="program-info">
                    <h5 class="fw-bold text-light">College of Agriculture & Forestry</h5>
                </div>
                <div class="program-overlay">
                    <h6 class="fw-bold text-light">Programs:</h6>
                    <ul class="list-unstyled small mb-0">
                        <li>BS in Agriculture</li>
                        <li>Bachelor in Animal Science</li>
                        <li>BS in Agribusiness</li>
                        <li>BS in Forestry</li>
                        <li>Bachelor in Sugar Technology</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- College of Arts and Sciences -->
        <div class="col-md-6 col-lg-4">
            <div class="program-card shadow-sm border-0 rounded-4">
                <img src="{{ asset('images/default-thumbnail.png') }}" class="card-img-top rounded-top-4" alt="Arts and Sciences">
                <div class="program-info">
                    <h5 class="fw-bold text-light">College of Arts & Sciences</h5>
                </div>
                <div class="program-overlay">
                    <h6 class="fw-bold text-light">Programs:</h6>
                    <ul class="list-unstyled small mb-0">
                        <li>Bachelor of Arts (AB English, Social Science)</li>
                        <li>BS in Statistics</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- College of Business and Hospitality Management -->
        <div class="col-md-6 col-lg-4">
            <div class="program-card shadow-sm border-0 rounded-4">
                <img src="{{ asset('images/default-thumbnail.png') }}" class="card-img-top rounded-top-4" alt="Business">
                <div class="program-info">
                    <h5 class="fw-bold text-light">College of Business & Hospitality Management</h5>
                </div>
                <div class="program-overlay">
                    <h6 class="fw-bold text-light">Programs:</h6>
                    <ul class="list-unstyled small mb-0">
                        <li>BS in Hotel & Restaurant Management</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- College of Information and Computing Studies -->
        <div class="col-md-6 col-lg-4">
            <div class="program-card shadow-sm border-0 rounded-4">
                <img src="{{ asset('images/default-thumbnail.png') }}" class="card-img-top rounded-top-4" alt="IT">
                <div class="program-info">
                    <h5 class="fw-bold text-light">College of Information & Computing Studies</h5>
                </div>
                <div class="program-overlay">
                    <h6 class="fw-bold text-light">Programs:</h6>
                    <ul class="list-unstyled small mb-0">
                        <li>BS in Information Technology</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- College of Criminal Justice Education -->
        <div class="col-md-6 col-lg-4">
            <div class="program-card shadow-sm border-0 rounded-4">
                <img src="{{ asset('images/default-thumbnail.png') }}" class="card-img-top rounded-top-4" alt="Criminology">
                <div class="program-info">
                    <h5 class="fw-bold text-light">College of Criminal Justice Education</h5>
                </div>
                <div class="program-overlay">
                    <h6 class="fw-bold text-light">Programs:</h6>
                    <ul class="list-unstyled small mb-0">
                        <li>BS in Criminology</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- College of Engineering -->
        <div class="col-md-6 col-lg-4">
            <div class="program-card shadow-sm border-0 rounded-4">
                <img src="{{ asset('images/default-thumbnail.png') }}" class="card-img-top rounded-top-4" alt="Engineering">
                <div class="program-info">
                    <h5 class="fw-bold text-light">College of Engineering</h5>
                </div>
                <div class="program-overlay">
                    <h6 class="fw-bold text-light">Programs:</h6>
                    <ul class="list-unstyled small mb-0">
                        <li>BS in Agricultural & Biosystems Engineering</li>
                        <li>BS in Mechanical Engineering</li>
                        <li>BS in Electrical Engineering</li>
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

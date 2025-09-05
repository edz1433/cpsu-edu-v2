@extends('web.layouts.mainlayout')
@section('content')

<div class="container my-5">
    <div class="text-center mb-5">
        <h1 class="fw-bold" style="color:#1f5036;">🎓 Programs Offered</h1>
        <p class="text-muted">Explore graduate and postgraduate programs offered at <strong>CPSU</strong>. Hover on a program to see available majors.</p>
    </div>

    <div class="row g-4">
        <!-- Doctor of Philosophy -->
        <div class="col-md-6 col-lg-4">
            <div class="program-card shadow-sm border-0 rounded-4">
                <img src="{{ asset('images/default-thumbnail.png') }}" class="card-img-top rounded-top-4" alt="PhD Program">
                <div class="program-info">
                    <h6 class="fw-bold text-light">Doctor of Philosophy (Ph.D.)</h6>
                </div>
                <div class="program-overlay">
                    <h6 class="fw-bold text-light">Majors in:</h6>
                    <ul class="list-unstyled small mb-0">
                        <li>Educational Management</li>
                        <li>Agriculture</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- DPA -->
        <div class="col-md-6 col-lg-4">
            <div class="program-card shadow-sm border-0 rounded-4">
                <img src="{{ asset('images/default-thumbnail.png') }}" class="card-img-top rounded-top-4" alt="DPA Program">
                <div class="program-info">
                    <h6 class="fw-bold text-light">Doctor in Public Administration (DPA)</h6>
                </div>
                <div class="program-overlay">
                    <p class="small mb-0">Focuses on governance, leadership, and public policy.</p>
                </div>
            </div>
        </div>

        <!-- MAEd -->
        <div class="col-md-6 col-lg-4">
            <div class="program-card shadow-sm border-0 rounded-4">
                <img src="{{ asset('images/default-thumbnail.png') }}" class="card-img-top rounded-top-4" alt="MAEd Program">
                <div class="program-info">
                    <h6 class="fw-bold text-light">Master of Arts in Education (MAEd)</h6>
                </div>
                <div class="program-overlay">
                    <h6 class="fw-bold text-light">Majors in:</h6>
                    <ul class="list-unstyled small mb-0">
                        <li>Educational Management</li>
                        <li>Mathematics</li>
                        <li>English</li>
                        <li>Filipino</li>
                        <li>General Science</li>
                        <li>Physical Education</li>
                        <li>Social Science</li>
                        <li>Early Childhood Education</li>
                        <li>Special Education</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- MAEM-VP -->
        <div class="col-md-6 col-lg-4">
            <div class="program-card shadow-sm border-0 rounded-4">
                <img src="{{ asset('images/default-thumbnail.png') }}" class="card-img-top rounded-top-4" alt="MAEM Program">
                <div class="program-info">
                    <h6 class="fw-bold text-light">MAEM-VP</h6>
                </div>
                <div class="program-overlay">
                    <p class="small mb-0">Master of Arts in Educational Management major in Vocational Productivity</p>
                </div>
            </div>
        </div>

        <!-- MPA -->
        <div class="col-md-6 col-lg-4">
            <div class="program-card shadow-sm border-0 rounded-4">
                <img src="{{ asset('images/default-thumbnail.png') }}" class="card-img-top rounded-top-4" alt="MPA Program">
                <div class="program-info">
                    <h6 class="fw-bold text-light">Master in Public Administration</h6>
                </div>
                <div class="program-overlay">
                    <h6 class="fw-bold text-light">Tracks:</h6>
                    <ul class="list-unstyled small mb-0">
                        <li>General (MPA-General)</li>
                        <li>Human Resource Management (MPA-HRM)</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- MSA -->
        <div class="col-md-6 col-lg-4">
            <div class="program-card shadow-sm border-0 rounded-4">
                <img src="{{ asset('images/default-thumbnail.png') }}" class="card-img-top rounded-top-4" alt="MSA Program">
                <div class="program-info">
                    <h6 class="fw-bold text-light">Master of Science in Agriculture (MSA)</h6>
                </div>
                <div class="program-overlay">
                    <h6 class="fw-bold text-light">Majors in:</h6>
                    <ul class="list-unstyled small mb-0">
                        <li>Crop Science</li>
                        <li>Horticulture</li>
                        <li>Agricultural Extension</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- MSAS -->
        <div class="col-md-6 col-lg-4">
            <div class="program-card shadow-sm border-0 rounded-4">
                <img src="{{ asset('images/default-thumbnail.png') }}" class="card-img-top rounded-top-4" alt="MSAS Program">
                <div class="program-info">
                    <h6 class="fw-bold text-light">Master of Science in Animal Science (MSAS)</h6>
                </div>
                <div class="program-overlay">
                    <p class="small mb-0">Specialized studies in advanced animal science.</p>
                </div>
            </div>
        </div>

        <!-- MSRD -->
        <div class="col-md-6 col-lg-4">
            <div class="program-card shadow-sm border-0 rounded-4">
                <img src="{{ asset('images/default-thumbnail.png') }}" class="card-img-top rounded-top-4" alt="MSRD Program">
                <div class="program-info">
                    <h6 class="fw-bold text-light">Master of Science in Rural Development (MSRD)</h6>
                </div>
                <div class="program-overlay">
                    <p class="small mb-0">Focused on sustainable rural community development.</p>
                </div>
            </div>
        </div>

        <!-- MSIT -->
        <div class="col-md-6 col-lg-4">
            <div class="program-card shadow-sm border-0 rounded-4">
                <img src="{{ asset('images/default-thumbnail.png') }}" class="card-img-top rounded-top-4" alt="MSIT Program">
                <div class="program-info">
                    <h6 class="fw-bold text-light">Master of Science in Information Technology (MSIT)</h6>
                </div>
                <div class="program-overlay">
                    <p class="small mb-0">Advanced IT studies for research and innovation.</p>
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
    /* green label at bottom */
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
    /* hover overlay */
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

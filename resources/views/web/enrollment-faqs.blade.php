@extends('web.layouts.mainlayout')
@section('content')
@section('content')

<style>
    .admission-title {
        color: #1f5036;
        font-weight: 700;
    }
    .admission-section h3 {
        color: #1f5036;
        font-weight: 600;
    }
    .accordion-button {
        background-color: #f8f9fa;
        color: #1f5036;
        font-weight: 500;
    }
    .accordion-button:not(.collapsed) {
        background-color: #1f5036;
        color: #fff;
    }
    .accordion-button:focus {
        box-shadow: none;
    }
    .list-group-item {
        border: none;
        padding-left: 1.2rem;
    }
    .contact-box {
        background: #eaf4ef;
        border-left: 5px solid #1f5036;
        padding: 15px 20px;
        margin-top: 30px;
        border-radius: 6px;
    }
</style>

<div class="container">
    <div class="card shadow-sm border-0 rounded-3 overflow-hidden">
        <div class="card-body p-5">
            <!-- Header -->
            <div class="text-center mb-5">
                <h1 class="admission-title">CPSU Admission Information</h1>
                <p class="text-muted">
                    Welcome to <strong>Central Philippines State University</strong>. Below are the 
                    details of the admission process, goals, and requirements.
                </p>
            </div>

            <!-- Goals and Objectives -->
            <div class="admission-section mb-5">
                <h3>Goals and Objectives</h3>
                <ul class="ps-3 mt-3">
                    <li>Screen prospective students for undergraduate and graduate programs.</li>
                    <li>Assist incoming students in choosing their course.</li>
                    <li>Assess student potential based on CPSU specializations (technological, agricultural, education, etc.).</li>
                </ul>

                <p class="mt-3">
                    Student admissions is a vital function of the <strong>Office of the Student Affairs</strong>,
                    headed by the Dean of Student Affairs with her team, in coordination with School Deans and the College Registrar. 
                    A psychometrician also assists with the preparation, administration, and interpretation of the 
                    <em>NSCA College Entrance Examination</em>.
                </p>
            </div>

            <!-- Admission Requirements Accordion -->
            <div class="admission-section">
                <h3>Admission Requirements</h3>
                <div class="accordion mt-3" id="admissionAccordion">
                    <!-- First Year -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true">
                                First Year Students
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#admissionAccordion">
                            <div class="accordion-body">
                                <ul class="list-group">
                                    <li class="list-group-item">Report Card/Form 138-A</li>
                                    <li class="list-group-item">Certificate of Good Moral Character</li>
                                    <li class="list-group-item">Transcript of Records (for Transferees)</li>
                                    <li class="list-group-item">Honorable Dismissal (for Transferees)</li>
                                    <li class="list-group-item">Birth Certificate (NSO Authenticated)</li>
                                    <li class="list-group-item">CPSU Security Clearance</li>
                                    <li class="list-group-item">6 pcs. 2X2 ID Picture</li>
                                    <li class="list-group-item">4 pcs. long folder</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Medical -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo">
                                Medical-Dental Requirements (S.Y. 2018-2019)
                            </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#admissionAccordion">
                            <div class="accordion-body">
                                <ul class="list-group">
                                    <li class="list-group-item">1 pc brown envelope (long)</li>
                                    <li class="list-group-item">1 pc 1x1 ID picture</li>
                                    <li class="list-group-item">Medical Certificate (signed by government/private physician)</li>
                                    <li class="list-group-item">
                                        Laboratory Results:
                                        <ul class="mt-2">
                                            <li>CBC</li>
                                            <li>Platelet</li>
                                            <li>Chest x-ray</li>
                                            <li>Urinalysis</li>
                                            <li>Fecalysis</li>
                                            <li>HBsAg (Criminology & HRM only)</li>
                                            <li>Drug Test (Criminology only)</li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contact -->
            <div class="contact-box">
                <p class="mb-0">
                    <strong>For inquiries:</strong> Please call or text the Guidance Office at 
                    <span class="fw-bold" style="color:#1f5036;">0926-667-0050</span>.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection

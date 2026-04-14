@extends('web.layouts.mainlayout')

@section('content')

<section id="page-banner" class="pt-105 pb-110 bg_cover" data-overlay="7" style="background-image: url({{ asset('Uploads/default-thumbnail.png') }})">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="page-banner-cont">
					<h2>Gender and Development</h2>
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="#">Home</a></li>
							<li class="breadcrumb-item"><a href="#">Gender and Development</a></li>
						</ol>
					</nav>
				</div> 
			</div>
		</div> 
	</div> 
</section>

<section>
    <div class="container mt-4 mb-4">
        <div class="text-center mb-5">
            <h1 class="fw-bold" style="color:#1f5036;">Employee</h1>
            <p class="text-muted">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
        </div>
        <div class="row justify-content-center g-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <!-- Overall Gender Pie -->
                        <div style="width: 100%; max-width: 300px; height: 400px; margin: 40px auto;">
                            <canvas id="genderChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <!-- By Campus Bar -->
                        <div style="width: 100%; max-width: 1200px; height: 400px; margin: 40px auto;">
                            <canvas id="campusChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="container mt-4 mb-4">
        <div class="text-center mb-5">
            <h1 class="fw-bold" style="color:#1f5036;">Students</h1>
            <p class="text-muted">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
        </div>
        <div class="row justify-content-center g-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <!-- Overall Gender Pie -->
                        <div style="width: 100%; max-width: 300px; height: 400px; margin: 40px auto;">
                            <canvas id="genderStudentChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <!-- By Campus Bar -->
                        <div style="width: 100%; max-width: 1200px; height: 400px; margin: 40px auto;">
                            <canvas id="campusStudentChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>




<script>
    document.addEventListener("DOMContentLoaded", async function () {

        try {
            const response = await fetch("{{ $apiUrl }}/gad-gender-count", {
                headers: { 'Accept': 'application/json' }
            });

            const result = await response.json();

            /* ===============================
            1. PIE CHART (ALL CAMPUS)
            =============================== */
            const genderCanvas = document.getElementById('genderChart');

            if (genderCanvas) {
                const filtered = (result.allcampus || [])
                    .filter(item => item.sex !== null);

                const labels = filtered.map(item => item.sex);
                const data = filtered.map(item => item.count);

                new Chart(genderCanvas, {
                    type: 'pie',
                    data: {
                        labels: labels,
                        datasets: [{
                            data: data,
                            backgroundColor: [
                                '#14532D', // dark green
                                '#4ADE80'  // light green
                            ],
                            borderColor: '#ffffff',
                            borderWidth: 2
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: { position: 'bottom' }
                        }
                    }
                });
            }

            /* ===============================
            2. BY CAMPUS BAR CHART
            =============================== */
            const campusCanvas = document.getElementById('campusChart');

            if (campusCanvas) {
                const byCampus = (result.bycampus || [])
                    .filter(item => item.sex !== null);

                // unique campuses
                const campuses = [...new Set(byCampus.map(item => item.campus_name))];

                // male data
                const maleData = campuses.map(campus => {
                    const found = byCampus.find(item =>
                        item.campus_name === campus && item.sex === 'Male'
                    );
                    return found ? found.count : 0;
                });

                // female data
                const femaleData = campuses.map(campus => {
                    const found = byCampus.find(item =>
                        item.campus_name === campus && item.sex === 'Female'
                    );
                    return found ? found.count : 0;
                });

                new Chart(campusCanvas, {
                    type: 'bar',
                    data: {
                        labels: campuses,
                        datasets: [
                            {
                                label: 'Male',
                                data: maleData,
                                backgroundColor: '#14532D' // dark green
                            },
                            {
                                label: 'Female',
                                data: femaleData,
                                backgroundColor: '#4ADE80' // light green
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            x: {
                                ticks: {
                                    autoSkip: false,
                                    maxRotation: 45,
                                    minRotation: 30
                                }
                            },
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            }

        } catch (error) {
            console.error('Error fetching data:', error);
        }
    });
</script>



<script>
    document.addEventListener("DOMContentLoaded", async function () {

        try {
            const response = await fetch("{{ $apicoasUrl }}/gad-gender-student-count", {
                headers: { 'Accept': 'application/json' }
            });

            const result = await response.json();

            /* ===============================
            1. PIE CHART (ALL CAMPUS)
            =============================== */
            const genderCanvas = document.getElementById('genderStudentChart');

            if (genderCanvas) {
                const filtered = (result.allcampus || [])
                    .filter(item => item.gender !== null);

                const labels = filtered.map(item => item.gender);
                const data = filtered.map(item => item.count);

                new Chart(genderCanvas, {
                    type: 'pie',
                    data: {
                        labels: labels,
                        datasets: [{
                            data: data,
                            backgroundColor: [
                                '#14532D', // dark green
                                '#4ADE80'  // light green
                            ],
                            borderColor: '#ffffff',
                            borderWidth: 2
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: { position: 'bottom' }
                        }
                    }
                });
            }

            /* ===============================
            2. BY CAMPUS BAR CHART
            =============================== */
            const campusCanvas = document.getElementById('campusStudentChart');

            if (campusCanvas) {
                const byCampus = (result.bycampus || [])
                    .filter(item => item.gender !== null);

                // unique campuses
                const campuses = [...new Set(byCampus.map(item => item.name))];

                // male data
                const maleData = campuses.map(campus => {
                    const found = byCampus.find(item =>
                        item.name === campus && item.gender === 'Male'
                    );
                    return found ? found.count : 0;
                });

                // female data
                const femaleData = campuses.map(campus => {
                    const found = byCampus.find(item =>
                        item.name === campus && item.gender === 'Female'
                    );
                    return found ? found.count : 0;
                });

                new Chart(campusCanvas, {
                    type: 'bar',
                    data: {
                        labels: campuses,
                        datasets: [
                            {
                                label: 'Male',
                                data: maleData,
                                backgroundColor: '#14532D' // dark green
                            },
                            {
                                label: 'Female',
                                data: femaleData,
                                backgroundColor: '#4ADE80' // light green
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            x: {
                                ticks: {
                                    autoSkip: false,
                                    maxRotation: 45,
                                    minRotation: 30
                                }
                            },
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            }

        } catch (error) {
            console.error('Error fetching data:', error);
        }
    });
</script>
@endsection
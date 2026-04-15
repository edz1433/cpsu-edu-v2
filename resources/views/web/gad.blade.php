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

<br>
<section>
    <div class="container mt-6 mb-4">
        <div class="text-center mb-5 mt-6">
            <h1 class="fw-bold" style="color:#1f5036;">Students</h1>
            <p>Sex-disaggregated Data for Academic Year 2025-2026</p>
        </div>
        <div class="row justify-content-center g-4">
            {{-- <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5>All Campus:</h5>
                        <table class="table mt-4" id="alltablegendercampus">
                            <thead>
                                <tr>
                                    <th>Campus</th>
                                    <th>Male</th>
                                    <th>Female</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> --}}
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <!-- Overall Gender Pie -->
                        <h5>All Campus:</h5>
                        <div style="width: 100%; max-width: 300px; height: 400px; margin: 40px auto;">
                            <canvas id="genderStudentChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5>Main Campus:</h5>
                        <div style="width: 100%; max-width: 300px; height: 400px; margin: 40px auto;">
                            <canvas id="genderStudentChartmain"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5>Victorias Campus:</h5>
                        <div style="width: 100%; max-width: 300px; height: 400px; margin: 40px auto;">
                            <canvas id="genderStudentChartvictorias"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5>San Carlos Campus:</h5>
                        <div style="width: 100%; max-width: 300px; height: 400px; margin: 40px auto;">
                            <canvas id="genderStudentChartsancarlos"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5>Hinigaran Campus:</h5>
                        <div style="width: 100%; max-width: 300px; height: 400px; margin: 40px auto;">
                            <canvas id="genderStudentCharthinigaran"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5>Moises Padilla Campus:</h5>
                        <div style="width: 100%; max-width: 300px; height: 400px; margin: 40px auto;">
                            <canvas id="genderStudentChartmoises"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5>Ilog Campus:</h5>
                        <div style="width: 100%; max-width: 300px; height: 400px; margin: 40px auto;">
                            <canvas id="genderStudentChartilog"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5>Candoni:</h5>
                        <div style="width: 100%; max-width: 300px; height: 400px; margin: 40px auto;">
                            <canvas id="genderStudentChartcandoni"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5>Cauayan:</h5>
                        <div style="width: 100%; max-width: 300px; height: 400px; margin: 40px auto;">
                            <canvas id="genderStudentChartcauayan"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5>Sipalay:</h5>
                        <div style="width: 100%; max-width: 300px; height: 400px; margin: 40px auto;">
                            <canvas id="genderStudentChartsipalay"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5>Hinobaan:</h5>
                        <div style="width: 100%; max-width: 300px; height: 400px; margin: 40px auto;">
                            <canvas id="genderStudentCharthinobaan"></canvas>
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
            <h1 class="fw-bold" style="color:#1f5036;">Employee</h1>
            <p>Sex-disaggregated Data for Academic Year 2025-2026</p>
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
                                '#14532D', // dark green - Male
                                '#4ADE80'  // light green - Female
                            ],
                            borderColor: '#ffffff',
                            borderWidth: 2
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: { 
                                position: 'bottom',
                                labels: {
                                    generateLabels: function(chart) {
                                        const data = chart.data;
                                        const dataset = data.datasets[0];

                                        return data.labels.map((label, i) => {
                                            const value = dataset.data[i];
                                            return {
                                                text: `${label} (${value})`,
                                                fillStyle: dataset.backgroundColor[i],
                                                strokeStyle: '#fff',
                                                lineWidth: 1,
                                                hidden: false,
                                                index: i
                                            };
                                        });
                                    }
                                }
                            },
                            datalabels: {
                                display: true,
                                color: '#fff',
                                font: {
                                    weight: 'bold',
                                    size: 14
                                },
                                formatter: (value, context) => {
                                    const total = context.chart.data.datasets[0].data.reduce((a, b) => a + b, 0);
                                    const percentage = ((value / total) * 100).toFixed(1);
                                    return percentage + '%'; 
                                }
                            }
                        }
                    },
                    plugins: [ChartDataLabels] 
                });
            }

            /* ===============================
            2. BY CAMPUS - STACKED BAR CHART (Improved)
            =============================== */
            const campusCanvas = document.getElementById('campusChart');

            if (campusCanvas) {
                const byCampus = (result.bycampus || [])
                    .filter(item => item.sex !== null);

                // Get unique campus names
                const campuses = [...new Set(byCampus.map(item => item.campus_name))];

                // Prepare Male and Female data
                const maleData = campuses.map(campus => {
                    const found = byCampus.find(item =>
                        item.campus_name === campus && item.sex === 'Male'
                    );
                    return found ? found.count : 0;
                });

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
                                backgroundColor: '#14532D',   // dark green
                                borderColor: '#ffffff',
                                borderWidth: 1
                            },
                            {
                                label: 'Female',
                                data: femaleData,
                                backgroundColor: '#4ADE80',   // light green
                                borderColor: '#ffffff',
                                borderWidth: 1
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        indexAxis: 'x', // set to 'y' for horizontal bars
                        scales: {
                            x: {
                                stacked: true,
                                ticks: {
                                    autoSkip: false,
                                    maxRotation: 45,
                                    minRotation: 30
                                }
                            },
                            y: {
                                stacked: true,
                                beginAtZero: true,
                                title: {
                                    display: true,
                                    text: 'Number of Students'
                                }
                            }
                        },
                        plugins: {
                            legend: {
                                position: 'top',
                                align: 'center'
                            },
                            tooltip: {
                                mode: 'index',
                                intersect: false
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
            const genderCanvasMain = document.getElementById('genderStudentChartmain');
            const genderCanvasVictorias = document.getElementById('genderStudentChartvictorias');
            const genderCanvasSanCarlos = document.getElementById('genderStudentChartsancarlos');
            const genderCanvasHinigaran = document.getElementById('genderStudentCharthinigaran');
            const genderCanvasMoises = document.getElementById('genderStudentChartmoises');
            const genderCanvasIlog = document.getElementById('genderStudentChartilog');
            const genderCanvasCandoni = document.getElementById('genderStudentChartcandoni');
            const genderCanvasCauayan = document.getElementById('genderStudentChartcauayan');
            const genderCanvasSipalay = document.getElementById('genderStudentChartsipalay');
            const genderCanvasHinobaan = document.getElementById('genderStudentCharthinobaan');

            if (genderCanvas) {
                const filtered = (result.allcampus || [])
                    .filter(item => item.gender !== null);

                const labels = filtered.map(item => item.gender);
                const data = filtered.map(item => item.count);
                Chart.register(ChartDataLabels);
                new Chart(genderCanvas, {
                    type: 'pie',
                    data: {
                        labels: labels,
                        datasets: [{
                            data: data,
                            backgroundColor: [
                                '#14532D',
                                '#4ADE80'
                            ],
                            borderColor: '#ffffff',
                            borderWidth: 2
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'bottom',
                                labels: {
                                    generateLabels: function(chart) {
                                        const data = chart.data;
                                        const dataset = data.datasets[0];

                                        return data.labels.map((label, i) => {
                                            const value = dataset.data[i];
                                            return {
                                                text: `${label} (${value})`,
                                                fillStyle: dataset.backgroundColor[i],
                                                strokeStyle: '#fff',
                                                lineWidth: 1,
                                                hidden: false,
                                                index: i
                                            };
                                        });
                                    }
                                }
                            },
                            datalabels: {
                                display: true,
                                color: '#fff',
                                font: {
                                    weight: 'bold',
                                    size: 14
                                },
                                formatter: (value, context) => {
                                    const data = context.chart.data.datasets[0].data;
                                    const total = data.reduce((a, b) => a + b, 0);
                                    const percentage = ((value / total) * 100).toFixed(1);
                                    return percentage + '%'; 
                                }
                            }
                        }
                    },
                    plugins: [ChartDataLabels] 
                });
            }

            if (genderCanvasMain) {
                const filtered = (result.maincampus || [])
                    .filter(item => item.gender !== null);

                const labels = filtered.map(item => item.gender);
                const data = filtered.map(item => item.count);
                Chart.register(ChartDataLabels);
                new Chart(genderCanvasMain, {
                    type: 'pie',
                    data: {
                        labels: labels,
                        datasets: [{
                            data: data,
                            backgroundColor: [
                                '#14532D',
                                '#4ADE80'
                            ],
                            borderColor: '#ffffff',
                            borderWidth: 2
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'bottom',
                                labels: {
                                    generateLabels: function(chart) {
                                        const data = chart.data;
                                        const dataset = data.datasets[0];

                                        return data.labels.map((label, i) => {
                                            const value = dataset.data[i];
                                            return {
                                                text: `${label} (${value})`,
                                                fillStyle: dataset.backgroundColor[i],
                                                strokeStyle: '#fff',
                                                lineWidth: 1,
                                                hidden: false,
                                                index: i
                                            };
                                        });
                                    }
                                }
                            },
                            datalabels: {
                                display: true,
                                color: '#fff',
                                font: {
                                    weight: 'bold',
                                    size: 14
                                },
                                formatter: (value, context) => {
                                    const data = context.chart.data.datasets[0].data;
                                    const total = data.reduce((a, b) => a + b, 0);
                                    const percentage = ((value / total) * 100).toFixed(1);
                                    return percentage + '%'; 
                                }
                            }
                        }
                    },
                    plugins: [ChartDataLabels] 
                });
            }
            if (genderCanvasVictorias) {
                const filtered = (result.victoriascampus || [])
                    .filter(item => item.gender !== null);

                const labels = filtered.map(item => item.gender);
                const data = filtered.map(item => item.count);
                Chart.register(ChartDataLabels);
                new Chart(genderCanvasVictorias, {
                    type: 'pie',
                    data: {
                        labels: labels,
                        datasets: [{
                            data: data,
                            backgroundColor: [
                                '#14532D',
                                '#4ADE80'
                            ],
                            borderColor: '#ffffff',
                            borderWidth: 2
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'bottom',
                                labels: {
                                    generateLabels: function(chart) {
                                        const data = chart.data;
                                        const dataset = data.datasets[0];

                                        return data.labels.map((label, i) => {
                                            const value = dataset.data[i];
                                            return {
                                                text: `${label} (${value})`,
                                                fillStyle: dataset.backgroundColor[i],
                                                strokeStyle: '#fff',
                                                lineWidth: 1,
                                                hidden: false,
                                                index: i
                                            };
                                        });
                                    }
                                }
                            },
                            datalabels: {
                                display: true,
                                color: '#fff',
                                font: {
                                    weight: 'bold',
                                    size: 14
                                },
                                formatter: (value, context) => {
                                    const data = context.chart.data.datasets[0].data;
                                    const total = data.reduce((a, b) => a + b, 0);
                                    const percentage = ((value / total) * 100).toFixed(1);
                                    return percentage + '%'; 
                                }
                            }
                        }
                    },
                    plugins: [ChartDataLabels] 
                });
            }
            if (genderCanvasSanCarlos) {
                const filtered = (result.sancarloscampus || [])
                    .filter(item => item.gender !== null);

                const labels = filtered.map(item => item.gender);
                const data = filtered.map(item => item.count);
                Chart.register(ChartDataLabels);
                new Chart(genderCanvasSanCarlos, {
                    type: 'pie',
                    data: {
                        labels: labels,
                        datasets: [{
                            data: data,
                            backgroundColor: [
                                '#14532D',
                                '#4ADE80'
                            ],
                            borderColor: '#ffffff',
                            borderWidth: 2
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'bottom',
                                labels: {
                                    generateLabels: function(chart) {
                                        const data = chart.data;
                                        const dataset = data.datasets[0];

                                        return data.labels.map((label, i) => {
                                            const value = dataset.data[i];
                                            return {
                                                text: `${label} (${value})`,
                                                fillStyle: dataset.backgroundColor[i],
                                                strokeStyle: '#fff',
                                                lineWidth: 1,
                                                hidden: false,
                                                index: i
                                            };
                                        });
                                    }
                                }
                            },
                            datalabels: {
                                display: true,
                                color: '#fff',
                                font: {
                                    weight: 'bold',
                                    size: 14
                                },
                                formatter: (value, context) => {
                                    const data = context.chart.data.datasets[0].data;
                                    const total = data.reduce((a, b) => a + b, 0);
                                    const percentage = ((value / total) * 100).toFixed(1);
                                    return percentage + '%'; 
                                }
                            }
                        }
                    },
                    plugins: [ChartDataLabels] 
                });
            }
            if (genderCanvasHinigaran) {
                const filtered = (result.hinigarancampus || [])
                    .filter(item => item.gender !== null);

                const labels = filtered.map(item => item.gender);
                const data = filtered.map(item => item.count);
                Chart.register(ChartDataLabels);
                new Chart(genderCanvasHinigaran, {
                    type: 'pie',
                    data: {
                        labels: labels,
                        datasets: [{
                            data: data,
                            backgroundColor: [
                                '#14532D',
                                '#4ADE80'
                            ],
                            borderColor: '#ffffff',
                            borderWidth: 2
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'bottom',
                                labels: {
                                    generateLabels: function(chart) {
                                        const data = chart.data;
                                        const dataset = data.datasets[0];

                                        return data.labels.map((label, i) => {
                                            const value = dataset.data[i];
                                            return {
                                                text: `${label} (${value})`,
                                                fillStyle: dataset.backgroundColor[i],
                                                strokeStyle: '#fff',
                                                lineWidth: 1,
                                                hidden: false,
                                                index: i
                                            };
                                        });
                                    }
                                }
                            },
                            datalabels: {
                                display: true,
                                color: '#fff',
                                font: {
                                    weight: 'bold',
                                    size: 14
                                },
                                formatter: (value, context) => {
                                    const data = context.chart.data.datasets[0].data;
                                    const total = data.reduce((a, b) => a + b, 0);
                                    const percentage = ((value / total) * 100).toFixed(1);
                                    return percentage + '%'; 
                                }
                            }
                        }
                    },
                    plugins: [ChartDataLabels] 
                });
            }
            if (genderCanvasMoises) {
                const filtered = (result.moisepadillacampus || [])
                    .filter(item => item.gender !== null);

                const labels = filtered.map(item => item.gender);
                const data = filtered.map(item => item.count);
                Chart.register(ChartDataLabels);
                new Chart(genderCanvasMoises, {
                    type: 'pie',
                    data: {
                        labels: labels,
                        datasets: [{
                            data: data,
                            backgroundColor: [
                                '#14532D',
                                '#4ADE80'
                            ],
                            borderColor: '#ffffff',
                            borderWidth: 2
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'bottom',
                                labels: {
                                    generateLabels: function(chart) {
                                        const data = chart.data;
                                        const dataset = data.datasets[0];

                                        return data.labels.map((label, i) => {
                                            const value = dataset.data[i];
                                            return {
                                                text: `${label} (${value})`,
                                                fillStyle: dataset.backgroundColor[i],
                                                strokeStyle: '#fff',
                                                lineWidth: 1,
                                                hidden: false,
                                                index: i
                                            };
                                        });
                                    }
                                }
                            },
                            datalabels: {
                                display: true,
                                color: '#fff',
                                font: {
                                    weight: 'bold',
                                    size: 14
                                },
                                formatter: (value, context) => {
                                    const data = context.chart.data.datasets[0].data;
                                    const total = data.reduce((a, b) => a + b, 0);
                                    const percentage = ((value / total) * 100).toFixed(1);
                                    return percentage + '%'; 
                                }
                            }
                        }
                    },
                    plugins: [ChartDataLabels] 
                });
            }
            if (genderCanvasIlog) {
                const filtered = (result.ilogcampus || [])
                    .filter(item => item.gender !== null);

                const labels = filtered.map(item => item.gender);
                const data = filtered.map(item => item.count);
                Chart.register(ChartDataLabels);
                new Chart(genderCanvasIlog, {
                    type: 'pie',
                    data: {
                        labels: labels,
                        datasets: [{
                            data: data,
                            backgroundColor: [
                                '#14532D',
                                '#4ADE80'
                            ],
                            borderColor: '#ffffff',
                            borderWidth: 2
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'bottom',
                                labels: {
                                    generateLabels: function(chart) {
                                        const data = chart.data;
                                        const dataset = data.datasets[0];

                                        return data.labels.map((label, i) => {
                                            const value = dataset.data[i];
                                            return {
                                                text: `${label} (${value})`,
                                                fillStyle: dataset.backgroundColor[i],
                                                strokeStyle: '#fff',
                                                lineWidth: 1,
                                                hidden: false,
                                                index: i
                                            };
                                        });
                                    }
                                }
                            },
                            datalabels: {
                                display: true,
                                color: '#fff',
                                font: {
                                    weight: 'bold',
                                    size: 14
                                },
                                formatter: (value, context) => {
                                    const data = context.chart.data.datasets[0].data;
                                    const total = data.reduce((a, b) => a + b, 0);
                                    const percentage = ((value / total) * 100).toFixed(1);
                                    return percentage + '%'; 
                                }
                            }
                        }
                    },
                    plugins: [ChartDataLabels] 
                });
            }
            if (genderCanvasCandoni) {
                const filtered = (result.candonicampus || [])
                    .filter(item => item.gender !== null);

                const labels = filtered.map(item => item.gender);
                const data = filtered.map(item => item.count);
                Chart.register(ChartDataLabels);
                new Chart(genderCanvasCandoni, {
                    type: 'pie',
                    data: {
                        labels: labels,
                        datasets: [{
                            data: data,
                            backgroundColor: [
                                '#14532D',
                                '#4ADE80'
                            ],
                            borderColor: '#ffffff',
                            borderWidth: 2
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'bottom',
                                labels: {
                                    generateLabels: function(chart) {
                                        const data = chart.data;
                                        const dataset = data.datasets[0];

                                        return data.labels.map((label, i) => {
                                            const value = dataset.data[i];
                                            return {
                                                text: `${label} (${value})`,
                                                fillStyle: dataset.backgroundColor[i],
                                                strokeStyle: '#fff',
                                                lineWidth: 1,
                                                hidden: false,
                                                index: i
                                            };
                                        });
                                    }
                                }
                            },
                            datalabels: {
                                display: true,
                                color: '#fff',
                                font: {
                                    weight: 'bold',
                                    size: 14
                                },
                                formatter: (value, context) => {
                                    const data = context.chart.data.datasets[0].data;
                                    const total = data.reduce((a, b) => a + b, 0);
                                    const percentage = ((value / total) * 100).toFixed(1);
                                    return percentage + '%'; 
                                }
                            }
                        }
                    },
                    plugins: [ChartDataLabels] 
                });
            }
            if (genderCanvasCauayan) {
                const filtered = (result.candonicampus || [])
                    .filter(item => item.gender !== null);

                const labels = filtered.map(item => item.gender);
                const data = filtered.map(item => item.count);
                Chart.register(ChartDataLabels);
                new Chart(genderCanvasCauayan, {
                    type: 'pie',
                    data: {
                        labels: labels,
                        datasets: [{
                            data: data,
                            backgroundColor: [
                                '#14532D',
                                '#4ADE80'
                            ],
                            borderColor: '#ffffff',
                            borderWidth: 2
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'bottom',
                                labels: {
                                    generateLabels: function(chart) {
                                        const data = chart.data;
                                        const dataset = data.datasets[0];

                                        return data.labels.map((label, i) => {
                                            const value = dataset.data[i];
                                            return {
                                                text: `${label} (${value})`,
                                                fillStyle: dataset.backgroundColor[i],
                                                strokeStyle: '#fff',
                                                lineWidth: 1,
                                                hidden: false,
                                                index: i
                                            };
                                        });
                                    }
                                }
                            },
                            datalabels: {
                                display: true,
                                color: '#fff',
                                font: {
                                    weight: 'bold',
                                    size: 14
                                },
                                formatter: (value, context) => {
                                    const data = context.chart.data.datasets[0].data;
                                    const total = data.reduce((a, b) => a + b, 0);
                                    const percentage = ((value / total) * 100).toFixed(1);
                                    return percentage + '%'; 
                                }
                            }
                        }
                    },
                    plugins: [ChartDataLabels] 
                });
            }
            if (genderCanvasSipalay) {
                const filtered = (result.sipalaycampus || [])
                    .filter(item => item.gender !== null);

                const labels = filtered.map(item => item.gender);
                const data = filtered.map(item => item.count);
                Chart.register(ChartDataLabels);
                new Chart(genderCanvasSipalay, {
                    type: 'pie',
                    data: {
                        labels: labels,
                        datasets: [{
                            data: data,
                            backgroundColor: [
                                '#14532D',
                                '#4ADE80'
                            ],
                            borderColor: '#ffffff',
                            borderWidth: 2
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'bottom',
                                labels: {
                                    generateLabels: function(chart) {
                                        const data = chart.data;
                                        const dataset = data.datasets[0];

                                        return data.labels.map((label, i) => {
                                            const value = dataset.data[i];
                                            return {
                                                text: `${label} (${value})`,
                                                fillStyle: dataset.backgroundColor[i],
                                                strokeStyle: '#fff',
                                                lineWidth: 1,
                                                hidden: false,
                                                index: i
                                            };
                                        });
                                    }
                                }
                            },
                            datalabels: {
                                display: true,
                                color: '#fff',
                                font: {
                                    weight: 'bold',
                                    size: 14
                                },
                                formatter: (value, context) => {
                                    const data = context.chart.data.datasets[0].data;
                                    const total = data.reduce((a, b) => a + b, 0);
                                    const percentage = ((value / total) * 100).toFixed(1);
                                    return percentage + '%'; 
                                }
                            }
                        }
                    },
                    plugins: [ChartDataLabels] 
                });
            }
            if (genderCanvasHinobaan) {
                const filtered = (result.hinobaancampus || [])
                    .filter(item => item.gender !== null);

                const labels = filtered.map(item => item.gender);
                const data = filtered.map(item => item.count);
                Chart.register(ChartDataLabels);
                new Chart(genderCanvasHinobaan, {
                    type: 'pie',
                    data: {
                        labels: labels,
                        datasets: [{
                            data: data,
                            backgroundColor: [
                                '#14532D',
                                '#4ADE80'
                            ],
                            borderColor: '#ffffff',
                            borderWidth: 2
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'bottom',
                                labels: {
                                    generateLabels: function(chart) {
                                        const data = chart.data;
                                        const dataset = data.datasets[0];

                                        return data.labels.map((label, i) => {
                                            const value = dataset.data[i];
                                            return {
                                                text: `${label} (${value})`,
                                                fillStyle: dataset.backgroundColor[i],
                                                strokeStyle: '#fff',
                                                lineWidth: 1,
                                                hidden: false,
                                                index: i
                                            };
                                        });
                                    }
                                }
                            },
                            datalabels: {
                                display: true,
                                color: '#fff',
                                font: {
                                    weight: 'bold',
                                    size: 14
                                },
                                formatter: (value, context) => {
                                    const data = context.chart.data.datasets[0].data;
                                    const total = data.reduce((a, b) => a + b, 0);
                                    const percentage = ((value / total) * 100).toFixed(1);
                                    return percentage + '%'; 
                                }
                            }
                        }
                    },
                    plugins: [ChartDataLabels] 
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
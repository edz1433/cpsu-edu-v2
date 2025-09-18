@extends('web.layouts.mainlayout')
@section('content')
<!DOCTYPE html>
<html>
<head>
    <title>Global Partner Institutions</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css"/>
    <style>
        #map {
            height: 500px;
            border-radius: 10px;
            margin-bottom: 20px;
        }
        .partners-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }
        .partner-card {
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 15px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
            background: #fff;
        }
        .partner-header {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }
        .color-box {
            width: 20px;
            height: 20px;
            margin-right: 10px;
            border-radius: 4px;
        }
        .partner-title {
            font-size: 16px;
            font-weight: bold;
            margin: 0;
        }
        .partner-location {
            font-size: 14px;
            color: #555;
        }
        .partner-desc {
            margin-top: 8px;
            font-size: 13px;
            line-height: 1.4;
        }
    </style>
</head>
<body>
    <h2 class="mb-3">🌍 International Partner Institutions</h2>
    <div id="map"></div>

    <div class="partners-container">
        @php
            $partners = [
                [
                    "name" => "Kansas State University",
                    "location" => "Manhattan, KS 66506, United States",
                    "desc" => "Exchange of scholars and scientists, professors for lectures, participation in conferences, exchange of academic information and materials.",
                    "coords" => [39.1911, -96.5761],
                    "color" => "#e74c3c"
                ],
                [
                    "name" => "Phranakhon Rajabhat University",
                    "location" => "Thailand",
                    "desc" => "Exchange of lectures for academic staff, trainings, and development of research.",
                    "coords" => [13.8806, 100.5856],
                    "color" => "#3498db"
                ],
                [
                    "name" => "Federal University of Sao Carlos",
                    "location" => "Brazil",
                    "desc" => "Joint research programs, exchange of students and faculty.",
                    "coords" => [-21.9797, -47.8819],
                    "color" => "#2ecc71"
                ],
                [
                    "name" => "Universitas Negeri Malang (UM)",
                    "location" => "Indonesia",
                    "desc" => "Research, education, community service, and human resource development.",
                    "coords" => [-7.9570, 112.6145],
                    "color" => "#f39c12"
                ],
                [
                    "name" => "Royal University of Agriculture",
                    "location" => "Cambodia",
                    "desc" => "Research collaboration and student exchange.",
                    "coords" => [11.5466, 104.9339],
                    "color" => "#9b59b6"
                ],
                [
                    "name" => "Wadwhani Operating Foundation",
                    "location" => "California, USA",
                    "desc" => "Entrepreneurial education and training programs.",
                    "coords" => [37.7749, -122.4194],
                    "color" => "#16a085"
                ]
            ];
        @endphp

        @foreach ($partners as $p)
            <div class="partner-card">
                <div class="partner-header">
                    <div class="color-box" style="background-color: {{ $p['color'] }};"></div>
                    <div>
                        <p class="partner-title">{{ $p['name'] }}</p>
                        <p class="partner-location">{{ $p['location'] }}</p>
                    </div>
                </div>
                <p class="partner-desc">{{ $p['desc'] }}</p>
            </div>
        @endforeach
    </div>

    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script>
        var map = L.map('map').setView([20, 0], 2);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        var partners = @json($partners);

        partners.forEach(p => {
            var marker = L.circleMarker(p.coords, {
                color: p.color,
                radius: 8,
                fillOpacity: 0.8
            }).addTo(map);

            marker.bindPopup("<b>" + p.name + "</b><br>" + p.location + "<br><small>" + p.desc + "</small>");
        });
    </script>
</body>
</html>
@endsection

@extends('web.layouts.mainlayout')
@section('content')
<!DOCTYPE html>
<html>
<head>
    <title>Global Partner Institutions</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css"/>
    <style>
        .container-partners {
            display: grid;
            grid-template-columns: 1fr 2fr;
            gap: 20px;
            margin-top: 20px;
        }
        #map {
            height: 600px;
            width: 100%;
            border-radius: 10px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }
        .partner-list {
            overflow-y: auto;
            max-height: 600px;
            padding-right: 10px;
        }
        .partner-card {
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 15px;
            background: #fff;
            box-shadow: 0 2px 5px rgba(0,0,0,0.08);
        }
        .partner-header {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }
        .color-box {
            width: 18px;
            height: 18px;
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
            font-size: 13px;
            margin-top: 8px;
            line-height: 1.4;
        }
    </style>
</head>
<body>
    <h2 class="mb-3">🌍 International Partner Institutions</h2>

    <div class="container-partners">
        <!-- Left side: details -->
        <div class="partner-list">
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

        <!-- Right side: map -->
        <div id="map"></div>
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
                fillOpacity: 0.9
            }).addTo(map);

            marker.bindPopup("<b>" + p.name + "</b><br>" + p.location + "<br><small>" + p.desc + "</small>");
        });
    </script>
</body>
</html>
@endsection

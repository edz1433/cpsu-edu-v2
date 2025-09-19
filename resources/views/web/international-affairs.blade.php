@extends('web.layouts.mainlayout')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Global Partner Institutions</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        body {
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
        }
        h2 {
            margin: 20px;
            font-size: 1.8rem;
            color: #2c3e50;
            text-align: center;
        }
        .container-partners {
            display: grid;
            grid-template-columns: 1fr 2fr;
            gap: 20px;
            margin: 20px;
        }
        #map {
            height: 600px;
            width: 100%;
            border-radius: 10px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.15);
        }
        .partner-list {
            overflow-y: auto;
            max-height: 600px;
            padding-right: 10px;
        }
        .partner-card {
            border: 1px solid #e0e0e0;
            border-radius: 12px;
            padding: 15px;
            margin-bottom: 15px;
            background: #fff;
            transition: all 0.2s ease;
            box-shadow: 0 2px 5px rgba(0,0,0,0.08);
            cursor: pointer;
        }
        .partner-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(0,0,0,0.12);
            background: #f8f9fa;
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
            color: #2c3e50;
        }
        .partner-location {
            font-size: 14px;
            color: #7f8c8d;
        }
        .partner-desc {
            font-size: 13px;
            margin-top: 8px;
            line-height: 1.4;
            color: #444;
        }

        /* Pulsing effect */
        .pulse-marker div::after {
            content: "";
            width: 16px;
            height: 16px;
            border-radius: 50%;
            position: absolute;
            top: 0;
            left: 0;
            animation: pulse 1s infinite;
            opacity: 0.5;
            background-color: inherit;
        }

        @keyframes pulse {
            0% { transform: scale(1); opacity: 0.7; }
            50% { transform: scale(2); opacity: 0; }
            100% { transform: scale(1); opacity: 0.7; }
        }

        @media (max-width: 992px) {
            .container-partners {
                grid-template-columns: 1fr;
            }
            #map {
                height: 400px;
            }
            .partner-list {
                max-height: unset;
                overflow-y: visible;
            }
        }
    </style>
</head>
<body>
    <h2>🌍 International Partner Institutions</h2>

    <div class="container-partners">
        <div class="partner-list">
            @php
                $partners = [
                    ["name"=>"Kansas State University","location"=>"Manhattan, KS 66506, United States","desc"=>"Exchange of scholars and scientists, professors for lectures, participation in conferences, exchange of academic information and materials.","coords"=>[39.1911, -96.5761],"color"=>"#e74c3c"],
                    ["name"=>"Phranakhon Rajabhat University","location"=>"Thailand","desc"=>"Exchange of lectures for academic staff, trainings, and development of research.","coords"=>[13.8806, 100.5856],"color"=>"#3498db"],
                    ["name"=>"Federal University of Sao Carlos","location"=>"Brazil","desc"=>"Joint research programs, exchange of students and faculty.","coords"=>[-21.9797, -47.8819],"color"=>"#2ecc71"],
                    ["name"=>"Universitas Negeri Malang (UM)","location"=>"Indonesia","desc"=>"Research, education, community service, and human resource development.","coords"=>[-7.9570, 112.6145],"color"=>"#f39c12"],
                    ["name"=>"Royal University of Agriculture","location"=>"Cambodia","desc"=>"Research collaboration and student exchange.","coords"=>[11.5466, 104.9339],"color"=>"#9b59b6"],
                    ["name"=>"Wadwhani Operating Foundation","location"=>"San Francisco, CA 94111, United States","desc"=>"Entrepreneurial education and training programs.","coords"=>[37.7947, -122.3965],"color"=>"#16a085"]
                ];
            @endphp

            @foreach ($partners as $index => $p)
                <div class="partner-card" data-index="{{ $index }}">
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

        <div id="map"></div>
    </div>

    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script>
        var map = L.map('map').setView([20, 0], 2);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        var partners = @json($partners);
        var markers = [];

        // Add static markers
        partners.forEach((p, i) => {
            var marker = L.circleMarker(p.coords, {
                color: p.color,
                radius: 8,
                fillOpacity: 0.9
            }).addTo(map);

            marker.bindPopup("<b>" + p.name + "</b><br>" + p.location + "<br><small>" + p.desc + "</small>");
            markers[i] = marker;
        });

        let activePulse;

        document.querySelectorAll('.partner-card').forEach(card => {
            card.addEventListener('click', () => {
                var index = card.getAttribute('data-index');
                var partner = partners[index];
                var marker = markers[index];

                // Center map on partner marker
                map.setView(partner.coords, 4, { animate: true });

                marker.openPopup();

                // Remove old pulse
                if (activePulse) {
                    map.removeLayer(activePulse);
                }

                // Add pulsing marker with partner color
                var pulseIcon = L.divIcon({ 
                    className: 'pulse-marker', 
                    html: `<div style="
                        width: 16px; height: 16px; border-radius: 50%; 
                        background-color: ${partner.color}; position: relative;
                    "></div>`
                });

                activePulse = L.marker(partner.coords, { icon: pulseIcon }).addTo(map);

                // Remove pulse after 1 minute (60000ms)
                setTimeout(() => {
                    if (activePulse) {
                        map.removeLayer(activePulse);
                        activePulse = null;
                    }
                }, 60000);

                // Ensure marker is centered in map container
                map.panTo(partner.coords, { animate: true });
            });
        });
    </script>
</body>
</html>
@endsection

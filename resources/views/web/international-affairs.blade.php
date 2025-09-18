@extends('web.layouts.mainlayout')
@section('content')
<!DOCTYPE html>
<html>
<head>
    <title>Leaflet in Laravel</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css"/>
    <style>
        #map {
            height: 500px;
            border-radius: 10px;
            margin-bottom: 20px;
        }
        .partner-list {
            margin-top: 20px;
        }
        .partner-item {
            display: flex;
            align-items: center;
            margin-bottom: 8px;
        }
        .color-box {
            width: 20px;
            height: 20px;
            margin-right: 10px;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <h2>🌍 Partner Countries</h2>
    <div id="map"></div>

    <div class="partner-list">
        <h3>Partner List</h3>
        <div class="partner-item">
            <div class="color-box" style="background-color: #e74c3c;"></div>Philippines
        </div>
        <div class="partner-item">
            <div class="color-box" style="background-color: #3498db;"></div>Japan
        </div>
        <div class="partner-item">
            <div class="color-box" style="background-color: #2ecc71;"></div>Australia
        </div>
    </div>

    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-ajax"></script>

    <script>
        // Initialize map
        var map = L.map('map').setView([10.3157, 123.8854], 3);

        // Add OpenStreetMap tiles
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        // Partner countries (sample coordinates using GeoJSON rectangles)
        var partners = [
            {
                name: "Philippines",
                coords: [[5, 115], [20, 128]], // rough bounding box
                color: "#e74c3c"
            },
            {
                name: "Japan",
                coords: [[30, 129], [46, 146]],
                color: "#3498db"
            },
            {
                name: "Australia",
                coords: [[-44, 113], [-10, 154]],
                color: "#2ecc71"
            }
        ];

        // Draw countries on map
        partners.forEach(p => {
            var rect = L.rectangle(p.coords, {
                color: p.color,
                weight: 2,
                fillOpacity: 0.4
            }).addTo(map);
            
            rect.bindPopup("<b>" + p.name + "</b>");
        });
    </script>
</body>
</html>
@endsection

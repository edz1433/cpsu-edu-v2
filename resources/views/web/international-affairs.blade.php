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
        }
    </style>
</head>
<body>
    <h2>My Leaflet Map</h2>
    <div id="map"></div>

    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script>
        // Initialize map
        var map = L.map('map').setView([10.3157, 123.8854], 13); // Example: Cebu City

        // Add OpenStreetMap tiles
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        // Marker
        L.marker([10.3157, 123.8854]).addTo(map)
            .bindPopup('Hello from Cebu!')
            .openPopup();
    </script>
</body>
</html>

@endsection

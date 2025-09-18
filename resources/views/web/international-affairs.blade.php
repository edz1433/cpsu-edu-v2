@extends('web.layouts.mainlayout')
@section('content')
<meta charset="UTF-8">
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css"/>
<style>
    body {
        font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
        background: #f9fafb;
        margin: 0;
        padding: 0;
    }
    .container {
        display: flex;
        height: 100vh;
    }
    .sidebar {
        width: 35%;
        background: #fff;
        border-right: 1px solid #ddd;
        overflow-y: auto;
        padding: 20px;
    }
    .sidebar h2 {
        margin-bottom: 20px;
        color: #1e3a8a;
    }
    .partner {
        padding: 15px;
        margin-bottom: 12px;
        border-radius: 10px;
        background: #f1f5f9;
        cursor: pointer;
        transition: 0.3s;
    }
    .partner:hover {
        background: #e2e8f0;
    }
    .partner strong {
        display: block;
        color: #0f172a;
    }
    .partner small {
        display: block;
        color: #475569;
        margin-top: 3px;
    }
    #map {
        flex: 1;
        height: 100%;
    }
</style>
<div class="container">
    <!-- Left Sidebar -->
    <div class="sidebar">
        <h2>Partner Institutions</h2>
        <div class="partner" onclick="focusMap('kansas')">
            <strong>Kansas State University</strong>
            <small>Manhattan, KS, USA</small>
            <small>Exchange of Scholars and Scientists</small>
        </div>
        <div class="partner" onclick="focusMap('thailand')">
            <strong>Phranakhon Rajabhat University</strong>
            <small>Thailand</small>
            <small>Lecturer Exchange, Training, Research</small>
        </div>
        <div class="partner" onclick="focusMap('brazil')">
            <strong>Federal University of Sao Carlos</strong>
            <small>Brazil</small>
            <small>Research & Student Exchange</small>
        </div>
        <div class="partner" onclick="focusMap('indonesia')">
            <strong>Universitas Negeri Malang (UM)</strong>
            <small>Indonesia</small>
            <small>Research, Education, HR Development</small>
        </div>
        <div class="partner" onclick="focusMap('cambodia')">
            <strong>Royal University of Agriculture</strong>
            <small>Cambodia</small>
            <small>Research & Student Exchange</small>
        </div>
        <div class="partner" onclick="focusMap('california')">
            <strong>Wadwhani Operating Foundation</strong>
            <small>California, USA</small>
            <small>Entrepreneurial Education</small>
        </div>
    </div>

    <!-- Right Map -->
    <div id="map"></div>
</div>

<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script>
    // Initialize map
    var map = L.map('map').setView([20, 0], 2);

    // Add modern basemap
    L.tileLayer('https://{s}.tile.openstreetmap.fr/hot/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors, HOT'
    }).addTo(map);

    // Locations with markers
    var locations = {
        kansas: {
            coords: [39.1974, -96.5847],
            popup: "<b>Kansas State University</b><br>Exchange of Scholars and Scientists"
        },
        thailand: {
            coords: [13.8476, 100.5696],
            popup: "<b>Phranakhon Rajabhat University</b><br>Lecturer Exchange, Training, Research"
        },
        brazil: {
            coords: [-21.9856, -47.8796],
            popup: "<b>Federal University of Sao Carlos</b><br>Research & Student Exchange"
        },
        indonesia: {
            coords: [-7.9666, 112.6326],
            popup: "<b>Universitas Negeri Malang (UM)</b><br>Research, Education, HR Development"
        },
        cambodia: {
            coords: [11.5449, 104.8922],
            popup: "<b>Royal University of Agriculture</b><br>Research & Student Exchange"
        },
        california: {
            coords: [37.7749, -122.4194],
            popup: "<b>Wadwhani Operating Foundation</b><br>Entrepreneurial Education"
        }
    };

    // Add all markers
    var markers = {};
    for (var key in locations) {
        var loc = locations[key];
        markers[key] = L.marker(loc.coords).addTo(map).bindPopup(loc.popup);
    }

    // Focus function
    function focusMap(key) {
        var loc = locations[key];
        map.setView(loc.coords, 6);
        markers[key].openPopup();
    }
</script>
@endsection

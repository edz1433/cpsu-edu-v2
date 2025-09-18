@extends('web.layouts.mainlayout')
@section('content')
<!DOCTYPE html>
<html>
<head>
    <title>Global Partner Institutions</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css"/>
    <style>
        body {
            margin: 0;
            font-family: "Segoe UI", sans-serif;
            background: #f9fafb;
            display: flex;
            height: 100vh;
        }
        .container-partners {
            display: grid;
            grid-template-columns: 300px 1fr;
            height: 100%;
            width: 100%;
        }
        .partners-list {
            background: #fff;
            border-right: 1px solid #ddd;
            overflow-y: auto;
            padding: 1rem;
        }
        .partner-card {
            padding: 0.8rem;
            margin-bottom: 0.8rem;
            border-radius: 8px;
            background: #f0f4f8;
            cursor: pointer;
            transition: background 0.3s;
            border-left: 5px solid transparent;
        }
        .partner-card:hover {
            background: #e0e7ef;
        }
        .map-container {
            width: 100%;
            height: 100%;
        }
        #map {
            width: 100%;
            height: 100%;
        }

        /* Pulse marker styles */
        .pulse-marker {
            width: 16px;
            height: 16px;
            border-radius: 50%;
            position: relative;
        }
        .pulse-ring {
            width: 16px;
            height: 16px;
            border-radius: 50%;
            position: absolute;
            top: 0;
            left: 0;
            animation: pulse 1s infinite;
            opacity: 0.5;
        }
        @keyframes pulse {
            0% { transform: scale(1); opacity: 0.7; }
            50% { transform: scale(2); opacity: 0; }
            100% { transform: scale(1); opacity: 0.7; }
        }
    </style>
</head>
<body>
<div class="container-partners">
    <div class="partners-list" id="partners-list"></div>
    <div class="map-container"><div id="map"></div></div>
</div>

<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script>
    // Example partner data
    var partners = [
        { name: "Harvard University", country: "USA", coords: [42.3770, -71.1167], color: "#e74c3c" },
        { name: "University of Tokyo", country: "Japan", coords: [35.7126, 139.7610], color: "#3498db" },
        { name: "University of Melbourne", country: "Australia", coords: [-37.7963, 144.9614], color: "#2ecc71" },
        { name: "Oxford University", country: "UK", coords: [51.7548, -1.2544], color: "#9b59b6" }
    ];

    // Initialize map
    var map = L.map('map').setView([20, 0], 2);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    var markers = [];
    var activePulse = null;

    // Add partner list + markers
    partners.forEach((partner, index) => {
        // Add to list
        var card = document.createElement('div');
        card.className = 'partner-card';
        card.style.borderLeftColor = partner.color;
        card.setAttribute('data-index', index);
        card.innerHTML = `<strong>${partner.name}</strong><br><small>${partner.country}</small>`;
        document.getElementById('partners-list').appendChild(card);

        // Add marker
        var marker = L.circleMarker(partner.coords, {
            radius: 8,
            color: partner.color,
            fillColor: partner.color,
            fillOpacity: 0.8
        }).addTo(map).bindPopup(`<b>${partner.name}</b><br>${partner.country}`);
        markers.push(marker);
    });

    // Handle card click
    document.querySelectorAll('.partner-card').forEach(card => {
        card.addEventListener('click', () => {
            var index = card.getAttribute('data-index');
            var partner = partners[index];
            var marker = markers[index];

            // Slight zoom (level 4)
            map.setView(partner.coords, 4, { animate: true });
            marker.openPopup();

            // Remove old pulse
            if (activePulse) {
                map.removeLayer(activePulse);
            }

            // Create a dynamic pulse
            var pulseIcon = L.divIcon({
                className: '',
                html: `
                    <div class="pulse-marker" style="background-color:${partner.color}">
                        <div class="pulse-ring" style="background-color:${partner.color}"></div>
                    </div>
                `,
                iconSize: [16, 16]
            });

            activePulse = L.marker(partner.coords, { icon: pulseIcon }).addTo(map);

            // Auto remove after 3 seconds
            setTimeout(() => {
                if (activePulse) {
                    map.removeLayer(activePulse);
                    activePulse = null;
                }
            }, 3000);
        });
    });
</script>
</body>
</html>

@endsection

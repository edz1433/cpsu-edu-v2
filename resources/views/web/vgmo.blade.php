@extends('web.layouts.mainlayout')
@section('content')
<style>
    .vgmo-container {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px; /* bigger gap for better breathing space */
        max-width: 1400px; /* limits extreme stretching on large screens */
        margin: 40px auto; /* centers the container and adds top/bottom spacing */
        padding: 20px;
    }
    .vgmo-container img {
        width: 100%;
        height: auto;
        border-radius: 15px;
        box-shadow: 0 6px 14px rgba(0, 0, 0, 0.15);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .vgmo-container img:hover {
        transform: scale(1.05);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.25);
    }

    /* Responsive for smaller screens */
    @media (max-width: 1024px) {
        .vgmo-container {
            grid-template-columns: repeat(2, 1fr);
        }
    }
    @media (max-width: 600px) {
        .vgmo-container {
            grid-template-columns: 1fr;
            margin: 20px; /* reduce margin for small screens */
        }
    }
</style>

<div class="vgmo-container">
    <img src="{{ asset('images/vision.jpg') }}" alt="Vision">
    <img src="{{ asset('images/mission.jpg') }}" alt="Mission">
    <img src="{{ asset('images/strategic-goals.jpg') }}" alt="Strategic Goals">
    <img src="{{ asset('images/objectives.jpg') }}" alt="Objectives">
</div>
@endsection

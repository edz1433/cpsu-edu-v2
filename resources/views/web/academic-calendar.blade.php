@extends('web.layouts.mainlayout')
@section('content')
<style>
    .vgmo-container {
        display: grid;
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
   

    /* Responsive for smaller screens */
  
</style>

<div class="vgmo-container">
    <img src="{{ asset('images/academic calendar (2).jpg') }}" alt=""></img>
</div>
@endsection

@extends('web.layouts.mainlayout')
@section('content')
<div class="container-fluid my-5">
  <div class="row">
    <!-- Left side: Labels -->
    <div class="col-md-3">
      <div class="card shadow">
        <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
          <h5 class="mb-0">Campus Map Labels</h5>
        </div>
        <div class="card-body" style="max-height: 75vh; overflow-y: auto;">
          <!-- Search box -->
          <input type="text" id="search-labels" class="form-control mb-3" placeholder="Search labels...">

          <ul class="list-group list-group-flush" id="labels-list">
            <li class="list-group-item">1. Admin Building</li>
            <li class="list-group-item">2. Science Building</li>
            <li class="list-group-item">3. Old Admin Building</li>
            <li class="list-group-item">4. College of Engineering</li>
            <li class="list-group-item">5. Agri. Science Building</li>
            <li class="list-group-item">6. CPSU Gymnasium</li>
            <li class="list-group-item">7. CPSU Hostel</li>
            <li class="list-group-item">8. CPSU Library</li>
            <li class="list-group-item">9. CPSU Chapel</li>
            <li class="list-group-item">10. CPSU Oval/Stage</li>
            <li class="list-group-item">11. Clinic</li>
            <li class="list-group-item">12. Old CRL Building</li>
            <li class="list-group-item">13. College of Arts & Sciences</li>
            <li class="list-group-item">14. CRL Library</li>
            <li class="list-group-item">15. CTE Faculty Office</li>
            <li class="list-group-item">16. CTE Classrooms</li>
            <li class="list-group-item">17. CTE New Building</li>
            <li class="list-group-item">18. CTE Old Building</li>
            <li class="list-group-item">19. CTE Graduate School</li>
            <li class="list-group-item">20. CTE Extension & Research Office</li>
            <li class="list-group-item">21. CAS Faculty Office</li>
            <li class="list-group-item">22. CAS Classrooms</li>
            <li class="list-group-item">23. CAS Laboratory</li>
            <li class="list-group-item">24. COE Faculty Office</li>
            <li class="list-group-item">25. COE Classrooms</li>
            <li class="list-group-item">26. COE Workshop</li>
            <li class="list-group-item">27. COE Laboratory</li>
            <li class="list-group-item">28. COE Old Building</li>
            <li class="list-group-item">29. COE New Building</li>
            <li class="list-group-item">30. CPSU Dormitory</li>
            <li class="list-group-item">31. CPSU Graduate School</li>
            <li class="list-group-item">32. ICT Laboratory</li>
            <li class="list-group-item">33. ICT Classrooms</li>
            <li class="list-group-item">34. ICT Faculty Office</li>
            <li class="list-group-item">35. CTE Laboratory</li>
            <li class="list-group-item">36. CPSU Stage</li>
            <li class="list-group-item">37. CAS New Building</li>
            <li class="list-group-item">38. CAS Old Building</li>
            <li class="list-group-item">39. Laboratory High School</li>
            <li class="list-group-item">40. Elementary School</li>
            <li class="list-group-item">41. Proposed Athletes Housing</li>
            <li class="list-group-item">42. Student Center</li>
            <li class="list-group-item">43. Veterinary Medicine Building</li>
            <li class="list-group-item">44. Motorpool/Bus Shed</li>
            <li class="list-group-item">45. Soccer Field</li>
            <li class="list-group-item">46. College of Agriculture</li>
            <li class="list-group-item">47. Agri. Extension Office</li>
            <li class="list-group-item">48. Research Office</li>
            <li class="list-group-item">49. Research Laboratory</li>
            <li class="list-group-item">50. CPSU Printing Press</li>
            <li class="list-group-item">51. CPSU Guest House</li>
            <li class="list-group-item">52. CPSU Housing</li>
            <li class="list-group-item">53. Student Housing</li>
            <li class="list-group-item">54. Teachers Housing</li>
            <li class="list-group-item">55. Employees Housing</li>
            <li class="list-group-item">56. Research Farm</li>
            <li class="list-group-item">57. Vermicompost Production</li>
            <li class="list-group-item">58. Piggery</li>
            <li class="list-group-item">59. Poultry</li>
            <li class="list-group-item">60. Goat Project</li>
            <li class="list-group-item">61. Cattle Project</li>
            <li class="list-group-item">62. CPSU Canteen</li>
            <li class="list-group-item">63. College of Business and Management</li>
          </ul>
        </div>
      </div>
    </div>

    <!-- Right side: Map -->
    <div class="col-md-9">
      <div class="map-container">
        <img src="{{ asset('images/cpsu-map.jpg') }}" alt="Campus Map" class="img-fluid">

        <!-- Example markers with matching IDs -->
        <div id="marker1" class="marker" data-label="1. Admin Building" style="top: 39%; left: 58.2%;" onclick="showPopup(this, '{{ asset('images/s-11.jpg') }}')"></div>
        <div id="marker2" class="marker" data-label="2. Science Building" style="top: 55%; left: 45%;" onclick="showPopup(this, '{{ asset('images/s-12.jpg') }}')"></div>
        <div id="marker3" class="marker" data-label="3. Old Admin Building" style="top: 65%; left: 35%;" onclick="showPopup(this, '{{ asset('images/s-13.jpg') }}')"></div>
        <div id="marker4" class="marker" data-label="4. College of Engineering" style="top: 48%; left: 25%;" onclick="showPopup(this, '{{ asset('images/s-14.jpg') }}')"></div>

        <!-- Popup -->
        <div id="popup" class="popup card shadow">
          <div class="card-body p-2">
            <img id="popup-img" src="" class="img-fluid rounded">
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<style>
.map-container {
  position: relative;
  width: 100%;
  margin: auto;
}
.map-container img {
  width: 100%;
  height: auto;
  display: block;
}
.marker {
  position: absolute;
  width: 28px;
  height: 28px;
  background: url("{{ asset('images/pin-point.png') }}") no-repeat center center;
  background-size: contain;
  cursor: pointer;
  transform: translate(-50%, -100%);
  border-radius: 50%;
  z-index: 1;
}

.marker.highlight::after {
  content: "";
  position: absolute;
  top: 50%;
  left: 50%;
  width: 28px;
  height: 28px;
  border-radius: 50%;
  background: rgba(0, 255, 0, 0.4);
  transform: translate(-50%, -50%) scale(1);
  animation: pulse 1.5s infinite;
  z-index: -1;
}

@keyframes pulse {
  0% {
    transform: translate(-50%, -50%) scale(1);
    opacity: 0.7;
  }
  70% {
    transform: translate(-50%, -50%) scale(2.5);
    opacity: 0;
  }
  100% {
    transform: translate(-50%, -50%) scale(1);
    opacity: 0;
  }
}

.active-label {
  background-color: #d1f7d1 !important;
  font-weight: bold;
}

.popup {
  display: none;
  position: absolute;
  z-index: 999;
  width: 200px;
  transform: translate(-50%, -120%);
}
</style>

<script>
  function showPopup(marker, imgSrc) {
    const popup = document.getElementById('popup');
    const popupImg = document.getElementById('popup-img');
    popupImg.src = imgSrc;

    popup.style.top = marker.style.top;
    popup.style.left = marker.style.left;
    popup.style.display = 'block';
  }

  document.addEventListener('click', function(e) {
    const popup = document.getElementById('popup');
    if (!e.target.classList.contains('marker')) {
      popup.style.display = 'none';
    }
  });

  // Search filter
  document.getElementById('search-labels').addEventListener('keyup', function() {
    const filter = this.value.toLowerCase();
    const items = document.querySelectorAll('#labels-list li');
    items.forEach(item => {
      const text = item.textContent.toLowerCase();
      item.style.display = text.includes(filter) ? '' : 'none';
    });
  });

  // Handle label click -> highlight marker
  const labelItems = document.querySelectorAll('#labels-list li');
  labelItems.forEach(item => {
    item.addEventListener('click', function() {
      resetHighlights();

      const markerId = this.getAttribute('data-marker');
      const marker = document.getElementById(markerId);

      if (marker) {
        marker.classList.add('highlight');
        this.classList.add('active-label');
        marker.scrollIntoView({ behavior: 'smooth', block: 'center', inline: 'center' });
      }
    });
  });

  // Handle marker click -> highlight label
  const markers = document.querySelectorAll('.marker');
  markers.forEach(marker => {
    marker.addEventListener('click', function(e) {
      resetHighlights();

      // Highlight marker
      this.classList.add('highlight');

      // Find matching label
      const markerId = this.id;
      const label = document.querySelector(`#labels-list li[data-marker="${markerId}"]`);
      if (label) {
        label.classList.add('active-label');
        label.scrollIntoView({ behavior: 'smooth', block: 'center' });
      }

      e.stopPropagation(); // avoid closing popup immediately
    });
  });

  // Reset highlights
  function resetHighlights() {
    document.querySelectorAll('.marker').forEach(m => m.classList.remove('highlight'));
    document.querySelectorAll('#labels-list li').forEach(l => l.classList.remove('active-label'));
  }
</script>
@endsection

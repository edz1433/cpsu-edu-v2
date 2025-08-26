<!DOCTYPE html>
<html lang="en">
@php
    $current_route=request()->route()->getName();
@endphp

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>CPSU HRIS {{ isset($title) ? ' | '.$title : '' }}</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('template/plugins/fontawesome-free-v6/css/all.min.css') }}">
    <!-- fullCalendar -->
    <link rel="stylesheet" href="{{ asset('template/plugins/fullcalendar/main.css') }}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('template/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('template/dist/css/adminlte.min.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('template/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('template/plugins/toastr/toastr.min.css') }}">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('template/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    <!-- Custom style -->
    <link rel="stylesheet" href="{{ asset('template/dist/css/style.css') }}">
    <!-- QR -->
    <script src="{{ asset('template/dist/js/html2canvas.min.js') }}"></script>
    <script src="{{ asset('template/dist/js/qrcode.min.js') }}"></script>
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('template/img/CPSU_L.png') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
	
	<link rel="stylesheet" type="text/css" href="{{ asset('template/plugins/summernote/summernote.css') }}">
    <style>
    .profile-image {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        object-fit: cover;
        margin-top: -7px;
        margin-right: 10px;
    }
    .img-circle1 {
        width: 40px !important;
        height: 40px !important;
        border-radius: 50% !important;
        object-fit: cover !important;
        border: 2px solid #ddd !important;
        display: block !important;
    }

    .nav-item.dropdown .dropdown-menu.notifications{
        width: 500px !important; /* Or whatever width you prefer */
        max-width: none !important; /* Ensure it doesn't get constrained by max-width */
    }
    .btn-success1 {
        background-color: #28a745 !important;
        border-color: #28a745 !important;
    }
    body.modal-open {
        overflow: hidden;   
    }
    .privacy-container h3 {
        margin-top: 1.5rem;
    }
    .privacy-container ul {
        padding-left: 20px;
    }
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed sidebar-collapse layout-navbar-fixed text-sm">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-warning">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars text-success1"></i></a>
                </li>
            </ul>
            
        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <!-- User Dropdown -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-success" href="#" data-toggle="dropdown">
                    <img src="{{ asset("Uploads/default-profile.png") }}" class="profile-image" alt="User">
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <form id="logout-form" action="{{ route('admin-logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="dropdown-item">
                            <i class="fas fa-power-off"></i> Sign Out
                        </button>
                    </form>
                </div>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Sidebar -->
    <aside class="main-sidebar sidebar-dim-green elevation-2">
        <!-- Brand Logo -->
        <a href="{{ route('admin-dashboard') }}" class="brand-link">
            <img src="{{ asset('template/img/CPSU_L.png') }}" alt="Logo" class="brand-image img-circle">
            <span class="brand-text font-weight-bold text-success1">CPSU</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- User panel -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="{{ asset("Uploads/default-profile.png") }}" class="img-circle1 elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <span class="d-block">{{ auth()->check() ? ucwords(auth()->user()->fname.' '.auth()->user()->lname) : 'Guest' }}</span>
                    <small class="text-muted">{{ auth()->check() ? (auth()->user()->role == 1 ? 'Web Administrator' : 'Content Administrator') : '' }}</small>
                </div>
            </div>
			<hr>
			@include('webadmin.layouts.sidebar')
    </aside>

    <!-- Content Wrapper -->
    <div class="content-wrapper pt-3">
        <div class="content">
            @yield('body')
        </div>
    </div>
    <!-- /.content-wrapper -->

    <!-- Footer -->
    <footer class="main-footer text-sm">
        <div class="d-flex justify-content-between flex-wrap">
            <div>
                <strong>All rights reserved.</strong> | 
                <a href="#" data-toggle="modal" data-target="#dataPrivacyModal">Data Privacy Policy</a>
            </div>
            <div>
                Maintained by <a href="https://www.facebook.com/cpsumiso.main" target="_blank">MIS</a>
            </div>
        </div>
    </footer>
</div>

<!-- Scripts -->
<script src="{{ asset('template/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('template/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('template/dist/js/adminlte.min.js') }}"></script>

<!-- Toastr & SweetAlert -->
<script src="{{ asset('template/plugins/toastr/toastr.min.js') }}"></script>
<script src="{{ asset('template/plugins/sweetalert2/sweetalert2.min.js') }}"></script>

<!-- DataTables -->
<script src="{{ asset('template/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('template/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('template/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('template/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('template/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('template/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('template/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('template/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('template/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('template/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>

<!-- Select2 -->
<script src="{{ asset('template/plugins/select2/js/select2.full.min.js') }}"></script>

<!-- ChartJS -->
<script src="{{ asset('template/plugins/chart.js/Chart.min.js') }}"></script>

<!-- jQuery UI -->
<script src="{{ asset('template/plugins/jquery-ui/jquery-ui.min.js') }}"></script>

<!-- FullCalendar -->
<script src="{{ asset('template/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('template/plugins/fullcalendar/main.js') }}"></script>

<script src="{{ asset('template/plugins/summernote/summernote.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.8/clipboard.min.js"></script>
<script>
$(function () {
    // DataTables init
    $("#example1, #example2, #example3").DataTable({
        responsive: true,
        autoWidth: false
    });

    // Select2
    $('.select2').select2({ theme: 'bootstrap4' });
});
</script>
<script>
  	$(document).ready(function() {
    	var $summernote = $('.summernote');
    	$summernote.summernote({
      	height: 300,
      	tabsize: 2,
    });
    
    $summernote.on('summernote.change', function(we, contents) {
      	$('#summernote-textarea').val(contents);
    });
    
    $('.btn-save').on('click', function(e) {
      	e.preventDefault(); 
      		$('form.mail-compose').submit();
    	});
  	});
</script>
<script>
    // Initialize Clipboard.js
    new ClipboardJS('.copy-link');

    // Show a message when the link is copied
    $('.copy-link').on('click', function () {
        $(this).attr('data-original-title', 'Copied!').tooltip('show');
    });
</script>
<script>
function deletethis(id, model) {
	var confirmation = confirm("Are you sure you want to delete this " + model + "?");

	if (confirmation) {
		$.ajax({
			type: "POST",
			url: "{{ route('delete') }}",
			data: {
				id: id,
				model: model,
				_token: "{{ csrf_token() }}"
			},
			success: function (response) {
				location.reload();
			},
			error: function (xhr, status, error) {
				alert('AJAX request failed with status ' + status + ': ' + error);
			}
		});
	}
}
</script>
<script>
$('#category').on('change', function () {
    var categoryId = $(this).val(); 
    var $subcategory = $('#subcategory');

    $subcategory.empty(); // clear old options
    $subcategory.append('<option value="">-- Select Sub Category --</option>');

    if (categoryId) {
		$.ajax({
			url: "{{ route('subcategories', ['id' => '']) }}/" + categoryId, // dynamic ID
			type: "GET",
			dataType: "json",
			success: function (res) {
				console.log("Subcategories loaded successfully:", res);

				let $subcategory = $('#subcategory');  
				$subcategory.empty();  
				$subcategory.append('<option value="">-- Select Sub Category --</option>');

				// Make sure res is an array
				if (Array.isArray(res)) {
					res.forEach(function (item) {
						$subcategory.append(
							$('<option>', {
								value: item.id,
								text: item.title
							})
						);
					});

					console.log("Subcategories loaded:", $subcategory.html());
				}
			},
			error: function (xhr) {
				console.error("Failed to load subcategories:", xhr.responseText);
			}
		});

	}
});
</script>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
@if (url()->current() == url('cpsu-edu/public/home'))
    @include('webadmin.layouts.header')
@else
    @include('webadmin.layouts.header')
@endif
@include('webadmin.layouts.sidebar')
@php
    $current_route=request()->route()->getName();
@endphp
<head>
	<!-- META ============================================= -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="keywords" content="" />
	<meta name="author" content="" />
	<meta name="robots" content="" />
	
	<!-- DESCRIPTION -->
	<meta name="description" content="EduChamp : Education HTML Template" />
	
	<!-- OG -->
	<meta property="og:title" content="EduChamp : Education HTML Template" />
	<meta property="og:description" content="EduChamp : Education HTML Template" />
	<meta property="og:image" content="" />
	<meta name="format-detection" content="telephone=no">
	
	<!-- FAVICONS ICON ============================================= -->
	<link rel="icon" href="../error-404.html" type="image/x-icon" />
	<link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets-admin/images/cpsu.png') }}" />

	<!-- PAGE TITLE HERE ============================================= -->
	<title>CPSU || Official Website</title>
	
	<!-- MOBILE SPECIFIC ============================================= -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<!-- All PLUGINS CSS ============================================= -->
	<link rel="stylesheet" type="text/css" href="{{ asset('assets-admin/css/assets.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets-admin/vendors/calendar/fullcalendar.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets-admin/vendors/summernote/summernote.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets-admin/vendors/file-upload/imageuploadify.min.css') }}">
	
	<!-- TYPOGRAPHY ============================================= -->
	<link rel="stylesheet" type="text/css" href="{{ asset('assets-admin/css/typography.css') }}">
	
	<!-- SHORTCODES ============================================= -->
	<link rel="stylesheet" type="text/css" href="{{ asset('assets-admin/css/shortcodes/shortcodes.css') }}">
	
	<!-- STYLESHEETS ============================================= -->
	<link rel="stylesheet" type="text/css" href="{{ asset('assets-admin/css/style.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets-admin/css/dashboard.css') }}">
  {{-- <link class="skin" rel="stylesheet" type="text/css" href="{{ asset('assets/css/color/color-1.css') }}"> --}}

  	<!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('assets-admin/vendors/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets-admin/vendors/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets-admin/vendors/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

	<style>
		.default-bg{
			background-color:  #04401f;
			color:  #ffff;
		}
	</style>

</head>
<body class="ttr-opened-sidebar ttr-pinned-sidebar">
	<!-- header start -->
    @yield('header')
	<!-- header end -->

	<!-- Left sidebar menu start -->
    @yield('sidebar')
	<!-- Left sidebar menu end -->

	<!--Main container start -->
    @yield('content')
  	<!--Main container End -->
    
	<div class="ttr-overlay"></div>

<!-- External JavaScripts -->
<script src="{{ asset('assets-admin/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets-admin/vendors/bootstrap/js/popper.min.js') }}"></script>
<script src="{{ asset('assets-admin/vendors/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets-admin/vendors/bootstrap-select/bootstrap-select.min.js') }}"></script>
<script src="{{ asset('assets-admin/vendors/bootstrap-touchspin/jquery.bootstrap-touchspin.js') }}"></script>
<script src="{{ asset('assets-admin/vendors/magnific-popup/magnific-popup.js') }}"></script>
<script src="{{ asset('assets-admin/vendors/counter/waypoints-min.js') }}"></script>
<script src="{{ asset('assets-admin/vendors/counter/counterup.min.js') }}"></script>
<script src="{{ asset('assets-admin/vendors/imagesloaded/imagesloaded.js') }}"></script>
<script src="{{ asset('assets-admin/vendors/masonry/masonry.js') }}"></script>
<script src="{{ asset('assets-admin/vendors/masonry/filter.js') }}"></script>
<script src="{{ asset('assets-admin/vendors/owl-carousel/owl.carousel.js')}}"></script>
<script src='{{ asset('assets-admin/vendors/scroll/scrollbar.min.js') }}'></script>
<script src="{{ asset('assets-admin/js/functions.js') }}"></script>
<script src="{{ asset('assets-admin/vendors/chart/chart.min.js') }}"></script>
<script src="{{ asset('assets-admin/js/admin.js') }}"></script>
<script src='{{ asset('assets-admin/vendors/calendar/moment.min.js') }}'></script>
<script src='{{ asset('assets-admin/vendors/calendar/fullcalendar.js') }}'></script>
<script src="{{ asset('assets-admin/vendors/summernote/summernote.js') }}"></script>
<script src="{{ asset('assets-admin/vendors/file-upload/imageuploadify.min.js') }}"></script>
{{-- <script src='{{ asset('assets-admin/vendors/switcher/switcher.js') }}'></script> --}}

<!-- DataTables  & Plugins -->
<script src="{{ asset('assets-admin/vendors/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets-admin/vendors/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets-admin/vendors/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets-admin/vendors/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets-admin/vendors/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets-admin/vendors/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script> 
{{-- <script src="{{ asset('assets-admin/vendors/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('assets-admin/vendors/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('assets-admin/vendors/pdfmake/vfs_fonts.js') }}"></script> --}}
<script src="{{ asset('assets-admin/vendors/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('assets-admin/vendors/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('assets-admin/vendors/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.8/clipboard.min.js"></script>

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
	function toggleDiv() {
		const div = document.getElementById('myDiv');
		div.style.display = div.style.display === 'none' ? 'block' : 'none';
	}
	const toggleButton = document.getElementById('toggleButton');
    toggleButton.addEventListener('click', toggleDiv);
</script>
<script>
    $(function () {
        $("#example1").DataTable({
            "responsive": false,
            "lengthChange": true, 
            "autoWidth": true,
            //"buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]

        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');


        $("#example3").DataTable({
            "responsive": true,
            "lengthChange": true, 
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]

        }).buttons().container().appendTo('#example3_wrapper .col-md-6:eq(0)');
        
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

<!-- Mirrored from educhamp.themetrades.com/demo/admin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 22 Feb 2019 13:09:05 GMT -->
</html>
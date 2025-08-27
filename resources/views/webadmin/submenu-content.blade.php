@extends('webadmin.layouts.mainlayout')
@include('webadmin.layouts.header')

@section('body')
<div class="container pt-3">
    <div class="row">
        <div class="col-lg-12">
            <!-- Card -->
            <div class="card shadow-sm">
                <div class="card-header bg-success text-white">
                    <h3 class="card-title text-center w-100">{{ $submenu->title }}</h3>
                </div>
                <div class="card-body">
                    <div id="file-content">
                        @php
                            use Illuminate\Support\Facades\Storage;

                            $content = '';
                            if ($submenu->content && Storage::disk('public')->exists('Uploads/Submenu/content/' . $submenu->content)) {
                                $content = Storage::disk('public')->get('Uploads/Submenu/content/' . $submenu->content);
                            } else {
                                $content = '<p>Content not available.</p>';
                            }
                        @endphp

                        {!! $content !!}
                    </div>
                </div>
            </div>
            <!-- End Card -->
        </div>
    </div>
</div>
@endsection

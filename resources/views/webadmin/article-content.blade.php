@extends('webadmin.layouts.mainlayout')
@include('webadmin.layouts.header')

@section('content')
<main class="ttr-wrapper">
    <div class="container-fluid">
        <div class="db-breadcrumb">
            <h4 class="breadcrumb-title">Articles</h4>
            <ul class="db-breadcrumb-list">
                <li><a href="{{ route('admin-dashboard') }}"><i class="fa fa-home"></i>Dashboard</a></li>
                <li><a href="{{ route('admin-articles') }}">Articles</a></li>
                <li>View</li>
            </ul>
        </div>  
        <div class="row">
            <div class="col-lg-12 m-b30">
                <div class="widget-box">
                    <div class="wrapper">
                        <div class="container pt-4">
                            <h4 class="text-center">{{ $article->title }}</h4>
                            <div id="file-content">
                                @php
                                    $contentFilePath = storage_path("app/public/Uploads/News/content/{$article->content}");
                                    $content = 'Content not available';
                                    if (!empty($article->content) && file_exists($contentFilePath)) {
                                        $content = file_get_contents($contentFilePath);
                                        // Remove all <img> tags
                                        $content = preg_replace('/<img\b[^>]*>(?:<\/img>)?/i', '', $content);
                                    }
                                @endphp
                                {!! $content !!}
                            </div>
                        </div>
                    </div>
                </div> 
            </div>
        </div>
    </div>
</main>
@endsection

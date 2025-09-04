@extends('webadmin.layouts.mainlayout')
@include('webadmin.layouts.header')

@section('body')
<main class="ttr-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 m-b30">
                <div class="widget-box">
                    <div class="wrapper">
                        <div class="container pt-4">
                            <h4 class="text-center">{{ $article->title }}</h4>
                            <div id="file-content">
                                @php
                                    $contentFilePath = public_path("Uploads/News/content/{$article->content}");
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

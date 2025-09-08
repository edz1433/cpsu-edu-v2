@extends('web.layouts.mainlayout')
@section('content')
<div class="section-area section-sp2 popular-courses-bx" style="background-color: #f9f9f9;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h4 class="widget-title mb-4 text-success1" style="font-weight: 700; border-bottom: 2px solid #14532D; padding-bottom: 10px;">
                    Search Results for "{{ request()->input('s') }}"
                </h4>

                @forelse ($article as $art)
                    <div class="search-result-item p-3 mb-4 border rounded shadow-sm hover-shadow" style="background-color: #fff;">
                        <h5 class="post-title text-success1 mb-2">
                            <a href="{{ route('view-article', ['id' => $art->id]) }}" class="text-success1 text-decoration-none">
                                {{ $art->title }}
                            </a>
                        </h5>
                        <p class="text-muted mb-2" style="font-size: 0.9rem;">
                            {{ \Carbon\Carbon::parse($art->date)->format('F d, Y') }}
                        </p>
                        <p style="text-align: justify; line-height: 1.6;">
                            {!! $art->excerpt !!}
                        </p>
                    </div>
                @empty
                    <p class="text-muted py-5 text-center">No articles found matching your search.</p>
                @endforelse

                <div class="d-flex justify-content-center mt-4">
                    {{ $article->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.hover-shadow:hover {
    box-shadow: 0 8px 20px rgba(0,0,0,0.12);
    transition: all 0.3s ease;
}
.text-success1 {
    color: #14532D !important;
}
.pt-btn {
    font-weight: 500;
    text-decoration: underline;
    color: #14532D;
}
.pt-btn:hover {
    color: #14532D;
    text-decoration: none;
}
</style>
@endsection

@extends('web.layouts.mainlayout')

@section('content')
<div class="container py-4">

    {{-- Job listings --}}
    <div class="row">
        @forelse($jobs as $job)
        <div class="col-md-6 mb-4">
            <div class="card h-100 shadow-sm job-card">
                <div class="card-body position-relative">
                    {{-- Job title & Apply Now --}}
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h5 class="card-title text-success font-weight-bold mb-1">{{ $job['title'] }}</h5>
                            <p class="text-muted small mb-1">Plantilla Item No.: {{ $job['plantilla_item_no'] }}</p>
                            <p class="font-weight-bold text-dark mb-2">
                                Salary: ₱{{ number_format((float) $job['salary'], 2) }}
                            </p>
                        </div>
                        <a href="" class="btn btn-danger btn-sm apply-btn" data-toggle="modal" data-target="#requirement-modal">Requirements</a>
                    </div>

                    {{-- Job details --}}
                    <div class="row small mt-3">
                        <div class="col-12 mb-1">
                            <span class="font-weight-bold text-success">Office Assignment:</span> {{ $job['assignment'] }}
                        </div>
                        <div class="col-12 mb-1">
                            <span class="font-weight-bold text-success">Education:</span> {{ $job['education'] }}
                        </div>
                        <div class="col-12 mb-1">
                            <span class="font-weight-bold text-success">Eligibility:</span> {{ $job['eligibility'] }}
                        </div>
                        <div class="col-12 mb-1">
                            <span class="font-weight-bold text-success">Training:</span> {{ $job['training'] }}
                        </div>
                        <div class="col-12 mb-1">
                            <span class="font-weight-bold text-success">Experience:</span> {{ $job['experience'] }}
                        </div>
                        <div class="col-12 mb-1">
                            <span class="font-weight-bold text-success">Competency:</span> {{ $job['competency'] }}
                        </div>
                    </div>

                    {{-- Posted / Expiration --}}
                    <p class="text-muted small mt-3 pt-2 border-top">
                        Posted: {{ \Carbon\Carbon::parse($job['posted_at'])->format('F d, Y') }} |
                        Expiration: {{ \Carbon\Carbon::parse($job['expiration_at'])->format('F d, Y') }}
                    </p>
                </div>
            </div>
        </div>
        @empty
        <p class="col-12 text-center text-muted">No job postings available at the moment.</p>
        @endforelse
    </div>
</div>
<div class="modal fade" id="requirement-modal" tabindex="-1" role="dialog" aria-labelledby="requirementModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body text-center">
                <img src="{{ asset('images/requirements.jpg') }}" width="100%" alt="Requirements" class="img-fluid rounded">
            </div>
            
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .job-card {
        border: 1px solid #e0e0e0;
        border-radius: .75rem;
    }
    .apply-btn {
        border-radius: .25rem;
        padding: .25rem .75rem;
        font-weight: 500;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
</style>
@endpush

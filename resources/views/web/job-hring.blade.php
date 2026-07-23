@extends('web.layouts.mainlayout')

@section('content')
<div class="container py-4">
    <style>
    .job-card {
        /* border: 1px solid #e0e0e0;
        border-radius: .75rem; */
    }
    .apply-btn {
        border-radius: .25rem;
        padding: .25rem .75rem;
        font-weight: 500;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    .track-btn {
        border-radius: 50px;
        font-weight: 600;
        font-size: 1rem;
        letter-spacing: 0.5px;
        transition: all 0.3s ease;
    }
    .track-btn:hover {
        background-color: #c82333;
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(0, 0, 0, 0.15);
    }
    #status-output {
        margin-top: 20px;
        padding: 15px;
        /* border: 1px solid #ccc;
        border-radius: 8px;
        background-color: #f8f9fa; */
    }
    .application-timeline {
        font-family: 'Segoe UI', sans-serif;
    }

    /* Header with logo and title */
    .header {
        display: flex;
        margin-bottom: 10px;
        margin-left: auto;
        margin-right: auto;
    }

    .header img {
        width: 60px;
        height: 60px;
        object-fit: contain;
        margin-right: 15px;
    }

    .header h1 {
        font-size: 24px;
        color: #333;
        margin: 0;
    }

    .application-timeline {
        position: relative;
        margin: 0 auto;
        padding-left: 40px;
    }

    .application-timeline::before {
        content: '';
        position: absolute;
        left: 20px;
        top: 0;
        bottom: 0;
        width: 4px;
        background: #ddd;
    }

    .timeline-header {
        text-align: left;
        margin-bottom: 30px;
        color: #1e293b;
        font-size: 20px;
        font-weight: 600;
        padding: 10px 20px;
        background: #f1f5f9;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    }

    .timeline-date {
        display: inline-block;
        color: #fff;
        padding: 5px 12px;
        border-radius: 12px;
        margin: 20px 0;
        font-weight: bold;
        font-size: 14px;
    }

    .timeline-date.red { background: #f44336; }     /* DQ */
    .timeline-date.teal { background: #00bcd4; }    /* Applied */
    .timeline-date.yellow { background: #ff9800; }  /* Review */
    .timeline-date.blue { background: #2196f3; }    /* Interview */
    .timeline-date.green { background: #4caf50; }   /* Approved */

    .timeline-item {
        position: relative;
        margin: 20px 0;
        display: flex;
        align-items: flex-start;
        opacity: 0;
        transform: translateY(30px);
        transition: all 0.6s ease-out;
    }

    .timeline-item.visible {
        opacity: 1;
        transform: translateY(0);
    }

    .timeline-icon {
        flex-shrink: 0;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 15px;
        box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
    }

    .timeline-icon svg {
        width: 24px;
        height: 24px;
        fill: currentColor;
        transition: all 0.3s ease;
    }

    /* Icon colors */
    .timeline-icon.applied { 
    border: 3px solid #00bcd4; 
    color: #00bcd4; 
    background: #e0f7fa; 
    }

    .timeline-icon.review { border: 3px solid #ff9800; color: #ff9800; background: #fff8f0; }
    .timeline-icon.interview { border: 3px solid #2196f3; color: #2196f3; background: #e6f0ff; }
    .timeline-icon.dq { border: 3px solid #f44336; color: #f44336; background: #fff0f0; }
    .timeline-icon.approved { border: 3px solid #4caf50; color: #4caf50; background: #e6ffe6; }

    /* Pop effect on hover */
    .timeline-icon:hover {
        transform: scale(1.2);
        box-shadow: 0 4px 12px rgba(0,0,0,0.2);
    }

    .timeline-content {
        padding: 15px 20px;
        border-radius: 12px;
        box-shadow: 0 3px 8px rgba(0,0,0,0.05);
        max-width: 550px;
    }

    .timeline-content.red { background: #ffe5e5; }
    .timeline-content.teal { background: #e0f7fa; }
    .timeline-content.yellow { background: #fff5e0; }
    .timeline-content.blue { background: #e6f0ff; }
    .timeline-content.green { background: #e6ffe6; }

    .timeline-content h4 {
        margin: 0 0 5px;
        font-size: 16px;
        font-weight: 600;
    }

    .timeline-content p {
        margin: 0;
        font-size: 14px;
        line-height: 1.5;
    }

    .timeline-link {
        display: inline-block;
        margin-top: 8px;
        color: #2196f3;
        text-decoration: none;
        font-weight: 500;
        transition: all 0.3s;
    }

    .timeline-link:hover {
        text-decoration: underline;
        transform: translateY(-2px);
    }
    .job-detail-toggle {
        border: 0;
        background: transparent;
        color: #28a745;
        font-size: 0.875rem;
        font-weight: 600;
        padding: 0;
    }
    .job-detail-toggle:hover,
    .job-detail-toggle:focus {
        color: #1e7e34;
        text-decoration: underline;
        outline: none;
    }
    .job-detail-collapsible {
        max-height: 96px;
        overflow: hidden;
        position: relative;
    }
    .job-detail-collapsible::after {
        content: '';
        position: absolute;
        right: 0;
        bottom: 0;
        left: 0;
        height: 32px;
        background: linear-gradient(rgba(255, 255, 255, 0), #fff);
        pointer-events: none;
    }
    .job-detail-collapsible.expanded {
        max-height: none;
    }
    .job-detail-collapsible.expanded::after {
        display: none;
    }
    </style>
    <div class="row mb-4">
        <div class="col-md-12 text-right">
            <a href="#" class="btn btn-danger btn-lg track-btn px-4 py-2 shadow-sm" data-toggle="modal" data-target="#trackModal">
                <i class="fa fa-check mr-2"></i>Track Application
            </a>
        </div>
    </div>

    <div class="row" id="job-listing">
        @forelse($jobs as $job)
        <div class="col-md-6 mb-4">
            <div class="card h-100 shadow-sm job-card">
                <div class="card-body position-relative">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h5 class="card-title text-success font-weight-bold mb-1">{{ $job['title'] }}</h5>
                            <p class="text-muted small mb-1">Plantilla Item No.: {{ $job['plantilla_item_no'] }}</p>
                            <p class="font-weight-bold text-dark mb-2">
                                Salary: ₱{{ number_format((float) $job['salary'], 2) }}
                            </p>
                        </div>
                        <a href="{{ route('apply.job', ['jobId' => $job['id'], 'jobTitle' => $job['title']]) }}" 
                           class="btn btn-danger btn-sm apply-btn">Apply Now</a>
                    </div>

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
                            <div class="job-detail-collapsible" id="job-details-{{ $job['id'] }}">
                                <div class="mb-1">
                                    <span class="font-weight-bold text-success">Competency:</span> {!! nl2br(e($job['competency'])) !!}
                                </div>
                                @if(!empty($job['requirements']))
                                <div class="mt-2">
                                    <span class="font-weight-bold text-success">Requirements:</span> {!! nl2br(e($job['requirements'])) !!}
                                </div>
                                @endif
                            </div>
                            <button type="button"
                                    class="job-detail-toggle mt-1"
                                    data-target="job-details-{{ $job['id'] }}"
                                    aria-expanded="false">
                                Read more
                            </button>
                        </div>
                    </div>

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

    {{-- Application Status will replace job listing --}}
    <div class="row" id="status-output" style="display:none;">
        <div class="col-12">
            Loading application status...
        </div>
    </div>

    

</div>

<!-- Track Modal -->
<div class="modal fade" id="trackModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content border-0 rounded-lg shadow-lg">
      <div class="modal-body text-center p-4">
        <i class="fa fa-search text-danger mb-3" style="font-size: 48px;"></i>
        <h5 class="mb-3 font-weight-bold">Track Your Application</h5>
        <p class="text-muted mb-4">
          Please enter your <strong>Application Number</strong> that was sent to your email to check your application status.
        </p>

        <form id="track-form">
            <div class="form-group">
                <input type="text" class="form-control form-control-lg text-center"
                       id="app_number" name="app_number"
                       placeholder="Enter your application number" required>
                <button type="submit" hidden></button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('track-form');
    const jobListing = document.getElementById('job-listing');
    const statusOutput = document.getElementById('status-output');
    const trackModal = $('#trackModal'); // Bootstrap modal

    document.querySelectorAll('.job-detail-toggle').forEach(button => {
        const detail = document.getElementById(button.dataset.target);
        if (!detail) return;

        if (detail.scrollHeight <= detail.clientHeight) {
            button.style.display = 'none';
            detail.classList.add('expanded');
            return;
        }

        button.addEventListener('click', function () {
            const isExpanded = detail.classList.toggle('expanded');
            button.textContent = isExpanded ? 'Show less' : 'Read more';
            button.setAttribute('aria-expanded', isExpanded ? 'true' : 'false');
        });
    });

    form.addEventListener('submit', function (e) {
        e.preventDefault();
        const appNumber = document.getElementById('app_number').value.trim();
        if (!appNumber) return alert('Please enter a valid application number.');

        // Loading view
        jobListing.style.display = 'none';
        statusOutput.style.display = 'block';
        statusOutput.innerHTML = '<p>Loading application status...</p>';

        const apiUrl = "{{ env('HRIS_API_URL') }}";

        axios.get(`${apiUrl}/application/status/${appNumber}`)
            .then(res => {
                const response = res.data || {};
                const data = response.data || {};
                
                const status = parseInt(data.status);
                const isComplete = parseInt(data.is_complete);

                // ✅ CPSU HR Department – Formal Application Status Definitions
                const stages = [
                    {
                        id: 0,
                        title: 'Application Submitted',
                        desc: 'Your application has been successfully submitted. Kindly check your email for confirmation and any further instructions from the CPSU Human Resources Department.',
                        color: 'teal',
                        icon: 'applied'
                    },
                    {
                        id: 1,
                        title: 'Under Review',
                        desc: 'Your application is currently being reviewed by the CPSU Human Resources Department. Please monitor your email for any updates or additional requirements.',
                        color: 'yellow',
                        icon: 'review'
                    },
                    {
                        id: 2,
                        title: 'Qualified for Interview',
                        desc: 'You have been shortlisted for an interview. Please check your email for the interview schedule, venue, and further instructions from the CPSU Human Resources Department.',
                        color: 'blue',
                        icon: 'interview'
                    },
                    {
                        id: 3,
                        title: 'Disqualified',
                        desc: data.reason || 'After careful evaluation, your application did not meet the qualification requirements for the position. Please refer to your email for further details from the CPSU Human Resources Department.',
                        color: 'red',
                        icon: 'dq'
                    },
                    {
                        id: 4,
                        title: 'Qualified but Not Selected',
                        desc: 'You were found qualified but were not selected to proceed to the next stage of the recruitment process. Please refer to your email for further information or future opportunities with CPSU.',
                        color: 'orange',
                        icon: 'review'
                    },
                    {
                        id: 5,
                        title: 'For Psychological / Pre-Employment Test',
                        desc: 'You have been endorsed to advance to the next stage of the recruitment process for a psychological or pre-employment test. Kindly check your email for your schedule and further instructions from the CPSU Human Resources Department.',
                        color: 'green',
                        icon: 'approved'
                    },
                    {
                        id: 6,
                        title: 'Not Hired',
                        desc: 'We sincerely appreciate your interest in joining Central Philippines State University. After thorough evaluation, you were not selected for the position. Please check your email for additional information from the CPSU Human Resources Department.',
                        color: 'gray',
                        icon: 'dq'
                    },
                    {
                        id: 7,
                        title: 'Hired',
                        desc: 'Congratulations! You have been selected for the position at Central Philippines State University. Please check your email for onboarding details and next steps from the CPSU Human Resources Department.',
                        color: 'green',
                        icon: 'approved'
                    }
                ];

                let html = `
                    <div class="header">
                        <h1>${data.position || '&emsp;APPLICATION'}</h1>
                    </div>
                    <div class="application-timeline">
                        <div class="timeline-header">
                            Application #: ${data.app_number || appNumber}
                        </div>
                `;

                // ✅ Stages actually passed through for each status.
                // Statuses are NOT a linear scale — 3, 4 and 6 are branch outcomes,
                // so an applicant can reach them without ever being interviewed.
                const stagePaths = {
                    0: [0],             // Application Submitted
                    1: [0, 1],          // Under Review
                    2: [0, 1, 2],       // Qualified for Interview
                    3: [0, 1, 3],       // Disqualified (never reached interview)
                    4: [0, 1, 4],       // Qualified but Not Selected (never reached interview)
                    5: [0, 1, 2, 5],    // For Psychological / Pre-Employment Test
                    6: [0, 1, 2, 5, 6], // Not Hired
                    7: [0, 1, 2, 5, 7]  // Hired
                };

                const path = stagePaths[status] || stagePaths[0];

                // ✅ Render only the stages on this application's path
                for (let stageId of path) {
                    const stage = stages.find(s => s.id === stageId);
                    if (!stage) continue;

                    html += `
                            <div class="timeline-date ${stage.color}">${stage.title}</div>
                            <div class="timeline-item active">
                                <div class="timeline-icon ${stage.icon}">
                                    ${getIconSVG(stage.icon)}
                                </div>
                                <div class="timeline-content ${stage.color}">
                                    <h4>${stage.title}</h4>
                                    <p>${stage.desc}</p>
                                    ${
                                        stage.id === 3 && data.reason
                                            ? `<div class="dq-reason"><strong>Reason:</strong> ${data.reason}</div>`
                                            : ''
                                    }
                                </div>
                            </div>
                        `;
                }

                // ✅ Add “Awaiting Next Update” only while the application is still in progress.
                // 3, 4, 6 and 7 are final outcomes — nothing further is coming.
                const finalStatuses = [3, 4, 6, 7];
                if (isComplete === 0 && !finalStatuses.includes(status)) {
                    html += `
                        <div class="timeline-item">
                            <div class="timeline-icon muted" style="border: 3px dashed #ccc; color: #999; background: #f9f9f9;">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                    <path d="M12 2a10 10 0 1 0 10 10A10 10 0 0 0 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/>
                                </svg>
                            </div>
                            <div class="timeline-content blue">
                                <h4>Awaiting Next Update</h4>
                                <p>Please wait while your application progresses to the next stage.</p>
                            </div>
                        </div>
                    `;
                }

                html += '</div>'; // close timeline
                statusOutput.innerHTML = html;

                // Close modal after short delay
                setTimeout(() => {
                    trackModal.modal('hide');
                }, 400);
            })
            .catch(err => {
                console.error(err);
                statusOutput.innerHTML = '<p style="color:red;">Error fetching application status. Please check your number or try again later.</p>';
            });
    });

    // ✅ SVG Icons
    function getIconSVG(type) {
        const icons = {
            applied: `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8l-6-6zM6 20V4h7v5h5v11H6z"/></svg>`,
            review: `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M21 21l-4.35-4.35M11 4a7 7 0 1 0 0 14 7 7 0 0 0 0-14z"/></svg>`,
            interview: `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4S14.21 4 12 4 8 5.79 8 8s1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>`,
            dq: `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/></svg>`,
            approved: `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 2a10 10 0 1 0 10 10A10 10 0 0 0 12 2zm-1 15l-5-5 1.41-1.41L11 14.17l7.59-7.59L20 8z"/></svg>`
        };
        return icons[type] || '';
    }
});
</script>

<!-- ✅ Fade-in animation -->
<script>
document.addEventListener('DOMContentLoaded', () => {
  const observer = new IntersectionObserver(entries => {
    entries.forEach(entry => {
      if (entry.isIntersecting) entry.target.classList.add('visible');
    });
  }, { threshold: 0.2 });

  const watchTimeline = () => {
    document.querySelectorAll('.timeline-item').forEach(item => observer.observe(item));
  };

  // Run again when content changes (after status loads)
  const target = document.getElementById('status-output');
  const mutationObserver = new MutationObserver(watchTimeline);
  mutationObserver.observe(target, { childList: true, subtree: true });
});
</script>

<script>
  // Scroll fade-in effect
  const items = document.querySelectorAll('.timeline-item');
  const observer = new IntersectionObserver(entries => {
    entries.forEach(entry => {
      if(entry.isIntersecting) {
        entry.target.classList.add('visible');
      }
    });
  }, { threshold: 0.2 });

  items.forEach(item => observer.observe(item));
</script>
@endsection


<style>
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
</style>
</head>
<body>
<!-- Header with Logo and Title -->
<div class="header">
    <h1> &emsp;ACCOUNTANT I</h1>
</div>

<div class="application-timeline">
  <div class="timeline-header">
    Application #: NSCAB-AI-93-2023-EMP-5456
  </div>
  
  <div class="timeline-date teal">Applied</div>
  <div class="timeline-item">
    <div class="timeline-icon applied">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8l-6-6zM6 20V4h7v5h5v11H6z"/></svg>
    </div>
    <div class="timeline-content teal">
      <h4>Application Submitted</h4>
      <p>Your application has been successfully submitted and is now under review.</p>
    </div>
  </div>

  <div class="timeline-date yellow">Under Review</div>
  <div class="timeline-item">
    <div class="timeline-icon review">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M21 21l-4.35-4.35M11 4a7 7 0 1 0 0 14 7 7 0 0 0 0-14z"/></svg>
    </div>
    <div class="timeline-content yellow">
      <h4>HR is Reviewing</h4>
      <p>The HR team is currently reviewing your qualifications.</p>
    </div>
  </div>

  <div class="timeline-date blue">Interview</div>
  <div class="timeline-item">
    <div class="timeline-icon interview">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4S14.21 4 12 4 8 5.79 8 8s1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
    </div>
    <div class="timeline-content blue">
      <h4>Interview Scheduled</h4>
      <p>You have been scheduled for an interview. Check your email for details.</p>
      <a href="#" class="timeline-link">View interview details</a>
    </div>
  </div>

  <div class="timeline-date red">Disqualified</div>
  <div class="timeline-item">
    <div class="timeline-icon dq">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10
                10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/>
      </svg>
    </div>
    <div class="timeline-content red">
      <h4>Application Disqualified</h4>
      <p>Unfortunately, your application did not meet the requirements.</p>
      <div class="dq-reason">
        <strong>Reason:</strong> Did not meet minimum experience requirement.
      </div>
    </div>
  </div>

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

  <div class="timeline-date green">Final Status</div>
  <div class="timeline-item">
    <div class="timeline-icon approved">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 2a10 10 0 1 0 10 10A10 10 0 0 0 12 2zm-1 15l-5-5 1.41-1.41L11 14.17l7.59-7.59L20 8z"/></svg>
    </div>
    <div class="timeline-content green">
      <h4>Application Approved</h4>
      <p>Congratulations! You have been selected for the position.</p>
      <a href="#" class="timeline-link">View offer letter</a>
    </div>
  </div>

</div>

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


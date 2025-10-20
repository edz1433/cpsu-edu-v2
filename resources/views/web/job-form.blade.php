<!DOCTYPE html>
@php
    if (!session('google_email')) {
        header("Location: /");
        exit;
    }

    function shortEncrypt($string)
    {
        $key = 'fA7xB93kL0pTzWmQ';
        $cipher = 'AES-128-ECB';
        return rtrim(strtr(base64_encode(openssl_encrypt($string, $cipher, $key, 0)), '+/', '-_'), '=');
    }
@endphp
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Application Form</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
    :root {
      --primary: #14532D;
      --primary-dark: #14532D;
      --secondary: #0e9f6e;
      --light-bg: #f9fafb;
      --dark-text: #111827;
      --mid-text: #374151;
      --light-text: #6b7280;
      --border: #e5e7eb;
      --error: #dc3545;
      --success: #28a745;
      --warning: #ffc107;
    }

    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: 'Inter', Arial, sans-serif;
      background: linear-gradient(135deg, #e0f2fe, #f3e8ff, #ecfdf5);
      color: var(--dark-text);
      line-height: 1.6;
      position: relative;
      overflow-x: hidden;
    }

    /* Animated Background */
    .background-container {
      position: fixed;
      top: 200px;
      left: 0;
      width: 100%;
      height: 100%;
      z-index: -1;
      background: linear-gradient(45deg, rgba(20, 83, 45, 0.1), rgba(14, 159, 110, 0.1));
      animation: gradientShift 15s ease infinite;
    }

    @keyframes gradientShift {
      0% { background-position: 0% 50%; }
      50% { background-position: 100% 50%; }
      100% { background-position: 0% 50%; }
    }

    /* Floating Particles */
    .particles {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      pointer-events: none;
    }

    .particle {
      position: absolute;
      background: rgba(14, 159, 110, 0.3);
      border-radius: 50%;
      animation: float 20s infinite linear;
      opacity: 0.4;
    }

    .particle:nth-child(1) { width: 30px; height: 30px; top: 10%; left: 15%; animation-duration: 25s; }
    .particle:nth-child(2) { width: 20px; height: 20px; top: 30%; left: 80%; animation-duration: 30s; }
    .particle:nth-child(3) { width: 40px; height: 40px; top: 50%; left: 30%; animation-duration: 22s; }
    .particle:nth-child(4) { width: 25px; height: 25px; top: 70%; left: 60%; animation-duration: 28s; }
    .particle:nth-child(5) { width: 35px; height: 35px; top: 20%; left: 40%; animation-duration: 26s; }

    @keyframes float {
      0% { transform: translateY(0) translateX(0); }
      50% { transform: translateY(-20vh) translateX(10vw); }
      100% { transform: translateY(0) translateX(0); }
    }

    .container {
      max-width: 65%;
      margin: 0 auto;
      padding: 0 20px;
      position: relative;
      z-index: 1;
    }

    .form-header {
      background: linear-gradient(135deg, var(--primary), var(--secondary));
      color: white;
      padding: 60px 20px;
      text-align: center;
      box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
      position: relative;
      overflow: hidden;
      margin-bottom: -30px;
      backdrop-filter: blur(8px);
      border: 1px solid rgba(255, 255, 255, 0.2);
      transition: transform 0.3s ease;
    }

    .form-header:hover {
      transform: translateY(-5px);
    }

    .form-header::before {
      content: '';
      position: absolute;
      top: -50%;
      left: -50%;
      width: 200%;
      height: 200%;
      background: radial-gradient(circle, rgba(255, 255, 255, 0.3) 0%, transparent 70%);
      animation: pulse 8s infinite ease-in-out;
    }

    @keyframes pulse {
      0% { transform: scale(1); opacity: 0.4; }
      50% { transform: scale(1.3); opacity: 0.2; }
      100% { transform: scale(1); opacity: 0.4; }
    }

    .form-header h2 {
      margin: 0;
      font-weight: 700;
      font-size: 32px;
      position: relative;
      text-transform: uppercase;
      letter-spacing: 1px;
      animation: fadeInUp 0.8s ease;
    }

    .form-header p {
      margin-top: 12px;
      font-size: 16px;
      opacity: 0.9;
      position: relative;
      max-width: 600px;
      margin-left: auto;
      margin-right: auto;
      animation: fadeInUp 0.8s ease 0.2s;
      animation-fill-mode: both;
    }

    @keyframes fadeInUp {
      from { transform: translateY(20px); opacity: 0; }
      to { transform: translateY(0); opacity: 1; }
    }

    .form-header::after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 0;
      width: 100%;
      height: 4px;
      background: linear-gradient(90deg, transparent, var(--secondary), transparent);
      animation: slideGlow 4s infinite ease-in-out;
    }

    @keyframes slideGlow {
      0% { transform: translateX(-100%); }
      50% { transform: translateX(100%); }
      100% { transform: translateX(-100%); }
    }

    .form-container {
      margin: -40px auto 40px auto;
      background: rgba(255, 255, 255, 0.95);
      padding: 40px;
      border-radius: 12px;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
      backdrop-filter: blur(8px);
      transition: transform 0.3s ease;
    }

    .form-container:hover {
      transform: translateY(-5px);
    }

    .form-section {
      margin-bottom: 20px;
      padding-bottom: 20px;
      border-bottom: 1px solid var(--border);
      transition: background 0.3s ease;
    }

    .form-section:hover {
      background: rgba(14, 159, 110, 0.03);
    }

    .form-section:last-of-type {
      border-bottom: none;
    }

    .form-section h3 {
      font-size: 20px;
      font-weight: 600;
      margin-bottom: 20px;
      color: var(--primary-dark);
      display: flex;
      align-items: center;
      position: relative;
    }

    .form-section h3 i {
      margin-right: 10px;
      transition: transform 0.3s ease;
    }

    .form-section h3:hover i {
      transform: scale(1.2);
    }

    label {
      font-size: 14px;
      font-weight: 500;
      color: var(--mid-text);
      display: block;
      margin-bottom: 8px;
    }

    .required::after {
      content: " *";
      color: var(--error);
    }

    .input-group {
      margin-bottom: 20px;
      position: relative;
    }

    input[type="text"],
    input[type="email"],
    input[type="number"],
    input[type="file"],
    textarea,
    select {
      width: 100%;
      padding: 12px 16px;
      border: 1.5px solid var(--border);
      border-radius: 8px;
      font-size: 15px;
      background: white;
      outline: none;
      transition: all 0.3s ease;
    }

    input:focus,
    textarea:focus,
    select:focus {
      border-color: var(--primary);
      box-shadow: 0 0 0 3px rgba(20, 83, 45, 0.15);
      transform: scale(1.01);
    }

    .is-valid {
      border-color: var(--success) !important;
      background: rgba(40, 167, 69, 0.05);
    }

    .is-invalid {
      border-color: var(--error) !important;
      background: rgba(220, 53, 69, 0.05);
    }

    .valid-feedback {
      display: none;
      width: 100%;
      margin-top: 0.25rem;
      font-size: 0.875em;
      color: var(--success);
    }

    .is-valid ~ .valid-feedback {
      display: block;
    }

    .invalid-feedback {
      display: none;
      width: 100%;
      margin-top: 0.25rem;
      font-size: 0.875em;
      color: var(--error);
    }

    .is-invalid ~ .invalid-feedback {
      display: block;
    }

    textarea {
      resize: vertical;
      min-height: 80px;
    }

    .form-row {
      display: flex;
      gap: 20px;
      margin-bottom: 15px;
    }

    @media (max-width: 768px) {
      .form-row {
        flex-direction: column;
        gap: 0;
      }
    }

    .form-row > div {
      flex: 1;
    }

    .add-btn {
      background: transparent;
      color: var(--primary);
      border: 1px dashed var(--primary);
      border-radius: 6px;
      padding: 10px 15px;
      font-size: 14px;
      font-weight: 500;
      cursor: pointer;
      display: inline-flex;
      align-items: center;
      transition: all 0.2s ease;
      position: relative;
      overflow: hidden;
    }

    .add-btn::before {
      content: '';
      position: absolute;
      top: 50%;
      left: 50%;
      width: 0;
      height: 0;
      background: rgba(20, 83, 45, 0.1);
      border-radius: 50%;
      transform: translate(-50%, -50%);
      transition: width 0.3s ease, height 0.3s ease;
    }

    .add-btn:hover::before {
      width: 300px;
      height: 300px;
    }

    .add-btn:hover {
      background: transparent;
      transform: translateY(-2px);
    }

    .add-btn i {
      margin-right: 8px;
    }

    .remove-btn {
      background: transparent;
      border: none;
      color: var(--error);
      cursor: pointer;
      font-size: 18px;
      align-self: center;
      padding: 5px;
      margin-top: 15px;
      transition: all 0.2s ease;
    }

    .remove-btn:hover {
      transform: scale(1.2) rotate(90deg);
    }

    .attachments {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 20px;
    }

    @media (max-width: 600px) {
      .attachments {
        grid-template-columns: 1fr;
      }
    }

    .file-input-container {
      position: relative;
    }

    .file-input-container input[type="file"] {
      padding: 30px 16px 16px;
      border: 2px dashed var(--border);
      background: var(--light-bg);
      transition: all 0.3s ease;
    }

    .file-input-container input[type="file"]:hover {
      border-color: var(--primary);
      background: rgba(20, 83, 45, 0.05);
      transform: scale(1.01);
    }

    .file-input-container label {
      position: absolute;
      top: 12px;
      left: 16px;
      font-weight: 600;
      transition: color 0.3s ease;
    }

    .file-input-container:hover label {
      color: var(--primary);
    }

    .note {
      font-size: 13px;
      color: var(--light-text);
      margin-top: 8px;
    }

    .submit-btn {
      background: var(--secondary);
      color: white;
      font-size: 16px;
      padding: 14px 32px;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      display: block;
      margin: 40px auto 0;
      font-weight: 500;
      transition: all 0.3s ease;
      box-shadow: 0 4px 6px rgba(14, 159, 110, 0.2);
      position: relative;
      overflow: hidden;
    }

    .submit-btn::before {
      content: '';
      position: absolute;
      top: 50%;
      left: 50%;
      width: 0;
      height: 0;
      background: rgba(255, 255, 255, 0.2);
      border-radius: 50%;
      transform: translate(-50%, -50%);
      transition: width 0.4s ease, height 0.4s ease;
    }

    .submit-btn:hover::before {
      width: 400px;
      height: 400px;
    }

    .submit-btn:hover {
      background: #0c7c5a;
      transform: translateY(-2px);
      box-shadow: 0 6px 12px rgba(14, 159, 110, 0.25);
    }

    .submit-btn:active {
      transform: translateY(0);
    }

    .modal {
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, 0.6);
      backdrop-filter: blur(6px);
      z-index: 1000;
      justify-content: center;
      align-items: center;
      animation: fadeIn 0.3s ease;
    }

    @keyframes fadeIn {
      from { opacity: 0; }
      to { opacity: 1; }
    }

    .modal-content {
      background: white;
      padding: 30px;
      border-radius: 12px;
      max-width: 500px;
      width: 90%;
      box-shadow: 0 25px 50px rgba(0, 0, 0, 0.2);
      text-align: center;
      transform: scale(0.8);
      animation: modalPop 0.3s ease forwards;
    }

    @keyframes modalPop {
      to { transform: scale(1); }
    }

    .modal h3 {
      margin-bottom: 15px;
      color: var(--primary-dark);
    }

    .modal p {
      margin-bottom: 25px;
      color: var(--mid-text);
    }

    .modal-buttons {
      display: flex;
      justify-content: center;
      gap: 15px;
    }

    .modal-btn {
      padding: 10px 20px;
      border-radius: 6px;
      font-weight: 500;
      cursor: pointer;
      transition: all 0.2s ease;
    }

    .modal-confirm {
      background: var(--secondary);
      color: white;
      border: none;
    }

    .modal-cancel {
      background: transparent;
      color: var(--mid-text);
      border: 1px solid var(--border);
    }

    .modal-btn:hover {
      opacity: 0.9;
      transform: translateY(-2px);
    }

    .success-message {
      display: none;
      text-align: center;
      padding: 30px;
      background: rgba(14, 159, 110, 0.15);
      border-radius: 8px;
      margin-top: 20px;
      color: var(--success);
      animation: slideIn 0.5s ease;
    }

    @keyframes slideIn {
      from { transform: translateY(20px); opacity: 0; }
      to { transform: translateY(0); opacity: 1; }
    }

    .success-message i {
      font-size: 48px;
      margin-bottom: 15px;
      animation: pulseIcon 1.5s infinite;
    }

    @keyframes pulseIcon {
      0% { transform: scale(1); }
      50% { transform: scale(1.1); }
      100% { transform: scale(1); }
    }

    .loading {
      display: none;
      text-align: center;
      margin: 20px 0;
    }

    .loading-spinner {
      border: 4px solid rgba(20, 83, 45, 0.1);
      border-left-color: var(--primary);
      border-radius: 50%;
      width: 40px;
      height: 40px;
      animation: spin 1s linear infinite;
      margin: 0 auto;
    }

    @keyframes spin {
      to { transform: rotate(360deg); }
    }

    @media (max-width: 768px) {
      .container {
        max-width: 100%;
      }
      .form-header {
        padding: 40px 15px;
      }
      .form-header h2 {
        font-size: 24px;
      }
      .form-header p {
        font-size: 14px;
      }
    }

    .server-error {
      display: none;
      width: 100%;
      margin-top: 0.25rem;
      font-size: 0.875em;
      color: var(--error);
    }

    .server-error.show {
      display: block;
    }

.already-applied {
    display: none; /* initially hidden */
    padding: 25px 30px;
    margin: 25px 0;
    border-left: 8px solid #ff4d4f; /* darker red accent */
    background: #fff0f0; /* soft pink background */
    color: #c0392b; /* deep red text */
    font-family: 'Poppins', sans-serif;
    font-size: 20px; /* bigger text */
    font-weight: 600;
    border-radius: 12px;
    box-shadow: 0 6px 18px rgba(0,0,0,0.1);
    line-height: 1.8;
    animation: fadeIn 0.4s ease-in-out;
    position: relative;
}

.already-applied::before {
    content: "⚠️";
    margin-right: 12px;
    font-size: 26px;
    vertical-align: middle;
}

.already-applied a {
    color: #e74c3c; /* brighter red for link */
    text-decoration: none;
    font-weight: 700;
    transition: all 0.3s ease;
}

.already-applied a:hover {
    color: #c0392b;
    text-decoration: underline;
    transform: translateY(-2px);
}

/* Fade-in animation */
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(-8px); }
    to { opacity: 1; transform: translateY(0); }
}

  </style>

</head>
<body>
  <!-- Animated Background -->
  <div class="background-container">
    <div class="particles">
      <div class="particle"></div>
      <div class="particle"></div>
      <div class="particle"></div>
      <div class="particle"></div>
      <div class="particle"></div>
    </div>
  </div>

  <!-- Header -->
  <div class="form-header">
    <h2>{{ session('job_title') }}</h2>
    <p>Please complete the form below to submit your application</p>
  </div>
  @php
      $jid = session('job_id'); 
      $email = session('google_email'); 
      $apiurl = env('HRIS_API_URL');
  @endphp
  <div class="container">
    <!-- Form -->
    <div class="form-container">
      <div class="alert alert-warning already-applied" id="already-applied" style="display: none;">
          You have already applied for this position!
          Check your application status using application #: <span id="app-number"></span>.
      </div>
 
      <form id="applicationForm" enctype="multipart/form-data">
        @csrf
        <!-- Position -->
        <div class="form-section">
          <div class="input-group">
            <label for="position">Position</label>
            <input type="text" id="position" name="position" value="{{ session('job_title') }}" autocomplete="off" readonly>
          </div>
        </div>

        <!-- Personal Information -->
        <div class="form-section">
          <h3><i class="fas fa-user"></i> Personal Information</h3>
          <div class="form-row">
            <div class="input-group">
              <input type="hidden" name="jid" value="{{ session('job_id') }}">
              <label for="first_name" class="required">First Name</label>
              <input type="text" id="first_name" name="first_name" value="{{ session('google_fname') }}" autocomplete="off" required placeholder="Enter your first name">
              <div class="invalid-feedback">Please enter your first name</div>
              <div class="server-error"></div>
            </div>
            <div class="input-group">
              <label for="middle_name">Middle Name</label>
              <input type="text" id="middle_name" name="middle_name" autocomplete="off" placeholder="Enter your middle name">
              <div class="server-error"></div>
            </div>
            <div class="input-group">
              <label for="last_name" class="required">Last Name</label>
              <input type="text" id="last_name" name="last_name" value="{{ session('google_lname') }}" autocomplete="off" required placeholder="Enter your last name">
              <div class="invalid-feedback">Please enter your last name</div>
              <div class="server-error"></div>
            </div>
          </div>

          <div class="form-row">
            <div class="input-group">
              <label for="age" class="required">Age</label>
              <input type="number" id="age" name="age" autocomplete="off" required min="18" max="65" placeholder="Your age">
              <div class="invalid-feedback">Please enter a valid age (18-65)</div>
              <div class="server-error"></div>
            </div>
            <div class="input-group">
              <label for="sex" class="required">Sex</label>
              <select id="sex" name="sex" required>
                <option value="">Select sex</option>
                <option value="male">Male</option>
                <option value="female">Female</option>
                <option value="other">Other</option>
              </select>
              <div class="invalid-feedback">Please select your sex</div>
              <div class="server-error"></div>
            </div>
            <div class="input-group">
              <label for="mobile" class="required">Mobile No.</label>
              <input type="text" id="mobile" name="mobile" autocomplete="off" required placeholder="e.g., 09123456789">
              <div class="invalid-feedback">Please enter a valid mobile number</div>
              <div class="server-error"></div>
            </div>
            <div class="input-group">
              <label for="email" class="required">Email Address</label>
              <input type="email" id="email" name="email" autocomplete="off" value="{{ session('google_email') }}" readonly required>
              <div class="invalid-feedback">Please enter a valid email address</div>
              <div class="server-error"></div>
            </div>
          </div>

          <div class="input-group">
            <label for="address" class="required">Complete Address</label>
            <textarea id="address" name="address" autocomplete="off" required placeholder="Enter your complete address"></textarea>
            <div class="invalid-feedback">Please enter your complete address</div>
            <div class="server-error"></div>
          </div>
        </div>

        <!-- Education -->
        <div class="form-section" id="education-section">
          <h3><i class="fas fa-graduation-cap"></i> Education Background</h3>
          <div class="education-row form-row">
            <div class="input-group">
              <label class="required">Description</label>
              <input type="text" name="education[]" autocomplete="off" required placeholder="e.g., Bachelor of Science in Business Administration">
              <div class="invalid-feedback">Please enter education description</div>
              <div class="server-error"></div>
            </div>
            <div class="input-group">
              <label class="required">Level</label>
              <select name="elevel[]" required>
                <option value="">Select level</option>
                <option value="elementary">Elementary</option>
                <option value="highschool">High School</option>
                <option value="vocational">Vocational</option>
                <option value="college">College</option>
                <option value="postgraduate">Postgraduate</option>
              </select>
              <div class="invalid-feedback">Please select education level</div>
              <div class="server-error"></div>
            </div>
            <div class="input-group">
              <label class="required">Year Graduated</label>
              <input type="text" name="eyear[]" autocomplete="off" required placeholder="e.g., 2015">
              <div class="invalid-feedback">Please enter graduation year</div>
              <div class="server-error"></div>
            </div>
            <button type="button" class="remove-btn" onclick="removeRow(this)">✕</button>
          </div>
          <button type="button" class="add-btn" onclick="addEducationRow()"><i class="fas fa-plus"></i> Add Another</button>
        </div>

        <!-- Eligibility -->
        <div class="form-section" id="eligibility-section">
          <h3><i class="fas fa-award"></i> Eligibility</h3>
          <div class="eligibility-row form-row">
            <div class="input-group">
              <label>Description</label>
              <input type="text" name="eligibility[]" autocomplete="off" placeholder="e.g., Civil Service Professional">
              <div class="invalid-feedback">Please enter eligibility description</div>
              <div class="server-error"></div>
            </div>
            <button type="button" class="remove-btn" onclick="removeRow(this)">✕</button>
          </div>
          <button type="button" class="add-btn" onclick="addEligibilityRow()"><i class="fas fa-plus"></i> Add Another</button>
        </div>

        <!-- Attachments -->
        <div class="form-section">
          <h3><i class="fas fa-paperclip"></i> Attachments</h3>
          <div class="attachments">
            <div class="input-group file-input-container">
              <label class="required">Personal Data Sheet (PDF)</label>
              <input type="file" name="pds" accept=".pdf" autocomplete="off" required>
              <p class="note">Upload your Personal Data Sheet. (max 20MB)</p>
              <div class="invalid-feedback">Please upload your Personal Data Sheet</div>
              <div class="server-error"></div>
            </div>
            <div class="input-group file-input-container">
              <label class="required">Work Experience Sheet (PDF)</label>
              <input type="file" name="wes" accept=".pdf" required>
              <p class="note">Upload your WES detailing roles. (max 20MB)</p>
              <div class="invalid-feedback">Please upload your Work Experience Sheet</div>
              <div class="server-error"></div>
            </div>
            <div class="input-group file-input-container">
              <label class="required">Intent Letter (PDF)</label>
              <input type="file" name="intent" accept=".pdf" required>
              <div class="invalid-feedback">Please upload your Intent Letter</div>
              <div class="server-error"></div>
            </div>
            <div class="input-group file-input-container">
              <label class="required">Resume (PDF)</label>
              <input type="file" name="resume" accept=".pdf" required>
              <div class="invalid-feedback">Please upload your Resume</div>
              <div class="server-error"></div>
            </div>
            <div class="input-group file-input-container">
              <label class="required">Transcript of Records (PDF)</label>
              <input type="file" name="tor" accept=".pdf" required>
              <div class="invalid-feedback">Please upload your Transcript of Records</div>
              <div class="server-error"></div>
            </div>
            <div class="input-group file-input-container">
              <label>Certificate of Employment (PDF)</label>
              <input type="file" name="coe" accept=".pdf">
              <div class="server-error"></div>
            </div>
            <div class="input-group file-input-container">
              <label>Certificate of Training (PDF)</label>
              <input type="file" name="cert_training[]" accept=".pdf" multiple>
              <div class="server-error"></div>
            </div>
          </div>
        </div>

        <!-- Loading indicator -->
        <div class="loading">
          <div class="loading-spinner"></div>
          <p>Submitting your application...</p>
        </div>

        <!-- Success message -->
        <div class="success-message">
          <i class="fas fa-check-circle"></i>
          <h3>Application Submitted Successfully!</h3>
          <p>Thank you for your application. We will review your submission and contact you soon.</p>
        </div>

        <!-- Submit -->
        <button type="button" class="submit-btn" onclick="validateForm()">Submit Application</button>
      </form>
    </div>
  </div>

  <!-- Confirmation Modal -->
  <div class="modal" id="confirmationModal">
    <div class="modal-content">
      <h3>Confirm Submission</h3>
      <p>Are you sure you want to submit your application? Please review all information before proceeding.</p>
      <div class="modal-buttons">
        <button class="modal-btn modal-cancel" onclick="closeModal()">Cancel</button>
        <button class="modal-btn modal-confirm" onclick="submitForm()">Confirm</button>
      </div>
    </div>
  </div>

<script>
  // Add and remove dynamic rows
  function addEducationRow() {
    const section = document.getElementById("education-section");
    const newRow = document.createElement("div");
    newRow.classList.add("education-row", "form-row");
    newRow.innerHTML = `
      <div class="input-group">
        <label class="required">Description</label>
        <input type="text" name="education[]" required placeholder="e.g., Bachelor of Science in Business Administration">
        <div class="invalid-feedback">Please enter education description</div>
        <div class="server-error"></div>
      </div>
      <div class="input-group">
        <label class="required">Level</label>
        <select name="elevel[]" required>
          <option value="">Select level</option>
          <option value="elementary">Elementary</option>
          <option value="highschool">High School</option>
          <option value="vocational">Vocational</option>
          <option value="college">College</option>
          <option value="postgraduate">Postgraduate</option>
        </select>
        <div class="invalid-feedback">Please select education level</div>
        <div class="server-error"></div>
      </div>
      <div class="input-group">
        <label class="required">Year Graduated</label>
        <input type="text" name="eyear[]" required placeholder="e.g., 2015">
        <div class="invalid-feedback">Please enter graduation year</div>
        <div class="server-error"></div>
      </div>
      <button type="button" class="remove-btn" onclick="removeRow(this)">✕</button>
    `;
    section.insertBefore(newRow, section.querySelector(".add-btn"));
  }

  function addEligibilityRow() {
    const section = document.getElementById("eligibility-section");
    const newRow = document.createElement("div");
    newRow.classList.add("eligibility-row", "form-row");
    newRow.innerHTML = `
      <div class="input-group">
        <label>Description</label>
        <input type="text" name="eligibility[]" placeholder="e.g., Civil Service Professional">
        <div class="invalid-feedback">Please enter eligibility description</div>
        <div class="server-error"></div>
      </div>
      <button type="button" class="remove-btn" onclick="removeRow(this)">✕</button>
    `;
    section.insertBefore(newRow, section.querySelector(".add-btn"));
  }

  function removeRow(button) {
    const row = button.parentNode;
    if (row.parentNode.querySelectorAll('.education-row, .eligibility-row').length > 1) {
      row.parentNode.removeChild(row);
    }
  }

  // Form validation
  function validateForm() {
    const form = document.getElementById('applicationForm');
    const allInputs = form.querySelectorAll('input, select, textarea');
    let isValid = true;

    // Reset validation states
    allInputs.forEach(input => {
      input.classList.remove('is-invalid', 'is-valid');
      const serverError = input.parentNode.querySelector('.server-error');
      if (serverError) serverError.classList.remove('show');
    });

    // Check required fields
    form.querySelectorAll('[required]').forEach(input => {
      if (!input.value.trim() && input.type !== 'file') {
        input.classList.add('is-invalid');
        isValid = false;
      } else if (input.type === 'file' && !input.files.length && input.hasAttribute('required')) {
        input.classList.add('is-invalid');
        isValid = false;
      } else {
        input.classList.add('is-valid');
      }
    });

    // Special validation for email
    const emailInput = document.getElementById('email');
    if (emailInput.value && !isValidEmail(emailInput.value)) {
      emailInput.classList.add('is-invalid');
      emailInput.nextElementSibling.nextElementSibling.textContent = 'Please enter a valid email address';
      isValid = false;
    }

    // Special validation for age
    const ageInput = document.getElementById('age');
    if (ageInput.value && (ageInput.value < 18 || ageInput.value > 65)) {
      ageInput.classList.add('is-invalid');
      ageInput.nextElementSibling.nextElementSibling.textContent = 'Please enter a valid age (18-65)';
      isValid = false;
    }

    if (!isValid) {
      const firstError = form.querySelector('.is-invalid');
      if (firstError) firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
      return;
    }

    // Show confirmation modal if valid
    document.getElementById('confirmationModal').style.display = 'flex';
  }

  function isValidEmail(email) {
    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(email);
  }

  function closeModal() {
    document.getElementById('confirmationModal').style.display = 'none';
  }

  function submitForm() {
    closeModal();
    const form = document.getElementById('applicationForm');
    const formData = new FormData(form);
    const HRIS_API_URL = "{{ env('HRIS_API_URL') }}";

    // Show loading indicator
    document.querySelector('.loading').style.display = 'block';
    document.querySelector('.submit-btn').style.display = 'none';

    // Clear previous server errors
    document.querySelectorAll('.server-error').forEach(error => {
      error.textContent = '';
      error.classList.remove('show');
    });

    // AJAX submission
    fetch(`${HRIS_API_URL}/application/store`, {
      method: 'POST',
      body: formData,
      headers: {
        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
        'Accept': 'application/json'
      }
    })
    .then(async response => {
      document.querySelector('.loading').style.display = 'none';
      document.querySelector('.submit-btn').style.display = 'block';

      if (response.status === 409) {
        const data = await response.json();
        document.querySelector('.success-message').style.display = 'block';
        document.querySelector('.success-message').innerHTML = `${data.message}`;
        document.querySelector('.success-message').scrollIntoView({ behavior: 'smooth' });
        return;
      }

      if (!response.ok) {
        const errorData = await response.json();
        throw errorData;
      }

      const data = await response.json();
      if (data.message === 'Application submitted successfully!') {
        document.querySelector('.success-message').style.display = 'block';
        let statusUrlTemplate = "{{ route('application.status', ['id' => ':id']) }}";
        const statusUrl = statusUrlTemplate.replace(':id', data.data.id);
        document.querySelector('.success-message').innerHTML = `
          Application submitted successfully! 
          Check your application status at: <a href="${statusUrl}" target="_blank">${statusUrl}</a>
        `;
        form.reset();
        document.querySelector('.success-message').scrollIntoView({ behavior: 'smooth' });
      }
    })
    .catch(error => {
      document.querySelector('.loading').style.display = 'none';
      document.querySelector('.submit-btn').style.display = 'block';

      if (error.errors) {
        Object.keys(error.errors).forEach(key => {
          const input = form.querySelector(`[name="${key}"], [name="${key}[]"]`);
          if (input) {
            input.classList.add('is-invalid');
            const errorDiv = input.parentNode.querySelector('.server-error');
            if (errorDiv) {
              errorDiv.textContent = error.errors[key][0];
              errorDiv.classList.add('show');
            }
          }
        });
        const firstError = form.querySelector('.is-invalid');
        if (firstError) firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
      } else {
        alert('An error occurred while submitting the form. Please try again.');
        console.error(error);
      }
    });
  }

  // Close modal on outside click
  window.onclick = function(event) {
    const modal = document.getElementById('confirmationModal');
    if (event.target === modal) closeModal();
  }

  // Real-time input validation
  document.addEventListener('DOMContentLoaded', function() {
    const inputs = document.querySelectorAll('input, select, textarea');
    inputs.forEach(input => {
      input.addEventListener('blur', function() {
        if (this.hasAttribute('required') && !this.value.trim() && this.type !== 'file') {
          this.classList.add('is-invalid');
          this.classList.remove('is-valid');
        } else if (this.type === 'file' && this.hasAttribute('required') && !this.files.length) {
          this.classList.add('is-invalid');
          this.classList.remove('is-valid');
        } else if (this.type === 'email' && this.value && !isValidEmail(this.value)) {
          this.classList.add('is-invalid');
          this.classList.remove('is-valid');
        } else if (this.id === 'age' && this.value && (this.value < 18 || this.value > 65)) {
          this.classList.add('is-invalid');
          this.classList.remove('is-valid');
        } else if (this.value || (this.type === 'file' && this.files.length)) {
          this.classList.add('is-valid');
          this.classList.remove('is-invalid');
        } else {
          this.classList.remove('is-invalid', 'is-valid');
        }
      });
    });

    // Parallax effect for particles on scroll
    window.addEventListener('scroll', () => {
      const particles = document.querySelectorAll('.particle');
      const scrollPosition = window.scrollY;
      particles.forEach((particle, index) => {
        const speed = (index + 1) * 0.1;
        particle.style.transform = `translateY(${scrollPosition * speed}px)`;
      });
    });
  });

  document.addEventListener('DOMContentLoaded', function() {
      const jid = "{{ $jid }}";
      const email = "{{ $email }}";
      const apiurl = "{{ $apiurl }}";

      if (!email) {
          // No email yet, just show the form
          document.getElementById('applicationForm').style.display = 'block';
          return;
      }

      // Fetch to external system to check if applicant exists
      fetch(`${apiurl}/application/check/${jid}/${email}`)
          .then(response => {
              if (!response.ok) throw new Error('Network response was not ok');
              return response.json();
          })
          .then(data => {
              if (data.exists) {
                  document.getElementById('already-applied').style.display = 'block';
                  document.getElementById('applicationForm').style.display = 'none';
                  document.getElementById('app-number').textContent = data.app_number;
              } else {
                  document.getElementById('already-applied').style.display = 'none';
                  document.getElementById('applicationForm').style.display = 'block';
              }
          })
          .catch(err => {
              console.error('Error checking application:', err);
              // Fallback: show form if API fails
              document.getElementById('applicationForm').style.display = 'block';
          });
  });
</script>
</body>
</html>
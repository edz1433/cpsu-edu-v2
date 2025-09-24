<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Administrative Officer II Application</title>
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
      background: var(--light-bg);
      color: var(--dark-text);
      line-height: 1.6;
    }

    .container {
      max-width: 65%;
      margin: 0 auto;
      padding: 0 20px;
    }

    .form-header {
      background: linear-gradient(135deg, var(--primary), var(--primary-dark));
      color: white;
      padding: 50px 20px;
      text-align: center;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .form-header h2 {
      margin: 0;
      font-weight: 600;
      font-size: 28px;
    }

    .form-header p {
      margin-top: 10px;
      opacity: 0.9;
    }

    .form-container {
      margin: -40px auto 40px auto;
      background: white;
      padding: 40px;
      border-radius: 12px;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
    }

    .form-section {
      margin-bottom: 20px;
      padding-bottom: 20px;
      border-bottom: 1px solid var(--border);
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
    }

    .form-section h3 i {
      margin-right: 10px;
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
      box-shadow: 0 0 0 3px rgba(26, 86, 219, 0.15);
    }

    /* AdminLTE-style validation states */
    .is-valid {
      border-color: var(--success) !important;
    }

    .is-invalid {
      border-color: var(--error) !important;
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
    }

    .add-btn:hover {
      background: rgba(26, 86, 219, 0.05);
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
      transform: scale(1.1);
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
    }

    .file-input-container input[type="file"]:hover {
      border-color: var(--primary);
      background: rgba(26, 86, 219, 0.03);
    }

    .file-input-container label {
      position: absolute;
      top: 12px;
      left: 16px;
      font-weight: 600;
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
      box-shadow: 0 4px 6px rgba(5, 122, 85, 0.2);
    }

    .submit-btn:hover {
      background: #0c7c5a;
      transform: translateY(-2px);
      box-shadow: 0 6px 12px rgba(5, 122, 85, 0.25);
    }

    .submit-btn:active {
      transform: translateY(0);
    }

    /* Modal */
    .modal {
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, 0.5);
      backdrop-filter: blur(4px);
      z-index: 1000;
      justify-content: center;
      align-items: center;
    }

    .modal-content {
      background: white;
      padding: 30px;
      border-radius: 12px;
      max-width: 500px;
      width: 90%;
      box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
      text-align: center;
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
      transform: translateY(-1px);
    }

    /* Success message */
    .success-message {
      display: none;
      text-align: center;
      padding: 30px;
      background: rgba(5, 122, 85, 0.1);
      border-radius: 8px;
      margin-top: 20px;
      color: var(--success);
    }

    .success-message i {
      font-size: 48px;
      margin-bottom: 15px;
    }

    /* Loading animation */
    .loading {
      display: none;
      text-align: center;
      margin: 20px 0;
    }

    .loading-spinner {
      border: 4px solid rgba(26, 86, 219, 0.1);
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
    }
  </style>
</head>
<body>
  <!-- Header -->
  <div class="form-header">
    <h2>Administrative Officer II Application</h2>
    <p>Please complete the form below to submit your application</p>
  </div>

  <div class="container">
    <!-- Form -->
    <div class="form-container">
      <form id="applicationForm">
        <!-- Position -->
        <div class="form-section">
          <div class="input-group">
            <label for="position">Position</label>
            <input type="text" id="position" value="Administrative Officer II" autocomplete="off" readonly>
          </div>
        </div>

        <!-- Personal Information -->
        <div class="form-section">
          <h3><i class="fas fa-user"></i> Personal Information</h3>
          <div class="form-row">
            <div class="input-group">
              <label for="first_name" class="required">First Name</label>
              <input type="text" id="first_name" name="first_name" autocomplete="off" required placeholder="Enter your first name">
              
              <div class="invalid-feedback">Please enter your first name</div>
            </div>
            <div class="input-group">
              <label for="middle_name">Middle Name</label>
              <input type="text" id="middle_name" name="middle_name" autocomplete="off" placeholder="Enter your middle name">
            </div>
            <div class="input-group">
              <label for="last_name" class="required">Last Name</label>
              <input type="text" id="last_name" name="last_name" autocomplete="off" required placeholder="Enter your last name">
              
              <div class="invalid-feedback">Please enter your last name</div>
            </div>
          </div>

          <div class="form-row">
            <div class="input-group">
              <label for="age" class="required">Age</label>
              <input type="number" id="age" name="age" autocomplete="off" required min="18" max="65" placeholder="Your age">
              
              <div class="invalid-feedback">Please enter a valid age (18-65)</div>
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
            </div>
            <div class="input-group">
              <label for="mobile" class="required">Mobile No.</label>
              <input type="text" id="mobile" name="mobile" autocomplete="off" required placeholder="e.g., 09123456789">
              
              <div class="invalid-feedback">Please enter a valid mobile number</div>
            </div>
            <div class="input-group">
              <label for="email" class="required">Email Address</label>
              <input type="email" id="email" name="email" autocomplete="off" placeholder="your.email@example.com" readonly required>
              
              <div class="invalid-feedback">Please enter a valid email address</div>
            </div>
          </div>

          <div class="input-group">
            <label for="address" class="required">Complete Address</label>
            <textarea id="address" name="address" autocomplete="off" required placeholder="Enter your complete address"></textarea>
            
            <div class="invalid-feedback">Please enter your complete address</div>
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
            </div>
            <div class="input-group">
              <label class="required">Year Graduated</label>
              <input type="text" name="eyear[]" autocomplete="off" required placeholder="e.g., 2015">
              <div class="invalid-feedback">Please enter graduation year</div>
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
              <label class="required">Description</label>
              <input type="text" name="eligibility[]" autocomplete="off" required placeholder="e.g., Civil Service Professional">
              <div class="invalid-feedback">Please enter eligibility description</div>
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
            </div>
            <div class="input-group file-input-container">
              <label class="required">Work Experience Sheet (PDF)</label>
              <input type="file" name="wes" accept=".pdf" multiple required>
              <p class="note">Upload your WES detailing roles. (max 20MB)</p>
              <div class="invalid-feedback">Please upload your Work Experience Sheet</div>
            </div>
            <div class="input-group file-input-container">
              <label class="required">Intent Letter (PDF)</label>
              <input type="file" name="intent" accept=".pdf" required>
              <div class="invalid-feedback">Please upload your Intent Letter</div>
            </div>
            <div class="input-group file-input-container">
              <label class="required">Resume (PDF)</label>
              <input type="file" name="resume" accept=".pdf" required>
              <div class="invalid-feedback">Please upload your Resume</div>
            </div>
            <div class="input-group file-input-container">
              <label class="required">Transcript of Records (PDF)</label>
              <input type="file" name="tor" accept=".pdf" required>
              <div class="invalid-feedback">Please upload your Transcript of Records</div>
            </div>
            <div class="input-group file-input-container">
              <label>Certificate of Employment (PDF)</label>
              <input type="file" name="coe" accept=".pdf">
            </div>
            <div class="input-group file-input-container">
              <label>Certificate of Training (PDF)</label>
              <input type="file" name="cert_training" accept=".pdf" multiple>
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
          <input type="text" name="edesc[]" required placeholder="e.g., Bachelor of Science in Business Administration">
          <div class="invalid-feedback">Please enter education description</div>
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
        </div>
        <div class="input-group">
          <label class="required">Year Graduated</label>
          <input type="text" name="eyear[]" required placeholder="e.g., 2015">
          <div class="invalid-feedback">Please enter graduation year</div>
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
          <label class="required">Description</label>
          <input type="text" name="eligibility[]" required placeholder="e.g., Civil Service Professional">
          <div class="invalid-feedback">Please enter eligibility description</div>
        </div>
        <button type="button" class="remove-btn" onclick="removeRow(this)">✕</button>
      `;
      section.insertBefore(newRow, section.querySelector(".add-btn"));
    }

    function removeRow(button) {
      const row = button.parentNode;
      // Only remove if there's more than one row
      if (row.parentNode.querySelectorAll('.education-row, .eligibility-row').length > 1) {
        row.parentNode.removeChild(row);
      }
    }

    // Form validation and submission
    function validateForm() {
      const form = document.getElementById('applicationForm');
      const allInputs = form.querySelectorAll('input, select, textarea');
      let isValid = true;
      
      // Reset validation states
      allInputs.forEach(input => {
        input.classList.remove('is-invalid', 'is-valid');
      });
      
      // Check each required field
      form.querySelectorAll('[required]').forEach(input => {
        if (!input.value.trim()) {
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
        // Scroll to first error
        const firstError = form.querySelector('.is-invalid');
        if (firstError) {
          firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }
        return;
      }
      
      // If form is valid, show confirmation modal
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
      
      // Show loading indicator
      document.querySelector('.loading').style.display = 'block';
      document.querySelector('.submit-btn').style.display = 'none';
      
      // Simulate form submission (in a real application, this would be an AJAX call)
      setTimeout(() => {
        document.querySelector('.loading').style.display = 'none';
        document.querySelector('.success-message').style.display = 'block';
        
        // Reset form after successful submission
        document.getElementById('applicationForm').reset();
        
        // Scroll to success message
        document.querySelector('.success-message').scrollIntoView({ behavior: 'smooth' });
      }, 2000);
    }

    // Close modal if user clicks outside modal content
    window.onclick = function(event) {
      const modal = document.getElementById('confirmationModal');
      if (event.target === modal) {
        closeModal();
      }
    }

    // Add real-time validation to inputs
    document.addEventListener('DOMContentLoaded', function() {
      const inputs = document.querySelectorAll('input, select, textarea');
      inputs.forEach(input => {
        input.addEventListener('blur', function() {
          if (this.hasAttribute('required') && !this.value.trim()) {
            this.classList.add('is-invalid');
            this.classList.remove('is-valid');
          } else if (this.type === 'email' && this.value && !isValidEmail(this.value)) {
            this.classList.add('is-invalid');
            this.classList.remove('is-valid');
          } else if (this.id === 'age' && this.value && (this.value < 18 || this.value > 65)) {
            this.classList.add('is-invalid');
            this.classList.remove('is-valid');
          } else if (this.value) {
            this.classList.add('is-valid');
            this.classList.remove('is-invalid');
          } else {
            this.classList.remove('is-invalid', 'is-valid');
          }
        });
      });
    });
  </script>

</body>
</html>
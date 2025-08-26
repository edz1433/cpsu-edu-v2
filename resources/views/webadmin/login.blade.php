<!DOCTYPE html>
<html lang="en">
@if(auth()->check())
    <script>window.location.href = "{{ route('admin-dashboard') }}";</script>
@endif
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CPSU Web Admin | Login</title>

  <link rel="icon" href="{{ asset('images/cpsu.png') }}" type="image/png">

  <style>
    /* 🌿 Green Palette Theme */
    body {
      background: linear-gradient(135deg, #2e7d32, #1b5e20);
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      font-family: "Segoe UI", sans-serif;
      margin: 0;
    }
    .card {
      width: 100%;
      max-width: 400px;
      border: none;
      border-radius: 15px;
      box-shadow: 0 6px 20px rgba(0, 0, 0, 0.25);
      background: #ffffff;
      padding: 2rem;
      box-sizing: border-box;
    }
	.login-logo {
		text-align: center;
	}
	.login-logo h4 {
		margin-top: 0.5rem;
		text-align: center;
	}
    h4 {
      margin: 0.5rem 0;
    }
    p {
      margin: 0.25rem 0 1.5rem;
    }

    /* Input fields */
    label {
      font-weight: 600;
      display: block;
      margin-bottom: 0.3rem;
      font-size: 14px;
    }
    input[type="text"],
    input[type="password"] {
      width: 100%;
      padding: 10px 12px;
      border: 1px solid #ccc;
      border-radius: 8px;
      font-size: 14px;
      box-sizing: border-box;
      transition: 0.3s;
    }
    input:focus {
      border-color: #2e7d32;
      outline: none;
      box-shadow: 0 0 0 3px rgba(46, 125, 50, 0.25);
    }

    /* Button */
    .btn {
      width: 100%;
      background-color: #2e7d32;
      border: none;
      border-radius: 8px;
      padding: 10px;
      color: #fff;
      font-weight: 600;
      font-size: 15px;
      cursor: pointer;
      margin-top: 1rem;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: background 0.3s;
    }
    .btn:hover {
      background-color: #1b5e20;
    }
    .btn svg {
      margin-right: 6px;
    }

    /* Alert box */
    .alert {
      background: #d32f2f;
      color: #fff;
      border: none;
      border-radius: 8px;
      padding: 10px;
      margin-bottom: 1rem;
      font-size: 14px;
      display: flex;
      align-items: center;
    }
    .alert svg {
      margin-right: 8px;
      flex-shrink: 0;
    }

    .text-green {
      color: #2e7d32;
    }
    .text-muted {
      color: #777;
      font-size: 14px;
    }
  </style>
</head>
<body>

  <div class="card">
    <div class="card-body text-center">
      <!-- Logo -->
      <div class="login-logo mb-3">
        <img src="{{ asset('images/cpsu.png') }}" alt="CPSU Logo">
        <h4 class="text-green">CPSU Web Admin</h4>
      	<p class="text-muted">Sign in to start your session</p>
      </div>


      <form action="{{ route('postLogin') }}" method="post">
        @csrf
        @if(session('error'))
          <div class="alert">
            <!-- Inline warning icon -->
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" viewBox="0 0 24 24">
              <path d="M1 21h22L12 2 1 21zm12-3h-2v2h2v-2zm0-6h-2v4h2v-4z"/>
            </svg>
            <span>{{ session('error') }}</span>
          </div>
        @endif

        <div class="form-group text-left">
          <label for="username">Username</label>
          <input id="username" name="username" type="text" placeholder="Enter username" required>
        </div>

        <div class="form-group text-left">
          <label for="password">Password</label>
          <input id="password" name="password" type="password" placeholder="Enter password" required>
        </div>

        <button type="submit" class="btn">
          <!-- Inline login icon -->
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" viewBox="0 0 24 24">
            <path d="M10 17l5-5-5-5v10zm9-12v14h-8v2h8c1.1 0 
                     2-.9 2-2V5c0-1.1-.9-2-2-2h-8v2h8z"/>
          </svg>
          Sign In
        </button>
      </form>
    </div>
  </div>

</body>
</html>

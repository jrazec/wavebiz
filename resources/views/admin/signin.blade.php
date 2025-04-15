<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Admin Sign In</title>
  <!-- Bootstrap 5 CSS CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    body {
        background: #ffe15d;
    }
    .hero {
      background: linear-gradient(0deg, #ffe15d,rgb(16, 12, 4));
      color: white;
      padding: 3rem;
      text-align: center;
    }

    .form-container {
      background: #fff;
      padding: 2rem;
      border-radius: 10px;
      box-shadow: 5px 5px 20px rgba(0,0,0,0.5);
    }

    .form-footer a {
      text-decoration: none;
    }

    .form-footer a:hover {
      text-decoration: underline;
    }

    .btn-primary {
      background-color:rgb(19, 19, 19);
    }

    .btn-primary:hover {
      background-color:rgb(109, 97, 43);
    }

    .form-floating-label {
    position: relative;
    }

    .form-control {
        margin: 1.5rem 0;
    }

    .form-floating-label label {
        position: absolute;
        top: -1rem;
        left: 0.75rem;
        font-size: 0.875rem;
        color: #6c757d;
        background-color: white;
        padding: 0 0.25rem;
        transform: translateY(1.5rem);
        opacity: 0;
        transition: all 0.2s ease-in-out;
        pointer-events: none;
    }

    .form-floating-label input:focus + label,
    .form-floating-label input:not(:placeholder-shown) + label {
        transform: translateY(0);
        opacity: 1;
    }

    /* Hide placeholder on focus */
    .form-floating-label input:focus::placeholder {
    color: transparent;
    }

  </style>
</head>
<body>

  <div class="hero">
    <img src="{{ asset('assets/wavebiz_logo.png') }}" alt="Wavebiz Logo" style="width: 12rem;">

  </div>

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6 col-lg-5">
        <div class="form-container mt-4">
        <h1>Welcome, Admin.</h1>
        <form id="loginForm">
            @csrf
            <div class="form-floating-label mb-3">
                <input name="fldUserName" type="text" id="username" class="form-control" placeholder="Username" required>
                <label for="username">Username</label>
            </div>
            <div class="form-floating-label mb-3">
                <input name="fldPassword" type="password" id="password" class="form-control" placeholder="Password" required>
                <label for="password">Password</label>
            </div>
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary">Login</button>
            </div>
            </form>
          <div class="form-footer mt-3 text-center">
            <p><a href="#">Forgot Password?</a></p>
          </div>
        </div>
      </div>
    </div>
    <div>
    @if ($errors->any())
        <div class="alert alert-danger mt-3">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
  </div>

  <!-- Bootstrap 5 JS Bundle CDN -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <!-- Login script -->
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const loginForm = document.getElementById('loginForm');
      const usernameInput = document.getElementById('username');
      const passwordInput = document.getElementById('password');

      loginForm.addEventListener('submit', async function (e) {
        e.preventDefault();

        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        const response = await fetch("{{ route('signin') }}", {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": csrfToken,
            "Accept": "application/json"
          },
          body: JSON.stringify({
            fldUserName: usernameInput.value,
            fldPassword: passwordInput.value
          })
        });

        if (response.ok) {
          // Redirect on success
          window.location.href = "/dashboard"; // Change to your dashboard route
        } else {
          const data = await response.json();
          if (data.errors) {
            alert(Object.values(data.errors).join('\n'));
          } else {
            alert('Login failed. Please check your credentials.');
          }
        }
      });
    });
  </script>
</body>
</html>

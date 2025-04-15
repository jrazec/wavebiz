<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Sign In Page</title>
  <!-- Bootstrap 5 CSS CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    .hero {
      background: linear-gradient(135deg, #4e54c8, #8f94fb);
      color: white;
      padding: 60px 0;
      text-align: center;
    }

    .form-container {
      margin-top: -40px;
      background: #fff;
      padding: 2rem;
      border-radius: 10px;
      box-shadow: 0 5px 20px rgba(0,0,0,0.1);
    }

    .form-footer a {
      text-decoration: none;
    }

    .form-footer a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>

  <div class="hero">
    <h1>Welcome Back!</h1>
    <p>Please sign in to your account</p>
  </div>

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6 col-lg-5">
        <div class="form-container mt-4">
          <h3 class="mb-4 text-center">Sign In</h3>
          <form id="loginForm">
            @csrf
            <div class="mb-3">
              <label for="username" class="form-label">Username or Email</label>
              <input name="fldUserName" type="text" class="form-control" id="username" placeholder="Enter your username" required>
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input name="fldPassword" type="password" class="form-control" id="password" placeholder="Enter your password" required>
            </div>
            <div class="d-grid gap-2">
              <button type="submit" class="btn btn-primary">Login</button>
            </div>
          </form>

          <div class="form-footer mt-3 text-center">
            <p><a href="#">Forgot Password?</a></p>
            <p>Don't have an account? <a href="#">Sign Up</a></p>
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

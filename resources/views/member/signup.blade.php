<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Signup Form</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    body {
      background-color: #f8f9fa;
      background: linear-gradient(135deg, #4e54c8, #8f94fb);
      color: white;
      padding: 60px 0;

    }
    .signup-form {
      background: #fff;
      padding: 2rem;
      border-radius: 10px;
      box-shadow: 0 5px 20px rgba(0,0,0,0.1);
      
    }
    h3,label {
        color: #000;;
    }
  </style>
</head>
<body>

  <div class="container my-5">
    <div class="row justify-content-center">
      <div class="col-lg-10">
        <div class="signup-form">
          <h3 class="text-center mb-4">Create Your Account</h3>
          <form method="POST" action="{{route('signup')}}">
          @csrf
            <div class="row">
              <div class="col-md-6 mb-3">
                <label>User ID</label>
                <input type="text" name="fldUserID" class="form-control" required />
              </div>
              <div class="col-md-4 mb-3">
                <label>First Name</label>
                <input type="text" name="fldFirstName" class="form-control" />
              </div>
              <div class="col-md-4 mb-3">
                <label>Middle Name</label>
                <input type="text" name="fldMiddleName" class="form-control" />
              </div>
              <div class="col-md-4 mb-3">
                <label>Last Name</label>
                <input type="text" name="fldLastName" class="form-control" />
              </div>
              
              <div class="col-md-6 mb-3">
                <label>Username</label>
                <input type="text" name="fldUserName" class="form-control" required />
              </div>
              <div class="col-md-6 mb-3">
                <label>Password</label>
                <input type="password" name="fldPassword" class="form-control" required />
              </div>
              <div class="col-md-6 mb-3">
                <label>Nickname</label>
                <input type="text" name="fldNickName" class="form-control" />
              </div>
              <div class="col-md-6 mb-3">
                <label>Birthdate</label>
                <input type="date" name="fldBirthDate" class="form-control" required />
              </div>

              <div class="col-md-6 mb-3">
                <label>Civil Status</label>
                <select name="fldCivilStatus" class="form-select">
                  <option value="1">Single</option>
                  <option value="2">Married</option>
                  <option value="3">Divorced</option>
                  <option value="4">Widowed</option>
                </select>
              </div>
              <div class="col-md-6 mb-3">
                <label>Gender</label>
                <select name="fldGender" class="form-select">
                  <option value="1">Male</option>
                  <option value="2">Female</option>
                </select>
              </div>

              <div class="col-md-6 mb-3">
                <label>Nationality</label>
                <input type="text" name="fldNationality" class="form-control" />
              </div>


              <div class="col-md-6 mb-3">
                <label>Email Address</label>
                <input type="email" name="fldEmailAdd" class="form-control" />
              </div>
              <div class="col-md-3 mb-3">
                <label>Cellphone</label>
                <input type="text" name="fldCellphone" class="form-control" />
              </div>
              <div class="col-md-3 mb-3">
                <label>Landline</label>
                <input type="text" name="fldLandline" class="form-control" />
              </div>

              <div class="col-md-6 mb-3">
                <label>Beneficiary</label>
                <textarea name="fldBeneficiary" class="form-control"></textarea>
              </div>
              <div class="col-md-6 mb-3">
                <label>Relationship</label>
                <input type="text" name="fldRelationship" class="form-control" />
              </div>

              <div class="col-md-6 mb-3">
                <label>TIN</label>
                <input type="text" name="fldTIN" class="form-control" />
              </div>

              <div class="col-md-6 mb-3">
                <label>Sponsor ID</label>
                <input type="number" name="fldSponsorID" class="form-control" value="0" />
              </div>
              <div class="col-md-6 mb-3">
                <label>Direct Sponsor ID</label>
                <input type="number" name="fldDirectSponsorID" class="form-control" value="0" />
              </div>

              <div class="col-12 mb-3">
                <label>Terms and Conditions</label>
                <textarea name="fldTermsAndCondition" class="form-control" rows="3" value="">By using our website and placing an order, you agree to the following terms:

Orders and Payments
All orders are subject to availability and confirmation of the order price. We accept payments via [list payment methods].

Shipping
We aim to deliver your order within [X] business days. Shipping times may vary based on your location.

Returns and Refunds
You may return most items within [X] days of delivery for a refund or exchange. Items must be unused and in original condition.

Product Information
We strive to ensure all product details, descriptions, and prices are accurate. In case of errors, we reserve the right to correct them.

Privacy
We respect your privacy and handle your personal information according to our [Privacy Policy link].

Contact Us
If you have any questions, feel free to reach out at [email/contact info].

</textarea>
              </div>

              <div class="col-12 form-check mb-3">
                <input class="form-check-input" type="checkbox" name="fldAgreeTerms" value="1" checked />
                <label class="form-check-label">I agree to the terms and conditions</label>
              </div>

              <div class="col-12 text-center">
                <button type="submit" class="btn btn-primary px-5">Sign Up</button>
              </div>

            </div> <!-- row -->
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal for validation in $errors->any() -->
   <div>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
  </div>
  <div id="messageBox" class="mt-3"></div>
  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    document.getElementById('signupForm').addEventListener('submit', async function (e) {
    e.preventDefault(); // prevent default form submission

    const form = e.target;
    const formData = new FormData(form);
    const data = {};

    // Convert FormData to plain object
    formData.forEach((value, key) => {
            // Handle multiple form fields with the same name
            if (data[key] !== undefined) {
            if (!Array.isArray(data[key])) {
                data[key] = [data[key]];
            }
            data[key].push(value);
            } else {
            data[key] = value;
            }
        });

        try {
            const response = await fetch('/api/signup', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
            });

            const result = await response.json();

            document.getElementById('messageBox').innerHTML = `
            <div class="alert ${response.ok ? 'alert-success' : 'alert-danger'}">
                ${result.message || (response.ok ? 'Signup successful!' : 'Signup failed!')}
            </div>
            `;

            if (response.ok) form.reset();

        } catch (error) {
            document.getElementById('messageBox').innerHTML = `
            <div class="alert alert-danger">An error occurred: ${error.message}</div>
            `;
        }
    });
  </script>
  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

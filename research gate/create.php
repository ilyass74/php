


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Registration - Sign Up</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #007bff;
            --secondary-color: #6c757d;
            --background-light: #f4f6f9;
            --text-dark: #333;
        }

        body {
            background-color: var(--background-light);
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            color: var(--text-dark);
        }

        .signup-container {
            display: flex;
            min-height: 100vh;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .signup-card {
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 123, 255, 0.1);
            padding: 40px;
            width: 100%;
            max-width: 500px;
            border: 1px solid rgba(0, 123, 255, 0.1);
        }

        .signup-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .signup-header h2 {
            color: var(--primary-color);
            font-weight: 700;
            margin-bottom: 10px;
        }

        .form-control, .form-select {
            padding: 12px;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        }

        .btn-primary {
            background-color: var(--primary-color);
            border: none;
            padding: 12px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .password-requirements {
            font-size: 0.8rem;
            color: var(--secondary-color);
            margin-top: 5px;
        }

        .login-link {
            color: var(--secondary-color);
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .login-link:hover {
            color: var(--primary-color);
            text-decoration: underline;
        }

        @media (max-width: 576px) {
            .signup-card {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="signup-container">
        <div class="signup-card">
            <div class="signup-header">
                <h2>ResearchXchange</h2>
                <p class="text-muted">Sign up to access our platform</p>
            </div>

            <form method="POST" id="signupForm" novalidate>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="fname" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="fname" name="firstName" required pattern="[A-Za-z]+" title="First name should only contain letters">
                        <div class="invalid-feedback">Please enter a valid first name</div>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="lname" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="lname" name="lastName" required pattern="[A-Za-z]+" title="Last name should only contain letters">
                        <div class="invalid-feedback">Please enter a valid last name</div>
                    </div>
                </div>
                
                <div class="mb-3">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                    <div class="invalid-feedback">Please enter a valid email address</div>
                </div>
                
                <div class="mb-3">
                    <label for="cities" class="form-label">City</label>
                    <select class="form-select" name="cities" id="cities" required>
                        <option value="">Select your city</option>
                        <!-- PHP City Population would be dynamically populated here -->
                    </select>
                    <div class="invalid-feedback">Please select a city</div>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" 
                           required minlength="8" 
                           pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*]).{8,}"
                           title="Must contain at least one number, one uppercase, one lowercase letter, one special character, and be at least 8 characters long">
                    <div class="password-requirements">
                        <small>
                            <i class="fas fa-info-circle"></i> 
                            Password must be at least 8 characters with uppercase, lowercase, number, and symbol
                        </small>
                    </div>
                    <div class="invalid-feedback">Please enter a strong password</div>
                </div>

                <div class="d-grid gap-2 mt-4">
                    <button type="submit" name="submit" class="btn btn-primary btn-lg">
                        <i class="fas fa-user-plus"></i> Sign Up
                    </button>
                </div>

                <div class="text-center mt-3">
                    <a href="login.php" class="login-link">
                        Already have an account? Login here
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('signupForm');
        
        form.addEventListener('submit', function(event) {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
            
            form.classList.add('was-validated');
        }, false);
    });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


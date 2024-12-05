<?php
// Include necessary files for database connection
include("connection.php");  // Your connection file

// Start the session to track user login status
session_start();

// Handle login form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Create a new connection object
    $conn = new mysqli("localhost", "root", "", "poog4");  // Replace with your DB credentials

    // Check if email exists and password matches
    $sql = "SELECT * FROM clients WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    // If the email exists and password matches
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verify password
        if (password_verify($password, $user['password'])) {
            // Start session for the logged-in user
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['email'] = $user['email'];

            // Redirect to dashboard or another page after successful login
            header("Location: dashboard.php");
            exit();
        } else {
            $error_message = "Invalid password.";
        }
    } else {
        $error_message = "No account found with this email.";
    }

    // Close the database connection
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom CSS for styling */
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }
        .login-container {
            display: flex;
            min-height: 100vh;
            align-items: center;
            justify-content: center;
        }
        .login-card {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 10px 25px rgba(0, 123, 255, 0.1);
            padding: 40px;
            width: 100%;
            max-width: 400px;
        }
        .login-card h2 {
            color: #007bff;
            font-weight: bold;
            text-align: center;
            margin-bottom: 20px;
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
            padding: 12px;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .text-center a {
            color: #007bff;
        }
        .text-center a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <h2>Login</h2>
            <?php
            if (isset($error_message)) {
                echo "<div class='alert alert-danger'>$error_message</div>";
            }
            ?>
            <form method="POST" action="">
                <div class="mb-3">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>

                <div class="d-grid gap-2 mt-4">
                    <button type="submit" class="btn btn-primary btn-lg">Login</button>
                </div>
            </form>

            <div class="text-center mt-3">
                <a href="create.php">Don't have an account? Sign up here</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

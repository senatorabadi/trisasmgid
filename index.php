<?php
session_start(); // Mulai sesi

include 'koneksi.php';

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
$error_message = ""; // Inisialisasi variabel error_message
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username === "admin" && $password === "admin") {
        $_SESSION['user_name'] = "admin"; // Set session for admin
        $redirect = isset($_GET['redirect']) ? $_GET['redirect'] : 'dashboard.php';
        header("Location: $redirect");
        exit();
    }

    // Fetch user from the database
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        // Verify password (assuming the password is hashed)
        if (password_verify($password, $user['password'])) {
            $_SESSION['username'] = $username; // Simpan username ke dalam sesi
            header("Location: projek.php");
            exit();
        } else {
            $error_message = "Username or password is incorrect.";
        }
    } else {
        $error_message = "Username or password is incorrect.";
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <div class="container">
        <div class="login-form">
            <h2>LOG IN</h2>

            <!-- Error message notification -->
            <div class="error-notification" id="errorNotification" style="display: <?php echo !empty($error_message) ? 'block' : 'none'; ?>;">
                <?php echo $error_message; ?>
            </div>

            <!-- Login Form -->
            <form id="loginForm" method="POST" action="index.php">
                <div class="input-field">
                    <input type="text" name="username" id="username" placeholder="Username" required>
                    <i class="fas fa-user"></i>
                </div>
                <div class="input-field">
                    <input type="password" id="password" name="password" placeholder="Password" required>
                    <span class="password-toggle" onclick="togglePasswordVisibility()">
                        <i class="fa fa-eye"></i>
                    </span>
                </div>
                <button type="submit">Log in</button>
            </form>
            <p>Click here to <a href="#" id="registerLink">Create an Account</a></p>
        </div>
    </div>
    
    <script>
        function togglePasswordVisibility() {
            var passwordInput = document.getElementById("password");
            var passwordToggleIcon = document.querySelector(".password-toggle i");

            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                passwordToggleIcon.classList.remove("fa-eye");
                passwordToggleIcon.classList.add("fa-eye-slash");
            } else {
                passwordInput.type = "password";
                passwordToggleIcon.classList.remove("fa-eye-slash");
                passwordToggleIcon.classList.add("fa-eye");
            }
        }

        // Redirect to the registration page
        document.getElementById('registerLink').addEventListener('click', function() {
            window.location.href = 'register.php';
        });

        // Hide error notification after 2 seconds
 if (document.getElementById("errorNotification").style.display === "block") {
            setTimeout(function() {
                document.getElementById("errorNotification").style.display = "none";
            }, 2000);
        }
    </script>
    <style>
        .input-field {
            position: relative;
            margin-bottom: 20px;
        }

        .input-field input {
            width: 100%;
            padding: 10px 0; /* Padding untuk memberi ruang bagi ikon */
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .input-field i {
            position: absolute;
            top: 50%;
            right: 3px; /* Posisi ikon user */
            transform: translateY(-50%);
            color: #888;
        }

        .password-toggle {
            position: absolute;
            top: 50%;
            right: 3px; /* Posisi ikon eye */
            transform: translateY(-50%);
            cursor: pointer;
            color: #888;
        }

        .error-notification {
            background-color: red;
            color: white;
            padding: 10px;
            border-radius: 5px;
            text-align: center;
            margin-top: 10px;
            position: fixed;
            top: 10px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 9999;
            display: none; /* Default hidden */
        }
    </style>
</body>
</html> 
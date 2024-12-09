<?php
include 'koneksi.php';

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    
    // Check if the username already exists in the database
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Username exists, display an error message
        $error_message = "Error: The username '$username' is already taken. Please choose another one.";
        echo "<script>window.onload = function() {
            displayError('$error_message');
        }</script>";
    } else {
        // Check if passwords match
        if ($password !== $confirm_password) {
            // Passwords don't match, display error
            $error_message = "Error: The passwords do not match. Please try again.";
            echo "<script>window.onload = function() {
                displayError('$error_message');
            }</script>";
        } else {
            // Hash the password
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Prepare the insert query using prepared statements to prevent SQL injection
            $stmt = $conn->prepare("INSERT INTO users (name, phone, username, password) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $name, $phone, $username, $hashedPassword);

            // Execute the query and check if the insertion is successful
            if ($stmt->execute()) {
                echo "New record created successfully!";
                header("Location: index.php");  // Redirect to the login page after successful registration
                exit();
            } else {
                echo "Error: " . $stmt->error;
            }

            // Close statement
            $stmt->close();
        }
    }
}

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
    <link rel="stylesheet" href="css/login.css">
    <style>
        /* Style for the floating error notification */
        <style>
    /* Style for the floating error notification */
    .error-notification {
        background-color: red;
        color: white;
        padding: 10px;
        border-radius: 5px;
        text-align: center;
        margin-top: 10px;
        display: none;
        position: fixed;
        top: 10px;
        left: 50%;
        transform: translateX(-50%);
        z-index: 9999;
    }


    input {
        padding: 10px;
        width: 200px;
        margin: -5px 0; /* Mengurangi margin atas dan bawah */
    }

    button {
        margin-top: 10px; /* Menjaga jarak antara tombol dan input sebelumnya */
    }
</style>
    </style>
</head>
<body>
    <div class="container">
        <div class="register-form">
            <h2>CREATE ACCOUNT</h2>
            
            <!-- Error notification (initially hidden) -->
            <div id="error-notification" class="error-notification"></div>

            <!-- Registration Form -->
            <form id="registerForm" method="POST" action="register.php">
                <div class="input-field">
                    <input type="text" name="name" placeholder="Masukkan Nama" required>
                </div>
                <div class="input-field">
                    <input type="text" name="phone" placeholder="Masukkan No HP" required>
                </div>
                <div class="input-field">
                    <input type="text" name="username" placeholder="Masukkan Username" required>
                </div>
                <div class="input-field">
                    <input type="password" name="password" placeholder="Masukkan Password" required>
                </div>
                <div class="input-field">
                    <input type="password" name="confirm_password" placeholder="Ulangi Password" required>
                </div>
                <button type="submit">Register</button>
            </form>
            <p>I already have an account!!  <a href="index.php">Log in</a></p>
        </div>
    </div>

    <script>
        // Display error message and clear form fields
        function displayError(message) {
            var errorDiv = document.getElementById('error-notification');
            errorDiv.textContent = message;
            errorDiv.style.display = 'block';

            // Clear the form fields after error message
            document.getElementById('registerForm').reset();

            // Hide the error message after 5 seconds
            setTimeout(function() {
                errorDiv.style.display = 'none';
            }, 5000); // Error message will disappear after 5 seconds
        }
    </script>
</body>
</html>

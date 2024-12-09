<?php

include 'koneksi.php';

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $orderDate = $_POST['orderDate'];
    $pickupDate = $_POST['pickupDate'];
    $product = $_POST['product'];
    $quantity = $_POST['quantity'];
    $totalPrice = $_POST['totalPrice'];
    $payment = $_FILES['payment']['name'];



    // Insert order into database
    $stmt = $conn->prepare("INSERT INTO orders (name, phone, address, order_date, pickup_date, product, quantity, total_price, payment) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssisss", $name, $phone, $address, $orderDate, $pickupDate, $product, $quantity, $totalPrice, $payment);
    $stmt->execute();

    // Send confirmation email
    $to = "kdiftargaming@gmail.com";
    $subject = "New Order Confirmation";
    $message = "New order from $name. Product: $product, Quantity: $quantity, Total Price: $totalPrice.";
    mail($to, $subject, $message);

    $stmt->close();
    $conn->close();

    header("Location: thank_you.html");
    exit();
}
?>
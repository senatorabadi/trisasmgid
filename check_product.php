<?php
header('Content-Type: application/json');

include 'koneksi.php';

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Mengambil data dari permintaan
$data = json_decode(file_get_contents("php://input"), true);
$productName = $data['name'];

// Memeriksa apakah produk ada di database
$sql = "SELECT stock FROM products WHERE name = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $productName);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($stock);

if ($stmt->num_rows > 0) {
    $stmt->fetch();
    echo json_encode(["exists" => true, "stock" => $stock]);
} else {
    echo json_encode(["exists" => false]);
}

$stmt->close();
$conn->close();
?>
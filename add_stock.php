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
$newStock = $data['stock'];

// Memperbarui jumlah stok di database
$sql = "UPDATE products SET stock = ? WHERE name = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("is", $newStock, $productName);

if ($stmt->execute()) {
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false, "error" => "Gagal memperbarui stok: " . $stmt->error]);
}

$stmt-> close();
$conn->close();
?>
<?php
header('Content-Type: application/json');

include 'koneksi.php';

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);


// Memeriksa koneksi
if ($conn->connect_error) {
    echo json_encode([]);
    exit;
}

// Mengambil daftar produk dari database
$sql = "SELECT name FROM products";
$result = $conn->query($sql);

$products = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $products[] = $row['name'];
    }
}

echo json_encode($products);
$conn->close();
?>
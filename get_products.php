<?php
include 'koneksi.php';

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Mengambil data produk yang memiliki stok lebih dari 0
$sql = "SELECT * FROM products WHERE stock > 0";
$result = $conn->query($sql);

$products = array();

if ($result->num_rows > 0) {
    // Mengambil data setiap baris
    while($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
} 

// Mengembalikan data dalam format JSON
header('Content-Type: application/json');
echo json_encode($products);

$conn->close();
?>
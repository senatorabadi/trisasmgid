<?php
include 'koneksi.php';

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ambil ID produk dari query string
$id = $_GET['id'];

// Query untuk mengambil data produk berdasarkan ID
$sql = "SELECT * FROM products WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Ambil data produk
    $data = $result->fetch_assoc();
    echo json_encode($data);
} else {
    echo json_encode(null);
}

$stmt->close();
$conn->close();
?>
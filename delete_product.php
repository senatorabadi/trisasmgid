<?php
include 'koneksi.php';

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_GET['id'];

$sql = "DELETE FROM products WHERE id='$id'";
if ($conn->query($sql) === TRUE) {
    echo "Produk berhasil dihapus.";
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>
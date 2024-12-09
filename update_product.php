<?php
include 'koneksi.php';

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_GET['id'];
$data = json_decode(file_get_contents("php://input"), true);
$name = $data['name'];
$price = $data['price'];
$image = $data['image'];
$description = $data['description'];
$stock = $data['stock'];

$sql = "UPDATE products SET name='$name', price='$price', image='$image', description='$description', stock='$stock' WHERE id='$id'";
if ($conn->query($sql) === TRUE) {
    echo "Produk berhasil diperbarui.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
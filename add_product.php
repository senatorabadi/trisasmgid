<?php
include 'koneksi.php';

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$data = json_decode(file_get_contents("php://input"), true);
$name = $data['name'];
$price = $data['price'];
$image = $data['image'];
$description = $data['description'];
$stock = $data['stock'];

$sql = "INSERT INTO products (name, price, image, description, stock) VALUES ('$name', '$price', '$image', '$description', '$stock')";
if ($conn->query($sql) === TRUE) {
    echo "Produk berhasil ditambahkan.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
<?php
include 'koneksi.php';

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Ambil data dari form
$id = $_POST['id_produk'];
$name = $_POST['name'];
$price = $_POST['price'];
$image = $_POST['image'];
$description = $_POST['description'];
$stock = $_POST['stock'];

// Query untuk memperbarui data produk
$sql = "UPDATE products SET name=?, price=?, image=?, description=?, stock=? WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sdssii", $name, $price, $image, $description, $stock, $id);

if ($stmt->execute()) {
    echo "<script>
    window.onload = function() {
    alert('Data product telah berhasil di edit'); 
    window.location.href = 'edit_produk.php'; 
    }
    </script>";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
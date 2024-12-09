<?php
include 'koneksi.php';

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Mengambil data dari database
$sql = "SELECT * FROM kontak ORDER BY created_at DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>Nama</th><th>No Hp</th><th>Pertanyaan</th><th>Tanggal</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["nama"]. "</td><td>" . $row["no_hp"]. "</td><td>" . $row["pertanyaan"]. "</td><td>" . $row["created_at"]. "</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}

$conn->close();
?>
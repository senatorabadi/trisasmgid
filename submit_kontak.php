<?php
include 'koneksi.php'; 

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Mengambil data dari form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $no_hp = $_POST['no_hp'];
    $pertanyaan = $_POST['pertanyaan'];

    // Menyimpan data ke dalam database
    $sql = "INSERT INTO kontak (nama, no_hp, pertanyaan) VALUES ('$nama', '$no_hp', '$pertanyaan')";
    
    if ($conn->query($sql) === TRUE) {
        echo  "<script>
        window.onload = function() {
        alert('harap bisa di tunggu nanti akan kami kabarkan lewat wa'); 
        window.location.href = 'projek.php#kontak';
        }
        </script>";
    } else {
        echo json_encode(["success" => false, "message" => "Error: " . $conn->error]);
    }
}

$conn->close();
?>
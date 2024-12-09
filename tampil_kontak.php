<?php
session_start();
include 'koneksi.php'; // Sambungkan ke database
// Pastikan tidak ada output di atas kode ini
if (!isset($_SESSION['user_name'])) {
    header("Location: index.php?redirect=tampil_kontak.php");
    exit(); // Menambahkan exit untuk menghentikan eksekusi setelah pengalihan
}

$_SESSION['last_activity'] = time(); // Perbarui waktu aktivitas terakhir

// Membuat koneksi ke database
$conn = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1">
    <title>Trisasmg.id Admin</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <!-- font awesome cdn link -->
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">

    <!-- custom css file link -->
    <link rel="stylesheet" href="styles.css">

</head>
<body>
    
    <input type="checkbox" id="nav-toggle">
    <div class="sidebar">
        <a href="#" class="logo"><i class="fas-fa-untensils">
            <img src="image/BEE-70171-48b38c43-ae88-4bd2-b11e-bdcc561d807d-removebg-preview.png"  alt=""> </i>
    
        <div class="sidebar-menu">
            <ul>
                <li>
                    <a href="dashboard.php" ><span class="las la-igloo"></span>
                    <span>Dashboard</span></a>
                </li>
                <li>
                    <a href="data.php"><span class="las la-users"></span>
                    <span>Data Pelanggan</span></a>
                </li>
                <li>
                    <a href="manajemenpesanan.php"><span class="las la-clipboard-list"></span>
                    <span>Manajemen Pemesanan</span></a>
                </li>
                <li>
                    <a href="persediaan.php" ><span class="las la-receipt"></span>
                    <span>Persediaan</span></a>
                </li>
                <li>
                    <a href="review.php"><span class="las la-igloo"></span>
                    <span>Review</span></a>
                </li>
                <li>
                <a href="tampil_kontak.php" class="active" ><span class="las la-clipboard-list"></span>
                    <span>Pertanyaan</span></a>
                </li>
                <li>
                    <a href="grafik.php"><span class="las la-clipboard-list"></span>
                    <span>Grafik Penjualan</span></a>
                </li>
                <li class="Logout">
                    <a href="logout.php"><span class="las la-sign-out-alt"></span>
                    <span>Logout</span></a>
                </li>
            </ul>
        </div>
    </div>
    <div class="main-content">
        <header>
            <h2>
                <label for="nav-toggle">
                    <span class="las la-bars"></span>
                </label>
    
                Persediaan
            </h2>
    
            <div class="user-wrapper">
                <img src="img/logo1.jpg" width="40px" height="40px" alt="">
                <div>
                <h4>Admin</h4>
                </div>
            </div>
        </header>

<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Kontak</title>
    <link rel="stylesheet" href="tampil_kontak.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #ffffff;
            margin: 0;
            padding: 20px;
            margin-top: 70px;
        }

        .container {
            max-width: 800px;
            margin: auto;
            background: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
        }

        .table-container {
            max-height: 430px; /* Set a max height for the scrollable area */
            overflow-y: auto; /* Enable vertical scrolling */
            border: 1px solid #ddd; /* Optional: Add a border */
            border-radius: 5px; /* Optional: Add rounded corners */
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            position: relative; /* Required for sticky positioning */
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #ecb56e;
            position: sticky; /* Make header sticky */
            top: 0; /* Stick to the top */
            z-index: 10; /* Ensure it stays above other content */
        }

        tr:hover {
            background-color: #f5f5f5;
        }


    </style>
</head>
<body>

    <div class="container">
    <h1>Pertanyaan Pelanggan</h1>
    <div class="table-container">
            <table>
                <thead>
                    <tr>
                      <th>Nama</th>
                      <th>No Hp</th>
                      <th>Pertanyaan</th>
                      <th>Tanggal</th>
                    </tr>
                </thead>
        <?php
            $servername = "localhost"; 
            $username = "root";
            $password = ""; 
            $dbname = "trisasmg_id"; 

            // Membuat koneksi
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Memeriksa koneksi
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Mengambil data dari database
            $sql = "SELECT * FROM kontak ORDER BY created_at DESC";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr><td>" . $row["nama"]. "</td><td>" . $row["no_hp"]. "</td><td>" . $row["pertanyaan"]. "</td><td>" . $row["created_at"]. "</td></tr>";
                }
                echo "</table>";
            } else {
                echo "0 results";
            }

            $conn->close();
        ?>
    </div>
</body>
</html>
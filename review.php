
<?php
session_start();
include 'koneksi.php'; // Sambungkan ke database
// Pastikan tidak ada output di atas kode ini
if (!isset($_SESSION['user_name'])) {
    header("Location: index.php?redirect=review.php");
    exit(); // Menambahkan exit untuk menghentikan eksekusi setelah pengalihan
}

$_SESSION['last_activity'] = time(); // Perbarui waktu aktivitas terakhir

// Membuat koneksi ke database
$conn = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


// Query untuk mengambil data
$sql = "SELECT name, rating, comment FROM reviews ORDER BY created_at DESC";
$result = $conn->query($sql);

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
    <link rel="stylesheet" href="review.css">

</head>
<body>
    
    <input type="checkbox" id="nav-toggle">
    <div class="sidebar">
        <a href="#" class="logo"><i class="fas-fa-untensils">
            <img src="image/BEE-70171-48b38c43-ae88-4bd2-b11e-bdcc561d807d-removebg-preview.png"  alt=""> </i>
    
        <div class="sidebar-menu">
            <ul>
                <li>
                    <a href="dashboard.php"><span class="las la-igloo"></span>
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
                <li>
                    <a href="persediaan.php"><span class="las la-receipt"></span>
                    <span>Persediaan</span></a>
                </li>
                <li>
                    <a href="review.php" class="active"><span class="las la-igloo"></span>
                    <span>Review</span></a>
                </li>
                <li>
                <a href="tampil_kontak.php"><span class="las la-clipboard-list"></span>
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
    
                Review
            </h2>
    
            <div class="user-wrapper">
                <img src="img/logo1.jpg" width="40px" height="40px" alt="">
                <div>
                <h4>Admin</h4>
                </div>
            </div>
        </header>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review</title>
    <link rel="stylesheet" href="review.css">
    <style>
        .table-container {
            max-height: 430px; /* Atur tinggi maksimum yang diinginkan */
            overflow-y: auto; /* Tambahkan scroll vertikal */
            overflow-x: auto; /* Tambahkan scroll horizontal */
        }

        table {
            width: 100%; /* Pastikan tabel mengambil lebar penuh kontainer */
            border-collapse: collapse;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
            white-space: nowrap; /* Mencegah teks membungkus */
        }

        th {
            background-color: #ecb56e;
            position: sticky; /* Menjaga posisi tetap */
            top: 0; /* Menentukan posisi tetap di atas */
            z-index: 10; /* Pastikan th berada di atas td */
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Review Customer</h1>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Bintang</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        // Output data dari setiap baris
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>" . htmlspecialchars($row["name"]) . "</td>
                                    <td>" . htmlspecialchars($row["rating"]) . "</td>
                                    <td>" . htmlspecialchars($row["comment"]) . "</td>
                                </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='3'>Tidak ada data</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>

<?php
$conn->close();
?>


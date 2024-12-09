<?php
session_start();
include 'koneksi.php'; // Sambungkan ke database
// Pastikan tidak ada output di atas kode ini
if (!isset($_SESSION['user_name'])) {
    header("Location: index.php?redirect=grafik.php");
    exit(); // Menambahkan exit untuk menghentikan eksekusi setelah pengalihan
}

$_SESSION['last_activity'] = time(); // Perbarui waktu aktivitas terakhir

// Koneksi ke database
$host = 'localhost'; // Ganti dengan host database Anda
$user = 'root';      // Ganti dengan username database Anda
$pass = '';          // Ganti dengan password database Anda (kosongkan jika tidak ada)
$dbname = 'trisasmg_id'; // Nama database

$conn = new mysqli($host, $user, $pass, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data dari tabel pemesanan
$sql = "SELECT name_product, jumlah_product_terjual FROM grafik";
$result = $conn->query($sql);

$pesanan = [];
$jumlah = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $pesanan[] = $row['name_product'];
        $jumlah[] = $row['jumlah_product_terjual'];
    }
} else {
    echo "0 results";
}
$conn->close();
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
    <link rel="stylesheet" href="grafikk.css">

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
                    <a href="review.php"><span class="las la-igloo"></span>
                    <span>Review</span></a>
                </li>
                <li>
                <a href="tampil_kontak.php"><span class="las la-clipboard-list"></span>
                    <span>Pertanyaan</span></a>
                </li>
                <li>
                    <a href="grafik.php" class="active"><span class="las la-clipboard-list"></span>
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
    
                Grafik Penjualan
            </h2>
    
            <div class="user-wrapper">
                <img src="img/logo1.jpg" width="40px" height="40px" alt="">
                <div>
                    <h4>Rachma</h4>
                    <Small>Admin</Small>
                </div>
            </div>
        </header>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grafik Penjualan</title>
    <link rel="stylesheet" href="grafikk.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div class="container">
        <h1>Grafik Penjualan</h1>
        <canvas id="myChart" width="400" height="200"></canvas>
    </div>

    <script>
        const ctx = document.getElementById('myChart').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'bar', // Jenis grafik yang ingin ditampilkan (bar, line, pie, dll)
            data: {
                labels: <?php echo json_encode($pesanan); ?>,
                datasets: [{
                    label: 'Jumlah Penjualan',
                    data: <?php echo json_encode($jumlah); ?>,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>
</html>
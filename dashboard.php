<?php
// Mulai sesi
session_start();
include 'koneksi.php'; // Sambungkan ke database
// Pastikan tidak ada output di atas kode ini
if (!isset($_SESSION['user_name'])) {
    header("Location: index.php?redirect=dashboard.php");
    exit(); // Menambahkan exit untuk menghentikan eksekusi setelah pengalihan
}

$_SESSION['last_activity'] = time(); // Perbarui waktu aktivitas terakhir

// Membuat koneksi ke database
$conn = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query untuk mendapatkan data produk dan total penjualan
$sql_sales = "SELECT nama_produk AS product, SUM(total_harga) AS total_sales 
              FROM order_detail
              GROUP BY nama_produk
              ORDER BY nama_produk  ASC";
$result_sales = $conn->query($sql_sales);

// Simpan data dalam array untuk digunakan di JavaScript
$sales_data = array(
    'labels' => array(),
    'sales' => array()
);
while ($row = $result_sales->fetch_assoc()) {
    $sales_data['labels'][] = $row['product'];
    $sales_data['sales'][] = $row['total_sales'];
}

// Encode data menjadi JSON
$sales_data_json = json_encode($sales_data);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1">
    <title>Trisasmg.id Admin</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="dashboard.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <input type="checkbox" id="nav-toggle">
    <div class="sidebar">
        <a href="#" class="logo">
            <img src="image/BEE-70171-48b38c43-ae88-4bd2-b11e-bdcc561d807d-removebg-preview.png" alt="">
        </a>
        <div class="sidebar-menu">
            <ul>
            <li>
                    <a href="dashboard.php"  class="active"><span class="las la-igloo"></span>
                    <span>Dashboard</span></a>
                </li>
                <li>
                    <a href="data.php" ><span class="las la-users"></span>
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
                <label for="nav-toggle"><span class="las la-bars"></span></label>
                Dashboard
            </h2>

            <div class="judul">
                <div>
                    <h1>TRISASMG.id</h1>
                </div>
            </div>

            <div class="user-wrapper">
                <img src="img/logo1.jpg" width="40px" height="40px" alt="">
                <div>
                    <h4>Admin</h4>
                </div>
            </div>
        </header>
        <main>


    <div class="cards">

        <div class="card-single">
            <div class="card-content"><a href=data.php>
                <h2>
                    <?php
                    include 'koneksi.php';
                    $result = mysqli_query($conn, "SELECT COUNT(DISTINCT nama_pemesan) AS total_nama_pemesan FROM pemesan");
                    $data = mysqli_fetch_assoc($result);
                    echo $data['total_nama_pemesan'];
                    ?>
                </h2>
                <span>Pelanggan</span>
            </div>
            <div class="card-actions">
                <h1 class="las la-users"></h1>
            </div>
        </div>
        
        <div class="card-single">
            <div class="card-content"><a href=manajemenpesanan.php>
                <h2>
                    <?php
                    $result = mysqli_query($conn, "SELECT COUNT(*) AS total_orders FROM pemesan");
                    $data = mysqli_fetch_assoc($result);
                    echo $data['total_orders'];
                    ?>
                </h2>
                <span>Pesanan</span>
            </div>
            <div class="card-actions">
                <h1 class="las la-clipboard-list" ></h1>
            </div>
        </div>
        
        <div class="card-single">
            <div class="card-content"><a href=persediaan.php>
                <h2>
                    <?php
                    $result = mysqli_query($conn, "SELECT COUNT(*) AS total_name FROM products");
                    $data = mysqli_fetch_assoc($result);
                    echo $data['total_name'];
                    ?>
                </h2>
                <span>Persediaan</span>
            </div>
            <div class="card-actions">
                <h1 class="las la-receipt"></h1>
            </div>
        </div>
        
        <div class="card-single">
            <div class="card-content"><a href=review.php>
                <h2>
                    <?php
                    $result = mysqli_query($conn, "SELECT COUNT(*) AS total_name FROM kontak");
                    $data = mysqli_fetch_assoc($result);
                    echo $data['total_name'];
                    ?>
                </h2>
                <span>Review</span>
            </div>
            <div class="card-actions">
                <h1 class="las la-igloo"></h1>
            </div>
        </div>
    </div>

    <div class="chart-container">
    <a href=grafik.php>
    <h3>Grafik Penjualan</h3>
    <canvas id="salesChart"></canvas>
    </div>

    <script>
    // Data dari PHP
    const salesData = <?php echo $sales_data_json; ?>;

    // Render grafik dengan Chart.js
    const ctx = document.getElementById('salesChart').getContext('2d');
    const salesChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: salesData.labels, // Pelanggan
            datasets: [{
                label: 'Total Penjualan',
                data: salesData.sales, // Total Penjualan
                borderColor: 'rgba(75, 192, 192, 1)',
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderWidth: 2,
                tension: 0.4 // Menambahkan kelengkungan untuk gelombang
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                }
            },
            scales: {
                x: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Produk'
                    }
                },
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Total Penjualan'
                    }
                }
            }
        }
    });
</script>

</body>
</html>
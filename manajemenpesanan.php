<?php
session_start();
include 'koneksi.php'; // Sambungkan ke database
// Pastikan tidak ada output di atas kode ini
if (!isset($_SESSION['user_name'])) {
    header("Location: index.php?redirect=manajemenpesanan.php");
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
    <link rel="stylesheet" href="mpesanan.css">

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
                    <a href="" class="active"><span class="las la-clipboard-list"></span>
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
                <label for="nav-toggle">
                    <span class="las la-bars"></span>
                </label>
    
               Manajemen Pemesanan
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
    <title>Data Pemesanan</title>
    <link rel="stylesheet" href="mpesanan.css">
    <style>
        .detail-button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
        }
        .overlay {
            display: none; 
            position: fixed;
            top: 0;
            left: 0;
            width:100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            z-index: 1000;
            justify-content: center; 
            align-items: center; /
        }

        .overlay-content {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            width: 80%;
            max-width: 600px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .table-scroll {
            max-height: 400px; /* Atur tinggi maksimum sesuai kebutuhan */
            overflow-y: auto; /* Tambahkan scrollbar vertikal */
            overflow-x: hidden; /* Sembunyikan scrollbar horizontal */
        }

        table {
            width: 100%; /* Pastikan tabel mengisi lebar container */
            border-collapse: collapse; /* Menghilangkan jarak antara sel */
        }

        th, td {
            padding: 8px; /* Tambahkan padding untuk sel */
            border: 1px solid #ddd; /* Tambahkan border untuk sel */
            text-align: left; /* Rata kiri untuk teks */
        }

        .date-header {
            margin: 20px 0 10px; /* Tambahkan margin untuk header tanggal */
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Data Pemesanan</h1>
        <div class="table-wrapper">
            <div class="table-scroll">
                <table>
                    <tbody>
                        <?php
                        function formatRupiah($angka) {
                            return 'Rp. ' . number_format($angka, 0, ',', '.');
                        }

                        // Koneksi ke database
                        $conn = new mysqli("localhost", "root", "", "trisasmg_id");

                        // Mengecek koneksi
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }

                        // Kueri untuk mengambil data pemesanan terbaru
                        $sql = "SELECT * FROM pemesan ORDER BY tgl_pesan DESC";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            $current_date = '';
                            $no = 1; 
                            while($row = $result->fetch_assoc()) {
                                // Ambil tanggal dari kolom tgl_pesan
                                $tgl_pesan = date('Y-m-d', strtotime($row['tgl_pesan']));
                                
                                // Jika tanggal berubah, tampilkan header tanggal baru
                                if ($current_date != $tgl_pesan) {
                                    if ($current_date != '') {
                                        echo "</tbody></table>"; // Tutup tabel sebelumnya
                                    }
                                    $current_date = $tgl_pesan; // Update tanggal saat ini
                                    echo "<h3 class='date-header'>Tanggal: " . date('d-m-Y', strtotime($current_date)) . "</h3>";
                                    echo "<table><thead>
                                            <tr>
                                                <th>Nomor</th>
                                                <th>Nama Pemesan</th>
                                                <th>No Telepon</th>
                                                <th>Metode Bayar</th>
                                                <th>Detail</th>
                                            </tr>
                                        </thead>
                                        <tbody>";
                                    $no = 1; // Reset nomor urut untuk setiap tanggal baru
                                }
                                // Format nomor pesanan
                                $nomor_pesanan = 'P' . str_pad($no, 3, '0', STR_PAD_LEFT); // Format nomor pesanan
                                // Tampilkan data pemesanan
                                echo "<tr>
                                        <td>{$nomor_pesanan}</td>
                                        <td>{$row['nama_pemesan']}</td>
                                        <td>{$row['no_telp']}</td>
                                        <td>{$row['metode_bayar']}</td>
                                        <td><button class='detail-button' onclick='showDetail({$row['id']})'>Detail</button></td>
                                    </tr>";
                                $no++;
                            }
                            echo "</tbody></table>"; // Tutup tabel terakhir
                        } else {
                            echo "<tr><td colspan='5'>Tidak ada data pemesanan.</td></tr>";
                        }

                        // Tutup koneksi
                        $conn->close();
                        ?>
                    </tbody>
                </table>
            </div>
            </div>
        </div>
    </div>

    <div class="overlay" id="overlay" onclick="hideDetail()">
        <div class="overlay-content" id="overlay-content" onclick="event.stopPropagation();">
            <!-- Detail pemesanan akan ditampilkan di sini -->
        </div>
    </div>

    <script>
        function showDetail(id) {
            const overlay = document.getElementById('overlay');
            const overlayContent = document.getElementById('overlay-content');

            // Mengambil data detail pesanan menggunakan AJAX
            fetch(`get_detail.php?id=${id}`)
                .then(response => response.text())
                .then(data => {
                    overlayContent.innerHTML = data; // Menampilkan data di overlay
                    overlay.style.display = 'flex'; // Menampilkan overlay
                })
                .catch(error => console.error('Error:', error));
        }

        function hideDetail() {
            const overlay = document.getElementById('overlay');
            overlay.style.display = 'none'; // Menyembunyikan overlay
        }
    </script>
</body>
</html>
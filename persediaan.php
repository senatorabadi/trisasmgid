
<?php
session_start();
include 'koneksi.php'; // Sambungkan ke database
// Pastikan tidak ada output di atas kode ini
if (!isset($_SESSION['user_name'])) {
    header("Location: index.php?redirect=persediaan.php");
    exit(); // Menambahkan exit untuk menghentikan eksekusi setelah pengalihan
}

$_SESSION['last_activity'] = time(); // Perbarui waktu aktivitas terakhir

// Membuat koneksi ke database
$conn = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Mengambil data dari tabel products
$sql = "SELECT * FROM products";
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
    <link rel="stylesheet" href="persediaan.css">

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
                    <a href="persediaan.php" class="active"><span class="las la-receipt"></span>
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
    
                Persediaan
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
    <link rel="stylesheet" href="persediaan.css">
    <title>Daftar Produk</title>
    <script src="https://unpkg.com/feather-icons"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        /* CSS untuk overlay dan form */
        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            justify-content: center;
            align-items: center;
            z-index: 10;
        }
        .form-container {
            background: white;
            padding: 20px;
            border-radius: 5px;
            width: 400px;
        }
        .form-container input {
            width: 100%;
            margin: 10px 0;
        }
        .form-container button {
            margin: 5px;
        }
        .table-container {
            max-height: 450px; /* Atur tinggi maksimum sesuai kebutuhan */
            overflow-y: auto;  /* Tambahkan scroll vertikal */
            border: 1px solid #ccc; /* Tambahkan border jika diinginkan */
            margin-top: 20px; /* Jarak atas untuk estetika */
            padding:0;
            box-sizing: border-box;
        }

        table {
            width: 100%; /* Pastikan tabel mengambil lebar penuh kontainer */
            border-collapse: collapse; /* Menghilangkan jarak antara sel */
        }

        th, td {
            padding: 12px; /* Padding untuk sel */
            text-align: left; /* Rata kiri untuk teks */
            border-bottom: 1px solid #ddd; /* Garis bawah untuk sel */
        }

        .product-image {
            width: 50px; /* Atur lebar gambar */
            height: auto; /* Menjaga rasio aspek gambar */
            max-width: 100%; /* Pastikan gambar tidak melampaui lebar sel */
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
            <h1>Daftar Produk</h1>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>Nama</th>
                            <th>Harga</th>
                            <th>Gambar</th>
                            <th>Deskripsi</th>
                            <th>Stok</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1; // Inisialisasi variabel nomor urut
                        foreach ($result as $row): ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $row["name"]; ?></td>
                            <td><?php echo $row["price"]; ?></td>
                            <td><img src="<?php echo $row["image"]; ?>" alt="<?php echo $row["name"]; ?>" width="50"></td>
                            <td><?php echo $row["description"]; ?></td>
                            <td><?php echo $row["stock"]; ?></td>
                            <td>
                                <button class='editBtn'  data-id='<?php echo $row["id"]; ?>'>
                                    <i data-feather="edit"></i> 
                                </button>
                                <button class='deleteBtn' data-id='<?php echo $row["id"]; ?>'>
                                    <i data-feather="trash-2"></i> 
                                </button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <button id="addProductBtn" class="saveBtn">TAMBAHKAN PRODUCT</button>
        </div>

        <!-- Overlay untuk Edit dan Tambah Produk -->
        <div class="overlay" id="overlay">
            <div class="form-container">
                <h2 id="formTitle">Tambah Produk</h2>
                <input type="hidden" id="productId">
                <label for="name">NAMA:</label>
                <input type="text" id="name" required>
                <label for="price">HARGA:</label>
                <input type="number" id="price" required>
                <label for="image">GAMBAR:</label>
                <input type="text" id="image" required>
                <label for="description">DESKRIPSI:</label>
                <input type="text" id="description" required>
                <label for="stock">STOCK:</label>
                <input type="number" id="stock" required>
                <button id="saveBtn" class="saveBtn">Simpan</button>
                <button id="cancelBtn" class="cancelBtn">Kembali</button>
            </div>
        </div>

        <script>
            const overlay = document.getElementById('overlay');
            const formTitle = document.getElementById('formTitle');
            const productId = document.getElementById('productId');
            const nameInput = document.getElementById('name');
            const priceInput = document.getElementById('price');
            const imageInput = document.getElementById('image');
            const descriptionInput = document.getElementById('description');
            const stockInput = document.getElementById('stock');
            const saveBtn = document.getElementById('saveBtn');
            const cancelBtn = document.getElementById('cancelBtn');

            document.getElementById('addProductBtn').addEventListener('click', () => {
                overlay.style.display = 'flex';
                formTitle.innerText = 'Tambah Produk';
                productId.value = '';
                nameInput.value = '';
                priceInput.value = '';
                imageInput.value = '';
                descriptionInput.value = '';
                stockInput.value = '';
            });

            document.querySelectorAll('.editBtn').forEach(button => {
                button.addEventListener('click', () => {
                    const id = button.getAttribute('data-id');
                    fetch(`get_product.php?id=${id}`)
                        .then(response => response.json())
                        .then(data => {
                            overlay.style.display = 'flex';
                            formTitle.innerText = 'Edit Produk';
                            productId.value = data.id;
                            nameInput.value = data.name;
                            priceInput.value = data.price;
                            imageInput.value = data.image;
                            descriptionInput.value = data.description;
                            stockInput.value = data.stock;
                        });
                });
            });

            document.querySelectorAll('.deleteBtn').forEach(button => {
                button.addEventListener('click', () => {
                    const id = button.getAttribute('data-id');
                    if (confirm('Apakah anda yakin ingin menghapus produk ini?')) {
                        fetch(`delete_product.php?id=${id}`, { method: 'DELETE' })
                            .then(response => response.text())
                            .then(data => {
                                alert(data);
                                location.reload();
                            });
                    }
                });
            });

            saveBtn.addEventListener('click', () => {
                const id = productId.value;
                const method = id ? 'PUT' : 'POST';
                const url = id ? `update_product.php?id=${id}` : 'add_product.php';
                const data = {
                    name: nameInput.value,
                    price: priceInput.value,
                    image: imageInput.value,
                    description: descriptionInput.value,
                    stock: stockInput.value
                };

                if (confirm(`Apakah anda yakin ingin menyimpan ${id ? 'perubahan' : 'produk baru'} ini?`)) {
                    fetch(url, {
                        method: method,
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify(data)
                    })
                    .then(response => response.text())
                    .then(data => {
                        alert(data);
                        overlay.style.display = 'none';
                        location.reload();
                    });
                }
            });

            cancelBtn.addEventListener('click', () => {
                overlay.style.display = 'none';
            });
        </script>
    </div>
    <script>
      feather.replace();
    </script>
</body>
</html>

<?php
$conn->close(); // Menutup koneksi
?>


<?php
header('Content-Type: text/html; charset=utf-8');

include 'koneksi.php';

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Mengambil ID dari parameter URL
$id = intval($_GET['id']);

// Kueri untuk mengambil data pemesanan
$sql = "SELECT p.*, od.nama_produk, od.jumlah, od.harga, od.total_harga 
        FROM pemesan p 
        LEFT JOIN order_detail od ON p.id = od.pemesan_id 
        WHERE p.id = $id";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $data = [];
    $total_jumlah = 0;
    $total_harga = 0;

    while ($row = $result->fetch_assoc()) {
        $data['nomor'] = 'P' . str_pad($row['id'], 3, '0', STR_PAD_LEFT);
        $data['nama_pemesan'] = $row['nama_pemesan'];
        $data['no_telp'] = $row['no_telp'];
        $data['tgl_pesan'] = date('d-m-Y', strtotime($row['tgl_pesan']));
        $data['tgl_ambil'] = date('d-m-Y', strtotime($row['tgl_ambil']));
        $data['metode_bayar'] = $row['metode_bayar'];
        $data['bukti_bayar'] = $row['bukti_bayar'];

        // Mengumpulkan detail pesanan
        $data['order_details'][] = [
            'nama_produk' => $row['nama_produk'],
            'jumlah' => $row['jumlah'],
            'harga' => $row['harga']
        ];

        // Menghitung total jumlah dan total harga
        $total_jumlah += $row['jumlah'];
        $total_harga += $row['total_harga'];
    }

    $data['total_jumlah'] = $total_jumlah;
    $data['total_harga'] = $total_harga;
} else {
    echo "Data tidak ditemukan";
    exit;
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
<style>
body {
  font-family: sans-serif;
}

td:nth-child(1) {
  width: 50%; 
}
td:nth-child(2) {
  width: 15%; 
}

td:nth-child(3) {
  width: 25%; 
}

.header {
  text-align: center;
  margin-bottom: 20px;
}

.header h1 {
  font-size: 2.5em;
}

.section {
  display: flex;
  justify-content: space-between;
  margin-bottom: 20px;
}

.section-left {
  width: 50%;
}

.section-right {
  width: 40%;
}

.info-row {
  display: flex; /* Menggunakan flexbox */
  align-items: center; /* Menyelaraskan item secara vertikal */
  margin-bottom: 0; /* Mengurangi jarak antar baris */
}

.info-row label {
  margin-right: 10px; /* Jarak antara label dan paragraf */
}

.section-right img {
  width: 100%;
  height: auto;
}


.table {
  border-collapse: collapse;
  width: 100%;
  margin-top: 20px;
}

.table th, .table td {
  text-align: left;
  padding: 8px;
}

.table tr:nth-child(even) {
  background-color: #f2f2f2;
}

.table th {
  background-color: #4CAF50;
  color: white;
}



</style>
</head>
<body>
<!-- 
<div class="container"> -->
  <div class="header">
    <h1>Detail Pesanan</ h1>
  </div>

  <div class="section">
    <div class="section-left">
      <div class="info-row">
        <label>Nomor:</label>
        <p><?php echo $data['nomor']; ?></p>
      </div>

      <div class="info-row">
        <label>Nama Pesanan:</label>
        <p><?php echo $data['nama_pemesan']; ?></p>
      </div>

      <div class="info-row">
        <label>No Telepon:</label>
        <p><?php echo $data['no_telp']; ?></p>
      </div>

      <div class="info-row">
        <label>Tanggal Pesan:</label>
        <p><?php echo $data['tgl_pesan']; ?></p>
      </div>

      <div class="info-row">
        <label>Tanggal Ambil:</label>
        <p><?php echo $data['tgl_ambil']; ?></p>
      </div>

      <div class="info-row">
        <label>Metode Bayar:</label>
        <p><?php echo $data['metode_bayar']; ?></p>
      </div>
    </div>

    <div class="section-right">
      <h2>Bukti Bayar</h2>
      <!-- <p><strong>Gambar:</strong></p> -->
      <img class="bukti-bayar" src="<?php echo $data['bukti_bayar']; ?>" alt="Gambar Bukti Bayar">
    </div>
  </div>

  <div class="details">
    <h2>Detail Penjualan</h2>
    <table class="table">
      <tr>
        <th>Nama Produk</th>
        <th>Jumlah</th>
        <th>Harga</th>
      </tr>
      <?php foreach ($data['order_details'] as $detail): ?>
      <tr>
        <td><?php echo $detail['nama_produk']; ?></td>
        <td><?php echo $detail['jumlah']; ?></td>
        <td><?php echo number_format($detail['harga'], 2, ',', '.'); ?></td>
      </tr>
      <?php endforeach; ?>
      <tr>
        <td><strong>Total</strong></td>
        <td><strong><?php echo $data['total_jumlah']; ?></strong></td>
        <td><strong><?php echo number_format($data['total_harga'], 2, ',', '.'); ?></strong></td>
      </tr>
    </table>
  </div>
</div>

</body>
</html>
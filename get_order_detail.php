<?php
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
        $data['metode_bayar'] = $ row['metode_bayar'];
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

    echo json_encode($data);
} else {
    echo json_encode(['error' => 'Data tidak ditemukan']);
}

// Tutup koneksi
$conn->close();
?>
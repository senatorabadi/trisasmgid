

<?php
// Konfigurasi koneksi database
include 'koneksi.php';

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $nama_pemesan = $_POST['nama_pemesan'];
    $no_telp = $_POST['no_telp'];
    $alamat = $_POST['alamat'];
    $tgl_pesan = $_POST['tgl_pesan'];
    $tgl_ambil = $_POST['tgl_ambil'];
    $metode_bayar = $_POST['metode_bayar'];
    $bukti_bayar = $_FILES['bukti_bayar']['name']; // Assuming you have uploaded a file
    $cart = json_decode($_POST['cart'], true); // Decode the cart JSON data

    // Upload the payment receipt
    $upload_dir = 'uploads/';
    $upload_file = $upload_dir . basename($bukti_bayar);
    move_uploaded_file($_FILES['bukti_bayar']['tmp_name'], $upload_file);

    // Start a transaction to ensure data consistency
    $conn->begin_transaction();

    try {
        // Insert into pemesan table
        $stmt = $conn->prepare("INSERT INTO pemesan (nama_pemesan, no_telp, alamat, tgl_pesan, tgl_ambil, metode_bayar, bukti_bayar) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssss", $nama_pemesan, $no_telp, $alamat, $tgl_pesan, $tgl_ambil, $metode_bayar, $upload_file);
        if ($stmt->execute()) {
            // Get the last inserted pemesan ID
            $pemesan_id = $conn->insert_id;

            // Insert each item from the cart into the order_detail table
            foreach ($cart as $item) {
                $nama_produk = $item['name'];
                $jumlah = $item['quantity'];
                $harga = $item['price'];
                $total_harga = $jumlah * $harga;

                $stmt_order_detail = $conn->prepare("INSERT INTO order_detail (pemesan_id, nama_produk, jumlah, harga, total_harga) VALUES (?, ?, ?, ?, ?)");
                $stmt_order_detail->bind_param("isidd", $pemesan_id, $nama_produk, $jumlah, $harga, $total_harga);
                if (!$stmt_order_detail->execute()) {
                    throw new Exception("Error inserting order detail: " . $stmt_order_detail->error);
                }
            }

            // Mengurangi stok produk
            foreach ($cart as $item) {
                $productId = $item['id'];
                $quantity = $item['quantity'];

                // Update stok produk di database
                $updateStockSql = "UPDATE products SET stock = stock - ? WHERE id = ?";
                $stmt_update_stock = $conn->prepare($updateStockSql);
                $stmt_update_stock->bind_param("ii", $quantity, $productId);
                if (!$stmt_update_stock->execute()) {
                    throw new Exception("Error updating stock: " . $stmt_update_stock->error);
                }
            }

            // Commit the transaction
            $conn->commit();
            echo "<script>
            window.onload = function() {
            alert('Terima Kasih Sudah Memesan di TRISASMG.ID!'); // Menampilkan pesan
            window.location.href = 'projek.php'; // Kembali ke beranda
            }
            </script>";
        } else {
            throw new Exception("Error inserting pemesan: " . $stmt->error);
        }
    } catch (Exception $e) {
        // Rollback the transaction if any error occurs
        $conn->rollback();
        echo "Error: " . $e->getMessage();
    } finally {
        // Close the prepared statements $stmt->close();
        $stmt_order_detail->close();
        $stmt_update_stock->close();
    }
}

// Close the connection
$conn->close();
?>


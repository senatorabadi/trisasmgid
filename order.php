


<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <META HTTP-EQUIV="X-UA-COMPATIBLE" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Pemesanan TRISASMG.ID</title>
    <link rel="stylesheet" href="css/order.css" />
</head>
<body>
    <section class="container">
        <header>Form Pemesanan</header>
        <form action="bismillah.php" method="POST" enctype="multipart/form-data" class="form" onsubmit="return showThankYou(event);">
            
            <!-- Input fields for customer details -->
            <div class="input-box">
                <label>Nama Lengkap</label>
                <input type="text" placeholder="Masukan nama Anda" name="nama_pemesan" required />
            </div>
            <div class="input-box">
                <label>Nomor Telepon</label>
                <input type="text" placeholder="Masukan nomor telepon" name="no_telp" required />
            </div>
            <div class="input-box">
                <label>Alamat</label>
                <input type="text" placeholder="Masukan alamat" name="alamat" required />
            </div>
            <div class="column">
                <div class="input-box">
                    <label>Tanggal Pemesanan</label>
                    <input type="date" name="tgl_pesan" required />
                </div>
                <div class="input-box">
                    <label>Tanggal Pesanan Diambil</label>
                    <input type="date" name="tgl_ambil" required />
                </div>
            </div>

            <!-- Tabel untuk menampilkan detail pesanan -->
            <table id="order-details" border="1">
                <thead>
                    <tr>
                        <th>Nama Produk</th>
                        <th>Jumlah</th>
                        <th>Harga Satuan</th>
                        <th>Total Harga</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Data pesanan akan dimasukkan di sini dengan JavaScript -->
                </tbody>
            </table>

            <div class="input-box">
                <label for="jumlah-pesan">Jumlah Pesan:</label>
                <input type="number" id="jumlah-pesan" name="jumlah-pesan" required readonly>
            </div>

            <div class="input-box">
                <label for="total-harga">Total Harga:</label>
                <input type="text" id="total-harga" name="total-harga" required readonly>
            </div>

            <div class="pembayaran">
                <label>Metode Pembayaran</label>
                <select class="metode_bayar" name="metode_bayar">
                    <option value="shopeepay">Shopeepay (088232719800)</option>
                    <option value="dana">Dana (085878845950)</option>
                    <option value="BCA">BCA (8165289460)</option>
                </select>
            </div>

            <div class="buktibayar">
                <label>Bukti Pembayaran</label>
                <input type="file" name="bukti_bayar" placeholder="Upload bukti pembayaran" required>
            </div>

            <input type="hidden" name="cart" id="cart" value="">

            <input type="submit" name="proses" class="button">
        </form>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Membaca data dari localStorage
            const pesanan = localStorage.getItem('pesanan');
            const totalItems = localStorage.getItem('totalItems');
            const total = localStorage.getItem('total');
            const cart = JSON.parse(localStorage.getItem('cart')); // Mendapatkan cart dalam bentuk objek

            // Menampilkan data di form
            if (totalItems) {
                document.getElementById('jumlah-pesan').value = totalItems;
            }
            if (total) {
                document.getElementById('total-harga').value = total;
            }
            if (cart) {
                // Menyimpan cart ke input tersembunyi
                document.getElementById('cart').value = JSON.stringify(cart);

                // Menampilkan detail pesanan di tabel
                const orderDetailsTable = document.getElementById('order-details').getElementsByTagName('tbody')[0];
                cart.forEach(item => {
                    const row = orderDetailsTable.insertRow();
                    row.insertCell(0).innerText = item.name;
                    row.insertCell(1).innerText = item.quantity;
                    row.insertCell(2).innerText = item.price.toFixed(2);  // Menampilkan harga dengan 2 desimal
                    row.insertCell(3).innerText = (item.price * item.quantity).toFixed(2);  // Total harga
                });
            }

            // Menghapus data dari localStorage setelah dibaca
            localStorage.removeItem('pesanan');
            localStorage.removeItem('totalItems');
            localStorage.removeItem('total');
            localStorage.removeItem('cart'); // Menghapus cart dari localStorage
        });
    </script>
</body>
</html>

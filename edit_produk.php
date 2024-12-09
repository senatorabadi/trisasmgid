<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Produk</title>
    <!-- <link rel="stylesheet" href="styles.css"> -->
     <style>
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 20px;
}

.container {
    max-width: 600px;
    margin: auto;
    background: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h1 {
    text-align: center;
    color: #333;
}

form {
    display: flex;
    flex-direction: column;
}

label {
    margin: 10px 0 5px;
    font-weight: bold;
}

select,
input[type="number"],
input[type="text"],
textarea {
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 5px;
    font-size: 16px;
    transition: border-color 0.3s;
}

select:focus,
input[type="number"]:focus,
input[type="text"]:focus,
textarea:focus {
    border-color: #4CAF50; /* Warna hijau saat fokus */
    outline: none;
}

textarea {
    resize: vertical; /* Hanya dapat mengubah ukuran vertikal */
}

button {
    margin-top: 15px;
    padding: 10px;
    background-color: #3498db; /* Warna biru */
    color: white;
    border: none;
    border-radius: 5px;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s;
}

button:hover {
    background-color: #2980b9; /* Warna biru lebih gelap saat hover */
}

#product-details {
    margin-top: 20px;
    display: none; /* Awalnya disembunyikan */
}

.container {
    background: #fff;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h1 {
    margin-bottom: 20px;
}

label {
    display: block;
    margin: 10px 0 5px;
}

input[type="text"],
input[type="number"],
textarea,
select {
    width: 90%;
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

button {
    background-color: #28a745;
    color: white;
    padding: 10px 15px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

button:hover {
    background-color: #218838;
}
     </style>
<body>
    <div class="container">
        <h1>Edit Produk</h1>
        <form action="proses_edit.php" method="POST">
            <label for="product_select">Pilih Produk:</label>
            <select id="product_select" name="id_produk" required>
                <option value="">-- Pilih Produk --</option>
                <?php
                include 'koneksi.php';

                // Create connection
                $conn = new mysqli($servername, $username, $password, $dbname);

                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Query untuk mengambil daftar produk dari tabel products
                $sql = "SELECT id, name FROM products";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row["id"] . "'>" . $row["name"] . "</option>";
                    }
                } else {
                    echo "<option value=''>Tidak ada produk ditemukan</option>";
                }

                $conn->close();
                ?>
            </select>
            
            <div id="product-details" style="display:none;">
                <label for="name">Nama:</label>
                <input type="text" id="name" name="name" required>
                
                <label for="price">Harga:</label>
                <input type="number" id="price" name="price" step="0.01" required>
                
                <label for="image">Gambar (URL):</label>
                <input type="text" id="image" name="image" required>
                
                <label for="description">Deskripsi:</label>
                <textarea id="description" name="description" rows="4" required></textarea>
                
                <label for="stock">Stok:</label>
                <input type="number" id="stock" name="stock" required>
                
                <button type="submit">Simpan Perubahan</button>
            </div>
        </form>
    </div>

    <script>
        document.getElementById('product_select').addEventListener('change', function() {
            const id = this.value;
            if (id) {
                // Ganti URL dengan endpoint yang sesuai untuk mengambil data produk
                fetch(`get_edit_product.php?id=${id}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data) {
                            document.getElementById('name').value = data.name;
                            document.getElementById('price').value = data.price;
                            document.getElementById('image').value = data.image;
                            document.getElementById('description').value = data.description;
                            document.getElementById('stock').value = data.stock;
                            document.getElementById('product-details').style.display = 'block';
                        } else {
                            alert('Produk tidak ditemukan');
                        }
                    })
                    .catch(error => console.error('Error:', error));
            } else {
                // Reset form jika tidak ada produk yang dipilih
                document.getElementById('product-details').style.display = 'none';
                document.getElementById('name').value = '';
                document.getElementById('price').value = '';
                document.getElementById('image').value = '';
                document.getElementById('description').value = '';
                document.getElementById('stock').value = '';
            }
        });
    </script>
</body>
</html>
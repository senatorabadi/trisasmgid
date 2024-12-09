

let cart = []; 

// Fungsi untuk menampilkan produk
function displayProducts() {
    const productContainer = document.getElementById('product-container');
    productContainer.innerHTML = ''; 

    // Mengambil data produk dari server
    fetch('get_products.php')
        .then(response => response.json())
        .then(products => {
            products.forEach(product => {
                // Cek apakah stok lebih dari 0
                if (product.stock > 0) {
                    const productCard = `
                        <div class="product-card">
                            <img src="${product.image}" alt="${product.name}" class="product-image">
                            <div class="product-info">
                                <h3 class="product-name">${product.name}</h3>
                                <p class="product-description">${product.description}.</p>
                                <p class="product-price">IDR ${parseFloat(product.price).toLocaleString()}</p>
                                <button class="buy-button" onclick="addToCart(${product.id}, '${product.name}', ${product.price})">Beli Sekarang</button>
                            </div>
                        </div>
                    `;
                    productContainer.innerHTML += productCard; 
                }
            });
        })
        .catch(error => console.error('Error fetching products:', error));
}

// Panggil fungsi untuk menampilkan produk saat halaman dimuat
window.onload = displayProducts;

// Fungsi addToCart
function addToCart(id, name, price) {
    // Cek apakah produk sudah ada di keranjang
    const existingItem = cart.find(item => item.id === id);
    if (existingItem) {
        existingItem.quantity += 1;
    } else {
        cart.push({ id, name, price, quantity: 1 }); 
    }
    updateCartDisplay(); 
    toggleCart(); 
}

// Fungsi untuk memperbarui tampilan keranjang
function updateCartDisplay() {
    const cartItemsContainer = document.querySelector('.cart-items');
    cartItemsContainer.innerHTML = ''; // Kosongkan tampilan keranjang

    let total = 0;
    let totalItems = 0; 

    cart.forEach(item => {
        const cartItem = `
            <div class="cart-item">
                <span>${item.name}</span>
                <span>${item.quantity}</span>
                <span>IDR ${parseFloat(item.price * item.quantity).toLocaleString()}</span>
                <div class="item-controls">
                    <button onclick="removeFromCart(${item.id})">delete</button>
                </div>
            </div>
        `;
        cartItemsContainer.innerHTML += cartItem; 
        total += item.price * item.quantity; 
        totalItems += item.quantity;
    });

    // Tampilkan total
    const totalContainer = document.querySelector('.total');
    totalContainer.innerHTML = `TOTAL: IDR ${total.toLocaleString()}`;

    // Perbarui jumlah item di ikon keranjang
    const cartCountElement = document.getElementById('cart-count');
    cartCountElement.innerHTML = totalItems;
}

// Fungsi untuk menghapus item dari keranjang
function removeFromCart(id) {
    cart = cart.filter(item => item.id !== id); 
    updateCartDisplay();
}

// Fungsi untuk menampilkan atau menyembunyikan keranjang
function toggleCart() {
    const cartElement = document.getElementById('shopping-cart');
}

// Fungsi untuk menutup keranjang saat tombol Close diklik
function closeCart() {
    const cartElement = document.getElementById('shopping-cart');
    cartElement.classList.remove('active'); 
}

// Tambahkan event listener untuk tombol Close
document.querySelector('.close-cart').addEventListener('click', closeCart);


// Fungsi untuk checkout
function checkout() {
    const pesanan = cart.map(item => `${item.name} (x${item.quantity})`).join(', ');
    const totalItems = cart.reduce((total, item) => total + item.quantity, 0);
    const total = cart.reduce((total, item) => total + (item.price * item.quantity), 0);

    // Menyimpan data ke localStorage
    localStorage.setItem('pesanan', pesanan);
    localStorage.setItem('totalItems', totalItems);
    localStorage.setItem('total', total);
    localStorage.setItem('cart', JSON.stringify(cart)); // Menyimpan cart sebagai JSON

    // Kosongkan keranjang belanja
    cart = []; 
    updateCartDisplay(); 

    // Mengalihkan ke halaman order.php
    window.location.href = 'order.php';
}
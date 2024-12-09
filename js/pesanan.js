document.addEventListener('DOMContentLoaded', () => {
    const cart = JSON.parse(localStorage.getItem('cart')) || [];
    const totalItems = cart.reduce((acc, item) => acc + item.quantity, 0);
    const totalPrice = cart.reduce((acc, item) => acc + (item.price * item.quantity), 0);

    document.getElementById('quantity').value = totalItems;
    document.getElementById('totalPrice').value = `IDR ${totalPrice.toLocaleString()}`;

    const productSelect = document.getElementById('product');
    cart.forEach(item => {
        const option = document.createElement('option');
        option.value = item.name;
        option.textContent = item.name;
        productSelect.appendChild(option);
    });
});

function showCalendar(inputId) {
    // Implement calendar functionality here
}
document.getElementById('reviewForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Mencegah pengiriman form default

    const formData = new FormData(this);

    fetch('submit_review.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        const notification = document.getElementById('notification');
        if (data.success) {
            notification.textContent = data.message;
            notification.style.display = 'block';
            setTimeout(() => {
                notification.style.display = 'none'; 
            }, 3000);
            document.getElementById('reviewForm').reset(); // Kosongkan form
            
            // Panggil fetchReviews untuk memperbarui tampilan review
            fetchReviews();
        } else {
            alert(data.message); // Tampilkan pesan error jika ada
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
});






        // Mengambil data review dari file PHP
        function fetchReviews() {
            fetch('get_reviews.php')
                .then(response => response.text())
                .then(data => {
                    document.getElementById('reviews-container').innerHTML = data;
                })
                .catch(error => {
                    console.error('Error fetching reviews:', error);
                });
        }
        
        // Panggil fungsi fetchReviews untuk pertama kali
        fetchReviews();
        
        // Set interval untuk memanggil fetchReviews setiap 5 detik (5000 ms)
        setInterval(fetchReviews, 1000);
<?php
include 'koneksi.php';

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT name, rating, comment FROM reviews ORDER BY created_at DESC";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo '<div class="review-container">';
        echo '<div class="review-header">';
        echo '<h3>' . htmlspecialchars($row['name']) . '</h3>';
        echo '<div class="star">';
        for ($i = 0; $i < $row['rating']; $i++) {
            echo '<i class="fas fa-star"></i>';
        }
        echo '</div>';
        echo '</div>'; // end of review-header
        echo '<p>' . htmlspecialchars($row['comment']) . '</p>';
        echo '<div class="like-dislike">';
        echo '<span class="like-count">0</span> <button class="like-btn"><i class="fas fa-thumbs-up"></i></button>';
        echo '<span class="dislike-count">0</span> <button class="dislike-btn"><i class="fas fa-thumbs-down"></i></button>';
        echo '</div>';
        echo '</div>'; // end of review-container
    }
} else {
    echo "Tidak ada review yang tersedia.";
}


$conn->close();
?>
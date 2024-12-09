<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="x-ua -compatible" content="ie=edge" />
  <meta name="viewport " content="width=device-width, initial-scale=1.0" />
  <title>TRISASMG.ID</title>

  <!--font-->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Poppins:ital:arial,wght@0,100;0,300;0,400;0,700;1,700&display=swap"
    rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
    integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

  <!--icon-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />

  <!--css-->
  <link rel="stylesheet" href="css/project.css" />
  <link rel="stylesheet" href="css/Review.css" />
  </head>


<body>
  <!--navbar awal-->
  <nav class="navbar">
    <a href="#" class="navbar-logo">TRISASMG<span>.ID</span></a>

    <div class="navbar-nav">
      <a href="#home">Home</a>
      <a href="#about">About</a>
      <a href="#menu">Menu</a>
      <a href="#review">Review</a>
      <a href="#kontak">Contact</a>
      <a href="#FAQ">FAQ</a>
    </div>

    <div class="navbar-extra">      
        <a href="#" id="shopping-cart-button">
        <i class="fas fa-shopping-cart"></i>
        <span id="cart-count" class="cart-count">0</span>
    </a>
    <a href="logout.php" id="logout-button">
        <i class="fas fa-sign-out-alt"></i>
    </a>
    <a href="#" id="hamburger-menu">
        <i class="fas fa-bars"></i>
    </a>
    </nav>

    <div class="shopping-cart" id="shopping-cart">
        <div class="cart-items"></div>
        <div class="total"></div>
        <div class="cart-actions">
            <button class="checkout-button" onclick="checkout()">Checkout</button>
            <button class="close-cart" onclick="toggleCart()">Close</button>
        </div>
    </div>
<!-- Shopping Cart End -->
  </nav>
  <!--navbar akhir-->

  <!--home section awal-->
  <br>
  <section class="home" id="home">
    <main class="content">
      <h1>Bosan dengan menu yang itu-itu saja? coba sensasi makanan pedas di <span>trisasmg.id!</span></h1>
      <!-- <a href="#" class="cta">ORDER NOW</a> -->
    </main>
  </section>
  <br>
  <!--home section akhir-->

  <!--about section awal-->
  <sectin id="about" class="about">
      <h2>Tentang Kami</h2>
    </div>

    <div class="container">
      <div class="content">
        <!--<h2></h2>-->
        <p>Trisasmg.id adalah rumah bagi para pecinta pedas. Kami menyajikan berbagai macam menu mercon buatan tangan
          dengan resep rahasia yang dijamin bikin ketagihan. Dari ceker mercon yang gurih, bakso mercon yang kenyal,
          hingga sayap mercon yang renyah, setiap gigitannya adalah hasil dari pemilihan bahan-bahan berkualitas dan
          proses pembuatan yang penuh kasih sayang. Cocok dinikmati bersama nasi cokot yang hangat dan segarkan
          tenggorokan dengan es lumut jelly susu dengan bermacam varian. Rasakan sensasi yang berbeda dan nikmati
          kelezatan makanan rumahan yang autentik.</p>
      </div>
      <div class="image">
        <img src="img/logo1.jpg">
      </div>
    </div>

  </sectin>
  <!--about section akhir-->


  <!--menu section awal-->
  <section class="menu" id="menu">
    <h2><span>Menu</span> Kami</h2>
    <div class="product-container" id="product-container">
        <!-- Produk akan diisi di sini oleh JavaScript -->
    </div>
</section>
<!-- Menu Section Akhir -->

<!-- REVIEW SECTION AWAL -->
 <!-- review section starts -->

 <section class="review" id="review">
  <h2>Review Produk Kami</h2>
  <div class="container">
    <div class="container-review">
        <div class="notification-review" id="notification"></div>
        <form id="reviewForm">
            <div class="star-rating">
                <input type="radio" id="star1" name="rating" value="5" required />
                <label for="star1" class="star"><i class="fas fa-star"></i></label>
                <input type="radio" id="star2" name="rating" value="4" />
                <label for="star2" class="star"><i class="fas fa-star"></i></label>
                <input type="radio" id="star3" name="rating" value="3" />
                <label for="star3" class="star"><i class="fas fa-star"></i></label>
                <input type="radio" id="star4" name="rating" value="2" />
                <label for="star4" class="star"><i class="fas fa-star"></i></label>
                <input type="radio" id="star5" name="rating" value="1" />
                <label for="star5" class="star"><i class="fas fa-star"></i></label>
            </div>
            <input type="text" name="name" placeholder="Nama Anda" required>
            <textarea name="comment" placeholder="Pendapat Anda" required></textarea>
            <button type="submit">Kirim Review</button>
        </form>
    </div>

  <!-- Bagian Hasil Review -->
    <div class="display">
      <!-- <h2>Hasil Review Produk</h2> -->
      <div id="reviews-container">
          <div class="review-item">
              <div class="review-header">
                  <span>Nama Pengguna</span>
                  <div class="star-rating">
                      <i class="fas fa-star"></i>
                      <i class="fas fa-star"></i>
                      <i class="fas fa-star"></i>
                      <i class="fas fa-star"></i>
                      <i class="fas fa-star"></i>
                  </div>
              </div>
          </div>

      </div>
  </div>
</div>
</section>
<!-- review section ends -->


<!--contact section awal-->
<section class="contact" id="kontak">
    <h2>Kontak Kami</h2>
    <div class="row">
      <form action="submit_kontak.php" method="POST" onsubmit="return validateForm()">
          <div class="medsos">
            <a href="https://www.instagram.com/trisasmg.id?igsh=MWRlemNqc2R4dXBwOA=="><i data-feather="instagram"></i>
              Instagram</a>
            <a href="https://wa.me/6285640400057"><i data-feather="message-circle"></i> WhatsApp</a>
          </div>
          <div class="input-group">
            <i data-feather="user"></i>
            <input type="text" name="nama" placeholder="Nama" required>
          </div>
          <div class="input-group">
            <i data-feather="phone"></i>
            <input type="text" name="no_hp" placeholder="No Hp" required>
          </div>
          <div class="input-group">
            <i data-feather="help-circle"></i>
            <input type="text" name="pertanyaan" placeholder="Pertanyaan" required>
          </div>
          <button class="btn" type="submit">Kirim</button>
        </form>
        <iframe src="https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d3959.2860860315177!2d110.41743807499805!3d-7.092799892910344!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zN8KwMDUnMzQuMSJTIDExMMKwMjUnMTIuMSJF!5e0!3m2!1sen!2sid!4v1730761492607!5m2!1sen!2sid"
          allowfullscreen="true" loading="lazy" referrerpolicy="no-referrer-when-downgrade" class="map"></iframe>
    </div>
    <script>
      document.getElementById('contactForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Mencegah pengiriman form default

    // Ambil nilai dari input
    const name = document.getElementById('name').value;
    const question = document.getElementById('question').value;

    // Buat URL WhatsApp
    const phoneNumber = '6285640400057'; // Nomor WhatsApp
    const message = Nama: ${name}%0Apertanyaan: ${question};
    const whatsappURL = https://wa.me/${phoneNumber}?text=${message};

    // Alihkan ke URL WhatsApp
    window.open(whatsappURL, '_blank');
});
    </script>
</section>
    <!--contact section akhir-->

    <!-- FAQ -->
    <section class="FAQ" id="FAQ">
      <h2>Frequenty Asked Questions</h2>

      <div class="content">

        <div class="question-answer">
          <div class="question">
            <h3 class="tittle-question">
              Jika customer ingin membeli secara COD, dapat bertemu di wilayah mana saja?
            </h3>
            <button class="question-btn">
              <span class="up-icon">
                <i class="fa-solid fa-chevron-up"></i>
              </span>
              <span class="down-icon">
                <i class="fa-solid fa-chevron-down"></i>
              </span>
            </button>
          </div>
          <div class="answer">
            <p>Kami menerima COD disekitar Banyumanik, Tembalang, dan Pudakpayung.</p>
          </div>
        </div>

        <div class="question-answer">
          <div class="question">
            <h3 class="tittle-question">
              Max H-berapa customer mengabari jika ingin memesan dalam jumlah yang banyak ?
            </h3>
            <button class="question-btn">
              <span class="up-icon">
                <i class="fa-solid fa-chevron-up"></i>
              </span>
              <span class="down-icon">
                <i class="fa-solid fa-chevron-down"></i>
              </span>
            </button>
          </div>
          <div class="answer">
            <p>Maximal H-1 hubungi kami untuk pemesanan dalam jumlah yang banyak.
            </p>
          </div>
        </div>

        <div class="question-answer">
          <div class="question">
            <h3 class="tittle-question">
              Berapa biaya ongkos kirim untuk pengantaran pesanan?
            </h3>
            <button class="question-btn">
              <span class="up-icon">
                <i class="fa-solid fa-chevron-up"></i>
              </span>
              <span class="down-icon">
                <i class="fa-solid fa-chevron-down"></i>
              </span>
            </button>
          </div>
          <div class="answer">
            <p>Jarak 10km kami beri tarif ongkos kirim Rp 10.000 dan berlaku kelipatan.
            </p>
          </div>
        </div>

        <div class="question-answer">
          <div class="question">
            <h3 class="tittle-question">
              Apakah tingkat kepedasannya sama semua?
            </h3>
            <button class="question-btn">
              <span class="up-icon">
                <i class="fa-solid fa-chevron-up"></i>
              </span>
              <span class="down-icon">
                <i class="fa-solid fa-chevron-down"></i>
              </span>
            </button>
          </div>
          <div class="answer">
            <p>Untuk tingkat kepedasan kami bagi menjadi 2 yaitu, pedas tingkat sedang dan sangat pedas.</p>
          </div>
        </div>

        <div class="question-answer">
          <div class="question">
            <h3 class="tittle-question">
              Ready hari apa saja?
            </h3>
            <button class="question-btn">
              <span class="up-icon">
                <i class="fa-solid fa-chevron-up"></i>
              </span>
              <span class="down-icon">
                <i class="fa-solid fa-chevron-down"></i>
              </span>
            </button>
          </div>
          <div class="answer">
            <p>Kami ready setiap hari Minggu supaya kalian ga bosen ya! </p>
          </div>
        </div>
      </div>
      </main>
      </div>
    </SEction>



      <!--icon-->
      <script>
        feather.replace();
      </script>
      <!--navbar aktif untuk hamburger menu javascript-->
      <script src="js/script.js"></script>
      <!-- untuk review -->
      <script src="js/review.js"></script>
      <!-- untuk menu -->
      <script src="js/menambahkan_product.js"></script>
      </div>
</body>

</html>
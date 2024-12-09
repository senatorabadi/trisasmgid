// Toggle class active untuk navbar
const navbarnav = document.querySelector(".navbar-nav");

// Ketika hamburger menu di klik
document.querySelector("#hamburger-menu").onclick = (e) => {
  e.preventDefault(); // Mencegah perilaku default (jika ada href)
  navbarnav.classList.toggle("active");
};

// Toggle class active untuk shopping cart
const shoppingcart = document.querySelector('.shopping-cart');
document.querySelector('#shopping-cart-button').onclick = (e) => {
  shoppingcart.classList.toggle('active');
  e.preventDefault(); // Mencegah perilaku default (jika ada href)
};

// Klik di luar sidebar untuk menghilangkan navmenu
const hm = document.querySelector("#hamburger-menu");
const sb = document.querySelector(".sidebar"); // Pastikan elemen sidebar didefinisikan
const searchForm = document.querySelector(".search-form"); // Pastikan elemen searchForm didefinisikan

document.addEventListener("click", function (e) {
  // Menutup navbar jika klik di luar hamburger menu dan navbar
  if (!hm.contains(e.target) && !navbarnav.contains(e.target)) {
    navbarnav.classList.remove("active");
  }
  // Menutup search form jika klik di luar search form
  if (!sb.contains(e.target) && !searchForm.contains(e.target)) {
    searchForm.classList.remove("active");
  }
});

// Menambahkan FAQ
const questions = document.querySelectorAll(".question-answer");

questions.forEach(function (question) {
  const btn = question.querySelector(".question-btn");
  btn.addEventListener("click", function () {
    question.classList.toggle("show-text");
    // Menutup pertanyaan lain jika yang ini dibuka
    questions.forEach(q => {
      if (q !== question) {
        q.classList.remove("show-text");
      }
    });
  });
});

// Validasi form
function validateForm() {
  const nama = document.querySelector('input[name="nama"]').value;
  const no_hp = document.querySelector('input[name="no_hp"]').value;
  const pertanyaan = document.querySelector('input[name="pertanyaan"]').value;

  if (!nama || !no_hp || !pertanyaan) {
      alert("Semua field harus diisi!");
      return false;
  }
  return true;
}
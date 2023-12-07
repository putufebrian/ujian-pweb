// Menggunakan event listener untuk menangani submit form
document.getElementById('loginForm').addEventListener('submit', function(event) {
  event.preventDefault(); // Mencegah pengiriman form bawaan

  // Mendapatkan nilai username dan password
  var username = document.getElementById('username').value;
  var password = document.getElementById('password').value;

  // Memeriksa jika username dan password tidak sesuai (Anda bisa tambahkan logika Anda sendiri di sini)
  if (username !== 'admin' || password !== 'admin') {
    // Menampilkan pesan kesalahan menggunakan pop-up
    alert('Username atau password salah');
  } else {
    // Jika login berhasil, redirect ke index.php
    window.location.href = 'index.php';
  }
});

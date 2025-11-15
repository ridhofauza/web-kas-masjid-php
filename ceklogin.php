<?php
    // session_start();
    // include "library/config.php";

    // $username = $_POST['username'];
    // $password = $_POST['password'];

    // $query = mysqli_query($con, "SELECT * FROM pengguna Where username = '$username' AND password = '$password' ");
    // $data = mysqli_fetch_assoc($query); 
    // $jml = mysqli_num_rows($query);
    
    // if ($jml > 0) {
    //     $_SESSION['username'] = $data['username'];
    //     $_SESSION['password'] = $data['password'];
    //     $_SESSION['nama'] = $data['nama'];
    //     $_SESSION['role'] = $data['role'];

    //     header('location: index.php');
    // } else {
    //     echo "<p align='center'>Login Gagal!</p>";
    //     echo "<meta http-equiv='refresh' content='2; url=login.php'>";
    // }

session_start(); // Memulai sesi PHP
include "library/config.php"; // Mengimpor file konfigurasi database

// Mengambil input dari form login
$username = htmlspecialchars($_POST['username']); // Mengamankan input username
$password_input = $_POST['password']; // Password dari input pengguna

// Query untuk mendapatkan data pengguna berdasarkan username
$query = mysqli_query($con, "SELECT * FROM users WHERE email = '$username'");
$data = mysqli_fetch_assoc($query); 
$jml = mysqli_num_rows($query); // Menghitung jumlah baris hasil query

if ($jml > 0) { // Jika ada hasil (username ditemukan)
    // Verifikasi password menggunakan password_verify()
    if (password_verify($password_input, $data['password'])) { // Memeriksa kecocokan password
        // Menyimpan informasi pengguna ke dalam session
        $_SESSION['id_user'] = $data['id_user'];
        $_SESSION['username'] = $data['email'];
        $_SESSION['nama'] = $data['nama'];
        $_SESSION['role'] = $data['role'];
        $_SESSION['foto_profil'] = !empty($data['foto_profil']) ? $data['foto_profil'] : './images/default-avatar.png';
        // Menyimpan foto profil ke session (gunakan default jika kosong)

        // Redirect berdasarkan role
        if ($_SESSION['role'] === 'admin') {
            // Admin hanya bisa mengakses dashboard, transaksi, dan laporan
            header('Location: index.php?hal=dashboard'); // Redirect ke dashboard
            exit();
        } elseif ($_SESSION['role'] === 'jamaah') {
            // Owner bisa mengakses semua fitur
            header('Location: index.php?hal=dashboard'); // Redirect ke dashboard (atau halaman lain jika diperlukan)
            exit();
        } else {
            echo "<p align='center'>Role tidak valid!</p>";
            echo "<meta http-equiv='refresh' content='2; url=login.php'>"; // Redirect kembali ke halaman login setelah 2 detik
        }
    } else {
        // Jika password salah
        echo "<p align='center'>Login Gagal! Password salah.</p>";
        echo "<meta http-equiv='refresh' content='2; url=login.php'>"; // Redirect kembali ke halaman login setelah 2 detik
    }
} else {
    // Jika username tidak ditemukan
    echo "<p align='center'>Login Gagal! Username tidak ditemukan.</p>";
    echo "<meta http-equiv='refresh' content='2; url=login.php'>"; // Redirect kembali ke halaman login setelah 2 detik
}

?>
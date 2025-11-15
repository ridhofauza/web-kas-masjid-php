<?php
if (!defined("INDEX")) die("");

// Pastikan metode POST digunakan
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $id_kategori = htmlspecialchars($_POST['id_kategori']);
    $nama_kategori = htmlspecialchars($_POST['nama_kategori']);
    $deskripsi = htmlspecialchars($_POST['deskripsi']);

    // Update data di database
    $query = "UPDATE kategori_keuangan SET nama_kategori = ?, deskripsi = ? WHERE id_kategori = ?";
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, "ssi", $nama_kategori, $deskripsi,$id_kategori);

    if (mysqli_stmt_execute($stmt)) {
        // Jika berhasil, tampilkan notifikasi
        ?>
<style>
/* Style untuk notifikasi */
.notif-div {
    position: fixed;
    top: 60px;
    right: 20px;
    background: #d4edda;
    border: 1px solid #c3e6cb;
    padding: 12px 20px;
    border-radius: 5px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
    z-index: 9999;
    font-size: 16px;
    color: #155724;
    text-align: center;
}

/* Media query untuk layar kecil (misalnya, lebar kurang dari 768px) */
@media (max-width: 768px) {
    .notif-div {
        top: 110px;
        /* Sesuaikan posisi top agar tidak menutupi navbar */
        right: 10px;
        /* Sesuaikan posisi kanan agar tidak terlalu dekat dengan tepi layar */
        left: 180px;
        /* Tambahkan posisi kiri agar notifikasi memiliki lebar yang sesuai */
        width: auto;
        /* Biarkan lebar menyesuaikan dengan konten */
        margin: 0 auto;
        /* Pusatkan notifikasi horizontal */
    }
}
</style>
<script>
function showNotif(message, type) {
    const notifDiv = document.createElement('div');
    notifDiv.className = 'notif-div'; // Tambahkan kelas untuk styling

    notifDiv.textContent = message;

    document.body.appendChild(notifDiv);

    setTimeout(() => {
        notifDiv.remove();
        window.location.href = '?hal=kategori-keuangan'; // Redirect setelah notifikasi
    }, 3000);
}

// Contoh pemanggilan fungsi notifikasi
showNotif('Data berhasil diupdate!', 'success');
</script>

<?php
    } else {
        echo "Tidak dapat memperbarui data!<br>";
        echo mysqli_error($con);
    }
} else {
    echo "Akses tidak sah!";
}
?>
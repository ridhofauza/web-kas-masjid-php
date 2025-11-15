<?php
if (!defined("INDEX")) die("Akses langsung tidak diizinkan.");

// Ambil ID pengguna dari parameter GET
$id = intval($_GET['id']); // Mengubah ID menjadi integer untuk keamanan

// Ambil informasi pengguna termasuk foto profil sebelum menghapus data
$query = "SELECT foto_profil FROM users WHERE id_user = ?";
$stmt = mysqli_prepare($con, $query);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if ($row = mysqli_fetch_assoc($result)) {
    $foto_profil = $row['foto_profil']; // Path foto profil pengguna

    // Hapus pengguna dari database
    $deleteQuery = "DELETE FROM users WHERE id_user = ?";
    $deleteStmt = mysqli_prepare($con, $deleteQuery);
    mysqli_stmt_bind_param($deleteStmt, "i", $id);
    $deleteResult = mysqli_stmt_execute($deleteStmt);

    if ($deleteResult) {
        // Hapus file foto profil jika ada
        if (!empty($foto_profil) && file_exists($foto_profil)) {
            unlink($foto_profil); // Menghapus file dari server
        }
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
        window.location.href = '?hal=pengguna'; // Redirect setelah notifikasi
    }, 3000);
}

// Contoh pemanggilan fungsi notifikasi
showNotif('Data berhasil dihapus!', 'success');
</script>

<?php
    } else {
        echo "Tidak dapat menghapus data!<br>" . mysqli_error($con);
    }
} else {
    echo "Pengguna tidak ditemukan.";
}
?>
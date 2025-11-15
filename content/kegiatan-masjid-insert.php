<?php
if (!defined("INDEX")) die("");

// Mengambil data dari form
$id_user = $_SESSION['id_user'];
$nama_kegiatan = htmlspecialchars($_POST['nama_kegiatan']);
$deskripsi = htmlspecialchars($_POST['deskripsi']);
$tanggal_mulai = htmlspecialchars($_POST['tanggal_mulai']);
$tanggal_selesai = htmlspecialchars($_POST['tanggal_selesai']);
$lokasi = htmlspecialchars($_POST['lokasi']);

// Menyimpan data ke database
$query = "INSERT INTO kegiatan_masjid (nama_kegiatan, deskripsi, tanggal_mulai, tanggal_selesai, lokasi, dibuat_oleh) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = mysqli_prepare($con, $query);
mysqli_stmt_bind_param($stmt, "sssssi", $nama_kegiatan, $deskripsi, $tanggal_mulai, $tanggal_selesai, $lokasi, $id_user);

if (mysqli_stmt_execute($stmt)) { ?>
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
        window.location.href = '?hal=kegiatan-masjid'; // Redirect setelah notifikasi
    }, 3000);
}

// Contoh pemanggilan fungsi notifikasi
showNotif('Data berhasil ditambah!', 'success');
</script>

<?php 
} else {
   echo "Tidak dapat menambah data!<br>";
   echo mysqli_error($con);
}
?>
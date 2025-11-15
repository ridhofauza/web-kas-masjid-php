<?php
if (!defined("INDEX")) die("");

// Mengambil data dari form
$id_donatur = $_POST['donatur'];
$id_kegiatan = $_POST['kegiatan'];
$tanggal_donasi = $_POST['tanggal_donasi'];
$jumlah = htmlspecialchars($_POST['jumlah']);
$metode_pembayaran = htmlspecialchars($_POST['metode_pembayaran']);
$status_verifikasi = htmlspecialchars($_POST['status_verifikasi']);
$keterangan = htmlspecialchars($_POST['keterangan']);

// Proses upload file
if (isset($_FILES['bukti_transfer']) && $_FILES['bukti_transfer']['error'] == 0) {
    $upload_dir = 'uploads/bukti_transfer/'; // Pastikan folder ini ada dan writable
    $file_name = basename($_FILES['bukti_transfer']['name']);
    $target_file = $upload_dir . $file_name;

    // Memindahkan file ke folder tujuan
    if (move_uploaded_file($_FILES['bukti_transfer']['tmp_name'], $target_file)) {
        // Menyimpan data ke database
        $query = "INSERT INTO donasi (id_user, id_kegiatan, tanggal_donasi, jumlah, metode_pembayaran, bukti_transfer, status_verifikasi, keterangan) VALUES (?,?,?,?,?,?,?,?)";
        $stmt = mysqli_prepare($con, $query);
        mysqli_stmt_bind_param($stmt, "iisissss", $id_donatur, $id_kegiatan, $tanggal_donasi, $jumlah, $metode_pembayaran, $target_file, $status_verifikasi, $keterangan);

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
        window.location.href = '?hal=donasi'; // Redirect setelah notifikasi
    }, 3000);
}

// Contoh pemanggilan fungsi notifikasi
showNotif('Data berhasil ditambah!', 'success');
</script>

<?php } else {
            echo "Tidak dapat menambah data!<br>";
            echo mysqli_error($con);
        }
    } else {
        echo "Gagal mengunggah file.<br>";
    }
} else {
    echo "Tidak ada file yang diunggah atau terjadi kesalahan saat mengunggah file.<br>";
}
?>
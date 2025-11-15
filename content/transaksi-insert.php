<?php
if (!defined("INDEX")) die("");

$nama = htmlspecialchars($_POST['nama']);
$tanggal = htmlspecialchars($_POST['tanggal']);
$kategori = htmlspecialchars($_POST['kategori']);
$nominal = htmlspecialchars($_POST['nominal']);
$rincian = htmlspecialchars($_POST['rincian']);
$timestamp = date('Y-m-d H:i:s');

$query = "INSERT INTO transaksi (nama, tanggal, kategori, nominal, rincian, timestamp) VALUES ('$nama', '$tanggal', '$kategori', '$nominal', '$rincian', '$timestamp')";
$result = mysqli_query($con, $query);

if ($result) { ?>
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
        window.location.href = '?hal=transaksi'; // Redirect setelah notifikasi
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
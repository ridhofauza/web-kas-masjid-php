<?php
if (!defined("INDEX")) die("");

// Direktori tempat menyimpan file upload
$target_dir = "uploads/";

// Ambil data dari form
$nama = htmlspecialchars($_POST['nama'] ?? '');
$alamat = htmlspecialchars($_POST['alamat'] ?? '');
$email = htmlspecialchars($_POST['email'] ?? '');
$no_telp = htmlspecialchars($_POST['no_telp'] ?? '');
$bank = htmlspecialchars($_POST['bank'] ?? '');
$no_rek = htmlspecialchars($_POST['no_rek'] ?? '');
$ketua_takmir = htmlspecialchars($_POST['ketua_takmir'] ?? '');
$sekretaris = htmlspecialchars($_POST['sekretaris'] ?? '');
$bendahara = htmlspecialchars($_POST['bendahara'] ?? '');

// Ambil data logo lama dari database
$query_logo = "SELECT logo FROM masjid";
$result_logo = mysqli_query($con, $query_logo);
if ($result_logo) {
    $data_logo = mysqli_fetch_assoc($result_logo);
    $logo_lama = $data_logo['logo'] ?? '';
} else {
    echo "Error: " . mysqli_error($con);
    exit;
}

// Proses upload file jika ada
if (isset($_FILES["logo"]) && $_FILES["logo"]["error"] == 0) {
    $target_file = $target_dir . basename($_FILES["logo"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Validasi file (hanya contoh, perlu ditingkatkan)
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        echo "<script>showNotif('Sorry, only JPG, JPEG, PNG & GIF files are allowed.', 'error');</script>";
        $uploadOk = 0;
    }

    // Cek ukuran file
    if ($_FILES["logo"]["size"] > 500000) {
        echo "<script>showNotif('Sorry, your file is too large.', 'error');</script>";
        $uploadOk = 0;
    }

    if ($uploadOk == 1) {
        if (move_uploaded_file($_FILES["logo"]["tmp_name"], $target_file)) {
            $logo = htmlspecialchars(basename($_FILES["logo"]["name"]));
        } else {
            echo "<script>showNotif('Sorry, there was an error uploading your file.', 'error');</script>";
            $logo = $logo_lama; // Gunakan logo lama jika upload gagal
        }
    } else {
        $logo = $logo_lama; // Gunakan logo lama jika validasi gagal
    }
} else {
    $logo = $logo_lama; // Gunakan logo lama jika tidak ada file yang diupload
}

// Update data ke database
$query = "UPDATE masjid SET 
            nama = ?, 
            alamat = ?, 
            email = ?, 
            no_telp = ?, 
            bank = ?, 
            no_rek = ?, 
            ketua_takmir = ?, 
            sekretaris = ?, 
            bendahara = ?,
            logo = ?";

$stmt = mysqli_prepare($con, $query);
mysqli_stmt_bind_param($stmt, "ssssssssss", $nama, $alamat, $email, $no_telp, $bank, $no_rek, $ketua_takmir, $sekretaris, $bendahara, $logo);

$berhasil_update = false; // Tambahkan variabel untuk menandai keberhasilan update

if (mysqli_stmt_execute($stmt)) {
    // Menampilkan notifikasi sukses
    echo "<script>showNotif('Data berhasil diupdate!', 'success');</script>";
    $berhasil_update = true; // Set variabel menjadi true jika berhasil
} else {
    // Menampilkan notifikasi gagal
    echo "<script>showNotif('Tidak dapat mengupdate data! Error: " . mysqli_error($con) . "', 'error');</script>";
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
        <?php if($berhasil_update): ?>
        window.location.href = '?hal=masjid'; // Redirect setelah notifikasi
        <?php endif; ?>
    }, 3000);
}

<?php if(!$berhasil_update): ?>
// Jika update gagal, tampilkan notifikasi
showNotif('Tidak dapat mengupdate data! Error: <?php echo mysqli_error($con); ?>', 'error');
<?php else: ?>
// Jika update berhasil, tampilkan notifikasi
showNotif('Data berhasil diupdate!', 'success');
<?php endif; ?>
</script>
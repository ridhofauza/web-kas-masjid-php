<?php
if (!defined("INDEX")) die("");

// Mengambil data dari form
$nama = htmlspecialchars($_POST['nama']);
$username = htmlspecialchars($_POST['username']);
$password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hashing password untuk keamanan
$no_hp = htmlspecialchars($_POST['no_hp']);
$role = htmlspecialchars($_POST['role']);

// Proses upload file
if (isset($_FILES['foto_profil']) && $_FILES['foto_profil']['error'] == 0) {
    $upload_dir = 'uploads/'; // Pastikan folder ini ada dan writable
    $file_name = basename($_FILES['foto_profil']['name']);
    $target_file = $upload_dir .date('YmdHis') .'_'. $file_name;

    // Memindahkan file ke folder tujuan
    if (move_uploaded_file($_FILES['foto_profil']['tmp_name'], $target_file)) {
        // Menyimpan data pengguna ke database
        $query = "INSERT INTO users (nama, email, password, no_hp, role, foto_profil) VALUES ('$nama', '$username', '$password', '$no_hp', '$role', '$target_file')";
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
        window.location.href = '?hal=pengguna'; // Redirect setelah notifikasi
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
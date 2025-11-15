<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (!defined("INDEX")) die("");

// Pastikan metode POST digunakan
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = htmlspecialchars($_POST['id']);
    $nama = htmlspecialchars($_POST['nama']);
    $username = htmlspecialchars($_POST['username']);
    $no_hp = htmlspecialchars($_POST['no_hp']);
    $password = $_POST['password'];
    $role = htmlspecialchars($_POST['role']);

    // Proses unggah file foto profil
    $foto_profil = null;
    if (isset($_FILES['foto_profil']) && $_FILES['foto_profil']['error'] == 0) {
        $upload_dir = 'uploads/';
        $file_name = basename($_FILES['foto_profil']['name']);
        $target_file = $upload_dir . $file_name;

        // Pindahkan file ke folder tujuan
        if (move_uploaded_file($_FILES['foto_profil']['tmp_name'], $target_file)) {
            $foto_profil = $target_file;
        } else {
            echo "Gagal mengunggah file.";
            exit;
        }
    }

// 1. SQL Injection: Kode ini rentan terhadap serangan SQL Injection karena menggunakan input langsung dari $_GET['id']. -->
// 2. Keamanan Input: Sebaiknya, gunakan prepared statement untuk memperbaiki keamanan. -->

    // Update data pengguna
    if (empty($password)) {
        // Update tanpa mengubah password
        if ($foto_profil) {
            $query = "UPDATE users SET nama = ?, email = ?, no_hp = ?, role = ?, foto_profil = ? WHERE id_user = ?";
            $stmt = mysqli_prepare($con, $query);
            mysqli_stmt_bind_param($stmt, "sssssi", $nama, $username, $no_hp, $role, $foto_profil, $id);
        } else {
            $query = "UPDATE users SET nama = ?, email = ?, role = ?, no_hp = ? WHERE id_user = ?";
            $stmt = mysqli_prepare($con, $query);
            mysqli_stmt_bind_param($stmt, "ssssi", $nama, $username, $role, $no_hp, $id);
        }
    } else {
        // Update dengan mengubah password
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        if ($foto_profil) {
            $query = "UPDATE users SET nama = ?, email = ?, password = ?, no_hp = ?, role = ?, foto_profil = ? WHERE id_user = ?";
            $stmt = mysqli_prepare($con, $query);
            mysqli_stmt_bind_param($stmt, "ssssssi", $nama, $username, $password_hash, $no_hp, $role, $foto_profil, $id);
        } else {
            $query = "UPDATE users SET nama = ?, email = ?, password = ?, no_hp = ?, role = ? WHERE id_user = ?";
            $stmt = mysqli_prepare($con, $query);
            mysqli_stmt_bind_param($stmt, "sssssi", $nama, $username, $password_hash, $no_hp, $role, $id);
        }
    }

    // Eksekusi query dan tampilkan notifikasi
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
        window.location.href = '?hal=pengguna'; // Redirect setelah notifikasi
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
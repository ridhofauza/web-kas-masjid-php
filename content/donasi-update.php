<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (!defined("INDEX")) die("");

// Pastikan metode POST digunakan
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   $id_donasi = $_POST['id_donasi'];
   $id_donatur = $_POST['donatur'];
   $id_kegiatan = $_POST['kegiatan'];
   $tanggal_donasi = $_POST['tanggal_donasi'];
   $jumlah = htmlspecialchars($_POST['jumlah']);
   $keterangan = htmlspecialchars($_POST['keterangan']);
   $metode_pembayaran = htmlspecialchars($_POST['metode_pembayaran']);
   $status_verifikasi = htmlspecialchars($_POST['status_verifikasi']);
   $bukti_transfer_old = htmlspecialchars($_POST['bukti_transfer_old']);

   // Proses unggah file bukti transfer
   $bukti_transfer = null;
   if (isset($_FILES['bukti_transfer']) && $_FILES['bukti_transfer']['error'] == 0) {
      // delete bukti transfer lama
      if (!empty($bukti_transfer_old)) {
         if (file_exists($bukti_transfer_old)) {
            if (unlink($bukti_transfer_old)) {
               $upload_dir = 'uploads/bukti_transfer/';
               $file_name = basename($_FILES['bukti_transfer']['name']);
               $target_file = $upload_dir . $file_name;

               // Pindahkan file baru ke folder tujuan
               if (move_uploaded_file($_FILES['bukti_transfer']['tmp_name'], $target_file)) {
                  $bukti_transfer = $target_file;
               } else {
                  echo "Gagal mengunggah file.";
                  exit;
               }
            } else {
               echo "Gagal menghapus file.";
               exit;
            }
         }
      }
   }

   // 1. SQL Injection: Kode ini rentan terhadap serangan SQL Injection karena menggunakan input langsung dari $_GET['id']. -->
   // 2. Keamanan Input: Sebaiknya, gunakan prepared statement untuk memperbaiki keamanan. -->

   // Update data donasi
   if ($bukti_transfer) {
      $query = "UPDATE donasi SET id_user = ?, id_kegiatan = ?, tanggal_donasi = ?, jumlah = ?, metode_pembayaran = ?, bukti_transfer = ?, status_verifikasi = ?, keterangan = ? WHERE id_donasi = ?";
      $stmt = mysqli_prepare($con, $query);
      mysqli_stmt_bind_param($stmt, "iisissssi", $id_donatur, $id_kegiatan, $tanggal_donasi, $jumlah, $metode_pembayaran, $bukti_transfer, $status_verifikasi, $keterangan, $id_donasi);
   } else {
      $query = "UPDATE donasi SET id_user = ?, id_kegiatan = ?, tanggal_donasi = ?, jumlah = ?, metode_pembayaran = ?, status_verifikasi = ?, keterangan = ? WHERE id_donasi = ?";
      $stmt = mysqli_prepare($con, $query);
      mysqli_stmt_bind_param($stmt, "iisisssi", $id_donatur, $id_kegiatan, $tanggal_donasi, $jumlah, $metode_pembayaran, $status_verifikasi, $keterangan, $id_donasi);
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
               window.location.href = '?hal=donasi'; // Redirect setelah notifikasi
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
<?php
if (!defined("INDEX")) die("");

// Pastikan metode GET digunakan
if ($_SERVER["REQUEST_METHOD"] == "GET") {
   // Ambil ID transaksi dari URL
   $id = isset($_GET['id']) ? htmlspecialchars($_GET['id']) : '';
   $file_path = isset($_GET['file']) ? htmlspecialchars($_GET['file']) : '';
   $file_path = './' . $file_path;

   if (!empty($file_path)) {
      if (file_exists($file_path)) {
         unlink($file_path);   // delete the file

         // Pastikan ID tidak kosong
         if (!empty($id)) {
            // Hapus data dari database
            $query = "DELETE FROM donasi WHERE id_donasi = ?";
            $stmt = mysqli_prepare($con, $query);
            mysqli_stmt_bind_param($stmt, "i", $id);

            if (mysqli_stmt_execute($stmt)) {
               // Jika berhasil, tampilkan notifikasi dan redirect ke halaman
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
                        window.location.href = '?hal=donasi'; // Redirect setelah notifikasi
                     }, 3000);
                  }

                  // Contoh pemanggilan fungsi notifikasi
                  showNotif('Data berhasil dihapus!', 'success');
               </script>

<?php
            } else {
               echo "Tidak dapat menghapus data!<br>";
               echo mysqli_error($con);
            }
         } else {
            echo "ID tidak valid!";
         }
      } else {
         echo "File tidak ditemukan!";
      }
   } else {
      echo "Tidak dapat menghapus file!<br>";
   }
} else {
   echo "Akses tidak sah!";
}
?>
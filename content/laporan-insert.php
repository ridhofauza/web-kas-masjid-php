<?php
if (!defined("INDEX")) die("");

// Mengambil data dari form
$id_user = $_SESSION['id_user'];
$periode_tahun = $_POST['periode_tahun'];
$periode_bulan = $_POST['periode_bulan'];
$total_pemasukan = $_POST['total_pemasukan'];
$total_pengeluaran = $_POST['total_pengeluaran'];
$saldo_akhir = $_POST['saldo_akhir'];
$dibuat_oleh = $_SESSION['nama'];
$file_pdf = null;
$map_month = mapMonth();
$month_name = $map_month[$periode_bulan];
$periode_full = $month_name.' '.$periode_tahun;

// Query untuk mengambil data keuangan
$query = "SELECT d.tanggal_donasi as tanggal, 'donasi' as sumber_dana, d.keterangan as sumber_donasi, 'pemasukan' as jenis, '-' as kategori, d.metode_pembayaran as rincian, d.jumlah FROM donasi d WHERE d.status_verifikasi = 'verifikasi' AND MONTH(d.tanggal_donasi) = ? AND YEAR(d.tanggal_donasi) = ?
    UNION ALL
    SELECT k.tanggal, k.sumber as sumber_dana, IFNULL(d.keterangan, '-') as sumber_donasi, k.jenis, IFNULL(kk.nama_kategori, '-') as kategori, k.keterangan as rincian, k.jumlah FROM keuangan k LEFT JOIN donasi d ON d.id_donasi = k.id_donasi LEFT JOIN kategori_keuangan kk ON kk.id_kategori = k.id_kategori WHERE MONTH(k.tanggal) = ? AND YEAR(k.tanggal) = ? ORDER BY tanggal ASC";
$stmt = mysqli_prepare($con, $query);
mysqli_stmt_bind_param($stmt, "ssss", $periode_bulan, $periode_tahun, $periode_bulan, $periode_tahun);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$dataTransaksi = [];
while ($row = mysqli_fetch_assoc($result)) {
   $dataTransaksi[] = $row;
}

// FPDF Calculate MultiCell Height
function nbLines($pdf, $w, $txt)
{
   $txt = str_replace("\r", '', $txt);
   $words = explode(' ', $txt);
   $lineWidth = 0;
   $lines = 1;

   foreach ($words as $word) {
      $wordWidth = $pdf->GetStringWidth($word . ' ');
      if ($lineWidth + $wordWidth > $w) {
         $lines++;
         $lineWidth = $wordWidth;
      } else {
         $lineWidth += $wordWidth;
      }
   }
   return $lines;
}

// Fungsi untuk menghasilkan PDF
function generatePDF($data, $bulan, $tahun, $dibuat_oleh)
{
   require_once('fpdf/fpdf.php');

   // Inisialisasi PDF
   $pdf = new FPDF();
   $pdf->AddPage();
   $pdf->SetFont('Arial', 'B', 16);
   $pdf->Cell(0, 10, 'Laporan Transaksi Bulan ' . $bulan . ' Tahun ' . $tahun, 0, 1, 'C');

   // Header tabel
   $pdf->SetFont('Arial', 'B', 10);

   // Style tabel
   $pdf->SetXY(20, 30); // Ubah nilai Y menjadi 30
   $pdf->Cell(8, 7, 'No', 1, 0, 'C');
   $pdf->Cell(20, 7, 'Tanggal', 1, 0, 'C');
   $pdf->Cell(28, 7, 'Sumber Donasi', 1, 0, 'C');
   $pdf->Cell(20, 7, 'Jenis', 1, 0, 'C');
   $pdf->Cell(30, 7, 'Kategori', 1, 0, 'C');
   $pdf->Cell(30, 7, 'Rincian', 1, 0, 'C');
   $pdf->Cell(30, 7, 'Nominal', 1, 0, 'C');
   $pdf->Ln();

   // Data tabel
   $pdf->SetFont('Arial', '', 9);
   $totalNominal = 0; // Variabel untuk menyimpan total nominal
   $temp_total_pemasukan = 0;
   $temp_total_pengeluaran = 0;
   $y = 37; // Ubah nilai Y menjadi 37

   if (count($data) > 0) {
      $no = 1;
      foreach ($data as $row) {

         // Hitung pengeluaran & pemasukan
         if ($row['jenis'] === 'pemasukan') {
            $temp_total_pemasukan += $row['jumlah'];
         }
         if ($row['jenis'] === 'pengeluaran') {
            $temp_total_pengeluaran += $row['jumlah'];
         }

         // Hitung tinggi masing-masing kolom
         $h2 = nbLines($pdf, 28, $row['sumber_donasi']) * 6;
         $h3 = nbLines($pdf, 30, $row['kategori']) * 6;
         $h4 = nbLines($pdf, 30, $row['rincian']) * 6;

         $rowHeight = max($h2, $h3, $h4, 6);

         // Cetak sel tetap
         $pdf->SetXY(20, $y);
         $pdf->Cell(8,  $rowHeight, $no++, 1, 0, 'C');
         $pdf->Cell(20, $rowHeight, $row['tanggal'], 1, 0, 'C');

         // Sumber Donasi
         $x = $pdf->GetX();
         $pdf->SetXY($x, $y);
         $pdf->MultiCell(28, 6, html_entity_decode($row['sumber_donasi']), 0, 'L');
         $pdf->Rect($x, $y, 28, $rowHeight);
         $pdf->SetXY($x + 28, $y);

         // Jenis
         $pdf->Cell(20, $rowHeight, html_entity_decode($row['jenis']), 1, 0, 'C');

         // Kategori
         $x = $pdf->GetX();
         $pdf->SetXY($x, $y);
         $pdf->MultiCell(30, 6, html_entity_decode($row['kategori']), 0, 'L');
         $pdf->Rect($x, $y, 30, $rowHeight);
         $pdf->SetXY($x + 30, $y);

         // Rincian
         $x = $pdf->GetX();
         $pdf->SetXY($x, $y);
         $pdf->MultiCell(30, 6, paymentMethod(html_entity_decode($row['rincian'])), 0, 'L');
         $pdf->Rect($x, $y, 30, $rowHeight);
         $pdf->SetXY($x + 30, $y);

         // Nominal
         $pdf->Cell(30, $rowHeight, rupiah($row['jumlah']), 1, 0, 'R');

         $y += $rowHeight;

         $pdf->Ln($rowHeight);
      }

      // Tambahkan baris total di bawah tabel
      $totalNominal = $temp_total_pemasukan - $temp_total_pengeluaran;
      $pdf->SetXY(20, $y);
      $pdf->SetFont('Arial', 'B', 9);
      $pdf->Cell(136, 6, 'Saldo Akhir', 1, 0, 'C');
      $pdf->Cell(30, 6, rupiah($totalNominal), 1, 0, 'R');
   } else {
      $y += 6;
      $pdf->SetFont('Arial', 'I', 10);
      $pdf->SetXY(20, $y);
      $pdf->Cell(166, 7, 'Data tidak ditemukan', 0, 0, 'C');
   }
   $pdf->Ln();
   $y += 6;
   $pdf->SetXY(20, $y);
   $pdf->SetFont('Arial', 'I', 7);
   $pdf->Cell(160, 7, 'Dibuat oleh: ' . $dibuat_oleh, 0, 0);
   $y += 3;
   $pdf->SetXY(20, $y);
   $pdf->SetFont('Arial', 'I', 7);
   $pdf->Cell(160, 7, 'Tanggal dibuat: ' . date('Y-m-d H:i:s'), 0, 0);

   $filename_pdf = 'laporan_' . $bulan . '_' . $tahun . '_' . date('YmdHis') . '.pdf';
   $filepath_pdf = 'uploads/laporan_pdf/' . $filename_pdf;
   $pdf->Output('F', $filepath_pdf);
   return $filepath_pdf;
}

// Proses simpan file
$file_pdf = generatePDF($dataTransaksi, $month_name, $periode_tahun, 
$dibuat_oleh);
if (!empty($file_pdf)) {
   // Menyimpan data ke database
   $query = "INSERT INTO laporan (periode, total_pemasukan, total_pengeluaran, saldo_akhir, dibuat_oleh, file_pdf) VALUES (?,?,?,?,?,?)";
   $stmt = mysqli_prepare($con, $query);
   mysqli_stmt_bind_param($stmt, "siiiis", $periode_full, $total_pemasukan, $total_pengeluaran, $saldo_akhir, $id_user, $file_pdf);

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
               window.location.href = '?hal=laporan'; // Redirect setelah notifikasi
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
   echo "Tidak ada file yang disimpan atau terjadi kesalahan saat menyimpan file.<br>";
}
?>
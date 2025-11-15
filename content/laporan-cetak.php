<?php
// Gunakan path absolut untuk memastikan file ditemukan
require_once(__DIR__ . '/../config.php');

// Ambil format dari URL (pdf atau excel)
$format = $_GET['format'] ?? '';

// Ambil data bulan dan tahun dari URL
$tahun = $_GET['tahun'] ?? date('Y');
$bulan = $_GET['bulan'] ?? date('m');

// Query untuk mengambil data transaksi
$query = "SELECT 
                tanggal,
                nama,
                kategori,
                nominal,
                rincian
          FROM transaksi 
          WHERE YEAR(tanggal) = ? AND MONTH(tanggal) = ?";
$stmt = $con->prepare($query);
$stmt->bind_param('ii', $tahun, $bulan);
$stmt->execute();
$result = $stmt->get_result();

// Data laporan
$dataTransaksi = [];
while ($row = $result->fetch_assoc()) {
    $dataTransaksi[] = $row;
}

// Fungsi untuk menghasilkan PDF
function generatePDF($dataTransaksi, $bulan, $tahun) {
    header('Content-Type: application/pdf');
    header('Content-Disposition: inline; filename="laporan-transaksi.pdf"');

    echo "<h1>Laporan Transaksi Bulan {$bulan} Tahun {$tahun}</h1>";
    echo "<table border='1' cellpadding='5' cellspacing='0'>";
    echo "<tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Nama</th>
            <th>Kategori</th>
            <th>Nominal</th>
            <th>Rincian</th>
          </tr>";

    foreach ($dataTransaksi as $index => $row) {
        echo "<tr>
                <td>" . ($index + 1) . "</td>
                <td>{$row['tanggal']}</td>
                <td>{$row['nama']}</td>
                <td>{$row['kategori']}</td>
                <td>Rp " . number_format($row['nominal'], 0, ',', '.') . "</td>
                <td>{$row['rincian']}</td>
              </tr>";
    }

    echo "</table>";
}

// Fungsi untuk menghasilkan Excel
function generateExcel($dataTransaksi, $bulan, $tahun) {
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment; filename="laporan-transaksi.xls"');

    echo "Laporan Transaksi Bulan {$bulan} Tahun {$tahun}\n";
    echo "No\tTanggal\tNama\tKategori\tNominal\tRincian\n";

    foreach ($dataTransaksi as $index => $row) {
        echo ($index + 1) . "\t";
        echo "{$row['tanggal']}\t";
        echo "{$row['nama']}\t";
        echo "{$row['kategori']}\t";
        echo "Rp " . number_format($row['nominal'], 0, ',', '.') . "\t";
        echo "{$row['rincian']}\n";
    }
}

// Pilih format keluaran berdasarkan parameter
if ($format === 'pdf') {
    generatePDF($dataTransaksi, $bulan, $tahun);
} elseif ($format === 'excel') {
    generateExcel($dataTransaksi, $bulan, $tahun);
} else {
    echo "Format tidak valid!";
}
?>
<?php
header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $periode_tahun = $_POST['periode_tahun'];
    $periode_bulan = $_POST['periode_bulan'];
    $total_pemasukan = 0;
    $total_pengeluaran = 0;
    $saldo_akhir = 0;

    $data = [
        "total_pemasukan" => 0,
        "total_pengeluaran" => 0,
        "saldo_akhir" => 0
    ];


    $query = "SELECT d.tanggal_donasi as tanggal, 'donasi' as sumber_dana, d.keterangan as sumber_donasi, 'pemasukan' as jenis, '-' as kategori, d.metode_pembayaran as rincian, d.jumlah FROM donasi d WHERE d.status_verifikasi = 'verifikasi' AND MONTH(d.tanggal_donasi) = ? AND YEAR(d.tanggal_donasi) = ?
    UNION ALL
    SELECT k.tanggal, k.sumber as sumber_dana, IFNULL(d.keterangan, '-') as sumber_donasi, k.jenis, IFNULL(kk.nama_kategori, '-') as kategori, k.keterangan as rincian, k.jumlah FROM keuangan k LEFT JOIN donasi d ON d.id_donasi = k.id_donasi LEFT JOIN kategori_keuangan kk ON kk.id_kategori = k.id_kategori WHERE MONTH(k.tanggal) = ? AND YEAR(k.tanggal) = ? ORDER BY tanggal ASC";
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, "ssss", $periode_bulan, $periode_tahun, $periode_bulan, $periode_tahun);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    while ($row = mysqli_fetch_assoc($result)) {
        if ($row['jenis'] === 'pemasukan') {
            $total_pemasukan += $row['jumlah'];
        }
        if ($row['jenis'] === 'pengeluaran') {
            $total_pengeluaran += $row['jumlah'];
        }
    }

    $saldo_akhir = $total_pemasukan - $total_pengeluaran;
    $data = [
        "total_pemasukan" => $total_pemasukan,
        "total_pengeluaran" => $total_pengeluaran,
        "saldo_akhir" => $saldo_akhir
    ];
    echo json_encode($data);
} else {
    http_response_code(405); // 405 = Method Not Allowed
    echo json_encode([
        "error" => true,
        "message" => "Only POST are allowed."
    ]);
    exit;
}

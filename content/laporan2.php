<?php
if (!defined("INDEX")) die("");

// Inisialisasi variabel
$dataTransaksi = [];
$tahun = isset($_POST['tahun']) ? $_POST['tahun'] : '';
$bulan = isset($_POST['bulan']) ? $_POST['bulan'] : '';

// Proses form jika ada data yang dikirimkan
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tahun = $_POST['tahun'];
    $bulan = $_POST['bulan'];

    // Query untuk mengambil data berdasarkan bulan dan tahun
    global $con;
    $query = "SELECT 
                    tanggal,
                    nama,
                    kategori,
                    nominal,
                    rincian
              FROM transaksi 
              WHERE YEAR(tanggal) = ? AND MONTH(tanggal) = ?";
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, 'ii', $tahun, $bulan);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    $dataTransaksi = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $dataTransaksi[] = $row;
    }
    mysqli_stmt_close($stmt); // Tutup statement
}

// Fungsi untuk menghasilkan PDF
function generatePDF($data, $tahun, $bulan) {
    require('fpdf/fpdf.php');

    // Array nama bulan dalam bahasa Indonesia
    $namaBulan = [
        1 => 'Januari',
        2 => 'Februari',
        3 => 'Maret',
        4 => 'April',
        5 => 'Mei',
        6 => 'Juni',
        7 => 'Juli',
        8 => 'Agustus',
        9 => 'September',
        10 => 'Oktober',
        11 => 'November',
        12 => 'Desember'
    ];
    
    // Ambil nama bulan dari array
    $namaBulanCetak = isset($namaBulan[$bulan]) ? $namaBulan[$bulan] : '';

    // Inisialisasi PDF
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 16);
    $pdf->Cell(0, 10, 'Laporan Transaksi Bulan '.$namaBulanCetak.' Tahun '.$tahun, 0, 1, 'C');

    // Header tabel
    $pdf->SetFont('Arial', 'B', 12);
    
    // Style tabel
    $pdf->SetXY(10, 30); // Ubah nilai Y menjadi 30
    $pdf->Cell(10, 7, 'No',1,0,'C');
    $pdf->Cell(30, 7, 'Tanggal',1,0,'C');
    $pdf->Cell(40, 7, 'Nama',1,0,'C');
    $pdf->Cell(40, 7, 'Kategori',1,0,'C');
    $pdf->Cell(30, 7, 'Nominal',1,0,'C');
    $pdf->Cell(40, 7, 'Rincian',1,0,'C');
    $pdf->Ln();

    // Data tabel
    $pdf->SetFont('Arial', '', 10);
    $totalNominal = 0; // Variabel untuk menyimpan total nominal

    if (count($data) > 0) {
        $y = 37; // Ubah nilai Y menjadi 37
        $no = 1;
        foreach ($data as $row) {
            $pdf->SetXY(10, $y);
            $pdf->Cell(10, 6, $no++, 1, 0, 'C'); // Alignment center
            $pdf->Cell(30, 6, $row['tanggal'], 1, 0, 'C');
            $pdf->Cell(40, 6, $row['nama'], 1, 0, 'C');
            $pdf->Cell(40, 6, $row['kategori'], 1, 0, 'C');
            $pdf->Cell(30, 6, rupiah($row['nominal']), 1, 0, 'C');
            // Menggunakan html_entity_decode untuk memastikan karakter khusus ditampilkan dengan benar
            $pdf->Cell(40, 6, html_entity_decode($row['rincian']), 1, 0, 'C');        
            $pdf->Ln();
            $y += 6;

            // Tambahkan nominal ke total
            $totalNominal += $row['nominal'];
        }

        // Tambahkan baris total di bawah tabel
        $pdf->SetXY(10, $y);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(120, 6, 'Total', 1, 0, 'C');
        $pdf->Cell(30, 6, rupiah($totalNominal), 1, 0, 'C');
        $pdf->Cell(40, 6, '', 1, 0, 'C');
        
    }else{
        $pdf->SetFont('Arial', 'I', 10);
        $pdf->SetXY(10, 47);
        $pdf->Cell(190, 7, 'Data tidak ditemukan', 0, 0, 'C');
    }

    ob_clean();
    return @$pdf->Output('D', 'laporan_transaksi.pdf');
}

?>

<section class="content">
    <div class="box box-body">
        <div class="box-header with-border">
            <h3 class="box-title">Laporan</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <form action="" method="POST">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Tahun</label>
                            <select class="form-control" name="tahun" id="tahunSelect">
                                <option value="">Pilih Tahun</option>
                                <?php for($y=2020; $y<=date('Y'); $y++): ?>
                                <option value="<?=$y?>" <?=($y==$tahun)?'selected':''?>><?=$y?></option>
                                <?php endfor; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Bulan</label>
                            <select class="form-control" name="bulan" id="bulanSelect">
                                <option value="">Pilih Bulan</option>
                                <?php 
                                $namaBulan = array(
                                    1 => 'Januari',
                                    2 => 'Februari',
                                    3 => 'Maret',
                                    4 => 'April',
                                    5 => 'Mei',
                                    6 => 'Juni',
                                    7 => 'Juli',
                                    8 => 'Agustus',
                                    9 => 'September',
                                    10 => 'Oktober',
                                    11 => 'November',
                                    12 => 'Desember'
                                );
                                for ($m=1; $m<=12; $m++): ?>
                                <option value="<?=$m?>" <?=($m==$bulan)?'selected':''?>>
                                    <?=$namaBulan[$m]?>
                                </option>
                                <?php endfor; ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6" style="margin-top:25px; margin-bottom: 20px;">
                        <button type="submit" class="btn btn-primary">Cek Transaksi</button>
                        <?php if ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
                        <a href="?hal=laporan&cetak=pdf&tahun=<?=$tahun?>&bulan=<?=$bulan?>"
                            class="btn btn-success">Cetak PDF</a>
                        <?php endif; ?>
                    </div>
                </div>
            </form>

            <div class="table-responsive">
                <table id="example2" class="table table-bordered table-striped" style="border-color: #ddd;">
                    <thead>
                        <tr style="background: #2c3e50; color: white;">
                            <th style="border-color: #ddd;">No</th>
                            <th style="border-color: #ddd;">Tanggal</th>
                            <th style="border-color: #ddd;">Nama</th>
                            <th style="border-color: #ddd;">Kategori</th>
                            <th style="border-color: #ddd;">Nominal</th>
                            <th style="border-color: #ddd;">Rincian</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($dataTransaksi)): ?>
                        <?php foreach ($dataTransaksi as $index => $row): ?>
                        <tr>
                            <td style="border-color: #ddd;"><?= ($index + 1) ?></td>
                            <td style="border-color: #ddd;"><?= $row['tanggal'] ?></td>
                            <td style="border-color: #ddd;"><?= $row['nama'] ?></td>
                            <td style="border-color: #ddd;"><?= $row['kategori'] ?></td>
                            <td style="border-color: #ddd;"><?= rupiah($row['nominal'])?></td>
                            <td style="border-color: #ddd;"><?= $row['rincian'] ?></td>
                        </tr>
                        <?php endforeach; ?>
                        <?php else: ?>
                        <tr>
                            <td colspan="6">Tidak ada data</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

<?php
// Handle request cetak PDF
if (isset($_GET['cetak']) && $_GET['cetak'] === 'pdf') {
    // Ambil tahun dan bulan dari URL
    $tahun = $_GET['tahun'] ?? date('Y');
    $bulan = $_GET['bulan'] ?? date('m');

    // Query untuk mengambil data transaksi
    global $con;
    $query = "SELECT 
                    tanggal,
                    nama,
                    kategori,
                    nominal,
                    rincian
              FROM transaksi 
              WHERE YEAR(tanggal) = ? AND MONTH(tanggal) = ?";
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, 'ii', $tahun, $bulan);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    $dataTransaksi = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $dataTransaksi[] = $row;
    }
    
    generatePDF($dataTransaksi, $tahun, $bulan);
    mysqli_stmt_close($stmt); // Tutup statement
}
?>

<script>
// Reset dropdown ke "Pilih Tahun" dan "Pilih Bulan" hanya saat refresh halaman
document.addEventListener("DOMContentLoaded", function() {
    <?php if (!$_SERVER['REQUEST_METHOD'] === 'POST'): ?>
    document.getElementById("tahunSelect").value = "";
    document.getElementById("bulanSelect").value = "";
    <?php endif; ?>
});
</script>
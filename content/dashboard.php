<?php
if (!defined('INDEX')) die("");

/*
    $pemasukan = mysqli_fetch_assoc(mysqli_query($con, "
    SELECT SUM(nominal) AS data 
    FROM transaksi 
    WHERE nominal > 0 AND MONTH(tanggal) = MONTH(CURDATE()) AND YEAR(tanggal) = YEAR(CURDATE())
    "));

    $pengeluaran = mysqli_fetch_assoc(mysqli_query($con, "
        SELECT SUM(nominal) AS data 
        FROM transaksi 
        WHERE nominal < 0 AND MONTH(tanggal) = MONTH(CURDATE()) AND YEAR(tanggal) = YEAR(CURDATE())
    "));

    $saldo = mysqli_fetch_assoc(mysqli_query($con, "
        SELECT SUM(nominal) AS data 
        FROM transaksi 
        WHERE MONTH(tanggal) = MONTH(CURDATE()) AND YEAR(tanggal) = YEAR(CURDATE())
    ")); */

$pemasukan = mysqli_fetch_assoc(mysqli_query($con, "
    SELECT SUM(x.jumlah) as data FROM (SELECT
    'pemasukan' AS jenis,
    d.jumlah
FROM
    donasi d
WHERE
    d.status_verifikasi = 'verifikasi' AND MONTH(d.tanggal_donasi) = MONTH(CURDATE()) AND YEAR(d.tanggal_donasi) = YEAR(CURDATE())
UNION ALL
SELECT
    k.jenis,
    k.jumlah
FROM
    keuangan k
WHERE
    MONTH(k.tanggal) = MONTH(CURDATE()) AND YEAR(k.tanggal) = YEAR(CURDATE())) x WHERE x.jenis = 'pemasukan';
    "));

$pengeluaran = mysqli_fetch_assoc(mysqli_query($con, "
    SELECT SUM(x.jumlah) as data FROM (SELECT
    'pemasukan' AS jenis,
    d.jumlah
FROM
    donasi d
WHERE
    d.status_verifikasi = 'verifikasi' AND MONTH(d.tanggal_donasi) = MONTH(CURDATE()) AND YEAR(d.tanggal_donasi) = YEAR(CURDATE())
UNION ALL
SELECT
    k.jenis,
    k.jumlah
FROM
    keuangan k
WHERE
    MONTH(k.tanggal) = MONTH(CURDATE()) AND YEAR(k.tanggal) = YEAR(CURDATE())) x WHERE x.jenis = 'pengeluaran';
    "));

$saldo['data'] = $pemasukan['data'] - $pengeluaran['data'];
?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Dashboard
    </h1>
</section>

<!-- Main content -->
<section class="content container-fluid">

    <div class="row">
        <div class="col-lg-4 col-sm-6 col-xs-12">
            <!-- small box -->
            <div class="small-box bg-green" style="padding-top: 5px; padding-bottom: 5px">
                <div class="inner">
                    <h3><?= rupiah($pemasukan['data'] ?? 0) ?></h3>

                    <p>Pemasukan Bulan Ini</p>
                </div>
                <div class="icon">
                    <i class="ion ion-ios-cart"></i>
                </div>
                <!-- <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> -->
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-4 col-sm-6 col-xs-12">
            <!-- small box -->
            <div class="small-box bg-aqua" style="padding-top: 5px; padding-bottom: 5px">
                <div class="inner">
                    <h3><?= rupiah(abs($pengeluaran['data'] ?? 0)) ?></h3>

                    <p>Pengeluaran Bulan Ini</p>
                </div>
                <div class="icon">
                    <i class="ion ion-arrow-graph-down-left"></i>
                </div>
                <!-- <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> -->
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-4 col-sm-6 col-xs-12">
            <!-- small box -->
            <div class="small-box bg-yellow" style="padding-top: 5px; padding-bottom: 5px">
                <div class="inner">
                    <h3><?= rupiah($saldo['data'] ?? 0) ?></h3>

                    <p>Saldo Akhir Bulan Ini</p>
                </div>
                <div class="icon">
                    <i class="ion ion-cash"></i>
                </div>
                <!-- <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> -->
            </div>
        </div>
    </div>

    <!-- Kegiatan -->
    <div class="box box-body">
        <div class="box-header with-border">
            <h3 class="box-title">Agenda & Kegiatan Mendatang</h3>
        </div>
        <!-- box body -->
        <div class="box-body">
            <div class="row">
                <?php
                $query_activity = "SELECT nama_kegiatan, lokasi, tanggal_mulai FROM kegiatan_masjid ORDER BY id_kegiatan DESC LIMIT 3";
                $result = mysqli_query($con, $query_activity);
                while ($data = mysqli_fetch_assoc($result)) {
                    $date = new DateTime($data['tanggal_mulai']);
                    $tanggal = $date->format('d');
                    $tahun = $date->format('Y');
                    $angka_bulan = $date->format('m');
                    $map_bulan = mapMonth();
                    $bulan = $map_bulan[$angka_bulan];
                ?>
                    <!-- Start box activity -->
                    <div class="col-lg-4 col-sm-6 col-xs-12">
                        <!-- small box -->
                        <div style="border: 1px solid rgba(0,0,0,0.08); border-radius: 8px; padding: 8px 20px; margin: 3px; max-width: 420px;">
                            <div>
                                <div class="row">
                                    <!-- left box -->
                                    <div class="col-lg-3 text-center" style="background-color: #f4f4f4; border-radius: 8px; padding: 5px;">
                                        <span><?= $bulan ?></span><br />
                                        <span style="font-size: 1.2em; font-weight: 600;"><?= $tanggal ?> </span><br />
                                        <span><?= $tahun ?></span><br />
                                    </div>
                                    <!-- right box -->
                                    <div class="col-lg-9">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <h4><?= $data['nama_kegiatan'] ?></h4>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12"><?= $data['lokasi'] ?></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End box activity -->
                <?php } ?>
            </div>
        </div>
    </div>

    <!-- Donasi/Transaksi -->
    <div class="box box-body">
        <div class="box-header with-border">
            <h3 class="box-title">Donasi/Transaksi Terbaru</h3>
        </div>
        <!-- box body -->
        <div class="box-body">
            <div class="row">
                <?php
                $sql_donasi = "SELECT u.nama, d.jumlah, d.status_verifikasi FROM donasi d INNER JOIN users u ON d.id_user = u.id_user ORDER BY d.id_donasi DESC LIMIT 3";
                $result = mysqli_query($con, $sql_donasi);
                while ($data = mysqli_fetch_assoc($result)) {
                ?>
                    <!-- start donasi card -->
                    <div class="col-lg-4 col-sm-6 col-xs-12">
                        <!-- small box -->
                        <div style="border: 1px solid rgba(0,0,0,0.08); border-radius: 8px; padding: 8px 20px; margin: 3px; max-width: 420px;">
                            <div class="row">
                                <div class="col-lg-8" style="vertical-align: middle;">
                                    <h4><?= rupiah($data['jumlah']) ?></h4>
                                </div>
                                <div class="col-lg-4" style="vertical-align: middle;"><span class="<?= htmlspecialchars($data['status_verifikasi']) === 'verifikasi' ? 'bg-success' : (htmlspecialchars($data['status_verifikasi']) === 'pending' ? 'bg-info' : 'bg-warning') ?>" style="padding: 4px 12px; border-radius: 999px; font-size: 12px; font-weight: 600;"><?= strtoupper(htmlspecialchars($data['status_verifikasi'])) ?></span></div>
                            </div>
                            <div class="row" style="margin-top: 14px;">
                                <div class="col-lg-12"><?= htmlspecialchars($data['nama']) ?></div>
                            </div>
                        </div>
                    </div>
                    <!-- end donasi card -->
                <?php } ?>
            </div>
        </div>
    </div>
</section>
<!-- /.content -->
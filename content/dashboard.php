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
</section>
<!-- /.content -->
<?php
    if(!defined("INDEX")) die();

    $halaman = [
        "dashboard",
        "transaksi",
        "transaksi-tambah",
        "transaksi-insert",
        "transaksi-edit",
        "transaksi-update",
        "transaksi-hapus",
        "laporan2",
        "laporan2-cetak",
        "pengguna",
        "pengguna-tambah",
        "pengguna-insert",
        "pengguna-edit",
        "pengguna-update",
        "pengguna-hapus",
        "masjid",
        "masjid-edit",
        "masjid-update",
        "kegiatan-masjid",
        "kegiatan-masjid-tambah",
        "kegiatan-masjid-insert",
        "kegiatan-masjid-edit",
        "kegiatan-masjid-update",
        "kegiatan-masjid-hapus",
        "kategori-keuangan",
        "kategori-keuangan-tambah",
        "kategori-keuangan-insert",
        "kategori-keuangan-edit",
        "kategori-keuangan-update",
        "kategori-keuangan-hapus",
        "donasi",
        "donasi-tambah",
        "donasi-insert",
        "donasi-edit",
        "donasi-update",
        "donasi-hapus",
        "keuangan",
        "keuangan-tambah",
        "keuangan-insert",
        "keuangan-edit",
        "keuangan-update",
        "keuangan-hapus",
        "laporan",
        "laporan-tambah",
        "laporan-insert",
        "laporan-hapus",
        "laporan-data-ajax"
    ];

    if (isset($_GET['hal'])) {
        $hal = $_GET['hal'];
    } else {
        $hal = "dashboard";
    }

    foreach($halaman as $h){
        if($hal == $h){
            include "content/$h.php";
            break;
        }
    }
?>
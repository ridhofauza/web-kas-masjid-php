<?php
// Tentukan judul halaman berdasarkan parameter 'hal'
$page = isset($_GET['hal']) ? $_GET['hal'] : 'dashboard';

switch ($page) {
    case 'dashboard':
        $title = "Kas Masjid | Dashboard";
        break;
    case 'transaksi':
    case 'transaksi-tambah':
    case 'transaksi-insert':
    case 'transaksi-edit':
    case 'transaksi-update':
    case 'transaksi-hapus':
        $title = "Kas Masjid | Transaksi";
        break;
    case 'laporan':
        $title = "Kas Masjid | Laporan";
        break;
    case 'pengguna':
    case 'pengguna-tambah':
    case 'pengguna-insert':
    case 'pengguna-edit':
    case 'pengguna-update':
    case 'pengguna-hapus':
        $title = "Kas Masjid | Pengguna";
        break;
    case 'masjid':
    case 'masjid-edit':
    case 'masjid-update':
        $title = "Kas Masjid | Masjid";
        break;
    case 'kegiatan-masjid':
    case 'kegiatan-masjid-tambah':
    case 'kegiatan-masjid-insert':
    case 'kegiatan-masjid-edit':
    case 'kegiatan-masjid-update':
    case 'kegiatan-masjid-hapus':
        $title = "Kas Masjid | Kegiatan Masjid";
        break;
    case 'kategori-keuangan':
    case 'kategori-keuangan-tambah':
    case 'kategori-keuangan-insert':
    case 'kategori-keuangan-edit':
    case 'kategori-keuangan-update':
    case 'kategori-keuangan-hapus':
        $title = "Kas Masjid | Kategori Keuangan";
        break;
    case 'donasi':
    case 'donasi-tambah':
    case 'donasi-insert':
    case 'donasi-edit':
    case 'donasi-update':
    case 'donasi-hapus':
        $title = "Kas Masjid | Donasi";
        break;
    case 'keuangan':
    case 'keuangan-tambah':
    case 'keuangan-insert':
    case 'keuangan-edit':
    case 'keuangan-update':
    case 'keuangan-hapus':
        $title = "Kas Masjid | Keuangan";
        break;
    default:
        $title = "Kas Masjid | Halaman Tidak Ditemukan";
}
?>

<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title><?= $title ?></title>
<!-- Tell the browser to be responsive to screen width -->
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
<!-- Font Awesome -->
<link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
<!-- Ionicons -->
<link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
<!-- Select2 -->
<link rel="stylesheet" href="bower_components/select2/dist/css/select2.min.css">
<!-- Theme style -->
<link rel="stylesheet" href="dist/css/AdminLTE.min.css">
<!-- AdminLTE Skins. We have chosen the skin-blue for this starter
        page. However, you can choose any other skin. Make sure you
        apply the skin class to the body tag so the changes take effect. -->
<link rel="stylesheet" href="dist/css/skins/skin-green.min.css">

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

<!-- Google Font -->
<link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

<!-- DataTables -->
<link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
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
    case 'laporan2':
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
    case 'laporan':
    case 'laporan-tambah':
    case 'laporan-insert':
    case 'laporan-hapus':
        $title = "Kas Masjid | Laporan";
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
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<!-- DataTables -->
<link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">

<style>
    body {
        font-family: "Poppins", sans-serif;
    }

    .sidebar-menu li {
        padding: 2px 0px;
        background-color: #ffffff;
        border-top: 1px solid #e0dede;
        color: #637381;
        font-weight: 500;
    }

    .sidebar-menu li ul li {
        padding: 2px 0px;
        border-top: 1px solid #e0dede;
    }

    .skin-green .sidebar a {
        color: #637381;
    }

    .main-sidebar {
        background-color: #ffffff;
    }

    .skin-green .sidebar-menu .treeview-menu>li>a {
        color: #637381;
    }

    .skin-green .sidebar-menu>li>.treeview-menu {
        background: #c4c4c4;
    }

    .skin-green .sidebar-menu>li.active>a {
        border-left: none;
    }

    .skin-green .sidebar-menu>li:hover>a,
    .skin-green .sidebar-menu>li.active>a,
    .skin-green .sidebar-menu>li.menu-open>a {
        color: #007867;
        background-color: #c8fad6;
    }

    .skin-green .sidebar-menu>li:hover,
    .skin-green .sidebar-menu>li.active,
    .skin-green .sidebar-menu>li.menu-open {
        white-space: nowrap;
        overflow: hidden;
        color: #637382;
        margin: .125rem .5rem;
        background-color: rgba(0, 0, 0, 0);
        line-height: 1.2;
    }

    .skin-green .sidebar-menu .treeview-menu>li.active>a,
    .skin-green .sidebar-menu .treeview-menu>li>a:hover {
        color: #637381;
        background-color: #f4f4f4;
        margin-right: 1em;
    }
</style>
<?php
session_start();
ob_start(); // Memastikan tidak ada output sebelum header

include "library/config.php";
include "library/functions.php";

// Periksa apakah session sudah diset
if (empty($_SESSION['username'])) {
   header('location: login.php'); // Redirect ke halaman login jika belum login
   exit();
} else {
   define("INDEX", true);
}

if (!defined("INDEX")) die();

$halaman = [
   "404-json",
   "laporan-data-ajax"
];

if (isset($_GET['hal'])) {
   $hal = $_GET['hal'];
} else {
   $hal = "404-json";
}

foreach ($halaman as $h) {
   if ($hal == $h) {
      include "content/$h.php";
      break;
   }
}

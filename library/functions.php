<?php

function rupiah ($angka) {
    $hasil = 'Rp ' . number_format($angka, 0, ",", ".");
    return $hasil;
}

function paymentMethod($metode) {
    $hasil = $metode;
    switch($metode) {
        case 'transfer_bank': 
            $hasil = 'Transfer Bank';
            break;
        case 'qris': 
            $hasil = 'QRIS';
            break;
        case 'tunai': 
            $hasil = 'Tunai';
            break;
        default: 
            $hasil = $metode;
    }
    return $hasil;
}

function mapMonth() {
    return [
        1  => 'Januari',
        2  => 'Februari',
        3  => 'Maret',
        4  => 'April',
        5  => 'Mei',
        6  => 'Juni',
        7  => 'Juli',
        8  => 'Agustus',
        9  => 'September',
        10 => 'Oktober',
        11 => 'November',
        12 => 'Desember'
    ];    
}

?>
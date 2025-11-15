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

?>
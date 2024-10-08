<?php
require "functions.php";

$db = connectDB();

// Ambil ID dari parameter URL
$get_id = $_GET['id'];

// Pastikan ID ada
if (isset($get_id) && !empty($get_id)) {
    if (hapusData($db, $get_id)) {
        header('Location: dashboard.php');
        exit(); 
    } else {
        echo "Hapus data gagal: " . $db->lastErrorMsg();
    }
} else {
    echo "ID tidak ditemukan.";
}

<?php

$db = new SQLite3('whatsaap.sqlite');
if (!$db) {
    echo $db->lastErrorMsg();
    exit();
}

// Buat tabel nomor
$query_buat_tabel_simpan_nomor= 'CREATE TABLE IF NOT EXISTS simpan_whatsaap(
    id_nomor INTEGER PRIMARY KEY AUTOINCREMENT,
    nama TEXT NOT NULL,
    nomor TEXT NOT NULL
)';

$db->query($query_buat_tabel_simpan_nomor);
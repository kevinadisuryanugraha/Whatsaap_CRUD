<?php
// Koneksi database
function connectDB() {
    $db = new SQLite3('whatsaap.sqlite');
    if (!$db) {
        echo $db->lastErrorMsg();
        exit();
    }
    return $db;
}

// Membuat tabel
function createTable($db) {
    $query_buat_tabel_simpan_nomor = 'CREATE TABLE IF NOT EXISTS simpan_whatsaap(
        id_nomor INTEGER PRIMARY KEY AUTOINCREMENT,
        nama TEXT NOT NULL,
        nomor TEXT NOT NULL
    )';
    return $db->query($query_buat_tabel_simpan_nomor);
}

// Tambah data
function tambahData($db, $nama, $nomor) {
    if (!empty($nomor) && !empty($nama)) {
        $query_tambah_data = "INSERT INTO simpan_whatsaap (nama, nomor) VALUES ('$nama', '$nomor')";
        if ($db->exec($query_tambah_data)) {
            return true;
        }
    }
    return false;
}

// Update data
function updateData($db, $id, $nama, $nomor) {
    if (!empty($nomor) && !empty($nama)) {
        $query_update_data = "UPDATE simpan_whatsaap SET nama='$nama', nomor='$nomor' WHERE id_nomor='$id'";
        if ($db->exec($query_update_data)) {
            return true;
        }
    }
    return false;
}

// Tampilkan data
function tampilkanData($db) {
    $query_tampilkan_simpan_whatsaap = 'SELECT * FROM simpan_whatsaap';
    return $db->query($query_tampilkan_simpan_whatsaap);
}

// Hapus data
function hapusData($db, $id) {
    $query_hapus = "DELETE FROM simpan_whatsaap WHERE id_nomor='$id'";
    return $db->query($query_hapus);
}
<?php

require "db.php";

// Ambil parameter 'id' dari URL
$get_id = isset($_GET['id']) ? $_GET['id'] : 0;

function get_data_edit($id)
{
    global $db;
    $query_get_data_edit = "SELECT id_nomor, nama, nomor FROM simpan_whatsaap WHERE id_nomor='$id'";
    $ambil_data_edit = $db->query($query_get_data_edit);
    if ($ambil_data_edit) {
        return $ambil_data_edit->fetchArray(SQLITE3_ASSOC);
    } else {
        return false; // Jika query gagal, kembalikan false
    }
}

// Handle update data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];
    $nomor = $_POST['nomor'];

    if (!empty($nama) && !empty($nomor)) {
        $query_update_data = "UPDATE simpan_whatsaap SET nama='$nama', nomor='$nomor' WHERE id_nomor='$get_id'";
        if ($db->exec($query_update_data)) {
            header("Location: dashboard.php");
            exit();
        } else {
            echo "Gagal memperbarui data!";
        }
    } else {
        echo "Semua field harus diisi!";
    }
}

$data_edit = get_data_edit($get_id);

// Cek apakah data ditemukan
if (!$data_edit) {
    echo "Data tidak ditemukan.";
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kirim Whatsaap</title>
    <style>
        body {
            margin: 0;
        }

        .jumbotron {
            background-color: green;
            height: auto;
            margin-top: -20px;
        }

        .header {
            margin: 1rem;
            padding: 0.5rem 1rem 1rem 1rem;
            color: white;
            font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        }

        .navigasi {
            height: auto;
            margin-top: -16px;
        }

        .navigasi nav ul {
            padding: 10px;
            display: flex;
            list-style: none;
        }

        .navigasi nav ul li a {
            text-decoration: none;
            font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
            padding: 2px;
            margin-left: 10px;
            color: #333;
            font-size: 18px;
            transition: 0.3s ease-in-out;
        }

        .navigasi nav ul li a:hover {
            border-bottom: 4px solid black;
        }

        .container {
            padding: 10px 20px;
        }

        .container form {
            width: 100%;
            height: auto;
        }

        .container form input {
            width: 100%;
            padding: 12px;
            margin-bottom: 10px;
        }

        .container form #nomor, #nama {
            width: 98%;
        }

        .container form #submit {
            background-color: green;
            color: white;
            border: none;
            cursor: pointer;
        }

        .table {
            padding: 20px
        }

        .table table {
            font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
            border: 1px solid black;
            text-align: center;
        }

        .table table tr th {
            padding: 10px 20px;
            border: 1px solid black;
            background-color: yellow;
        }

        .table table tr td {
            padding: 10px 20px;
            border: 1px solid black;
        }
    </style>
</head>

<body>
    <div class="jumbotron">
        <div class="header">
            <h1>Kirim Whatsaap Tanpa perlu simpan Nomor</h1>
            <br>
            <h2>Cepat dan mudah. Tidak perlu instalasi</h2>
        </div>
    </div>

    <div class="navigasi">
        <nav>
            <ul>
                <li>
                    <a href="index.php">kirim WA</a>
                </li>
                <li>
                    <a href="dashboard.php">Dashboard WA</a>
                </li>
            </ul>
        </nav>
    </div>

    <div class="container">
        <form action="" method="POST">
            <label for="nama">Masukkan nama Anda</label>
            <input type="text" name="nama" id="nama" value="<?php echo htmlspecialchars($data_edit['nama']); ?>">

            <label for="number">Masukkan Nomor Anda</label>
            <input type="number" name="nomor" id="nomor" value="<?php echo htmlspecialchars($data_edit['nomor']); ?>">
            <br>
            <input type="submit" name="submit" id="submit" onclick="return confirm('yakin nih sudah benar ?')">
        </form>
    </div>
</body>

</html>
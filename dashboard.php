<?php
require "functions.php";

$db = connectDB();
createTable($db);

if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $nomor = $_POST['nomor'];
    
    if (tambahData($db, $nama, $nomor)) {
        echo "<script>alert('Sudah masuk nih kangg')</script>";
    } else {
        echo "<script>alert('Harus diisi semua atuh kangg')</script>";
    }
}

if (isset($_POST['update'])) {
    $id = $_POST['id_nomor'];
    $nama = $_POST['nama'];
    $nomor = $_POST['nomor'];
    
    if (updateData($db, $id, $nama, $nomor)) {
        echo "<script>alert('Data berhasil diupdate')</script>";
    } else {
        echo "<script>alert('Semua field harus diisi')</script>";
    }
}

$result = tampilkanData($db);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kirim Whatsaap</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
        }

        .jumbotron {
            background-color: green;
            height: auto;
            margin-top: -20px;
            padding: 20px;
        }

        .header {
            margin: 1rem;
            padding: 0.5rem 1rem 1rem 1rem;
            color: white;
        }

        .navigasi {
            height: auto;
            margin-top: -16px;
            background-color: #f8f8f8;
        }

        .navigasi nav ul {
            padding: 10px;
            display: flex;
            list-style: none;
        }

        .navigasi nav ul li a {
            text-decoration: none;
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
            padding: 20px;
        }

        .container form {
            width: 100%;
            max-width: 500px;
            margin: 0 auto;
        }

        .container form input {
            width: 100%;
            padding: 12px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .container form #submit {
            background-color: green;
            color: white;
            border: none;
            cursor: pointer;
        }

        .table {
            padding: 20px;
        }

        .table table {
            width: 100%;
            border-collapse: collapse;
        }

        .table table th,
        .table table td {
            padding: 15px;
            border: 1px solid #ddd;
            text-align: left;
        }

        .table table th {
            background-color: #347928;
            text-align: center;
            color: #fff;
        }

        .edit-form input[type="text"],
        .edit-form input[type="number"] {
            width: calc(47% - 5px);
            height: 30px;
            padding: 5px;
            margin-bottom: 10px;
        }

        .edit-form input[type="submit"] {
            background-color: green;
            color: white;
            border: none;
            padding: 5px 20px;
            cursor: pointer;
            font-size: 20px;
        }

        .edit-form .close {
            background-color: red;
            padding:5px 20px;
            text-decoration: none;
            color: #fff;
            font-size: 20px;
        }

        .table .action-links {
            text-align:center;
        }

        .action-links .tombol_edit
        {
            background-color: #4379F2;
            color: white;
            border-radius: 5px;
            padding:10px;
        }

        
        .action-links .tombol_delete {
            background-color: #E4003A;
            color: white;
            border-radius: 5px;
            padding:10px;
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
            <input type="text" name="nama" id="nama" required>

            <label for="nomor">Masukkan Nomor Anda</label>
            <input type="number" name="nomor" id="nomor" required>
            <br>
            <input type="submit" name="submit" id="submit" value="Tambah Kontak" onclick="return confirm('yakin nih sudah benar ?')">
        </form>
    </div>

    <div class="table">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Kontak</th>
                    <th>Nomor Kontak</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
                    $edit_mode = isset($_GET['edit']) && $_GET['edit'] == $row['id_nomor'];
                    echo "<tr>";
                    echo "<td>{$no}</td>";
                    
                    if ($edit_mode) {
                        echo "<td colspan='3'>
                            <form class='edit-form' action='' method='POST'>
                                <input type='hidden' name='id_nomor' value='{$row['id_nomor']}'>
                                <input type='text' name='nama' value='{$row['nama']}' placeholder='Nama' required>
                                <br>
                                <input type='number' name='nomor' value='{$row['nomor']}' placeholder='Nomor' required>
                                <br>
                                <input type='submit' name='update' value='Update'>
                                <a class='close' href='dashboard.php'>Batal</a>
                            </form>
                        </td>";
                    } else {
                        echo "<td>{$row['nama']}</td>";
                        echo "<td><a href='https://wa.me/{$row['nomor']}'>{$row['nomor']}</a></td>";
                        echo "<td class='action-links'>
                            <a class='tombol_edit' href='?edit={$row['id_nomor']}'><i class='fa-solid fa-pen-to-square'></i></a>
                            <a class='tombol_delete' href='delete.php?id={$row['id_nomor']}' onclick=\"return confirm('Apakah Anda yakin ingin menghapus kontak ini?');\"><i class='fa-solid fa-trash'></i></a>
                        </td>";
                    }
                    echo "</tr>";
                    $no++;
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>
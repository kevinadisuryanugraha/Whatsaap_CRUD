<?php

require "db.php";

if (isset($_POST['submit'])) {
    $nomor = $_POST['nomor'];
    
    if (!empty($nomor)) {
        $query_tambah_data = "INSERT INTO nomor_whatsaap (nomor) VALUES ('$nomor')";
        if ($db->exec($query_tambah_data)) {
            echo "<script>
                alert('Sudah masuk nih kangg')
                window.location='https://wa.me/$nomor';
            </script>";
        } else {
            echo "Eror tidak berhasil euyy";
        }
    } else {
        echo "<script>
                alert('Harus diisi semua atuh kangg')
                window.location='index.php';
            </script>";
    }
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

        .container form  {
            width: 100%;
            height: auto;
        }

        .container form input {
            width: 100%;
            padding: 12px;
            margin-bottom: 10px;
        }

        .container form #nomor {
            width: 98%;
        }

        .container form #submit {
            background-color: green;
            color: white;
            border: none;
            cursor: pointer;
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
            <input type="number" name="nomor" id="nomor">
            <br>
            <input type="submit" name="submit" id="submit" onclick="return confirm('yakin nih sudah benar ?')">
        </form>
    </div>
</body>
</html>
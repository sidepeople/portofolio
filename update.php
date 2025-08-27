<?php
require 'functions.php';

// ambil data URL
$id = $_GET["id"];

// query data siswa berdasarkan id
$ubahDB = query("SELECT * FROM siswa WHERE id = $id")[0];

// mengecek apakah tombol submit sudah ditekan atau belum
if( isset($_POST["submit"]) ) {

    // mengecek apakah data berhasil diubah atau tidak
    if( update($_POST) > 0 ) {
        echo "
        <script>
            alert('data berhasil DIUPDATE!!!');
            document.location.href = 'laporan.php';
        </script>
        ";
    } else {
        echo "
        <script>
            alert('data GAGAL DIUPDATE!!!');
            document.location.href = 'laporan.php';
        </script>
        ";
    }
}
?>
<!DOCTYPE html>
<html>
    <title>UPDATE data siswa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            color: #333;
            margin-top: 30px;
        }

        form {
            width: 400px;
            margin: 30px auto;
            padding: 20px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        ul {
            list-style: none;
            padding: 0;
        }

        li {
            margin-bottom: 15px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
            color: #555;
        }

        input[type="text"],
        input[type="file"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
            outline: none;
            transition: border-color 0.3s;
        }

        input[type="text"]:focus,
        input[type="file"]:focus {
            border-color: #007bff;
        }

        img {
            margin-top: 5px;
            border-radius: 5px;
        }

        button {
            background: #007bff;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            transition: background 0.3s;
        }

        button:hover {
            background: #0056b3;
        }
    </style>

<head>
    <title>UPDATE data siswa</title>
</head>
<body>
    <h1>UPDATE data siswa</h1>

    <form action="" method="post">
        <input type="hidden" name="id" value="<?= $ubahDB["id"]; ?>">
        <ul>
            <li>
                <label for="nama">Nama : </label>
                <input type="text" name="nama" id="nama" required value="<?= $ubahDB["nama"]; ?>">
            </li>
            <li>
                <label for="nim">NIS : </label>
                <input type="text" name="nim" id="nim" required value="<?= $ubahDB["nim"]; ?>">
            </li>
            <li>
                <label for="email">Email : </label>
                <input type="text" name="email" id="email" required value="<?= $ubahDB["email"]; ?>">
            </li>
            <li>
                <label for="jurusan">Jurusan : </label>
                <input type="text" name="jurusan" id="jurusan" required value="<?= $ubahDB["jurusan"]; ?>">
            </li>
            <li>
                <label for="gambar">Gambar : </label> <br>
                <img src="img/<?= $ubahDB['gambar']; ?>" width="50"> <br>
                <input type="file" name="gambar" id="gambar">
            </li>
            <li>
                <button type="submit" name="submit">UPDATE Data!</button>
            </li>
        </ul>
    </form>
</body>
</html>

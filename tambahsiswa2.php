<?php
require "koneksi.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Siswa</title>
    <style>
        /* Styling dasar */
        body {
            background-image: url("bg.jpg");
            background-size: cover;
            font-family: Arial, sans-serif;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            color: #333;
        }

        /* Container form */
        .container {
            background-color: rgba(255, 255, 255, 0.9);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 8px;
            padding: 20px;
            width: 90%;
            max-width: 500px;
            text-align: center;
            margin: 20px;
        }

        h1 {
            color: #333;
            margin-bottom: 20px;
            font-size: 24px;
        }

        img {
            margin-bottom: 20px;
        }

        /* Tabel form */
        table {
            width: 100%;
            margin: 0;
            border-collapse: collapse;
        }

        td {
            padding: 10px;
            vertical-align: middle;
        }

        /* Meratakan label ke kanan */
        td:first-child {
            text-align: right;
            font-weight: bold;
            color: #555;
        }

        td:nth-child(2) {
            width: 10px;
            text-align: center;
        }

        td:last-child {
            text-align: left;
        }

        /* Input field styling */
        input[type="text"], input[type="tel"], input[type="date"], textarea, select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
            box-sizing: border-box;
        }

        /* Tombol submit styling */
        input[type="submit"] {
            width: 100%;
            padding: 12px;
            font-size: 16px;
            font-weight: bold;
            color: #fff;
            background-color: #5cb85c;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #4cae4c;
        }

        /* Pesan error */
        .alert {
            color: #d9534f;
            font-size: 14px;
            text-align: center;
            margin-top: 15px;
        }

        /* Responsif */
        @media (max-width: 600px) {
            .container {
                padding: 15px;
            }

            td:first-child {
                font-size: 14px;
            }

            input[type="submit"] {
                font-size: 14px;
                padding: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Tambah Data Siswa</h1>
        <img src="assets/img/puskom.png" alt="Logo" width="150px">
        <form action="" method="POST" enctype="multipart/form-data">
            <table>
                <tr>
                    <td>NIS</td>
                    <td>:</td>
                    <td><input type="text" name="nis" required></td>
                </tr>
                <tr>
                    <td>Nama Siswa</td>
                    <td>:</td>
                    <td><input type="text" name="namasiswa" required></td>
                </tr>
                <tr>
                    <td>Jenis Kelamin</td>
                    <td>:</td>
                    <td><input type="text" name="jk" required></td>
                </tr>
                <tr>
                    <td>Phone</td>
                    <td>:</td>
                    <td><input type="text" name="phone" required></td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td>:</td>
                    <td><input type="text" name="alamat" required></td>
                </tr>
                <tr>
                    <td>Tanggal Lahir</td>
                    <td>:</td>
                    <td><input type="date" name="tanggallahir" required></td>
                </tr>
                <tr>
                    <td>Foto</td>
                    <td>:</td>
                    <td><input type="file" name="foto" required></td>
                </tr>
                <tr>
                    <td colspan="3" style="text-align: center;">
                        <input type="submit" value="Daftar">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nis = isset($_POST['nis']) ? $_POST['nis'] : null;
    $namasiswa = isset($_POST['namasiswa']) ? $_POST['namasiswa'] : null;
    $jk = isset($_POST['jk']) ? $_POST['jk'] : null;
    $phone = isset($_POST['phone']) ? $_POST['phone'] : null;
    $alamat = isset($_POST['alamat']) ? $_POST['alamat'] : null;
    $tanggallahir = isset($_POST['tanggallahir']) ? $_POST['tanggallahir'] : null;
    $foto = isset($_FILES['foto']['name']) ? $_FILES['foto']['name'] : null;

    $target_dir = "assets/img/";
    $target_file = $target_dir . basename($foto);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
    if (!in_array($imageFileType, $allowed_types)) {
        echo "<div class='alert'>Hanya file JPG, JPEG, PNG & GIF yang diperbolehkan</div>";
    } else {
        if (isset($_FILES['foto']['tmp_name']) && move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
            $sql = "INSERT INTO siswa (nis, namasiswa,  jk, phone, alamat, tanggallahir, foto)
                    VALUES ('$nis', '$namasiswa', '$jk', '$phone', '$alamat', '$tanggallahir', '$foto')";

            if ($conn->query($sql) === TRUE) {
                echo "<script>alert('Data berhasil disimpan'); window.location.href='user.php';</script>";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "<div class='alert'>Maaf, terjadi kesalahan saat mengupload gambar.</div>";
        }
    }
}
?>

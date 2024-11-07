<?php
require "koneksi.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Siswa PKL</title>
    <style>
        /* Gaya dasar */
        body {
            background-image: url("bg.jpg");
            font-family: Arial, sans-serif;
            background-size: cover;
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
            margin-bottom: 10px;
            font-size: 24px;
        }

        img {
            margin-bottom: 20px;
        }

        /* Tabel input form */
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

        /* Input dan select styling */
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
        <h1>Tambah Data Siswa PKL</h1>
        <img src="assets/img/puskom.png" alt="Logo" width="150px">
        <form action="" method="POST" enctype="multipart/form-data">
            <table>
                <tr>
                    <td>Nama</td>
                    <td>:</td>
                    <td><input type="text" name="nama" required></td>
                </tr>
                <tr>
                    <td>Keterangan PKL</td>
                    <td>:</td>
                    <td><input type="text" name="keteranganpkl" required></td>
                </tr>
                <tr>
                    <td>Tanggal</td>
                    <td>:</td>
                    <td><input type="date" name="tanggal" required></td>
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
    $nama = $_POST['nama'] ?? null;
    $keteranganpkl = $_POST['keteranganpkl'] ?? null;
    $tanggal = $_POST['tanggal'] ?? null;
    $foto = $_FILES['foto']['name'] ?? null;

    if ($foto) {
        $target_dir = "assets/img/";
        $target_file = $target_dir . basename($foto);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];

        // Validasi format file
        if (in_array($imageFileType, $allowed_types)) {
            if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
                $sql = "INSERT INTO datapkl (nama, keteranganpkl, tanggal, foto)
                        VALUES ('$nama', '$keteranganpkl', '$tanggal', '$foto')";

                if ($conn->query($sql) === TRUE) {
                    echo "<script>alert('Data berhasil disimpan'); window.location.href='user2.php';</script>";
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            } else {
                echo "<div class='alert'>Maaf, terjadi kesalahan saat mengupload gambar.</div>";
            }
        } else {
            echo "<div class='alert'>Hanya file JPG, JPEG, PNG & GIF yang diperbolehkan</div>";
        }
    }
}
?>

<?php
include 'koneksi.php'; 

$sql = "SELECT * FROM datapkl";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Jurnal</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
            text-align: center;
        }
        button {
            padding: 5px 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
        .action-buttons {
            display: flex;
            gap: 5px;
            justify-content: center;
        }
        .button-group {
            margin-bottom: 20px;
        }
        
       /* Reset margin dan padding */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    /* Navbar styling */
    body {
        font-family: Arial, sans-serif;
    }

    .navbar {
        background-color: blue; /* Hijau Tua */
        overflow: hidden;
        padding: 10px 10px;
        display: flex;
        align-items: center;
    }

    /* Navbar items */
    .navbar a {
        color: white;
        padding: 10px 10px;
        text-decoration: none;
        font-size: 17px;
    }

    .navbar a:hover {
        background-color: lightblue; /* Warna hijau lebih terang saat hover */
    }

    /* Kolom Pencarian */
    .search-container {
        margin-left: auto;
        display: flex;
        align-items: center;
    }

    .search-container input[type="text"] {
        padding: 8px;
        font-size: 16px;
        border: none;
        border-radius: 4px 0 0 4px;
        outline: none;
    }

    .search-container button {
        padding: 8px 10px;
        background-color:lightblue;
        color: white;
        font-size: 16px;
        border: none;
        border-radius: 0 4px 4px 0;
        cursor: pointer;
    }

    .search-container button:hover {
        background-color: #1E7A1E;
    }
    </style>
</head>
<body>
<div class="navbar">
<a href=""><h4>Pustaka Komputer</h4></a>
    <a href="home.php">Home</a>
    <a href="datasiswa.php">Data Siswa</a>
    <a href="datapkl.php">Data PKL</a>
    <a href="datauser.php">Data User</a>

    <!-- Kolom Pencarian -->
    <div class="search-container">
        <input type="text" placeholder="Search...">
        <button type="submit">Search</button>
    </div>
</div>
<br>

<div style="text-align: justify-content: flex-end;">
    <h1>Menu Edit Data User</h1>
    <div class="button-group" style="text-align: justify-content: flex-end;; margin-bottom: 20px;">
    <a href="register.php" class="btn btn-primary">TAMBAH DATA USER</a>
</div>
</div>

<table>
    <tr>
        <th>ID User</th>
        <th>Username</th>
        <th>Password</th>
        <th>Nama</th>
        <th>Email</th>
        <th>Level</th>
        <th>Aksi</th>

    </tr>
    <?php
include 'koneksi.php'; 
$no = 1;
$data = mysqli_query($conn, 'SELECT * FROM user');
while ($result = mysqli_fetch_array($data)) {
    echo "
    <tr>
        <td>".$result['iduser']."</td>
        <td>".$result['username']."</td>
        <td>".$result['pw']."</td>
        <td>".$result['nama']."</td>
        <td>".$result['email']."</td>
        <td>".$result['level']."</td>
        <td class='action-buttons'>
            <a href='hapususer.php?username=".$result['username']."' onclick='return confirm(\"Yakin ingin menghapus?\")'><button class='btn btn-danger'>Hapus</button></a>
        </td>
    </tr>";
}
?>

</table>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</html>

<?php
$conn->close();
?>
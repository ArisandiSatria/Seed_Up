<?php

require_once("./db.php");

session_start();
$name = $_SESSION['username_owner'];
$query = "SELECT * FROM akun_pemilik WHERE username='$name'";
$stmt = $conn->query($query);
$hasil = $stmt->fetch_assoc();

?>;


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>SEEDS UP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <style>
        * {
            font-style: poppins, sans-serif;
            margin: 0;
            padding: 0;
        }
        body {
            background-image: url(img/bgppl.jpeg);
            background-size: cover;
        }
        nav {
            padding-top: 20px;
            padding-bottom: 5px;
            box-sizing: border-box;
        }
        nav ul {
            list-style: none;
            width: 50%;
            padding-top: 6px;
        }
        nav ul li a{
            text-decoration: none;
            color: #34364a;
        }
        nav ul li a:hover{
            color: rgba(255, 117, 24, 1);
        }
    </style>
<body>
    <div class="container">
        <nav class="row ps-4">
            <div class="col-1">
                <img src="img/logoppl-removebg-preview.png" style="position:absolute;top:4%;height: 4rem; width: 4.5rem;">
            </div>
            <ul class="col-7 d-flex justify-content-between">
                <li><a href="tampilanOwner2.php"><h6>Dashboard</h6></a></li>
                <li><a href="infoCuaca2.php"><h6>Info Cuaca</h6></a></li>
                <li><a href="laporanPencatatan2.php"><h6>Laporan Pencatatan</h6></a></li>
                <li><a href="pemasaran2.php"><h6>Produk</h6></a></li>
                <li><a href="riwayatTransaksi.php"><h6> Riwayat Transaksi</h6></a></li>
            </ul>
            <h5 class="col-2 offset-2 pt-2 d-flex justify-content-end">
                <a href="profilOwner.php" style="text-decoration: none;color: #34364a;">
                <i class="bi bi-person"></i>
                <?php echo "Halo, " . $_SESSION['username_owner'] ."!". ""; ?>
                </a>
            </h5>
        </nav>
        <div class="container-fluid justify-content-md-center mt-5">
            <h5 style="color: rgba(255, 117, 24, 1);">Ini detail profil Anda!</h5>
            <h2 class="mb-4" style="font-weight: bold;">Profil Admin</h2>
            <div class="nama mb-3">
                <h5>Nama:</h5>
                <?=$hasil["nama_pemilik"]?>
            </div>
            <div class="tgllahir mb-3">
                <h5>Tanggal Lahir:</h5>
                <?=$hasil["tanggal_lahir"]?>
            </div>
            <div class="username mb-3">
                <h5>Username:</h5>
                <?=$hasil["username"]?>
            </div>
            <div class="alamat mb-3">
                <h5>Alamat:</h5>
                <?=$hasil["alamat"]?>
            </div>
            <div class="email mb-3">
                <h5>Email:</h5>
                <?=$hasil["e_mail"]?>
            </div>
            <div class="noHp mb-3">
                <h5>No. HP:</h5>
                <?=$hasil["no_hp"]?>
            </div>
            <div class="d-flex justify-content-between mt-3">
                <div>
                    <a href="tampilanOwner2.php" class="btn btn-secondary">Kembali</a>
                </div>
                <form action="" method="POST">
                    <div class="mb-3">
                        <a href="editProfilOwner.php" type="edit" class="btn btn-warning" style="color: white;">Ubah</a>
                        <a href="logout.php" class="btn btn-danger">Log Out</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
    

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>
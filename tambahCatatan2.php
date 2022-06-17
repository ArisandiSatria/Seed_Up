<?php 
session_start();
require_once("./db.php");

if (isset($_POST["submit"])) {
    $judulCatatan = $_POST["judulCatatan"];
    $isiCatatan = $_POST["isiCatatan"];
    $kategori = $_POST["kategoriCatatan"];
    $pemasukan = $_POST["pemasukan"];
    $pengeluaran = $_POST["pengeluaran"];
    $tanggal = date("d-m-Y");

    $sql = "INSERT INTO data_pencatatan (tanggal, judul, kategori, isi, pemasukan, pengeluaran) 
                        VALUES ('$tanggal', '$judulCatatan', '$kategori', '$isiCatatan', $pemasukan, $pengeluaran)
            ";
    mysqli_query($conn, $sql);
    header("Location: laporanPencatatan2.php");
}

$query = "SELECT * FROM akun_pemilik";
$stmt = $conn->query($query);
$hasil = $stmt->fetch_assoc();

?>


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
    <div class="container mt-4">
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
    </div>
    <div class="container mx-auto mt-5 row">
        <div class="col">
            <h5 style="color: rgba(255, 117, 24, 1);">Ayo tambah catatanmu!</h5>
            <h2 class="mb-4" style="font-weight: bold;">Tambah Catatan</h2>
            <form action="" method="POST">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Judul</label><p class="d-inline" style="color: red;">*</p>
                    <input name="judulCatatan" class="form-control" id="exampleFormControlInput1" placeholder="Masukkan Judul" required>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Kategori</label><p class="d-inline" style="color: red;">*</p>
                    <input name="kategoriCatatan" class="form-control" id="exampleFormControlInput1" placeholder="Masukkan Kategori">
                </div>
                <div class="row">
                    <div class="mb-3 col">
                        <label for="exampleFormControlInput1" class="form-label">Pemasukan</label>
                        <input type="number" name="pemasukan" class="form-control" id="exampleFormControlInput1" value="0" placeholder="Masukkan pemasukan Anda">
                    </div>
                    <div class="mb-3 col">
                        <label for="exampleFormControlInput1" class="form-label">Pengeluaran</label>
                        <input type="number" name="pengeluaran" class="form-control" id="exampleFormControlInput1" value="0" placeholder="Masukkan pengeluaran Anda">
                    </div>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Deskripsi</label><p class="d-inline" style="color: red;">*</p>
                    <textarea name="isiCatatan" class="form-control" id="exampleFormControlTextarea1" required></textarea>
                </div>
                <div class="mb-3">
                    <a href="laporanPencatatan2.php" class="btn btn-secondary">Kembali</a>
                    <input class="btn" type="submit" name="submit" value="Submit" style="float: right; background-color: rgba(255, 117, 24, 1); color: white;">
                </div>
            </form>
        </div>
    </div>
</body>
    

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>
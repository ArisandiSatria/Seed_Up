<?php 
session_start();
require_once("./db.php");

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $query = "SELECT * FROM transaksi_pesanan
                JOIN detail_pembayaran ON detail_pembayaran.id_pembayaran = transaksi_pesanan.id_pembayaran
                JOIN detail_pesanan ON detail_pesanan.id_pesanan = transaksi_pesanan.id_pesanan
                JOIN data_produk ON data_produk.id_produk = detail_pesanan.id_produk
                JOIN akun_customer ON akun_customer.id_customer = transaksi_pesanan.id_pesanan
                WHERE id_transaksi = '$id' 
                ";
    $stmt = $conn->query($query);
    $result = $stmt->fetch_assoc();
}

if (isset($_POST["verif"])) {
    $id = $_GET["id"];
    $status = $_POST["verif"];
    $sql = "INSERT INTO verifikasi_transaksi (id_pesanan_customer, status_transaksi) 
    VALUES ($id, '$status')
    ";
    mysqli_query($conn, $sql);

    $id = $_GET["id"];
    $sql = "DELETE FROM transaksi_pesanan WHERE id_transaksi = $id;
    ";
    mysqli_query($conn, $sql);
    header("Location: riwayatTransaksi.php");
} 


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
    <div class="container mt-5">
        <h5 style="color: rgba(255, 117, 24, 1);">Ada yang pesan nih!</h5>
        <h2 class="mb-4" style="font-weight: bold;">Detail Pesanan</h2>
        <div class="container mx-auto mt-5" style="color: black;">
            <div class="row">
                <div class="container col-6">
                    <div class="pemesan">
                        <h6 class="fw-bold">Pemesan:</h6>
                        <?=$result["nama_customer"]?>
                    </div>
                    <div class="alamat mt-2">
                        <h6 class="fw-bold">Alamat:</h6>
                        <?=$result["alamat"]?>
                    </div>
                    <div class="row mt-4">
                        <div class="col rincian mt-2">
                            <h6 class="fw-bold">Rincian:</h6>
                            <span>Produk: <?=$result["nama_produk"]?></span><br>
                            <span>Jumlah: <?=$result["kuantitas"]?></span>
                        </div>
                        <div class="col total mt-2">
                            <h6 class="fw-bold">Total:</h6>
                            <span>Harga sub produk: <?=$result["harga_produk"]?></span><br>
                            <details>
                                <summary>Total pembayaran: Rp <?=$result["kuantitas"] * $result["harga_produk"]?></summary>
                                <small style="font-size: xx-small; background-color: blue;"><p><i><?=$result["kuantitas"]?> (jumlah produk) X <?=$result["harga_produk"]?> (harga per produk)</i></p></small>
                            </details>
                        </div>
                    </div>
                </div>
                <div class="container col-6">
                    <h6 class="mb-2">Bukti pembayaran:</h6>
                    <img src="<?=$result["foto_bukti"]?>" class="img-thumbnail">
                    <form action="" method="POST">
                        <div class="d-flex justify-content-between mt-2">
                            <input type="submit" class="btn btn-danger" name="verif" value="Gagal">
                            <input type="submit" class="btn btn-success" name="verif" value="Berhasil">
                        </div>
                    </form>
                </div>
            </div>

            <div class="d-flex justify-content-between mt-2 mb-3">
                <a href="tampilanOwner2.php" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
    </div>
</body>
    

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>
</html>
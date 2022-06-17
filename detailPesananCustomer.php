<?php 
session_start();
require_once("./db.php");

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $query = "SELECT * FROM verifikasi_transaksi
            JOIN pesanan_customer ON pesanan_customer.id_pesanan_customer = verifikasi_transaksi.id_pesanan_customer
            JOIN detail_pesanan ON detail_pesanan.id_pesanan = pesanan_customer.id_pesanan
            JOIN detail_pembayaran ON detail_pembayaran.id_pembayaran = pesanan_customer.id_pesanan
            JOIN data_produk ON data_produk.id_produk = detail_pesanan.id_produk
            JOIN akun_customer ON akun_customer.id_customer = pesanan_customer.id_pesanan
            WHERE id_verifikasi = $id
    ";
    $stmt = $conn->query($query);
    $result = $stmt->fetch_assoc();
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
            background-image: url(img/bgcus.jpeg);
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
        .card {
            box-shadow: 0 6px 10px 1px rgba(0, 0, 0, .2);
        }
    </style>
<body>
<div class="container mt-4">
        <nav class="row ps-4">
            <div class="col-1">
                <img src="img/logoppl-removebg-preview.png" style="position:absolute;top:4%;height: 4rem; width: 4.5rem;">
            </div>
            <ul class="col-5 d-flex justify-content-between">
                <li><a href="tampilanCustomer.php"><h6>Produk</h6></a></li>
                <li><a href="pesananCustomer.php"><h6>Pesananmu</h6></a></li>
                <li><a href="profilOwnerCustomer.php"><h6>Profil Owner</h6></a></li>
            </ul>
            <h5 class="col-3 offset-2 pt-2 d-flex justify-content-end">
                <a href="profilCustomer.php" style="text-decoration: none;color: #34364a;">
                <i class="bi bi-person"></i>
                <?php echo "Halo, " . $_SESSION['username_customer'] ."!". ""; ?>
                </a>
            </h5>
        </nav>
    </div>
    <div class="container mt-5">
        <h5 style="color: rgba(255, 117, 24, 1);">Pesanan Anda</h5>
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
                            <h3>
                                <b>Status Transaksi = <?=$result['status_transaksi']?></b>
                            </h3>
                        </div>
                    </form>
                </div>
            </div>

            <div class="d-flex justify-content-between mt-2 mb-3">
                <a href="pesananCustomer.php" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
    </div>
</body>
    

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>
</html>
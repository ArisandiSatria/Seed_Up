<?php
session_start();
include 'db.php';

$name = $_SESSION['username_customer'];
$query = "SELECT * FROM akun_customer WHERE username='$name'";
$stmt = $conn->query($query);
$hasil = $stmt->fetch_assoc();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM detail_pesanan 
                JOIN data_produk on data_produk.id_produk = detail_pesanan.id_produk
                JOIN metode_pembayaran on metode_pembayaran.id_metode = detail_pesanan.id_metode
                WHERE id_pesanan = $id";
    $stmt = $conn->query($query);
    $result = $stmt->fetch_assoc();
}

if (isset($_POST['bayar'])) {
    $idPesanan = $_GET['id'];
    $tanggal = date("d-m-Y");
    $fotoBukti = upload();
    if (!$fotoBukti) {
        return false;
    }
    $sql = "INSERT INTO detail_pembayaran (id_pesanan, foto_bukti, tanggal)
                        VALUES ($idPesanan, '$fotoBukti', '$tanggal')
        ";
    mysqli_query($conn, $sql);
    header("Location: pesananCustomer.php");
}

function upload() {
    $namaGambar = $_FILES['fotoProduk']['name'];
    $ukuranGambar = $_FILES['fotoProduk']['size'];
    $tmp = $_FILES['fotoProduk']['tmp_name'];
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaGambar);
    $ekstensiGambar = strtolower(end($ekstensiGambar));

    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo "<script>
            alert('Ekstensi file salah!');
        </script>";

        return false;
    }

    if ($ukuranGambar > 3000000) {
        echo "<script>
            alert('Ukuran gambar terlalu besar!');
        </script>";

        return false;
    }

    $namaGambarBaru = uniqid();
    $namaGambarBaru .= '.';
    $namaGambarBaru .= $ekstensiGambar;

    move_uploaded_file($tmp, 'imgUpload/' . $namaGambarBaru);

    return $namaGambar;

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
        nav {
            padding-top: 20px;
            padding-bottom: 5px;
            box-sizing: border-box;
        }
        body {
            background-image: url(img/bgcus.jpeg);
            background-size: cover;
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
        <h5 style="color: rgba(255, 117, 24, 1);">Pesananmu</h5>
        <h2 class="mb-4" style="font-weight: bold;">Ayo lakukan pembayaran!</h2>
        <form method="POST" enctype="multipart/form-data">
        <div class="row">
            <div class="col-4">
                <div class="mb-3">
                    <h5>Alamat:</h5>
                    <?=$hasil["alamat"]?>
                </div>
                <div class="mb-3">
                    <h5>Produk:</h5>
                    <?=$result["nama_produk"]?>
                </div>
                <div class="mb-3">
                    <h5>Kuantitas:</h5>
                    <?=$result['kuantitas']?> buah
                </div>
                <div class="mb-3">
                    <h5>Harga:</h5>
                    Rp <?=$result['harga_produk']?>
                </div>
            </div>
            <div class="col-8">
                <div class="mb-3">
                    <h5>Total Pembayaran:</h5>
                    <h4><b>Rp <?=$result['harga_produk'] * $result['kuantitas']?></b></h4>
                </div>
                <hr size="3">
                <div class="mb-3">
                    <h5>Metode Pembayaran:</h5>
                    <h4><b><?=$result['metode']?></b></h4>
                </div>
                <div class="mb-3">
                    <h5>Bayar ke Nomor Berikut:</h5>
                    <h4><b><?=$result['nomor']?></b></h4>
                </div>
                <div class="mb-3 row">
                    <label for="bukti" class="col-3 col-form-label"><h5>Bukti Pembayaran:</h5></label>
                    <div class="col-7">
                        <input type="file" name="fotoProduk" class="form-control">
                        <small><i>(Hanya jpg, jpeg, dan png || Maks. = 2MB)</i></small>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <a href="tampilanCustomer.php" class="btn btn-secondary">Batal</a>
                <input class="btn" type="submit" style="float: right; background-color: rgba(255, 117, 24, 1); color: white;" name="bayar" value="Pesan">
            </div>
        </form>
    </div>
</body>
    

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>
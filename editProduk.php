<?php 
session_start();
require_once("./db.php");

$id = $_GET["id"];
$result = query("SELECT * FROM data_produk WHERE id_produk = $id")[0];

if (isset($_POST["submit"])) {
    $id = $_GET["id"];
    $namaProduk = $_POST["namaProduk"];
    $keteranganProduk = $_POST["keteranganProduk"];
    $fotoProdukLama = $_POST["fotoProdukLama"];
    if ($_FILES['fotoProduk']['error'] === 4) {
        $fotoProduk = $fotoProdukLama;
    } else {
        $fotoProduk = upload();
    }

    $hargaProduk = $_POST["hargaProduk"];
    $stokProduk = $_POST["stokProduk"];
    $sql = "UPDATE data_produk 
            SET nama_produk='$namaProduk', keterangan='$keteranganProduk', foto='$fotoProduk', harga_produk='$hargaProduk', stok_barang='$stokProduk' 
            WHERE id_produk = $id ";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    header("Location: pemasaran2.php");
}

$query = "SELECT * FROM akun_pemilik";
$stmt = $conn->query($query);
$hasil = $stmt->fetch_assoc();

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
            alert('Ukurang gambar terlalu besar!');
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
            <h5 style="color: rgba(255, 117, 24, 1);">Kamu memperbarui produkmu!</h5>
            <h2 class="mb-4" style="font-weight: bold;">Ubah Produk</h2>
            <form method="POST" enctype="multipart/form-data">
                <input type="hidden" name="fotoProdukLama" value="<?=$result['foto'];?>">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Foto Produk</label><br>
                    <img src="<?=$result['foto']?>" width="30%" class="mb-3">
                    <input type="file" name="fotoProduk" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Nama Produk</label>
                    <input name="namaProduk" class="form-control" id="exampleFormControlInput1" value="<?=$result['nama_produk']?>">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">keterangan</label>
                    <textarea name="keteranganProduk" class="form-control" id="exampleFormControlTextarea1" rows="3"><?=$result['keterangan']?></textarea>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Harga</label>
                    <input name="hargaProduk" type="number" class="form-control" id="exampleFormControlInput1" value="<?=$result['harga_produk']?>">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Stok</label>
                    <input name="stokProduk" type="number" class="form-control" id="exampleFormControlInput1" value="<?=$result['stok_barang']?>">
                </div>
                <div class="mb-3">
                    <a href="pemasaran2.php" class="btn btn-secondary">Batal</a>
                    <input class="btn" type="submit" name="submit" value="Submit" style="float: right; background-color: rgba(255, 117, 24, 1); color: white;">
                </div>
            </form>
        </div>
    </div>
</body>
    

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>
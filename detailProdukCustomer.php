<?php 

session_start();
require_once("./db.php");
$name = $_SESSION['username_customer'];
$query = "SELECT * FROM akun_customer WHERE username='$name'";
$stmt = $conn->query($query);
$hasil = $stmt->fetch_assoc();
if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $query = "SELECT * FROM data_produk
                WHERE id_produk = '$id' 
            ";
    $stmt = $conn->query($query);
    $result = $stmt->fetch_assoc();
}

if (isset($_POST["submit"])) {
    $id= $hasil['id_customer'];
    $jumlah = $_POST['jumlah'];
    $idProduk = $_GET['id'];
    $metode = $_POST['metode'];
    $sql = "INSERT INTO detail_pesanan (id_produk, id_metode, kuantitas, id_customer)
            VALUES ($idProduk, $metode, $jumlah, $id)
    ";
    if ($conn->query($sql) === TRUE) {
        $last_id = $conn->insert_id;
        header("Location: tambahPesanan.php?id=" . $last_id);
    }
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
        <h5 style="color: rgba(255, 117, 24, 1);">Produk ini luar biasa!</h5>
        <h2 class="mb-4" style="font-weight: bold;">Detail Produk</h2>
        <form method="post">
            <div class="container mx-auto mt-5 row" style="color: black;">
                <div class="container col-3">
                    <img src="<?=$result["foto"];?>" class="img-fluid">
                </div>
                <div class="row col">
                    <div class="container col-12">
                        <h1 class="d-inline"><?=$result["nama_produk"]?></h1>
                    </div>
                    <div class="container col mt-4">
                        <?=$result["keterangan"]?>
                        <div class="row mt-5">
                            <div class="Language col">
                                <h6 class="fw-bold">Harga</h6>
                                Rp <?=$result["harga_produk"]?>
                            </div>
                            <div class="Rental Duration col">
                                <h6 class="fw-bold">Stok Produk</h6>
                                <?=$result["stok_barang"]?>
                            </div>
                            <div class="mt-5 form-group row">
                                <h6><b>Pesan Sekarang!</b></h6>
                                <label for="pesan" class="col-1 col-form-label">Jumlah:</label>
                                <div class="col-2">
                                    <input type="number" name="jumlah" class="form-control" required>
                                </div>
                                <div class="mb-3 row col-9">
                                    <label for="metode" class="col-5 col-form-label">Pilih metode pembayaran:<span style="color:red">*</span></label>
                                    <div class="col-3">
                                        <select class="form-select" name="metode" required>
                                            <option value="" selected>-</option>
                                            <option value="1">Dana</option>
                                            <option value="2">OVO</option>
                                            <option value="3">Gopay</option>
                                            <option value="4">BRI</option> 
                                            <option value="5">BNI</option> 
                                            <option value="6">Mandiri</option> 
                                            <option value="7">BCA</option> 
                                            <option value="8">BTN</option> 
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-between mt-5">
                    <div>
                        <a href="tampilanCustomer.php" class="btn btn-secondary">Kembali</a>
                    </div>
                    <div class="mb-3">
                        <input class="btn" type="submit" name="submit" value="Pesan" style="float: right; background-color: rgba(255, 117, 24, 1); color: white;">
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
    

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>
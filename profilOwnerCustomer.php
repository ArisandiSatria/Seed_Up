<?php

require_once("./db.php");

session_start();
$query = "SELECT * FROM akun_pemilik WHERE id_pemilik = 1";
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
        <h5 style="color: rgba(255, 117, 24, 1);">Ini detail profil Owner kami!</h5>
        <h2 class="mb-4" style="font-weight: bold;">Profil Owner</h2>
        <div class="d-flex justify-content-between">
            <div class="g-4" style="color: black;">
                <div class="nama mb-3">
                    <h5>Nama:</h5>
                    <?=$hasil["nama_pemilik"]?>
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
            </div>
            <div class="lokasi">
                <h5>Lokasi kami:</h5>
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3953.747869534633!2d114.0543974147775!3d-7.710181294442175!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xcbaa773938811b62!2zN8KwNDInMzYuNyJTIDExNMKwMDMnMjMuNyJF!5e0!3m2!1sid!2sid!4v1652561193810!5m2!1sid!2sid" width="300" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </div>
    
</body>
    

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>
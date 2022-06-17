<?php 
session_start();
require_once("./db.php");

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
        .card {
            box-shadow: 0 6px 10px 1px rgba(0, 0, 0, .2);
        }
        #weatherContainer{
            position: absolute;
            top: 70%;
            left: 50%;
            margin-right: -50%;
            transform: translate(-50%, -50%);
            height: 350px;
            width: 1300px;
            border: 5px solid rgba(255, 255, 255, 0.829);    
            border-radius: 10px;
        }

        #iconsContainer{
            position: absolute;
            top: 50%;
            left: 50%;
            margin-right: -50%;
            transform: translate(-50%, -50%);
            height: 300px;
            width: 1200px;    
            border: 5px solid rgb(255, 255, 255);    
            border-radius: 10px;
        }

        .icons{
            display: inline-bock;
            float: left;
            height: 250px;
            width: 190px;
            margin: 20px;
            border: 5px solid rgb(255, 255, 255);
            border-radius: 10px;
        }

        .image{
            height: 140px;
            width: 100%;
        }

        .imgClass{
            height: 140px;
            width: 100%;
        }

        .weather{
            margin: 7px;
        /*  background-color: rgb(106, 215, 255); */
            border-radius: 7px;
            text-align: center;
            font-weight: bold;
        }

        .minValues{
            text-align: center;
            display: inline-block;
            border-radius: 5px;
            height: 25px;
            width: 85px;
            margin: 0;
            margin-bottom: 5px;
            margin-left: 5px;
        }

        .maxValues{
            text-align: center;
            display: inline-block;
            border-radius: 5px;
            height: 25px;
            width: 85px;
            margin: 0;
            margin-bottom: 5px;
            margin-left: 5px;
        }
    </style>
<body onload="DefaultScreen()">
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
    <div class="container mt-5">
        <h5 style="color: rgba(255, 117, 24, 1);">Lihat perkiraan cuaca 5 hari ke depan yuk!</h5>
        <h2 class="mb-3" style="font-weight: bold;">Cuaca</h2>
        <div class="row" id="inputContainer">
            <div class="d-flex justify-content-between col">
                <h4 id="cityName" class="">Perkiraan cuaca di kota Jember</h4>
                <label class="form-label pt-2">Cari Kota:</label>
            </div>
            <div class="d-flex col-2">
                <input type="text" id="cityInput" class="form-control">
            </div>
            <button onclick="GetInfo()" class="btn col-1" type="button" style="background-color: rgba(255, 117, 24, 1); color: white;">Cari</button>
        </div>
        <div class="d-flex justify-content-evenly mt-2">    
            <div class = "icons">
                <p class="weather" id="day1"></p>
                <div class="image"><img src="img/dots.png" class="imgClass" id="img1"></div>
                <p class="minValues" id="day1Min">Loading...</p>
                <p class="maxValues" id="day1Max">Loading...</p>
            </div>
            <div class = "icons">
                <p class="weather" id="day2"></p>
                <div class="image"><img src="img/dots.png" class="imgClass" id="img2"></div>
                <p class="minValues" id="day2Min">Loading...</p>
                <p class="maxValues" id="day2Max">Loading...</p>
            </div>
            <div class = "icons">
                <p class="weather" id="day3"></p>
                <div class="image"><img src="img/dots.png" class="imgClass" id="img3"></div>
                <p class="minValues" id="day3Min">Loading...</p>
                <p class="maxValues" id="day3Max">Loading...</p>
            </div>
            <div class = "icons">
                <p class="weather" id="day4"></p>
                <div class="image"><img src="img/dots.png" class="imgClass" id="img4"></div>
                <p class="minValues" id="day4Min">Loading...</p>
                <p class="maxValues" id="day4Max">Loading...</p>
            </div>
            <div class = "icons">
                <p class="weather" id="day5"></p>
                <div class="image"><img src="img/dots.png" class="imgClass" id="img5"></div>
                <p class="minValues" id="day5Min">Loading...</p>
                <p class="maxValues" id="day5Max">Loading...</p>
            </div>
        </div>
    </div>
</body>


<script src="script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>
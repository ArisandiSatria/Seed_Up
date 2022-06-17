<?php

require_once("./db.php");
session_start();
$name = $_SESSION['username_owner'];
$query = "SELECT * FROM akun_pemilik WHERE username='$name'";
$result = $conn->query($query);

if(isset($_POST['simpan']))
    {
        $nama = $_POST['nama'];
        $username = $_POST['username'];
        $alamat = $_POST['alamat'];
        $email = $_POST['email'];
        $nohp = $_POST['nohp'];
        $tglLahir = $_POST['tglLahir'];
        $password = $_POST['password'];
        $name = $_SESSION['username_owner'];
        
        $sql = "UPDATE akun_pemilik SET nama_pemilik='$nama', username='$username', alamat='$alamat',e_mail='$email', 
                no_hp='$nohp', tanggal_lahir='$tglLahir', password ='$password' WHERE username = '$name'";
        if ($conn->query($sql) === TRUE) {
            $_SESSION['username_owner'] = $username;
            echo "<meta http-equiv='refresh' content='1;url=profilOwner.php'>";
            } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
            }
    }
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
                <li><a href="laporanPencatatan2.php"><h6>Laporan Pencatatan</h6></a></li>
                <li><a href="infoCuaca2.php"><h6>Info Cuaca</h6></a></li>
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
        <div class="container mx-auto mt-5 row">
            <div class="col">
                <h5 style="color: rgba(255, 117, 24, 1);">Hati-hati ya!</h5>
                <h2 class="mb-4" style="font-weight: bold;">Ubah Profil Admin</h2>
                <form action="" method="POST" class="form-item">
                    <?php while($row = $result->fetch_assoc()) {?>
                        <div class="mb-3">
                            <label for="email">Email</label>
                            <input type="email" placeholder="Masukkan Email" name="email" class="form-control col-md-9" value="<?php echo $row['e_mail'] ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="nama">Nama Lengkap</label>
                            <input type="text" placeholder="Masukkan Nama" name="nama" class="form-control col-md-9" value="<?php echo $row['nama_pemilik'] ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="username">Username</label>
                            <input type="text" placeholder="Masukkan Username" name="username" class="form-control col-md-9" value="<?php echo $row['username'] ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="alamat">Alamat</label>
                            <input type="text" placeholder="Masukkan Alamat" name="alamat" class="form-control col-md-9" value="<?php echo $row['alamat'] ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="nohp">Nomor Hp</label>
                            <input type="text" placeholder="Masukkan Nomor Hp" name="nohp" class="form-control col-md-9" value="<?php echo $row['no_hp'] ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="password">Password</label>
                            <input type="password" placeholder="Masukkan Password" name="password" class="form-control col-md-9" value="<?php echo $row['password'] ?>" required>
                        </div>
                        <div class="mb-3">
                            <a href="profilOwner.php" class="btn btn-secondary">Batal</a>
                            <input type="submit" class="btn" name="simpan" value="Simpan" style="float: right; background-color: rgba(255, 117, 24, 1); color: white;">
                        </div>
                    <?php }?>
                </form>
            </div>
        </div>
    </div>
</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>
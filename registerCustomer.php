<?php 

include 'db.php';

error_reporting(0);

session_start();

if (isset($_SESSION['username'])) {
    header("Location: index.php");
}

if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $alamat = $_POST['alamat'];
    $email = $_POST['email'];
    $nohp = $_POST['nohp'];
    $tglLahir = $_POST['tglLahir'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    
    if ($password == $cpassword) {
        $sql = "SELECT * FROM akun_customer WHERE e_mail='$email'";
        $result = mysqli_query($conn, $sql);
        if (!$result->num_rows > 0) {
            $sql = "INSERT INTO akun_customer (nama_customer, username, alamat, e_mail, no_hp, tanggal_lahir, password)
                    VALUES ('$nama','$username', '$alamat','$email','$nohp','$tglLahir', '$password')";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                echo "<script>alert('Selamat, registrasi berhasil!')</script>";
                echo "<meta http-equiv='refresh' content='1;url=index.php'>";
            } else {
                echo "<script>alert('Woops! Terjadi kesalahan.')</script>";
            }
        } else {
            echo "<script>alert('Woops! Email Sudah Terdaftar.')</script>";
        }
    } else {
        echo "<script>alert('Password Tidak Sesuai')</script>";
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Register Akun Customer</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <style>
        body {
            width: 99.05%;
        }
        .rectangle {
            background-image: url( https://media.istockphoto.com/photos/orange-wall-grunge-background-picture-id1303180027?b=1&k=20&m=1303180027&s=170667a&w=0&h=ghVGWhyLQj0DgMNlhb4q9tFXNP8ToTtzEXAF2iIAiQM=);
            background-repeat: no-repeat;
            background-size: cover;
            position: absolute;
            width: 45%;
            height: 100%;
            left: 0px;
            top: 0px;
        }
        .para {
            position: absolute;
            left: 5%;
            top: 20%;
            color: white;
        }
    </style>
    
</head>
<body>
    <div class="row">
        <div class="container col">
            <div class="rectangle">
                <div class="para">
                    <h1>Membeli produk dalam negeri</h1>
                    <h3>membangun negeri</h3>
                </div>
            </div>
        </div>
        <div class="container col mx-auto me-4">
            <div class="col mt-5">
                <form action="" method="POST" class="row g-3">
                    <h3 class="mb-5" style="color: rgba(255, 117, 24, 1); text-align: center;">Buat Akun</h3>
                    <div class="form-group col-6">
                        <label for="email">Email</label>
                        <input type="email" placeholder="Masukkan Email" name="email" class="form-control col-md-9" value="<?php echo $email; ?>" required>
                    </div>
                    <div class="form-group col-6">
                        <label for="nama">Nama Lengkap</label>
                        <input type="text" placeholder="Masukkan Nama" name="nama" class="form-control col-md-9" value="<?php echo $nama; ?>" required>
                    </div>
                    <div class="form-group col-6">
                        <label for="username">Username</label>
                        <input type="text" placeholder="Masukkan Username" name="username" class="form-control col-md-9" value="<?php echo $username; ?>" required>
                    </div>
                    <div class="form-group col-6">
                        <label for="alamat">Alamat</label>
                        <input type="text" placeholder="Masukkan Alamat" name="alamat" class="form-control col-md-9" value="<?php echo $alamat; ?>" required>
                    </div>
                    <div class="form-group col-6">
                        <label for="nohp">Nomor Hp</label>
                        <input type="text" placeholder="Masukkan Nomor Hp" name="nohp" class="form-control col-md-9" value="<?php echo $nohp; ?>" required>
                    </div>
                    <div class="form-group col-6">
                        <label for="tglLahir">Tanggal Lahir</label>
                        <input type="date" placeholder="Masukkan Tanggal Lahir" name="tglLahir" class="form-control col-md-9" value="<?php echo $tglLahir; ?>" required>
                    </div>
                    <div class="form-group col-6">
                        <label for="password">Password</label>
                        <input type="password" placeholder="Masukkan Password" name="password" class="form-control col-md-9" value="<?php echo $password; ?>" required>
                    </div>
                    <div class="form-group col-6">
                        <label for="cpassword">Konfirmasi Password</label>
                        <input type="password" placeholder="Masukkan Password" name="cpassword" class="form-control col-md-9" value="<?php echo $cpassword; ?>" required>
                    </div><br>
                    <div class="mt-4">
                        <input type="submit" class="btn" style="background-color: rgba(255, 117, 24, 1); color: white;" name="submit" value="Daftar">
                        <p class="login-register-text mt-2">Anda sudah punya akun? <a href="index.php">Login </a></p>        
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
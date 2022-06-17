<?php 

include 'db.php';

error_reporting(0);

session_start();
if (isset($_SESSION['username_owner'])) {
    header("Location: tampilanOwner2.php");
}
if (isset($_POST['submitOwner'])) {
    $email = $_POST['emailOwner'];
    $password = $_POST['passwordOwner'];

    $sql = "SELECT * FROM `akun_pemilik` WHERE e_mail='$email' AND password='$password'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['username_owner'] = $row['username'];
        header("Location: tampilanOwner2.php");
    
    } else {
        echo "<script>alert('Email atau password Anda salah. Silahkan coba lagi!')</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <title>Seeds_Up</title>
    <style>
        * {
            font-family: poppins, sans-serif;
        }
        body {
            width: 99.05%;
        }
        .rectangle {
            position: absolute;
            width: 45%;
            height: 100%;
            left: 0px;
            top: 0px;
            background: rgba(255, 117, 24, 1);
        }
        .bgImg {
            position: absolute;
            width: 100%;
            height: 100%;
            left: 0px;
            top: 0px;
            filter: opacity(15%);
        }
        .logo {
            position: absolute;
            width: 121px;
            height: 36px;
            left: 5%;
            top: 10%;
            font-weight: 700;
            font-size: 24px;
            line-height: 36px;
            color: white;
        }
        .parLog {
            position: absolute;
            width: 332px;
            height: 72px;
            left: 5%;
            top: 30%;
            color: white;
        }
        small {
            font-size: smaller;
        }
    </style>
</head>
<body>
    <div class="row">
        <div class="container col">
            <div class="rectangle">
                <h3 class="logo">Seeds_Up</h3>
                <h1 class="parLog">Satu klik dapat mengubah nasib</h1>
                <img class="bgImg" src="img/bg.jpg" alt="">
            </div>
        </div>
        <div class="container col row mt-5 mx-auto">
            <div class="col-6 mx-auto mt-5">
                <form action="" method="POST">
                    <h3>Selamat Datang Admin</h3>
                    <div class="mb-3 mt-5">
                        <label for="inputEmail3" class="mb-2">Email address</label>
                        <input type="email" class="form-control" name="emailOwner" id="inputEmail3" value="" required>
                    </div>
                    <div class="mb-3">
                        <label for="inputPassword3" class="mb-2">Password</label>
                        <input type="password" class="form-control" name="passwordOwner" value="" required>
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" name="submitOwner" class="btn btn-primary">Log In</button>
                    </div>
                    <small class="fw-light"><p>Masuk sebagai <a href="index.php" >Customer</a></p></small>
                </form>
            </div>
        </div>
    </div>


</body>
</html> 
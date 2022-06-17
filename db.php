<?php
$conn = new mysqli("localhost","root","","seed_up");

if ($conn->connect_error) {
    die("Koneksi Gagal");
}

function query($query) {
    global $conn;
    $result = mysqli_query($conn, $query);

    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function execute($query) {
    global $conn;
    $result = mysqli_query($conn, $query);
    return $result;
}
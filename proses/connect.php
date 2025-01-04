<?php
    $server = "localhost";
    $username = "root";
    $password = "";
    $dbname = "db_deelcerise";
    
    // Membuat koneksi
    $conn = mysqli_connect($server, $username, $password, $dbname);
    
    // Cek koneksi
    if (!$conn) {
        die("Koneksi gagal: " . mysqli_connect_error());;
    } 
?>
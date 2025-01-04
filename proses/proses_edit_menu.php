<?php 
include "connect.php";

$id = (isset($_POST['id'])) ? htmlentities($_POST['id']) : "" ;
$foto = (isset($_FILES['foto']['name'])) ? htmlentities($_FILES['foto']['name']) : "";
$nama_menu = (isset($_POST['nama_menu'])) ? htmlentities($_POST['nama_menu']) : "";
$keterangan = (isset($_POST['keterangan'])) ? htmlentities($_POST['keterangan']) : "";
$kategori = (isset($_POST['kategori'])) ? htmlentities($_POST['kategori']) : "";
$harga = (isset($_POST['harga'])) ? htmlentities($_POST['harga']) : "";
$tmp = $_FILES['foto']['tmp_name'];

if (isset($_POST['input_menu_validate'])) {
    $angka_acak = rand(100, 9999);
    $nama_gambar_baru = $angka_acak . '-' . $foto;
    $location = "../assets/img/" . $nama_gambar_baru;

    // Cek apakah file sudah ada
    if (file_exists($location)) {
        echo "<script>alert('Maaf, file dengan nama yang sama sudah ada.');window.history.back();</script>";
    } else {
        // Cek apakah nama menu sudah ada di database
        $query_check = "SELECT * FROM tb_daftar_menu WHERE nama_menu = '$nama_menu'";
        $result_check = mysqli_query($conn, $query_check);
        if (mysqli_num_rows($result_check) > 0) {
            echo "<script>alert('Maaf, nama menu yang sama sudah ada.');window.history.back();</script>";
        } else {
            if (move_uploaded_file($tmp, $location)) {
                $query = "UPDATE tb_daftar_menu SET foto='$nama_gambar_baru', nama_menu='$nama_menu', keterangan='$keterangan', kategori='$kategori', harga='$harga' WHERE id='$id'";
                $result = mysqli_query($conn, $query);
                if (!$result) {
                    die("Query Error: " . mysqli_errno($conn) . " - " . mysqli_error($conn));
                } else {
                    echo "<script>alert('Data berhasil ditambahkan.');window.location='../menu';</script>";
                }
            } else {
                echo "<script>alert('Maaf, terjadi kesalahan saat mengupload file Anda.');window.history.back();</script>";
            }
        }
    }
}
?>
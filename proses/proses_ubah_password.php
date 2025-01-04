<?php 
session_start();
include "connect.php";

$id = (isset($_POST['id'])) ? htmlentities($_POST['id']) : "" ;
$passwordlama = (isset($_POST['passwordlama'])) ? md5(htmlentities($_POST['passwordlama'])) : "" ;
$passwordbaru = (isset($_POST['passwordbaru'])) ? md5(htmlentities($_POST['passwordbaru'])) : "" ;
$repasswordbaru = (isset($_POST['repasswordbaru'])) ? md5(htmlentities($_POST['repasswordbaru'])) : "" ;

if(!empty($_POST['ubah_password_validate'])){
    // Periksa apakah username dan password lama sesuai
    $query = mysqli_query($conn, "SELECT * FROM tb_user WHERE username = '$_SESSION[username_deelcerise]' AND password = '$passwordlama'");
    $hasil = mysqli_fetch_array($query);
    if($hasil){
        if($passwordbaru == $repasswordbaru){
            // Update password baru
            $query = mysqli_query($conn, "UPDATE tb_user SET password='$passwordbaru' WHERE username = '$_SESSION[username_deelcerise]'");
            if($query){
                $message = '<script>alert("Password berhasil diupdate");
                            window.history.back();</script>';
            }else{
                $message = '<script>alert("Password gagal diupdate");
                            window.history.back();</script>';
            }
        }else{
            $message = '<script>alert("Password baru tidak sama");
                        window.history.back();</script>';
        }
    }else{ 
        $message = '<script>alert("Password lama tidak sesuai");
                    window.history.back();</script>';
    }
    echo $message;
} else {
    header("location:../home");
}
?>
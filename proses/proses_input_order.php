<?php 
session_start();
include "connect.php";

// Ambil data dari form
$kode_order = (isset($_POST['kode_order'])) ? htmlentities($_POST['kode_order']) : "" ;
$pelanggan = (isset($_POST['pelanggan'])) ? htmlentities($_POST['pelanggan']) : "" ;

if(!empty($_POST['input_order_validate'])){
    // Periksa apakah order sudah ada
    $select = mysqli_query($conn, "SELECT * FROM tb_order WHERE id_order = '$kode_order'");
    if(mysqli_num_rows($select) > 0){
        $message = '<script>alert("Order yang dimasukkan sudah ada");
                    window.location="../order";
                    </script>';
    }else{
        // Masukkan data order baru
        $query = mysqli_query($conn, "INSERT INTO tb_order (id_order,pelanggan, pelayan) VALUES ('$kode_order', '$pelanggan', '$_SESSION[id_deelcerise]')");
        if($query){
            $message = '<script>alert("Data berhasil dimasukkan");
                        window.location="../?x=orderitem&order='.$kode_order.'&pelanggan='.$pelanggan.'"</script>';
        }else{
            $message = '<script>alert("Data gagal dimasukkan");
                        window.location="../order"</script>';
        }
    }
}
echo $message;
?>
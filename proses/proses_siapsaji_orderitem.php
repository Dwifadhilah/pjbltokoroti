<?php 
session_start();
include "connect.php";

// Ambil data dari form
$id = (isset($_POST['id'])) ? htmlentities($_POST['id']) : "" ;
$catatan = (isset($_POST['catatan'])) ? htmlentities($_POST['catatan']) : "" ;

if(!empty($_POST['siapsaji_orderitem_validate'])){
    // Masukkan data order baru
    $query = mysqli_query($conn, "UPDATE tb_list_order SET catatan='$catatan', status=2 WHERE id_list_order='$id'");
    if($query){
        $message = '<script>alert("Orderan siap disajikan");
                    window.location="../dapur"</script>';
    }else{
        $message = '<script>alert("Gagal proses data");
                    window.location="../dapur"</script>';
    }
}
echo $message;
?>
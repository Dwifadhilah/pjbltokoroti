<?php 
    include "connect.php";
    $id = (isset($_POST['id'])) ? htmlentities($_POST['id']) : "" ;

    if(!empty($_POST['reset_password_validate'])){
        $query = mysqli_query($conn, "UPDATE tb_user SET password=md5('54321') WHERE id='$id'");
        if($query){
            $message = '<script>alert("Password Berhasil Direset");
                        window.location="../user"</script>';
        }else{
            $message = '<script>alert("Password Gagal Direset");
                        window.location="../user"</script>';
        }
    }echo $message;
?>
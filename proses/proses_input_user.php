<?php 
    include "connect.php";
    $nama = (isset($_POST['nama'])) ? htmlentities($_POST['nama']) : "" ;
    $username = (isset($_POST['username'])) ? htmlentities($_POST['username']) : "" ;
    $level = (isset($_POST['level'])) ? htmlentities($_POST['level']) : "" ;
    $nohp = (isset($_POST['nohp'])) ? htmlentities($_POST['nohp']) : "" ;
    $password = (isset($_POST['password'])) ? md5(htmlentities($_POST['password']))  : "" ;
    $alamat = (isset($_POST['alamat'])) ? htmlentities($_POST['alamat']) : "" ;

    if(!empty($_POST['input_user_validate'])){
        $select = mysqli_query($conn, "SELECT * FROM tb_user WHERE username = '$username'");
        if(mysqli_num_rows($select) > 0){
            $message = '<script>alert("Username yang dimasukkan sudah ada");
                        window.location="../user";
                        </script>';
        }else{
            $query = mysqli_query($conn, "INSERT INTO tb_user (nama, username, level, nohp, password, alamat) VALUES ('$nama', '$username', '$level', '$nohp', '$password', '$alamat')");
            if($query){
                $message = '<script>alert("Data berhasil dimasukkan");
                            window.location="../user"</script>';
            }else{
                $message = '<script>alert("Data gagal dimasukkan");
                            window.location="../user"</script>';
            }
        }
    }echo $message;
?>
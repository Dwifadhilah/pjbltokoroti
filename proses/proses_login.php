<?php
    session_start();
    include "connect.php";
    $username = (isset($_POST['username'])) ? htmlentities($_POST['username']) : "" ;
    $password = (isset($_POST['password'])) ? md5(htmlentities($_POST['password']))  : "" ;
    if(!empty($_POST['submit'])){
        $query = mysqli_query($conn, "SELECT * FROM tb_user WHERE username = '$username' && password = '$password'");
        $hasil = mysqli_fetch_array($query);
        if($hasil){
            $_SESSION['username_deelcerise'] = $username;
            $_SESSION['level_deelcerise'] = $hasil['level'];
            $_SESSION['id_deelcerise'] = $hasil['id'];
            header("location:../home");
        }else{ ?>
            <script>
                alert("Username atau Password salah!");
                window.location = "../login";
            </script>
<?php
        }
    }
?>

<!-- htmlentities = agar tidak menjalankan tag. cth <b></b> nanti tulisan akan menjadi bold -->
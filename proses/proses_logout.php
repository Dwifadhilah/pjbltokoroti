<?php
    session_start();
    // session_destroy(); = untuk menghapus semua session
    session_destroy();
    header("location:login");
?>
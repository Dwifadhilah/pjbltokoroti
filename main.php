<!-- Agar hanya bisa melanjutkan jika sudah login -->
<?php
// session_start();
if (empty($_SESSION['username_deelcerise'])) {
    header("location:login");
}

include "proses/connect.php";
$query = mysqli_query($conn, "SELECT * FROM tb_user WHERE username = '$_SESSION[username_deelcerise]'");
$hasil = mysqli_fetch_array($query);

?>



<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>De Elcérise</title>
    <!-- LINK UNTUK BOOTSTRAP CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- LINK UNTUK BOOTSTRAP JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <!-- LINK UNTUK LOGO DRI BOOTSTRAP -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- STRAT LINK UNTUK MEMBUAT TABLE MENJADI LEBIH RAPI -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css" />
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <!-- END LINK UNTUK MEMBUAT TABLE MENJADI LEBIH RAPI -->
</head>

<body>
    <!-- START HEADER -->
    <?php include "header.php"; ?>
    <!-- END HEADER -->

    <!-- START BAGIAN SIDEBAR DAN CONTENT -->
    <div class="container-lg">
        <div class="row mb-5">

            <!-- START SIDEBAR -->
            <?php include "sidebar.php"; ?>
            <!-- END SIDEBAR -->

            <!-- START CONTENT -->
            <!-- 'col-lg-9' = krn total kolom 12 jd bagian content 9 -->
            <?php
            include $page;
            ?>
            <!-- END CONTENT -->

        </div>
        <div class="fixed-bottom text-center bg-light py-1">
            &copy; PJBL 11 RPL 2 Kel-10
        </div>
    </div>
    <!-- END BAGIAN SIDEBAR DAN CONTENT -->

    <!-- untuk peringatan jika tidak mengisi kolom / kotak -->
    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (() => {
            'use strict'

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            const forms = document.querySelectorAll('.needs-validation')

            // Loop over them and prevent submission
            Array.from(forms).forEach(form => {
                form.addEventListener('submit', event => {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                }, false)
            })
        })()
    </script>

    <!-- untuk membuat table lebih rapi -->
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>

</body>

</html>
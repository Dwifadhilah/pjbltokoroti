<?php
include "proses/connect.php";
$query = mysqli_query($conn, "SELECT * FROM tb_user WHERE username = '$_SESSION[username_deelcerise]'");
$record = mysqli_fetch_array($query);

?>

<!-- 'navbar-dark' = "tulisan jd putih" | 'bg-dark' = "warna navbar dark" -->
<!-- 'sticky-top' = "navbar tetap" -->
<nav class="navbar navbar-expand navbar-dark bg-primary sticky-top">
    <!-- 'container' = "navbar tdk terlalu dekat dgn frame" -->
    <!-- 'container-lg'= "selain ukuran di bawah large sprti medium,small akan full frame" -->
    <div class="container-lg">
        <a class="navbar-brand" href="."><img src="assets/img/Cherry Bakery.png" alt="" width="40" height="40"> De Elcérise</a>
        <!-- 'justify-content-end' = "Username" nya ke kanan -->
        <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <?php echo $hasil['username']; ?>
                    </a>
                    <!-- 'dropdown-menu-end' = "hasil dropdown nya tdk melewati garis/layar" -->
                    <!-- 'mt-2 = "hasil dropdown tdk bertumpuk dgn bagian navbar" -->
                    <ul class="dropdown-menu dropdown-menu-end mt-2">
                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#ModalUbahProfile"><i class="bi bi-person-vcard"></i> Profile</a></li>
                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#ModalUbahPassword"><i class="bi bi-file-lock2"></i> Ubah Password</a></li>
                        <li><a class="dropdown-item" href="logout"><i class="bi bi-box-arrow-right"></i> Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- START Modal Ubah Password -->
<div class="modal fade" id="ModalUbahPassword" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-fullscreen-md-down">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Ubah Password</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="needs-validation" novalidate action="proses/proses_ubah_password.php" method="POST">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-floating mb-3">
                                <input disabled type="text" class="form-control" id="floatingInput" placeholder="username" name="username" required value="<?php echo $_SESSION['username_deelcerise'] ?>">
                                <label for="floatingInput">Username</label>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" id="floatingPassword" placeholder="passwordlama" name="passwordlama" required>
                                <label for="floatingPassword">Password Lama</label>
                                <div class="invalid-feedback">
                                    Masukkan Password Lama
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" id="floatingPassword" placeholder="passwordbaru" name="passwordbaru" required>
                                <label for="floatingPassword">Password Baru</label>
                                <div class="invalid-feedback">
                                    Masukkan Password Baru
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" id="floatingPassword" placeholder="repasswordbaru" name="repasswordbaru" required>
                                <label for="floatingPassword">Konfirmasi Password Baru</label>
                                <div class="invalid-feedback">
                                    Masukkan Password Baru Kembali
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success" name="ubah_password_validate" value="12345">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- END Modal Ubah Password -->

<!-- START Modal Ubah Profile -->
<div class="modal fade" id="ModalUbahProfile" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-fullscreen-md-down">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Ubah Profile</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="needs-validation" novalidate action="proses/proses_ubah_profile.php" method="POST">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-floating mb-3">
                                <input disabled type="text" class="form-control" id="floatingInput" placeholder="username" name="username" required value="<?php echo $_SESSION['username_deelcerise'] ?>">
                                <label for="floatingInput">Username</label>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingNama" placeholder="nama" name="nama" value="<?php echo $record['nama'] ?>" required>
                                <label for="floatingNama">Nama</label>
                                <div class="invalid-feedback">
                                    Masukkan Nama Anda
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-floating mb-3">
                                <input type="number" class="form-control" id="floatingInput" placeholder="nohp" name="nohp" value="<?php echo $record['nohp'] ?>" required>
                                <label for="floatingInput">Nomer Handphone</label>
                                <div class="invalid-feedback">
                                    Masukkan Nomor Handphone Anda
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-floating mb-3">
                                <textarea class="form-control" name="alamat" id="floatingAlamat" style="height:100px" required><?php echo $record['alamat'] ?></textarea>
                                <label for="floatingAlamat">Alamat</label>
                                <div class="invalid-feedback">
                                    Masukkan Alamat Anda
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success" name="ubah_profile_validate" value="12345">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- END Modal Ubah Profile -->
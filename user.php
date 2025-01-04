<?php
    include "proses/connect.php";
    $query = mysqli_query($conn, "SELECT * FROM tb_user");
    while($record = mysqli_fetch_array($query)){
        $result[] = $record;
    }

?>
<!-- START CONTENT -->
<!-- 'col-lg-9' = krn total kolom 12 jd bagian content 9 -->
<div class="col-lg-9 mt-2">
    <div class="card">
        <div class="card-header">
            <b>Halaman User</b>
        </div>
        <div class="card-body">
            <div class="row mb-2">
                <div class="col d-flex justify-content-end">
                    <button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#ModalTambahUser"> Tambah User</button>
                </div>
            </div>

            <!-- START Modal Tambah User Baru -->
            <div class="modal fade" id="ModalTambahUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-fullscreen-md-down">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah User</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <form class="needs-validation" novalidate action="proses/proses_input_user.php" method="POST">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingInput" placeholder="Nama" name="nama" required>
                                <label for="floatingInput" >Nama</label>
                                <div class="invalid-feedback">
                                    Masukkan Nama.
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingInput" placeholder="username" name="username" required>
                                <label for="floatingInput">Username</label>
                                <div class="invalid-feedback">
                                    Masukkan Username
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-floating mb-3">
                                <select class="form-select" aria-label="Default select example" name="level" id="floatingSelect" required>
                                    <option selected hidden value="">Pilih Level User</option>
                                    <option value="1">Owner</option>
                                    <option value="2">Cashier</option>
                                    <option value="3">Kitchen</option>
                                </select>
                                <label for="floatingSelect">Level User</label>
                                <div class="invalid-feedback">
                                    Pilih Level User
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-floating mb-3">
                                <input type="number" class="form-control" id="floatingInput" placeholder="08xxxxxxxxxx" name="nohp" required>
                                <label for="floatingInput">Nomor Handphone</label>
                                <div class="invalid-feedback">
                                    Masukkan Nomor Handphone
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" id="floatingInput" placeholder="Password" name="password" required>
                                <label for="floatingPassword" >Password</label>
                                <div class="invalid-feedback">
                                    Masukkan Password
                                </div>
                            </div>
                        </div>
                    </div>
                        <div class="form-floating">
                            <textarea class="form-control" name="" id="" placeholder="Alamat" style="height:100px" name="alamat" required></textarea>
                            <label for="floatingInput">Alamat</label>
                            <div class="invalid-feedback">
                                Masukkan Alamat
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success" name="input_user_validate" value="12345">Save</button>
                        </div>
                </form>
                </div>
                </div>
            </div>
            </div>
            <!-- END Modal Tambah User Baru -->

            <?php 
                foreach($result as $row){
            ?>
            <!-- START Modal View -->
            <div class="modal fade" id="ModalView<?php echo $row['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-fullscreen-md-down">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Detail Data User</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <form class="needs-validation" novalidate action="proses/proses_input_user.php" method="POST">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-floating mb-3">
                                <input disabled type="text" class="form-control" id="floatingInput" placeholder="nama" name="nama" value="<?php echo $row['nama'] ?>">
                                <label for="floatingInput" >Nama</label>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-floating mb-3">
                                <input disabled type="text" class="form-control" id="floatingInput" placeholder="username" name="username" value="<?php echo $row['username'] ?>">
                                <label for="floatingInput">Username</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-floating mb-3">
                            <select disabled class="form-select" aria-label="Default selectexample" required name="level" id="">
                                    <?php 
                                        $data = array("Owner", "Cashier", "Kitchen");
                                        foreach($data as $key => $value){
                                            if($row['level'] == $key+1){
                                                echo "<option selected value='$key'>$value</option>";
                                            }else{
                                                echo "<option value='$key'>$value</option>";
                                            }  
                                        }
                                    ?>
                                </select>
                                <label for="floatingSelect">Level User</label>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-floating mb-3">
                                <input disabled type="number" class="form-control" id="floatingInput" placeholder="08xxxxxxxxxx" name="nohp" value="<?php echo $row['nohp'] ?>">
                                <label for="floatingInput">Nomor Handphone</label>
                            </div>
                        </div>
                    </div>
                        <div class="form-floating">
                            <textarea disabled class="form-control" name="" id="" style="height:100px" name="alamat"><?php echo $row['alamat'] ?></textarea>
                            <label for="floatingInput">Alamat</label>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                </form>
                </div>
                </div>
            </div>
            </div>
            <!-- END Modal View -->

            <!-- START Modal Edit -->
            <div class="modal fade" id="ModalEdit<?php echo $row['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-fullscreen-md-down">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data User</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <form class="needs-validation" novalidate action="proses/proses_edit_user.php" method="POST">
                    <input type="hidden" value="<?php echo $row['id'] ?>" name="id">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingInput" placeholder="nama" name="nama" required value="<?php echo $row['nama'] ?>">
                                <label for="floatingInput" >Nama</label>
                                <div class="invalid-feedback">
                                    Masukkan Nama
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingInput" placeholder="username" name="username" required value="<?php echo $row['username'] ?>">
                                <label for="floatingInput">Username</label>
                                <div class="invalid-feedback">
                                    Masukkan Username
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-floating mb-3">
                                <select class="form-select" aria-label="Default selectexample" required name="level" id="">
                                    <?php 
                                        $data = array("Owner", "Cashier", "Kitchen");
                                        foreach($data as $key => $value){
                                            if($row['level'] == $key+1){
                                                echo "<option selected value=".($key+1).">$value</option>";
                                            }else{
                                                echo "<option value=".($key+1).">$value</option>";
                                            }   
                                        }
                                    ?>
                                </select>
                                <label for="floatingSelect">Level User</label>
                                <div class="invalid-feedback">
                                    Pilih Level User
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-floating mb-3">
                                <input type="number" class="form-control" id="floatingInput" placeholder="08xxxxxxxxxx" name="nohp" required value="<?php echo $row['nohp'] ?>">
                                <label for="floatingInput">Nomor Handphone</label>
                                <div class="invalid-feedback">
                                    Masukkan Nomor Handphone
                                </div>
                            </div>
                        </div>
                    </div>
                        <div class="form-floating">
                            <textarea class="form-control" name="alamat" id="" style="height:100px"><?php echo $row['alamat'] ?></textarea>
                            <label for="floatingInput">Alamat</label>
                            <div class="invalid-feedback">
                                    Masukkan Alamat.
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success" name="input_user_validate" value="12345">Save</button>
                        </div>
                </form>
                </div>
                </div>
            </div>
            </div>
            <!-- END Modal Edit -->

            <!-- START Modal Delete -->
            <div class="modal fade" id="ModalDelete<?php echo $row['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md modal-fullscreen-md-down">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Data User</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <form class="needs-validation" novalidate action="proses/proses_delete_user.php" method="POST">
                    <input type="hidden" value="<?php echo $row['id'] ?>" name="id">
                        <div class="col-lg-12">
                            <?php 
                                if($row['username'] == $_SESSION['username_deelcerise']){
                                    echo "<div class='alert alert-danger'>Anda tidak dapat menghapus akun sendiri</div>";
                                }else{
                                    echo "Apakah anda yakin ingin menghapus user <b>$row[username] ?</b> ";
                                }
                            ?>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-danger" name="input_user_validate" value="12345" <?php echo($row['username'] == $_SESSION['username_deelcerise'])? 'disabled': ''; ?>>Hapus</button>
                        </div>
                </form>
                </div>
                </div>
            </div>
            </div>
            <!-- END Modal Delete -->

            <!-- START Modal Reset Password -->
            <div class="modal fade" id="ModalResetPassword<?php echo $row['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md modal-fullscreen-md-down">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Reset Password</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <form class="needs-validation" novalidate action="proses/proses_reset_password.php" method="POST">
                    <input type="hidden" value="<?php echo $row['id'] ?>" name="id">
                        <div class="col-lg-12">
                            <?php 
                                if($row['username'] == $_SESSION['username_deelcerise']){
                                    echo "<div class='alert alert-danger'>Anda tidak dapat mereset password akun sendiri</div>";
                                }else{
                                    echo "Apakah anda yakin ingin mereset password user <b>$row[username] ?</b> menjadi password bawaan sistem yaitu <b>54321</b>";
                                }
                            ?>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success" name="reset_password_validate" value="12345" <?php echo($row['username'] == $_SESSION['username_deelcerise'])? 'disabled': ''; ?>>Reset Password</button>
                        </div>
                </form>
                </div>
                </div>
            </div>
            </div>
            <!-- END Modal Reset Password -->

            <?php 
                }

                if(empty($result)){
                    echo "Data user tidak ada";
                }else{

            ?>

            <!-- table-responsive = agar tablenya responsif di pengguna hp -->
            <div class="table-responsive">
            <table class="table table-bordered table-hover text-center" id="example">
                <thead class="table-secondary">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Username</th>
                        <th scope="col">Level</th>
                        <th scope="col">Nomor Handphone</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $no = 1;
                        foreach($result as $row){
                    ?>
                    <tr>
                    <th scope="row">
                        <?php echo $no++ ?>
                    </th>
                    <td>
                        <?php echo $row['nama']; ?>
                    </td>
                    <td>
                        <?php echo $row['username']; ?>
                    </td>
                    <td>
                        <?php 
                            if($row['level'] == 1){
                                echo "Owner";
                            }elseif($row['level'] == 2){
                                echo "Cashier";
                            }elseif($row['level'] == 3){
                                echo "Kitchen";
                            } 
                        ?>
                    </td>
                    <td>
                        <?php echo $row['nohp']; ?>
                    </td>
                    <!-- d-flex = agar buttonnya sejajar kesamping bukan kebawah -->
                    <!-- me-1 = unutk memberikan jarak antar tombol -->
                    <td class="d-flex justify-content-center align-items-center">
                        <button class="btn btn-info btn-sm me-1" data-bs-toggle="modal" data-bs-target="#ModalView<?php echo $row['id'] ?>"><i class="bi bi-eye"></i></button>
                        <button class="btn btn-warning btn-sm me-1" data-bs-toggle="modal" data-bs-target="#ModalEdit<?php echo $row['id'] ?>"><i class="bi bi-pencil-square"></i></button>
                        <button class="btn btn-danger btn-sm me-1" data-bs-toggle="modal" data-bs-target="#ModalDelete<?php echo $row['id'] ?>"><i class="bi bi-trash"></i></button>
                        <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#ModalResetPassword<?php echo $row['id'] ?>"><i class="bi bi-key"></i></button>
                    </td>
                    </tr>

                    <?php } ?>

                </tbody>
            </table>
            </div>

            <?php } ?>

        </div>
    </div>
</div>
<!-- END CONTENT -->
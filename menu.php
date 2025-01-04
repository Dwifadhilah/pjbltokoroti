<?php
include "proses/connect.php";

$query = mysqli_query($conn, "SELECT * FROM tb_daftar_menu");

if (!$query) {
    die("Query failed: " . mysqli_error($conn));
}

$result = [];
while ($record = mysqli_fetch_array($query)) {
    $result[] = $record;
}
?>


<!-- START CONTENT -->
<!-- 'col-lg-9' = krn total kolom 12 jd bagian content 9 -->
<div class="col-lg-9 mt-2">
    <div class="card">
        <div class="card-header">
            <b>Halaman Menu</b>
        </div>
        <div class="card-body">
            <div class="row mb-2">
                <div class="col d-flex justify-content-end">
                    <button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#ModalTambahUser"> Tambah Menu</button>
                </div>
            </div>

            <!-- START Modal Tambah Menu Baru -->
            <div class="modal fade" id="ModalTambahUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl modal-fullscreen-md-down">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Menu Makanan dan Minuman</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form class="needs-validation" novalidate action="proses/proses_input_menu.php" method="POST" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="input-group mb-3">
                                            <input type="file" class="form-control py-3" id="uploadFoto" placeholder="foto" name="foto" required>
                                            <label class="input-group-text" for="uploadFoto">Upload Foto Menu</label>
                                            <div class="invalid-feedback">
                                                Masukkan File Foto Menu
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="floatingInput" placeholder="nama_menu" name="nama_menu" required>
                                            <label for="floatingInput">Nama Menu</label>
                                            <div class="invalid-feedback">
                                                Masukkan Nama Menu
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="floatingInput" placeholder="keterangan" name="keterangan">
                                            <label for="floatingInput">Keterangan</label>
                                            <div class="invalid-feedback">
                                                Masukkan Keterangan.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-floating mb-3">
                                            <select class="form-select" aria-label="Default select example" name="kategori" id="floatingSelect" required>
                                                <option selected hidden value="">Pilih Kategori Menu</option>
                                                <option value="1">Cake</option>
                                                <option value="2">Cookies</option>
                                                <option value="3">Pastry</option>
                                                <option value="4">Brownies</option>
                                            </select>
                                            <label for="floatingSelect">Jenis Menu</label>
                                            <div class="invalid-feedback">
                                                Pilih Jenis Menu
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-floating mb-3">
                                            <input type="number" class="form-control" id="floatingInput" placeholder="harga" name="harga" required>
                                            <label for="floatingInput">Harga</label>
                                            <div class="invalid-feedback">
                                                Masukkan Harga Menu
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-success" name="input_menu_validate" value="12345">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END Modal Tambah Menu Baru -->

            <?php
            if (empty($result)) {
                echo "<b>Data menu makanan atau minuman tidak ada</b>";
            } else {

                foreach ($result as $row) {
            ?>

                    <!-- START Modal Edit -->
                    <div class="modal fade" id="ModalEdit<?php echo $row['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl modal-fullscreen-md-down">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Menu Makanan dan Minuman</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form class="needs-validation" novalidate action="proses/proses_edit_menu.php" method="POST" enctype="multipart/form-data">
                                        <input type="hidden" value="<?php echo $row['id'] ?>" name="id">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="input-group mb-3">
                                                    <input type="file" class="form-control py-3" id="floatingInputFoto" placeholder="foto" name="foto" required>
                                                    <label class="input-group-text" for="floatingInputFoto">Upload Foto Menu</label>
                                                    <div class="invalid-feedback">
                                                        Masukkan File Foto Menu
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" id="floatingInputNamaMenu" placeholder="nama_menu" name="nama_menu" value="<?php echo $row['nama_menu'] ?>" required>
                                                    <label for="floatingInputNamaMenu">Nama Menu</label>
                                                    <div class="invalid-feedback">
                                                        Masukkan Nama Menu
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" id="floatingInput" placeholder="keterangan" name="keterangan" value="<?php echo $row['keterangan'] ?>">
                                                    <label for="floatingInput">Keterangan</label>
                                                    <div class="invalid-feedback">
                                                        Masukkan Keterangan.
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-floating mb-3">
                                                    <select class="form-select" aria-label="Default select example" name="kategori" id="floatingSelect" required>
                                                        <?php
                                                        $data = array("Cake", "Cookies", "Pastry", "Brownies");
                                                        foreach ($data as $key => $value) {
                                                            $selected = ($row['kategori'] == $key + 1) ? "selected" : "";
                                                            echo "<option value='" . ($key + 1) . "' $selected>$value</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                    <label for="floatingSelect">Jenis Menu</label>
                                                    <div class="invalid-feedback">
                                                        Pilih Jenis Menu
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-floating mb-3">
                                                    <input type="number" class="form-control" id="floatingInput" placeholder="harga" name="harga" value="<?php echo $row['harga'] ?>" required>
                                                    <label for="floatingInput">Harga</label>
                                                    <div class="invalid-feedback">
                                                        Masukkan Harga Menu
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-success" name="input_menu_validate" value="12345">Save</button>
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
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Menu</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form class="needs-validation" novalidate action="proses/proses_delete_menu.php" method="POST">
                                        <input type="hidden" value="<?php echo $row['id'] ?>" name="id">
                                        <input type="hidden" value="<?php echo $row['foto'] ?>" name="foto">
                                        <div class="col-lg-12">
                                            Apakah anda yakin ingin menghapus menu <b><?php echo $row['nama_menu'] ?> ?</b>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-danger" name="input_menu_validate" value="12345">Hapus</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END Modal Delete -->

                <?php
                }

                ?>

                <!-- table-responsive = agar tablenya responsif di pengguna hp -->
                <div class="table-responsive">
                    <table class="table table-bordered table-hover text-center" id="example">
                        <thead class="table-secondary">
                            <tr class="text-nowrap">
                                <th scope="col">No</th>
                                <th scope="col">Foto Menu</th>
                                <th scope="col">Nama Menu</th>
                                <th scope="col">Keterangan</th>
                                <th scope="col">Kategori</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($result as $row) {
                            ?>
                                <tr>
                                    <th scope="row">
                                        <?php echo $no++ ?>
                                    </th>
                                    <td>
                                        <div style="width: 100px; height: 100px; overflow: hidden;">
                                            <img src="assets/img/<?php echo $row['foto']; ?>" class="img-thumbnail" alt="...">
                                        </div>
                                    </td>
                                    <td>
                                        <?php echo $row['nama_menu'] ?>
                                    </td>
                                    <td>
                                        <?php echo $row['keterangan'] ?>
                                    </td>
                                    <td>
                                        <?php
                                        if ($row['kategori'] == 1) {
                                            echo "Cake";
                                        } elseif ($row['kategori'] == 2) {
                                            echo "Cookies";
                                        } elseif ($row['kategori'] == 3) {
                                            echo "Pastry";
                                        } elseif ($row['kategori'] == 4) {
                                            echo "Brownies";
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php echo number_format($row['harga'], 0, ',', '.') ?>
                                    </td>
                                    <!-- d-flex = agar buttonnya sejajar kesamping bukan kebawah -->
                                    <!-- me-1 = unutk memberikan jarak antar tombol -->
                                    <td>
                                        <div class="d-flex justify-content-center align-items-center">
                                            <button class="btn btn-warning btn-sm me-1" data-bs-toggle="modal" data-bs-target="#ModalEdit<?php echo $row['id'] ?>"><i class="bi bi-pencil-square"></i></button>
                                            <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#ModalDelete<?php echo $row['id'] ?>"><i class="bi bi-trash"></i></button>
                                        </div>
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

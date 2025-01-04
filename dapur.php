<?php
include "proses/connect.php";
$query = mysqli_query($conn, "SELECT * FROM tb_list_order
    LEFT JOIN tb_order ON tb_order.id_order = tb_list_order.kode_order
    LEFT JOIN tb_daftar_menu ON tb_daftar_menu.id = tb_list_order.menu
    JOIN tb_bayar ON tb_bayar.id_bayar = tb_order.id_order ORDER BY waktu_order ASC");


while ($record = mysqli_fetch_array($query)) {
    $result[] = $record;
    
}

$select_menu = mysqli_query($conn, "SELECT id,nama_menu FROM tb_daftar_menu");
?>


<!-- START CONTENT -->
<!-- 'col-lg-9' = krn total kolom 12 jd bagian content 9 -->
<div class="col-lg-9 mt-2">
    <div class="card">
        <div class="card-header">
            <b>Halaman Dapur</b>
        </div>
        
        <div class="card-body">

            <?php
            if (empty($result)) {
                echo "<b>Data Order Item tidak ada</b>";
            } else {

                foreach ($result as $row) {
            ?>

                    <!-- START Modal Terima Dapur -->
                    <div class="modal fade" id="terima<?php echo $row['id_list_order'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-fullscreen-md-down">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Terima Orderan</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form class="needs-validation" novalidate action="proses/proses_terima_orderitem.php" method="POST">
                                        <input type="hidden" name="id" value="<?php echo $row['id_list_order'] ?>">
                                        <div class="row">
                                            <div class="col-lg-8">
                                                <div class="form-floating mb-3">
                                                    <select disabled class="form-select" aria-label="Default select example" name="menu" id="floatingSelect" required>
                                                        <option selected hidden value="">Pilih Menu</option>
                                                        <?php
                                                        foreach ($select_menu as $value) {
                                                            if ($row['menu'] == $value['id']) {
                                                                echo "<option value='" . $value['id'] . "' selected>" . $value['nama_menu'] . "</option>";
                                                            } else {
                                                                echo "<option value='" . $value['id'] . "'>" . $value['nama_menu'] . "</option>";
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                    <label for="floatingSelect">Menu</label>
                                                    <div class="invalid-feedback">
                                                        Silahkan Pilih Menu
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-floating mb-3">
                                                    <input disabled type="number" class="form-control" id="floatingInput" placeholder="jumlah" name="jumlah" value="<?php echo $row['jumlah'] ?>" required>
                                                    <label for="floatingInput">Jumlah Porsi</label>
                                                    <div class="invalid-feedback">
                                                        Masukkan Jumlah Porsi
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-floating mb-3">
                                                    <input disabled type="text" class="form-control" id="floatingInput" placeholder="catatan" name="catatan" value="<?php echo $row['catatan'] ?>">
                                                    <label for="floatingInput">Catatan</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-success" name="terima_orderitem_validate" value="12345">Save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END Modal Terima Dapur -->

                    <!-- START Modal Siap Saji -->
                    <div class="modal fade" id="siapsaji<?php echo $row['id_list_order'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-fullscreen-md-down">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Orderan Siap Saji</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form class="needs-validation" novalidate action="proses/proses_siapsaji_orderitem.php" method="POST">
                                        <input type="hidden" name="id" value="<?php echo $row['id_list_order'] ?>">
                                        <div class="row">
                                            <div class="col-lg-8">
                                                <div class="form-floating mb-3">
                                                    <select disabled class="form-select" aria-label="Default select example" name="menu" id="floatingSelect" required>
                                                        <option selected hidden value="">Pilih Menu</option>
                                                        <?php
                                                        foreach ($select_menu as $value) {
                                                            if ($row['menu'] == $value['id']) {
                                                                echo "<option value='" . $value['id'] . "' selected>" . $value['nama_menu'] . "</option>";
                                                            } else {
                                                                echo "<option value='" . $value['id'] . "'>" . $value['nama_menu'] . "</option>";
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                    <label for="floatingSelect">Menu</label>
                                                    <div class="invalid-feedback">
                                                        Silahkan Pilih Menu
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-floating mb-3">
                                                    <input disabled type="number" class="form-control" id="floatingInput" placeholder="jumlah" name="jumlah" value="<?php echo $row['jumlah'] ?>" required>
                                                    <label for="floatingInput">Jumlah Porsi</label>
                                                    <div class="invalid-feedback">
                                                        Masukkan Jumlah Porsi
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" id="floatingInput" placeholder="catatan" name="catatan" value="<?php echo $row['catatan'] ?>">
                                                    <label for="floatingInput">Catatan</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-success" name="siapsaji_orderitem_validate" value="12345">Save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END Modal Siap Saji -->

                <?php
                }
                ?>

                <!-- table-responsive = agar tablenya responsif di pengguna hp -->
                <div class="table-responsive">
                    <table class="table table-bordered table-hover text-center" id="example">
                        <thead class="table-secondary">
                            <tr class="text-nowrap">
                                <th scope="col">No</th>
                                <th scope="col">Kode Order</th>
                                <th scope="col">Waktu Order</th>
                                <th scope="col">Menu</th>
                                <th scope="col">Qty</th>
                                <th scope="col">Catatan</th>
                                <th scope="col">Status</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $no = 1;
                                foreach ($result as $row) {
                                    if($row['status'] != 2 ){
                            ?>
                                <tr>
                                    <td>
                                        <?php echo $no++ ?>
                                    </td>
                                    <td>
                                        <?php echo $row['kode_order'] ?>
                                    </td>
                                    <td>
                                        <?php echo $row['waktu_order'] ?>
                                    </td>
                                    <td>
                                        <?php echo $row['nama_menu'] ?>
                                    </td>
                                    <td>
                                        <?php echo $row['jumlah'] ?>
                                    </td>
                                    <td>
                                        <?php echo $row['catatan'] ?>
                                    </td>
                                    <td>
                                        <?php 
                                            if($row['status'] == 1){
                                                echo "<span class='badge text-bg-warning'>Diterima Oleh Dapur</span>";
                                            }else if($row['status'] == 2){
                                                echo "<span class='badge text-bg-success'>Siap Saji</span>";
                                            }else{
                                                echo "<span class='badge text-bg-secondary'> Belum Diterima</span>";
                                            }
                                        ?>
                                    </td>
                                    <td>
                                        <div class="d-flex">
                                            <button class="<?php echo (!empty($row['status'])) ? "btn btn-secondary btn-sm me-1 disabled" : "btn btn-warning btn-sm me-1"; ?>"  data-bs-toggle="modal" data-bs-target="#terima<?php echo $row['id_list_order'] ?>">Terima</button>
                                            <button class="<?php echo (empty($row['status']) || $row['status']!=1) ? "btn btn-secondary btn-sm text-nowrap disabled" : "btn btn-success btn-sm text-nowrap"; ?>" data-bs-toggle="modal" data-bs-target="#siapsaji<?php echo $row['id_list_order'] ?>">Siap Saji</button>
                                        </div>
                                    </td>
                                </tr>

                            <?php  
                                    }
                                }
                            ?>
                        </tbody>
                    </table>
                </div>

            <?php } ?>

        </div>
    </div>
</div>
<!-- END CONTENT -->


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
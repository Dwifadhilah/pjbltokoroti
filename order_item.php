<?php
include "proses/connect.php";
$query = mysqli_query($conn, "SELECT *, SUM(harga*jumlah) AS harganya, tb_order.waktu_order FROM tb_list_order
    LEFT JOIN tb_order ON tb_order.id_order = tb_list_order.kode_order
    LEFT JOIN tb_daftar_menu ON tb_daftar_menu.id = tb_list_order.menu
    LEFT JOIN tb_bayar ON tb_bayar.id_bayar = tb_order.id_order
    GROUP BY id_list_order
    HAVING tb_list_order.kode_order = $_GET[order]");

$kode = $_GET['order'];
$pelanggan = $_GET['pelanggan'];
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
            <b>Halaman Order Item</b>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-1">
                    <a href="order" class="btn btn-info text-light"><i class="bi bi-arrow-left-square"></i>Back</a>
                </div>
                <div class="col-lg-3">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="kodemenu" value="<?php echo $kode ?>" disabled>
                        <label class="floatingInput" for="uploadFoto">Kode Menu</label>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="pelanggan" value="<?php echo $pelanggan ?>" disabled>
                        <label for="floatingInput">Pelanggan</label>
                    </div>
                </div>
            </div>

            <!-- START Modal Tambah Item Baru -->
            <div class="modal fade" id="tambahItem" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-fullscreen-md-down">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Order Menu</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form class="needs-validation" novalidate action="proses/proses_input_orderitem.php" method="POST">
                                <input type="hidden" name="kode_order" value="<?php echo $kode ?>">
                                <input type="hidden" name="pelanggan" value="<?php echo $pelanggan ?>">
                                <div class="row">
                                    <div class="col-lg-8">
                                        <div class="form-floating mb-3">
                                            <select class="form-select" aria-label="Default select example" name="menu" id="floatingSelect" required>
                                                <option selected hidden value="">Pilih Menu</option>
                                                <?php
                                                foreach ($select_menu as $value) {
                                                    echo "<option value=$value[id]>$value[nama_menu]</option>";
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
                                            <input type="number" class="form-control" id="floatingInput" placeholder="jumlah" name="jumlah" required>
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
                                            <input type="text" class="form-control" id="floatingInput" placeholder="catatan" name="catatan">
                                            <label for="floatingInput">Catatan</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-success" name="input_orderitem_validate" value="12345">Add Order</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END Modal Tambah Item Baru -->

            <?php
            if (empty($result)) {
                echo "<b>Data Order Item tidak ada</b>";
            } else {

                foreach ($result as $row) {
            ?>

                    <!-- START Modal Edit -->
                    <div class="modal fade" id="ModalEdit<?php echo $row['id_list_order'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-fullscreen-md-down">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Orderan Pelanggan</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form class="needs-validation" novalidate action="proses/proses_edit_orderitem.php" method="POST">
                                        <input type="hidden" name="id" value="<?php echo $row['id_list_order'] ?>">
                                        <input type="hidden" name="kode_order" value="<?php echo $kode ?>">
                                        <input type="hidden" name="pelanggan" value="<?php echo $pelanggan ?>">
                                        <div class="row">
                                            <div class="col-lg-8">
                                                <div class="form-floating mb-3">
                                                    <select class="form-select" aria-label="Default select example" name="menu" id="floatingSelect" required>
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
                                                    <input type="number" class="form-control" id="floatingInput" placeholder="jumlah" name="jumlah" value="<?php echo $row['jumlah'] ?>" required>
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
                                            <button type="submit" class="btn btn-success" name="edit_orderitem_validate" value="12345">Save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END Modal Edit -->

                    <!-- START Modal Delete -->
                    <div class="modal fade" id="ModalDelete<?php echo $row['id_list_order'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-md modal-fullscreen-md-down">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Orderan</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form class="needs-validation" novalidate action="proses/proses_delete_orderitem.php" method="POST">
                                        <input type="hidden" value="<?php echo $row['id_list_order'] ?>" name="id">
                                        <input type="hidden" name="kode_order" value="<?php echo $kode ?>">
                                        <input type="hidden" name="pelanggan" value="<?php echo $pelanggan ?>">
                                        <div class="col-lg-12">
                                            Apakah anda yakin ingin menghapus orderan <b><?php echo $row['nama_menu'] ?> ?</b>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-danger" name="delete_orderitem_validate" value="12345">Hapus</button>
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

                <!-- START Modal Bayar -->
                <div class="modal fade" id="bayar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-fullscreen-md-down">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Pembayaran</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover text-center">
                                        <thead class="table-secondary">
                                            <tr class="text-nowrap">
                                                <th scope="col">Menu</th>
                                                <th scope="col">Harga</th>
                                                <th scope="col">Qty</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Catatan</th>
                                                <th scope="col">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $total = 0;
                                            foreach ($result as $row) {
                                            ?>
                                                <tr>
                                                    <td>
                                                        <?php echo $row['nama_menu'] ?>
                                                    </td>
                                                    <td>
                                                        <?php echo number_format($row['harga'], 0, ',', '.') ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $row['jumlah'] ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $row['status'] ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $row['catatan'] ?>
                                                    </td>
                                                    <td>
                                                        <?php echo number_format($row['harganya'], 0, ',', '.') ?>
                                                    </td>
                                                </tr>

                                            <?php
                                                $total += $row['harganya'];
                                            }
                                            ?>
                                            <tr>
                                                <td colspan="5" class="fw-bold">
                                                    Total Harga
                                                </td>
                                                <td class="fw-bold">
                                                    <?php echo number_format($total, 0, ',', '.') ?>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <span class="text-danger fs-5 fw-semibold">Silahkan Masukkan Nominal Uang Pelanggan</span>
                                <form class="needs-validation" novalidate action="proses/proses_bayar.php" method="POST">
                                    <input type="hidden" name="kode_order" value="<?php echo $kode ?>">
                                    <input type="hidden" name="pelanggan" value="<?php echo $pelanggan ?>">
                                    <input type="hidden" name="total" value="<?php echo $total ?>">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-floating mb-3">
                                                <input type="number" class="form-control" id="floatingInput" placeholder="uang" name="uang" required>
                                                <label for="floatingInput">Nominal Uang</label>
                                                <div class="invalid-feedback">
                                                    Masukkan Nominal Uang
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-success" name="bayar_validate" value="12345">Bayar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END Modal Bayar-->

                <!-- table-responsive = agar tablenya responsif di pengguna hp -->
                <div class="table-responsive">
                    <table class="table table-bordered table-hover text-center">
                        <thead class="table-secondary">
                            <tr class="text-nowrap">
                                <th scope="col">Menu</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Qty</th>
                                <th scope="col">Status</th>
                                <th scope="col">Catatan</th>
                                <th scope="col">Total</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $total = 0;
                            foreach ($result as $row) {
                            ?>
                                <tr>
                                    <td>
                                        <?php echo $row['nama_menu'] ?>
                                    </td>
                                    <td>
                                        <?php echo number_format($row['harga'], 0, ',', '.') ?>
                                    </td>
                                    <td>
                                        <?php echo $row['jumlah'] ?>
                                    </td>
                                    <td>
                                        <?php
                                        if ($row['status'] == 1) {
                                            echo "<span class='badge text-bg-warning'>Diterima Oleh Dapur</span>";
                                        } else if ($row['status'] == 2) {
                                            echo "<span class='badge text-bg-success'>Siap Saji</span>";
                                        } else {
                                            echo "<span class='badge text-bg-secondary'> Belum Diterima</span>";
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php echo $row['catatan'] ?>
                                    </td>
                                    <td>
                                        <?php echo number_format($row['harganya'], 0, ',', '.') ?>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center align-items-center">
                                            <button class="<?php echo (!empty($row['id_bayar'])) ? "btn btn-secondary btn-sm me-1 disabled" : "btn btn-warning btn-sm me-1"; ?>" data-bs-toggle="modal" data-bs-target="#ModalEdit<?php echo $row['id_list_order'] ?>"><i class="bi bi-pencil-square"></i></button>
                                            <button class="<?php echo (!empty($row['id_bayar'])) ? "btn btn-secondary btn-sm disabled" : "btn btn-danger btn-sm"; ?>" data-bs-toggle="modal" data-bs-target="#ModalDelete<?php echo $row['id_list_order'] ?>"><i class="bi bi-trash"></i></button>
                                        </div>
                                    </td>
                                </tr>

                            <?php
                                $total += $row['harganya'];
                            }
                            ?>
                            <tr>
                                <td colspan="5" class="fw-bold">
                                    Total Harga
                                </td>
                                <td class="fw-bold">
                                    <?php echo number_format($total, 0, ',', '.') ?>
                                </td>
                                <td class="fw-blod">

                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            <?php } ?>

            <div>
                <button class="<?php echo (!empty($row['id_bayar'])) ? "btn btn-secondary disabled" : "btn btn-dark"; ?>" data-bs-toggle="modal" data-bs-target="#tambahItem"><i class="bi bi-plus-circle"></i> Item</button>
                <button class="<?php echo (!empty($row['id_bayar'])) ? "btn btn-secondary disabled" : "btn btn-success"; ?>" data-bs-toggle="modal" data-bs-target="#bayar"><i class="bi bi-cash-coin"></i> Bayar</button>
                <button onclick="printStruk()" class="<?php echo (!empty($row['id_bayar'])) ? "btn btn-success me-4" : "btn btn-secondary me-4 disabled"; ?>"><i class="bi bi-file-earmark-text"></i> Cetak Struk</button>
                <span class="<?php echo (!empty($row['id_bayar'])) ? "text-secondary fs-6 fw-semibold" : "text-danger fs-6 fw-semibold"; ?>">Silahkan Lakukan Pembayaran Agar Pesanan Dapat Dibuat !</span>
            </div>
        </div>
    </div>
</div>
<!-- END CONTENT -->

<!-- Struk Content -->
<!-- d-none = agar isi struk content tidak muncul terlebih dahulu -->
<div id="strukContent" class="d-none">
    <style>
        #struk {
            font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
            font-size: 15px;
            max-width: 350px;
            border: 2px solid #333;
            padding: 10px;
            width: 100mm;
        }
        #struk img {
            display: block;
            /* Menampilkan gambar sebagai elemen blok */
            margin: 5px auto;
            /* Menempatkan gambar di tengah */
            width: 200px;
            /* Mengatur lebar gambar */
            height: auto;
            /* Mengatur tinggi gambar secara otomatis */
        }

        #struk h2 {
            text-align: center;
            margin: 5px 0;
            font-size: 20px;
            margin-bottom: 25px;
        }

        #struk p {
            margin: 5px 0;
        }

        #struk h3 {
            margin-top: 25px;
        }

        #struk table {
            font-size: 15px;
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        #struk th,
        #struk td {
            border: 1px solid #333;
            padding: 8px;
            text-align: center;
        }

        #struk .total {
            font-weight: bold;
        }
        
        #struk h4, #struk h5{
            text-align: center;
            margin: 5px 0;
        }

        #struk h5{
            font-size: 15px;
        }

    </style>
    <div id="struk">
        <img src="assets/img/Elcerise.png" alt="">
        <h2>Mustikajaya - Kota Bekasi</h2>
        <p>Kode Order : <?php echo $kode ?></p>
        <p>Pelanggan : <?php echo $pelanggan ?></p>
        <p>Waktu Order : <?php echo date('d/m/Y h:i:s', strtotime($result[0]['waktu_order'])) ?></p>
        <h3>Detail Pesanan</h3>
        <table>
            <thead>
                <tr>
                    <th>Menu</th>
                    <th>Harga</th>
                    <th>Qty</th>
                    <th>Total</th>
                </tr>
            </thead>
            <?php
            $total = 0;
            foreach ($result as $row) { ?>
                <tr>
                    <td><?php echo $row['nama_menu'] ?></td>
                    <td><?php echo number_format($row['harga'], 0, ',', '.') ?></td>
                    <td><?php echo $row['jumlah'] ?></td>
                    <td><?php echo number_format($row['harganya'], 0, ',', '.') ?></td>
                </tr>
            <?php
                $total += $row['harganya'];
            }
            ?>
            <tr class="total">
                <td colspan="3">Total harga</td>
                <td>
                    <?php echo number_format($total, 0, ',', '.') ?>
                </td>
            </tr>
            </tbody>
        </table>
        <h4>~~  Thank You For Your Order ~~</h4>
        <h5>See You Next Time ^.^</h5>
    </div>
</div>


<!-- JS untuk print struk -->
<script>
    function printStruk() {
        var strukContent = document.getElementById("strukContent").innerHTML;

        var printFrame = document.createElement("iframe");
        printFrame.style.display = "none";
        document.body.appendChild(printFrame);
        printFrame.contentDocument.write(strukContent);
        printFrame.contentWindow.print(); // untuk print cetak struk
        document.body.removeChild(printFrame);
    }
</script>
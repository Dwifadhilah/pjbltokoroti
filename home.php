<?php
include "proses/connect.php";
$query = mysqli_query($conn, "SELECT * FROM tb_daftar_menu");
while ($row = mysqli_fetch_array($query)) {
    $result[] = $row;
}


$query_chart = mysqli_query($conn, "SELECT nama_menu, tb_daftar_menu.id, SUM(tb_list_order.jumlah) AS total_jumlah FROM tb_daftar_menu
LEFT JOIN tb_list_order ON tb_daftar_menu.id = tb_list_order.menu
GROUP BY tb_daftar_menu.id
ORDER BY tb_daftar_menu.nama_menu DESC");

// $result_chart = array();
while ($record_chart = mysqli_fetch_array($query_chart)) {
    $result_chart[] = $record_chart;
}

$array_menu = array_column($result_chart, 'nama_menu');
// array_map = salah satu fungsi di php digunakan untuk fungsi callback pada array
$array_menu_quote = array_map(function($menu){
    return "'".$menu."'";
}, $array_menu);
$string_menu = implode(",", $array_menu_quote);
// echo $string_menu."\n";

$array_jumlah_pesanan = array_column($result_chart, 'total_jumlah');
$string_jumlah_pesanan = implode(",", $array_jumlah_pesanan);
// echo $string_jumlah_pesanan."\n";


?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- 'col-lg-9' = krn total kolom 12 jd bagian content 9 -->
<div class="col-lg-9 mt-2">
    <!-- START Carosel -->
    <!-- data-bs-ride = agar carosel bisa berjalan sendiri -->
    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <?php
            $slide = 0;
            $firstSlideButton = true;
            foreach ($result as $dataTombol) {
                ($firstSlideButton) ? $aktif = "active" : $aktif = "";
                $firstSlideButton = false;
            ?>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="<?php echo $slide ?>" class="<?php echo $aktif ?>" aria-current="true" aria-label="Slide <?php echo $slide + 1 ?>"></button>
            <?php
                $slide++;
            }
            ?>
        </div>

        <!-- rounder = agar bagian pinggir melengkung tdk tajam  -->
        <div class="carousel-inner rounded">
            <?php
            $firstSlide = true;
            foreach ($result as $data) {
                // if ternary = krn hanya menggunakan tanda tanya dan titik dua 
                ($firstSlide) ? $aktif = "active" : $aktif = "";
                // agar tdk true lagi
                $firstSlide = false;
            ?>
                <div class="carousel-item <?php echo $aktif ?>">
                    <!-- img-fluid = agar gambar lebih responsif -->
                    <img src="assets/img/<?php echo $data['foto'] ?>" class="img-fluid" style="width:1000px; height:300px; object-fit:cover" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h5><?php echo $data['nama_menu'] ?></h5>
                        <p><?php echo $data['keterangan'] ?></p>
                    </div>
                </div>
            <?php } ?>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <!-- END Carosel -->

    <!-- START Judul -->
    <div class="card mt-2 border-0 bg-light rounded">
        <div class="card-body text-center">
            <h5 class="card-title">De Elcérise - WEBSITE PEMESANAN TOKO ROTI</h5>
            <p class="card-text">Website pemesanan toko roti yang mudah dan praktis. Nikmati beragam jenis roti favorit Anda hanya dengan beberapa klik. Pesan, bayar dan lacak pesanan Anda dengan mudah melalui website ini ^^</p>
            <a href="order" class="btn btn-dark">Buat Order</a>
        </div>
    </div>
    <!-- END Judul -->

    <!-- START Chart -->
    <div class="card mt-3 border-0 bg-light rounded">
        <div class="card-body text-center">
            <div>
                <canvas id="myChart"></canvas>
            </div>

            <script>
                const ctx = document.getElementById('myChart');

                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: [<?php echo $string_menu ?>],
                        datasets: [{
                            label: 'Jumlah Porsi Terjual',
                            data: [<?php echo $string_jumlah_pesanan ?>],
                            borderWidth: 1,
                            backgroundColor: [
                                'rgba(218, 25, 25, 0.6)',
                                'rgba(25, 32, 218, 0.6)',
                                'rgba(218, 207, 25, 0.6)',
                                'rgba(25, 218, 55, 0.6)',
                                'rgba(147, 25, 218, 0.6)',
                                'rgba(255, 119, 0, 0.6)'
                            ]
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            </script>
        </div>
    </div>
    <!-- END Chart -->
</div>
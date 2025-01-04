<!-- 'col-lg-3' = krn total kolom 12 jd bagian sidebar 3 -->
<div class="col-lg-3">
    <!-- 'navbar-expand-lg' = "bagian-bagian/pilihan-pilihan navbar muncul tpi kesamping dan bukan garis 3" -->
    <!-- 'rounded' = "bagian pinggir melengkung" | 'border' = "bagian pinggir terdapat garis" | 'mt-2' = "supaya terdapat pemisah antara navabr dgn sidebar" -->
    <nav class="navbar navbar-expand-lg bg-light rounded border mt-2">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
                <!-- 'offcanvas-start' = "di bootstrap kiri:start kanan:end" -->
                <!-- 'stlye="width:250px' = "supaya canvas tidak terlalu besar -->
            <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel" stlye="width:250px">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Offcanvas</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <!-- 'flex-column' = "bagian/pilihan navbarnya muncul kebawah bukan ke samping" -->
                    <ul class="navbar-nav nav-pills flex-column justify-content-end flex-grow-1">
                        <li class="nav-item">
                            <a class="nav-link ps-2 <?php echo ((isset($_GET['x']) && $_GET['x']=='home') || !isset($_GET['x'])) ? 'active link-light':'link-dark';?>" aria-current="page" href="home"><i class="bi bi-house-heart-fill"></i> Dashboard</a>
                        </li>
                    <?php if($hasil['level']==1 || $hasil['level']==2){ ?>    
                        <li class="nav-item">
                            <a class="nav-link ps-2 <?php echo (isset($_GET['x']) && $_GET['x']=='menu') ? 'active link-light':'link-dark';?>" href="menu"><i class="bi bi-card-checklist"></i> Daftar Menu</a>
                        </li>
                        <li class="nav-item">
                            <!-- php beserta isinya unutk link website agar tidak berbahaya, jadi di sembunyikan agar orang tidak tahu kita buka apa -->
                            <a class="nav-link ps-2 <?php echo (isset($_GET['x']) && $_GET['x']=='order') ? 'active link-light':'link-dark';?>" href="order"><i class="bi bi-cart-check-fill"></i> Order</a>
                        </li>
                    <?php } ?>
                    <?php if($hasil['level']==1 || $hasil['level']==3){ ?> 
                        <li class="nav-item">
                            <a class="nav-link ps-2 <?php echo (isset($_GET['x']) && $_GET['x']=='dapur') ? 'active link-light':'link-dark';?>" href="dapur"><i class="bi bi-stack"></i> Dapur</a>
                        </li>
                    <?php } ?>
                        <!-- agar user dan report hanya bisa dilihat admin / level 1 -->
                    <?php if($hasil['level']==1){ ?>
                        <li class="nav-item">
                            <a class="nav-link ps-2 <?php echo (isset($_GET['x']) && $_GET['x']=='user') ? 'active link-light':'link-dark';?>" href="user"><i class="bi bi-person-square"></i> User</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link ps-2 <?php echo (isset($_GET['x']) && $_GET['x']=='report') ? 'active link-light':'link-dark';?>" href="report"><r class="bi bi-file-earmark-bar-graph"></r> Report</a>
                        </li>
                    <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</div>      
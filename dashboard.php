<?php
session_start(); // Memulai session
// Memeriksa apakah pengguna telah login
if (!isset($_SESSION['username'])) {
    header("Location: index.php"); // Mengarahkan pengguna ke halaman login jika belum login
}
include 'koneksi.php';
include 'data_header.php';
include 'sidebar.php';
include 'topbar.php';
?>
<div id="content">
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-4 text-gray-800">Dashboard</h1>
        </div>



        <!-- Content Row -->
        <div class="row">
            <div class="container-fluid py-4">
      <div class="row">
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card bg-danger text-white">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Highest Purchase Count</p>
                    <h5 class="font-weight-bolder">
                      530 
                    </h5>
                    <p class="mb-0">
                      <span class="text-success text-sm font-weight-bolder">in Contact ID 269</span>
                      from 771 Product ID
                    </p>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                    <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card bg-warning text-dark">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Production Rate</p>
                    <h5 class="font-weight-bolder">
                      99.97%
                    </h5>
                    <p class="mb-0">
                      <span class="text-success text-sm font-weight-bolder">Last 25 years</span>
                      
                    </p>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                    <i class="ni ni-world text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6">
          <div class="card bg-primary text-white">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Scrapped Product</p>
                    <h5 class="font-weight-bolder">
                      42605
                    </h5>
                    <p class="mb-0">
                      <span class="text-success text-sm font-weight-bolder">Total Scrapped Product</span> 
                    </p>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                    <i class="ni ni-cart text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <br>
            <div class="col-lg-6 mb-4">

                <!-- Illustrations -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Deskripsi Aplikasi</h6>
                    </div>
                    <div class="card-body">
                        <div class="text-center">
                            <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;" src="assets/img/logo.png" alt="...">
                        </div>
                        <p>Aplikasi ini adalah aplikasi yang membantu manajemen untuk melihat Persentase Stok Produk Masuk dan Persentase Penjualan per Produk.<br>Kami juga menampilkan "Production Success Rate tahun 2001-2004", "Customer dengan frekuensi pembelian tertinggi", dan "Jumlah produk yang gagal atau cacat produksi" </p>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

</div>
</div>
<?php
include 'data_footer.php';
?>
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
            <h1 class="h3 mb-4 text-gray-800">Data Tabel Fakta Produksi</h1>
        </div>



        <!-- Content Row -->
        <div class="row">

            <div class="col-lg-12 mb-4">

                <!-- Illustrations -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary"></h6>
                    </div>
                    <div class="card-body">
                        <iframe name="mondrian" src="http://localhost:8080/mondrian/testpage.jsp?query=dwoadw2" style="height:100% ;width:100%; border:none; text-align:center;">
                        </iframe>
                        <br>


                        <iframe name="neo4j" src="http://localhost:8080" style="height:100% ;width:100%; border:none; align-content:center;">
                        </iframe>
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
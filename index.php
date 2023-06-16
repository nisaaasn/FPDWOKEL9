<?php
session_start(); // Memulai session
// Memeriksa apakah pengguna telah login
if (isset($_SESSION['username'])) {
    header("Location: dashboard.php"); // Mengarahkan pengguna ke halaman login jika belum login
    exit();
}
include 'koneksi.php';
include 'auth_header.php';
?>
<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-lg-7">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Login Admin Control Data Warehouse</h1>
                                </div>

                                <form class="user" method="post" action="proses_login.php">
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user" id="username" name="username" placeholder="Enter Username...">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Password">
                                    </div>
                                    <input type="submit" class="btn btn-primary btn-user btn-block" value="Login">
                                </form>
                                <hr>
                                <div class="text-center">
                                    <p class="small"> Silahkan Masukkan Username Dan Password Anda!</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>
<?php
include 'auth_footer.php';
?>
  <script>
  // Mendapatkan referensi form login
  const loginForm = document.getElementById('login-form');

  // Menangani event submit pada form login
  loginForm.addEventListener('submit', function(event) {
    event.preventDefault(); // Mencegah form melakukan submit default

    // Mendapatkan nilai input username dan password
    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;

    // Memeriksa apakah username dan password benar
    if (username === 'admin' && password === 'admin') {
      // Jika benar, arahkan pengguna ke halaman index.html
      window.location.href = '../index.html';
    } else {
      // Jika salah, tampilkan pesan kesalahan atau lakukan tindakan lain
      alert('Username or password is incorrect. Please try again.');
    }
  });
</script>
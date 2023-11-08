<?php
require_once "koneksi.php";
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Digunkan untuk menghubungkan ke framework Bootstrap   -->
    <!-- Bootstrap offline -->
    <link rel="stylesheet" href="assets/css/bootstrap.css">

    <!-- Bootstrap Online -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    
    <title>Sistem Informasi Poliklinik</title>
</head>
<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg  navbar-dark bg-dark" >
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">
      Sistem Informasi Poliklinik
    </a>
    <button class="navbar-toggler"
    type="button" data-bs-toggle="collapse"
    data-bs-target="#navbarNavDropdown"
    aria-controls="navbarNavDropdown" aria-expanded="false"
    aria-label="Toggle navigation">
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="index.php">
            Home
          </a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button"
          data-bs-toggle="dropdown" aria-expanded="false">
            Data Master
          </a>
          <ul class="dropdown-menu">
            <li>
              <a class="dropdown-item" href="index.php?page=dokter">
                Dokter
              </a>
            </li>
            <li>
              <a class="dropdown-item" href="index.php?page=pasien">
                Pasien
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link" 
          href="index.php?page=periksa">
            Periksa
          </a>
        </li>
        
        <?php
        session_start();
        if (isset($_SESSION['user_id'])) {
          // Jika pengguna sudah login, tampilkan opsi Logout
          echo '<li class="nav-item" style="position: absolute; right: 1em;">';
          echo '<a class="nav-link" href="index.php?page=logout">Logout</a>';
          echo '</li>';
        } else {
          // Jika pengguna belum login, tampilkan opsi Login dan Register
          echo '<li class="nav-item" style="position: absolute; right: 1em;">';
          echo '<a class="nav-link" href="index.php?page=login">Login</a>';
          echo '</li>';
          echo '<li class="nav-item" style="position: absolute; right: 5em;">';
          echo '<a class="nav-link" href="index.php?page=register">Register</a>';
          echo '</li>';
        }
      ?>
        
      </ul>
    </div>
  </div>
</nav>

<!-- kode ini digunakan untuk membuat halaman web yang dapat menampilkan konten dinamis berdasarkan parameter GET 'page' yang diberikan dalam URL -->
<main role="main" class="container">
    <?php
    if (isset($_GET['page'])) {
    ?>
        <h2><br><?php echo ucwords($_GET['page']) ?></h2>
        <hr>
    <?php
        include($_GET['page'] . ".php");
    } else {
    ?>
      <body style="background-image: url('img/1.jpg'); background-size: cover; background-repeat: no-repeat; background-position: center 30px;">
      <br><br><br><br><br></BR>
      <h3>Selamat Datang di</h3>
      <h2>SISTEM INFORMASI POLIKLINIK</h2>
      <hr style='width: 42%; height:5px; opacity:1; border-width:0; color:#0275d8;'>
      </body>
    <?php
    }
    ?>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>
</html>
<?php
if (!isset($_SESSION['user_id'])) {
  header('Location: index.php?page=login');
  exit;
}

include'koneksi.php';
?>

<div class="container">
<form class="form row" method="POST" action="" name="myForm" onsubmit="return(validate());">
   <!-- Kode php untuk menghubungkan form dengan database -->
    <?php
    $nama = '';
    $alamat = '';
    $no_hp = '';
    if (isset($_GET['id'])) {
        $ambil = mysqli_query($mysqli, 
        "SELECT * FROM pasien 
        WHERE id='" . $_GET['id'] . "'");
        while ($row = mysqli_fetch_array($ambil)) {
            $nama = $row['nama'];
            $alamat = $row['alamat'];
            $no_hp = $row['no_hp'];
        }

    ?>
        <input type="hidden" name="id" value="<?php echo
        $_GET['id'] ?>">
    <?php
    }
    ?>

    <!-- Kode untuk membuat tampilan form input dan tombol submit -->
    <div class="col">
        <label for="inputNama" class="form-label fw-bold">
            Nama Pasien
        </label>
        <input type="varchar" class="form-control" name="nama" id="inputNama" placeholder="Nama Pasien" value="<?php echo $nama ?>">
    </div>
    <div class="col">
        <label for="inputAlamat" class="form-label fw-bold">
            Alamat
        </label>
        <input type="varchar" class="form-control" name="alamat" id="inputAlamat" placeholder="Alamat" value="<?php echo $alamat ?>">
    </div>
    <div class="col mb-4">
        <label for="inputNo_hp" class="form-label fw-bold">
        Nomor Handphone
        </label>
        <input type="varchar" class="form-control" name="no_hp" id="inputNo_hp" placeholder="Nomor Handphone" value="<?php echo $no_hp ?>">
    </div>
    <div class="col mt-4">
        <button type="submit" class="btn btn-primary rounded-pill px-3" name="simpan">Simpan</button>
    </div>
</form>

<!-- Table-->
<table class="table table-hover">
    <!--thead atau baris judul-->
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nama Pasien</th>
            <th scope="col">Alamat</th>
            <th scope="col">Nomor Handphone</th>
            <th scope="col">Aksi</th>
        </tr>
    </thead>

    <!--tbody berisi isi tabel sesuai dengan judul atau head-->
    <tbody>
    <?php
   $result = mysqli_query(
      $mysqli,"SELECT * FROM pasien ORDER BY nama"
      );
    $no = 1;
    while ($data = mysqli_fetch_array($result)) {
    ?>
    <tr>
        <th scope="row"><?php echo $no++ ?></th>
        <td><?php echo $data['nama'] ?></td>
        <td><?php echo $data['alamat'] ?></td>
        <td><?php echo $data['no_hp'] ?></td>
        <td>
          <a class="btn btn-success rounded-pill px-3" 
          href="index.php?page=pasien&id=<?php echo $data['id'] ?>">Ubah
          </a>
          <a class="btn btn-danger rounded-pill px-3" 
          href="index.php?page=pasien&id=<?php echo $data['id'] ?>&aksi=hapus">Hapus
          </a>
        </td>
      </tr>
      <?php
      }
      ?>
    </tbody>
    </table>
</div>

<?php
if (isset($_POST['simpan'])) {
    if (isset($_POST['id'])) {
        $ubah = mysqli_query($mysqli, "UPDATE Pasien SET 
                                        nama = '" . $_POST['nama'] . "',
                                        alamat = '" . $_POST['alamat'] . "',
                                        no_hp = '" . $_POST['no_hp'] . "'
                                        WHERE
                                        id = '" . $_POST['id'] . "'");
    } else {
        $tambah = mysqli_query($mysqli, "INSERT INTO pasien (nama, alamat, no_hp) 
        VALUES (
            '" . $_POST['nama'] . "',
            '" . $_POST['alamat'] . "',
            '" . $_POST['no_hp'] . "'
                                            )");
    }

    echo "<script> 
            document.location='index.php?page=pasien';
            </script>";
}

if (isset($_GET['aksi'])) {
    if ($_GET['aksi'] == 'hapus') {
        $hapus = mysqli_query($mysqli, "DELETE FROM pasien WHERE id = '" . $_GET['id'] . "'");
    } else if ($_GET['aksi'] == 'ubah_status') {
        $ubah_status = mysqli_query($mysqli, "UPDATE pasien SET 
                                        status = '" . $_GET['status'] . "' 
                                        WHERE
                                        id = '" . $_GET['id'] . "'");
    }

    echo "<script> 
            document.location='index.php?page=pasien';
            </script>";
}
?>

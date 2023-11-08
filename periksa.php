<?php

if (!isset($_SESSION['user_id'])) {
  header('Location: index.php?page=login');
  exit;


include'koneksi.php';
}

?>

<div class="container">
<form class="form row" method="POST" action="" name="myForm" onsubmit="return validate()">
    <!-- Kode php untuk menghubungkan form dengan database -->
    <?php
    $id_pasien = '';
    $id_dokter = '';
    $tgl_periksa = '';
    $catatan = '';
    $obat = '';

    if (isset($_GET['id'])) {
        $ambil = mysqli_query($mysqli, 
        "SELECT * FROM periksa
        WHERE id='1" . $_GET['id'] . "'");
        while ($row = mysqli_fetch_array($ambil)) {
            $id_pasien= $row['id_pasien'];
            $id_dokter = $row['id_dokter'];
            $tgl_prtiksa = $row['tgl_periksa'];
            $catatan = $row['catatan'];
            $obat = $row['obat'];
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
      <select class="form-control" name="id_pasien">
        <?php
        $selected = '';
        $pasien = mysqli_query($mysqli, "SELECT * FROM pasien");
        while ($data = mysqli_fetch_array($pasien)) {
            if ($data['id'] == $id_pasien) {
                $selected = 'selected="selected"';
            } else {
                $selected = '';
            }
        ?>
            <option value="<?php echo $data['id'] ?>" <?php echo $selected ?>><?php echo $data['nama'] ?></option>
        <?php
        }
        ?>
      </select>
    </div>
    <div class="col">
        <label for="inputAlamat" class="form-label fw-bold">
            Nama Dokter
        </label>
        <select class="form-control" name="id_dokter">
        <?php
        $selected = '';
        $dokter = mysqli_query($mysqli, "SELECT * FROM dokter");
        while ($data = mysqli_fetch_array($dokter)) {
            if ($data['id'] == $id_dokter) {
                $selected = 'selected="selected"';
            } else {
                $selected = '';
            }
        ?>
            <option value="<?php echo $data['id'] ?>" <?php echo $selected ?>><?php echo $data['nama'] ?></option>
        <?php
        }
        ?>
    </select>
    </div>

    <!-- Kode untuk membuat tampilan form input dan tombol submit -->
    <div class="col mb-2">
        <label for="inputNo_hp" class="form-label fw-bold">
        Tanggal Periksa
        </label>
        <input type="datetime-local" class="form-control" name="tgl_periksa" id="inputTgl_periksa" placeholder="Tanggal Periksa" value="<?php echo $tgl_periksa; ?>">
    </div>
    <div class="col mb-4">
        <label for="inputNo_hp" class="form-label fw-bold">
        Catatan
        </label>
        <input type="text" class="form-control" name="catatan" id="inputCatatan" placeholder="Catatan" value="<?php echo $catatan; ?>">
    </div>
    <div class="col mb-4">
        <label for="inputNo_hp" class="form-label fw-bold">
        Obat
        </label>
        <input type="text" class="form-control" name="obat" id="inputObat" placeholder="Obat" value="<?php echo $obat; ?>">
    </div>
    <div class="col mt-4">
        <button type="submit" class="btn btn-primary rounded-pill px-3" name="simpan">Simpan</button>
    </div>
</form>

<!-- Table-->
<table class="table table-hover mt-8">
    <!--thead atau baris judul-->
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nama Pasien</th>
            <th scope="col">Nama Dokter</th>
            <th scope="col">Tanggal Periksa</th>
            <th scope="col">Catatan</th>
            <th scope="col">Obat</th>
            <th scope="col">Aksi</th>
        </tr>
    </thead>

    <!--tbody berisi isi tabel sesuai dengan judul atau head-->
    <tbody>
    <tbody method="post" action="index.php?page=periksa">
    <?php
    $result = mysqli_query($mysqli, "SELECT pr.*,d.nama as 'nama_dokter', p.nama as 'nama_pasien' FROM periksa pr LEFT JOIN dokter d ON (pr.id_dokter=d.id) LEFT JOIN pasien p ON (pr.id_pasien=p.id) ORDER BY pr.tgl_periksa DESC");
    $no = 1;
    while ($data = mysqli_fetch_array($result)) {
    ?>
    <tr>
        <td><?php echo $no++ ?></td>
        <td><?php echo $data['nama_pasien'] ?></td>
        <td><?php echo $data['nama_dokter'] ?></td>
        <td><?php echo $data['tgl_periksa'] ?></td>
        <td><?php echo $data['catatan'] ?></td>
        <td><?php echo $data['obat'] ?></td>
        <td>
            <a class="btn btn-success rounded-pill px-3" 
            href="index.php?page=periksa&id=<?php echo $data['id'] ?>">Ubah</a>
            <a class="btn btn-danger rounded-pill px-3" 
            href="index.php?page=periksa&id=<?php echo $data['id'] ?>&aksi=hapus">Hapus</a>
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

    $id_pasien = $_POST['id_pasien'];
    $id_dokter = $_POST['id_dokter'];
    $tgl_periksa = $_POST['tgl_periksa'];
    $catatan = $_POST['catatan'];
    $obat = $_POST['obat'];

    if (!isset($_GET['id'])) {
        $query = "INSERT INTO periksa (id_pasien, id_dokter, tgl_periksa, catatan, obat)
        VALUES ('$id_pasien', '$id_dokter', '$tgl_periksa', '$catatan', '$obat')";
    } else {
        $query =$query = "UPDATE `periksa` SET `id_pasien` = '$id_pasien', `id_dokter` = '$id_dokter', `tgl_periksa` = '$tgl_periksa', `catatan` = '$catatan', 'obat' = '$obat' WHERE `id` = '" . $_GET['id'] . "'";
    }
    $result = mysqli_query($mysqli, $query);
    echo "<script> 
    document.location='index.php?page=periksa';
    </script>";
}

if (isset($_GET['aksi'])) {
    if ($_GET['aksi'] == 'hapus') {
        $hapus = mysqli_query($mysqli, "DELETE FROM periksa WHERE id = '" . $_GET['id'] . "'");
    } else if ($_GET['aksi'] == 'ubah_status') {
        $ubah_status = mysqli_query($mysqli, "UPDATE periksa SET 
                                        status = '" . $_GET['status'] . "' 
                                        WHERE
                                        id = '" . $_GET['id'] . "'");
    }

    echo "<script> 
            document.location='index.php?page=periksa';
            </script>";
}
?>



<?php
require_once '../conn2.php';

if ($_SESSION['login'] != true) {
   echo "<script>alert('Hayooo, mau ngehek dek?'); window.location.href = '../index.php';</script>";
   exit;
}

$kotas = mysqli_query($conn, "SELECT * FROM kota ORDER BY id DESC");
$ortus = mysqli_query($conn, "SELECT * FROM ortu ORDER BY id DESC");
$kelass = mysqli_query($conn, "SELECT * FROM kelas ORDER BY id DESC");

// save data
if (isset($_POST['save'])) {
   $nama = $_POST['nama'];
   $jenkel = $_POST['jenkel'];
   $no_hp = $_POST['no_hp'];
   $kota = $_POST['kota'];
   $kelas = $_POST['kelas'];
   $ortu = $_POST['ortu'];
   $alamat = $_POST['alamat'];

   $execute = mysqli_query($conn, "INSERT INTO siswa(nama, jenkel, no_hp, alamat, kelas_id, ortu_id, kota_id) VALUES('$nama', '$jenkel', '$no_hp', '$alamat', '$kelas', '$ortu', '$kota')");

   if ($execute) {
      echo "<script>alert('Data Berhasil disimpan :p'); window.location.href = 'index.php';</script>";
      exit;
   } else {
      echo "<script>alert('Upss... Data gagal disimpan'); window.location.href = 'index.php';</script>";
      exit;
   }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Tambah Siswa</title>
   <link rel="stylesheet" href="../style.css">
   <style>
      .container {
         width: 50%;
         padding: 20px;
         margin: auto;
         margin: 30px auto;
         border: 10px double chocolate;
      }
   </style>
</head>

<body>
   <?php require_once '../navbar.php' ?>
   <main>
      <div class="container">
         <div class="infwrap">
            <h1>Tambah Siswa</h1>
            <a class="btnback" href="index.php"><span class="fas fa-arrow-left"></span> Kembali</a>
         </div>
         <div class="space"></div>
         <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
            <div class="form-group">
               <label for="name">Nama Siswa</label><br>
               <input type="text" required name="nama" id="">
            </div>
            <div class="form-group">
               <label for="jenkel">Jenis Kelamin</label>
               <select name="jenkel" required id="">
                  <option value="">-- Pilih Kemaluan --</option>
                  <option value="L">LAKI LAKI</option>
                  <option value="P">PEREMPUAN</option>
               </select>
            </div>
            <div class="form-group">
               <label for="name">No. HP</label><br>
               <input type="number" min="0" required name="no_hp" id="">
            </div>
            <div class="form-group">
               <label for="kelas">Kelas</label>
               <select name="kelas" required id="">
                  <option value="">-- Pilih Kelas --</option>
                  <?php while ($kelas = mysqli_fetch_object($kelass)) : ?>
                     <option value="<?= $kelas->id ?>"><?= $kelas->nama_kelas ?></option>
                  <?php endwhile; ?>
               </select>
            </div>
            <div class="form-group">
               <label for="ortu">Ortu</label>
               <select name="ortu" required id="">
                  <option value="">-- Pilih Ortu --</option>
                  <?php while ($ortu = mysqli_fetch_object($ortus)) : ?>
                     <option value="<?= $ortu->id ?>">Ayah : <?= $ortu->nama_ayah ?> | Ibu : <?= $ortu->nama_ibu ?></option>
                  <?php endwhile; ?>
               </select>
            </div>
            <div class="form-group">
               <label for="kota">Kota</label>
               <select name="kota" required id="">
                  <option value="">-- Pilih Kota --</option>
                  <?php while ($kota = mysqli_fetch_object($kotas)) : ?>
                     <option value="<?= $kota->id ?>"><?= $kota->nama_kota ?></option>
                  <?php endwhile; ?>
               </select>
            </div>
            <div class="form-group">
               <label for="name">Alamat Siswa</label><br>
               <textarea name="alamat" id="" rows="5"></textarea>
            </div>
            <div class="form-group">
               <button class="btnsave" type="submit" name="save">Simpan</button>
            </div>
         </form>
      </div>
   </main>

</body>

</html>
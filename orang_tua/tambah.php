<?php
require_once '../conn2.php';

if ($_SESSION['login'] != true) {
   echo "<script>alert('Hayooo, mau ngehek dek?'); window.location.href = '../index.php';</script>";
   exit;
}

$kotas = mysqli_query($conn, "SELECT * FROM kota ORDER BY id DESC");

// save data
if (isset($_POST['save'])) {
   $nama_ayah = $_POST['nama_ayah'];
   $nama_ibu = $_POST['nama_ibu'];
   $no_hp = $_POST['no_hp'];
   $kota = $_POST['kota'];
   $alamat = $_POST['alamat'];

   $execute = mysqli_query($conn, "INSERT INTO ortu(nama_ayah, nama_ibu, no_hp, alamat, kota_id) VALUES('$nama_ayah', '$nama_ibu', '$no_hp', '$alamat', '$kota')");

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
   <title>Tambah Ortu</title>
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
            <h1>Tambah Ortu</h1>
            <a class="btnback" href="index.php"><span class="fas fa-arrow-left"></span> Kembali</a>
         </div>
         <div class="space"></div>
         <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
            <div class="form-group">
               <label for="name">Nama Ayah</label><br>
               <input type="text" required name="nama_ayah" id="">
            </div>
            <div class="form-group">
               <label for="name">Nama Ibu</label><br>
               <input type="text" required name="nama_ibu" id="">
            </div>
            <div class="form-group">
               <label for="name">No. HP</label><br>
               <input type="number" min="0" required name="no_hp" id="">
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
               <label for="name">Alamat</label><br>
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
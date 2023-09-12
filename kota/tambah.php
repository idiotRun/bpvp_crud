<?php
require_once '../conn2.php';

if ($_SESSION['login'] != true) {
   echo "<script>alert('Hayooo, mau ngehek dek?'); window.location.href = '../index.php';</script>";
   exit;
}

// save data
if (isset($_POST['save'])) {
   $nama = $_POST['nama'];

   $execute = mysqli_query($conn, "INSERT INTO kota(nama_kota) VALUES('$nama')");

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
   <title>Tambah Kota</title>
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
            <h1>Tambah Kota</h1>
            <a class="btnback" href="index.php"><span class="fas fa-arrow-left"></span> Kembali</a>
         </div>
         <div class="space"></div>
         <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
            <div class="form-group">
               <label for="name">Nama Kota</label><br>
               <input type="text" required name="nama" id="">
            </div>
            <div class="form-group">
               <button class="btnsave" type="submit" name="save">Simpan</button>
            </div>
         </form>
      </div>
   </main>

</body>

</html>
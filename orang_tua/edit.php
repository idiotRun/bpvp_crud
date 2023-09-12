<?php
require_once '../conn2.php';

if ($_SESSION['login'] != true) {
   echo "<script>alert('Hayooo, mau ngehek dek?'); window.location.href = '../index.php';</script>";
   exit;
}

// check id sent
if (empty($_GET['id'])) {
   echo "<script>alert('Upss... Harus ada ID yang dikirim'); window.location.href = 'index.php';</script>";
   exit;
}

$kotas = mysqli_query($conn, "SELECT * FROM kota ORDER BY id DESC");

$id = $_GET['id'];
$dataGet = mysqli_query($conn, "SELECT * FROM ortu WHERE id = '$id'");
$data = mysqli_fetch_object($dataGet);

// update data
if (isset($_POST['update'])) {
   $nama_ayah = $_POST['nama_ayah'];
   $nama_ibu = $_POST['nama_ibu'];
   $no_hp = $_POST['no_hp'];
   $kota = $_POST['kota'];
   $alamat = $_POST['alamat'];

   $execute = mysqli_query($conn, "UPDATE ortu SET nama_ayah = '$nama_ayah', nama_ibu = '$nama_ibu', no_hp = '$no_hp', kota_id = '$kota', alamat = '$alamat' WHERE id = '$id'");

   if ($execute) {
      echo "<script>alert('Data Berhasil diubah :p'); window.location.href = 'index.php';</script>";
      exit;
   } else {
      echo "<script>alert('Upss... Data gagal diubah'); window.location.href = 'index.php';</script>";
      exit;
   }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Edit Ortu</title>
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
            <h1>Edit Ortu</h1>
            <a class="btnback" href="index.php"><span class="fas fa-arrow-left"></span> Kembali</a>
         </div>
         <form action="edit.php?id=<?= $id ?>" method="post" enctype="multipart/form-data">
            <div class="form-group">
               <label for="name">Nama Ayah</label><br>
               <input type="text" required value="<?= $data->nama_ayah ?>" name="nama_ayah" id="">
            </div>
            <div class="form-group">
               <label for="name">Nama Ibu</label><br>
               <input type="text" required value="<?= $data->nama_ibu ?>" name="nama_ibu" id="">
            </div>
            <div class="form-group">
               <label for="name">No. HP</label><br>
               <input type="number" min="0" required value="<?= $data->no_hp ?>" name="no_hp" id="">
            </div>
            <div class="form-group">
               <label for="kota">Kota</label>
               <select name="kota" required id="">
                  <option value="">-- Pilih Kota --</option>
                  <?php while ($kota = mysqli_fetch_object($kotas)) : ?>
                     <option value="<?= $kota->id ?>" <?= $kota->id == $data->kota_id ? 'selected' : '' ?>><?= $kota->nama_kota ?></option>
                  <?php endwhile; ?>
               </select>
            </div>
            <div class="form-group">
               <label for="name">Alamat</label><br>
               <textarea name="alamat" id="" rows="5"><?= $data->alamat ?></textarea>
            </div>
            <div class="form-group">
               <button class="btnsave" type="submit" name="update">Update</button>
            </div>
         </form>
      </div>
   </main>

</body>

</html>
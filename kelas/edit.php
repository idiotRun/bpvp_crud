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

$id = $_GET['id'];
$dataGet = mysqli_query($conn, "SELECT * FROM kelas WHERE id = '$id'");
$data = mysqli_fetch_object($dataGet);

// update data
if (isset($_POST['update'])) {
   $nama = $_POST['nama'];

   $execute = mysqli_query($conn, "UPDATE kelas SET nama_kelas = '$nama' WHERE id = '$id'");

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
   <title>Edit Kelas</title>
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
            <h1>Edit Kelas</h1>
            <a class="btnback" href="index.php"><span class="fas fa-arrow-left"></span> Kembali</a>
         </div>
         <form action="edit.php?id=<?= $id ?>" method="post" enctype="multipart/form-data">
            <div class="form-group">
               <label for="nama">Nama Kelas</label><br>
               <input type="text" value="<?= $data->nama_kelas ?>" required name="nama" id="">
            </div>
            <div class="form-group">
               <button class="btnsave" type="submit" name="update">Update</button>
            </div>
         </form>
      </div>
   </main>

</body>

</html>
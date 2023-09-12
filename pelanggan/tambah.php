<?php
require_once '../conn.php';

// save data
if (isset($_POST['save'])) {
   $name = $_POST['name'];
   $no_hp = $_POST['no_hp'];
   $alamat = $_POST['alamat'];

   $execute = mysqli_query($conn, "INSERT INTO pelanggan(name, no_hp, alamat) VALUES('$name', '$no_hp', '$alamat')");

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
   <title>Tambah Pelanggan</title>
   <style>
      * {
         margin: 0;
         padding: 0;
         box-sizing: border-box;
         font-family: 'Fake Receipt';
      }

      .container {
         width: 50%;
         padding: 20px;
         margin: 30px auto;
         border: 10px double chocolate;
      }

      .space {
         margin-bottom: 20px;
      }

      .btnback {
         padding: 10px 20px;
         outline: none;
         border-radius: 6px;
         background-color: blue;
         color: white;
         text-decoration: none;
         font-weight: bold;
         text-transform: uppercase;
      }

      .btnback:hover {
         background-color: darkblue;
      }

      .btnsave {
         width: 100%;
         padding: 10px 20px;
         outline: none;
         border-radius: 6px;
         background-color: orange;
         color: black;
         text-decoration: none;
         font-weight: bold;
         text-transform: uppercase;
      }

      .btnsave:hover {
         background-color: darkorange;
      }

      form {
         width: 100%;
      }

      label {
         display: inline-block;
         width: 100%;
         margin-bottom: 6px;
      }

      input,
      textarea {
         width: 100%;
         max-width: 100%;
         background-color: white;
         outline: none;
         border: 1.5px solid grey;
         padding: 10px 20px;
      }

      .infwrap {
         display: flex;
         justify-content: space-between;
      }

      .form-group {
         margin-bottom: 15px;
      }

      .imgwrap {
         display: flex;
         justify-content: center;
      }

      .imgwrap img {
         max-width: 100%;
         border: 3px double black;
      }
   </style>
</head>

<body>
   <div class="container">
      <div class="infwrap">
         <h1>Tambah Pelanggan</h1>
         <a class="btnback" href="index.php"><span class="fas fa-arrow-left"></span> Kembali</a>
      </div>
      <div class="space"></div>
      <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
         <div class="form-group">
            <label for="name">Nama Pelanggan</label><br>
            <input type="text" required name="name" id="">
         </div>
         <div class="form-group">
            <label for="no_hp">No. HP</label><br>
            <input type="number" min="0" required name="no_hp" id="">
         </div>
         <div class="form-group">
            <label for="alamat">Alamat</label><br>
            <textarea name="alamat" id="" rows="5"></textarea>
         </div>
         <div class="form-group">
            <button class="btnsave" type="submit" name="save">Simpan</button>
         </div>
      </form>
   </div>

</body>

</html>
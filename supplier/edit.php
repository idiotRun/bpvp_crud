<?php
require_once '../conn.php';

// check id sent
if (empty($_GET['id'])) {
   echo "<script>alert('Upss... Harus ada ID yang dikirim'); window.location.href = 'index.php';</script>";
   exit;
}

$id = $_GET['id'];
$dataGet = mysqli_query($conn, "SELECT * FROM supplier WHERE id = '$id'");
$data = mysqli_fetch_object($dataGet);

// update data
if (isset($_POST['update'])) {
   $name = $_POST['name'];
   $no_hp = $_POST['no_hp'];
   $alamat = $_POST['alamat'] ?? '-';
   $status = $_POST['status'];

   $execute = mysqli_query($conn, "UPDATE supplier SET name = '$name', no_hp = '$no_hp', alamat = '$alamat', status = '$status' WHERE id = '$id'");

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
   <title>Edit Supplier</title>
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
         margin: auto;
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
      select,
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
         <h1>Edit Supplier</h1>
         <a class="btnback" href="index.php"><span class="fas fa-arrow-left"></span> Kembali</a>
      </div>
      <form action="edit.php?id=<?= $id ?>" method="post" enctype="multipart/form-data">
         <div class="form-group">
            <label for="name">Nama Supplier</label><br>
            <input type="text" value="<?= $data->name ?>" required name="name" id="">
         </div>
         <div class="form-group">
            <label for="no_hp">No. HP</label><br>
            <input type="number" value="<?= $data->no_hp ?>" min="0" required name="no_hp" id="">
         </div>
         <div class="form-group">
            <label for="status">Status</label>
            <select name="status" required id="">
               <option value="">-- Pilih Status --</option>
               <option value="A" <?= $data->status == 'A' ? 'selected' : '' ?>>AKTIF</option>
               <option value="TA" <?= $data->status == 'TA' ? 'selected' : '' ?>>TIDAK AKTIF</option>
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

</body>

</html>
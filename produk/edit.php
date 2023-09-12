<?php
require_once '../conn.php';

// check id sent
if (empty($_GET['id'])) {
   echo "<script>alert('Upss... Harus ada ID yang dikirim'); window.location.href = 'index.php';</script>";
   exit;
}

$id = $_GET['id'];
$dataGet = mysqli_query($conn, "SELECT * FROM products WHERE id = '$id'");
$data = mysqli_fetch_object($dataGet);

// update data
if (isset($_POST['update'])) {
   $name = $_POST['name'];
   $price = $_POST['price'];
   $quantity = $_POST['quantity'];
   $description = $_POST['description'] ?? '-';

   if (!empty($_FILES["file"]["name"])) {
      // check file already saved
      if (!empty($data->foto)) {
         unlink('file/' . $data->foto);
      }

      $targetDir = "file/";

      $fileName = $_FILES["file"]["name"];
      $fileSize = $_FILES["file"]["size"];
      $fileTmpName = $_FILES["file"]["tmp_name"];

      $allowedExtensions = array("jpg", "jpeg", "png", "webp", "gif");

      $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
      if (!in_array($fileExtension, $allowedExtensions)) {
         echo "Hanya file dengan ekstensi JPG, JPEG, PNG, WEBP, atau GIF yang diizinkan.";
         exit;
      }

      // Validasi ukuran file
      $maxFileSize = 2 * 1024 * 1024;
      if ($fileSize > $maxFileSize) {
         echo "Ukuran file melebihi batas maksimal 2MB.";
         exit;
      }

      $uniqueFileName = uniqid() . "." . $fileExtension;

      $targetPath = $targetDir . $uniqueFileName;
      if (move_uploaded_file($fileTmpName, $targetPath)) {
         $execute = mysqli_query($conn, "UPDATE products SET name = '$name', price = '$price', quantity = '$quantity', description = '$description', foto = '$uniqueFileName' WHERE id = '$id'");

         if ($execute) {
            echo "<script>alert('Data Berhasil diubah :p'); window.location.href = 'index.php';</script>";
            exit;
         } else {
            echo "<script>alert('Upss... Data gagal diubah'); window.location.href = 'index.php';</script>";
            exit;
         }
      } else {
         echo "Terjadi kesalahan saat mengunggah gambar.";
      }
   } else {
      $execute = mysqli_query($conn, "UPDATE products SET name = '$name', price = '$price', quantity = '$quantity', description = '$description' WHERE id = '$id'");

      if ($execute) {
         echo "<script>alert('Data Berhasil diubah :p'); window.location.href = 'index.php';</script>";
         exit;
      } else {
         echo "<script>alert('Upss... Data gagal diubah'); window.location.href = 'index.php';</script>";
         exit;
      }
   }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Edit Produk</title>
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
         <h1>Edit Produk</h1>
         <a class="btnback" href="index.php"><span class="fas fa-arrow-left"></span> Kembali</a>
      </div>
      <form action="edit.php?id=<?= $id ?>" method="post" enctype="multipart/form-data">
         <div class="form-group">
            <label for="name">Nama Produk</label><br>
            <input type="text" value="<?= $data->name ?>" required name="name" id="">
         </div>
         <div class="form-group">
            <label for="price">Harga</label><br>
            <input type="number" value="<?= $data->price ?>" min="0" required name="price" id="">
         </div>
         <div class="form-group">
            <label for="quantity">Quantity</label><br>
            <input type="number" value="<?= $data->quantity ?>" min="0" required name="quantity" id="">
         </div>
         <div class="form-group">
            <label for="">Preview</label><br>
            <div class="imgwrap">
               <img class="imgPrev" src="file/<?= $data->foto ?>" width="200px" alt="">
            </div>
         </div>
         <div class="form-group">
            <label for="file">Foto (Opsional)</label><br>
            <input type="file" onchange="showPreview(this)" name="file" id="">
         </div>
         <div class="form-group">
            <label for="name">Deskripsi</label><br>
            <textarea name="description" id="" rows="5"><?= $data->description ?></textarea>
         </div>
         <div class="form-group">
            <button class="btnsave" type="submit" name="update">Update</button>
         </div>
      </form>
   </div>

   <script>
      function showPreview(input) {
         var fileInput = document.querySelector("input[type=file]");
         var file = fileInput.files[0];

         if (file) {
            var reader = new FileReader();
            reader.onload = function() {
               var imgPrev = document.querySelector(".imgPrev");
               imgPrev.src = reader.result;
            };
            reader.readAsDataURL(file);
         }
      }
   </script>
</body>

</html>
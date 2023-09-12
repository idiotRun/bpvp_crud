<?php
require_once '../conn2.php';

if ($_SESSION['login'] != true) {
   echo "<script>alert('Hayooo, mau ngehek dek?'); window.location.href = '../index.php';</script>";
   exit;
}

// show data
$pels = mysqli_query($conn, "SELECT * FROM kota ORDER BY id DESC");
$no = 1;

?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Data Kota</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
   <link rel="stylesheet" href="../style.css">
</head>

<body>
   <?php require_once '../navbar.php' ?>
   <main>
      <div class="container">
         <div class="infwrap">
            <h1>Data Kota</h1>
            <a class="btnadd" href="tambah.php"><span class="fas fa-plus-circle"></span> Tambah Data</a>
         </div>
         <div class="space"></div>
         <table border="1" width="100%">
            <thead>
               <tr>
                  <th>No.</th>
                  <th>Nama</th>
                  <th>Aksi</th>
               </tr>
            </thead>
            <tbody>
               <?php while ($data = mysqli_fetch_object($pels)) : ?>
                  <tr class="">
                     <td><?= $no++ ?></td>
                     <td><?= htmlspecialchars($data->nama_kota) ?></td>
                     <td>
                        <div class="btnwrap">
                           <a class="btnedit" href="edit.php?id=<?= $data->id ?>"><span class="fas fa-pencil"></span></a>
                           <a class="btnremove" onclick="return confirm('Antum yakin ingin menghapus data ini?')" href="hapus.php?id=<?= $data->id ?>"><span class="fas fa-trash"></span></a>
                        </div>
                     </td>
                  </tr>
               <?php endwhile; ?>
            </tbody>
         </table>
      </div>
   </main>

   <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js" integrity="sha512-uKQ39gEGiyUJl4AI6L+ekBdGKpGw4xJ55+xyJG7YFlJokPNYegn9KwQ3P8A7aFQAUtUsAQHep+d/lrGqrbPIDQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>

</html>
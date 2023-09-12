<?php
require_once '../conn.php';

// show data
$pels = mysqli_query($conn, "SELECT * FROM supplier ORDER BY id DESC");
$no = 1;

?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Data Supplier</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
   <style>
      * {
         margin: 0;
         padding: 0;
         box-sizing: border-box;
         font-family: 'Fake Receipt';
      }

      .container {
         width: 80%;
         padding: 20px;
         margin: auto;
      }

      table {
         border-collapse: collapse;
      }

      table,
      tr,
      th,
      td {
         border: 3px dashed chocolate;
      }

      td {
         padding: 10px;
      }

      table thead {
         background-color: bisque;
      }

      table thead th {
         padding: 10px;
      }

      table tbody tr:hover {
         background-color: bisque;
      }

      .space {
         margin-bottom: 20px;
      }

      .btnadd {
         padding: 10px 20px;
         outline: none;
         border-radius: 6px;
         background-color: blue;
         color: white;
         text-decoration: none;
         font-weight: bold;
         text-transform: uppercase;
      }

      .btnadd:hover {
         background-color: darkblue;
      }

      .btnedit {
         padding: 5px 10px;
         outline: none;
         border-radius: 6px;
         background-color: orange;
         color: white;
         text-decoration: none;
         font-weight: bold;
         text-transform: uppercase;
      }

      .btnedit:hover {
         background-color: darkorange;
      }

      .btnremove {
         padding: 5px 10px;
         outline: none;
         border-radius: 6px;
         background-color: red;
         color: white;
         text-decoration: none;
         font-weight: bold;
         text-transform: uppercase;
      }

      .btnremove:hover {
         background-color: darkred;
      }

      .btnwrap {
         display: flex;
         gap: 5px;
      }

      .infwrap {
         display: flex;
         justify-content: space-between;
      }

      img:hover {
         scale: 1.25;
      }
   </style>
</head>

<body>
   <div class="container">
      <div class="infwrap">
         <h1>Data Supplier</h1>
         <a class="btnadd" href="tambah.php"><span class="fas fa-plus-circle"></span> Tambah Data</a>
      </div>
      <div class="space"></div>
      <table border="1" width="100%">
         <thead>
            <tr>
               <th>No.</th>
               <th>Nama</th>
               <th>No. HP</th>
               <th>Alamat</th>
               <th>Status</th>
               <th>Aksi</th>
            </tr>
         </thead>
         <tbody>
            <?php while ($data = mysqli_fetch_object($pels)) : ?>
               <tr class="">
                  <td><?= $no++ ?></td>
                  <td><?= htmlspecialchars($data->name) ?></td>
                  <td><?= $data->no_hp ?></td>
                  <td><?= $data->alamat ?></td>
                  <td><?= $data->status ?></td>
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

   <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js" integrity="sha512-uKQ39gEGiyUJl4AI6L+ekBdGKpGw4xJ55+xyJG7YFlJokPNYegn9KwQ3P8A7aFQAUtUsAQHep+d/lrGqrbPIDQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>

</html>
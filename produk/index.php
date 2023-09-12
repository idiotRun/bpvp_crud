<?php
require_once '../conn.php';

// show data
$prods = mysqli_query($conn, "SELECT * FROM products ORDER BY id DESC");
$no = 1;

function convertMonth($month)
{
   switch ($month) {
      case '01':
         return 'Januari';
         break;
      case '02':
         return 'Februari';
         break;
      case '03':
         return 'Maret';
         break;
      case '04':
         return 'April';
         break;
      case '05':
         return 'Mei';
         break;
      case '06':
         return 'Juni';
         break;
      case '07':
         return 'Juli';
         break;
      case '08':
         return 'Agustus';
         break;
      case '09':
         return 'September';
         break;
      case '10':
         return 'Oktober';
         break;
      case '11':
         return 'November';
         break;
      case '12':
         return 'Desember';
         break;

      default:
         # code...
         break;
   }
}

function convertDayName($day)
{
   switch ($day) {
      case 1:
         return 'Senin';
         break;
      case 2:
         return 'Selasa';
         break;
      case 3:
         return 'Rabu';
         break;
      case 4:
         return 'Kamis';
         break;
      case 5:
         return 'Jumat';
         break;
      case 6:
         return 'Sabtu';
         break;
      case 0:
         return 'Minggu';
         break;

      default:
         # code...
         break;
   }
}

function customDateInd($date)
{
   $year  = date('Y', strtotime($date));
   $month = date('m', strtotime($date));
   $day   = date('d', strtotime($date));
   $name  = date("w", strtotime($date));

   $formatMonth = convertMonth($month);
   $formatDayName = convertDayName($name);
   return "$formatDayName, $day $formatMonth $year";
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Data Produk</title>
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
         <h1>Data Produk</h1>
         <a class="btnadd" href="tambah.php"><span class="fas fa-plus-circle"></span> Tambah Data</a>
      </div>
      <div class="space"></div>
      <table border="1" width="100%">
         <thead>
            <tr>
               <th>No.</th>
               <th>Foto</th>
               <th>Nama Produk</th>
               <th>Deskripsi</th>
               <th>Harga Satuan</th>
               <th>QTY</th>
               <th>Tgl Dibuat</th>
               <th>Aksi</th>
            </tr>
         </thead>
         <tbody>
            <?php while ($data = mysqli_fetch_object($prods)) : ?>
               <tr class="<?= ($data->quantity < 10) ? 'alert' : '' ?>">
                  <td><?= $no++ ?></td>
                  <td>
                     <?php if (empty($data->foto)) { ?>
                        <img width="100px" height="100px" src="file/not.png" alt="s">
                     <?php } else { ?>
                        <img width="100px" height="100px" src="file/<?= $data->foto ?>" alt="f">
                     <?php } ?>
                  </td>
                  <td><?= htmlspecialchars($data->name) ?></td>
                  <td><?= $data->description ?? '-' ?></td>
                  <td><?= number_format($data->price, 0, '.', '.') ?></td>
                  <td><?= $data->quantity ?></td>
                  <td><?= customDateInd($data->created_at) ?></td>
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
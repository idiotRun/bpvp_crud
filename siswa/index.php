<?php
require_once '../conn2.php';

if ($_SESSION['login'] != true) {
   echo "<script>alert('Hayooo, mau ngehek dek?'); window.location.href = '../index.php';</script>";
   exit;
}

// show data
$pels = mysqli_query($conn, "SELECT *, siswa.id AS kode, siswa.alamat AS lokasi FROM siswa JOIN kota ON kota.id = siswa.kota_id JOIN kelas ON kelas.id = siswa.kelas_id JOIN ortu ON ortu.id = siswa.ortu_id ORDER BY siswa.id DESC");
$no = 1;

?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta name="description" content="A full-stack framework for Laravel that takes the pain out of building dynamic UIs.">
   <link rel="home" href="https://livewire.laravel.com">

   <!-- Social Meta -->
   <meta property="og:site_name" content="Laravel" />
   <meta property="og:title" content="Installation | Laravel" />
   <meta property="og:description" content="A full-stack framework for Laravel that takes the pain out of building dynamic UIs." />
   <meta property="og:url" content="https://livewire.laravel.com/docs/installation" />
   <title>Data Siswa</title>
   <link rel="stylesheet" href="../style.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
   <style>
      .container {
         width: 90% !important;
      }
   </style>
</head>

<body>
   <?php require_once '../navbar.php' ?>
   <main>
      <main>
         <div class="container">
            <div class="infwrap">
               <h1>Data Siswa</h1>
               <a class="btnadd" href="tambah.php"><span class="fas fa-plus-circle"></span> Tambah Data</a>
            </div>
            <div class="space"></div>
            <table border="1" width="100%">
               <thead>
                  <tr>
                     <th>No.</th>
                     <th>Kelas</th>
                     <th>Nama Siswa</th>
                     <th>Jenis Kemaluan</th>
                     <th>No. HP</th>
                     <th>Kota</th>
                     <th>Alamat</th>
                     <th>Aksi</th>
                  </tr>
               </thead>
               <tbody>
                  <?php while ($data = mysqli_fetch_object($pels)) : ?>
                     <tr class="">
                        <td><?= $no++ ?></td>
                        <td><?= htmlspecialchars($data->nama_kelas) ?></td>
                        <td><?= htmlspecialchars($data->nama) ?></td>
                        <td><?= $data->jenkel == 'L' ? 'Laki - Laki' : 'Perempuan' ?></td>
                        <td><?= htmlspecialchars($data->no_hp) ?></td>
                        <td><?= htmlspecialchars($data->nama_kota) ?></td>
                        <td><?= htmlspecialchars($data->lokasi) ?></td>
                        <td>
                           <div class="btnwrap">
                              <a class="btnedit" href="edit.php?id=<?= $data->kode ?>"><span class="fas fa-pencil"></span></a>
                              <a class="btnremove" onclick="return confirm('Antum yakin ingin menghapus data ini?')" href="hapus.php?id=<?= $data->kode ?>"><span class="fas fa-trash"></span></a>
                           </div>
                        </td>
                     </tr>
                     <tr>
                        <td colspan="8" style="background-color: lightskyblue;" align="center"><b>DATA ORANG TUA SISWA</b></td>
                     </tr>
                     <tr>
                        <td colspan="2">No. HP : <?= htmlspecialchars($data->no_hp) ?></td>
                        <td colspan="2">Ayah : <?= htmlspecialchars($data->nama_ayah) ?></td>
                        <td colspan="2">Ibu : <?= htmlspecialchars($data->nama_ibu) ?></td>
                        <td colspan="2">Alamat : <?= htmlspecialchars($data->alamat) ?></td>
                     </tr>
                     <tr>
                        <td colspan="8" style="background-color: lightpink;" align="center">
                           <b>---- BATAS DATA ----</b>
                        </td>
                     </tr>
                  <?php endwhile; ?>
               </tbody>
            </table>
         </div>
      </main>
   </main>

   <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js" integrity="sha512-uKQ39gEGiyUJl4AI6L+ekBdGKpGw4xJ55+xyJG7YFlJokPNYegn9KwQ3P8A7aFQAUtUsAQHep+d/lrGqrbPIDQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>

</html>
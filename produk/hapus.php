<?php 
require_once '../conn.php';

// check if u have id
if(empty($_GET['id'])) {
   echo "<script>alert('Upss... Harus ada ID yang dikirim'); window.location.href = 'index.php';</script>";
   exit;
} else {
   $id = $_GET['id'];
   $remove = mysqli_query($conn, "DELETE FROM products WHERE id = '$id'");

   // check info
   if($remove) {
      echo "<script>alert('Data berhasil dihapus :p'); window.location.href = 'index.php';</script>";
      exit;
   } else {
      echo "<script>alert('Data gagal dihapus, cek kembali kode anda'); window.location.href = 'index.php';</script>";
      exit;
   }
}
?>
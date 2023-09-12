<?php

require_once 'conn2.php';

if($_SESSION['login'] == true) {
   session_destroy();
   echo "<script>alert('Antum berhasil logout'); window.location.href = 'index.php';</script>";
   exit;
} else {
   echo "<script>alert('Antum gagal logout'); window.location.href = 'index.php';</script>";
   exit;
}
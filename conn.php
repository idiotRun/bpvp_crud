<?php 
error_reporting(3);
date_default_timezone_set('Asia/Makassar');
session_start();

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', 'root');
define('DB_NAME', 'latihan');

$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if(!$conn) {
   echo "GALAT KONEKSI DATABASE..!";
}
?>
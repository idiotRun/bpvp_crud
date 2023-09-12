<?php

require_once 'conn2.php';

if($_SESSION['login'] == true) {
   echo "<script>alert('Antum masih ada session'); window.location.href = 'kelas/index.php';</script>";
   exit;
}

if (isset($_POST['send'])) {
   // get from form
   $username = $_POST['username'];
   $password = $_POST['password'];

   $pass = md5($password);
   $search = mysqli_query($conn, "SELECT * FROM akun WHERE username = '$username' AND password = '$pass'");

   $row = mysqli_num_rows($search);

   if($row > 0) {
      // fetch data
      $fetch = mysqli_fetch_object($search);
      $_SESSION['login'] = true;
      $_SESSION['id'] = $fetch->id;
      $_SESSION['nama'] = $fetch->nama;

      echo "<script>alert('Antum berhasil login'); window.location.href = 'kelas/index.php';</script>";
      exit;
   } else {
      echo "<script>alert('Upss... Username / Password salah'); window.location.href = 'index.php';</script>";
      exit;
   }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Login Form</title>
   <style>
      * {
         box-sizing: border-box;
      }

      body {
         font-family: Arial, sans-serif;
         margin: 0;
         padding: 0;
         background-image: url('bg.webp');
         background-size: cover;
         background-repeat: no-repeat;
      }

      .container {
         display: flex;
         justify-content: center;
         align-items: center;
         height: 100vh;
      }

      .card {
         width: 400px;
         background-color: #fff;
         padding: 20px;
         border-radius: 10px;
         box-shadow: 0px 10px 10px rgba(0, 0, 0, 0.448);
         text-align: center;
      }

      h2 {
         color: #007BFF;
         margin-bottom: 20px;
      }

      form {
         display: flex;
         flex-direction: column;
      }

      label {
         text-align: left;
         margin-bottom: 5px;
         font-size: 14px;
      }

      input {
         padding: 10px;
         margin-bottom: 10px;
         border: 1px solid #ddd;
         border-radius: 5px;
      }

      button {
         padding: 10px;
         background-color: #007BFF;
         color: #fff;
         border: none;
         border-radius: 5px;
         cursor: pointer;
      }

      .success {
         margin-top: 12px;
         padding: 10px;
         width: 100%;
         font-size: 14px;
         color: white;
         text-transform: uppercase;
         font-weight: 700;
         background-color: blueviolet;

      }

      .alert {
         margin-top: 12px;
         padding: 10px;
         width: 100%;
         font-size: 14px;
         color: white;
         text-transform: uppercase;
         font-weight: 700;
         background-color: red;
      }

      .space {
         margin-top: 6px;
      }
   </style>
</head>

<body>
   <div class="container">
      <div class="card">
         <h2>Ninu ninu,, Login dulu</h2>
         <div class="space"></div>
         <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
            <label for="username">Username</label>
            <input type="text" value="" required autocomplete="off" name="username" id="username" placeholder="Username nya apa?">
            <div class="space"></div>
            <label for="password">Password</label>
            <input type="password" name="password" value="" required autocomplete="off" id="password" placeholder="Password antum...">

            <button type="submit" name="send">Login</button>
         </form>
      </div>

   </div>
</body>

</html>
<header>
   <nav>
      <div class="logo">
         <h1><a href="#"><b>CRUD RELASI</b></a></h1>
      </div>
      <input type="checkbox" id="menu-toggle">
      <label for="menu-toggle" class="menu-icon">&#9776;</label>
      <ul class="menu">
         <li><a href="<?= base_url('kota') ?>">Kota</a></li>
         <li><a href="<?= base_url('kelas') ?>">Kelas</a></li>
         <li><a href="<?= base_url('orang_tua') ?>">Orang_Tua</a></li>
         <li><a href="<?= base_url('siswa') ?>">Siswa</a></li>
         <li><a href="#">|</a></li>
         <li><a href="#">Konichiwa, <?= $_SESSION['nama'] ?></a></li>
         <li><a href="<?= base_url('logout.php') ?>">Logout</a></li>
      </ul>
   </nav>
</header>
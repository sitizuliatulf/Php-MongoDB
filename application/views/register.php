<div class="col-lg-5 col-lg-offset-2">
  <?php
    // check terlebih dahulu ada error atau tidak jika ada maka munculkan 
    if (validation_errors()) {
  ?>
      <div class="alert alert-danger"><h4>Gagal !</h4><?php echo validation_errors() ?></div>
  <?php 
    }
  ?>
  <h1>register akun</h1>
  <p>silahkan isi data</p>
    <!-- dalam satu halaman view hanya boleh ada 1 id saja -->
    <form action="" method="POST">
      <div class="form-group">
        <label for="username" >Username:</label>
        <!-- set value diberikan apabila kita salah melakukan input sebelumnya -->
        <input class="form-control" name="username" id="username" type="text" value="<?php echo set_value('username') ?>">
      </div>
      <div class="form-group">
        <label for="email" >Email:</label>
        <input class="form-control" name="email" id="email" type="text" value="<?php echo set_value('email') ?>">
      </div>
      <div class="form-group">
        <label for="password" >Password:</label>
        <input class="form-control" name="password" id="password" type="password" value="<?php echo set_value('password') ?>">
      </div>
      <div class="form-group">
        <label for="confirmation_password" >Konfirmasi Password:</label>
        <input class="form-control" name="confirmation_password" id="confirmation_password" type="password" value="<?php echo set_value('confirmation_password') ?>">
      </div>
      <div>
        <!-- kalau ada tag html form dan ingin bisa di submit buat type buttonya jadi submit, tp kalau misalkan ingin di pake cuma buat klik aja tidak submit dibuatt typenya jadi button -->
        <button type="submit" class="btn btn-primary" name="register">Register</button>
      </div>
    </form>
</div>
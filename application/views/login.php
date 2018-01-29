<center>
  <div class="col-md-offset-4 col-md-3">
    <div class="login-panel panel panel-default">
      <div class="panel-heading">
      <h3 class="panel-title">LogIn</h3>
      </div>
    <div class="panel-body">
    <?php 
      if (!empty($this->session->flashdata('err_login'))) { 
        echo $this->session->flashdata('err_login');
      }
      if (!empty(validation_errors())) {
    ?>
      <div class="alert alert-danger">
        <h4>Gagal! </h4>
        <?php echo validation_errors() ?>
      </div>
    <?php
      }
    ?>
      <form action="" method="POST" role="form">
        <fieldset>
          <div class="form-group">
            <input class="form-control" name="email" id="email" type="text" placeholder="email" value="<?php echo set_value('email') ?>">
          </div>
          <div class="form-group">
            <input class="form-control" name="password" id="password" type="password" placeholder="password" value="<?php echo set_value('password') ?>">
          </div>
          <!-- Change this to a button or input when using this as a form -->
          <button type="submit" class="btn btn-primary" name="login">Login</button>
          <div>
            <a href="./application/view/register.php"  > Register </a>
          </div>
        </fieldset>
      </form>
    </div>
  </div>
</center>



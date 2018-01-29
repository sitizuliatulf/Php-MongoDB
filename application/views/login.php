<!-- <div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="row">
                <div class="col-md-12">
                    <h2>Login</h2>
                    <hr />
                </div>
                <div class="col-md-12">
                    <label><?php echo $this->lang->line('username') ?></label>    
                    <input type="text" name="username" class="form-control  divider-input" id="username">
                    <label><?php echo $this->lang->line('password') ?></label>    
                    <input type="text" name="password" class="form-control  divider-input" id="password"> -->
                    <!-- <select name="fakultas" class="form-control divider-input" id="fakultas">
                        <option value="01">Ekonomi Dan Bisnis</option>
                        <option value="02">Teknik</option>
                        <option value="03">Ilmu Komputer</option>
                    </select> -->
                <<!-- /div>
                <div class="col-md-4"> --><!-- 
                    <a href="<?php echo base_url() ?>" name="submit" class="btn btn-danger">Batalkan</a> -->
<!--                     <button name="submit" class="btn btn-info">Login</button>
                </div>
            </div>
        </div>
    </div>
</div> -->

<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="javascript:void(0)"><b><?php echo $this->lang->line('masuk') ?></b></a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <?php 
        if ($this->session->flashdata('error_message')) {
            echo $this->session->flashdata('error_message');
        }
    ?>
    <form action="<?php echo base_url().'index/login' ?>" method="post">
      <div class="form-group has-feedback">
        <input type="username" name="username" class="form-control" placeholder="<?php echo $this->lang->line('username') ?>">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="password" class="form-control" placeholder="<?php echo $this->lang->line('password') ?>">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-12">
          <button type="submit" class="btn btn-primary btn-block btn-flat"><?php echo $this->lang->line('masuk') ?></button>
        </div>
      </div>
    </form>
  </div>
</div>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="javascript:void(0)"><b><?php echo $this->lang->line('portal_berita') ?></b></a>
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
        <input type="email" name="email" class="form-control" placeholder="<?php echo $this->lang->line('email') ?>">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="password" class="form-control" placeholder="<?php echo $this->lang->line('password') ?>">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-12">
          <button type="submit" class="btn btn-primary btn-block btn-flat"><?php echo $this->lang->line('signin') ?></button>
        </div>
      </div>
    </form>
  </div>
</div>
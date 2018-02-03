<!DOCTYPE html>
	<html>
	<head>
		<meta charset="utf-8">
		<title>Data Mahasiswa</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="shortcut icon" href="./img/r.png">
		<?php 
			if (isset($css)) {
				foreach($css as $key => $value) {
		?>
				<link rel="stylesheet" type="text/css" href="<?php echo base_url($value) ?>">
		<?php
				}
			}
		?>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	</head>
	<body>
	<nav class="navbar navbar-inverse navbar-fixed-top">
		<div class="container">
			<div class="navbar-header">
				<a class="navbar-brand" href="<?php echo base_url() ?>">Portal Berita</a>
			</div>
			<ul class="nav navbar-nav navbar-right">
				<?php 
				if ($this->add_on->user_is_login()) {
				?>
					<li>
						<a href="<?php echo base_url('index/logout') ?>">
						<span class="glyphicon glyphicon-user"></span> Keluar
						</a>
					</li>
				<?php
				} else {
				?>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<span class="glyphicon glyphicon-user"></span> Masuk
					</a>
					<div class="dropdown-menu dropdown-menu-right">
						<form method="post" action="<?php echo base_url('index/login') ?>">
							<div class="container login-wrapper">
								<div class="col-xs-12">
									<div class="form-group">
										<label>Email</label>
										<input type="email" name="email" class="form-control no-border-radius" value="">
									</div>
									<div class="form-group">
										<label>Kata Sandi</label>
										<input type="password" name="password" class="form-control no-border-radius" value="">
									</div>
								</div>
								<div class="col-xs-12">
									<a href="<?php echo base_url('index/register') ?>" type="submit" name="masuk" class="btn btn-block btn-info"> 
										Daftar
									</a>
									<button type="submit" name="login" class="btn btn-block btn-warning"> 
										Masuk
									</button>
								</div>
							</div>
						</form>
					</div>
				</li>
				<?php
					}
				?>
			</ul>
		</div>
	</nav>
	<?php 
	$cari = '';
	if (!empty($this->session->userdata('search'))) {
		$cari = $this->session->userdata('search');
	}
	?>
	<div class="container after-navbar">
		<div class="col-md-offset-2 col-md-8 text-center">
			<form method="get" action="<?php echo base_url('cari') ?>">
				<div class="input-group">
					<input type="text" name="cari" class="form-control" placeholder="Pencarian" value="<?php echo $cari ?>">
					<span class="input-group-btn">
						<button type="button" class="btn btn-default">
							<i class="fa fa-search"></i>
						</button>
					</span>
				</div>
			</form>
		</div>
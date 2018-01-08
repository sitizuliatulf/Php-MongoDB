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
	</head>
	<body>
<!DOCTYPE html>
<html>
<head>
	<title>Data Mahasiswa</title>
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<table class="table table-hover">
					<tr>
						<td>#</td>
						<td>Nama</td>
						<td>Email</td>
						<td>Address</td>
					</tr>
				<?php 
					foreach ($data as $key => $value) {
				?>
					<tr>
						<td><?php echo $key + 1 ?></td>
						<td><?php echo $value['nama'] ?></td>
						<td><?php echo $value['email'] ?></td>
						<td><?php echo $value['address'] ?></td>
					</tr>
				<?php
					}
				?>
				</table>
			</div>
		</div>
	</div>
</body>
</html>
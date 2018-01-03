<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="row">
				<div class="col-md-6 text-left">
					<h2>Data Mahasiswa</h2>
				</div>
				<div class="col-md-6 text-right">
					<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Add</button>
				</div>
			</div>
		</div>
		<table class="table table-hover">
			<tr>
				<td>Nama</td>
				<td>TTL</td>
				<td>Alamat</td>
				<td>No.HP</td>
				<td>Email</td>
				<td>Fakultas</td>
				<td>Jurusan</td>
				<td>NIM</td>
			</tr>
		<?php 
			foreach ($data as $key => $value) {
		?>
			
		<?php
			}
		?>
		</table>
	</div>
</div>
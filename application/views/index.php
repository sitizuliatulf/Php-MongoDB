<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="row">
				<div class="col-md-6 text-left">
					<h2><?php echo $this->lang->line('data_mahasiswa') ?></h2>
				</div>
				<div class="col-md-6 text-right">
					<a href="<?php echo base_url('mahasiswa/tambah') ?>" class="btn btn-info" data-toggle="modal">
						<?php echo $this->lang->line('tambahkan_mahasiswa')?>
					</a>
				</div>
			</div>
		</div>
		<table class="table table-hover">
			<tr>
				<td><?php echo $this->lang->line('nim') ?></td>
				<td><?php echo $this->lang->line('nama') ?></td>
				<td><?php echo $this->lang->line('fakultas') ?></td>
				<td><?php echo $this->lang->line('jurusan') ?></td>
				<td>#</td>
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
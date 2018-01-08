<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="row">
                <div class="col-md-12">
                    <h2>Tambah Mahasiswa</h2>
                    <hr />
                </div>
                <div class="col-md-12">
                    <label><?php echo $this->lang->line('nama') ?></label>    
                    <input type="text" name="nama" class="form-control  divider-input" id="nama">
                    <label><?php echo $this->lang->line('tanggal_lahir') ?></label>    
                    <input type="text" name="tanggal_lahir" class="form-control  divider-input" id="tanggal_lahir">
                    <label><?php echo $this->lang->line('fakultas') ?></label>    
                    <select name="fakultas" class="form-control divider-input" id="fakultas">
                        <option value="01">Ekonomi Dan Bisnis</option>
                        <option value="02">Teknik</option>
                        <option value="03">Ilmu Komputer</option>
                    </select>
                    <label><?php echo $this->lang->line('jurusan') ?></label>    
                    <select name="jurusan" class="form-control divider-input" id="jurusan">
                        <option value="11">Manajemen</option>
                        <option value="12">Akutansi</option>
                    </select>
                    <label><?php echo $this->lang->line('alamat') ?></label>    
                    <textarea name="alamat" class="form-control divider-input" rows="5"></textarea>
                </div>
                <div class="col-md-4">
                    <a href="<?php echo base_url() ?>" name="submit" class="btn btn-danger">Batalkan</a>
                    <button name="submit" class="btn btn-info">Simpan</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
  <div class="col-md-12 col-xs-12">
    <?php 
      if (is_array($data) && count($data) > 0) {
        foreach ($data as $k => $v) {
    ?>
      <div class="row">
        <div class="col-md-offset-2 col-md-8 col-xs-offset-2 col-xs-8 wrapper-article">
          <div class="col-md-4 col-xs-4">
            <div class="wrapper-image-list-article">
              <img src="<?php echo base_url().'image?filename='.$v['image']['filename'] ?>" class="image-responsive" alt="<?php echo $v['image']['filename']?>" >
            </div>
          </div>
          <div class="col-md-8 col-xs-8">
            <h2><?php echo $v['title'] ?></h2>
            <p><?php echo substr($v['content'], 0, 300).'...' ?></p>
            <a href="<?php echo base_url('baca-artikel/').$v['_id'] ?>">
              Baca lebih lanjut
            </a>
          </div>
        </div>
      </div>
    <?php
        }
      } else {
        if (!empty($this->session->userdata('search'))) {
          echo '<div class="row" style="margin-top: 50px;"><div class="col-md-12 text-center">Tidak ditemukan kata kunci <b>'. $this->session->userdata('search'). '</b> klik <a href="'.base_url().'">disini</a> untuk kembali</div></div>';
        }
      }
    ?>
  </div>
</div>

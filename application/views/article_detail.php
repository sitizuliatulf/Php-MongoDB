<div class="row">    
  <div class="col-md-12 col-xs-12">
    <div class="wrapper-detail-image">
      <img src="<?php echo base_url('image?filename=').$data['image']['filename'] ?>" alt="gambar detail" class="image-responsive" />
    </div> 
  </div>
  <div class="col-md-12 col-xs-12">
    <div class="wrapper-content-article">
      <div class="col-md-6 text-left">
        <h3><?php echo $data['title'] ?></h3>
      </div>
      <div class="col-md-6 text-right">
        <h3><?php echo $data['createdDate'] ?></h3>
      </div>  
      <div class="col-md-12 col-xs-12">
        <p><?php echo $data['content'] ?></p>
      </div>
    </div>
  </div>
  <div class="col-md-12 col-xs-12">
    <div class="wrapper-commentar">
      <div class="col-md-12 col-xs-12">
        <form method="POST" action="<?php echo base_url('simpan-komentar?id=').$data['_id'] ?>">
        <textarea class="form-control" rows="5" name="commentar"></textarea>
        <button type="submit" name="save_commentar" class="btn btn-info need-space">
          Simpan Komentar
        </button>
      </div>
      <div class="col-md-12 col-xs-12">
        <h3>Daftar Komentar</h3>
        <div class="wrapper-list-commentar">
          <?php 
            if (is_array($commentars) && count($commentars) > 0) {
              foreach ($commentars as $k => $v) {
                $bg_colour = $k % 2 === 1 ? 'white' : '#f3f3f3';
          ?>
            <div class="wrapper-item-commentar" style="background-color:<?php echo $bg_colour ?>">
              <div class="col-md-6 text-left no-padding">
                <h4><?php echo $v['name'] ?></h4>
              </div>
              <div class="col-md-6 text-right no-padding">
                <h4><?php echo $v['dateTime'] ?></h4>
              </div>
              <div class="col-md-12 text-left col-xs-12 need-space no-padding">
                <?php echo $v['content'] ?>
              </div>
            </div>
          <?php
              }
            }
          ?>
        </div>
      </div>
    </div>
  </div>
</div>

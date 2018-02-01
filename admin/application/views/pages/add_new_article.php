<?php 
$default_value = new stdClass();
$readonly = new stdClass();
$default_value->title = '';
$default_value->category = '';
$default_value->content = '';
$default_value->image = '';
if (is_array($this->session->userdata('EDIT_ARTICLE'))) {
    $article = $this->session->userdata('EDIT_ARTICLE')[0];
    $default_value->title = $article['title'];
    $default_value->category = $article['category'];
    $default_value->content = $article['content'];
    if (isset($article['image']) && !empty($article['image']['filename'])) {
        $default_value->image = '<img src="'.base_url($this->url).'/image/'.$article['image']['filename'].'" alt="gambar utama" style="width: 100%"/>';
    }
} else if (is_array($this->session->userdata('ADD_ARTICLE'))) {
    $article = $this->session->userdata('ADD_ARTICLE')[0];
    $default_value->title = $article['title'];
    $default_value->category = $article['category'];
    $default_value->content = $article['content'];
    $default_value->main_image = '';
}
?>
<div class="col-xs-12 col-md-12">
    <?php 
    if (!empty($this->session->flashdata('error_message'))) {  
        echo $this->session->flashdata('error_message');
    }
    ?>
    <div class="box">
        <form action="" method="post" enctype="multipart/form-data">
        <div class="box-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Judul <span class="asterik-red">*</span></label>
                        <input type="text" name="title" class="form-control" value="<?php echo $default_value->title?>" />
                    </div>
                    <div class="form-group">
                        <label>Gambar <span class="asterik-red">*</span></label>
                        <a id="wrapper-image" class="thumbnail text-center" href="javascript:void(0)">
                            <?php 
                            if (!empty($default_value->image)) {
                                echo $default_value->image;
                            ?>
                                <div class="fa fa-picture-o" style="font-size: 8em;display:none"></div>
                                <input type="hidden" name="filename_image" value="<?php echo $article['image']['filename'] ?>" />
                            <?php
                            } else {
                            ?>
                                <div class="fa fa-picture-o" style="font-size: 8em;"></div>
                            <?php
                            }
                            ?>
                        </a>
                        <div class="col-md-6 no-padding">
                            <input type="hidden" name="is_delete" value="0" />
                            <input type="file" name="main_image" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <button class="btn btn-sm btn-danger" type="button">
                                <i class="fa fa-close"></i>
                                Hapus
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Kategori <span class="asterik-red">*</span></label>
                        <input type="text" name="category" class="form-control" value="<?php echo $default_value->category ?>"  />
                    </div>
                    <div class="form-group">
                        <label>Isi Artikel <span class="asterik-red">*</span></label>
                        <textarea class="form-control" name="content" value="<?php echo $default_value->content ?>">
                            <?php echo $default_value->content ?>
                        </textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="box">
        <div class="box-body">
            <div class="row">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-info" name="submit"> 
                        <i class="fa fa-save"></i>
                        <?php echo $this->lang->line('save') ?>
                    </button>
                    <a href="<?php echo base_url($this->url) ?>" class="btn btn-default"> 
                        <i class="fa fa-close"></i>
                        <?php echo $this->lang->line('back') ?>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
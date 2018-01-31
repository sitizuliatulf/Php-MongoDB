<?php 
$default_value = new stdClass();
$readonly = new stdClass();
$default_value->title = '';
$default_value->main_image = '';
$default_value->category = '';
$default_value->content = '';
if (is_array($this->session->userdata('EDIT_ARTICLE'))) {
    $user = $this->session->userdata('EDIT_USER')[0];
    $default_value->username = $user['username'];
    $default_value->email = $user['email'];
    $default_value->is_admin = $user['isAdmin'];
    $readonly->email = 'readonly="readonly"'; 
} else if (is_array($this->session->userdata('ADD_ARTICLE'))) {
    $user = $this->session->userdata('ADD_USER')[0];
    $default_value->username = $user['username'];
    $default_value->email = $user['email'];
    $default_value->is_admin = $user['is_admin'];
    $default_value->password = $user['password'];
    $default_value->confirmation_password = $user['confirmation_password'];
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
							<div class="fa fa-picture-o" style="font-size: 8em;">
                            </div>
                        </a>
                        <div class="col-md-6 no-padding">
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
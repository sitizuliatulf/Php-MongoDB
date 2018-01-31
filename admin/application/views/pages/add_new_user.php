<?php 
$default_value = new stdClass();
$readonly = new stdClass();
$default_value->username = '';
$default_value->email = '';
$default_value->access_admin = '';
$default_value->password = '';
$default_value->confirmation_password = '';
$readonly->email = '';
if (is_array($this->session->userdata('EDIT_USER'))) {
    $user = $this->session->userdata('EDIT_USER')[0];
    $default_value->username = $user['username'];
    $default_value->email = $user['email'];
    $default_value->is_admin = $user['isAdmin'];
    $readonly->email = 'readonly="readonly"'; 
} else if (is_array($this->session->userdata('ADD_USER'))) {
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
        <form action="" method="post">
        <div class="box-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Username <span class="asterik-red">*</span></label>
                        <input type="text" name="username" class="form-control" value="<?php echo $default_value->username?>" />
                    </div>
                    <div class="form-group">
                        <label>Email <span class="asterik-red">*</span></label>
                        <input type="text" name="email" class="form-control" value="<?php echo $default_value->email ?>" <?php echo $readonly->email ?> />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Akses Admin <span class="asterik-red">*</span></label>
                        <select name="is_admin" class="form-control">
                            <?php 
                            if (count($is_admin_model) > 0 && is_array($is_admin_model)) {
                                foreach ($is_admin_model as $is_v) {
                                    $selected = '';
                                    if ($is_v->id == $default_value->is_admin) $selected = 'selected="selected"';
                            ?>
                                <option value="<?php echo $is_v->id ?>" <?php echo $selected?>>
                                    <?php echo $is_v->name ?>
                                </option>
                            <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <?php 
                    if (!is_array($this->session->userdata('EDIT_USER'))) {
                    ?>
                        <div class="form-group">
                            <label>Kata Sandi <span class="asterik-red">*</span></label>
                            <input type="password" name="password" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label>Konfirmasi Kata Sandi <span class="asterik-red">*</span></label>
                            <input type="password" name="confirmation_password" class="form-control" />
                        </div>
                    <?php
                    }
                    ?>
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
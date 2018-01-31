<?php 
$session_user_login = $this->session->userdata('session_user_login');
?>
<div class="wrapper">
    <header class="main-header">
        <a href="<?php echo base_url() ?>" class="logo">
            <span class="logo-lg"><b><?php echo $this->lang->line('portal_berita') ?>a</b></span>
        </a>
        <nav class="navbar navbar-static-top">
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
            </a>
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-user"></i>
                            <span class="hidden-xs"><?php echo $session_user_login->username ?></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="user-header">
                                <p>
                                    Hi Admin !
                                    <small><?php echo $session_user_login->email ?></small>
                                </p>
                            </li>
                            <li class="user-footer">
                            <div class="pull-left">
                                <a href="#" class="btn btn-default btn-flat"><?php echo $this->lang->line('profile')?></a>
                            </div>
                            <div class="pull-right">
                                <a href="javascript:void(0)" class="btn btn-default btn-flat btn-logout"><?php echo $this->lang->line('signout')?></a>
                            </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <ul class="sidebar-menu" data-widget="tree">
            <li class="header"><?php echo $this->lang->line('main_menu') ?></li>
            <li>
                <a href="<?php echo base_url('users') ?>">
                <i class="fa fa-user"></i> <span><?php echo $this->lang->line('users') ?></span>
                </a>
            </li>
            <li>
                <a href="<?php echo base_url('articles') ?>">
                <i class="fa  fa-newspaper-o"></i> <span><?php echo $this->lang->line('articles') ?></span>
                </a>
            </li>
            <li class="header"><?php echo $this->lang->line('pengaturan') ?></li>
            <li><a href="javascript:void(0)" class="btn-logout"><i class="fa fa-sign-out"></i> <span><?php echo $this->lang->line('signout') ?></span></a></li>
        </section>
    </aside>
    <div class="content-wrapper">
        <section class="content-header">
        <h1 class="title-header">
            <?php 
            $title = $this->uri->segment(1);
            if (!empty($this->uri->segment(2))) {
                $title = $this->uri->segment(2);
            }
            echo ucFirst($this->lang->line($title)); 
            ?>
        </h1>
        </section>

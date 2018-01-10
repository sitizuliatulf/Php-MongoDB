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
                            <li class="user-body">
                                <small>Member since Nov. 2012</small>
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
            <li class="active">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span><?php echo $this->lang->line('halaman_utama') ?></span>
                </a>
            </li>
            <li>
                <a href="<?php echo base_url('users') ?>">
                <i class="fa fa-user"></i> <span><?php echo $this->lang->line('users') ?></span>
                </a>
            </li>
            <li class="treeview">
                <a href="#">
                <i class="fa fa-files-o"></i>
                <span><?php echo $this->lang->line('articles') ?></span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="pages/layout/top-nav.html">
                            <i class="fa fa-circle-o"></i><?php echo $this->lang->line('article_categories') ?>
                        </a>
                    </li>
                    <li><a href="pages/layout/boxed.html"><i class="fa fa-circle-o"></i> <?php echo $this->lang->line('list_articles') ?></a></li>
                </ul>
            </li>
            <li class="header"><?php echo $this->lang->line('pengaturan') ?></li>
            <li><a href="javascript:void(0)" class="btn-logout"><i class="fa fa-sign-out"></i> <span><?php echo $this->lang->line('signout') ?></span></a></li>
        </section>
    </aside>
    <div class="content-wrapper">
        <section class="content-header">
        <h1>
            <?php echo 'Data '.ucFirst($this->lang->line($this->uri->segment(1))) ?>
        </h1>
        </section>

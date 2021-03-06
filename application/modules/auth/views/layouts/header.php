<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<header class="main-header">
<a class="logo">
        <span class="logo-mini"><i class="fa fa-info"></i></span>
        <span class="logo-lg"><b>SiCDP</b> Banten</span>
    </a>

    <nav class="navbar navbar-static-top" role="navigation">
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="<?php echo base_url('') ?>" class="user-image" alt="User Image">
                        <span class="hidden-xs">Selamat datang! <?php echo $this->user->name?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="user-header">
                            <img src="<?php echo base_url('') ?>" class="img-circle" alt="User Image">
                            <p>
                                <?php echo $this->user->name?>
                            </p>
                        </li>
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="<?php echo site_url('auth/profile'); ?>" class="btn btn-default btn-flat">Profil</a>
                            </div>
                            <div class="pull-right">
                                <a href="<?php echo site_url('auth/logout') ?>" class="btn btn-default btn-flat">Logout</a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>
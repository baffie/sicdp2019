<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<aside class="main-sidebar">
    <section class="sidebar">
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?php echo base_url('assets/img/avatar5.png') ?>" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
                <p>Operator</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <ul class="sidebar-menu">
            <li class="header">MENU PANEL</li>
            <li>
                <a href="<?php echo site_url('auth') ?>">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>
            <li class="treeview <?php if($this->uri->segment(2) == 'data_cppkab' || $this->uri->segment(2) == 'ldpm' || $this->uri->segment(2) == 'lpm') echo 'active'; ?>">
                <a href="#">
                    <i class="fa fa-server"></i>
                    <span>Data</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li <?php if($this->uri->segment(2) == 'data_cppkab') echo 'class="active"'; ?>><a href="<?php echo site_url('auth/data_cppkab') ?>"><i class="fa fa-circle-o"></i> Data CPP Kab/kota</a></li>
                    <li <?php if($this->uri->segment(2) == 'ldpm') echo 'class="active"'; ?>><a href="<?php echo site_url('auth/ldpm') ?>"><i class="fa fa-circle-o"></i> Data CPM LDPM</a></li>
                    <li <?php if($this->uri->segment(2) == 'lpm') echo 'class="active"'; ?>><a href="<?php echo site_url('auth/lpm') ?>"><i class="fa fa-circle-o"></i> Data CPM LPM</a></li>
                </ul>
            </li>
            <li class="treeview <?php if($this->uri->segment(2) == 'cpp_kab' || $this->uri->segment(2) == 'cpm_ldpm' || $this->uri->segment(2) == 'cpm_lpm') echo 'active'; ?>">
                <a href="#">
                    <i class="fa fa-server"></i>
                    <span>Master</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li <?php if($this->uri->segment(2) == 'cpp_kab') echo 'class="active"'; ?>><a href="<?php echo site_url('auth/cpp_kab') ?>"><i class="fa fa-circle-o"></i> CPP Kab/kota</a></li>
                    <li <?php if($this->uri->segment(2) == 'cpm_ldpm') echo 'class="active"'; ?>><a href="<?php echo site_url('auth/cpm_ldpm') ?>"><i class="fa fa-circle-o"></i> CPM LDPM</a></li>
                    <li <?php if($this->uri->segment(2) == 'cpm_lpm') echo 'class="active"'; ?>><a href="<?php echo site_url('auth/cpm_lpm') ?>"><i class="fa fa-circle-o"></i> CPM LPM</a></li>

                </ul>
            </li>
            <li class="<?php if($this->uri->segment(2) == 'profile') echo 'active'; ?>"><a href="<?php echo site_url('auth/profile') ?>"><i class="fa fa-user"></i> <span>Profil</span></a></li>
            <li><a href="<?php echo site_url('auth/logout') ?>"><i class="fa fa-sign-out"></i> <span>Logout</span></a></li>
        </ul>
    </section>
</aside>


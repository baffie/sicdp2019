<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<aside class="main-sidebar">
    <section class="sidebar">
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?php echo base_url('assets/img/avatar5.png') ?>" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
                <p><?php echo $this->user->name?></p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <ul class="sidebar-menu">
            <li class="header">MENU PANEL</li>
            <li <?php if($this->uri->segment(2) == 'dashboard') echo 'class="active"'; ?>>
                <a href="<?php echo site_url('cms/dashboard') ?>">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>
            <li class="treeview <?php if($this->uri->segment(2) == 'bulog' || $this->uri->segment(2) == 'data_cbp' || $this->uri->segment(2) == 'data_cpp_ldpm') echo 'active'; ?>">
                <a href="#">
                    <i class="fa fa-th"></i>
                    <span>Data CPP Propinsi</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li <?php if($this->uri->segment(2) == 'data_cpp_ldpm') echo 'class="active"'; ?>><a href="<?php echo site_url('cms/data_cpp_ldpm') ?>"><i class="fa fa-circle-o"></i> Data CPP LDPM</a></li>
                    <li <?php if($this->uri->segment(2) == 'bulog') echo 'class="active"'; ?>><a href="<?php echo site_url('cms/bulog') ?>"><i class="fa fa-circle-o"></i> Data Bulog</a></li>
                    <li <?php if($this->uri->segment(2) == 'data_cbp') echo 'class="active"'; ?>><a href="<?php echo site_url('cms/data_cbp') ?>"><i class="fa fa-circle-o"></i> Data CBP</a></li>
                </ul>
            </li>
            <li class="treeview <?php if($this->uri->segment(2) == 'data_cppkab' || $this->uri->segment(2) == 'ldpm' || $this->uri->segment(2) == 'lpm') echo 'active'; ?>">
                <a href="#">
                    <i class="fa fa-th"></i>
                    <span>Data Kab/Kota</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li <?php if($this->uri->segment(2) == 'data_cppkab') echo 'class="active"'; ?>><a href="<?php echo site_url('cms/data_cppkab') ?>"><i class="fa fa-circle-o"></i> Data CPP Kab/kota</a></li>
                    <li <?php if($this->uri->segment(2) == 'ldpm') echo 'class="active"'; ?>><a href="<?php echo site_url('cms/ldpm') ?>"><i class="fa fa-circle-o"></i> Data CPM LDPM</a></li>
                    <li <?php if($this->uri->segment(2) == 'lpm') echo 'class="active"'; ?>><a href="<?php echo site_url('cms/lpm') ?>"><i class="fa fa-circle-o"></i> Data CPM LPM</a></li>
                </ul>
            </li>
            <li class="treeview <?php if($this->uri->segment(2) == 'news' || $this->uri->segment(2) == 'page') echo 'active'; ?>">
                <a href="#">
                    <i class="fa fa-newspaper-o"></i>
                    <span>Konten</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li <?php if($this->uri->segment(2) == 'news') echo 'class="active"'; ?>><a href="<?php echo site_url('cms/news') ?>"><i class="fa fa-circle-o"></i> Berita</a></li>
                    <li <?php if($this->uri->segment(2) == 'page') echo 'class="active"'; ?>><a href="<?php echo site_url('cms/page') ?>"><i class="fa fa-circle-o"></i> Halaman</a></li>
                </ul>
            </li>
            <li class="treeview <?php if($this->uri->segment(2) == 'news_channel' || $this->uri->segment(2) == 'cpp_ldpm' || $this->uri->segment(2) == 'stok_bulog' || $this->uri->segment(2) == 'stok_cbp' || $this->uri->segment(2) == 'stok_ldpm') echo 'active'; ?>">
                <a href="#">
                    <i class="fa fa-server"></i>
                    <span>Master CPP Propinsi</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <!--<li <?php if($this->uri->segment(2) == 'poktan') echo 'class="active"'; ?>><a href="<?php echo site_url('cms/poktan') ?>"><i class="fa fa-circle-o"></i> Data Kelompok Tani</a></li>-->
                    <li <?php if($this->uri->segment(2) == 'cpp_ldpm') echo 'class="active"'; ?>><a href="<?php echo site_url('cms/cpp_ldpm') ?>"><i class="fa fa-circle-o"></i> CPP LDPM</a></li>
                    <!--<li <?php if($this->uri->segment(2) == 'stok_lpm') echo 'class="active"'; ?>><a href="<?php echo site_url('cms/stok_lpm') ?>"><i class="fa fa-circle-o"></i> Awal Stok </a></li>
                    <li <?php if($this->uri->segment(2) == 'stok_ldpm') echo 'class="active"'; ?>><a href="<?php echo site_url('cms/stok_ldpm') ?>"><i class="fa fa-circle-o"></i> Awal Stok LDPM</a></li>-->
                    <li <?php if($this->uri->segment(2) == 'stok_bulog') echo 'class="active"'; ?>><a href="<?php echo site_url('cms/stok_bulog') ?>"><i class="fa fa-circle-o"></i> Awal Stok Bulog</a></li>
                    <li <?php if($this->uri->segment(2) == 'stok_cbp') echo 'class="active"'; ?>><a href="<?php echo site_url('cms/stok_cbp') ?>"><i class="fa fa-circle-o"></i> Awal Stok CBP</a></li>
                    <li <?php if($this->uri->segment(2) == 'news_channel') echo 'class="active"'; ?>><a href="<?php echo site_url('cms/news_channel') ?>"><i class="fa fa-circle-o"></i> Channel</a></li>
                
                </ul>
            </li>
            <li class="treeview <?php if($this->uri->segment(2) == 'cpp_kab' || $this->uri->segment(2) == 'cpm_lpm' || $this->uri->segment(2) == 'cpm_ldpm') echo 'active'; ?>">
                <a href="#">
                    <i class="fa fa-server"></i>
                    <span>Master CPP Kab/Kota</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li <?php if($this->uri->segment(2) == 'cpp_kab') echo 'class="active"'; ?>><a href="<?php echo site_url('cms/cpp_kab') ?>"><i class="fa fa-circle-o"></i> CPP Kab/Kota</a></li>
                    <li <?php if($this->uri->segment(2) == 'cpm_ldpm') echo 'class="active"'; ?>><a href="<?php echo site_url('cms/cpm_ldpm') ?>"><i class="fa fa-circle-o"></i> CPM LDPM</a></li>
                    <li <?php if($this->uri->segment(2) == 'cpm_lpm') echo 'class="active"'; ?>><a href="<?php echo site_url('cms/cpm_lpm') ?>"><i class="fa fa-circle-o"></i> CPM LPM</a></li>
                    <!--<li <?php if($this->uri->segment(2) == 'stok_lpm') echo 'class="active"'; ?>><a href="<?php echo site_url('cms/stok_lpm') ?>"><i class="fa fa-circle-o"></i> Stok LPM</a></li>
                    <li <?php if($this->uri->segment(2) == 'stok_ldpm') echo 'class="active"'; ?>><a href="<?php echo site_url('cms/stok_ldpm') ?>"><i class="fa fa-circle-o"></i> Stok LDPM</a></li>
                    <li <?php if($this->uri->segment(2) == 'sektor') echo 'class="active"'; ?>><a href="<?php echo site_url('cms/sektor') ?>"><i class="fa fa-circle-o"></i> Stok x</a></li>
                    <li <?php if($this->uri->segment(2) == 'news_channel') echo 'class="active"'; ?>><a href="<?php echo site_url('cms/news_channel') ?>"><i class="fa fa-circle-o"></i> Channel</a></li>-->
                
                </ul>
            </li>


            <li class="<?php if($this->uri->segment(2) == 'users') echo 'active'; ?>"><a href="<?php echo site_url('cms/users') ?>"><i class="fa fa-users"></i> <span>Pengguna</span></a></li>

            <li class="<?php if($this->uri->segment(2) == 'settings') echo 'active'; ?>"><a href="<?php echo site_url('cms/settings') ?>"><i class="fa fa-cogs"></i> <span>Pengaturan</span></a></li>
            <li><a href="<?php echo site_url('cms/log/out') ?>"><i class="fa fa-sign-out"></i> <span>Logout</span></a></li>
        </ul>
    </section>
</aside>


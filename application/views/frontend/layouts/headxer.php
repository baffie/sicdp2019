<nav id="navbar-main">
    <!--<div class="container">
        <div class="social pull-right mt15 mb15">
            <ul>
                <?php if(setting('facebook')) echo '<li><a href="'.setting('facebook').'" target="_blank" title="Facebook"><i class="fa fa-facebook"></i></a></li>'; ?>
                <?php if(setting('twitter')) echo '<li><a href="'.setting('twitter').'" target="_blank" title="Twitter"><i class="fa fa-twitter"></i></a></li>';?>
                <?php if(setting('googleplus')) echo '<li><a href="'.setting('googleplus').'"  target="_blank" title="Google+"><i class="fa fa-google-plus"></i></a></li>';?>
                <?php if(setting('youtube')) echo '<li><a href="'.setting('youtube').'"  target="_blank" title="Youtube"><i class="fa fa-youtube"></i></a></li>';?>
                <?php if(setting('instagram')) echo '<li><a href="'.setting('instagram').'"  target="_blank" title="Instagram"><i class="fa fa-instagram"></i></a></li>';?>            </ul>
        </div>
    </div>-->
    <div class="navbar navbar-default" role="navigation">
        <div class="container">
            <img class="pull-left mb5" src="<?php echo base_url('assets/img/logo.png'); ?>" width="300" alt="Logo Kabupaten Pandeglang">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right mt30">
                    <li <?php if (current_url() == site_url()) echo ' class="active"'; ?>><a href="<?php echo site_url()?>">Home</a></li>
                    <!-- <li <?php if ($this->uri->segment(1) == 'news' || $this->uri->segment(1) == 'read') echo ' class="active"'; ?>><a href="<?php echo site_url('news')?>">Berita</a></li> -->
                    <li class="dropdown <?php if ($this->uri->segment(1) == 'page') echo 'active'; ?>">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role= "button" aria-expanded="false">Profil<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo site_url('page/latar-belakang')?>">Latar Belakang</a></li>
                            <li><a href="<?php echo site_url('page/tujuan-pembuatan-database-cadangan-pangan')?>">Tujuan Pembuatan Database Cadangan Pangan</a></li>
                            <li><a href="<?php echo site_url('page/alasan-pentingnya-pengembangan-cadangan-pangan')?>">Alasan Pentingnya Pengembangan Cadangan Pangan</a></li>
                            <li><a href="<?php echo site_url('page/istilah-dan-definisi')?>">Istilah Dan Definisi</a></li>
                            <li><a href="<?php echo site_url('page/undang-undang-pangan')?>">Undang-undang Pangan</a></li>
                            <li><a href="<?php echo site_url('page/pedum-lumbung-pangan-masyarakat')?>">PEDUM Lumbung Pangan Masyarakat</a></li>
                            <!--<li class="divider"></li>
                            <li class="dropdown dropdown-submenu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Kelompok Lumbung<span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="<?php echo site_url('page/profil-lpm')?>">Profil CPM LPM</a></li>
                                    <li><a href="<?php echo site_url('page/profil-ldpm')?>">Profil CPM LDPM</a></li>
                                    <li><a href="<?php echo site_url('page/profil-ldpm')?>">Profil CPP LDPM</a></li>
                                    <li><a href="<?php echo site_url('page/profil-swadaya')?>">Profil Swadaya</a></li>
                                </ul>
                            </li>-->
                        </ul>
                    </li>
                      <li class="dropdown <?php if ($this->uri->segment(1) == 'profil') echo 'active'; ?>">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Kelompok Lumbung<span class="caret"></span></a>
                                <ul class="dropdown dropdown-menu">
                                    <li><a href="<?php echo site_url('profil/lpm')?>">Profil CPM LPM</a></li>
                                    <li><a href="<?php echo site_url('profil/ldpm')?>">Profil CPM LDPM</a></li>
                                    <li><a href="<?php echo site_url('profil/cpp_ldpm')?>">Profil CPP LDPM</a></li>
                                    <li><a href="<?php echo site_url('page/profil-swadaya')?>">Profil Swadaya</a></li>
                                </ul>
                            </li>
                    <!--<li class="dropdown <?php if ($this->uri->segment(1) == 'data') echo 'active'; ?>">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">DATA CPM<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo site_url('cpm/cpm_lpm')?>">CPM LPM</a></li>
                            <li><a href="<?php echo site_url('cpm/cpm_ldpm')?>">CPM LDPM</a></li>
                        </ul>     
                    </li>-->
                    <li class="dropdown <?php if ($this->uri->segment(1) == 'cpp') echo 'active'; ?>">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">DATA<span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="<?php echo site_url('cpm/kota')?>">REKAP CPM LPM</a></li>
                                    <li><a href="<?php echo site_url('cpm/kota_ldpm')?>">REKAP CPM LDPM</a></li>
                                    <li><a href="<?php echo site_url('cpp/cpp_kab_detail')?>">REKAP CPP KABUPATEN</a></li>
                                    <li><a href="<?php echo site_url('cpp/cbp')?>">DATA CBP</a></li>
                                    <li><a href="<?php echo site_url('cpp/kota_cpp_ldpm)?>">CPP Provinsi (LDPM)</a></li>
                                    <li><a href="<?php echo site_url('cpp/bulog)?>">CPP Provinsi (BULOG)</a></li>
                                    <!--<li><a href="<?php echo site_url('cpp/perkembangan')?>">Grafik</a></li>-->
                                </ul>
                    </li>
                    <li <?php if (current_url() == site_url('category/agenda')) echo 'class="active"'; ?>><a href="<?php echo site_url('category/agenda')?>">Agenda</a></li>
                    <li><a href="#">Galeri</a></li>
                </ul>
            </div>
        </div>
    </div>
</nav>
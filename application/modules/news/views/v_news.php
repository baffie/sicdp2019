<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div class="row">
    <div class="col-md-12">
        <ol class="breadcrumb" itemprop="BreadcrumList" itemscope="BreadcrumbList" itemtype="http://schema.org/BreadcrumbList">
            <li itemprop="itemListElement" itemscope="ListItem" itemtype="http://schema.org/ListItem"><a href="<?php echo site_url() ?>" itemprop="item"><span itemprop="name">Home</span></a></li>
            <li itemprop="itemListElement" itemscope="ListItem" itemtype="http://schema.org/ListItem"><span itemprop="name">Berita</span></li>
            <li itemprop="itemListElement" itemscope="ListItem" itemtype="http://schema.org/ListItem" class="active" itemprop="item"><span itemprop="name">Index</span></li>
        </ol>
    </div>
</div>
<div class="row mb15">
    <div class="col-md-9">
        <h1 class="page-header mt0">Index Berita</h1>
        <ul class="media-list">
            <?php
            foreach ($detail->result_array() as $row) {
                $y = dateTime($row['created']);
                $url = site_url('read/'.$y['year'].$y['month'].$y['day'].'/'.$row['id'].'/'.$row['slug']);
                $url_img = base_url('uploads/thumbs/'.$row['images_content']);
                echo '<li class="media mb15">
                        <div class="media-left">
                            <a href="'.$url.'" title="'.$row['title'].'">
                                <img class="media-object lazy" data-original="'.$url_img.'" width="150" alt="'.$row['title'].'">
                            </a>
                        </div>
                        <div class="media-body">
                            <i class="fa fa-clock-o"></i> <small>'.dateformatindo($row['created'],3).'</small><br>
                            <a href="'.$url.'" title="'.$row['title'].'">
                                <h4 class="media-heading">'.$row['title'].'</h4>
                            </a>
                            <p>'.word_limiter($row['summary'],25).'</p>
                        </div>
                    </li>';
            }
            ?>
        </ul>

        <?php echo (isset($pagination)) ? $pagination : ''; ?>
    </div>

    <div class="col-md-3">
        <?php $this->load->view('news/right_inside'); ?>
        <img src="<?php echo base_url('assets/img/banner/banner2.png')?>" class="img-responsive lazy mb15" alt="">
    </div>
</div>


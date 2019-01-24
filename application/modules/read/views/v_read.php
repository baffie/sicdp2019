<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<ol class="breadcrumb" itemprop="BreadcrumList" itemscope="BreadcrumbList" itemtype="http://schema.org/BreadcrumbList">
    <li itemprop="itemListElement" itemscope="ListItem" itemtype="http://schema.org/ListItem"><a href="<?php echo site_url() ?>" itemprop="item"><span itemprop="name">Home</span></a></li>
    <li itemprop="itemListElement" itemscope="ListItem" itemtype="http://schema.org/ListItem"><a href="<?php echo site_url('news') ?>" itemprop="item"><span itemprop="name">Berita</span></a></li>
    <li itemprop="itemListElement" itemscope="ListItem" itemtype="http://schema.org/ListItem" class="active" itemprop="item"><span itemprop="name"><?php echo $detail['title'] ?></span></li>
</ol>
<style>
    .content-page .img-wrapper {
        max-height:400px;
        overflow:hidden;

    }
    .content-page .img-wrapper img{
        display: block;
        width:100%;
        margin: 0 auto;
    }
</style>

<div class="row mb40">
    <div class="col-md-9 col-sm-9 content-page">
        <article itemscope="itemscope" itemtype="http://schema.org/Article">
            <?php if (!empty($detail['subtitle'])) echo '<h3 class="mt0">'.$detail['subtitle'].'</h3>' ?>
            <h1 class="mt0" itemprop="headline"><?php echo $detail['title'] ?></h1>
            <p>
                <i class="fa fa-clock-o"></i> <time itemprop="datePublished" datetime="<?php echo $detail['created'];?>"><?php echo dateformatindo($detail['created'],1)?></time>
            </p>
            <div class="img-wrapper">
                <img itemprop="image" class="img-responsive" src="<?php echo base_url('uploads/'.$detail['images_content']); ?>" alt="" style="width: 100%">
                <meta itemprop="thumbnailUrl" content="<?php echo base_url('uploads/thumbs/'.$detail['images_content']); ?>">
            </div>

            <?php
            if(!empty($detail['images_caption'])) {
                echo '<figcaption><p class="mb30 p5" style="border-bottom: 1px solid #eeeeee"><small>'.$detail['images_caption'].'</small></figcaption>';
            }
            ?>

            <div class="page-content" itemprop="articleBody">
                <p><?php echo $detail['summary'] ?></p>
                <?php echo $detail['content'];?>

                <?php if(!empty($detail['source'])) echo '<p class="mt15"><strong>Sumber:</strong> '.$detail['source'].'</p>'; ?>
            </div>
        </article>
    </div>

    <div class="col-md-3">
        <?php $this->load->view('news/right_inside'); ?>
        <img src="<?php echo base_url('assets/img/banner/banne2.png')?>" class="img-responsive lazy mb15" alt="">
    </div>
</div>
<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="row">
    <div class="col-md-12">
        <ol class="breadcrumb" itemprop="BreadcrumList" itemscope="BreadcrumbList" itemtype="http://schema.org/BreadcrumbList">
            <li itemprop="itemListElement" itemscope="ListItem" itemtype="http://schema.org/ListItem"><a href="<?php echo site_url() ?>" itemprop="item"><span itemprop="name">Home</span></a></li>
            <li itemprop="itemListElement" itemscope="ListItem" itemtype="http://schema.org/ListItem"><span itemprop="name">Profil</span></li>
            <li itemprop="itemListElement" itemscope="ListItem" itemtype="http://schema.org/ListItem" class="active" itemprop="item"><span itemprop="name"><?php echo $detail['title'] ?></span></li>
        </ol>
    </div>
</div>
<div class="row mb30">
    <div class="col-md-12">
        <h1 class="title text-center margin-bottom-30"><?php echo $detail['title'] ?></h1>
        <p><?php echo $detail['summary'] ?></p>
        <p><?php echo $detail['description'] ?></p>
    </div>
</div>

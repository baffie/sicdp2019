<div class="mb15" style="background: #c8dfea; border-top: 4px solid #b7cfda">
    <div class="container">
        <?php echo modules::run('news/testimonial'); ?>
    </div>
</div>
<div class="container">
    <hr>
</div>
<footer class="mb15 text-center">
    <p><?php echo setting('copyright') ?></p>
    <!--<a href="<?php echo site_url()?>">Home</a> | <a href="<?php echo site_url('news')?>">Berita</a> | <a href="<?php echo site_url()?>">Profil</a> | <a href="<?php echo site_url()?>">Program</a> | <a href="<?php echo site_url('category/agenda')?>">Agenda</a> | <a href="<?php echo site_url()?>">Galeri</a> | <a href="<?php echo site_url('category/artikel')?>">Artikel</a>-->
    <?php echo (ENVIRONMENT === 'development') ?  '<br><small>Page rendered in {elapsed_time} seconds</small>' : '' ?>
</footer>
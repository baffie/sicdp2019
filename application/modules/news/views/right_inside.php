<div class="panel-agenda"><i class="fa fa-calendar"></i>  A G E N D A <small class="pull-right"><a style="color: #ffffff" href="<?php echo site_url('category/agenda')?>">+ Index</a></small></div>
<?php
$news = $this->news_model->get_news_list('agenda', 0, 1);
if($news){
    foreach($news as $row){
        $y = dateTime($row['created']);
        $url = site_url('read/'.$y['year'].$y['month'].$y['day'].'/'.$row['id'].'/'.$row['slug']);
        $url_img = base_url('uploads/thumbs/'.$row['images_content']);
        ?>
        <a href=""><img data-original="<?php echo $url_img?>" class="img-responsive lazy" alt="<?php echo $row['title']?>"></a>
        <h4><a href="<?php echo $url?>" title="<?php echo $row['title']?>"><?php echo $row['title']?></a></h4>
        <?php
    }
}
?>
<ul class="topic mb15">
    <?php
    $news = $this->news_model->get_news_list('agenda', 1, 2);
    if($news){
        foreach($news as $row){
            $y = dateTime($row['created']);
            $url = site_url('read/'.$y['year'].$y['month'].$y['day'].'/'.$row['id'].'/'.$row['slug']);
            ?>
            <li><a href="<?php echo $url ?>" title="<?php echo $row['title']?>"><?php echo $row['title']?></a></li>
            <?php
        }
    }
    ?>
</ul>

<div class="panel panel-default">
    <div class="panel-article text-warning"><i class="fa fa-newspaper-o"></i> A R T I K E L<small class="pull-right"><a href="<?php echo site_url('category/artikel')?>" class="text-warning">+ Index</a></small></div>
    <hr class="no-space">
    <div class="panel-body">
        <?php
        $news = $this->news_model->get_news_list('artikel', 0, 1);
        if($news){
            foreach($news as $row){
                $y = dateTime($row['created']);
                $url = site_url('read/'.$y['year'].$y['month'].$y['day'].'/'.$row['id'].'/'.$row['slug']);
                $url_img = base_url('uploads/thumbs/'.$row['images_content']);
                ?>
                <a href=""><img data-original="<?php echo $url_img?>" class="img-responsive lazy mb15" alt="<?php echo $row['title']?>"></a>
                <h4><a href="<?php echo $url?>" title="<?php echo $row['title']?>"><?php echo $row['title']?></a></h4>
                <?php
            }
        }
        ?>
    </div>
    <div class="list-group">
        <?php
        $news = $this->news_model->get_news_list('artikel', 1, 2);
        if($news){
            foreach($news as $row){
                $y = dateTime($row['created']);
                $url = site_url('read/'.$y['year'].$y['month'].$y['day'].'/'.$row['id'].'/'.$row['slug']);
                ?>
                <a class="list-group-item" href="<?php echo $url ?>" title="<?php echo $row['title']?>"><?php echo $row['title']?></a>
                <?php
            }
        }
        ?>
    </div>
</div>
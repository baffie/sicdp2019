<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="row" style="padding: 30px 0px 15px 0px; ">
    <div class="col-md-12">
        <div class="owl-carousel carousel-footer">
            <?php
            if($testimonial){
                foreach($testimonial as $row){
                    $y = dateTime($row['created']);
                    $url = site_url('read/'.$y['year'].$y['month'].$y['day'].'/'.$row['id'].'/'.$row['slug']);
                    $url_img = base_url('uploads/thumbs/'.$row['images_content']);
                    ?>
                    <div class="media">
                        <div class="media-left">
                            <a href="<?php echo $url?>" title="<?php echo $row['title']?>">
                                <img class="media-object img-circle" src="<?php echo $url_img?>" style="width: 100px" alt="<?php echo $row['images_caption']?>">
                            </a>
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading"><a href="<?php echo $url?>" title="<?php echo $row['title']?>"><?php echo $row['title']?></a></h4>
                            <?php echo word_limiter($row['summary'],25)?>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
    </div>
</div>
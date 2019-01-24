<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $this->load->view('frontend/v_slider'); ?>
<div class="row">
    <div class="col-md-9 mb15">
        <div class="row mb30">
            <div class="col-md-6">
                <?php
                $news = $this->news_model->get_news_list('info-cadangan-pangan', 0, 1);
                if($news){
                    foreach($news as $row){
                        $y = dateTime($row['created']);
                        $url = site_url('read/'.$y['year'].$y['month'].$y['day'].'/'.$row['id'].'/'.$row['slug']);
                        $url_img = base_url('uploads/thumbs/'.$row['images_content']);
                        ?>
                        <div class="bthumbnail image-hover">
                            <a href="<?php echo $url?>"><img data-original="<?php echo $url_img?>" class="img-responsive margin-bottom-15 lazy" alt="<?php echo $row['title']?>"></a>
                            <div class="bcategory">
                                <span class="sec">Info Cadangan Pangan</span>
                            </div>
                        </div>
                        <h3><a href="<?php echo $url?>" title="<?php echo $row['title']?>"><?php echo $row['title']?></a></h3>
                        <p><i class="fa fa-clock-o"></i> <?php echo dateformatindo($row['created'],3)?></p>
                        <p><?php echo word_limiter($row['summary'],25)?> <a href="<?php echo $url?>">Selengkapnya</a></p>
                        <?php
                    }
                }
                ?>
                <ul class="topic">
                    <?php
                    $news = $this->news_model->get_news_list('info-cadangan-pangan', 1, 3);
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
                <a href="<?php echo site_url('category/info-cadangan-pangan')?>" class="btn btn-danger">+ Index</a>
            </div>
            <div class="col-md-6">
                    <?php
                    $news = $this->news_model->get_news_list('info-ketahanan-pangan', 0, 1);
                    if($news){
                        foreach($news as $row){
                            $y = dateTime($row['created']);
                            $url = site_url('read/'.$y['year'].$y['month'].$y['day'].'/'.$row['id'].'/'.$row['slug']);
                            $url_img = base_url('uploads/thumbs/'.$row['images_content']);
                            ?>
                            <div class="bthumbnail image-hover">
                                <a href="<?php echo $url?>"><img data-original="<?php echo $url_img?>" class="img-responsive margin-bottom-15 lazy" alt="<?php echo $row['title']?>"></a>
                                <div class="bcategory">
                                    <span class="sec">Info Ketahanan Pangan</span>
                                </div>
                            </div>
                            <h3><a href="<?php echo $url?>" title="<?php echo $row['title']?>"><?php echo $row['title']?></a></h3>
                            <p><i class="fa fa-clock-o"></i> <?php echo dateformatindo($row['created'],3)?></p>
                            <p><?php echo word_limiter($row['summary'],25)?> <a href="<?php echo $url?>">Selengkapnya</a></p>
                            <?php
                        }
                    }
                    ?>
                    <ul class="topic">
                        <?php
                        $news = $this->news_model->get_news_list('info-ketahanan-pangan', 1, 3);
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
                    <a href="<?php echo site_url('category/info-ketahanan-pangan')?>" class="btn btn-danger">+ Index</a>
                </div>
        </div>
        <div style="border-bottom: 2px dotted #4c8f6e; margin-bottom: 2px"></div>
        <div class="mb15" style="border-bottom: 2px dotted #4c8f6e"></div>
        <div class="row mb30">
            <div class="col-md-6">
                    <?php
                    $news = $this->news_model->get_news_list('info-program', 0, 1);
                    if($news){
                        foreach($news as $row){
                            $y = dateTime($row['created']);
                            $url = site_url('read/'.$y['year'].$y['month'].$y['day'].'/'.$row['id'].'/'.$row['slug']);
                            $url_img = base_url('uploads/thumbs/'.$row['images_content']);
                            ?>
                            <div class="bthumbnail image-hover">
                                <a href="<?php echo $url?>"><img data-original="<?php echo $url_img?>" class="img-responsive margin-bottom-15 lazy" alt="<?php echo $row['title']?>"></a>
                                <div class="bcategory">
                                    <span class="sec">Info Program</span>
                                </div>
                            </div>
                            <?php
                        }
                    }
                    ?>
            </div>
            <div class="col-md-6">
                <?php
                $news = $this->news_model->get_news_list('info-program', 0, 1);
                if($news){
                    foreach($news as $row){
                        $y = dateTime($row['created']);
                        $url = site_url('read/'.$y['year'].$y['month'].$y['day'].'/'.$row['id'].'/'.$row['slug']);
                        $url_img = base_url('uploads/thumbs/'.$row['images_content']);
                        ?>
                        <h3 class="mt0"><a href="<?php echo $url?>" title="<?php echo $row['title']?>"><?php echo $row['title']?></a></h3>
                        <p><i class="fa fa-clock-o"></i> <?php echo dateformatindo($row['created'],3)?></p>
                        <p><?php echo word_limiter($row['summary'],25)?> <a href="<?php echo $url?>">Selengkapnya</a></p>
                        <?php
                    }
                }
                ?>
                <ul class="topic">
                    <?php
                    $news = $this->news_model->get_news_list('info-program', 1, 3);
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
            </div>
        </div>
        <!-- <div class="row">
            <div class="col-md-12">
                <img src="<?php echo base_url('assets/img/banne1.jpg')?>" class="img-responsive lazy" alt="">
            </div>
        </div> -->
    </div>
    <div class="col-md-3">
        <table id="mytable" class="table table-bordered table-striped" style="width:100%">
  <tr>
    <th>Gubernur</th>
    <th>Wakil Gubernur</th> 
  </tr>
  <tr>
    <td><img src="<?php echo base_url('assets/img/gubernur.jpg')?>" class="img-responsive lazy" alt="gubernur banten"></td>
    <td><img src="<?php echo base_url('assets/img/wagub.jpg')?>" class="img-responsive lazy" alt="wakil bupati pandeglang"></td>
</table>
    </div>
</div>
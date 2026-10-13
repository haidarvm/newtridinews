<?php include 'template/header.php';?>

<?php $top_banner = !empty($ads) ? $ads->getAds(3) : '';
if(!empty($top_banner->status) && $top_banner->status == 1) {?>
<div class="container ">
    <div class="row">
        <div class="col-md-12">
            <figure class="mt-3">
                <a href="<?= base_url()."ads/".$top_banner->ads_id;?>"  target="_blank">
                    <img src="<?=imgBasePathUrl($top_banner->path);?>"  width="330" height="300" alt="<?=$top_banner->title;?>" class="img-fluid">
                </a>
            </figure>
        </div>
    </div>
</div> 
<?php }?>
<section class="bg-content">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <!-- <figure class="mt-3 ">
                    <a href="http://bit.ly/GreenKurbanBobotoh" target="_blank">
                        <img src="" loading="lazy" alt="sinergi foundation" class="img-fluid ">
                    </a>
                </figure> -->
                <!-- Popular news carousel -->
                <div class="card__post-carousel">
                    <?php  foreach ($headlines as $headline) { ?>
                    <div class="item">
                        <!-- Post Article -->
                        <div class="card__post">
                            <div class="card__post__body" style="padding: 0;">
                                <a href="<?=readUrl($headline->post_date, $headline->post_title)?>">
                                    <img src="<?=imgBasePathUrl($headline->img_mid);?>" class="img-fluid" loading="lazy" alt="<?=$headline->post_title;?>">
                                </a>
                                <div class="card__post__content bg__post-cover">
                                    <!-- <div class="card__post__category">
                                        covid-19
                                    </div> -->
                                    <div class="card__post__title">
                                        <h2><a
                                                href="<?=readUrl($headline->post_date, $headline->post_title)?>"><?=$headline->post_title;?></a>
                                        </h2>
                                    </div>
                                    <div class="card__post__author-info">
                                        <ul class="list-inline">
                                            <li class="list-inline-item">
                                                <span>
                                                    <?=$headline->post_date;?>
                                                </span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
                <div class="wrapper__list__article mt-4">
                    <h4 class="border_section">Video</h4>
                    <div class="slidering">
                        <?php  foreach ($videos as $video) { ?>
                        <div class="item" style="padding-right: 15px;">
                            <!-- Post Article -->
                            <div class="article__entry">
                                <div class="img_video">
                                    <a href="<?=readUrl($video->post_date, $video->post_title)?>">
                                        <img src="<?=imgBasePathUrl($video->img_mid);?>" class="img-fluid" loading="lazy" alt="<?=$video->post_title;?>">
                                    </a>
                                </div>
                                <div class="article__content">
                                    <ul class="list-inline">
                                        <li class="list-inline-item">
                                            <span>
                                                <?=$video->post_date;?>
                                            </span>
                                        </li>
                                    </ul>
                                    <h5><a
                                            href="<?=readUrl($video->post_date, $video->post_title)?>"><?=$video->post_title;?></a>
                                    </h5>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
                <!-- End Popular 3 news carousel -->
                <!-- Banner ads -->
                <?php $center_banner = !empty($ads) ? $ads->getAds(6) : '';
                if(!empty($center_banner->status) && $center_banner->status == 1) {?>
                <figure class="mt-4 mb-4">
                    <a href="<?= base_url()."ads/".$center_banner->ads_id;?>" target="_blank">
                        <img src="<?=imgBasePathUrl($center_banner->path);?>"  class="img-fluid" loading="lazy" alt="<?=$center_banner->title;?>">
                    </a>
                </figure>
                <?php } ?>
                <!-- End Banner ads -->
                <!-- Category news -->
                <div class="wrapper__list__article">
                    <h4 class="border_section">Berita Terkini</h4>
                    <div class="wrapp__list__article-small">
                        <!-- Post Article List -->
                        <?php  
                        $i = 0;
                        foreach ($latest as $news) { 
                        $i++;
                        if ($i == 4) {
                            ?>
                        <?php $center_banner_two = !empty($ads) ? $ads->getAds(9) : '';
                          if(!empty($center_banner_two->status) && $center_banner_two->status == 1) {?>
                        <div class="mb-3">
                            <a href="<?= base_url()."ads/".$center_banner_two->ads_id;?>" target="_blank">
                                <img src="<?=imgBasePathUrl($center_banner_two->path);?>" class="img-fluid" loading="lazy" alt="<?=$center_banner_two->title;?>">
                            </a>
                        </div>
                        <?php } ?>
                        <?php
                        } ?>
                        <div class="mb-3">
                            <!-- Post Article -->
                            <div class="card__post card__post-list">
                                <div class="image-st">
                                    <a href="<?=readUrl($news->post_date, $news->post_title)?>">
                                        <img src="<?=imgBasePathUrl($news->img_thumb);?>" class="img-fluid" loading="lazy" alt="<?=$news->post_title;?>">
                                    </a>
                                </div>
                                <div class="card__post__body ">
                                    <div class="card__post__content">
                                        <div class="card__post__author-info mb-2">
                                            <ul class="list-inline">
                                                <li class="list-inline-item">
                                                    <span class="text-blue text-capitalize">
                                                        <?=$news->cat_name;?>
                                                    </span>
                                                </li>
                                                <li class="list-inline-item">
                                                    <span class="text-blue text-capitalize">
                                                        <?=tglJamDate($news->post_date);?>
                                                    </span>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="card__post__title">
                                            <h5><a
                                                    href="<?=readUrl($news->post_date, $news->post_title)?>"><?=$news->post_title;?></a>
                                            </h5>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>

                        <div class="load-more"></div>
                        <!-- <figure class="mt-4 mb-4">
                            <a href="#">
                                <img src="#" alt="" class="img-fluid">
                            </a>
                        </figure> -->

                    </div>
                    <div class="mx-auto">
				        <div class="row justify-content-center align-items-center">
                            <button type="button" class="load_button_last load-button btn btn-outline-primary mb-4 text-capitalize">Selanjutnya..</button>
                            <!-- <a href="#" class="btn btn-outline-primary mb-4 text-capitalize"> Load more</a> -->
                        </div>    
                    </div>
                </div>
            </div>
            <!-- End Category news -->

            <?php include 'template/sidebar.php';?>
           

          
        </div>
    </div>
</section>
<!-- End Popular Content news -->

<section class="wrapper__section p-0">
    <div class="wrapper__section__components">
        <!-- Footer  -->

        <?php include 'template/footer.php';?>

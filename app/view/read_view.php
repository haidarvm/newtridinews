<?php include 'template/header.php';?>

<section class="bg-white pb-60" style="padding-top: 0;">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <!-- Breadcrumb -->
                <ul class="breadcrumbs bg-light">
                    <li class="breadcrumbs__item">
                        <a href="<?=base_url();?>" class="breadcrumbs__url">
                            <i class="fa fa-home"></i> Home</a>
                    </li>
                    <li  href="<?=base_url(). 'category/'.strtolower($read->cat_name ?? '') ;?>"  class="breadcrumbs__item breadcrumbs__item--current">
                        <?=$read->cat_name;?>
                    </li>
                </ul>
            </div>
        </div>
      
        <div class="row">
            <div class="col-md-8">
                <!-- Social media animation -->
                <?php $top_banner = !empty($ads) ? $ads->getAds(3) : '';
                if(!empty($top_banner->status) && $top_banner->status == 1) {?>
                <figure class="mt-3 ">
                    <a href="<?=$top_banner->url;?>" target="_blank">
                        <img src="<?=imgBasePathUrl($top_banner->path);?>" loading="lazy" alt="<?=$top_banner->title;?>"
                            class="img-fluid ">
                    </a>
                </figure>
                <?php }?>
                <!-- Article detail -->
                <div class="col text-center justify-content-center align-self-center">
                </div>
                <div class="wrap__article-detail">
                    <div class="wrap__article-detail-title">
                        <h1>
                            <?=$read->post_title;?>
                        </h1>
                    </div>

                    <div class="wrap__article-detail-info">
                        <ul class="list-inline">
                            <li class="list-inline-item">
                                <a href="<?=base_url(). 'category/'.strtolower($read->cat_name ?? '') ;?>">
                                    <?=$read->cat_name;?>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <span class="text-dark text-capitalize ml-1">
                                    <?=tglJamDate($read->post_date);?>
                                </span>
                            </li>
                        </ul>
                    </div>
                   

                    <div class="wrap__article-detail-image">
                        <?php
                        if (empty($video)) {
                        ?>
                        <figure>
                            <img src="<?=imgBasePathUrl($read->img_mid);?>" alt="<?=$read->post_title;?>" loading="lazy"
                                class="img-fluid">
                            <i class="img-caption"><?=$read->img_caption;?></i>
                        </figure>
                        <?php } else {  ?>
                        <div class="embed-responsive embed-responsive-16by9 video-single">
                            <iframe class="embed-responsive-item"
                                src="https://www.youtube.com/embed/<?php echo getYoutube($video->link); ?>"
                                frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                        </div>
                        <?php  } ?>
                    </div>
                    <!-- GM  -->
                    

                    <div class="wrap__article-detail-content">
                        <div itemprop="articleBody">

                            <?php 
                            // print_r(singArray($keywords, "keyword"));
                            $channel_wa = '<p style="font-weight:300; font-size:16px"><i>Yuk gabung <b style="font-weight:500">channel whatsapp REPUBLIKBOBOTOH.COM</b> untuk mendapatkan berita-berita terbaru tentang Persib, Bobotoh, Liga 1, dan ragam berita menarik lainnya seputar Bandung Raya. <b style="font-weight:500"><a target="_blank" href="https://whatsapp.com/channel/0029VaBGMNw1NCrXzIOZZD1W">Klik di sini (JOIN)</a></b></i></p>';
                            // var_dump($content);
                            $adsother = '';
                            $new_content ='';
                            $youtube = '<p><b>TONTON VIDEONYA DI YOUTUBE <a href="https://www.youtube.com/@republikbobotohcom">RBCOM TV</a></b></p>';
                            if(preg_match('/<iframe/', $content, $rep_content)) {
                                $new_content  =  str_replace('<iframe', $youtube.'<iframe',$content);
                                // print_r($new_content);
                            } else {
                                $new_content = $content;
                            }

                            echo readAlso($new_content, $channel_wa,null, null,  $keywords); 
                            // $text = explode("\r\n",$read->post_content);
                            $follow = "<p style='font-size:16px;'>Follow Berita Republik Bobotoh di <b><a href='https://news.google.com/publications/CAAqBwgKMJPgowsw1uq7Aw?hl=id&gl=ID&ceid=ID%3Aid'>Google News</a></b></p>";
                            echo $follow;
                            ?>

                            <div class="editor">
                                <?php
                            $exclude = [30, 89];
                            if (!in_array($read->cat_id, $exclude)) {
                                echo !empty($read->name) ? '<p>Penulis: <b>' . $read->name . '</b> | ' : '<p>' ;
                                echo 'Editor: <b>' . $read->display_name . '</b></p>';
                            }?>
                                <!-- </p> -->
                            </div>
                            

                            <div class="total-views">
                                <ul class="list-inline">
                                    <span class="share">share on:</span>
                                    <li class="list-inline-item">
                                        <a class="btn btn-social-o facebook" target="_blank"
                                            href="https://www.facebook.com/sharer/sharer.php?u=<?=readUrl($read->post_date, $read->post_title);?>">
                                            <i class="fa fa-facebook-f"></i>
                                            <span>facebook</span>
                                        </a>

                                    </li>
                                    <li class="list-inline-item">
                                        <a class="btn btn-social-o twitter" target="_blank"
                                            href="https://twitter.com/intent/tweet?text=<?=$read->post_title?>&url=<?= readUrl($read->post_date, $read->post_title);?>">
                                            <i class="fa fa-twitter"></i>
                                            <span>twitter</span>
                                        </a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a class="btn btn-social-o whatsapp" target="_blank"
                                            href="whatsapp://send?text=<?=readUrl($read->post_date, $read->post_title);?>">
                                            <i class="fa fa-whatsapp"></i>
                                            <span>whatsapp</span>
                                        </a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a class="btn btn-social-o telegram" href="#">
                                            <i class="fa fa-telegram"></i>
                                            <span>telegram</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- News Tags -->
                <div class="blog-tags">
                    <ul class="list-inline">
                        <li class="list-inline-item">
                            <i class="fa fa-tags">
                            </i>
                        </li>
                        <?php foreach($keywords as $keyword) { ?>
                        <li class="list-inline-item">
                            <a href="<?=base_url().'tag/'.trim($keyword->keyword);?>">
                                <?=$keyword->keyword?>
                            </a>
                        </li>
                        <?php } ?>
                    </ul>
                </div>

                

                <!-- PREV NEXT TODO -->
                <div class="row mt-3">
                    <div class="col">
                        <div class="single_navigation-prev">
                            <a href="<?=readUrl($postBefore->post_date, $postBefore->post_title)?>">
                                <span>Berita Sebelumnya</span>
                                <?=$postBefore->post_title;?>
                            </a>
                        </div>
                    </div>
                    <div class="col">
                        <div class="single_navigation-next text-left text-md-right">
                            <a href="<?=readUrl($postAfter->post_date, $postAfter->post_title)?>">
                                <span>Berita Berikutnya</span>
                                <?=$postAfter->post_title;?>
                            </a>
                        </div>
                    </div>
                </div>
             
                <!-- Composite Start -->
               
                <!-- Composite End -->
                <!-- Terkini -->
                 <div class="lazy-widget" data-url="/lazy/terkini">
                        <div class="placeholder">Memuat Terkini...</div>
                </div>
            </div>
            <?php include 'template/sidebar.php';?>
            <div class="clearfix"></div>
        </div>
    </div>
</section>
<?php include 'template/footer.php';?>
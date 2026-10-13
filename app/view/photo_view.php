<?php include 'template/header.php';?>
<style>
@media only screen and (min-width:320px) {
    .slide {
        flex-direction: row;
    }

    .slide-images {
        width: 100%;
    }

    .slide-description {
        margin-left: 36px;
    }

    .photos {
        width: 113px !important;
        padding-right: 3px !important;
        margin: 0 !important;
    }
}

.blacked {
    background-color: #000000;
}

/* Thumbnails Slider */
.slider-thumbnails {
    margin-left: -5px;
    margin-right: -5px;
}

.slider-thumbnails .slick-slide {
    padding: 5px;
}

/* .slider-thumbnails .slick-slide:focus img {} */

.slider-thumbnails .slick-slide img {
    max-width: 100%;
}



/* Main Slider */
.slider {
    margin-bottom: 15px;
}

.slider .slick-slide {}

.slider .slick-slide img {
    width: 100%;
}

/* make button larger and change their positions */
.slick-prev,
.slick-next {
    width: 30px;
    height: 30px;
    z-index: 1;
}

.slick-prev {
    left: 5px;
}

.slick-next {
    right: 5px;
}

.slick-prev:before,
.slick-next:before {
    font-size: 40px;
    text-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
}


/* General slick slider styling */
.slick-slide:focus,
.slick-slide:focus {
    outline: none;
    /* remove default outline when on :focus */
}

/* hide dots and arrow buttons when slider is not hovered */
.slick-slider:not(:hover) .slick-arrow,
.slick-slider:not(:hover) .slick-dots {
    opacity: 0;
}
.slide-arrow{
  position: absolute;
  top: 50%;
  margin-top: -15px;
  color:#fff;
}
.slick-prev:before,
.slick-next:before {
    color:#fff; 
    font-size: 30px;
}

/* transition effects for opacity */
.slick-arrow {
    color: #fff;
    font-family: 'icomoon' !important;
    /* transition: opacity 0.5s ease-out; */
}

/* Loading effects for main slider */
.slider {
    background: url(img/tail-spin.svg);
    background-repeat: no-repeat;
    background-position: center;
    background-size: 100px 100px;
    min-height: 100px;
}

.slider img.slick-loading {
    opacity: 0;
}

.slider img {
    transition: opacity 0.3s ease 0s;
}

.slider .slick-loading:after {
    content: 'loading'
}
</style>
<section class="bg-white pb-60">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <!-- Breadcrumb -->
                <ul class="breadcrumbs bg-light">
                    <li class="breadcrumbs__item">
                        <a href="<?=base_url();?>" class="breadcrumbs__url">
                            <i class="fa fa-home"></i> Home</a>
                    </li>
                    <li class="breadcrumbs__item breadcrumbs__item--current">
                        <?=$read->cat_name;?>
                    </li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <!-- Article detail -->
                <div class="wrap__article-detail">
                    <div class="wrap__article-detail-image">
                        <div class="slide">
                            <div class="slide-images">
                                <div class="slider">
                                    <?php
                                if(!empty($photos)) {?>
                                    <?php foreach($photos as $photo) {?>
                                    <div>
                                        <img class="img-fluid" src="<?php echo imgBasePathUrl($photo->full_path); ?>"
                                            loading="lazy" alt="" title="" />
                                    </div>
                                    <?php } ?>
                                    <?php  
                                } ?>
                                </div>
                                <div class="slider-thumbnails">
                                    <?php if (!empty($photos)) { ?>
                                    <?php foreach($photos as $photo) { ?>
                                    <img class="photos" src="<?php echo imgBasePathUrl($photo->img_thumb); ?>" alt=""
                                        title="" />
                                    <?php } ?>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="wrap__article-detail-title">
                        <h1>
                            <?=$read->post_title;?>
                        </h1>
                    </div>

                    <div class="wrap__article-detail-info">
                        <ul class="list-inline">
                            <li class="list-inline-item">
                                <a href="#">
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
                    <div class="wrap__article-detail-content">
                        <!-- <p class=""> -->
                        <?php 
                            echo $content; 
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
                                        href="https://twitter.com/share?text=<?=$read->post_title?>&url=<?= readUrl($read->post_date, $read->post_title);?>">
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
                                <!-- <li class="list-inline-item">
                                    <a class="btn btn-linkedin-o linkedin" href="#">
                                        <i class="fa fa-linkedin"></i>
                                        <span>linkedin</span>
                                    </a>
                                </li> -->
                            </ul>
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
                    <div class="row">
                        <div class="col-md-6">
                            <div class="single_navigation-prev">
                                <a href="<?=readUrl($postBefore->post_date, $postBefore->post_title)?>">
                                    <span>Berita Sebelumnya</span>
                                    <?=$postBefore->post_title;?>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="single_navigation-next text-left text-md-right">
                                <a href="<?=readUrl($postAfter->post_date, $postAfter->post_title)?>">
                                    <span>Berita Berikutnya</span>
                                    <?=$postAfter->post_title;?>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</section>
<?php include 'template/footer.php';?>
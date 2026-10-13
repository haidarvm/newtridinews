<?php include 'template/header_page.php';?>
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

    .product {
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

.slide-arrow {
    position: absolute;
    top: 50%;
    margin-top: -15px;
    color: #fff;
}

.slick-prev:before,
.slick-next:before {
    color: #fff;
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
                        <?=$product->name;?>
                    </li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <!-- Article detail -->
                <div class="wrap__article-detail">
                    <div class="wrap__article-detail-image">
                        <!-- <figure>
                            <img src="<?=imgBasePathUrl($product->path);?>" alt="<?=$product->name;?>" loading="lazy"
                                class="img-fluid">
                        </figure> -->
                        <div class="slide">
                            <div class="slide-images">
                                <div class="slider">
                                    <div>
                                    <img class="img-fluid" src="<?php echo imgBasePathUrl($product->path); ?>"
                                            loading="lazy" alt="" title="" />
                                    </div>
                                    <?php
                                if(!empty($product_imgs)) {?>
                                    <?php foreach($product_imgs as $product_img) {?>
                                    <div>
                                        <img class="img-fluid" src="<?php echo imgBasePathUrl($product_img->original); ?>"
                                            loading="lazy" alt="" title="" />
                                    </div>
                                    <?php } ?>
                                    <?php  
                                } ?>
                                </div>
                                <div class="slider-thumbnails">
                                    <?php if (!empty($product_imgs)) { ?>
                                    <img class="photos" src="<?php echo imgBasePathUrl($product->thumb); ?>" alt=""
                                    title="" />
                                    <?php foreach($product_imgs as $product_img) { ?>
                                    <img class="photos" src="<?php echo imgBasePathUrl($product_img->thumb); ?>" alt=""
                                        title="" />
                                    <?php } ?>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="wrap__article-detail-title">
                        <h1>
                            <?=$product->name;?>
                        </h1>
                        <h2>
                            Rp. <?=$product->price;?>
                        </h2>
                    </div>


                    <div class="wrap__article-detail-content">
                        <?php  echo $product->description;   ?>
                        <div class="total-views pb-80">
                            <ul class="list-inline" style="float:left;">
                                <span class="share" style="font-size: 20px; display:inline;">Beli Via:</span>
                                <li class="list-inline-item"><h1>
                                    <a class="btn btn-gradient-primary btn-lg btn-rounded btn-fw btn-social-o  whatsapp" target="_blank"
                                    style="font-size: 20px;" href="https://api.whatsapp.com/send?phone=6285722202193&text=Saya%20tertarik%20dengan%20product%20Local%20Loyal%20Store%20(<?=$product->name;?>)">
                                        <i class="fa fa-whatsapp"></i>
                                        <span style="font-size: 15px; display:inline;">WhatsApp</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="total-views pt-20">
                            <ul class="list-inline">
                                <span class="share">share on:</span>
                                <li class="list-inline-item">
                                    <a class="btn btn-social-o facebook" target="_blank"
                                        href="https://www.facebook.com/sharer/sharer.php?u=<?=productUrl($product->name);?>">
                                        <i class="fa fa-facebook-f"></i>
                                        <span>facebook</span>
                                    </a>

                                </li>
                                <li class="list-inline-item">
                                    <a class="btn btn-social-o twitter" target="_blank"
                                        href="https://twitter.com/share?text=<?=$product->name?>&url=<?= productUrl($product->name);?>">
                                        <i class="fa fa-twitter"></i>
                                        <span>twitter</span>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a class="btn btn-social-o whatsapp" target="_blank"
                                        href="whatsapp://send?text=<?=productUrl($product->name);?>">
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
                    <!-- PREV NEXT TODO -->
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</section>
 <?php include 'template/footer.php';?>
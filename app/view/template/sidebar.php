<!-- start sidebar -->
<div class="col-md-4">
    <div class="col-aside d-none d-xl-flex primary-sidebar justify-content-center">
        <div class="sidebar">
            <div class="sidebar-sticky-container">
                <div class="ad-skyscraper-container ">
                    <?php $left_banner = $ads->getAds(5);
                    if ($left_banner->status == 1) { ?>
                    <a href="<<?= base_url() . "ads/" . $left_banner->ads_id; ?>" target="_blank">
                        <img src="<?= imgBasePathUrl($left_banner->path); ?>" loading="lazy"
                            alt="<?= $left_banner->title; ?>" class="img-fluid">
                    </a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <aside class="wrapper__list__article">
        <div class="wrapper__list__article-small">
            <div class="justify-content-center" style="text-align: center;">
                <!-- Djarum video -->
                <figure class="mb-3">
                    <!-- video 
                    <video  class="lazy embed-responsive embed-responsive-16by9 hide-mobile" id="video"  preload="none" muted autoplay controls loop>
                       <source data-src="<?= base_url(); ?>assets/img/espresso.mp4" >
                    </video>-->
                </figure>
                <?php $right_banner = $ads->getAds(4);
                    if ($right_banner->status == 1) { ?>
                <figure class="mb-4">
                    <a href="<?= base_url() . "ads/" . $right_banner->ads_id; ?>" target="_blank">
                        <img src="<?= imgBasePathUrl($right_banner->path); ?>" width="330" height="300"
                            alt="<?= $right_banner->title; ?>" class="img-fluid">
                    </a>
                </figure>
                <?php } ?>
                <?php $right_banner_two = $ads->getAds(8);
                    if ($right_banner_two->status == 1) { ?>
                <figure class="mb-4">
                    <a href="<?= base_url() . "ads/" . $right_banner_two->ads_id; ?>" target="_blank">
                        <img src="<?= imgBasePathUrl($right_banner_two->path); ?>" width="330" height="300"
                            alt="<?= $right_banner_two->title; ?>" class="img-fluid">
                    </a>
                </figure>
                <?php } ?>

                <!-- Add WA business -->

            </div>
            <!-- Add Live Score add lazy also-->
            <h4 class="border_section mb-2">Klasemen LIGA 1 2026/2027</h4>
            <figure class="mb-2">
                <div id="klasmen"></div>
            </figure>

            <!-- Live Score embed -->
            <?php
            // echo $klasmen->content;
                    ?>
            <div style="text-align:center;"></div>
            <aside class="wrapper__list__article mt-3">
                <div class="mb-3">
                    <!-- Post Popular -->
                    <div class="lazy-widget" data-url="/lazy/popular">
                        <div class="placeholder">Memuat Popular...</div>
                    </div>
                </div>
            </aside>

            <aside class="wrapper__list__article">
                <!-- List Article -->
                <div class="mb-3">
                    <!-- Post Article -->
                    <div class="lazy-widget" data-url="/lazy/ragam">
                        <div class="placeholder">Memuat Ragam...</div>
                    </div>
                </div>
            </aside>
            <div class="lazy-widget" data-url="/lazy/teras">
                <div class="placeholder">Memuat Teras...</div>
            </div>
        </div>
        <div class="mb-3">
            <div class="lazy-widget" data-url="/lazy/bobotoh">
                <div class="placeholder">Memuat Bobotoh...</div>
            </div>
        </div>
    </aside>

    <!-- Tags news 
        <aside class="wrapper__list__article">
            <h4 class="border_section">tags</h4>
            <div class="blog-tags p-0">
                <ul class="list-inline">

                    <li class="list-inline-item">
                        <a href="#">
                            #property
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a href="#">
                            #sea
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a href="#">
                            #programming
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a href="#">
                            #sea
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a href="#">
                            #property
                        </a>
                    </li>
                </ul>
            </div>
        </aside>
        End Tags news -->
</div>
</div>
<!-- End Sidebar -->
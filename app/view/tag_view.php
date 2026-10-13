<?php include 'template/header.php';?>
<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <!-- Breadcrumb -->
                <ul class="breadcrumbs bg-light mb-4">
                    <li class="breadcrumbs__item">
                        <a href="index.html" class="breadcrumbs__url">
                            <i class="fa fa-home"></i> Home</a>
                    </li>
                    <li class="breadcrumbs__item breadcrumbs__item--current">
                        <?=$tag_name;?>
                    </li>
                </ul>
            </div>

        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <?php $top_banner = $ads->getAds(3);
                if($top_banner->status == 1) {?>
                    <figure class="mt-3 ">
                        <a href="<?=$top_banner->url;?>" target="_blank">
                            <img src="<?=imgBasePathUrl($top_banner->path);?>" loading="lazy" alt="<?=$top_banner->title;?>" class="img-fluid ">
                        </a>
                    </figure> 
                <?php }?>
                <aside class="wrapper__list__article ">
                    <h4 class="border_section"><?=urldecode($tag_name);?></h4>

                    <div class="wrapper__list__article-small">
                    <?php 
                    $i = 0;
                    foreach ($tags as $tag) {
                        if($i == 3) {
                        $center_banner = $ads->getAds(6);
                        if ($center_banner->status == 1) {
                                echo '<figure class="mt-4 mb-4">
                                <a href="'.$center_banner->url.'" target="_blank">
                                    <img src="' . imgBasePathUrl($center_banner->path) . '"  class="img-fluid" loading="lazy" alt="'.$center_banner->title .'">
                                </a>
                            </figure>';
                            }
                        }
                        $i++;
                        ?>
                            <div class="mb-3">
                                <!-- Post Article -->
                                <div class="card__post card__post-list">
                                    <div class="image-st">
                                        <a href="<?=readUrl($tag->post_date, $tag->post_title)?>">
                                            <img src="<?=imgBasePathUrl($tag->img_thumb);?>" class="img-fluid" loading="lazy" alt="<?=$tag->post_title;?>">
                                        </a>
                                    </div>
                                    <div class="card__post__body ">
                                        <div class="card__post__content">
                                            <div class="card__post__author-info mb-2">
                                                <ul class="list-inline">
                                                    <li class="list-inline-item">
                                                        <span class="text-dark text-capitalize">
                                                        <?=indosDate($tag->post_date);?>
                                                        </span>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="card__post__title">
                                                <h5>
                                                    <a href="<?=readUrl($tag->post_date, $tag->post_title)?>">
                                                    <?=$tag->post_title;?>
                                                    </a>
                                                </h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php } ?> 
                        </div>
                </aside>
                <!-- Pagination -->
                <div class="pagination-area" >
                    <div class="pagination wow fadeIn animated" data-wow-duration="2s" data-wow-delay="0.5s"
                        style="visibility: visible; animation-duration: 2s; animation-delay: 0.5s; animation-name: fadeIn;">
                        <?php echo $paginator;?>
                    </div>
                </div>
            </div>
            <?php include 'template/sidebar.php';?>
        </div>
    </div>
</section>
<?php include 'template/footer.php';?>
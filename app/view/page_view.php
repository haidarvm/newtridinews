<?php include 'template/header_page.php';?>
<section id="content_main" class="clearfix jl_spost">
    <div class="container">
        <div class="row main_content">
            <div class="col-md-8  loop-large-post" id="content">
                <div class="widget_container content_page">
                    <!-- start post -->
                    <div class="post-2970 post type-post status-publish  has-post-thumbnail hentry category-business tag-inspiration tag-morning tag-tip tag-tutorial "
                        id="post-2970">
                        <div class="single_section_content box blog_large_post_style">
                            <div class="jl_single_style2">
                                <div class="single_post_entry_content single_bellow_left_align jl_top_single_title jl_top_title_feature">
                                    <h1 class="single_post_title_main"><?=$read->post_title;?></h1>
                                </div>
                                <?php if($read->img_mid) {?>
                                <div class="image-post-thumb jlsingle-title-above slide-inner jl_radus_e">
                                    <img class="size-sprasa_feature_large img-fluid" loading="lazy"
                                        src="<?=imgBasePathUrl($read->img_mid);?>" alt="<?=$read->img_caption;?>">
                                </div>
                                <p class="meta-category-small"><i><?=$read->img_caption;?></i></p>
                                <?php } ?>
                            </div>

                            <div class="post_sw">
                                <div class="post_s">
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="post_content jl_content" <?=autoParagraph($read->post_content);?>><?php echo readAlso($read->post_content);?></div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <!-- end post -->
                    <div class="brack_space"></div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php include 'template/footer.php';?>
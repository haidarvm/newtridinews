<aside class="wrapper__list__article">
    <h4 class="border_section"><?=$title;?></h4>
    <!-- List Article -->
    <div class="mb-3">
        <!-- Post Article -->
        <?php foreach ($articles as $row) { ?>
        <div class="card__post card__post-list mb-2">
            <div class="image-sm">
                <a href="<?=readUrl($row->post_date, $row->post_title)?>">
                    <img src="<?=imgBasePathUrl($row->img_thumb);?>" class="img-fluid" loading="lazy"
                        alt="<?=$row->post_title;?>">
                </a>
            </div>
            <div class="card__post__body ">
                <div class="card__post__content">

                    <div class="card__post__author-info mb-2">
                        <ul class="list-inline">
                            <li class="list-inline-item">
                                <span class="text-blue text-capitalize">
                                    <?=$row->post_date;?>
                                </span>
                            </li>

                        </ul>
                    </div>
                    <div class="card__post__title">
                        <h6>
                            <a href="<?=readUrl($row->post_date, $row->post_title)?>">
                                <?=$row->post_title;?>
                            </a>
                        </h6>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</aside>
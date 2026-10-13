<div class="wrapper__list__article mt-3">
  <div class="wrapp__list__article-small">
    <h4>Berita Terkini</h4>
    <?php $i = 0; foreach($latest as $news) { ?>
    <div class="mb-3">
      <!-- Post Article -->
      <div class="card__post card__post-list">
        <div class="image-st">
          <a href="<?=readUrl($news->post_date, $news->post_title)?>">
            <img
              src="<?=imgBasePathUrl($news->img_thumb);?>"
              loading="lazy"
              alt="<?=$news->post_title;?>"
              class="img-fluid"
            />
          </a>
        </div>
        <div class="card__post__body">
          <div class="card__post__content">
            <div class="card__post__author-info mb-2">
              <ul class="list-inline">
                <li class="list-inline-item">
                  <span class="text-blue text-capitalize">
                    <?=$news->cat_name;?>
                  </span>
                </li>
                <li class="list-inline-item">
                  <span> <?=tglJamDate($news->post_date);?> </span>
                </li>
              </ul>
            </div>
            <div class="card__post__title">
              <h5>
                <a href="<?=readUrl($news->post_date, $news->post_title)?>"
                  ><?=$news->post_title;?></a
                >
              </h5>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php }?>
  </div>
</div>

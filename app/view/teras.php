<h4 class="border_section mt-3">Teras Bandung</h4>

<?php
$terask = [];

foreach ($articles ?? [] as $teras) {
    if (is_object($teras)) {
        // Jika model Laravel / ORM
        if (method_exists($teras, 'toArray')) {
            $terask[] = $teras->toArray();
        } else {
            // Jika stdClass biasa
            $terask[] = (array) $teras;
        }
    } elseif (is_array($teras)) {
        // Jika data dari awal sudah berbentuk array
        $terask[] = $teras;
    }
}

if (!empty($terask)):
    ?>

<div class="article__entry mb-3">
  <div class="article__image">
    <a href="<?= $terask[0]['url'] ?? '#' ?>" target="_blank">
      <img
        src="<?= $terask[0]['img_mid'] ?? '' ?>"
        class="img-fluid"
        loading="lazy"
        alt="<?= $terask[0]['title'] ?? '' ?>"
      />
    </a>
  </div>
  <div class="article__content">
    <ul class="list-inline">
      <li class="list-inline-item">
        <span class="text-blue text-capitalize">
          <?= $terask[0]['date'] ?? '' ?>
        </span>
      </li>
    </ul>
    <h5>
      <a href="<?= $terask[0]['url'] ?? '#' ?>" target="_blank">
        <?= $terask[0]['title'] ?? '' ?>
      </a>
    </h5>
  </div>
</div>

<?php if (count($terask) > 1): ?>
  <?php foreach (array_slice($terask, 1) as $teraskrow): ?>
    <div class="mb-3">
      <!-- Post Article -->
      <div class="card__post card__post-list mb-2">
        <div class="image-sm">
          <a href="<?= $teraskrow['url'] ?? '#' ?>" target="_blank">
            <img
              src="<?= $teraskrow['img_thumb'] ?? '' ?>"
              class="img-fluid"
              loading="lazy"
              alt="<?= $teraskrow['title'] ?? '' ?>"
            />
          </a>
        </div>

        <div class="card__post__body">
          <div class="card__post__content">
            <div class="card__post__author-info mb-2">
              <ul class="list-inline">
                <?php if (!empty($teraskrow['cat_name'])): ?>
                  <li class="list-inline-item">
                    <span class="text-blue text-capitalize">
                      <?= $teraskrow['cat_name'] ?>
                    </span>
                  </li>
                <?php endif; ?>
                <li class="list-inline-item">
                  <span class="text-blue text-capitalize">
                    <?= $teraskrow['date'] ?? '' ?>
                  </span>
                </li>
              </ul>
            </div>
            <div class="card__post__title">
              <h6>
                <a href="<?= $teraskrow['url'] ?? '#' ?>" target="_blank">
                  <?= $teraskrow['title'] ?? '' ?>
                </a>
              </h6>
            </div>
          </div>
        </div>
      </div>
    </div>
  <?php endforeach; ?>
<?php endif; ?>

<?php else: ?>
  <div class="alert alert-info">Belum ada data teras berita.</div>
<?php endif; ?>
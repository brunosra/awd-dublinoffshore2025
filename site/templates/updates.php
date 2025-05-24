<?php snippet('header') ?>

<?php snippet('pageHero') ?>

<aside class="">
  <h5>Filter by type</h5>
  <ul class="">
    <li class="">
      <a href="<?= $page->url() ?>">All</a>
    </li>
    <?php foreach($tags as $tag): ?>
    <li class="tag">
      <a href="<?= url($page->url(), ['params' => ['tag' => urlencode($tag)]]) ?>">
        <?= html($tag) ?>
      </a>
    </li>
    <?php endforeach ?>
  </ul>
</aside>

<section class="">
  <?php foreach($posts as $post): ?>
    <article>
      <a class="" href="<?= $post->url() ?>">
          <?php if ($post->cover()->isNotEmpty()): ?>
            <?php foreach ($post->cover()->toFiles() as $image): ?>
              <?php
              $sizes = "(min-width: 1200px) 50vw,
                        (min-width: 900px) 33vw,
                        (min-width: 600px) 50vw,
                        100vw";
              ?>
              <picture>
                <source srcset="<?= $image->srcset('webp') ?>" sizes="<?= $sizes ?>" type="image/webp">
                <img
                    class=""
                    alt="<?= $image->alt() ?>"
                    data-src="<?= $image->resize(300)->url() ?>"
                    data-srcset="<?= $image->srcset() ?>"
                    sizes="<?= $sizes ?>"
                    width="<?= $image->resize(310)->width() ?>"
                    height="<?//= $image->resize(500)->height() ?>">
              </picture>
            <?php endforeach ?>
          <?php else: ?>
          <!-- Hard coded location of placeholder image here  <?//= url('assets/images/#.webp') ?>-->
          <?php endif ?>
          <p class="small"><?= $post->published()->toDate('Y') ?></p>
          <?php foreach ($post->tags() as $tag): ?>
            <p class="small"><?= $tag ?></p>
          <?php endforeach ?>
          <h6 class=""><?= $post->title()->esc() ?></h6>
      </a>  
    </article>
  <?php endforeach ?>
  <nav class="pagination">     <!-- pagination -->
    <?php if($pagination->hasPrevPage()): ?>
      <h6><a style="" href="<?= $pagination->prevPageUrl() ?>">&lsaquo; Previous</a></h6>
    <?php endif ?>
    <?php if($pagination->hasNextPage()): ?>
      <h6><a style="" href="<?= $pagination->nextPageUrl() ?>">Next &rsaquo;</a></h6>
    <?php endif ?>
  </nav>     <!-- padgination end -->
</section>

<?php snippet('footer') ?>





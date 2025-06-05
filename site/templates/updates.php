<?php snippet('header') ?>
<?php snippet('page_hero') ?>

<div class="container">
  <aside class="tags">
    <h5>Filter by type</h5>
    <ul class="tag-list">
      <li class="tag-item">
        <a href="<?= $page->url() ?>" class="btn btn-tag btn-small">All</a>
      </li>
      <?php foreach($tags as $tag): ?>
      <li class="tag-item">
        <a href="<?= url($page->url(), ['params' => ['tag' => urlencode($tag)]]) ?>" class="btn btn-tag btn-small">
          <?= html($tag) ?>
        </a>
      </li>
      <?php endforeach ?>
    </ul>
  </aside>

  <section class="post-list">
    <?php foreach($posts as $post): ?>
      <article>
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
                    width="<?= $image->width(310) ?>"
                    height="<? $image->height(235) ?>">
              </picture>
            <?php endforeach ?>
          <?php else: ?>
            <picture>
              <img src="<?= vite()->asset('assets/images/default-post-image.svg') ?>" alt="<?= $post->title()->esc() ?>">
            </picture>
          <?php endif ?>
          <div class="post-meta">
            <p class="small year"><?= $post->published()->toDate('Y') ?></p>
            <ul class="post-meta-tags">
              <?php foreach ($post->tags() as $tag): ?>
                <li>
                  <a href="<?= url($page->url(), ['params' => ['tag' => urlencode($tag)]]) ?>" class="btn btn-tag btn-small">
                    <?= html($tag) ?>
                  </a>
                </li>
              <?php endforeach ?>
            </ul>
          </div>
          <a class="article-card h6" href="<?= $post->url() ?>"><?= $post->title()->esc() ?></a>
          <span class="read-more"><img src="<?= vite()->asset('assets/images/arrow.svg') ?>" alt="Read More" width="10" height="10"></span>
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
</div>

<?php snippet('footer') ?>




